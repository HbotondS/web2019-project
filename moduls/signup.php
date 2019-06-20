<?php
    include_once '../includes/autoload.php';
    include_once '../includes/consoleLog.php';

    if (isset($_POST['go'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['uid'];
        $password1 = $_POST['pwd1'];
        $password2 = $_POST['pwd2'];

        if ($password1 !== $password2) {
            //todo: handle exception
            echo 'a ket jelszo nem egyezik';
            exit();
        }

        $user = new User(0, $name, $email, $username, $password1);
        $user->insert();
        echo 'Regisztracio sikeres';
    }
