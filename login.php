<html>

    <head>
        <title>Login</title>
        <link rel="stylesheet" href="./CSS/formStyle.css">
    </head>

    <body>
        
    <?php
            if(isset($_POST['email'], $_POST['passwd'])){

                session_start();

                $url = "localhost";
                $user = "root";
                $password = "gagliarde";
                $db = "prova";
    
                $mysql = new mysqli($url, $user, $password, $db);
    
                if($mysql -> connect_errno){
    
                    echo("Errore nella connessione al database: ".$mysql->connect_error);
                    exit();
                }
    
                $mail = $_POST['email'];
                $passwd = $_POST['passwd'];

                $criptPassLog = md5($passwd);
    
                $query = ("SELECT * FROM utenti WHERE mail = '$mail'");
    
                $res = $mysql -> query($query);
    
                $risultato = "";
    
                if($res -> num_rows > 0){
    
                    foreach($res as $array){
                        
                        $risultato = $risultato.$array['mail'].$array['passwd']; 
                        
                        if($mail == $array['mail'] && $criptPassLog == $array['passwd']){
                    
                            $_SESSION['emailS'] = $mail;   
                            header("location: home.php");
                        
                        }else{                    
                            $flagError = 1;
                        }
                    }
    
                   
                }
            }else{
                //   
            }
        ?>
    
        <form class="box" action="" method="post">
            <h1>Login</h1>

            <input type="mail" name="email" placeholder="E-mail">
            <input type="password" name="passwd" placeholder="Password">
            
            <input type="submit" name="" value="Login">
            
            <a class="link" href="index.php">Non hai un account? </a> <br><br>
            <a  class="link" href="update.php">Password dimenticata</a> <br><br>

            <div style="color: white;">
                <?php if(isset($flagError))
                    echo("Email o Password errati");
                ?>
            </div>
        </form>

    </body>

</html>