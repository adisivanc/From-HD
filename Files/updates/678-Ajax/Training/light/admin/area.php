<?
	require("includes.php");
	$country_Arr = countries();
	$indiastate_Arr = IndiaStateArr();
	//$city_arr = city();


?>

<form id="areafrm" name="areafrm" method="post">
<input type="hidden" id="act" name="act" value="Submit">

<table>
	<tr><td>Country</td>
		<td><select id="country" name="country" onChange="show_state(this.value)">
				<option value="">- Select Country -</option>
				<?
					if(count($country_Arr>0))
					{
						foreach($country_Arr as $K=>$V)
						{ ?>
							<option value="<? $K ?>" if()><? $V ?></option>
						<? }
					}
				
				?>
			</select></td></tr>
	<tr><td>State</td><td><select id="state" name="state"><option value="">- Select State -</option></select></td></tr>
	<tr><td>City</td><td><select id="city" name="city"><option value="">- Select City -</option></select></td></tr>
	<tr><td>Area</td><td><input type="text" id="area" name="area"></td></tr>
	<tr><td></td><td><input type="button" value="Add"></td></tr>
</table>

</form>