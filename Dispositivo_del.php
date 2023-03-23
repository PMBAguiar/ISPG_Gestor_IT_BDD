<?php 
//conectar ao mysql
include ('include/bdd_connect.php');

$idd = $_GET['idd'];

//Dados de sessão
session_start();
if(is_null($_SESSION['Nome_Func']) or is_null($idd)){
    header("Location: login.php");
    exit;
}

if($_SESSION['Nivel_Func']!=2){
    header("Location: login.php");
    exit;
}

//Função de apagagem de um posto
//->Se for posto irá deixar placa_rede intacta
//->Se for outro irá apagar placa_rede associada
$query = "Call DelDisp($idd);";
mysqli_query($connection,$query);


header("Location: Dispositivo.php");
    exit;
?>
