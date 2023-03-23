<!DOCTYPE html>
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
if(is_null($_SESSION['Nome_Func'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['Nivel_Func']!=2){
    header("Location: login.php");
    exit;
}


  //evitar warnings
  error_reporting(E_ERROR | E_PARSE);

  //tabela parametro
  $modo = $_GET['modo'];

  $go = $_GET['go'];
  if(is_null($go)){
    $go = 0;
  }

  $id = $_GET['id'];


    //Buscar dados a inserir/editar do formulário
    $Nome_Area=$_POST['Nome_Area'];
    $Desc_Area=$_POST['Desc_Area'];


  if($modo==1 && $go!=1){
    $getquery="SELECT * FROM Area WHERE ID_Ficheiro=$id";

    $result = mysqli_query($connection,$getquery);
    $val = mysqli_fetch_array($result);

    //Buscar dados a inserir/editar
    $Nome_Area= $val['Nome_Area'];
    $Desc_Area= $val['Desc_Area'];
  }

  if(is_null($Ativo_Func))
    $Ativo_Func = 0;  

  if($go == 1){

  switch($modo){
      //Modo novo registo
      case 0: $query = "INSERT INTO Area (Nome_Area, Desc_Area) 
                        VALUES ('$Nome_Area', '$Desc_Area');";
              break;
  }
  mysqli_query($connection,$query);
  header("Location: Area.php");
  exit;
}
?>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

            <div class="navbar-header" style="color: white; font-size: 18px;">
                <?php echo "Bem vindo ".$_SESSION['Nome_Ficheiro']."!&nbsp;"; ?>
            </div>
            <div class="navbar-header" style="color: white; font-size: 18px;">
              
                 <a href="logout.php">Logout</a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse" style="font-size: 16px">
                    <ul class="nav navbar-nav side-nav">
                        <li >
                            <a href="index.php" ><i class="glyphicon glyphicon-home"></i> Home </a>
                        </li>  
                        <li class="active">
                            <a href="Ficheiro.php" ><i class="fa fa-fw fa-file"></i> Àreas </a>
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

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                             Area - Registo
                       </h1>

                        <!-- Formulário -->
                        <form class="form-horizontal" action="Area_reg.php?modo=<?php echo $modo; ?>&go=1&id=<?php echo $id; ?>" method="post">
                            <fieldset>

                            <!-- Nome-->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="Nome_Area">Nome</label> 
                              </div> 
                              <div class="col-md-3">

                                  <input id="Nome_Area" name="Nome_Area" type="text" value="<?php echo $Nome_Area; ?>" class="form-control input-md" required="">
                              </div>
                            </div>

                            <!-- Desc-->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="Desc_Area">Descrição</label> 
                              </div> 
                              <div class="col-md-3">

                                  <input id="Desc_Area" name="Desc_Area" type="text" value="<?php echo $Desc_Area; ?>" class="form-control input-md" required="">
                              </div>
                            </div>

                            

                            

                            <p></p>



                            <div class="row">
                                <div style="display: inline-block;">
                                    <button type="button" class="btn btn-danger" onclick="window.location='Area.php';">Cancelar Registo</button>
                                </div>

                                <div style="display: inline-block;">
                                    <button type="submit" class="btn btn-suNivel_Funcess">Gravar Registo</button>
                                </div>
                            </div>

                            </fieldset>
                        </form>

                        <!--Fim Formulário -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
