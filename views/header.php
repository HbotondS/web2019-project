<?php if (!isset($_SESSION['uid'])): ?>
    <div style="float: right">
        <a href="login.php"><button>Belepes</button></a>
        <a href="signup.php"><button>Regisztralas</button></a>
    </div>
<?php else: ?>
    <form action="../moduls/logout.php">
        <button type="submit">Kilepes</button>
    </form>
    <?php
    require 'loggedin.php';
    ?>
<?php endif; ?>