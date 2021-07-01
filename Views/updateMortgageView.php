<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/update-mortgage-styles.css">
    <script src="../Controllers/updateMortageScript.js"></script>
    <title>Hypothek bearbeiten</title>
</head>
<body>
<?php
$mortgageID = $_GET['mortgageID'];
require("../Models/CRUD.php");
require("../Controllers/Utils.php");
$mortgage = getMortgage($mortgageID);
?>
<table id="mortgage" class="list">
    <tr>
        <th>Datensatz</th>
        <th>Wert</th>
        <th></th>
    </tr>
    <tr>
        <td>Vorname</td>
        <?php $var = $mortgage[0]['firstName'] ?>
        <td id="firstName"><?=$var?></td>
        <td><button id="firstName-btn" class="edit-btn" onclick="editField('firstName', '<?=$var?>')">Bearbeiten</button></td>
    </tr>
    <tr>
        <td>Nachname</td>
        <?php $var = $mortgage[0]['lastName'] ?>
        <td id="lastName"><?=$var?></td>
        <td><button id="lastName-btn" class="edit-btn" onclick="editField('lastName', '<?=$var?>')">Bearbeiten</button></td>
    </tr>
    <tr>
        <td>E-mail</td>
        <?php $var = $mortgage[0]['email'] ?>
        <td id="email"><?=$var?></td>
        <td><button id="email-btn" class="edit-btn" onclick="editField('email', '<?=$var?>')">Bearbeiten</button></td>
    </tr>
    <tr>
        <td>Telefonnummer</td>
        <?php $var = $mortgage[0]['phoneNumber'] ?>
        <td id="phoneNumber"><?=$var?></td>
        <td><button id="phoneNumber-btn" class="edit-btn" onclick="editField('phoneNumber', '<?=$var?>')">Bearbeiten</button></td>

    </tr>
    <tr>
        <td>Paket</td>
        <?php $var = getPackageName($mortgage[0]['FK_packageID']) ?>
        <td id="package"><?=$var?></td>
        <td><button id="package-btn" class="edit-btn" onclick="editField('package', '<?=$var?>')">Bearbeiten</button></td>
    </tr>
    <tr>
        <td>Rückzahlungs-Status</td>
        <?php $var = formatRepaymentStatus($mortgage[0]['repaymentStatus']) ?>
        <td id="repaymentStatus"><?=$var?></td>
        <td><button id="repaymentStatus-btn" class="edit-btn" onclick="editField('repaymentStatus', '<?=$var?>')">Bearbeiten</button></td>
    </tr>
    <tr>
        <td>Startdatum</td>
        <td><?php echo formatDate($mortgage[0]['startDate']) ?></td>
        <td> </td>
    </tr>
    <tr>
        <td>Risikostufe</td>
        <td><?php echo getRiskLevel($mortgage[0]['FK_riskID']) ?></td>
        <td> </td>
    </tr>

</body>
</html>