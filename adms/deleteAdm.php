<?php 
  require_once('functionsAdm.php'); 

  if (isset($_GET['id'])){
    try{
      $adm = find("adms", $_GET['id']);
      delete($_GET['id']);
      unlink("imagens/" . $adm['photo']);
    } catch(Exception $e){
      $_SESSION['message'] = "Não foi possivel realizar a operação: " . $e->getMessage();
      $_SESSION['type'] = "danger";
    }
  } 
  
?>