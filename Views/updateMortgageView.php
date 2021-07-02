<?php
$noError = true;
?>



<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/update-mortgage-styles.css">
    <script src="../Controllers/updateMortgageScript.js"></script>
    <script src="../Controllers/validation.js"></script>
    <link rel="icon" href="../Media/favicon.ico" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Hypothek bearbeiten</title>
</head>
<body>

<div>
    <h1>Hypothekarbank</h1>
    <nav>
        <a href="createMortgageView.php" class="menu-bar menu-right text-center">Hypothek erfassen</a>
        <a href="existingMortgagesView.php" class="menu-bar menu-left text-center">Hypotheken-Übersicht</a>
    </nav>
</div>

<div id="message">
    <div id="errors"></div>
</div>
<script>hideList()</script>

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
        <th>Neuer Wert</th>
        <th></th>
    </tr>
    <tr>
        <td>Vorname</td>
        <?php $var = $mortgage[0]['firstName'] ?>
        <td id="firstName"><?= $var ?></td>
        <td><input name="<?= $var ?>" id="firstName-input" type="text" class="input-field" placeholder="<?= $var ?>">
        </td>
        <td>
            <button id="firstName-btn" class="menu-btn">Speichern</button>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $('#firstName-btn').click(function () {
                let inputValue = document.getElementById("firstName-input").value;
                checkEmpty(inputValue, "Vorname");
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('firstName').innerText = inputValue;
                }
            });
        });
    </script>
    <tr>
        <td>Nachname</td>
        <?php $var = $mortgage[0]['lastName'] ?>
        <td id="lastName"><?= $var ?></td>
        <td><input name="<?= $var ?>" id="lastName-input" type="text" class="input-field" placeholder="<?= $var ?>">
        </td>
        <td>
            <button id="lastName-btn" class="menu-btn">Speichern</button>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $('#lastName-btn').click(function () {
                let inputValue = document.getElementById("lastName-input").value;
                checkEmpty(inputValue, "Nachname");
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('lastName').innerText = inputValue;
                }
            });
        });
    </script>
    <tr>
        <td>E-Mail</td>
        <?php $var = $mortgage[0]['email'] ?>
        <td id="email"><?= $var ?></td>
        <td><input name="<?= $var ?>" id="email-input" type="text" class="input-field" placeholder="<?= $var ?>"></td>
        <td>
            <button id="email-btn" class="menu-btn">Speichern</button>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $('#email-btn').click(function () {
                let inputValue = document.getElementById("email-input").value;
                checkEmpty(inputValue, "E-Mail-Adresse");
                checkAt(inputValue.toString());
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('email').innerText = inputValue;
                }
            });
        });
    </script>
    <tr>
        <td>Telefonnummer</td>
        <?php $var = $mortgage[0]['phoneNumber'] ?>
        <td id="phoneNumber"><?= $var ?></td>
        <td><input name="<?= $var ?>" id="phoneNumber-input" type="text" class="input-field" placeholder="<?= $var ?>">
        </td>
        <td>
            <button id="phoneNumber-btn" class="menu-btn">Speichern</button>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $('#phoneNumber-btn').click(function () {
                let inputValue = document.getElementById("phoneNumber-input").value;
                checkEmpty(inputValue, "Telefonnummer");
                checkNumbers(inputValue);
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('phoneNumber').innerText = inputValue;
                }
            });
        });
    </script>
    <tr>
        <td>Paket</td>
        <?php $var = getPackageName($mortgage[0]['FK_packageID']) ?>
        <td id="package"><?= $var ?></td>
        <td><select name="packageSelect" id="package-input" class="input-field">
                <option value="none" selected disabled hidden>
                    <?= $var ?>
                </option>
                <?php
                $packages = getAllPackages();
                for ($i = 0; $i < count($packages); $i++) {
                    $packageName = $packages[$i]['packageName'] . " (" . $packages[$i]['percentage'] . "%)";
                    echo "<option value ='$packageName'>" . $packageName . "</option>";
                }
                ?>
            </select>
        <td>
            <button id="package-btn" class="menu-btn">Speichern</button>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $('#package-btn').click(function () {
                let inputValue = document.getElementById("package-input").value;
                document.getElementById('package').innerText = inputValue;
            });
        });
    </script>
    <tr>
        <td>Rückzahlungs-Status</td>
        <?php $var = formatRepaymentStatus($mortgage[0]['repaymentStatus']) ?>
        <td id="repaymentStatus"><?= $var ?></td>
        <td><select name="repayStatusSelect" id="repaymentStatus-input" class="input-field">
                <option value="none" selected disabled hidden>
                    <?= $var ?>
                </option>
                <option value="Nicht zurückgezahlt">Nicht zurückgezahlt</option>
                <option value="Zurückgezahlt">Zurückgezahlt</option>
            </select>
        <td>
            <button id="repaymentStatus-btn" class="menu-btn">Speichern</button>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $('#repaymentStatus-btn').click(function () {
                let inputValue = document.getElementById("repaymentStatus-input").value;
                document.getElementById('repaymentStatus').innerText = inputValue;
            });
        });
    </script>
    <tr>
        <td>Startdatum</td>
        <td><?php echo formatDate($mortgage[0]['startDate']) ?></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Risikostufe</td>
        <td><?php echo getRiskLevel($mortgage[0]['FK_riskID']) ?></td>
        <td></td>
        <td></td>
    </tr>
    <tr class="noBorder">
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button id="save" class="menu-btn">Alle speichern</button>
        </td>
    </tr>
    <script>
        $(document).ready(function () {
            $('#save').click(function () {
                fnInput = document.getElementById("firstName-input").value;
                checkEmpty(fnInput, "Vorname");
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('firstName').innerText = fnInput;
                }

                lnInput = document.getElementById('lastName').value;
                checkEmpty(lnInput, "Nachname");
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('lastName').innerText = lnInput;
                }

                emailInput = document.getElementById("email-input").value;
                checkEmpty(emailInput, "E-Mail-Adresse");
                checkAt(inputValue.toString());
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('email').innerText = emailInput;
                }

                pnInput = document.getElementById("phoneNumber-input").value;
                checkEmpty(pnInput, "Telefonnummer");
                checkNumbers(pnInput);
                if(hasErrors()) {
                    createErrorList();
                } else {
                    document.getElementById('phoneNumber').innerText = pnInput;
                }

                packageInput = document.getElementById("package-input").value
                document.getElementById('package').innerText = packageInput;

                rsInput = document.getElementById("repaymentStatus-input").value;
                document.getElementById('repaymentStatus').innerText = rsInput;

            });
        });
    </script>
</body>
</html>
