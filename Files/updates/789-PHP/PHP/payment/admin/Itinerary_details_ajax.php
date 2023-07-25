<? 

require_once("includes.php");

if($_POST['Id']>0 || ($rs_list->Id!="")){
 
 	if($rs_list->Id!='') $facultyId = $rs_list->Id; else $facultyId = $_POST['Id'];
	
	$rs_regdtl = Registration::getRegistrationByFacultyId($_POST['Id']);
 	
	if($rs_regdtl->Id!=''){
	    $dateofarrival = date ("d-m-Y",strtotime($rs_regdtl->DateofArrival));
		$arrivalflightnumber = $rs_regdtl->ArrivalFlightNumber;
		$arrivalflightname = $rs_regdtl->ArrivalFlightName;
		$arrivaltime = split(':',$rs_regdtl->ArrivalTime);
		$ArrivalType = $rs_regdtl->ArrivalType;
		
		$arrivalHour = $arrivaltime[0];
		$rs = explode(' ',$arrivaltime[1]);
		$arrivalMinute= $rs[0];
		$arrivalMeridien = $rs[1];
		
		$DepartureType = $rs_regdtl->DepartureType;
		$dateofdeparture = date ("d-m-Y",strtotime($rs_regdtl->DateofDeparture));
		$departureflightnumber = $rs_regdtl->DepartureFlightnumber;
		$departureflightname = $rs_regdtl->DepartureFlightname;
		$departuretime = split(':',$rs_regdtl->DepartureTime);
		$departureHour = $departuretime[0];
		$rs = explode(' ',$departuretime[1]);
		$departureMinute= $rs[0];
		$departureMeridien = $rs[1];
		
		$checkindate = date ("d-m-Y",strtotime($rs_regdtl->CheckinDate));
		$checkintime =  split(':',$rs_regdtl->CheckinTime);
		
		 
		$checkintime_hh = $checkintime[0];
		$rs = explode(' ',$checkintime[1]);
		 
		$checkintime_mm= $rs[0];
		$checkintime_ampm = $rs[1];
		
		$checkoutdate =  date ("d-m-Y",strtotime($rs_regdtl->CheckoutDate));
		$checkouttime = split(':',$rs_regdtl->CheckoutTime);
		
		$checkouttime_hh = $checkouttime[0];
		$rs = explode(' ',$checkouttime[1]);
		 
		$checkouttime_mm= $rs[0];
		$checkouttime_ampm = $rs[1];
 	}else{	
		$dateofarrival = "DD/MM/YYYY";
		$dateofdeparture = "DD/MM/YYYY";
		$departureHour = "HH";
		$departureMinute= "MM";
		$departureMeridien ="";
	}
}

