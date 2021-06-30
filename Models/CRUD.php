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
    $statement = $pdo->prepare('SELECT * FROM mortgages');
    $statement->execute();
    return $statement->fetchAll();
}

function getRiskLevel($riskID): string
{
    global $pdo;
    $statement = $pdo->prepare('SELECT riskLevel FROM M307DB.riskRanking WHERE riskID = :riskID;');
    $statement->bindValue(':riskID', $riskID);
    $statement->execute();
    $riskLevel = $statement->fetchAll();
    return $riskLevel[0][0];
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
    $start = new DateTime($startDate);
    return date('d.m.Y', strtotime(date('d.m.Y', $start->getTimestamp()) .' + '.$days.' days'));
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

function updateMortgage($mortgageID, $firstName, $lastName, $email, $phoneNumber,$repaymentStatus, $packageID)
{
    global $pdo;
    $query = "UPDATE `M307DB`.`mortgages` SET
                        `firstName` = :firstName,
                        `lastName` = :lastName,
                        `email` = :email,
                        `phoneNumber` = :phoneNumber,
                        `repaymentStatus` = :repaymentStatus,
                        `FK_packageID` = :packageID
                        WHERE `mortgageID` = :mortgageID;";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':mortgageID', $mortgageID);
    $statement->bindValue(':firstName', $firstName);
    $statement->bindValue(':lastName', $lastName);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phoneNumber', $phoneNumber);
    $statement->bindValue(':repaymentStatus', $repaymentStatus);
    $statement->bindValue(':packageID', $packageID);
    $statement->execute();
    $statement->closeCursor();
}
