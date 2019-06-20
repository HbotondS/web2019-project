<?php
    session_start();

    $user = new User();
    $user->getDataByUsername($_SESSION['uid']);