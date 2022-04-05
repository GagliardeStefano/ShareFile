<html>

    <head>
        <title>Registrazione</title>
        <link rel="stylesheet" href="./CSS/formStyle.css">
    </head>

    <body>
        
        <?php

            if(isset($_POST['nome'], $_POST['email'], $_POST['passwd'])){

                $url = "localhost";
                $user = "root";
                $password = "gagliarde";
                $db = "prova";

                $mysql = new mysqli($url, $user, $password, $db);

                if($mysql -> connect_errno){

                    echo("Errore nella connessione al database: ".$mysql->connect_error);
                    exit();
                }

                $nome = $_POST['nome'];
                $mail = $_POST['email'];
                $passwd = $_POST['passwd'];

                $query = ("SELECT * FROM utenti");
                $res = $mysql -> query($query);

                $risposta = "";

                
                foreach($res as $array){
                        
                    $risposta = $risposta.$array["mail"];
                }

                if($mail == $array["mail"]){

                    $flagUtente = 1;

                }else{
                    $criptPassReg = md5($passwd);
                    $_SESSION['criptPS'] = $criptPassReg;

                    $queryInsert = ("INSERT INTO utenti VALUES ('$nome','$mail','$criptPassReg')");

                    $resInsert = $mysql -> query($queryInsert);

                    session_start();

                    $_SESSION ['nomeS'] = $nome;
                    $_SESSION ['emailS'] = $mail;
                    $_SESSION ['passwS'] = $passwd;
                
                
                    header("location: home.php");
                }
            }


        ?>
                
        <form class="box" action="" method="post">
            <h1>Registrazione</h1>

            <input type="text" name="nome" placeholder="Nickname">
            <input type="mail" name="email" placeholder="E-mail">
            <input type="password" name="passwd" placeholder="Password">
            
            <input type="submit" name="" value="Registrazione">
            
            <a class="link" href="login.php">Hai gia' un account? </a> <br><br>

            <div style="color: white;">
                <?php if(isset($flagUtente))
                    echo("Utente già registrato");
                ?>
            </div>
        </form>

    </body>

</html>