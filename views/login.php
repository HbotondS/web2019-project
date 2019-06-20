<?php
    include_once 'backtohome.php';
?>

<div>
    <h3>Belepes</h3>
    <form id="myform" action="../moduls/login.php" method="post">
        <label for="uid">Felhasznalo nev</label>
        <input id="uid" type="text" name="uid" maxlength="100" size="30" required>

        <label for="pwd">Jelszo</label>
        <input id="pwd" type="password" name="pwd" size="30" required>

        <button type="submit" name="login-submit">Belepes</button>
        <button type="reset" name="reset">Elfelejtett jelszo</button>
    </form>
</div>
