console.log('script loaded')

let editing = false;

function editField(id, placeholder) {
    if (!editing) {
        document.getElementById(id).innerHTML = '<input name="' + placeholder + '" id="' + id + '"type="text" class="input-field" placeholder="' + placeholder + '">';
        document.getElementById(id).style.paddingLeft = 0 + 'px';
        // document.getElementById(id + '-btn').innerText = "Abbrechen";
        document.getElementById(id + '-btn').outerHTML = '<button id="' + id + "-save" + '" class="small-button" onclick="saveChanges('+id+')"><p>&#x2705</p></button> <button id="' + id + "-cncl" + '" class="small-button" onclick="saveChanges(false)"><p>&#x274E</p></button>'
        editing = true;
    }
    // } else {
    //     document.getElementById(id).innerHTML = '<td id='+id+'>'+placeholder+'</td>';
    //     document.getElementById(id).style = null;
    //     document.getElementById(id + '-btn').innerText = "Bearbeiten";
    //     editing = false;
    // }
}

function saveChanges(id) {
    console.log("id: ")
    console.log(id)
    // let vals = document.getElementById(id).value;
    // console.log(vals)
    // if(saveChanges){
        // console.log(input)
    // }
}

// onclick="editField('firstName', '<?=$var?>')