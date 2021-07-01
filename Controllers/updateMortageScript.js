console.log('script loaded')

let editing = false;

function editField(id, placeholder) {
    console.log(placeholder)
    if (!editing) {
        document.getElementById(id).innerHTML = '<input id="'+id+'"type="text" class="input-field" placeholder="'+placeholder+'">';
        document.getElementById(id).style.paddingLeft = 0 + 'px';
        document.getElementById(id + '-btn').innerText = "Abbrechen";
        editing = true;
    } else {
        document.getElementById(id).innerHTML = '<td id='+id+'>'+placeholder+'</td>';
        document.getElementById(id).style = null;
        document.getElementById(id + '-btn').innerText = "Bearbeiten";
        editing = false;
    }
}
