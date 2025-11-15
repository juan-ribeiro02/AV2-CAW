<?php 
    
    // SEMPRE inicie a sessão, não importa o quê.
    // Se ela já foi iniciada, o PHP é inteligente o bastante para não iniciar de novo.
    // Usar 'session_status()' é a forma mais correta.
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // AGORA que a sessão está carregada, podemos verificar o ID.
    if(!isset($_SESSION['id']))
    {
        die("Você não pode acessar esta página pois não está logado.<p><a href=\"index.php\">Entrar</a></p>");
    }
  /*  
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    if(!isset($_SESSION['id']))
    {
        die("Voce não pode acessara esta pagina devido ao você não estar logado. <p> <a href=\"index.php\">Entrar</a> </p>");
    }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>