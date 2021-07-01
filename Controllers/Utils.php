<?php



function formatRepaymentStatus($status): string {
    if ($status == 'Repaid') return 'Zurückgezahlt';
    else if ($status == 'Not Repaid') return 'Nicht zurückgezahlt';
    else return 'Fehler';
}

function formatDate($date) {
    $dateTime = new DateTime($date);
    return date('d.m.Y', $dateTime->getTimestamp());
}

function SpanOverdue($Startdate, $riskID): bool{
    //require("../Models/CRUD.php");
    //require("../Models/database.php");
    $difference=date_diff($Startdate, getRepayDate($Startdate, $riskID));

    if ($difference>0){
       return false;
    }else{
        return true;
    }
}

function getEmoji($startdate, $riskID):string{
    if (SpanOverdue($startdate, $riskID)===true){
        return "<p>&#x1F4B8</p>";
    }else{
        return "<p>&#x1F6A8</p>";
    }
}

