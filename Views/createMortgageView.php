<?php
require("../Models/CRUD.php");
require('../Models/database.php');

$noError = false;

$errorList = [];

$firstName = $_POST['firstname'] ?? '';
$lastName = $_POST['lastname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$riskLevel = $_POST['riskLevel'] ?? '';
$mortgagePackage = $_POST['mortgagePackage'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $firstName = trim($firstName);
    $lastName = trim($lastName);
    $email = trim($email);
    $phone = trim($phone);
    $riskLevel = trim($riskLevel);
    $mortgagePackage = trim($mortgagePackage);


    if ($firstName === '') {
        $errorList[] = 'Bitte geben Sie einen Vornamen ein.';
    }

    if ($lastName === '') {
        $errorList[] = 'Bitte geben Sie einen Nachname ein.';
    }

    if ($email === '') {
        $errorList[] = 'Bitte geben Sie eine Email ein.';
    } elseif (strpos($email, '@') === false) {
        $errorList[] = 'Die Email-Adresse "' . $email . '" ist ungültig.';
    }

    if ($phone === '') {
        $errorList[] = 'Bitte geben Sie eine Telefonnummer ein.';
    } elseif (!preg_match('/^[\+ 0-9]+$/', $phone)) {
        $errorList[] = 'Die Telefonnummer "' . $phone . '" ist ungültig.';
    }

    if ($riskLevel === '') {
        $errorList[] = 'Bitte wählen Sie ein Risikolevel.';
    }

    if ($mortgagePackage === '') {
        $errorList[] = 'Bitte wählen Sie ein Hypothek-Paket.';
    }

    if (count($errorList) === 0) {
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
    <script src="../Controllers/dateHandling.js"></script>
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <title>Hypothek erfassen</title>
</head>
<body>

<div>
    <h1>Hypothekarbank</h1>
    <nav>
        <a href="createMortgageView.php" class="selected-menue-bar text-center">Leihe erfassen</a>
        <a href="existingMortgagesView.php" class="menu-bar text-center">bestehende Leihen</a>
    </nav>
</div>
<div class="wrapper">
    <h2 class = "form-title text-center">Erfassen einer neuen Hypothek</h2>

    <?php if ($noError): ?>
        <p1 class=success>Speichern der Hypothek erfolgreich</p1>
    <?php else: ?>
        <?php if (count($errorList) > 0): ?>
            <ul class="errors">
                <?php foreach ($errorList as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>
    <br>
    <form method="POST">
        <fieldset>
            <legend class="form-legend">Personenangaben</legend>
            <div class="form-group">
                <input type="hidden" name="action" value="insert">
                <label class="form-label" for="firstname">Vorname*</label>
                <input type="text" id="firstname" name="firstname"><br>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="insert">
                <label class="form-label" for="lastname">Nachname*</label>
                <input type="text" id="lastname" name="lastname"><br>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="insert">
                <label class="form-label" for="email">E-Mail*</label>
                <input type="text" id="email" name="email"><br>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="insert">
                <label class="form-label" for="phone">Telefon*</label>
                <input type="text" id="phone" name="phone"><br>
            </div>
        </fieldset>

        <fieldset>
            <legend class="form-legend">Hypothekangaben</legend>
            <div class="form-group">
                <input type="hidden" name="action" value="insert">
                <label class="form-label" for="riskLevel">Risiko Level*</label>
                <select id="riskLevel" name="riskLevel" onchange="updateEndDate(this.selectedIndex);" onfocus="this.selectedIndex = -1;">
                    <?php
                    $levels = getAllRiskLevels();
                    for ($i = 0; $i < count($levels); $i++) {
                        $val = $levels[$i]['riskLevel'];
                        echo "<option value ='$val'>" . $val . "</option>";
                    }
                    ?>
                </select><br>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="insert">
                <label class="form-label" for="mortgagePackage">Hypothek Paket*</label>
                <select id="mortgagePackage" name="mortgagePackage">
                    <?php
                    $packages = getAllPackages();
                    for ($i = 0; $i < count($packages); $i++) {
                        $packageName = $packages[$i]['packageName'] . " (" . $packages[$i]['percentage'] . "%)";
                        echo "<option value ='$packageName'>" . $packageName . "</option>";
                    }
                    ?>
                </select><br><br>
            </div>
        </fieldset>

        <fieldset>
            <legend class="form-legend">Rückzahlung</legend>
            <div class="form-group">
                <span id="repayDate" class="form-label">Rückzahlungs-Datum:
                    <?php
                    global $val;
                    $startDate = date('Y-m-d');
                    $riskID = getRiskID($val);
                    $endDate = getRepayDate($startDate, $riskID);
                    echo $endDate;
                    ?>
                </span>
            </div>
        </fieldset>
       <p>* Pflichfelder</p>

        <div class="form-actions">
            <input class="menu-button" type="submit" value="Erfassen">
        </div>
    </form>

    <?php
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $countrycode = filter_input(INPUT_POST, "countrycode", FILTER_SANITIZE_STRING);
    $district = filter_input(INPUT_POST, "district", FILTER_SANITIZE_STRING);
    $population = filter_input(INPUT_POST, "population", FILTER_SANITIZE_STRING);
    ?>
  
</div>
<script>updateEndDate(0);</script>
</body>
</html>