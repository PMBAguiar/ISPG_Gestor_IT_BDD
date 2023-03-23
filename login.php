<!DOCTYPE html>

<?php
//conect e validar credenciais
if(isset($_SESSION)){
    header('Location: index.php');
}else {
    if (isset($_POST['Handle'])){

        include('include/bdd_connect.php');

        $query = "SELECT Email_Func,Nome_Func,Nivel_Func,Ativo_Func,ID_Func FROM Funcionario WHERE Handle_Func='".$_POST['Handle']."' AND Password_Func='".$_POST['inputPassword']."';";

        $result = mysqli_query ($connection, $query);
        $row = mysqli_fetch_array ($result);

        $flag = mysqli_num_rows ($result);

        if ( $flag == 1 && $row['Ativo_Func']==1) {

            session_start();
            $_SESSION['Email_Func']= $row['Email_Func'];
            $_SESSION['Nome_Func']= $row['Nome_Func'];
            $_SESSION['Nivel_Func']= $row['Nivel_Func'];
            $_SESSION['ID_Func']= $row['ID_Func'];
            include ('bdd_close.php');
            header('Location: index.php');

        } else {
            $flag=9;
            $_SESSION['Email_Func']= "";
            $_SESSION['Nome_func']= "";
        }
    }
            
}
?>

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

<body background="pics/background_img.png" style="background-size: 100%;">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <!-- Cabeça Painel -->
                    <div class="panel-heading">
                        <h3 class="panel-title" style="text-align: center;">Por favor insira credenciais.<?php echo $query; ?></h3>
                    </div>

                    <!-- Painel Principal -->
                    <div class="panel-body">
                        <form action="login.php" method="post">
                            <fieldset>
                                <!-- Input credenciais -->

                                <!-- Handle -->
                                <div class="form-group">
                                    <input class=form-control id="Handle" name="Handle" class="form-control" placeholder="Handle" type="text" value="<?php if ($flag==9){echo $_POST['Handle'];}?>">
                                </div>

                                <!-- Pass -->
                                <div class="form-group">
                                    <input class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" type="password">
                                </div>

                                <div>
                                    <button class="btn btn-lg btn-success btn-block" type="submit">Login</button>
                                </div>

                                <!-- Caso erro nos inputs -->
                                <div>
                                    <?php 
                                    if ($flag==9){
                                        echo "<div class='alert alert-danger' role='alert'><strong><span class='glyphicon glyphicon-alert' aria-hidden='true'></span> AVISO! </strong>Falha na autenticação. PF verifique as suas credenciais de acesso.</div>";
                                    }
                                    ?>
                                </div>

                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
