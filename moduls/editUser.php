<?php
    require_once '../includes/autoload.php';
    require_once 'userModel.php';

    if (isset($_POST['cancel'])) {
        header("Location: ../views/userData.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        try{
            if ($name != $user->getName()) {
                $user->setName($name);
                $user->updateName();
            }
            if ($email != $user->getEmail()) {
                $user->setEmail($email);
                $user->updateEmail();
            }
        } catch (Exception $e) {
            $_SESSION['exception'] = $e;
            header("Location: ../views/editUser.php?error=" . $e->getCode());
            exit();
        }
        header("Location: ../views/userData.php");
        exit();
    } elseif (isset($_POST['upload'])) {
        $mime = $_FILES['file']['type'];
        $name = $_FILES['file']['name'];
        $data = file_get_contents($_FILES['file']['tmp_name']);

        if ($user->attachDoc($name, $mime, $data) == 1) {
            header("Location: ../views/userData.php");
            exit();
        } else {
            header("Location: ../views/editUser.php?error=upload");
            exit();
        }
    }