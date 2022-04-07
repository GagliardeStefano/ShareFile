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

            $mysqli = new mysqli($url, $user, $password, $db);

            if($mysqli -> connect_errno){

                echo("Errore nella connessione al database: ".$mysql->connect_error);
                exit();
            }

            $nome = $_POST['nome'];
            $mail = $_POST['email'];
            $passwd = $_POST['passwd'];

            if(isset($nome, $mail, $passwd)){

                $query = ("SELECT mail FROM utenti WHERE mail = '$mail' ");
                $res = $mysqli->query($query);
                $risposta = "";

                foreach($res as $arry){
                    $risposta = $risposta.$arry['mail'];
                }
                
                if($mail != $arry['mail']){

                    $passCript = md5($passwd);
                    $insert = ("INSERT INTO utenti VALUES('$nome', '$mail', '$passCript')");
                    $esegui = $mysqli -> query($insert);
    
                    $_SESSION ['nomeS'] = $nome;
                    $_SESSION ['emailS'] = $mail;
                    $_SESSION ['passwS'] = $passwd;
    
                    header('location: login.php');
                }else{
                    $flagUtente = 1;
                } 
            }else{
                $flagDati = 1;
            }

            
                    
        }


?>
        
                
        <form class="box" action="" method="post">
            <h1>Registrazione</h1>

            <input type="text" name="nome" placeholder="Nickname">
            <input type="mail" name="email" placeholder="E-mail">
            <input type="password" name="passwd" placeholder="Password">
            
            <input type="submit" name="submit" value="Registrazione">
            
            <a class="link" href="login.php">Hai gia' un account? </a> <br><br>

            <div style="color: white;">
                <?php 

                    if(isset($flagDati))
                    echo("Inserisci tutti i dati");
                
                    if(isset($flagUtente))
                    echo("Utente già registrato");
                ?>
            </div>
        </form>


        


    </body>

</html>