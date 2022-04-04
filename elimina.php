<?php

    session_start();

    $id = $_SESSION['idS'];
        
    $url = "localhost";
    $user = "root";
    $password = "gagliarde";
    $db = "prova";

    $mysql = new mysqli($url, $user, $password, $db);

    if($mysql -> connect_errno){

        echo("Errore nella connessione al database: ".$mysql->connect_error);
        exit();
    }

    $query = ("DELETE FROM contenuti WHERE ID=$id");

    $res = $mysql -> query($query);

    header("location: home.php");


?>