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

//evitar warnings
error_reporting(E_ERROR | E_PARSE);

//Dados de sessão
session_start();
if(is_null( $_SESSION['Nome_Func'])){
    header("Location: login.php");
    exit;
}

if($_SESSION['Nivel_Func']!=2){
    header("Location: login.php");
    exit;
}

//tabela parametro
$filter = $_POST['stat'];

$query = "SELECT Ficheiro.*, Area.Nome_Area, ac.Timestamp, Funcionario.Nome_Func
            FROM Ficheiro
            INNER JOIN Area ON Ficheiro.ID_Area = Area.ID_Area
            INNER JOIN 
            (SELECT Acesso.ID_Acesso, Acesso.Timestamp, Acesso.ID_Func FROM Acesso, Ficheiro ORDER BY Acesso.Timestamp DESC LIMIT 1) AS ac
            INNER JOIN Funcionario ON Funcionario.ID_Func = ac.ID_Func";
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
                        <li class="active" >
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

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Ficheiros/Área

                        </h1>

                        <!-- TABELA -->
                         <div class="row-lg-6">

                            <div class="col-lg-12">
                   
                                    <div  id="tabela" class="table-responsive" style="font-size: 14px">

                                        <!-- Cabeçalho tabela -->
                                        <table id="tblExport" class="table table-bordered table-hover table-striped" style>
                                            <thead style="background: #333333; color: white;">
                                                <tr>
                                                    <th>Ficheiro</th>
                                                    <th>Area</th>
                                                    <th>Ùltimo Acesso</th>
                                                    <th>Funcionário</th>
                                                    <th colspan=2>
                                                        <button onclick="location.href = 'Ficheiro_reg.php?modo=0&go=0';" class="btn-block btn-success" type="submit">
                                                            <i class="glyphicon glyphicon-file"></i>
                                                            Novo
                                                        </button>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>


                                                <!-- Preencher dados da BD -->
                                                </tr>

                                                    <?php 
                                                        $color_sw = 1;

                                                        $result = mysqli_query($connection,$query);
                                                        $showrow = mysqli_num_rows ($result);  

                                                        for ($i = 1; $i <= $showrow ; $i++) { 

                                                                $val = mysqli_fetch_array($result);
                                                                
                                                                if($temp == $val['Nome_Ficheiro']){
                                                                    if($color_sw == 0){
                                                                        ?><tr class="success"><?php
                                                                    }else{
                                                                        ?><tr class="danger"><?php
                                                                    }
                                                                }else{
                                                                    if($color_sw == 0){
                                                                        ?><tr class="danger"><?php
                                                                        $color_sw = 1;
                                                                        
                                                                    }else{
                                                                        ?><tr class="success"><?php
                                                                        $color_sw = 0;
                                                                    }
                                                                    
                                                                }

                                                                $temp = $val['Nome_Ficheiro'];

                                                                
                                                                
                                                                
                                                                
                                                                ?> 
                                                                    <td><?php echo $val['Nome_Ficheiro'];?></td>
                                                                    <td><?php echo $val['Nome_Area'];?></td>
                                                                    <td><?php echo $val['Timestamp'];?></td>
                                                                    <td><?php echo $val['Nome_Func'];?></td>

                                                                    <td style="background: #333333; color: white;">
                                                                        <button onclick="location.href = 'Ficheiro_del.php?id=<?php echo $val['ID_Ficheiro'];?>';" class="btn-block btn-success" type="submit">
                                                                            <i class="glyphicon glyphicon-trash"></i>
                                                                        </button>
                                                                    </td>   
                                                                
                                                                    </tr>

                                                                <?php
                                                            }//fim linha
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
