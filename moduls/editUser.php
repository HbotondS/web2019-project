<?php
    require_once '../includes/autoload.php';
    require_once 'userModel.php';

    if (isset($_POST['cancel'])) {
        header("Location: ../views/userData.php");
        exit();
    } elseif (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];


        $user->setName($name);
        $user->setEmail($email);
        try{
            $user->updateName();
            $user->updateEmail();
        } catch (Exception $e) {
            $_SESSION['exception'] = $e;
            header("Location: ../views/editUser.php?error=" . $e->getCode());
            exit();
        }
        header("Location: ../views/userData.php");
        exit();
    }