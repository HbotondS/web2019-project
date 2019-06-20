<?php
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    function dbError($errorMsg) {
        $msg = "DB error: " . $errorMsg;
        alert($msg);
    }
