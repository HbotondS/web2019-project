<?php
    include_once 'backtohome.php';
?>

<div>
    <h3>Belepes</h3>
    <form id="myform" method="post">
        <label for="uid">Felhasznalo nev</label>
        <input id="uid" type="text" name="uid" maxlength="100" size="30" required>

        <label for="pwd">Jelszo</label>
        <input id="pwd" type="password" name="pwd" size="30">

        <button type="submit" name="submit">Belepes</button>
        <button type="reset" name="reset">Elfelejtett jelszo</button>
    </form>
</div>