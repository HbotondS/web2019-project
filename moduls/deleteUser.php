<?php
    require_once '../includes/autoload.php';
    session_start();

    if (isset($_POST['delete'])) {
        $user = new User();
        $user->getDataByUsername($_SESSION['uid']);
        $user->delete();
        require_once 'logout.php';
    }
