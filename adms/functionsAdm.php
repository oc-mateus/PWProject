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
	 *  Cadastro de Gerentes com upload de foto
	 */
	function addAdms() {
		if (!empty($_POST['adms'])) {
			$today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
			$adms = $_POST['adms'];
			// Inicializar a variável que armazenará o caminho da imagem
            $adms['photo'] = null;
    
            // Lidar com o upload da imagem (se houver um arquivo enviado)
            if (isset($_FILES['photo']['name']) && $_FILES['photo']['error'] == 0) {
                $upload_dir = 'imagens/';
                $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
                $new_file_name = uniqid() . '.' . $file_extension; // Gerar um nome único para a imagem
                $uploaded_file = $upload_dir . $new_file_name;
    
                // Verificar e mover o arquivo enviado para o diretório de uploads
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file)) {
                    $adms['photo'] = $uploaded_file; // Salvar o caminho da imagem no banco de dados
                } else {
                    echo "Erro ao enviar a imagem.";
                }
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

				 // Inicializar a variável que armazenará o caminho da imagem
				 $adms['photo'] = null;
    
				 // Lidar com o upload da imagem (se houver um arquivo enviado)
				 if (isset($_FILES['photo']['name']) && $_FILES['photo']['error'] == 0) {
					 $upload_dir = 'imagens/';
					 $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
					 $new_file_name = uniqid() . '.' . $file_extension; // Gerar um nome único para a imagem
					 $uploaded_file = $upload_dir . $new_file_name;
		 
					 // Verificar e mover o arquivo enviado para o diretório de uploads
					 if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file)) {
						 $adms['photo'] = $uploaded_file; // Salvar o caminho da imagem no banco de dados
					 } else {
						 echo "Erro ao enviar a imagem.";
					 }
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