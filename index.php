<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Views/Styles.css">
    <script src="Controllers/script.js"></script>
    <title>M307 Projekt</title>
</head>
<body>
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
//    require("Models/CRUD.php");
//    $result = getAllPackages();
    for ($i = 0; $i < count($result); $i++) {
        echo "<tr>";
            echo "<td>" . $result[$i]['packageName'] . "</td>";
            echo "<td>" . $result[$i]['percentage'] . " % </td>";
        echo"</tr>";
    }
    ?>
</table>

<table id="mortgages" class="list">
    <tr>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>E-mail</th>
        <th>Telefonnummer</th>
        <th>Startdatum</th>
        <th>Rückzahlungs-Status</th>
        <th>Risikostufe</th>
        <th>Paket</th>
    </tr>
    <?php
    require("Models/CRUD.php");
    $mortgages = getAllMortgages();
    for ($i = 0; $i < count($mortgages); $i++) {
        echo "<tr>";
        echo "<td>" . $mortgages[$i]['firstName'] . "</td>";
        echo "<td>" . $mortgages[$i]['lastName'] . "</td>";
        echo "<td>" . $mortgages[$i]['email'] . "</td>";
        echo "<td>" . $mortgages[$i]['phoneNumber'] . "</td>";
        echo "<td>" . $mortgages[$i]['startDate'] . "</td>";
        echo "<td>" . $mortgages[$i]['repaymentStatus'] . "</td>";
        echo "<td>" . getRiskLevel($mortgages[$i]['FK_riskID']) . "</td>";
        echo "<td>" . getPackageName($mortgages[$i]['FK_packageID']) . "</td>";
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
