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