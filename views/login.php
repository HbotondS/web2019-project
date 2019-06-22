<?php
    include_once 'backtohome.php';
?>

<div class="my-container">
    <?php if (isset($_GET['error']) && $_GET['error'] == 'loginfailed'): ?>
        <p class="error">Hibas felhasznalonev vagy jelszo</p>
    <?php endif; ?>
    <h3>Belepes</h3>
    <form id="myform" action="../moduls/login.php" method="post">
        <div class="row">
            <label for="uid">Felhasznalo nev</label>
            <input id="uid" type="text" name="uid" maxlength="100" size="30" required>
        </div>

        <div class="row">
            <label for="pwd">Jelszo</label>
            <input id="pwd" type="password" name="pwd" size="30" required>
        </div>

        <div class="button-wrapper">
            <button type="submit" name="login-submit">Belepes</button>
            <button type="reset" name="reset">Elfelejtett jelszo</button>
        </div>
    </form>
</div>