if($_POST['act'] == "Submit_Itinerary")
{
	ob_clean();
	
 		if($_POST['id']>0){
		
			$rs_regdtl = Registration::getRegistrationByFacultyId($_POST['id']);
					
			$today=time();
			$sqlDateTime = date('Y-m-d H:i:s',$today);

			$reg_obj = new Registration();
			$reg_obj->FacultyId= $_POST['id']; 
			
			if($_POST['dateofarrival']!="" && $_POST['dateofarrival']!="undefined") $dateofarrival = date("Y-m-d",strtotime($_POST['dateofarrival']));
			else $dateofarrival = "0000-00-00";
			
			if($_POST['dateofdeparture']!="" && $_POST['dateofdeparture']!="undefined") $dateofdeparture = date("Y-m-d",strtotime($_POST['dateofdeparture']));
			else $dateofdeparture = "0000-00-00";
			
			$reg_obj->DateofArrival = $dateofarrival;
			$reg_obj->ArrivalFlightNumber = $_POST['arrivalflightnumber'];
			$reg_obj->ArrivalTime = $_POST['arrivalHour'].":".$_POST['arrivalMinute']." ".$_POST['arrivalMeridien'];
			$reg_obj->ArrivalFlightName = $_POST['arrivalflightname'];
			$reg_obj->DateofDeparture = $dateofdeparture;	
			$reg_obj->DepartureFlightnumber = $_POST['departureflightnumber'];	
			$reg_obj->DepartureTime = $_POST['departureHour'].":".$_POST['departureMinute']." ".$_POST['departureMeridien'];
			$reg_obj->DepartureFlightname = $_POST['departureflightname']; 
			$reg_obj->Arrivaltime_Format = $_POST['arrivalHour'].":".$_POST['arrivalMinute']." ".$_POST['arrivalMeridien'];
			$reg_obj->Departuretime_Format 	 = $_POST['departureHour'].":".$_POST['departureMinute']." ".$_POST['departureMeridien'];
			$reg_obj->IsAccommodation = $_POST['is_accommodation'];
			$reg_obj->CompletedStep = "2";
			
			if($rs_regdtl->Id!=''){
				$uid = $rs_regdtl->Id;
				$rs_regdtl= $reg_obj->updateFac_Reg();
				echo $val="Updated Successfully";
			}else{
				$rs_list = Faculty::getFacultyById($_POST['id']);
				
				$reg_obj->FacultyId = $_POST['id'];
				$reg_obj->Prefix = $rs_list->Prefix;
				$reg_obj->MemberType = 'FA';
				$reg_obj->Name = $rs_list->Name;
				$reg_obj->EmailAddress = $rs_list->Email;		
				$reg_obj->Mobile = $rs_list->Mobile;		
				$reg_obj->Organization = $rs_list->Institute;
				$reg_obj->Designation = $rs_list->Designation;
				$reg_obj->Address = $rs_list->Address;
				$reg_obj->Country  = $rs_list->Country;		
				$reg_obj->City = $rs_list->City;
				$reg_obj->State = $rs_list->State;
				$reg_obj->Zipcode = $rs_list->Zipcode;
				$reg_obj->Paid = 'Y';
				$reg_obj->AddedDate = $rs_list->AddedDate;
				
				$rs_facdtl= $reg_obj->insertRegistration();
				
				$uid = $rs_facdtl;
				
				$reg_obj = new Registration();
				$reg_obj->field='isFaculty';
				$reg_obj->fieldvalue='Y';
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				
				$reg_obj = new Registration();
				$reg_obj->field='password';
				$reg_obj->fieldvalue='AROI2014';
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				
				$reg_obj = new Registration();
				$reg_obj->field='RegisterBy';
				$reg_obj->fieldvalue='A';
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				 
				$reg_obj = new Registration();
				$reg_obj->field='PaymentThrough';
				$reg_obj->fieldvalue='F';
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				
				$reg_obj = new Registration();
				$reg_obj->field='Paid';
				$reg_obj->fieldvalue='Y';
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				
				$reg_obj = new Registration();
				$reg_obj->field='RegistrationDate';
				$reg_obj->fieldvalue=$sqlDateTime;
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				
				$reg_obj = new Registration();
				$reg_obj->field='RegistredVia';
				$reg_obj->fieldvalue='SYS';
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				 
				if($rs_facdtl!="") echo $val="Inserted Successfully";
		   }
				$reg_obj = new Registration();
				$reg_obj->field='PickupDrop';
				$reg_obj->fieldvalue=$_POST['pickupdrop'];
				$reg_obj->user_id=$uid;
				$update =$reg_obj->update_userbyfield();
				
				$reg_obj = new Registration();
				$reg_obj->field='ArrivalType';
				$reg_obj->fieldvalue=$_POST['ArrivalType'];
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				
				$reg_obj = new Registration();
				$reg_obj->field='DepartureType';
				$reg_obj->fieldvalue=$_POST['DepartureType'];
				$reg_obj->user_id=$uid;
				$reg_obj->update_userbyfield();
				
			if($_POST['is_accommodation']=='Y' || $rs_regdtl->IsAccommodation=='Y') {
				
				$reg_obj->CheckinDate = date ("Y-m-d",strtotime($_POST['checkindate']));
				$reg_obj->CheckinTime = $_POST['checkintime_hh'].":".$_POST['checkintime_mm']." ".$_POST['checkinmeridian'];
				$reg_obj->CheckoutDate =  date ("Y-m-d",strtotime($_POST['checkoutdate']));
				$reg_obj->CheckoutTime = $_POST['checkouttime_hh'].":".$_POST['checkouttime_mm']." ".$_POST['checkoutmeridian'];
				$reg_obj->IsAccommodation = $_POST['is_accommodation'];
				$reg_obj->Notes = $_POST['accommodation_notes'];
				
				$reg_obj->FacultyId= $_POST['id']; 
				$rs_regdtl= $reg_obj->updateFac_AccomReg();
			
			}
			$reg_obj = new Registration();
			$reg_obj->field='LocalTransport';
			$reg_obj->fieldvalue=$_POST['localtransport'];
			$reg_obj->user_id=$uid;
			$reg_obj->update_userbyfield();
		  
	if($_POST['notes']!=''){
			
		$notesObj = new Faculty();
		$notesObj->faculty_id=$_POST['id'];
		$notesObj->notes=addslashes($_POST['notes']);
		
		$rs_NoteaDtl = $notesObj->getFacultyNotesByFId($_POST['id']);
		
		if($rs_NoteaDtl->Id>0){
			$notesObj->Id=$rs_NoteaDtl->Id;
			$update_fac_notes = $notesObj->updateFacultyNotes();
		}else{
			$notesObj->insertFacultyNotes();
		}
			
	}
 	  }
  exit();
}  

