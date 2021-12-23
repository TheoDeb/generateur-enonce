<?php 
    $content = (isset($_POST['content'])) ? $_POST['content'] : "";
    if (!empty($_POST)) {
        var_dump($_POST['content']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trix</title>
    <link rel="stylesheet" href="style/trix.css">
    <script src="js/trix.js"></script>
</head>
<body>
    <form action="index.php" method="POST">
        <input id="x" value="<?= $content?>" type="hidden" name="content">
        <trix-editor input="x" class="trix-content"></trix-editor>
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>