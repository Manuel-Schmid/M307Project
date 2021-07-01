<?php
$noError = false;

$errorList = [];

$firstname    = $_POST['firstname']    ?? '';
$lastname     = $_POST['lastname']     ??'';
$email        = $_POST['email']        ?? '';
$phone        = $_POST['phone']        ?? '';
$riskLevel    = $_POST['riskLevel']    ?? '';
$mortgagePackage = $_POST['mortgagePackage']    ??'';

if($_SERVER['REQUEST_METHOD'] === 'POST') {


    $firstname  = trim($firstname);
    $lastname   = trim($lastname);
    $email      = trim($email);
    $phone      = trim($phone);
    $riskLevel  = trim($riskLevel);
    $mortgagePackage = trim($mortgagePackage);


    if($firstname === '') {
        $errorList[] = 'Bitte geben Sie einen Vornamen ein.';
    }

    if($lastname === '') {
        $errorList[] = 'Bitte geben Sie einen Nachname ein.';
    }

    if($email === '') {
        $errorList[] = 'Bitte geben Sie eine Email ein.';
    } elseif(strpos($email, '@') === false) {
        $errorList[] = 'Die Email-Adresse "' . $email . '" ist ungültig.';
    }

    if($phone === '') {
        $errorList[] = 'Bitte geben Sie eine Telefonnummer ein.';
    } elseif( ! preg_match('/^[\+ 0-9]+$/', $phone)) {
        $errorList[] = 'Die Telefonnummer "' . $phone . '" ist ungültig.';
    }
//
//    if($riskLevel === '') {
//        $errorList[] = 'Bitte wählen Sie ein Risikolevel.';
//    }
//
//    if($mortgagePackage === '') {
//        $errorList[] = 'Bitte wählen Sie ein Hypothek-Paket.';
//    }

    if(count($errorList) === 0) {
        $noError = true;
    }

}

?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/create-mortgages-styles.css">
    <title>Hypothek erfassen</title>
</head>
<body>

<?php
require("../Models/CRUD.php");
?>
<h1>Erfassen einer neuen Hypothek</h1>
<?php if($noError): ?>

    <h1 class="form-title">Erfassen erfolgreich!</h1>

<?php else: ?>

<!--    <h1 class="form-title"></h1>-->

    <!-- SCHRITT 2 -->
    <?php if(count($errorList) > 0): ?>
        <ul class="errors">
            <?php foreach($errorList as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

<?php endif; ?>

<br><br>

<form action="" method="post">
    <fieldset>
        <legend>Personenangaben</legend>
        <label for="firstname">Vorname*</label>
        <input type="text" id="firstname" name="firstname"><br>

        <label for="lastname">Nachname*</label>
        <input type="text" id="lastname" name="lastname"><br>

        <label for="email">E-Mail*</label>
        <input type="text" id="email" name="email"><br>

        <label for="phone">Telefon*</label>
        <input type="number" id="phone" name="phone"><br>
    </fieldset>
    <fieldset>
        <legend>Hypothekangaben</legend>

        <label for="riskLevel">Risiko Level*</label>
        <select id="riskLevel" name="riskLevel">
            <?php
            $var = count(getAllRiskLevels());
            for ($i = 0; $i < $var; $i++) {
                $riskLevel = getRiskLevel[$i]['FK_packageID'];
                echo "<option value ='$riskLevel'>" .$riskLevel. "% </option>";
            }
            ?>
        </select><br>

        <label for="mortgagePackage">Hypothek Paket*</label>
        <select id="mortgagePackage" name="mortgagePackage">
            <?php
            $var = count(getAllPackages());
            for ($i = 1; $i < $var; $i++) {
                $packageName = getPackageName[$i]['FK_packageID'];
                echo "<option value ='$packageName'>" .$packageName. "</option>";
            }
            ?>
        </select><br>
    </fieldset>
    <p>* sind Pflichfelder</p>

    <input type="submit" name="form-submit">Hypothek erstellen</input>
</form>
<?php

?>
</body>
</html>