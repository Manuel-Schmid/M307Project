errors = []

function checkEmpty(value, field) {
    if (value === ""){
        errorInsert(field + " muss ausgefüllt sein.")
    }
}

function checkAt(value) {
    if(value.indexOf("@") < 0) {
        errorInsert("Die E-Mail ist ungültig");
    }
}

function errorInsert(errorMsg) {
    if(errors.indexOf(errorMsg) < 0) {
        errors.push(errorMsg);
        console.log("pushed")
        console.log(errors.length);
    }
}

function checkNumbers(value){
    if(!value.match(/[\+0-9]/g)){
        errorInsert("Diese Telefonnummer ist ungültig");
    }
}

function hasErrors(){
    return errors.length > 0;
}

function hideList() {
    document.getElementById("message").style.visibility='hidden'
    document.getElementById("message").style.paddingTop = '0px';
}

function showList() {
    document.getElementById("message").style.visibility='visible'
    document.getElementById("message").style.paddingTop = '92px';
}


function createErrorList() {
    document.getElementById("errors").innerHTML = "";

    showList();
    let listData = errors,
        listContainer = document.createElement('div'),
        listElement = document.createElement('ul'),
        numberOfListItems = listData.length,
        listItem,
        i;
    document.getElementById("errors").appendChild(listContainer);
    listContainer.appendChild(listElement);

    for (i = 0; i < numberOfListItems; ++i) {
        listItem = document.createElement('li');
        console.log(errors[i])
        listItem.innerHTML = errors[i];
        listElement.appendChild(listItem);
    }
}
