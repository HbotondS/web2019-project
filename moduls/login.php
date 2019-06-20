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
                header("Location: ../views/login.php?error=loginfailed");

            }
            if ($user->checkPwd($pwd)) {
                session_start();
                $_SESSION['uid'] = $uid;
                header("Location: ../views/userView.php");

            } else {
                header("Location: ../views/login.php?error=loginfailed");
            }

        }

    }