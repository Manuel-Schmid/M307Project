<?php



function formatRepaymentStatus($status): string {
    if ($status === 'Repaid') return 'Zurückgezahlt';
    else if ($status === 'Not Repaid') return 'Nicht zurückgezahlt';
    else return 'Fehler';
}

function formatDate($date) {
    $dateTime = new DateTime($date);
    return date('d.m.Y', $dateTime->getTimestamp());
}

function SpanOverdue($startdate, $riskID): bool{
    $repayDate = new DateTime(date('Y-m-d',strtotime(getRepayDate($startdate, $riskID))));
    $now = new DateTime();
    if($repayDate->getTimestamp() < $now->getTimestamp()) return true; // date is in the past
    else return false;
}

function getEmoji($startDate, $riskID, $repaymentStatus):string{
    if($repaymentStatus === 'Repaid') {
        return '<p>&#x2705</p>';
    } else {
        if (SpanOverdue($startDate, $riskID)){
            return '<p>&#x1F6A8</p>';
        }else{
            return '<p>&#x1F4B8</p>';
        }
    }

//
}

