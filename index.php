<?php
    require "config.php";
    include_once DBAPI;
    if (!isset($_SESSION)) session_start();
    include(HEADER_TEMPLATE);
    $db = open_database();
?>

<h1 class="text-center">Dashboard</h1>
<hr>

<?php if ($db) : ?>

    <div class="container text-center">
        <div class="row justify-content-center mt-2">
            <div class="col-xs-6 col-sm-3 col-md-2">
                <a href="adms/addAdm.php" class="btn btn-dark">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fa-solid fa-user-tie fa-6x"></i>
                        </div>
                        <div class="col-12 text-center">
                            <p><strong>Novo Gerente</strong></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <a href="adms" class="btn btn-secondary">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fa-solid fa-people-group fa-6x"></i>
                        </div>
                        <div class="col-12 text-center">
                            <p><strong>Gerentes</strong></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row justify-content-center mt-2">
            <div class="col-xs-6 col-sm-3 col-md-2">
                <a href="<?php echo BASEURL; ?>customers/add.php" class="btn btn-dark">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fa-solid fa-user-plus fa-6x"></i>
                        </div>
                        <div class="col-12 text-center">
                            <p><strong>Novo Cliente</strong></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <a href="<?php echo BASEURL; ?>customers" class="btn btn-secondary">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fa-solid fa-users fa-6x"></i>
                        </div>
                        <div class="col-12 text-center">
                            <p><strong>Clientes</strong></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-xs-6 col-sm-3 col-md-2">
                <a href="<?php echo BASEURL; ?>users/add.php" class="btn btn-dark">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fa-solid fa-user-plus fa-6x"></i>
                        </div>
                        <div class="col-12 text-center">
                            <p><strong>Novo Usuário</strong></p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <a href="<?php echo BASEURL; ?>users" class="btn btn-secondary">
                    <div class="row">
                        <div class="col-12 text-center">
                            <i class="fa-solid fa-users fa-6x"></i>
                        </div>
                        <div class="col-12 text-center">
                            <p><strong>Usuários</strong></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

<?php else : ?>
    <div class="alert alert-danger text-center" role="alert">
        <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
    </div>
<?php endif; ?>

<?php if (!empty($_SESSION['message'])) : ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible text-center" role="alert">
        <p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!<br>
        <?php echo $_SESSION['message']; ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<?php include(FOOTER_TEMPLATE); ?>
