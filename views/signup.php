<?php
    include_once 'backtohome.php';
    include_once '../includes/autoload.php';

    session_start();
?>

<div class="cd">
    <?php if (isset($_GET['error'])): ?>
        <?php if ($_GET['error'] == 'notmatchingpassword'): ?>
            <p>A ket jelszo nem egyezik meg</p>
        <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingUser): ?>
            <p><?= $_SESSION['exception']->getMessage() ?></p>
        <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingEmail): ?>
            <p><?= $_SESSION['exception']->getMessage() ?></p>
        <?php elseif ($_GET['error'] == UserUpdateErrorCode::existingUsername): ?>
            <p><?= $_SESSION['exception']->getMessage() ?></p>
        <?php endif; ?>
    <?php endif; ?>
    <h3 class="formc">Regisztracio</h3>
    <form id="myform" action="../moduls/signup.php" method="post">

        <label for="name">Nev</label>
        <input id="name" type="text" name="name" maxlength="100" size="40"
               required pattern=".{8,100}"
               placeholder="Legalább 8 karakter - betű, szám, szóköz">
        <br>

        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" maxlength="100" size="40" required
               placeholder="a@b.ro">
        <br>

        <label for="uid">Felhasznalo nev</label>
        <input id="uid" type="text" name="uid" maxlength="30" size="30" required placeholder="felhasznalo nev">
        <br>

        <label for="pwd1">Jelszo</label>
        <input id="pwd1" type="password" name="pwd1" minlength="8" maxlength="16" value="" size="30" required>
        <br>

        <label for="pwd2">Jelszo meg egyszer</label>
        <input id="pwd2" type="password" name="pwd2" minlength="8" maxlength="16" value="" size="30">
        <br>

        <button type="submit" name="go">Regisztralas</button>

    </form>
</div>
