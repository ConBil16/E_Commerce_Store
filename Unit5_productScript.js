function buttonPressed(button){
    var x = button.id;
    var dataString = $("form").serialize();
    if(!document.getElementById("checkBox").checked){
        dataString += '&checkBox=off';
    }

    var productName = $("#name").val();
    var imageName = $("#imageName").val();
    var quantity = $("#Quantity").val();
    var price = $("#Price").val();
    var inactive = 'cheese';
    var check = 0;

    switch (x) {
        case 'daSubmit':
            dataString += '&type=add';
            if(productName == ''){
                errorMessage.innerHTML = "Must have product name";
                errorMessage.style.color = "red";
                document.getElementById("name").focus();
                check += 1;
            }
        
            else if(imageName == ''){
                errorMessage.innerHTML = 'Must have an image name';
                errorMessage.style.color = "red";
                document.getElementById("imageName").focus();
                check += 1;
            }
        
            else if(price == '' || price <= 0){
                errorMessage.innerHTML = 'The item must cost more than $0';
                errorMessage.style.color = "red";
                document.getElementById("Price").focus();
                check += 1;
            }
            break;

        case 'Delete':
            dataString += '&type=delete';
            var r = confirm("Do you really want to delete?");
            if (r == true){
                break;
            }
            else{
                return false;
            }
            break;
        

        case 'Update':
            dataString += '&type=update';
            if(productName == ''){
                errorMessage.innerHTML = "Must have product name";
                errorMessage.style.color = "red";
                check += 1;
            }
        
            else if(imageName == ''){
                errorMessage.innerHTML = 'Must have an image name';
                errorMessage.style.color = "red";
                check += 1;
            }
        
            else if(price == '' || price <= 0){
                errorMessage.innerHTML = 'The item must cost more than $0';
                errorMessage.style.color = "red";
                check += 1;
            }
            break;
        default:
            return false;
    }


    if(check == 0){
        $.ajax({
            type: "POST",
            url: "Unit5_ajaxProduct.php",
            data: dataString,
            cache: false,
            success: function(result){
                //alert(result)  not sure why but the alert tag would break the whole javascript file
                document.getElementById("errorMessage").innerHTML = result;
                document.getElementById("myForm").reset();
            }
    });
    }


}

function highlight_row() {
    document.getElementById("errorMessage").innerHTML = '';
    var table = document.getElementById('table');
    var cells = table.getElementsByTagName('td');
    for (var i = 0; i < cells.length; i++) {
        // Take each cell
        var cell = cells[i];
        // do something on onclick event for cell
        cell.onclick = function () {
            // Get the row id where the cell exists
            var rowId = this.parentNode.rowIndex;

            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].style.backgroundColor = "";
                rowsNotSelected[row].classList.remove('selected');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.style.backgroundColor = "yellow";
            rowSelected.className += " selected";

            document.getElementById("product_id").value = rowSelected.cells[0].innerHTML;
            document.getElementById("name").value = rowSelected.cells[1].innerHTML;
            document.getElementById("imageName").value = rowSelected.cells[2].innerHTML;
            document.getElementById("Price").value = rowSelected.cells[3].innerHTML;
            document.getElementById("Quantity").value = rowSelected.cells[4].innerHTML;
            var checkbox =  rowSelected.cells[5].innerHTML;
            if (checkbox == 'Yes'){
                document.getElementById("checkBox").checked = true;
            }
            else{
                document.getElementById("checkBox").checked = false;
            }

        }
    }
}