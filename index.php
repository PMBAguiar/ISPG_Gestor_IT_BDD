<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Aplicação Teste</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>



<?php 
//conectar ao mysql
include ('include/bdd_connect.php');

//Dados de sessão
session_start();
if(is_null( $_SESSION['Nome_Func'])){
    header("Location: login.php");
    exit;
}

//tabela parametro
$table = "evento";

?>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <div class="navbar-header" style="color: white; font-size: 18px;">
                <?php echo "Bem vindo ".$_SESSION['Nome_Func']."!&nbsp;"; ?>
            </div>
            <div class="navbar-header" style="color: white; font-size: 18px;">
              
              <a href="logout.php">Logout</a>
            </div>

            <?php 

            //menu admin
            if($_SESSION['Nivel_Func']==2){
            ?>
               <div class="collapse navbar-collapse navbar-ex1-collapse" style="font-size: 16px">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="index.php" ><i class="glyphicon glyphicon-home"></i> Home </a>
                        </li>  
                        <li >
                            <a href="Area.php" ><i class="fa fa-fw fa-file"></i> Àreas </a>
                        </li> 
                        <li >
                            <a href="Ficheiros.php" ><i class="fa fa-fw fa-file"></i> Àreas Ficheiros </a>
                        </li>    
                        <li >
                            <a href="Log.php" ><i class="fa fa-fw fa-table"></i> Log Ficheiros </a>
                        </li>
                        <li>
                            <a href="Posto.php" ><i class="glyphicon glyphicon-th-list"></i> Postos </a>
                        </li>
                        <li>
                            <a href="Dispositivo.php" ><i class="glyphicon glyphicon-th-list"></i> Dispositivos </a>
                        </li> 
                        <li>
                            <a href="Software.php" ><i class="glyphicon glyphicon-th-list"></i> Software </a>
                        </li> 
                        <li  >
                            <a href="Funcionario.php"><i class="glyphicon glyphicon-user"></i> Funcionários </a>
                        </li>     
                              
                    </ul>
                </div>
                <?php
            }else{
            //menu standard
            ?>
                <div class="collapse navbar-collapse navbar-ex1-collapse" style="font-size: 16px">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="index.php" ><i class="fa fa-fw fa-table"></i> Home </a>
                        </li>     
                        <li>
                            <a href="Ficheiros_user.php" ><i class="glyphicon glyphicon-check"></i> Ficheiros </a>
                        </li>    
                    </ul>
                </div>

            <?php
            }
            ?>

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Notícia1
                        </h1>
                        <img src="pics/background_img.png" alt="imagem_evento" align="left" width="40%" height="40%"">

                        <div class="col-lg-6" style="font-size: 18px">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere quam porttitor, vulputate tellus et, pretium ex. Sed ac felis dui. In luctus venenatis nunc nec fermentum. Praesent laoreet nisl lacus, malesuada hendrerit ligula vestibulum in. Nam accumsan, ipsum et porttitor dapibus, magna libero malesuada purus, non commodo nibh mi rhoncus tortor. Ut lacinia ligula felis, non consequat ipsum convallis eget. Mauris hendrerit vulputate tortor non vulputate. Donec lacinia sem justo, at consectetur ipsum venenatis in. Curabitur sit amet convallis neque. Nunc lacinia orci in purus hendrerit luctus. Vivamus interdum nisi augue, nec malesuada risus congue quis. Praesent in nulla id dui tempor tincidunt non aliquam sem. Quisque ultricies nulla magna, vitae mollis libero dictum et. Sed tempor condimentum auctor.
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Notícia2
                        </h1>
                        <img src="pics/background_img.png" alt="imagem_evento" align="right" width="40%" height="40%"">

                        <div class="col-lg-6" style="font-size: 18px">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse posuere quam porttitor, vulputate tellus et, pretium ex. Sed ac felis dui. In luctus venenatis nunc nec fermentum. Praesent laoreet nisl lacus, malesuada hendrerit ligula vestibulum in. Nam accumsan, ipsum et porttitor dapibus, magna libero malesuada purus, non commodo nibh mi rhoncus tortor. Ut lacinia ligula felis, non consequat ipsum convallis eget. Mauris hendrerit vulputate tortor non vulputate. Donec lacinia sem justo, at consectetur ipsum venenatis in. Curabitur sit amet convallis neque. Nunc lacinia orci in purus hendrerit luctus. Vivamus interdum nisi augue, nec malesuada risus congue quis. Praesent in nulla id dui tempor tincidunt non aliquam sem. Quisque ultricies nulla magna, vitae mollis libero dictum et. Sed tempor condimentum auctor.
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
