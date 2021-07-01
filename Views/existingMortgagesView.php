<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/existing-mortgages-styles.css">
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <style> @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');</style>
    <title>Bestehende Hypotheken</title>
</head>
<body>

<div>
    <h1>Hypothekarbank</h1>
    <nav>
        <a href="createMortgageView.php" class="menu-bar text-center">Leihe erfassen</a>
        <a href="existingMortgagesView.php" class="selected-menue-bar text-center">bestehende Leihen</a>
    </nav>
</div>

<table id="mortgages" class="list">
    <tr>
        <th> </th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>E-mail</th>
        <th>Telefonnummer</th>
        <th>Startdatum</th>
        <th>Rückzahlungs-Status</th>
        <th>Verleih-Frist</th>
        <th>Risikostufe</th>
        <th>Paket</th>
        <th> </th>
    </tr>
    <?php
    require("../Models/CRUD.php");
    require("../Controllers/Utils.php");
    $mortgages = getAllMortgages();
    for ($i = 0; $i < count($mortgages); $i++) {
        echo "<tr>";
        echo '<td><input type="checkbox"></td>';
        echo "<td>" . $mortgages[$i]['firstName'] . "</td>";
        echo "<td>" . $mortgages[$i]['lastName'] . "</td>";
        echo "<td>" . $mortgages[$i]['email'] . "</td>";
        echo "<td>" . $mortgages[$i]['phoneNumber'] . "</td>";
        echo "<td>" . formatDate($mortgages[$i]['startDate']) . "</td>";
        echo "<td>" . formatRepaymentStatus($mortgages[$i]['repaymentStatus']) . "</td>";
        echo "<td>" . getEmoji() . "</td>";
        echo "<td>" . getRiskLevel($mortgages[$i]['FK_riskID']) . "</td>";
        echo "<td>" . getPackageName($mortgages[$i]['FK_packageID']) . "</td>";
        echo '<td><a class="edit-btn" href="updateMortgageView.php?mortgageID=' .$mortgages[$i]['mortgageID'].'">Bearbeiten</a></td>';
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>