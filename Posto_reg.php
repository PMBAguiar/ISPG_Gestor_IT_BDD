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
    $Modelo_Posto=$_POST['Modelo_Posto'];
    $CPU_Posto=$_POST['CPU_Posto'];
    $RAM_Posto=$_POST['RAM_Posto'];
    $MB_Posto=$_POST['MB_Posto'];
    $OS_Posto=$_POST['OS_Posto'];
    $ID_Placa=$_POST['ID_Placa'];
    $ID_Func=$_POST['ID_Func'];

  if($modo==1 && $go!=1){
    $getquery="SELECT Posto.*, Funcionario.Nome_Func FROM Posto
				LEFT JOIN Funcionario ON Posto.ID_Func =Funcionario.ID_Func 
				WHERE Posto.ID_Posto=$id";

    $result = mysqli_query($connection,$getquery);
    $val = mysqli_fetch_array($result);

    //Buscar dados a inserir/editar
    $Modelo_Posto=$val['Modelo_Posto'];
    $CPU_Posto=$val['CPU_Posto'];
    $RAM_Posto=$val['RAM_Posto'];
    $MB_Posto=$val['MB_Posto'];
    $OS_Posto=$val['OS_Posto'];
    $ID_Placa=$val['ID_Placa'];
    $ID_Func=$val['ID_Func'];
  }

  if(is_null($Ativo_Func))
    $Ativo_Func = 0;  

  if($go == 1){

  switch($modo){
      //Modo novo registo
      case 0: $query = "INSERT INTO Posto (Modelo_Posto, CPU_Posto,RAM_Posto, MB_Posto, OS_Posto, ID_Placa, ID_Func) 
                       VALUES ('$Modelo_Posto', '$CPU_Posto', '$RAM_Posto', '$MB_Posto', '$OS_Posto', $ID_Placa, $ID_Func);";
              break;
      //Modo editar registo
      case 1: $query = "UPDATE Posto
                        SET `Modelo_Posto`='$Modelo_Posto', `CPU_Posto`='$CPU_Posto', `RAM_Posto`='$RAM_Posto',`MB_Posto`='$MB_Posto',`'OS_Posto`='$OS_Posto',`ID_Placa`='$ID_Placa',`ID_Func`='$ID_Func'
                        WHERE  `ID_Posto`= '$id';";
              
              break;
  }
  //echo $query; 

  mysqli_query($connection,$query);
  header("Location: Posto.php");
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
                        <li class="active">
                            <a href="Posto.php" ><i class="glyphicon glyphicon-th-list"></i> Postos </a>
                        </li>
                        <li>
                            <a href="Dispositivo.php" ><i class="glyphicon glyphicon-th-list"></i> Dispositivos </a>
                        </li> 
                        <li >
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
                            Posto Registo
                       </h1>

                        <!-- Formulário -->
                        <form class="form-horizontal" action="Posto_reg.php?modo=<?php echo $modo; ?>&go=1&id=<?php echo $id; ?>" method="post">
                            <fieldset>

                            <!-- Modelo_Posto-->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="Modelo_Posto">Nome</label> 
                              </div> 
                              <div class="col-md-3">

                                  <input id="Modelo_Posto" name="Modelo_Posto" type="text" value="<?php echo $Modelo_Posto; ?>" class="form-control input-md" required="">
                              </div>
                            </div>

                            <!-- CPU -->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="CPU_Posto" >CPU</label> 
                              </div>  
                              <div class="col-md-2">
                                  <input id="CPU_Posto" name="CPU_Posto" type="text" value="<?php echo $CPU_Posto; ?>" class="form-control input-md" maxlength="50" required="">
                              </div>
                            </div>

                            <!-- RAM-->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="RAM_Posto" >Fornecedor</label> 
                              </div> 
                              <div class="col-md-2">
                                  <input id="RAM_Posto" name="RAM_Posto" type="text" value="<?php echo $RAM_Posto; ?>" class="form-control input-md" maxlength="9" required="">
                              </div>
                            </div>

                            <!-- MotherBoard-->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="MB_Posto" >Motherboard</label> 
                              </div> 
                              <div class="col-md-2">
                                  <input id="MB_Posto" name="MB_Posto" type="text" value="<?php echo $MB_Posto; ?>" class="form-control input-md" maxlength="9" required="">
                              </div>
                            </div>

                            <!-- ÓS-->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="OS_Posto" >Sistema Operativo</label> 
                              </div> 
                              <div class="col-md-2">
                                  <input id="OS_Posto" name="OS_Posto" type="text" value="<?php echo $OS_Posto; ?>" class="form-control input-md" maxlength="9" required="">
                              </div>
                            </div>

                            <!-- Placa Rede -->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="ID_Placa">Placa Rede</label> 
                              </div> 
                              <div class="col-md-2">
                                  <select class="form-control" name="ID_Placa" id="ID_Placa">
                                    <?php
                                    $getquery = "SELECT ID_Placa, Endereco_Placa FROM Placa_Rede
													WHERE Placa_Rede.ID_Placa NOT IN (SELECT Posto.ID_Placa FROM Posto WHERE Posto.ID_Placa IS NOT NULL)
													";
                                    $result = mysqli_query($connection,$getquery);
                                    $showrow = mysqli_num_rows ($result);  

                                    for ($i = 1; $i <= $showrow ; $i++) { 
                                      $val = mysqli_fetch_array($result);
                                    ?>
                                      <option <?php if($val['ID_Placa']==$ID_Posto){echo "selected";}?> value="<?php echo $val['ID_Placa']; ?>">
                                         <?php echo $val['Endereco_Placa']; ?>

                                      </option>
                                    <?php 
                                    }
                                    ?>

                                  </select>
                                </div>    
                              </div>
                            </div>

                            <!-- Funcionário -->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="ID_Func">Funcionário</label> 
                              </div> 
                              <div class="col-md-2">
                                  <select class="form-control" name="ID_Func" id="ID_Func">
                                    <?php
                                    $getquery = "SELECT ID_Func, Nome_Func FROM Funcionario";
                                    $result = mysqli_query($connection,$getquery);
                                    $showrow = mysqli_num_rows ($result);  

                                    for ($i = 1; $i <= $showrow ; $i++) { 
                                      $val = mysqli_fetch_array($result);
                                    ?>
                                      <option <?php if($val['ID_Func']==$ID_Posto){echo "selected";}?> value="<?php echo $val['ID_Func']; ?>">
                                         <?php echo $val['Nome_Func']; ?>

                                      </option>
                                    <?php 
                                    }
                                    ?>
                                    <option <?php if(is_null($val['ID_Func'])){echo "selected";}?> value="NULL">
                                         Sem Funcionário
                                    </option>
                                  </select>
                                </div>    
                              </div>
                            </div>

                            <p></p>
                            

                            <div class="row">

                                <div style="display: inline-block;">
                                    <button type="button" class="btn btn-danger" onclick="window.location='Posto.php';">Cancelar Registo</button>
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
