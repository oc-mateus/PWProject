<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Cadastro De Gerentes</title>
    
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" type="image/png" href="<?php echo BASEURL; ?>css/favicon.png"/>
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome/all.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">

    <style>
        body {
            padding-top: 50px;
            padding-bottom: 20px;
        }
        .btn-light {
            color: #ffffff;
            background-color: #999999;
            border-color: #999999;
        }
        .btn-action {
            color: #ffffff;
            background-color: #666666;
            border-color: #666666;
        }
        header, .actions {
            border-bottom: solid 1px #666666;
            margin-bottom: 20px;
        }
    </style>
    
</head>
<body>
    <br>
    <!-- Início do Menu -->
    <nav class="navbar navbar-expand-xl bg-dark fixed-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php"><i class="fa-solid fa-igloo fa-2x "></i></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Clientes Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Clientes</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Add. Cliente</a></li>
                        </ul>
                    </li>
                    <!-- Gerentes Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gerentes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>adms"><i class="fa-solid fa-user-tie"></i> Gerentes</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>adms/addAdm.php"><i class="fa-solid fa-user-plus"></i> Add. Gerente</a></li>
                        </ul>
                    </li>
                    <!-- Usuários Dropdown (exibe apenas se o usuário estiver logado como admin) -->
                    <?php if (isset($_SESSION['user'])): ?>
                        <?php if ($_SESSION['user']['is_admin']): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Usuários
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>users"><i class="fa-solid fa-user-lock"></i> Gerenciar Usuários</a></li>
                                    <li><a class="dropdown-item" href="<?php echo BASEURL; ?>users/addUsers.php"><i class="fa-solid fa-user-tie"></i> Add. Usuário</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <!-- Login/Logout -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL; ?>inc/logout.php">
                                Bem-vindo, <?php echo $_SESSION['user']['name']; ?>! <i class="fa-solid fa-person-walking-arrow-right"></i> Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASEURL; ?>inc/login.php">
                                <i class="fa-solid fa-users"></i> Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fim do Menu -->

    <main class="container">
        <!-- Conteúdo principal aqui -->
    </main>

    <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>
