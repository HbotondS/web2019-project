<link href="../styles/new-signup.css" rel="stylesheet">
<link href="../styles/messages.css" rel="stylesheet">

<a target="_self" href="adminView.php">
    <button>Vissza</button>
</a>

<?php if (isset($_GET['insert'])): ?>
    <p class="success">Hír létrehozása sikeres</p>
<?php endif; ?>
<?php if (isset($_GET['error']) && $_GET['error'] == 'failed-to-insert'): ?>
    <p class="error">Hiba tötrént a beszurás során, probálkozz később</p>
<?php endif; ?>
<div id="news" class="my-container">
    <h3>Új hír létrehozása</h3>
    <form id="myform" action="../moduls/newNews.php" method="post">
        <div class="row">
            <label for="title">Cím:</label>
            <input id="title" type="text" name="title" maxlength="100" size="40" required>
        </div>

        <button type="submit" name="go">Létrehozás</button>

    </form>

    <div class="row">
        <label for="content">Hír:</label>
        <textarea id="content" name="content" required rows="4" cols="50" form="myform"></textarea>
    </div>
</div>
