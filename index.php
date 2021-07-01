<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Views/css/global.css">
    <link rel="stylesheet" href="Views/css/main.css">
    <title>M307 Projekt</title>
</head>
<body>
<div class="text-center">
    <a class="edit-btn menu-button" href="Views/existingMortgagesView.php">Bestehende Hypotheken</a>
</div>
<table id="packages" class="list">
    <tr>
        <th>Paket</th>
        <th>Prozentsatz</th>
    </tr>
    <?php
    require("Models/database.php");
    $statement = $pdo->prepare('SELECT * FROM packages');
    $statement->execute();
    $result = $statement->fetchAll();
    for ($i = 0; $i < count($result); $i++) {
        echo "<tr>";
            echo "<td>" . $result[$i]['packageName'] . "</td>";
            echo "<td>" . $result[$i]['percentage'] . " % </td>";
        echo"</tr>";
    }
    ?>
</table>

</body>
</html>
