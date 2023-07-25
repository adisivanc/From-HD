<?
function main(){
?>

<script type="text/javascript">

$(function() {
	$(".datepicker").datepicker({
		changeMonth: true
	});  
});

</script>


<div id="parkinglot_outer">
<div class="mid">

	<div id="parkinglot_header">
        <div id="parkinglot_left"><a href="#" class="link1">< Go back to Dashboard</a></div>
        <div id="parkinglot_right">Your saved parking lots</div>
    </div>

	<div id="parkinglot_detail">
    
        <table border="0" cellspacing="0" cellpadding="0" class="parkinglotstbl">
          <tr>
            <th>PARKING LOT NAME</th>
            <th>CITY</th>
            <th>AIRPORT</th>
            <th>TIME ZONE</th>
            <th>ACTION</th>
          </tr>
          <tr>
            <td>1. Wally Park</td>
            <td align="center">Los Angeles</td>
            <td align="center">LAX</td>
            <td align="center">Pacific</td>
            <td>
            	<div class="lotstblbtn">VIEW</div>
            	<div class="lotstblbtn" onClick="show_pricingpopup()">PRICING</div>
                <div class="lotstblbtn" onClick="show_discountpopup()">DISCOUNTS</div>
            </td>
          </tr>
          <tr>
            <td>2. Walmart</td>
            <td align="center">New York</td>
            <td align="center">JFK</td>
            <td align="center">Eeastern Time</td>
            <td>
            	<div class="lotstblbtn">VIEW</div>
            	<div class="lotstblbtn" onClick="show_pricingpopup()">PRICING</div>
                <div class="lotstblbtn" onClick="show_discountpopup()">DISCOUNTS</div>
            </td>
          </tr>
          <tr>
            <td>1. Wally Park</td>
            <td align="center">Los Angeles</td>
            <td align="center">LAX</td>
            <td align="center">Pacific</td>
            <td>
            	<div class="lotstblbtn">VIEW</div>
            	<div class="lotstblbtn" onClick="show_pricingpopup()">PRICING</div>
                <div class="lotstblbtn" onClick="show_discountpopup()">DISCOUNTS</div>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
                
        <div id="addparkinglotbtn"><img src="images/addparkinglot_btn.jpg" border="0" style="cursor:pointer" onClick="show_addparkinglot()" /></div>
    
    </div>


</div>
</div>



<div id="addparkinglot_popup" style="display:none; padding:2px 1px;"> 
    <table border="0" cellspacing="0" cellpadding="0" class="addparkinglotpopup">
      <tr>
        <td class="addparkinglotpopuphd">Add Parking Lot<div id="addparkinglot_closebtn" class="popup_closebtn" title="Close">X</div></td>
      </tr>
      <tr>
        <td>
        	<div class="parkinglottblouter">
                <div class="parkinglottblrow">
                    <div class="parkinglottblhd">1. PARKING LOT INFORMATION</div>
                </div>
                <div class="parkinglottblbtm">
                    <div class="parkinglottblrow">
                        <div class="parkinglottblleft">
	                        <div class="parkinglottbllabel">PARKING LOT NAME</div>
                        	<input type="text" class="txtbox" onBlur="chkField(this)" onFocus="chkField(this)" id="eamil_address" name="eamil_address" value="" />
                        </div>
                    </div>
                    <div class="parkinglottblrow">
                        <div class="parkinglottblleft">
                            <div class="parkinglottbllabel">ADDRESS</div>
                            <input type="text" class="txtbox" onBlur="chkField(this)" onFocus="chkField(this)" id="eamil_address" name="eamil_address" value="" />
                        </div>
                    </div>
                    <div class="parkinglottblrow">
                        <div class="parkinglottblleft">
                            <div class="parkinglottbllabel">CITY</div>
                            <select class="listbox" id="" name="">
                            	<option value=""></option>
                            </select>
                        </div>
                        <div class="parkinglottblright">
                            <div class="parkinglottbllabel">STATE</div>
                            <select class="listbox" id="" name="">
                            	<option value=""></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </td>
      </tr>
      <tr>
        <td><? include "discount_popup.php"; ?></td>
      </tr>
      <tr>
        <td><? include "pricing_popup.php"; ?></td>
      </tr>
    </table>
</div>


<div id="pricing_popup" style="display:none; padding:2px 1px;">
    <table border="0" cellspacing="0" cellpadding="0" class="pricingpopup">
      <tr>
        <td class="pricingpopuphd">Pricing <div id="pricing_closebtn" class="popup_closebtn" title="Close">X</div></td>
      </tr>
      <tr>
        <td><? include "pricing_popup.php"; ?></td>
      </tr>
    </table>
</div>

<div id="discount_popup" style="display:none; padding:2px 1px;">
    <table border="0" cellspacing="0" cellpadding="0" class="addparkinglotpopup">
      <tr>
        <td class="addparkinglotpopuphd">Discount <div id="discount_closebtn" class="popup_closebtn" title="Close">X</div></td>
      </tr>
      <tr>
        <td><? include "discount_popup.php"; ?></td>
      </tr>
    </table>
</div>

<div id="editprice_popup" style="display:none; padding:2px 1px;">

    <table border="0" cellspacing="0" cellpadding="0" class="pricingpopup">
      <tr>
        <td class="pricingpopuphd">Edit Pricing <div id="editprice_closebtn" class="popup_closebtn" title="Close">X</div></td>
      </tr>
      <tr>
        <td>
        
            <div class="parkinglottblouter" id="pricingtblouter">
                <div class="parkinglottblbtm">
                <table border="0" cellspacing="0" cellpadding="0" class="pricingtbl">
                  <tr>
                    <td>Daily</td>
                    <td align="right"><input type="text" class="txtboxsmall" onBlur="chkField(this)" onFocus="chkField(this)" id="eamil_address" name="eamil_address" value="" /></td>
                  </tr>
                  <tr>
                    <td>Free Day Every</td>
                    <td align="right"><input type="text" class="txtboxsmall" onBlur="chkField(this)" onFocus="chkField(this)" id="eamil_address" name="eamil_address" value="" /></td>
                  </tr>
                  <tr>
                    <td>Weekend</td>
                    <td align="right"><input type="text" class="txtboxsmall" onBlur="chkField(this)" onFocus="chkField(this)" id="eamil_address" name="eamil_address" value="" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><img src="images/submit_btn.jpg" border="0" /></td>
                  </tr>
                </table>
                </div>
            </div>
        
        </td>
      </tr>
    </table>

</div>



<script type="text/javascript">

$(document).ready(function(){
	
	$(".parkinglotstbl tr th:nth-child(odd)").css('background-color','#edf1f4');
	$(".parkinglotstbl tr th:nth-child(even)").css('background-color','#f4f8fc');
	$(".parkinglotstbl tr td:nth-child(odd)").css('background-color','#f7f7f7');
	$(".parkinglotstbl tr td:nth-child(even)").css('background-color','#ffffff');
	
});


function show_addparkinglot(){
	
	$("#addparkinglot_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

$('#addparkinglot_closebtn').click(function(){   $("#addparkinglot_popup").dialog('close');  });


function show_pricingpopup(){
	
	$("#pricing_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

$('#pricing_closebtn').click(function(){  $("#pricing_popup").dialog('close');  });


function show_discountpopup(){
	
	$("#discount_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

$('#discount_closebtn').click(function(){  $("#discount_popup").dialog('close');  });


function show_pricepopup(){
	
	$("#editprice_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}
$('#editprice_closebtn').click(function(){  $("#editprice_popup").dialog('close');  });


</script>



<?
}
include "member_template.php";
?>