<?php
    include_once 'backtohome.php';
?>

<div class="my-container">
    <?php if (isset($_GET['error']) && $_GET['error'] == 'loginfailed'): ?>
        <p class="error">Hibás felhasználónév vagy jelszó</p>
    <?php endif; ?>
    <h3>Belepes</h3>
    <form id="myform" action="../moduls/login.php" method="post">
        <div class="row">
            <label for="uid">Felhasználónév:</label>
            <input id="uid" type="text" name="uid" maxlength="100" size="30" required>
        </div>

        <div class="row">
            <label for="pwd">Jelszó:</label>
            <input id="pwd" type="password" name="pwd" size="30" required>
        </div>

        <div class="button-wrapper">
            <button type="submit" name="login-submit">Belépés</button>
            <button type="reset" name="reset">Elfelejtett jelszó</button>
        </div>
    </form>
</div>
