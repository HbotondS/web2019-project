<?php
    $dbServerName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "felveteli";
    $charset = 'utf8mb4';
    try {
        $dsn = 'mysql:host=' . $dbServerName . ';dbname=' . $dbName . ';charset=' . $charset;
        $pdo = new PDO($dsn, $dbUsername, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Connect failed: ' . $e->getMessage();
    }
    $sql = "select * from docs where id=?";
    $sql = $pdo->prepare($sql);
    $sql->bindParam(1, $_GET['id']);
    $no = $sql->execute();
    $row = $sql->fetch();
    $no = $sql->execute();
    header('Content-Type:'.$row['mime']);
    echo $row['doc'];