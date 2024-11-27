<?php 
	include("../config.php");
	include(DBAPI);

	$adms = null;

	/**
	 *  Listagem de Clientes
	 */
	function index() {
		global $adms;
		$adms = find_all("adms");
	}

	/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
		global $adms;
		$adms = find('adms', $id);
	}

	/**
	 * Função para upload de arquivos.
	 */
	function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
		try {
			// Cria a pasta se ela não existir
			if (!is_dir($pasta_destino)) {
				if (!mkdir($pasta_destino, 0777, true)) {
					throw new Exception("Falha ao criar a pasta de destino.");
				}
			}

			$nomearquivo = basename($arquivo_destino); 
			$uploadOk = 1;

			// Verifica se o arquivo é uma imagem
			$check = getimagesize($nome_temp);
			if ($check === false) {
				throw new Exception("O arquivo não é uma imagem!");
			}

			// Verifica se o arquivo já existe
			if (file_exists($arquivo_destino)) {
				throw new Exception("Desculpe, o arquivo já existe!");
			}

			// Verifica o tamanho do arquivo
			if ($tamanho_arquivo > 5000000) { // 5MB
				throw new Exception("Desculpe, mas o arquivo é muito grande!");
			}

			// Permite apenas certos formatos de arquivo
			if (!in_array($tipo_arquivo, ['jpg', 'jpeg', 'png', 'gif'])) {
				throw new Exception("Apenas arquivos JPG, JPEG, PNG e GIF são permitidos!");
			}

			// Faz o upload do arquivo
			if (!move_uploaded_file($nome_temp, $arquivo_destino)) {
				throw new Exception("Erro ao enviar o arquivo!");
			}

			$_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
			$_SESSION['type'] = "success";

		} catch (Exception $e) {
			$_SESSION['message'] = "Erro: " . $e->getMessage();
			$_SESSION['type'] = "danger";
		}
	}

	/**
	 *  Cadastro de Gerentes com upload de photo
	 */
	function addAdms() {
		if (!empty($_POST['adms'])) {
			$today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
			$adms = $_POST['adms'];

			// Upload da foto
			if (!empty($_FILES["photo"]["name"])) {
				$pasta_destino = "adms/imagens/"; // Pasta correta para salvar as imagens
				$arquivo_destino = $pasta_destino . basename($_FILES["photo"]["name"]);
				$nome_arquivo = basename($_FILES["photo"]["name"]);
				$tamanho_arquivo = $_FILES["photo"]["size"];
				$nome_temp = $_FILES["photo"]["tmp_name"];
				$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

				// Chamada da função upload
				upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

				$adms['photo'] = $nome_arquivo;
			}

			$adms['modified'] = $adms['created'] = $today->format("Y-m-d H:i:s");
			save('adms', $adms);

			header('Location: index.php');
			exit();
		}
	}

	/**
	 *  Atualização/Edição de Gerente
	 */
	function editAdms() {
		$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			if (isset($_POST['adms'])) {
				$adms = $_POST['adms'];
				$adms['modified'] = $now->format("Y-m-d H:i:s");

				// Upload da foto
				if (!empty($_FILES["photo"]["name"])) {
					$pasta_destino = "adms/imagens/"; // Pasta correta para salvar as imagens
					$arquivo_destino = $pasta_destino . basename($_FILES["photo"]["name"]);
					$nome_arquivo = basename($_FILES["photo"]["name"]);
					$tamanho_arquivo = $_FILES["photo"]["size"];
					$nome_temp = $_FILES["photo"]["tmp_name"];
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));

					upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

					$adms['photo'] = $nome_arquivo;
				}

				update('adms', $id, $adms);
				header('Location: index.php');
			} else {
				global $adms;
				$adms = find('adms', $id);
			}
		} else {
			header('Location: index.php');
		}
	}

	/**
	 * Exclusão de um Cliente ou Gerente
	 */
	function delete($id = null) {
		global $adms;
		$adms = remove('adms', $id);
		header('Location: index.php');
	}
?>
