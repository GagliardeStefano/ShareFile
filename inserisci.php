<html>
    <head>
        <title>Inserisci</title>
        <link rel="stylesheet" href="./CSS/style.css">
    </head>

    <body style="display: flex; justify-content: center; align-items: center; min-height: 100vh; background: #6990F2;">

        
        <div class="wrapper">
            <p>Upload File</p>

            <ion-icon class="icon" name="cloud-upload-outline"></ion-icon>

            <form action="inserisci.php" method="post" enctype="multipart/form-data">
                
                <label for="materia">Scegli la materia associata al file:</label>
                <select name="materia">
                    <option value="TPSIT">TPSIT</option>
                    <option value="Informatica">Informatica</option>
                    <option value="Sistemi e reti">Sistemi e Reti</option>
                    <option value="Gestione Progetto">Gestione Progetto</option>
                </select>
                    
                <br>
                <br>  
    
                <input id="actual-btn" type="file" name="file" hidden>

                <label class="label" for="actual-btn">Scegli File</label>
                <span id="file-chosen">Nessun file scelto</span>
                <br>
                <br>
                <br>
                <input  id="submit" type="submit" name="submit" hidden>
                <label class="label" for="submit">Invia File</label>
                
     
            </form>

        </div>

        <?php

            session_start();

            if(isset($_POST['materia'])){

                $materia = $_POST['materia'];

                $email = $_SESSION['emailS'];
                $_SESSION['materiaS'] = $materia;
        
                $url = "localhost";
                $user = "root";
                $password = "gagliarde";
                $db = "prova";

                $mysql = new mysqli($url, $user, $password, $db);

                if($mysql -> connect_errno){

                    echo("Errore nella connessione al database: ".$mysql->connect_error);
                    exit();
                }

                $uploadDir = __DIR__.'\contenuti';

                foreach ($_FILES as $file) {
                    if (UPLOAD_ERR_OK === $file['error']) {
                            
                        $fileName = basename($file['name']);
                        move_uploaded_file($file['tmp_name'], $uploadDir.DIRECTORY_SEPARATOR.$fileName);

                            
                        $data = date('Y-m-d');
                        $percorso = $uploadDir.DIRECTORY_SEPARATOR.$fileName;
                            
                        $insert = ("INSERT INTO contenuti (materia, email, nome, percorso, dataCaricamento) VALUES('$materia','$email','$fileName','$percorso','$data')");

                        $res = $mysql -> query($insert);

                        header("location: home.php");
                    }
                }
        
            }
                 
        ?>

            
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

        <script src="./JS/script.js"></script>

    </body>
</html>