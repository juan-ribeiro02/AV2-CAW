<?php 
    
    if(!isset($_SESSION))
    {
        session_start();
    }
    
    if(isset($_SESSION['id']))
    {
        die("Voce não pode acessara esta pagina devido ao você não estar logado.<p><a href\"index.php\">Entrar</a></p>");
    }



?>