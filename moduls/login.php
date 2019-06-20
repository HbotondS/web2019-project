<?php
    include_once '../includes/autoload.php';
    include_once '../includes/consoleLog.php';

    $user = new User();

    if (isset($_POST['login-submit'])) {
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd'];
        if (isset($uid) && isset($pwd)) {
            try {
                $user->getDataByUsername($uid);
            } catch (Exception $e) {
                //todo: handle exception
                echo 'nincs ilyen adat';

            }
            if ($user->checkPwd($pwd)) {
                //todo: login screen
                echo 'sikeres bejelentkezes';
                session_start();
                $_SESSION['uid'] = $uid;
                header("Location: ../views/start_view.php");

            } else {
                //todo: handle exception
                echo 'hibas password';
            }

        }

    }