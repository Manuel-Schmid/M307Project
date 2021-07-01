<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/existing-mortgages-styles.css">
    <style> @import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');</style>
    <title>Bestehende Hypotheken</title>
</head>
<body>

<table id="mortgages" class="list">
    <tr>
        <th> </th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>E-mail</th>
        <th>Telefonnummer</th>
        <th>Startdatum</th>
        <th>Rückzahlungs-Status</th>
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
        echo "<td>" . getRiskLevel($mortgages[$i]['FK_riskID']) . "</td>";
        echo "<td>" . getPackageName($mortgages[$i]['FK_packageID']) . "</td>";
        echo '<td><a class="edit-btn" href="updateMortgageView.php?mortgageID=' .$mortgages[$i]['mortgageID'].'">Bearbeiten</a></td>';
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>