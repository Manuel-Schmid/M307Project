<?php
//if (isset($_POST['data'])) {
//    $data = $_POST['data'];
//    print( "data is: $data" );
//    return;
//}
//?>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Hypothek bearbeiten</title>
</head>
<body>

<div>
    <h1 class="text-center">Hypothekarbank</h1>
    <nav>
        <a href="createMortgageView.php" class="menu-bar text-center">Leihe erfassen</a>
        <a href="existingMortgagesView.php" class="menu-bar text-center">bestehende Leihen</a>
    </nav>
</div>

<?php
$mortgageID = $_GET['mortgageID'];
require("../Models/CRUD.php");
require("../Controllers/Utils.php");
//updateMortgageItem("firstName", 2, "Manuel");
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
        <td id="firstName"><?=$var?></td>
        <td><input name="<?=$var?>" id="firstName-input" type="text" class="input-field" placeholder="<?=$var?>"></td>
        <td><button id="firstName-btn" class="edit-btn">Speichern</button></td>
    </tr>
    <script>
        $(document).ready(function(){
            $('#firstName-btn').click(function(){
                let inputValue = document.getElementById("firstName-input").value;
                console.log(inputValue)
                document.getElementById('firstName').innerText = inputValue;
                // document.cookie="input=" + inputValue;
                // window.location.href='updateMortgageView.php?input=' + inputValue;
                // $.post('updateMortgageView.php',{'data': "value1"}, function (data) {
                //     $val = $('#response').text(data);
                // });
                <?php
//                $inputValue = "";
//                updateMortgageItem('firstName', $mortgageID, $inputValue);
                ?>
            });
        });
    </script>
    <tr>
        <td>Nachname</td>
        <?php $var = $mortgage[0]['lastName'] ?>
        <td id="lastName"><?=$var?></td>
        <td><input name="<?=$var?>" id="lastName-input" type="text" class="input-field" placeholder="<?=$var?>"></td>
        <td><button id="lastName-btn" class="edit-btn">Speichern</button></td>
    </tr>
    <script>
        $(document).ready(function(){
            $('#lastName-btn').click(function(){
                let inputValue = document.getElementById("lastName-input").value;
                console.log(inputValue)
                document.getElementById('lastName').innerText = inputValue;
            });
        });
    </script>
    <tr>
        <td>E-Mail</td>
        <?php $var = $mortgage[0]['email'] ?>
        <td id="email"><?=$var?></td>
        <td><input name="<?=$var?>" id="email-input" type="text" class="input-field" placeholder="<?=$var?>"></td>
        <td><button id="email-btn" class="edit-btn">Speichern</button></td>
    </tr>
    <script>
        $(document).ready(function(){
            $('#email-btn').click(function(){
                let inputValue = document.getElementById("email-input").value;
                console.log(inputValue)
                document.getElementById('email').innerText = inputValue;
            });
        });
    </script>
    <tr>
        <td>Telefonnummer</td>
        <?php $var = $mortgage[0]['phoneNumber'] ?>
        <td id="phoneNumber"><?=$var?></td>
        <td><input name="<?=$var?>" id="phoneNumber-input" type="text" class="input-field" placeholder="<?=$var?>"></td>
        <td><button id="phoneNumber-btn" class="edit-btn">Speichern</button></td>
    </tr>
    <script>
        $(document).ready(function(){
            $('#phoneNumber-btn').click(function(){
                let inputValue = document.getElementById("phoneNumber-input").value;
                console.log(inputValue)
                document.getElementById('phoneNumber').innerText = inputValue;
            });
        });
    </script>
    <tr>
        <td>Paket</td>
        <?php $var = getPackageName($mortgage[0]['FK_packageID']) ?>
        <td id="package"><?=$var?></td>
        <td><input name="<?=$var?>" id="package-input" type="text" class="input-field" placeholder="<?=$var?>"></td>
        <td><button id="package-btn" class="edit-btn">Speichern</button></td>
    </tr>
    <script>
        $(document).ready(function(){
            $('#package-btn').click(function(){
                let inputValue = document.getElementById("package-input").value;
                console.log(inputValue)
                document.getElementById('package').innerText = inputValue;
            });
        });
    </script>
    <tr>
        <td>Rückzahlungs-Status</td>
        <?php $var = formatRepaymentStatus($mortgage[0]['repaymentStatus']) ?>
        <td id="repaymentStatus"><?=$var?></td>
        <td><input name="<?=$var?>" id="repaymentStatus-input" type="text" class="input-field" placeholder="<?=$var?>"></td>
        <td><button id="repaymentStatus-btn" class="edit-btn">Speichern</button></td>
    </tr>
    <script>
        $(document).ready(function(){
            $('#repaymentStatus-btn').click(function(){
                let inputValue = document.getElementById("repaymentStatus-input").value;
                console.log(inputValue)
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

</body>
</html>