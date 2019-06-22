<?php
    include_once '../includes/autoload.php';

    session_start();

    if (isset($_POST['go'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['uid'];
        $password1 = $_POST['pwd1'];
        $password2 = $_POST['pwd2'];

        if ($password1 !== $password2) {
            header("Location: ../views/signup.php?error=notmatchingpassword");
            exit();
        }

        try {
            $user = new User(0, $name, $email, $username, $password1);
            $user->insert();
        } catch (Exception $e) {
            $_SESSION['exception'] = $e;
            header("Location: ../views/signup.php?error=" . $e->getCode());
            exit();
        }
        echo 'Regisztracio sikeres';
    }
