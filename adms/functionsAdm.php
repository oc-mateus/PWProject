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

	function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
		/*
		 * Upload de arquivos no PHP
		 * https://www.w3schools.com/php/php_file_upload.asp
		 */
		
		// Upload da photo
		try {
			$nomearquivo = basename($arquivo_destino); // nome do arquivo
			$uploadOk = 1;
			// Verificando se o arquivo é uma imagem
			if (isset($_POST["submit"])) {
				$check = getimagesize($nome_temp);
				if ($check !== false) {
					$_SESSION['message'] = "File is an image - " . $check["mime"] . ".";
					$_SESSION['type'] = "info";
					//echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
					throw new Exception("O arquivo não é uma imagem!");
					//echo "O arquivo não é uma imagem!";
				}
			}
			
			// Verificando se o arquivo já existe na pasta
			if (file_exists($arquivo_destino)) {
				$uploadOk = 0;
				throw new Exception("Desculpe, o arquivo já existe!");
				//echo "Desculpe, o arquivo já existe.";
			}
			
			// Verificando se o tamanho do arquivo
			if ($tamanho_arquivo > 5000000) {
				$uploadOk = 0;
				throw new Exception("Desculpe, mas o arquivo é muito grande!");
				//echo "Desculpe, mas o arquivo é muito grande!";
			}
			
			// Allow certain file formats
			if ($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg"
					&& $tipo_arquivo != "gif") {
						$uploadOk = 0;
						throw new Exception("Desculpe, mas só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
						//echo "Desculpe, mas só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!";
					}
					
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
						//echo "Desculpe, mas o arquivo não pode ser enviado.";
					} else {
						// Se tudo estiver OK, tentamos fazer o upload do arquivo
						if (move_uploaded_file($_FILES["photo"]["tmp_name"], $arquivo_destino)) {
							//colocando o nome do arquivo da photo do usuário no vetor
							$_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
							$_SESSION['type'] = "success";
							//echo "The file ". htmlspecialchars(basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
						} else {
							throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
							//echo "Sorry, there was an error uploading your file.";
						}
					}
		} catch (Exception $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
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
			if (!empty($_FILES["photo"]["name"])){
				$pasta_destino = "imagens/"; //pasta onde ficam as photos
				$arquivo_destino = $pasta_destino . basename($_FILES["photo"]["name"]); //Caminho completo até o arquivo que será gravado
				$nome_arquivo = basename($_FILES["photo"]["name"]); // nome do arquivo
				$tamanho_arquivo = getimagesize($_FILES["photo"]["tmp_name"]);
				$tamanho_arquivo = $_FILES["photo"]["size"]; // tamanho do arquivo em bytes
				$nome_temp = $_FILES["photo"]["tmp_name"]; // nome e caminho do arquivo no servidor
				$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); // extensão do arquivo

				//Chamada da função upload para gravar a imagem
				upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

				$adms['photo'] = $nome_arquivo;
			}

			$adms['modified'] = $adms['created'] = $today->format("Y-m-d H:i:s");
	
			// Salvar os dados no banco de dados
			save('adms', $adms);
	
			// Redirecionar ou mostrar mensagem de sucesso
			header('Location: index.php');
			exit();
		}
	}
	
	/**
	 *  Atualização/Edicao de Gerente
	 */
	function editAdms() {
		$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

		if (isset($_GET['id'])) {
			$id = $_GET['id'];

			if (isset($_POST['adms'])) {
				$adms = $_POST['adms'];
				$adms['modified'] = $now->format("Y-m-d H:i:s");

				if (!empty($_FILES["photo"]["name"])){
					$pasta_destino = "imagens/"; //pasta onde ficam as photos
					$arquivo_destino = basename($_FILES["photo"]["name"]); //Caminho completo até o arquivo que será gravado
					$nome_arquivo = basename($_FILES["photo"]["name"]); // nome do arquivo
					$tamanho_arquivo = getimagesize($_FILES["photo"]["tmp_name"]);
					$tamanho_arquivo = $_FILES["photo"]["size"]; // tamanho do arquivo em bytes
					$nome_temp = $_FILES["photo"]["tmp_name"]; // nome e caminho do arquivo no servidor
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION)); // extensão do arquivo

					upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);

					$usuario['photo'] = $nome_arquivo;
				}

				update('adms', $id, $adms);
				header('location: index.php');
			} else {
				global $adms;
				$adms = find('adms', $id);
			}
		} else {
			header('location: index.php');
		}
	}

	/**
	 *  Exclusão de um Cliente ou Gerente
	 */

function delete($id = null) {

  global $adms;
  $adms = remove('adms', $id);

  header('location: index.php');
}
	
?>