<?php
if (!isset($_SESSION)) session_start(); 

include('../config.php');
require_once(DBAPI);


if (empty($_POST['login']) || empty($_POST['senha'])) {
    header('Location: ' . BASEURL . 'index.php');
    exit;
}

$bd = open_database();

try {
    $usuario = $bd->real_escape_string($_POST['login']); 
    $senha = criptografia($bd->real_escape_string($_POST['senha']));

    
    $sql = "SELECT id, nome, user, password FROM usuarios WHERE user = '$usuario' AND password = '$senha' LIMIT 1";
    $query = $bd->query($sql);

    if ($query && $query->num_rows > 0) {
        $dados = $query->fetch_assoc();

        
        $_SESSION['id'] = $dados['id'];
        $_SESSION['nome'] = $dados['nome'];
        $_SESSION['user'] = $dados['user'];
        $_SESSION['message'] = "Bem-vindo, " . $dados['nome'] . "!";
        $_SESSION['type'] = "info";

        header("Location: " . BASEURL . 'index.php');
        exit;
    } else {
        throw new Exception("Usuário ou senha inválidos.");
    }
} catch (Exception $e) {
    $_SESSION['message'] = 'Erro: ' . $e->getMessage();
    $_SESSION['type'] = 'danger';
    header("Location: " . BASEURL . 'index.php');
    exit;
}
?>
