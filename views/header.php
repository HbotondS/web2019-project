<link href="../styles/error.css" rel="stylesheet">

<div>

    <?php if (!isset($_SESSION['uid'])): ?>
        <div style="float: right">
            <a href="login.php"><button>Belépés</button></a>
            <a href="signup.php"><button>Regisztrálás</button></a>
        </div>
    <?php else: ?>
        <div style="float: right">
            <a href="userData.php"><button>Saját adataim</button></a>
            <a href="../moduls/logout.php"><button type="submit">Kilépes</button></a>
        </div>
    <?php   endif; ?>

</div>
<br>
<hr>
