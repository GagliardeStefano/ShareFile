<html>
    <head>
        <title>Update</title>
        <link rel="stylesheet" href="./CSS/formStyle.css">
    </head>

    <body>
        <?php
            if(isset($_POST['email'],$_POST['checkEmail'],$_POST['passwd'],$_POST['newPasswd'],)){

                $mail = $_POST['email'];
                $checkMail = $_POST['checkEmail'];
                $pass = $_POST['passwd'];
                $checkPass = $_POST['newPasswd'];

                $url = "localhost";
                $user = "root";
                $password = "gagliarde";
                $db = "prova";

                $mysql = new mysqli($url, $user, $password, $db);

                if($mysql -> connect_errno){
                        
                    echo("Errore nella connessione al database: ".$mysql->connect_error);
                    exit();
                }

                $select = ("SELECT mail FROM utenti");
                $ris = $mysql -> query($select);
                $risultato = "";

                foreach($ris as $arrayUtenti){
                    $risultato = $risultato.$arrayUtenti['mail'];
                }

                if($mail == $arrayUtenti['mail']){

                    if($pass == null && $checkPass == null){
                        $flagPassNull = 1;

                    }else{

                        if($mail == null && $checkMail == null){
                            $flagMailNull = 1;
                        }else{
                            if($mail == $checkMail && $pass == $checkPass){
                        
                                $update = ("UPDATE utenti SET passwd='$pass' WHERE mail='$mail'");
                                $res = $mysql -> query($update);
                                
                                header("location: login.php");
                            
                            }elseif($mail != $checkMail && $pass == $checkPass){
                                $flagEmail = 1;
                                
                            }elseif($mail == $checkMail && $pass != $checkPass){
        
                                $flagPass = 1;
                            }elseif($mail != $checkMail && $pass != $checkPass){
        
                                $flagAll = 1;
                            }else{
                                $flagControllo = 1;
                            }
                        } 
                    }
                }else{
                    $flagControllo = 1;
                }
            }
        ?>
            
        <form class="box" action="" method="post">
            <h1>Cambia Password</h1>

            <input type="mail" name="email" placeholder="Email">
            <input type="mail" name="checkEmail" placeholder="Conferma Email">
            <input type="password" name="passwd" placeholder="Nuova Password">
            <input type="password" name="newPasswd" placeholder="Conferma Password">
                
            <input type="submit" name="" value="Cambia">

            <a style="color: white;" href="login.php">Ritorna al Login</a>
                
            <div style="color: white;">
                <?php 
                    if(isset($flagEmail))
                        echo("Le email non combaciano <br>");

                    if(isset($flagPass))
                        echo("Le password non combaciano <br>");

                    if(isset($flagAll))
                        echo("Email e Password non combaciano <br>");

                    if(isset($flagControllo))
                        echo("L'email inserita non e' registrata <br>");

                    if(isset($flagPassNull))
                        echo("Inserisci una password <br>");

                    if(isset($flagMailNull))
                        echo("Inserisci un email <br>");
                ?>
            </div>
        </form>

    </body>
</html>