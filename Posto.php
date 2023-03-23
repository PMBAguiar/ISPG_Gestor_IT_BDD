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

switch($filter){
    case 1: $query = "SELECT Posto.*, Funcionario.Nome_Func, Placa_Rede.Endereco_Placa
                        FROM Posto
                        LEFT JOIN Funcionario ON Posto.ID_Posto=Funcionario.ID_Posto
                        INNER JOIN Placa_Rede ON Posto.ID_Placa=Placa_Rede.ID_Placa
                        WHERE ID_Func IS NULL";
            break;

    case 2: $query = "SELECT Posto.*, Funcionario.Nome_Func, Placa_Rede.Endereco_Placa
                        FROM Posto
                        LEFT JOIN Funcionario ON Posto.ID_Posto=Funcionario.ID_Posto
                        INNER JOIN Placa_Rede ON Posto.ID_Placa=Placa_Rede.ID_Placa
                        WHERE ID_Func IS NOT NULL";
            break;

    default: $query = "SELECT Posto.*, Funcionario.Nome_Func, Placa_Rede.Endereco_Placa
                        FROM Posto
                        LEFT JOIN Funcionario ON Posto.ID_Posto=Funcionario.ID_Posto
                        INNER JOIN Placa_Rede ON Posto.ID_Placa=Placa_Rede.ID_Placa";
             break;

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
                            Postos de Trabalho

                            <div style="display: inline-block;">
                                <form action="Posto.php" method="POST">
                                    <button type="submit" name="stat" id="stat" value=0 class="btn btn-default">Todos</button>
                                </form>
                            </div>

                            <div style="display: inline-block;">
                                <form action="Posto.php" method="POST">
                                    <button type="submit" name="stat" id="stat" value=1 class="btn btn-success">Livres</button>
                                </form>
                            </div>

                            <div style="display: inline-block;">
                                <form action="Posto.php" method="POST">
                                    <button type="submit" name="stat" id="stat" value=2 class="btn btn-danger">Em Uso</button>
                                </form>
                            </div>

                        </h1>

                        <!-- TABELA -->
                         <div class="row-lg-6">

                            <div class="col-lg-12">
                   
                                    <div  id="tabela" class="table-responsive" style="font-size: 14px">

                                        <!-- Cabeçalho tabela -->
                                        <table id="tblExport" class="table table-bordered table-hover table-striped" style>
                                            <thead style="background: #333333; color: white;">
                                                <tr>
                                                    <th>Modelo</th>
                                                    <th>CPU</th>
                                                    <th>RAM </th>
                                                    <th>MotherBoard</th>
                                                    <th>O.S.</th>
                                                    <th>End. Rede</th>
                                                    <th>Funcionário</th>
                                                    <th colspan=2>
                                                        <button onclick="location.href = 'Posto_reg.php?modo=0&go=0';" class="btn-block btn-success" type="submit">
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
                                                        $result = mysqli_query($connection,$query);
                                                        $showrow = mysqli_num_rows ($result);  

                                                        for ($i = 1; $i <= $showrow ; $i++) { 

                                                                $val = mysqli_fetch_array($result);
                                                                
                                                                
                                                                //Determinar cor da linha
                                                                if ($val['ID_Func']==null){
                                                                    //verde para ativo
                                                                    ?> <tr class="success"> <?php
                                                                    
                                                                }else{
                                                                    //Vermelho para ñ/ativo
                                                                    ?><tr class="danger"> <?php
                                                                }
                                                                ?> 
                                                                    <td><?php echo $val['Modelo_Posto'];?></td>
                                                                    <td><?php echo $val['CPU_Posto'];?></td>
                                                                    <td><?php echo $val['RAM_Posto'];?></td>
                                                                    <td><?php echo $val['MB_Posto'];?></td>
                                                                    <td><?php echo $val['OS_Posto'];?></td>
                                                                    <td><?php echo $val['Endereco_Placa'];?></td>
                                                                    <td><?php echo $val['Nome_Func'];?></td>
                                                                    <td style="background: #333333; color: white;">
                                                                        <button onclick="location.href = 'Posto_reg.php?modo=1&go=0&id=<?php echo $val['ID_Posto'];?>';" class="btn-block btn-success" type="submit">
                                                                            <i class="glyphicon glyphicon-edit"></i>
                                                                        </button>
                                                                    </td>

                                                                    <td style="background: #333333; color: white;">
                                                                        <button onclick="location.href = 'Posto_del.php?id=<?php echo $val['ID_Posto'];?>';" class="btn-block btn-success" type="submit">
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
