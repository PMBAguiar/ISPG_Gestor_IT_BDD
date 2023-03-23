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

  $modo = $_GET['modo'];

  $go = $_GET['go'];
  if(is_null($go)){
    $go = 0;
  }

  $id = $_GET['id'];


    //Buscar dados a inserir/editar do formulário
    $Nome_LIC=$_POST['Nome_LIC'];
    $Serial_LIC=$_POST['Serial_LIC'];
    $Fornecedor_LIC=$_POST['Fornecedor_LIC'];
    $ID_Posto=$_POST['ID_Posto'];

  if($modo==1 && $go!=1){
    $getquery="SELECT * FROM Licenca_Software WHERE ID_LIC=$id";

    $result = mysqli_query($connection,$getquery);
    $val = mysqli_fetch_array($result);

    //Buscar dados a inserir/editar
    $Nome_LIC= $val['Nome_LIC'];
    $Serial_LIC= $val['Serial_LIC'];
    $Fornecedor_LIC= $val['Fornecedor_LIC'];
    $ID_Posto= $val['ID_Posto'];
  }

  if(is_null($Ativo_Func))
    $Ativo_Func = 0;  

  if($go == 1){

  switch($modo){
      //Modo novo registo
      case 0: $query = "INSERT INTO Licenca_Software (Nome_LIC, Serial_LIC, Fornecedor_LIC, ID_Posto) 
                        VALUES ('$Nome_LIC', '$Serial_LIC', '$Fornecedor_LIC', '$ID_Posto');";
              break;
      //Modo editar registo
      case 1: $query = "UPDATE Licenca_Software
                        SET `Nome_LIC`='$Nome_LIC', `Serial_LIC`='$Serial_LIC', `Fornecedor_LIC`='$Fornecedor_LIC',`ID_Posto`=$ID_Posto
                        WHERE  `ID_LIC`= '$id';";
              
              break;
  }
  mysqli_query($connection,$query);
  header("Location: Software.php");
  exit;
}
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

             <div class="collapse navbar-collapse navbar-ex1-collapse" style="font-size: 16px">
                    <ul class="nav navbar-nav side-nav">
                        <li >
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
                        <li class="active">
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
                            Licença Software Registo
                       </h1>

                        <!-- Formulário -->
                        <form class="form-horizontal" action="Software_reg.php?modo=<?php echo $modo; ?>&go=1&id=<?php echo $id; ?>" method="post">
                            <fieldset>

                            <!-- Nome_Func-->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="Nome_LIC">Nome</label> 
                              </div> 
                              <div class="col-md-3">

                                  <input id="Nome_LIC" name="Nome_LIC" type="text" value="<?php echo $Nome_LIC; ?>" class="form-control input-md" required="">
                              </div>
                            </div>

                            <!-- Serial-->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="Serial" >Serial</label> 
                              </div>  
                              <div class="col-md-2">
                                  <input id="Serial_LIC" name="Serial_LIC" type="text" value="<?php echo $Serial_LIC; ?>" class="form-control input-md" maxlength="29" required="">
                              </div>
                            </div>

                            <!-- Fornecedor-->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="Fornecedor_LIC" >Fornecedor</label> 
                              </div> 
                              <div class="col-md-2">
                                  <input id="Fornecedor_LIC" name="Fornecedor_LIC" type="text" value="<?php echo $Fornecedor_LIC; ?>" class="form-control input-md" maxlength="15" required="">
                              </div>
                            </div>

                            <!-- Posto -->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="ID_Posto">Posto</label> 
                              </div> 
                              <div class="col-md-2">
                                  <select class="form-control" name="ID_Posto" id="ID_Posto">
                                    <?php
                                    $getquery = "SELECT ID_Posto, Modelo_Posto FROM Posto";
                                    $result = mysqli_query($connection,$getquery);
                                    $showrow = mysqli_num_rows ($result);  

                                    for ($i = 1; $i <= $showrow ; $i++) { 
                                      $val = mysqli_fetch_array($result);
                                    ?>
                                      <option <?php if($val['ID_Posto']==$ID_Posto){echo "selected";}?> value="<?php echo $val['ID_Posto']; ?>">
                                         <?php echo $val['Modelo_Posto']; ?>

                                      </option>
                                    <?php 
                                    }
                                    ?>
                                    <option <?php if(is_null($val['ID_Posto'])){echo "selected";}?> value="NULL">
                                         Sem posto
                                    </option>
                                  </select>
                                </div>    
                              </div>
                            </div>

                            

                            <div class="row">

                                <div style="display: inline-block;">
                                    <button type="button" class="btn btn-danger" onclick="window.location='Software.php';">Cancelar Registo</button>
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
