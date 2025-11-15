<?php 

$usuario='f0_40375112';
$senha ='Acdej2025';
$database='if0_40375112_login';
$host='sql210.infinityfree.com';

$mysqli = new mysqli($host,$usuario,$senha,$database);

if($mysqli->error)
{
    die ("Falha ao conectar ao banco de dados:" . $mysqli->error);
}

?>