$rs_facnotesdtl = Faculty::getFacultyNotesByFId($_POST['Id']);
 ?>
<style type="text/css">
.texterror{
color:#F00;
}
</style>
<input type="hidden" name="page" id="page" value="<?=trim($_POST['page'])?>" />
<input type="hidden" name="page1" id="page1" value="<?=trim($_POST['page'])?>" />
<input type="hidden" name="fac_type" id="fac_type" value="<?=$_POST['fac_type']?>" />
<input type="hidden" name="city" id="city" value="<?=$_POST['city']?>" />

<table width="700" border="0" class="tbldetinner" cellpadding="2" cellspacing="0">
  <tr class="tbldetinnerhd">
	<td colspan="2">Itinerary Detail <span id="print_value" style="float:right; font-size:16px; color:#009933;"></span></td>
  </tr>
  <tr>
  	<td style="padding-left:10px;" id="td_Pickup">Do they need a pickup and drop from airport?</td>
  	<td style="padding-right:200px;"><input type="radio" name="pickupdrop" id="pickupdrop" value="Y" onclick="showItinerary()" <? if($rs_regdtl->PickupDrop=='Y'){ echo 'checked'; } ?> />
    Yes&nbsp;<input type="radio" name="pickupdrop" id="pickupdrop" value="N" onclick="showItinerary()" <? if($rs_regdtl->PickupDrop=='N'){ echo 'checked'; } ?> />No&nbsp;</td>
  </tr>
  <tr id="iti_td" style="display:none">
	<td style="padding:10px 0px;" valign="top">
		<table width="100%" border="0" class="itinerarytbl" cellpadding="2" cellspacing="2">
		  <tr>
			<td colspan="2"><b><u>Arrival</u></b></td>
		  </tr>
		  <tr>
			<td>Date</td>
			<td>
				<input type="text" class="txtbox1 datepicker" style="width:85px;" id="dateofarrival" name="dateofarrival" value="<?=($dateofarrival!='00-00-0000' && $dateofarrival!='01-01-1970')?$dateofarrival:''?>" onBlur="chkField(this)" onFocus="chkField(this)" autocomplete="off" />
			</td>
		  </tr>
		  <tr>
			<td>Time</td>
			<td>
				<select class="listboxtime" id="arrivalHour" name="arrivalHour" style="margin-left:0px">
				<option value="">HH</option>
				<option value="01" >01</option>
				<option value="02" >02</option>
				<option value="03" >03</option>
				<option value="04" >04</option>
				<option value="05" >05</option>
				<option value="06" >06</option>
				<option value="07" >07</option>
				<option value="08" >08</option>
				<option value="09" >09</option>
				<option value="10" >10</option>
				<option value="11" >11</option>
				<option value="12" >12</option>
				</select>
				<script type="text/javascript">
					$('#arrivalHour').val('<?=$arrivalHour?>');
				</script>
				
				<select class="listboxtime" id="arrivalMinute" name="arrivalMinute">
				<option value="">MM</option>
				<? 
				if($to_flight_minutes=='') $to_flight_minutes='00';
				for($i = 0; $i < 60; $i+=5){ 
				if($i<10) $i='0'.$i;
				?>
				<option value="<?=$i?>" ><?=$i?></option>
				<? } ?>
				</select>
				<script type="text/javascript">
					$('#arrivalMinute').val('<?=$arrivalMinute?>');
				</script>
				<span >
				<input type="radio" id="Meridien" name="arrivalMeridien" value="AM" <? if($arrivalMeridien== 'AM') { ?> checked="checked" <? } ?> />AM
				<input type="radio" id="Meridien" name="arrivalMeridien" value="PM" <? if($arrivalMeridien== 'PM') { ?> checked="checked" <? } ?> />PM
				</span>
				
			</td>
		  </tr>
          <tr>
			<td>Transport Mode</td>
			<td>
            	<input type="radio" id="arrivalmode1" name="ArrivalType" value="F" <? if($ArrivalType== 'F') { ?> checked="checked" <? } ?> /> Airline
                <input type="radio" id="arrivalmode2" name="ArrivalType" value="T" <? if($ArrivalType== 'T') { ?> checked="checked" <? } ?> /> Train
                <input type="radio" id="arrivalmode3" name="ArrivalType" value="R" <? if($ArrivalType== 'R') { ?> checked="checked" <? } ?> /> Road
            </td>
		  </tr>
		  <tr>
			<td>Flight No</td>
			<td><input type="text" class="txtbox1" style="width:190px;" id="arrivalflightnumber" name="arrivalflightnumber" value="<?=$arrivalflightnumber?>" /></td>
		  </tr>
		  <tr>
			<td>Airline Name</td>
			<td><input type="text" class="txtbox1" style="width:190px;" id="arrivalflightname" name="arrivalflightname" value="<?=$arrivalflightname;?>" /></td>
		  </tr>
		</table>
	</td>
	<td style="padding:10px 0;" valign="top">
		<table width="100%" border="0" class="itinerarytbl" cellpadding="2" cellspacing="2">
		  <tr>
			<td colspan="2"><b><u>Departure</u></b></td>
		  </tr>
		  <tr>
			<td>Date</td>
			<td>
				<input type="text" class="txtbox1" style="width:85px;" id="dateofdeparture" name="dateofdeparture" value="<?=($dateofdeparture!='00-00-0000' && $dateofdeparture!='01-01-1970')?$dateofdeparture:''?>" onBlur="chkField(this)" onFocus="chkField(this)" autocomplete="off"/>
			</td>
		  </tr>
		  <tr>
			<td>Time</td>
			<td>
				<select class="listboxtime" id="departureHour" name="departureHour" style="margin-left:0px">
				<option value="">HH</option>
				<option value="01" >01</option>
				<option value="02" >02</option>
				<option value="03" >03</option>
				<option value="04" >04</option>
				<option value="05" >05</option>
				<option value="06" >06</option>
				<option value="07" >07</option>
				<option value="08" >08</option>
				<option value="09" >09</option>
				<option value="10" >10</option>
				<option value="11" >11</option>
				<option value="12" >12</option>
				</select>
				<script type="text/javascript">
					$('#departureHour').val('<?=$departureHour?>');
				</script>
				
				<select class="listboxtime" id="departureMinute" name="departureMinute">
				<option value="">MM</option>
				<? 
				if($to_flight_minutes=='') $to_flight_minutes='00';
				for($i = 0; $i < 60; $i+=5){ 
				if($i<10) $i='0'.$i;
				?>
				<option value="<?=$i?>" ><?=$i?></option>
				<? } ?>
				</select>
				<script type="text/javascript">
					$('#departureMinute').val('<?=$departureMinute?>');
				</script>
				<span id="td_Dmeridian">
				<input type="radio" id="Meridien" name="departureMeridien" value="AM" <? if($departureMeridien== 'AM') { ?> checked="checked" <? } ?>/>AM
				<input type="radio" id="Meridien" name="departureMeridien" value="PM" <? if($departureMeridien== 'PM') { ?> checked="checked" <? } ?>/>PM
				</span>
			</td>
		  </tr>
          <tr>
			<td>Transport Mode</td>
			<td>
            	<input type="radio" id="departuremode1" name="DepartureType" value="F" <? if($DepartureType== 'F') { ?> checked="checked" <? } ?> /> Airline
                <input type="radio" id="departuremode2" name="DepartureType" value="T" <? if($DepartureType== 'T') { ?> checked="checked" <? } ?> /> Train
                <input type="radio" id="departuremode3" name="DepartureType" value="R" <? if($DepartureType== 'R') { ?> checked="checked" <? } ?> /> Road
            </td>
		  </tr>
		  <tr>
			<td>Flight No</td>
			<td><input type="text" class="txtbox1" style="width:190px;" id="departureflightnumber" name="departureflightnumber" value="<?=$departureflightnumber;?>" /></td>
		  </tr>
		  <tr>
			<td>Airline Name</td>
			<td><input type="text" class="txtbox1" style="width:190px;" id="departureflightname" name="departureflightname" value="<?=$departureflightname;?>" /></td>
		  </tr>
          
          
       </table>
	</td>
  </tr>
   <tr>
  	<td style="padding-left:10px; padding-top:10px;" id="td_is_accommodation">Do they need Accommodation?</td>
    <td><input type="radio" name="is_accommodation" id="is_accommodation1" value="Y" onclick="showtraveldtls(this.value)" <? if($rs_regdtl->IsAccommodation == 'Y') { ?> checked="checked" <? } ?> />Yes&nbsp;&nbsp;<input type="radio" name="is_accommodation" id="is_accommodation1" value="N" onclick="showtraveldtls(this.value)" <? if($rs_regdtl->IsAccommodation == 'N') { ?> checked="checked" <? } ?>  />No</td></tr>
   
    <tr id="traveldetails" style="display:none">
        <td colspan="2" style="padding:10px;">
        <table width="100%" border="0" cellpadding="2" cellspacing="2">
        <tr class="tbldetinnerhd">
    	<td colspan="2">Accommodation Detail</td>
        </tr>
        <tr>
        <td width="32%" valign="top" style="padding:5px;">Check In Date :</td>
        <td width="68%" valign="top" style="padding:5px;"><input type="text" class="txtbox1 datepicker" id="checkindate" name="checkindate" value="<?=($checkindate!='00-00-0000' && $checkindate!='01-01-1970' && $checkindate!='1969-12-31')?$checkindate:''?>" onBlur="chkField(this)" onFocus="chkField(this)" autocomplete="off" style="width:150px;" /></td>
        </tr>
        <tr>
        <td valign="top" style="padding:5px;">Check In Time :</td>
        <td valign="top" style="padding:5px;">	
        <select class="listbox" id="checkintime_hh" name="checkintime_hh" style="width:50px; margin-right:10px;">
        <option value="">HH</option>
        <option value="01" >01</option>
        <option value="02" >02</option>
        <option value="03" >03</option>
        <option value="04" >04</option>
        <option value="05" >05</option>
        <option value="06" >06</option>
        <option value="07" >07</option>
        <option value="08" >08</option>
        <option value="09" >09</option>
        <option value="10" >10</option>
        <option value="11" >11</option>
        <option value="12" >12</option>
        </select>
        <script type="text/javascript">
        $('#checkintime_hh').val('<?=$checkintime_hh?>');
        </script>
        
        <select class="listboxtime" id="checkintime_mm" name="checkintime_mm">
        <option value="">MM</option>
        <? 
       
        for($i = 0; $i < 60; $i+=5){ 
        if($i<10) $i='0'.$i;
        ?>
        <option value="<?=$i?>" ><?=$i?></option>
        <? } ?>
        </select>
        
        <script type="text/javascript">
        $('#checkintime_mm').val('<?=$checkintime_mm?>');
        </script>
        <span id="td_Ameridian1">
        <input type="radio" id="checkintime_ampm" name="checkintime_ampm" value="AM" <? if($checkintime_ampm== 'AM') { ?> checked="checked" <? } ?> />AM
        <input type="radio" id="checkintime_ampm" name="checkintime_ampm" value="PM" <? if($checkintime_ampm== 'PM') { ?> checked="checked" <? } ?> />PM
        </span></td>
        </tr>
        <tr>
        <td valign="top" style="padding:5px;">Check Out Date :</td>
        <td valign="top" style="padding:5px;"><input type="text" class="txtbox1 datepicker" style="width:150px;" id="checkoutdate" name="checkoutdate" value="<?=($checkoutdate!='00-00-0000' && $checkoutdate!='01-01-1970' && $checkoutdate!='1969-12-31')?$checkoutdate:''?>" onBlur="chkField(this)" onFocus="chkField(this)" autocomplete="off" /></td>
    </tr>
    <tr>
    <td valign="top" style="padding:5px;">Check Out Time :</td>
    <td valign="top" style="padding:5px;">	
    <select class="listbox" id="checkouttime_hh" name="checkouttime_hh" style="width:50px; margin-right:10px;">
    <option value="">HH</option>
    <option value="01" >01</option>
    <option value="02" >02</option>
    <option value="03" >03</option>
    <option value="04" >04</option>
    <option value="05" >05</option>
    <option value="06" >06</option>
    <option value="07" >07</option>
    <option value="08" >08</option>
    <option value="09" >09</option>
    <option value="10" >10</option>
    <option value="11" >11</option>
    <option value="12" >12</option>
    </select>
    <script type="text/javascript">
    $('#checkouttime_hh').val('<?=$checkouttime_hh?>');
    </script>
    <select class="listbox" id="checkouttime_mm" name="checkouttime_mm" style="width:50px; margin-right:10px;">
    <option value="">MM</option>
   <? 
         for($i = 0; $i < 60; $i+=5){ 
        if($i<10) $i='0'.$i;
        ?>
        <option value="<?=$i?>" ><?=$i?></option>
        <? } ?>
    </select>
    <script type="text/javascript">
        $('#checkouttime_mm').val('<?=$checkouttime_mm?>');
        </script>
    <span id="td_Dmeridian1">
    <input type="radio" id="checkouttime_ampm" name="checkouttime_ampm" value="AM" <? if($checkouttime_ampm== 'AM') { ?> checked="checked" <? } ?>/>AM
    <input type="radio" id="checkouttime_ampm" name="checkouttime_ampm" value="PM" <? if($checkouttime_ampm== 'PM') { ?> checked="checked" <? } ?>/>PM
    </span>
    </td>
    </tr>
    <tr>
    <td style="padding-left:10px; padding-bottom:10px;">Accommodation Notes?</td>
    <td><textarea name="accommodation_notes" id="accommodation_notes" rows="3" cols="30"><?=stripslashes($rs_regdtl->Notes)?></textarea></td>
    </tr>
    
    </table>
    </td>
    </tr>
  
  <tr style="display:none; padding-top:10px;" id="acco_td">
   		<td colspan="2">
        
        	    <script type="text/javascript">
				$(function() {
					$(".datepicker").datepicker({
						changeMonth: true,
						numberOfMonths: 1,
						minDate: '10/01/2014',
						//maxDate: '06/01/2014'
					});
					  
				});
			   </script>
               <?
			   	$rs_facdtl = Registration::getRegistrationByFacultyId($_POST['Id']);
				//print_r($rs_facdtl);
				 
				$dateofarrival = date ("d-m-Y",strtotime($rs_facdtl->DateofArrival));
				$arrivaltime = split(':',$rs_facdtl->ArrivalTime);
				$arrivalHour = $arrivaltime[0];
				$rs = explode(' ',$arrivaltime[1]);
				$arrivalMinute= $rs[0];
				$arrivalMeridien = $rs[1];
				
				$dateofdeparture = date ("d-m-Y",strtotime($rs_facdtl->DateofDeparture));
				$departuretime = split(':',$rs_facdtl->DepartureTime);
				$departureHour = $departuretime[0];
				$rs = explode(' ',$departuretime[1]);
				$departureMinute= $rs[0];
				$departureMeridien = $rs[1];
				
			   ?>
         </td>
   </tr>
 
