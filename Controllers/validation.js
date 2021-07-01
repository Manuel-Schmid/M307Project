errors = []

function checkEmpty(value, field) {
    if (value === ""){
        errors.push(field + " muss aufgefüllt sein.")
    }
}

function checkAt(value) {
    if(value.contains("#")===false){
        errors.push("Die E-Mail ist ungültig");
    }
}

function checkNumbers(value){
    if(!value.match(/[\+0-9]/g)){
    errors.push("Diese Telefonnummer ist ungültig");
    }
}

function getErrors(){
    return errors;
}

function checkErrors(){
    if(errors.length===0){
        return true;
    }
    return false;
}

function createList(){

    var listView=document.createElement('ol');

    for(var i=0;i<errors.length;i++)
    {
        var listViewItem=document.createElement('li');
        listViewItem.appendChild(document.createTextNode(errors[i]));
        listView.appendChild(listViewItem);
    }

    return listView;
}