<div>

    <?php if (!isset($_SESSION['uid'])): ?>
        <div style="float: right">
            <a href="login.php"><button>Belepes</button></a>
            <a href="signup.php"><button>Regisztralas</button></a>
        </div>
    <?php else: ?>
        <div style="float: right">
            <a href="userData.php"><button>Sajat adataim</button></a>
            <a href="../moduls/logout.php"><button type="submit">Kilepes</button></a>
        </div>
    <?php   endif; ?>

</div>
<br>
<hr>