<tr>
    <td style="padding-left:10px; padding-top:10px;">Notes <span style="padding-left:40px;"><textarea name="notes" id="notes" rows="3" cols="30"><?=stripslashes($rs_facnotesdtl->notes)?></textarea></span></td>
      
    <td>&nbsp;</td>
</tr>
<tr>
    <td colspan="2" style="padding:10px;"><? if($_POST['faculty_id']!="") $Val_Id = $_POST['faculty_id']; else $Val_Id = $facultyId;?> 
    <!--<img src="images/submit_btn.jpg" border="0" style="cursor:pointer; float:right" onclick="submit_faculty_reg(<?=$Val_Id?>)"/>-->
    <div class="submitbtn bgred" onclick="submit_faculty_reg(<?=$Val_Id?>)">Submit</div>
    </td>
</tr> 
</table>

				  
<script type="text/javascript">

function showfdtl(){
	
	var pickupdrop = $('input[name=pickupdrop]:checked').val();
	if(pickupdrop=='Y'){		
		$('#flightdtl_td').show();
	}else{
		$('#flightdtl_td').hide();
	}
	
}

$(function() {
	$(".datepicker").datepicker({
		changeMonth: true,
		minDate: '05/28/2014'
	});
	  
	$("#dateofdeparture").datepicker({
		changeMonth: true,
		minDate: '10/01/2014'
	});  
});


