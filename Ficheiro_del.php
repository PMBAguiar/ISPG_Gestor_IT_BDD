<?php 
//conectar ao mysql
include ('include/bdd_connect.php');

$id = $_GET['id'];

//Dados de sessão
session_start();
if(is_null($_SESSION['Nome_Func']) or is_null($id)){
    header("Location: login.php");
    exit;
}

if($_SESSION['Nivel_Func']<1){
    header("Location: login.php");
    exit;
}

$query = "Call DelFich($id)";
mysqli_query($connection,$query);


if($_SESSION['Nivel_Func']==2){
    header("Location: Ficheiros.php");
    exit;
}else{
	header("Location: Ficheiros_user.php");
    exit;
}
?>
