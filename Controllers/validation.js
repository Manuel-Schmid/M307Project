errors = []

function checkEmpty(value, field) {
    if (value === ""){
        errors.push(field + " muss aufgefüllt sein.")

    }
}

function checkAt(value) {
    if(value.contains("#")===false){
        errors.push("Die E-Mail ist ungültig")
    }
}

function checkNumbers(value){
    if(!value.match(/[\+0-9]/g)){
    errors.push("Diese Telefonnummer ist ungültig");
    }
}