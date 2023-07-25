<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript" src="js/default.js"></script>
<script type="text/javascript" src="js/jquery-1.7.2.js"></script>


<script type="text/javascript">

$(document).ready(function () {
    var counter = 0;

    $("#addrow").on("click", function () {

        counter = $('#myTable tr').length - 2;

        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><input type="text" name="name' + counter + '" title="'+ counter +'" /></td>';
        cols += '<td><input type="text" name="price' + counter + '"/></td>';

        cols += '<td><input type="button" class="ibtnDel"  value="Delete"></td>';
        newRow.append(cols);
      // if (counter == 4) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
        $("table.order-list").append(newRow);
        counter++;
    });

    $("table.order-list").on("change", 'input[name^="price"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();                
    });


    $("table.order-list").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
        calculateGrandTotal();
        
        counter -= 1
        $('#addrow').attr('disabled', false).prop('value', "Add Row");
    });


});



function calculateRow(row) {
    var price = +row.find('input[name^="price"]').val();

}

function calculateGrandTotal() {
    var grandTotal = 0;
    $("table.order-list").find('input[name^="price"]').each(function () {
        grandTotal += +$(this).val();
    });
    $("#grandtotal").text(grandTotal.toFixed(2));
}

</script>


</head>


<body>

<table id="myTable" class="order-list" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #cccccc;">
    <thead>
        <tr>
            <td>Name</td>
            <td>Price</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <input type="text" name="name" />
            </td>
            <td>
                <input type="text" name="price1" />
            </td>
            <td><a class="deleteRow"></a>

            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="text-align: left;">
                <input type="button" id="addrow" value="Add Row" />
            </td>
        </tr>
        <tr>
            <td colspan="">Grand Total: $<span id="grandtotal"></span>

            </td>
        </tr>
    </tfoot>
</table>

</body>
</html>