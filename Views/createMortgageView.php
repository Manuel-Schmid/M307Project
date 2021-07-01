<?php
$success = false;

$errors = [];

$name    = $_POST['name']    ?? '';
$email   = $_POST['email']   ?? '';
$phone   = $_POST['phone']   ?? '';
$people  = $_POST['people']  ?? '';
$hotel   = $_POST['hotel']   ?? '';
$program = $_POST['program'] ?? '';
$shuttle = $_POST['shuttle'] ?? '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Schritt 4
    $name    = trim($name);
    $email   = trim($email);
    $phone   = trim($phone);


    if($name === '') {
        $errors[] = 'Bitte geben Sie einen Namen ein.';
    }

    if($email === '') {
        $errors[] = 'Bitte geben Sie eine Email ein.';
    } elseif(strpos($email, '@') === false) {
        $errors[] = 'Die Email-Adresse "' . $email . '" ist ungültig.';
    }

    if($phone === '') {
        $errors[] = 'Bitte geben Sie eine Telefonnummer ein.';
    } elseif( ! preg_match('/^[\+ 0-9]+$/', $phone)) {
        $errors[] = 'Die Telefonnummer "' . $phone . '" ist ungültig.';
    }

    if($people === '') {
        $errors[] = 'Bitte geben Sie die Anzahl teilnehmender Personen ein.';
    } elseif( ! is_numeric($people)) {
        $errors[] = 'Bitte geben Sie für die Anzahl Personen nur Zahlen ein.';
    }

    if($hotel === '') {
        $errors[] = 'Bitte wählen Sie ein Hotel für die Übernachtung aus.';
    }

    // Keine Fehler vorhanden
    if(count($errors) === 0) {
        $success = true;
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
<?php //if($success): ?>
<!---->
<!--    <h1 class="form-title">Anmeldung erfolgreich!</h1>-->
<!---->
<!--    <p>Vielen Dank für Ihre Anmeldung. Wir haben diese erfolgreich entgegengenommen.</p>-->
<!---->
<?php //else: ?>
<!---->
<!--<h1 class="form-title">Anmeldung für Kundenevent</h1>-->
<!---->
<!--<p>Füllen Sie das folgende Formular aus um sich für unseren Kundenevent  --><?//= date("Y"); ?><!-- anzumelden.</p>-->

<?php
require("../Models/CRUD.php");
?>
<h1>Erfassen einer neuen Hypothek</h1>
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