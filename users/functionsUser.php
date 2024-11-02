<?php
	include("../config.php");
	include(DBAPI);

	$usuarios = null;
	$usuario = null;
	/**
	 *  Listagem de Clientes
	 */
	function index() {
		global $usuarios;
        if(!empty($_POST['users'])){
            $usuarios = filter("usuarios", "nome like '%{$_POST['users']}%'");
        }else{
            $usuarios = find_all("usuarios");
        }
	
	}
    /**
 * Criptografia
 */
function criptografia($senha) {
    // ==> Criptografia Blowfish
    // http://www.linhadecodigo.com.br/artigo/3332/criptografando-senhas-usando-bcrypt-blowfish-no-php.aspx

    // Aplicando criptografia na senha
    $custo = "09";
    $salt = "Cf1f11ePArKlBJomM0F6aJ";

    // Gera um hash baseado em bcrypt
    $hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");

    return $hash; // retorna a senha criptografada
}

	/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
		global $usuario;
		$usuario = find('users', $id);

	}

	/**
	 *  Cadastro de Clientes
	 */
	function add() {
		if (!empty($_POST['usuario'])) {
			$today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
			$usuario = $_POST['usuario'];
			$usuario['modified'] = $usuario['created'] = $today->format("Y-m-d H:i:s");
	
			// Lida com o upload da imagem
			if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
				$uploadDir = 'uploads/'; // Caminho onde os arquivos serão salvos
				$uploadFile = $uploadDir . basename($_FILES['photo']['name']);
				
				// Verifica se a pasta de uploads existe, se não, cria
				if (!is_dir($uploadDir)) {
					mkdir($uploadDir, 0777, true);
				}
	
				// Move o arquivo para a pasta de uploads
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
					$usuario['photo'] = $uploadFile; // Salva o caminho da imagem no array
				} else {
					echo "Erro ao fazer upload da imagem: " . $_FILES['photo']['error']; // Mostra o erro
				}
			} else {
				echo "Erro ao fazer upload: " . $_FILES['photo']['error']; // Mostra erro se o upload falhar
			}
	
			// Salva o cliente com a imagem
			save('usuarios', $usuario);
			header('location: index.php');
		}
	}
	
	
	

	
	function edit() {
		$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
	
			if (isset($_POST['usuario'])) {
				$usuario = $_POST['usuario'];
				$usuario['modified'] = $now->format("Y-m-d H:i:s");
	
				// Lida com o upload da nova imagem
				if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
					$uploadDir = 'uploads/'; // Pasta onde os arquivos serão salvos
					$uploadFile = $uploadDir . basename($_FILES['photo']['name']);
	
					// Verifica se a pasta de uploads existe, se não, cria
					if (!is_dir($uploadDir)) {
						mkdir($uploadDir, 0777, true);
					}
	
					// Move o arquivo para a pasta de uploads
					if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadFile)) {
						$usuario['photo'] = $uploadFile; // Salva o caminho da nova imagem no array
					} else {
						echo "Erro ao fazer upload da nova imagem.";
					}
				}
	
				update('usuarios', $id, $usuario); // Atualiza o cadastro do cliente
				header('location: index.php');
			} else {
				global $usuario;
				$usuario = find('usuarios', $id); // Busca os dados do cliente para edição
			}
		} else {
			header('location: index.php'); // Redireciona se o ID não estiver definido
		}
	}
	

	/**
	 *  Exclusão de um Cliente ou Gerente
	 */

function delete($id = null) {

  global $usuario;
  $usuario = remove('usuarios', $id);

  header('location: index.php');
}
	
?>