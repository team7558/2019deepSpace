function fixText(text) {
    var curr = text.replace(/'/g,"");
    curr = curr.replace(/\"/g,"");
    curr = curr.replace(/`/g,"");
    curr = curr.replace(/\n/g,"~~~");
    return curr;
}

function scoreForm() {
	updateFormData();
}

function updateFormData() {
    thisData = document.getElementById("dataqualsnumber");
    thisData.value = document.getElementById("inputqualsnumber").value;
    
    thisData = document.getElementById("dataqualslist");
    thisData.value = fixText(document.getElementById("inputqualslist").value);
}