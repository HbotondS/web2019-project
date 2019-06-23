<?php
    require_once '../includes/autoload.php';
    require_once 'userModel.php';

    if (isset($_GET['id'])) {
        if ($user->delDoc($_GET['id']) == 1) {
            header("Location: ../views/userData.php");
            exit();
        } else {
            header("Location: ../views/editUser.php?error=delDoc");
            exit();
        }
    }