<!-------------------------Submit/Update Itinerary Details-------------------------------->
function submit_faculty_reg(id){

var err=0;

var pickupdrop = $('input[name=pickupdrop]:checked').val();
var is_accommodation1 = $('input[name=is_accommodation]:checked').val();

var redirectpage = $('#page1').val();
var facultyType = $('#fac_type').val();
var facultyCity = $('#city').val();

 	
if(pickupdrop=='Y'){
	
  	var dateofarrival = $('#dateofarrival').val();
  	var arrivalflightnumber = $('#arrivalflightnumber').val();
	var arrivalflightname = $('#arrivalflightname').val();
	var arrivalHour = $('#arrivalHour').val();
	var arrivalMinute = $('#arrivalMinute').val();
	var arrivalMeridien = $('input[name=arrivalMeridien]:checked').val();
	
	var ArrivalType = $('input[name=ArrivalType]:checked').val();
	
	var dateofdeparture = $('#dateofdeparture').val();
	var departureflightnumber = $('#departureflightnumber').val();
	var departureHour = $('#departureHour').val();
	var departureMinute = $('#departureMinute').val();
	var departureflightname = $('#departureflightname').val();
	var departureMeridien = $('input[name=departureMeridien]:checked').val();
	
	var DepartureType = $('input[name=DepartureType]:checked').val();
	
	
	
	if($('#dateofarrival').val()==''){ err=1; $('#dateofarrival').addClass('boxerror'); } else{ $('#dateofarrival').removeClass('boxerror'); }
	if($('#arrivalflightnumber').val()==''){ err=1; $('#arrivalflightnumber').addClass('boxerror'); } else{ $('#arrivalflightnumber').removeClass('boxerror'); }
	if($('#arrivalflightname').val()==''){ err=1; $('#arrivalflightname').addClass('boxerror'); } else{ $('#arrivalflightname').removeClass('boxerror'); }
	if($('#arrivalHour').val()==''){ err=1; $('#arrivalHour').addClass('boxerror'); } else{ $('#arrivalHour').removeClass('boxerror'); }
	if($('#arrivalMinute').val()==''){ err=1; $('#arrivalMinute').addClass('boxerror'); } else{ $('#arrivalMinute').removeClass('boxerror'); }
	//if(!$('input[name=arrivalMeridien]:checked').val()){err=1;$("#td_Ameridian").addClass("texterror");}else{$("#Type").removeClass("texterror");}
	
	if($('#dateofdeparture').val()==''){ err=1; $('#dateofdeparture').addClass('boxerror'); } else{ $('#dateofdeparture').removeClass('boxerror'); }
	if($('#departureflightnumber').val()==''){ err=1; $('#departureflightnumber').addClass('boxerror'); } else{ $('#departureflightnumber').removeClass('boxerror'); }
	if($('#departureHour').val()==''){ err=1; $('#departureHour').addClass('boxerror'); } else{ $('#departureHour').removeClass('boxerror'); }
	if($('#departureMinute').val()==''){ err=1; $('#departureMinute').addClass('boxerror'); } else{ $('#departureMinute').removeClass('boxerror'); }
	if($('#departureflightname').val()==''){ err=1; $('#departureflightname').addClass('boxerror'); } else{ $('#departureflightname').removeClass('boxerror'); }
	//if(!$('input[name=departureMeridien]:checked').val()){err=1;$("#td_Dmeridian").addClass("texterror");}else{$("#Type").removeClass("texterror");}

}else{
	var dateofarrival = '';
  	var arrivalflightnumber = '';
	var arrivalflightname = '';
	var arrivalHour = '';
	var arrivalMinute = '';
	var arrivalMeridien = '';
	var ArrivalType = '';
	
	var dateofdeparture = '';
	var departureflightnumber = '';
	var departureHour = '';
	var departureMinute = '';
	var departureflightname = '';
	var departureMeridien = '';
	var DepartureType = '';
}
if(is_accommodation1=='Y'){
 	var checkindate = $('#checkindate').val();
	var checkintime_hh = $('#checkintime_hh').val();
	var checkintime_mm = $('#checkintime_mm').val();
	var checkinmeridian = $('input[name=checkintime_ampm]:checked').val();
	
	var checkoutdate = $('#checkoutdate').val();
	var checkouttime_hh = $('#checkouttime_hh').val();
	var checkouttime_mm = $('#checkouttime_mm').val();
	var checkoutmeridian = $('input[name=checkouttime_ampm]:checked').val();
	
    if($('#checkindate').val()==''){ err=1; $('#checkindate').addClass('boxerror'); } else{ $('#checkindate').removeClass('boxerror'); }
	if($('#checkintime_hh').val()==''){ err=1; $('#checkintime_hh').addClass('boxerror'); } else{ $('#checkintime_hh').removeClass('boxerror'); }
	if($('#checkintime_mm').val()==''){ err=1; $('#checkintime_mm').addClass('boxerror'); } else{ $('#checkintime_mm').removeClass('boxerror'); }
	//if(!$('input[name=checkinmeridian]:checked').val()){err=1;$("#td_Ameridian1").addClass("texterror");}else{$("#td_Ameridian1").removeClass("texterror");}
	
	if($('#checkoutdate').val()==''){ err=1; $('#checkoutdate').addClass('boxerror'); } else{ $('#checkoutdate').removeClass('boxerror'); }
	if($('#checkouttime_hh').val()==''){ err=1; $('#checkouttime_hh').addClass('boxerror'); } else{ $('#checkouttime_hh').removeClass('boxerror'); }
	if($('#checkouttime_mm').val()==''){ err=1; $('#checkouttime_mm').addClass('boxerror'); } else{ $('#checkouttime_mm').removeClass('boxerror'); }
	//if(!$('input[name=checkoutmeridian]:checked').val()){err=1;$("#td_Dmeridian1").addClass("texterror");}else{$("#td_Dmeridian1").removeClass("texterror");}	/
	
 	var accommodation_notes = $('#accommodation_notes').val();
 }else{
	var checkindate = '';
	var checkintime_hh = '';
	var checkintime_mm = '';
	var checkinmeridian = '';
	
	var checkoutdate = '';
	var checkouttime_hh = '';
	var checkouttime_mm = '';
	var checkoutmeridian = '';
 }
 
var localtransport = $('input[name=local_transport]:checked').val();
var notes = $('#notes').val();

 

if(!$('input[name=pickupdrop]:checked').val()){err=1;$("#td_Pickup").addClass("texterror");}else{$("#td_Pickup").removeClass("texterror");}
if(!$('input[name=is_accommodation]:checked').val()){err=1;$("#td_is_accommodation").addClass("texterror");}else{$("#td_is_accommodation").removeClass("texterror");}
//if(!$('input[name=local_transport]:checked').val()){err=1;$("#td_local_transport").addClass("texterror");}else{$("#td_local_transport").removeClass("texterror");}

 if(err==0){
 
  	ajax({
		a:'Itinerary_details_ajax',
		b:'act=Submit_Itinerary&id='+id+'&dateofarrival='+dateofarrival+'&arrivalflightnumber='+arrivalflightnumber+'&arrivalflightname='+arrivalflightname+'&arrivalHour='+arrivalHour+'&arrivalMinute='+arrivalMinute+'&arrivalMeridien='+arrivalMeridien+'&dateofdeparture='+dateofdeparture+'&departureflightnumber='+departureflightnumber+'&departureHour='+departureHour+'&departureMinute='+departureMinute+'&departureMeridien='+departureMeridien+'&departureflightname='+departureflightname+'&checkindate='+checkindate+'&checkintime_hh='+checkintime_hh+'&checkintime_mm='+checkintime_mm+'&checkinmeridian='+checkinmeridian+'&checkoutdate='+checkoutdate+'&checkouttime_hh='+checkouttime_hh+'&checkouttime_mm='+checkouttime_mm+'&checkoutmeridian='+checkoutmeridian+'&localtransport='+localtransport+'&is_accommodation='+is_accommodation1+'&notes='+notes+'&pickupdrop='+pickupdrop+'&accommodation_notes='+accommodation_notes+'&ArrivalType='+ArrivalType+'&DepartureType='+DepartureType,
		c:function(){},
		d:function(data){
			 //alert(data);
			if($.trim(redirectpage)=='report') {
				$("#popup_itinerary").dialog('close');
				faculty_report_tab(facultyType, facultyCity);
			}else{
		 		$('#print_value').html(data);
			}
		 }
		});
	}
}
<? if($rs_regdtl->PickupDrop!=''){ ?>
showItinerary();
<? } ?>
function showItinerary(){
	
	if($('input[name=pickupdrop]:checked').val()=='Y'){
		 		
		$('#iti_td').show();
		//$('#acco_td').hide();
	}else{
		//$('#acco_td').show();
		$('#iti_td').hide();
	}
}

<? if($rs_facdtl->IsAccommodation!=''){ ?>
showtraveldtls('<?=$rs_facdtl->IsAccommodation?>');
<? } ?>
function showtraveldtls(val){
	 
	
	if(val=='Y'){		
		$('#traveldetails').show();
	}else{
		$('#traveldetails').hide();
	}
}

</script>
