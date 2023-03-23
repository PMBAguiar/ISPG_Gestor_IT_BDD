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
  $table = "Funcionario";

  $modo = $_GET['modo'];

  $go = $_GET['go'];
  if(is_null($go)){
    $go = 0;
  }

  $id = $_GET['id'];


    //Buscar dados a inserir/editar do formulário
    $Nome_Func=$_POST['Nome_Func'];
    $Password_Func=$_POST['Password_Func'];
    $Nivel_Func=$_POST['Nivel_Func'];
    $Email_Func=$_POST['Email_Func'];
    $Handle_Func=$_POST['Handle_Func'];
    $Nivel_Func=$_POST['Nivel_Func'];
    $Posto_Func=$_POST['Posto_Func'];
    $Area_Func = $_POST['Area_Func'];
    $Ativo_Func=$_POST['Ativo_Func'];

  if($modo==1 && $go!=1){
    $getquery="SELECT * FROM Funcionario WHERE ID_Func=$id";

    $result = mysqli_query($connection,$getquery);
    $val = mysqli_fetch_array($result);

    //Buscar dados a inserir/editar
    $Nome_Func= $val['Nome_Func'];
    $Password_Func= $val['Password_Func'];
    $Nivel_Func= $val['Nivel_Func'];
    $Email_Func= $val['Email_Func'];
    $Handle_Func= $val['Handle_Func'];
    $Nivel_Func= $val['Nivel_Func'];
    $Posto_Func= $val['Posto_Func'];
    $Area_Func= $val['Area_Func'];
    $Ativo_Func= $val['Ativo_Func'];

  }

  if(is_null($Ativo_Func))
    $Ativo_Func = 0;  

  if($go == 1){

  switch($modo){
      //Modo novo registo
      case 0: $query = "INSERT INTO Funcionario (Nome_Func, Password_Func, Nivel_Func, Handle_Func, Email_Func, Ativo_Func, ID_Posto, ID_Area) 
                        VALUES ('$Nome_Func', '$Password_Func', '$Nivel_Func', '$Handle_Func', '$Email_Func', '$Ativo_Func', '$Posto_Func', 
                                '$Area_Func');";
              break;
      //Modo editar registo
      case 1: $query = "UPDATE Funcionario 
                        SET `Nome_Func`='$Nome_Func', `Password_Func`='$Password_Func', `Nivel_Func`='$Nivel_Func', `Handle_Func`='$Handle_Func', `Email_Func`='$Email_Func', `Ativo_Func`='$Area_Func', `ID_Posto`='$Posto_Func'
                        WHERE  `ID_Func`= '$id';";
              
              break;
  }
  mysqli_query($connection,$query);
  header("Location: Funcionario.php");
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
                        <li>
                            <a href="Software.php" ><i class="glyphicon glyphicon-th-list"></i> Software </a>
                        </li> 
                        <li  class="active">
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
                            Funcionarios - Registo
                       </h1>

                        <!-- Formulário -->
                        <form class="form-horizontal" action="Funcionario_reg.php?modo=<?php echo $modo; ?>&go=1&id=<?php echo $id; ?>" method="post">
                            <fieldset>

                            <!-- Nome_Func-->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="Nome_Func">Nome</label> 
                              </div> 
                              <div class="col-md-3">

                                  <input id="Nome_Func" name="Nome_Func" type="text" value="<?php echo $Nome_Func; ?>" class="form-control input-md" required="">
                              </div>
                            </div>

                            <!-- Handle_Funcone-->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="Handle_Funcone" >Handle</label> 
                              </div>  
                              <div class="col-md-2">
                                  <input id="Handle_Func" name="Handle_Func" type="text" value="<?php echo $Handle_Func; ?>" class="form-control input-md" maxlength="9" required="">
                              </div>
                            </div>

                            <!-- Password_Func-->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="Password_Func" >Password</label> 
                              </div> 
                              <div class="col-md-2">
                                  <input id="Password_Func" name="Password_Func" type="text" value="<?php echo $Password_Func; ?>" class="form-control input-md" maxlength="9" required="">
                              </div>
                            </div>

                            <!-- Email_Func -->
                            <div class="form-group">
                              <div class="col-md-1">
                                <label  for="Email_Func" >Email</label> 
                              </div>  
                              <div class="col-md-3">
                                  <input id="Email_Func" name="Email_Func" type="text" value="<?php echo $Email_Func; ?>" class="form-control input-md" required=""> 
                              </div>
                            </div>

                            

                            

                            <!-- Posto -->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="Evento">Posto</label> 
                              </div> 
                              <div class="col-md-2">
                                  <select class="form-control" name="Posto_Func" id="Posto_Func">
                                    <?php
                                    $getquery = "SELECT ID_Posto, Modelo_Posto FROM Posto WHERE ID_Func IS NULL";
                                    $result = mysqli_query($connection,$getquery);
                                    $showrow = mysqli_num_rows ($result);  

                                    for ($i = 1; $i <= $showrow ; $i++) { 
                                      $val = mysqli_fetch_array($result);
                                    ?>
                                      <option <?php if($val['ID_Posto']==$evento){echo "selected";}?> value="<?php echo $val['ID_Posto']; ?>">
                                         <?php echo $val['Modelo_Posto']; ?>

                                      </option>
                                    <?php 
                                    }
                                    ?>
                                  </select>
                                </div>    
                              </div>
                            </div>

                            <!-- Ativo -->
                            <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="Evento">Ativo</label> 
                              </div> 
                              <div class="col-md-2">
                                  <select class="form-control" name="Area_Func" id="Area_Func">

                                      <option  <?php if($val['Ativo_Func']==1){echo "selected";}?> value="1"> Ativo </option>
                                      <option  <?php if($val['Ativo_Func']=!1){echo "selected";}?> value="0"> Não Ativo</option>
                                  </select>
                                </div>    
                              </div>
                            </div>

                            

                            <p></p>

                            <!-- Nivel_Func-->
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-1">
                                  <label  for="Nivel_Func" >Nivel</label> 
                                </div> 
                                <div class="col-md-2">
                                    <input id="Nivel_Func" name="Nivel_Func" type="text" value="<?php echo $Nivel_Func; ?>" class="form-control input-md" maxlength="8" required="">
                                </div>
                              </div>
                            </div>

                            <p></p>

                            <!-- Area -->
                            <div class="row">
                              <div class="form-group" >
                              <div class="col-md-1">
                                <label  for="ID_Area">Area</label> 
                              </div> 
                              <div class="col-md-2">
                                  <select class="form-control" name="Area_Func" id="Area_Func">
                                    <?php
                                    $getquery = "SELECT ID_Area,Nome_Area FROM Area";
                                    $result = mysqli_query($connection,$getquery);
                                    $showrow = mysqli_num_rows ($result);  

                                    for ($i = 1; $i <= $showrow ; $i++) { 
                                      $val = mysqli_fetch_array($result);
                                    ?>
                                      <option <?php if($val['ID_Area']==$evento){echo "selected";}?> value="<?php echo $val['ID_Area']; ?>">
                                         <?php echo $val['Nome_Area']; ?>

                                      </option>
                                    <?php 
                                    }
                                    ?>
                                  </select>
                                </div>    
                              </div>
                            </div>

                            <p></p>

                            

                            

                          

                            <div class="row">
                                <div style="display: inline-block;">
                                    <button type="button" class="btn btn-danger" onclick="window.location='Funcionario.php';">Cancelar Registo</button>
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
