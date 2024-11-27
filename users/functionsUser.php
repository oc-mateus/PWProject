<?php
include("../config.php");
include(DBAPI);

$usuarios = null;
$usuario = null;

/**
 * Listagem de Clientes
 */
function index() {
    global $usuarios;
    if (!empty($_POST['users'])) {
        $usuarios = filter("usuarios", "nome like '%{$_POST['users']}%'");
    } else {
        $usuarios = find_all("usuarios");
    }
}

/**
 * Visualização de um Cliente
 */
function view($id = null) {
    global $usuario;
    $usuario = find('usuarios', $id);
}

/**
 * Cadastro de Clientes
 */
function addUsers() {
    if (!empty($_POST['usuario'])) {
        try {
            $usuario = $_POST['usuario'];
            // Criptografando a senha
            if (!empty($usuario['password'])) {
                $senha = criptografia($usuario['password']);
				$usuario['password'] = $senha;
            }
            save('usuarios', $usuario);
            header("Location: " . BASEURL . 'index.php');
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
}

function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
    try {
        if (!file_exists($pasta_destino)) {
            mkdir($pasta_destino, 0777, true); // Garante que a pasta exista
        }

        $uploadOk = 1;

        // Verifica se o arquivo é uma imagem
        $check = getimagesize($nome_temp);
        if ($check === false) {
            throw new Exception("O arquivo não é uma imagem!");
        }

        // Verifica tamanho do arquivo
        if ($tamanho_arquivo > 5000000) {
            throw new Exception("O arquivo é muito grande!");
        }

        // Verifica formato do arquivo
        $extensoes_permitidas = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($tipo_arquivo, $extensoes_permitidas)) {
            throw new Exception("Apenas arquivos JPG, JPEG, PNG e GIF são permitidos!");
        }

        // Move o arquivo
        if (!move_uploaded_file($nome_temp, $arquivo_destino)) {
            throw new Exception("Erro ao fazer o upload da imagem.");
        }

        $_SESSION['message'] = "Upload realizado com sucesso!";
        $_SESSION['type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = "Erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

/**
 * Edição de Usuários
 */
function editUser() {
    try {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if (isset($_POST['usuario'])) {
                $usuario = $_POST['usuario'];

                // Criptografando a senha
                if (!empty($usuario['password'])) {
                    $usuario['password'] = criptografia($usuario['password']);
                }

                // Upload da foto
                if (!empty($_FILES["foto"]["name"])) {
                    $pasta_destino = "users/fotos/"; // Atualizado para a pasta correta
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                    $nome_arquivo = basename($_FILES["foto"]["name"]);
                    $tamanho_arquivo = $_FILES["foto"]["size"];
                    $nome_temp = $_FILES["foto"]["tmp_name"];
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

                    $usuario['foto'] = $nome_arquivo;
                }

                update('usuarios', $id, $usuario);
                header("Location: " . BASEURL . 'index.php');
            } else {
                global $usuario;
                $usuario = find("usuarios", $id);
            }
        } else {
            header("Location: index.php");
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

/**
 * Exclusão de um Cliente ou Gerente
 */
function delete($id = null) {
    global $usuario;
    $usuario = remove("usuarios", $id);
    header("Location: index.php");
}
?>
