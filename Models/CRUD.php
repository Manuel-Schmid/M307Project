<?php
require ("database.php");

// GET

function getAllPackages(): array
{
    global $pdo;
    $statement = $pdo->prepare('SELECT * FROM packages');
    $statement->execute();
    return $statement->fetchAll();
}

function getAllMortgages(): array
{
    global $pdo;
    $statement = $pdo->prepare('SELECT * FROM mortgages ORDER BY startDate ASC');
    $statement->execute();
    return $statement->fetchAll();
}

function getMortgage($mortgageID): array
{
    global $pdo;
    $statement = $pdo->prepare('SELECT * FROM mortgages WHERE mortgageID = :mortgageID;');
    $statement->bindValue(':mortgageID', $mortgageID);
    $statement->execute();
    return $statement->fetchAll();
}

function getRiskLevel($riskID): string
{
    global $pdo;
    $statement = $pdo->prepare('SELECT riskLevel FROM M307DB.riskRanking WHERE riskID = :riskID;');
    $statement->bindValue(':riskID', $riskID);
    $statement->execute();
    $riskLevels = $statement->fetchAll();
    return $riskLevels[0][0];
}

function getRiskID($riskLevel): int
{
    global $pdo;
    $statement = $pdo->prepare('SELECT riskID FROM M307DB.riskRanking WHERE riskLevel = :riskLevel;');
    $statement->bindValue(':riskLevel', $riskLevel);
    $statement->execute();
    $riskIDs = $statement->fetchAll();
    return $riskIDs[0][0];
}

function getAllRiskLevels(): array
{
    global $pdo;
    $statement = $pdo->prepare('SELECT * FROM riskRanking');
    $statement->execute();
    return $statement->fetchAll();
}

function getPackageName($packageID): string
{
    global $pdo;
    $statement = $pdo->prepare('SELECT packageName FROM M307DB.packages WHERE packageID = :packageID;');
    $statement->bindValue(':packageID', $packageID);
    $statement->execute();
    $packageName = $statement->fetchAll();
    return $packageName[0][0];
}

function getRepayDate($startDate, $riskID) : string{
    global $pdo;
    $statement = $pdo->prepare('SELECT changeRentalDays FROM M307DB.riskRanking WHERE riskID = :riskID;');
    $statement->bindValue(':riskID', $riskID);
    $statement->execute();
    $riskLevel = $statement->fetchAll();
    $days = 480 + $riskLevel[0][0];
    return date('d.m.Y', date('d.m.Y', strtotime($startDate)) . ' + '.$days.' days');
}

// CREATE

function insertMortgage($firstName, $lastName, $email, $phoneNumber, $riskID, $packageID)
{
    global $pdo;
    $query = "INSERT INTO M307DB.mortgages(firstName,lastName,email,
                                 phoneNumber,startDate,repaymentStatus,
                                 FK_riskID,FK_packageID) 
                                 VALUES
                                (:firstName,:lastName, :email,
                                :phoneNumber,:startDate,
                                :repaymentStatus,:riskID,:packageID);";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':startDate', date('Y-m-d'));
    $statement->bindValue(':repaymentStatus', 'Not Repaid');
    $statement->bindValue(':riskID', $riskID);
    $statement->bindValue(':packageID', $packageID);
    $statement->execute();
    $statement->closeCursor();
}

// UPDATE

function updateMortgageItem($attribute, $mortgageID, $value)
{
    global $pdo;
    switch ($attribute) {
        case "firstName":
            $query = "UPDATE `M307DB`.`mortgages` SET
                        `firstName` = :firstName
                        WHERE `mortgageID` = :mortgageID;";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':firstName', $value);
            break;
        case "lastName":
            $query = "UPDATE `M307DB`.`mortgages` SET
                        `lastName` = :lastName
                        WHERE `mortgageID` = :mortgageID;";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':lastName', $value);
            break;
        case "email":
            $query = "UPDATE `M307DB`.`mortgages` SET
                        `email` = :email
                        WHERE `mortgageID` = :mortgageID;";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':email', $value);
            break;
        case "phoneNumber":
            $query = "UPDATE `M307DB`.`mortgages` SET
                        `phoneNumber` = :phoneNumber
                        WHERE `mortgageID` = :mortgageID;";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':phoneNumber', $value);
            break;
        case "package":
            $query = "UPDATE `M307DB`.`mortgages` SET
                        `FK_packageID` = :FK_packageID
                        WHERE `mortgageID` = :mortgageID;";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':FK_packageID', $value);
            break;
        case "repaymentStatus":
            $query = "UPDATE `M307DB`.`mortgages` SET
                        `repaymentStatus` = :repaymentStatus
                        WHERE `mortgageID` = :mortgageID;";
            $statement = $pdo->prepare($query);
            $statement->bindValue(':repaymentStatus', $value);
            break;
    }
    $statement->bindValue(':mortgageID', $mortgageID);
    $statement->execute();
    $statement->closeCursor();
}
