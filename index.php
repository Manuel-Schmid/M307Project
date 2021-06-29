<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Styles.css">
    <script src="script.js"></script>
    <title>M307 Projekt</title>
</head>
<body>

<?php
require("database.php");
$statement = $pdo->prepare('SELECT * FROM user');
$statement->execute();
$result = $statement->fetchAll();
for ($i = 0; $i < count($result); $i++) {
    echo 'Hello ' . $result[$i]['firstName'] . " " . $result[$i]['lastName'] . "<br>";
}

?>
</body>
</html>
