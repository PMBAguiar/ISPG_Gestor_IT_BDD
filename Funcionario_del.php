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

if($_SESSION['Nivel_Func']!=2){
    header("Location: login.php");
    exit;
}

$query = "INSERT INTO Acesso (`Tipo_Acesso`, `ID_Area`, `ID_Ficheiro`, `ID_Func`) VALUES ('upload', '$ida', '$id', '$idf');";
mysqli_query($connection,$query);

$query = "Call delFunc($id);";
mysqli_query($connection,$query);

header("Location: Funcionario.php");
    exit;
?>
