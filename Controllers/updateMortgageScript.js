console.log('script loaded')

let editing = false;

function editField(id, placeholder, mortgageID) {
    if (!editing) {
        document.getElementById(id).innerHTML = '<input name="' + placeholder + '" id="' + id + '-input' + '"type="text" class="input-field" placeholder="' + placeholder + '">';
        document.getElementById(id).style.paddingLeft = 0 + 'px';
        document.getElementById(id + '-btn').innerText = "Bestätigen";
        editing = true;
    } else {
        let newValue = document.getElementById(id + '-input').value
        saveChanges(id, mortgageID, newValue);
        document.getElementById(id).innerHTML = '<td id='+id+'>'+newValue+'</td>';
        document.getElementById(id).style = null;
        document.getElementById(id + '-btn').innerText = "Bearbeiten";
        editing = false;
    }
}

function saveChanges(id, mortgageID, newValue) {
    console.log(id)
    console.log(mortgageID)
    console.log(newValue)

    let cmd1 = '<?php require("../Models/CRUD.php");?>';
    let cmd= '<?php updateMortgageItem('+id+','+mortgageID+','+newValue+');?>' //call the php add function
    // document.write('<?php require("../Models/CRUD.php");?>')
    // document.write('<?php updateMortgageItem('+id+','+mortgageID+','+newValue+'); ?> ');
}

function test() {

}

 // updateMortgageItem($id, $mortgageID, $value)