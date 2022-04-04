<html>
    <head>
        <title>Home</title>
        <link rel="stylesheet" href="./CSS/tableStyle.css" >
        <link rel="stylesheet" href="./CSS/style.css" >
        <link rel="stylesheet" href="./CSS/search.css">

    </head>

    <body>

    <?php 

        session_start();
        
        if(isset($_SESSION['emailS'])){
           
            $email = $_SESSION['emailS'];
                
            $url = "localhost";
            $user = "root";
            $password = "gagliarde";
            $db = "prova";

            $mysql = new mysqli($url, $user, $password, $db);

            if($mysql -> connect_errno){
                    
                echo("Errore nella connessione al database: ".$mysql->connect_error);
                exit();
            }

            $query = ("SELECT * FROM contenuti");
            $res = $mysql -> query($query);

        }else{
            header("location: index.php");
        }
            
    ?>
            
            <div class="wrap">
            <div class="search">
                <input type="text" id="myInput" class="searchTerm" onkeyup="myFunction()" placeholder="Cerca una materia...">
                <button type="submit" class="searchButton">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>
            </div>

        
            <a href="inserisci.php"> 
                <button class="button">Inserisci un file</button>
            </a> 

            <div class="paragrafo">
                <p>Questi sono tutti i contenuti!</p>
            </div>

            <div class="dropdown">
            <button class="buttonAccount"><ion-icon class="dropbtn account" onclick="buttonFunction()" name="person-circle-outline"></button>
            <div id="myDropdown" class="dropdown-content">
                <a> <?php echo $email ?>   </a>
                <a href="update.php">Aggiorna Dati</a>
                <a href="logout.php">Logout</a>
            </div>
            </div>

            

            <table id="myTable">
                <tr>
                    <th>Utente</th>
                    <th>Materia</th>
                    <th>File</th>
                    <th>Data Caricamento</th>
                    <th>Elimina</th>
                </tr>
            
                <?php
                foreach($res as $arrayCont){    ?>
                    <tr id="myTR">    
                        <td><?php   echo $arrayCont['email']  ?></td>
                        <td><?php   echo $arrayCont['materia']  ?></td>
                        <td><?php   echo "<a href = download.php?path=contenuti/".$arrayCont['nome'].">".$arrayCont['nome']."</a>"  ?></td>
                        <td><?php   echo $arrayCont['dataCaricamento']     ?></td>

                    <?php   if($email == $arrayCont['email']){ ?>
                                <td>  <a style="color: black;" href="elimina.php?ID=<?php echo $arrayCont['ID']; $_SESSION['idS'] = $arrayCont['ID'] ?>"> <ion-icon style="width: 3rem; height: 2rem;" name="trash-bin-outline"></ion-icon> </a> </td> 
                    <?php   }else{ ?>
                                <td>  <ion-icon style="width: 3rem; height: 2rem;" name="lock-closed-outline"></ion-icon> </td>
                    <?php   } ?>
                        
                    </tr>
                <?php } ?>

                
            </table>     
            
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

            <script src="./JS/script.js"></script>
    </body>
</html>