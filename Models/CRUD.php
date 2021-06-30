<?php
require ("database.php");

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
