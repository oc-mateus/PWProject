<?php
	include("../config.php");
	include(DBAPI);

	$customers = null;
	$customer = null;
	/**
	 *  Listagem de Clientes
	 */
	function index() {
		global $customers;
		$customers = find_all("customers");

	}

	/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
		global $customer;
		$customer = find('customers', $id);

	}

	/**
	 *  Cadastro de Clientes
	 */
	function add() {
		if (!empty($_POST['customer'])) {
			$today = date_create('now', new DateTimeZone('America/Sao_Paulo'));
			$customer = $_POST['customer'];
			$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");
	
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
					$customer['photo'] = $uploadFile; // Salva o caminho da imagem no array
				} else {
					echo "Erro ao fazer upload da imagem: " . $_FILES['photo']['error']; // Mostra o erro
				}
			} else {
				echo "Erro ao fazer upload: " . $_FILES['photo']['error']; // Mostra erro se o upload falhar
			}
	
			// Salva o cliente com a imagem
			save('customers', $customer);
			header('location: index.php');
		}
	}
	
	
	

	
	function edit() {
		$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
	
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
	
			if (isset($_POST['customer'])) {
				$customer = $_POST['customer'];
				$customer['modified'] = $now->format("Y-m-d H:i:s");
	
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
						$customer['photo'] = $uploadFile; // Salva o caminho da nova imagem no array
					} else {
						echo "Erro ao fazer upload da nova imagem.";
					}
				}
	
				update('customers', $id, $customer); // Atualiza o cadastro do cliente
				header('location: index.php');
			} else {
				global $customer;
				$customer = find('customers', $id); // Busca os dados do cliente para edição
			}
		} else {
			header('location: index.php'); // Redireciona se o ID não estiver definido
		}
	}
	

	/**
	 *  Exclusão de um Cliente ou Gerente
	 */

function delete($id = null) {

  global $customer;
  $customer = remove('customers', $id);

  header('location: index.php');
}
	
?>