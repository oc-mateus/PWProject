<?php
include ("../config.php");
include (HEADER_TEMPLATE);
?>
<Style>
   .centraliza{
       display: grid;
       place-items: center;
    }
   
</Style>
<div id="actions" class="mt-5 mb-5">
    <form action="valida.php" method="post">
        <div class="row">
            <!-- User input -->
             <div class="centraliza">
                <div class="form-floating col-md-4 col-md-offset-2">
                    <div class="row mt-2">
                    <label for="log">Usuário</label>
                    <input type="text" class="form-control" id="log" placeholder="Usuário" name="login">
                    </div>
                <!-- Password input --> 
                <div class="row mt-2">
                <label for="pass">Senha</label>
                    <input type="password" class="form-control" id="pass" placeholder="Senha" name="senha">
                    </div>
                
                <!-- Submit button -->
                <div class="row mt-2">
                    <button type="submit" class="btn btn-secondary btn-block mb-4"><i class="fa-solid fa-user-check"></i> Conectar</button>
                    <a href="<?php echo BASEURL; ?>" class="btn btn-light btn-block mb-4"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
                    </div>
                </div>
             </div>
        </div>
    </form>
</div>
<?php include (FOOTER_TEMPLATE);?>