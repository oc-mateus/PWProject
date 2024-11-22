<?php  
  require_once('functionsUser.php'); 
  addUsers();
  session_start();
?>

<?php include(HEADER_TEMPLATE); ?>
<head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        color: #023047;
    }

    .page {
        display: flex;
        flex-direction: column;
        align-items: center;
        align-content: center;
        justify-content: center;
        width: 100%;
        height: 100vh;
        background-color: #fff;
    }

    .formLogin {
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 7px;
        padding: 40px;
        box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.4);
        gap: 5px;
    }

    .formLogin h1 {
        padding: 0;
        margin: 0;
        font-weight: 500;
        font-size: 2.3em;
        margin-bottom: 20px;
    }

    .formLogin p {
        display: inline-block;
        font-size: 14px;
        color: #666;
        margin-bottom: 25px;
    }

    .formLogin input {
        padding: 15px;
        font-size: 14px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        margin-top: 5px;
        border-radius: 4px;
        transition: all linear 160ms;
        outline: none;
    }

    .formLogin input:focus {
        border: 1px solid #f72585;
    }

    .formLogin label {
        font-size: 14px;
        font-weight: 600;
    }

    .formLogin a {
        display: inline-block;
        margin-bottom: 20px;
        font-size: 13px;
        color: #555;
        transition: all linear 160ms;
    }

    .formLogin a:hover {
        color: #f72585;
    }

    .btn {
        background-color: #f72585;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        border: none !important;
        transition: all linear 160ms;
        cursor: pointer;
        margin: 0 !important;
        padding: 15px;
        border-radius: 4px;
    }

    .btn:hover {
        transform: scale(1.05);
        background-color: #ff0676;
    }

    #senhaErro {
        color: red;
        font-size: 0.9em;
        display: none;
    }
</style>
</head>
<br>
<br>
<br>
<div class="page">
    <form id="formCadastro" action="addUsers.php" method="post" class="formLogin">
        <h1>Cadastro</h1>
        <p>Preencha os campos abaixo para realizar o cadastro.</p>

        <label for="name">Nome</label>
        <input type="text" placeholder="Digite seu nome" name="usuario['nome']" required>

        <label for="username">Usuário (Login)</label>
        <input type="text" placeholder="Digite seu usuário" name="usuario['user']" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" placeholder="Digite sua senha" name="usuario['password']" required>

        <label for="confirmaSenha">Confirme a Senha</label>
        <input type="password" id="confirmaSenha" placeholder="Confirme sua senha" required>
        <span id="senhaErro">As senhas não coincidem!</span>
        <p>Já tem conta?, <a href="<?php echo BASEURL; ?>inc/login.php">Logar.</a></p>
        <button type="submit" class="btn">Cadastrar</button>
    </form>
     
</div>

<script>
    document.getElementById('formCadastro').addEventListener('submit', function(event) {
        const senha = document.getElementById('senha').value;
        const confirmaSenha = document.getElementById('confirmaSenha').value;
        const senhaErro = document.getElementById('senhaErro');

        if (senha !== confirmaSenha) {
            event.preventDefault(); // Impede o envio do formulário
            senhaErro.style.display = 'block'; // Mostra a mensagem de erro
        } else {
            senhaErro.style.display = 'none'; // Oculta a mensagem de erro
        }
    });
</script>

<?php include (FOOTER_TEMPLATE); ?>