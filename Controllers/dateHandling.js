function updateEndDate(riskLevel) {
    let riskID = riskLevel + 1;
    let days = 480 + getDays(riskID);
    let d = new Date();
    d.setDate(d.getDate() + days);
    let endDateString = ("0" + d.getDate()).slice(-2) + "." + ("0"+(d.getMonth()+1)).slice(-2) + "." + d.getFullYear();
    document.getElementById("repayDate").innerText = "Rückzahlungs-Datum: " + endDateString;
}

function getDays(riskID) {
    switch(riskID) {
        case 1: return 360;
        case 2: return 180;
        case 3: return 0;
        case 4: return -120;
        case 5: return -240;
    }
}
