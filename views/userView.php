<?php
    include_once '../includes/autoload.php';
    include_once '../moduls/userModel.php';
    require 'header.php';

    if (isset($_SESSION['uid'])): ?>
    <h3>Udv ujra <?=$user->getName()?></h3>
<?php endif; ?>