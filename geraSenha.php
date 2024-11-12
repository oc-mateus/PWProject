 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    <?php   
        $senha = "lala";
        $custo = "09";
        $salt = "Cf1f11ePArKlBJomM0F6aJ";

        // Gera um hash baseado em bcrypt
        $hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");

        echo "<p>$hash</p>";
    ?>
 </body>
 </html>
