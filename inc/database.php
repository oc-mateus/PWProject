<?php
//mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR );
$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_STRICT & ~MYSQLI_REPORT_ERROR;

function open_database()
{
	try {
		$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		$conn->SET_charset("utf8");
		return $conn;
	} catch (Exception $e) {
		throw $e;
		// echo "<H3> Ocorreu um erro: <br>\n ".$e->getMessage() . "</H3>\n";
		return null;
	}
}

function close_database($conn)
{
	try {
		// mysqli_close($conn);
		$conn = null;
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
function find($table = null, $id = null)
{
	try {
		$database = open_database();
		$found = null;

		if ($id) {
			$sql = "SELECT * FROM " . $table . " WHERE id = " . $id;
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$found = $result->fetch_assoc();
			}

		} else {

			$sql = "SELECT * FROM " . $table;
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				// $found = $result->fetch_all(MYSQLI_ASSOC);

				/* Metodo alternativo */
				$found = array();
				while ($row = $result->fetch_assoc()) {
					array_push($found, $row);
				}
			}
		}
	} catch (Exception $e) {
		$_SESSION['message'] = $e->GetMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
}

/**
 *  Pesquisa Todos os Registros de uma Tabela
 */
function find_all($table)
{
	return find($table);
}
function formatadata($data, $formato)
{
	$dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
	return $dt->format($formato);
}

function telefone($telefone)
{
	$tel = "(" . substr($telefone, 0, 2) . ") " .
		substr($telefone, 2, 5) . "-" . substr($telefone, 7);
	return $tel;
}
function formatarCPF($cpf_cnpj)
{
    $cpfFormatado = substr($cpf_cnpj, 0, 3) . "." .
                    substr($cpf_cnpj, 3, 3) . "." .
                    substr($cpf_cnpj, 6, 3) . "-" .
                    substr($cpf_cnpj, 9);
    return $cpfFormatado;
}

function celPhone($phone)
{
	$cel = "(" . substr($phone, 0, 2) . ") " .
		substr($phone, 2, 5) . "-" . substr($phone, 7);
	return $cel;
}

function cep($cep)
{
	$cep = substr($cep, 0, 4) . "-" . substr($cep, 5);
	return $cep;
}

/**
*  Insere um registro no BD
*/
function save($table = null, $data = null) {

	$database = open_database();
  
	$columns = null;
	$values = null;
  
	//print_r($data);
  
	foreach ($data as $key => $value) {
	  $columns .= trim($key, "'") . ",";
	  $values .= "'$value',";
	}
  
	// remove a ultima virgula
	$columns = rtrim($columns, ',');
	$values = rtrim($values, ',');
	
	$sql = "INSERT INTO " . $table . "($columns)" . " VALUES " . "($values);";
  
	try {
	  $database->query($sql);
  
	  $_SESSION['message'] = 'Registro cadastrado com sucesso.';
	  $_SESSION['type'] = 'success';
	
	} catch (Exception $e) { 
	
	  $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
	  $_SESSION['type'] = 'danger';
	} 
  
	close_database($database);
  }

  /**
 *  Atualiza um registro em uma tabela, por ID
 */
function update($table = null, $id = 0, $data = null) {

	$database = open_database();
  
	$items = null;
  
	foreach ($data as $key => $value) {
	  $items .= trim($key, "'") . "='$value',";
	}
  
	// remove a ultima virgula
	$items = rtrim($items, ',');
  
	$sql  = "UPDATE " . $table;
	$sql .= " SET $items";
	$sql .= " WHERE id=" . $id . ";";
  
	try {
	  $database->query($sql);
  
	  $_SESSION['message'] = 'Registro atualizado com sucesso.';
	  $_SESSION['type'] = 'success';
  
	} catch (Exception $e) { 
  
	  $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
	  $_SESSION['type'] = 'danger';
	} 
  
	close_database($database);
  }
  function remove( $table = null, $id = null ) {

	$database = open_database();
	  
	try {
	  if ($id) {
  
		$sql = "DELETE FROM " . $table . " WHERE id = " . $id;
		$result = $database->query($sql);
  
		if ($result = $database->query($sql)) {   	
		  $_SESSION['message'] = "Registro Removido com Sucesso.";
		  $_SESSION['type'] = 'success';
		}
	  }
	} catch (Exception $e) { 
  
	  $_SESSION['message'] = $e->GetMessage();
	  $_SESSION['type'] = 'danger';
	}
  
	close_database($database);
  }

  function filter($table = null, $p = null)
  {
	$database = open_database();
	$found = null;

	try{
		if($p){
			$sql = "SELECT * FROM " . $table . " WHERE " . $p;
			$result = $database->query($sql);
			if($result->num_rows > 0){
				$found = array();
				while($row = $result->fetch_assoc())
				{
					array_push($found, $row);
				}
			}else{
				throw new Exception("Não foram encontrados registros!");
			}
		}
	} catch(Exception $e){
		$_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
		$_SESSION['type'] = 'danger';
	}
	close_database($database);
	return $found;
  }

  function clear_messages(){
	$_SESSION['message'] = null;
	$_SESSION['type'] = null;
  }


?>