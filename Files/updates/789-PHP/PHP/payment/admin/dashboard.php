<?
function main(){
	
	if($_POST['act']=="showAccommodationDtls") {
		ob_clean();
		
			$accObj = new Accommodation();
			$accObj->HotelId=$_POST['hotelId'];
			$accObj->OccupancyType=$_POST['occupancyType'];
			$accObj->CheckinDate=date('Y-m-d',strtotime($_POST['arrivalDate']));
			$rsRoomDetails = $accObj->getOccupiedRoomDetails();
			$page = "dashboard";	
			echo '<div style="max-height:700px;">';		
			echo '<div style="position: relative; top:0; float:right; margin-left:15px;" class="popup_closebtn" title="Close" onclick="closeAccommodationPopup()">X</div>';
			//include("hotel_details_include.php");
			echo '</div>';
			
		exit();
	}
	
	if($_POST['act']=="showDelegatesDtls") {
		ob_clean(); ?>
        <table width="400" border="0" cellpadding="5" cellspacing="0">
        	<tr bgcolor="#CCCCCC">
            	<td style="padding:10px;"><b>Delegate List</b></td>
                <td style="padding:10px;">
                    <div style="position: relative; top:0; float:right; margin-left:15px;" class="popup_closebtn" title="Close" onclick="closeDelegatesPopup()">X</div>
                </td>
            </tr>
            <tr>
            	<td style="padding:10px;"><input type="radio" name="delegates_csv" id="delegate_all" value="A" onclick="showDelegateRange(this.value)" /> All  Delegates
                	<input type="radio" name="delegates_csv" id="delegate_range" value="R" onclick="showDelegateRange(this.value)" /> Range</td>
            </tr>
            <tr id="range_box" style="display:none;">
            	<td style="padding:10px;"><input type="text" class="txtbox2" name="range_min" id="range_min" /> Max Value<br /><br />
                <input type="text" class="txtbox2" name="range_max" id="range_max" /> Min Value</td>
            </tr>
            <tr>
            	<td colspan="2" style="padding:10px;"><img src="images/download_csv_btn.jpg" onclick="downloadCSV()" style="cursor:pointer;" /></td>
            </tr>
        </table>
	<?	exit();
	}
	
	if($_POST['act']=="getAccommodationList") {
	ob_clean();	
		$query = "select * from registration where ((is_accommodation='Y') or (t_is_accommodation='Y') or (n_is_accommodation='Y')) and paid='Y'  order by couponname ASC";
			$rs_reg = dB::mExecuteSql($query);	 ?>
			<table width="98%" border="0" class="regdtltbl">
                <tr bgcolor="#FFFFFF">
               		<td class="regdtltblhd" align="center">S.No</td>
                    <td class="regdtltblhd" align="center">Type / Reg ID</td>
                    <td class="regdtltblhd">Name</td>
                    <td class="regdtltblhd">Mobile</td>
                    <td class="regdtltblhd">Coupon Name</td>
                    <td class="regdtltblhd">Room Preference</td>
                    <td class="regdtltblhd">Hotel Id</td>
                    <td class="regdtltblhd" align="center">Action</td>
                </tr>
		<?	
		$cnt=0;
		if(count($rs_reg)>0) {
		foreach($rs_reg as $K=>$V) {
		  
				 $query1 = "select * from roomsharing where (RegistrationId LIKE '%".$V->id."~STFA%') or (RegistrationId LIKE '%".$V->id."~STCA%') or (RegistrationId LIKE '%".$V->id."~CA%') or (RegistrationId LIKE '%".$V->id."~') or (RegistrationId LIKE '%".$V->id."~PG%') or (RegistrationId LIKE '%".$V->id."~T%') or (RegistrationId LIKE '%".$V->id."~N%') or (RegistrationId LIKE '%".$V->id."~,%') or (RegistrationId LIKE '%,".$V->id."~') or (RegistrationId LIKE '%,".$V->id."~,%') order by Id asc";
				$rs_nonacco = dB::sExecuteSql($query1);	
				
				$rowbgColor = $K % 2 == 0 ? "#eeeeee" : "#FFFFFF";
				
				if($rs_nonacco->Id=='') {  $cnt++; ?>
                	<? if($V->registration_type=='ST' && ($V->firstname!='' && $V->t_firstname!='' && $V->n_firstname!='') && $rs_nonacco->Id!=$V->id) {  ?>
					
                    <? if($V->is_accommodation=='Y') { ?>
                	<tr bgcolor="<?=$rowbgColor?>">
						<td align="center"><?=($cnt)?></td>
                    	<td align="center"><?=$V->id?></td>
                        <td><b><?=$V->prefix.' '.$V->firstname.' '.$V->lastname?> (ST-CA)</b></td>
                        <td><?=$V->mobile?></td>
                        <td><?=$V->couponname?></td>
                        <td><? if($V->room_preference=='' || $V->room_preference=='N/A') echo "Not Set"; else echo $V->room_preference; ?></td>
                        <td><? if($V->hotelid==1) echo "Renaissance"; elseif($V->hotelid==2) echo "Kohinoor"; else echo "Not Set"; ?></td>
                        <td align="center" style="vertical-align:middle; background-color:<?=$type_color;?>">
			<img src="images/view_icon.png" border="0" alt="View" title="View" class="actionimg" style="cursor:pointer" onclick="show_viewdetails('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/edit_icon.png" border="0" alt="Edit" title="Edit" class="actionimg" style="cursor:pointer" onclick="showreg('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/itinerary.png" border="0" title="Itinerary Details" alt="Itinerary Details" onClick="showItinerary('<?=$V->id?>','<?=$_POST['type']?>')" style="cursor:pointer;" />
            			</td>
                    </tr>
                    <? } ?>
                    <? if($V->t_is_accommodation=='Y') { ?>
                    <tr bgcolor="<?=$rowbgColor?>">	<td align="center"><?=($cnt)?></td>
                    	<td align="center"><?=$V->id?></td>
                        <td><b><?=$V->t_prefix.' '.$V->t_firstname.' '.$V->t_lastname?> (Technician)</b></td>
                        <td><?=$V->t_mobile?></td>
                        <td><?=$V->couponname?></td>
                        <td><? if($V->t_room_preference=='' || $V->room_preference=='N/A') echo "Not Set"; else echo $V->t_room_preference; ?></td>
                        <td><? if($V->t_hotelid==1) echo "Renaissance"; elseif($V->t_hotelid==2) echo "Kohinoor"; else echo "Not Set"; ?></td>
                        <td align="center" style="vertical-align:middle; background-color:<?=$type_color;?>">
			<img src="images/view_icon.png" border="0" alt="View" title="View" class="actionimg" style="cursor:pointer" onclick="show_viewdetails('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/edit_icon.png" border="0" alt="Edit" title="Edit" class="actionimg" style="cursor:pointer" onclick="showreg('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/itinerary.png" border="0" title="Itinerary Details" alt="Itinerary Details" onClick="showItinerary('<?=$V->id?>','<?=$_POST['type']?>')" style="cursor:pointer;" />
            			</td>
                    </tr>
                    <? } ?>
                    <? if($V->n_is_accommodation=='Y') { ?>
                    <tr bgcolor="<?=$rowbgColor?>">	<td align="center"><?=($cnt)?></td>
                    	<td align="center"><?=$V->id?></td>
                        <td><b><?=$V->n_prefix.' '.$V->n_firstname.' '.$V->n_lastname?> (Nurse)</b></td>
                        <td><?=$V->n_mobile?></td>
                        <td><?=$V->couponname?></td>
                        <td><? if($V->n_room_preference=='' || $V->room_preference=='N/A') echo "Not Set"; else echo $V->n_room_preference; ?></td>
                        <td><? if($V->n_hotelid==1) echo "Renaissance"; elseif($V->n_hotelid==2) echo "Kohinoor"; else echo "Not Set"; ?></td>
                        <td align="center" style="vertical-align:middle; background-color:<?=$type_color;?>">
			<img src="images/view_icon.png" border="0" alt="View" title="View" class="actionimg" style="cursor:pointer" onclick="show_viewdetails('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/edit_icon.png" border="0" alt="Edit" title="Edit" class="actionimg" style="cursor:pointer" onclick="showreg('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/itinerary.png" border="0" title="Itinerary Details" alt="Itinerary Details" onClick="showItinerary('<?=$V->id?>','<?=$_POST['type']?>')" style="cursor:pointer;" />
            			</td>
                    </tr>
                    <? } ?>
                    <? } else { ?>
                    <tr bgcolor="<?=$rowbgColor?>">	<td align="center"><?=($cnt)?></td>
                    	<td align="center"><?=$V->id?></td>
                        <td><b><?=$V->prefix.' '.$V->firstname.' '.$V->lastname?> (<?=$V->registration_type?>)</b></td>
                        <td><?=$V->mobile?></td>
                        <td><?=$V->couponname?></td>
                        <td><? if($V->room_preference=='' || $V->room_preference=='N/A') echo "Not Set"; else echo $V->room_preference; ?></td>
                        <td><? if($V->hotelid==1) echo "Renaissance"; elseif($V->hotelid==2) echo "Kohinoor"; else echo "Not Set"; ?></td>
                        <td align="center" style="vertical-align:middle; background-color:<?=$type_color;?>">
			<img src="images/view_icon.png" border="0" alt="View" title="View" class="actionimg" style="cursor:pointer" onclick="show_viewdetails('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/edit_icon.png" border="0" alt="Edit" title="Edit" class="actionimg" style="cursor:pointer" onclick="showreg('<?=$V->id?>','<?=$_POST['type']?>')"/>
            <img src="images/itinerary.png" border="0" title="Itinerary Details" alt="Itinerary Details" onClick="showItinerary('<?=$V->id?>','<?=$_POST['type']?>')" style="cursor:pointer;" />
            			</td>
                    </tr>
                    <? } ?>
		<?		}
				
			}} ?>
			</table>
	<?
	exit();	
	}
	
	if($_POST['act']=='func_showRegStat'){
		ob_clean();
			$rs_Dtl = Registration::getDateofArrival();
			if(count($rs_Dtl)>0){ ?>
				<table width="100%" border="0" cellspacing="4" cellpadding="4">
                	<?
					if($_POST['seltab']=='Y'){
						$totalRoomsR=0; $totalRoomsK=0;
					 foreach($rs_Dtl as $K=>$V){
						$member_total = Registration::getMemberCount($V->dateofarrival,$_POST['seltab']);	
						$t_member_total = Registration::getTechnicianMemberCount($V->dateofarrival,$_POST['seltab']);	
						$n_member_total = Registration::getNurseMemberCount($V->dateofarrival,$_POST['seltab']);
							
						$rs_renaissance = Accommodation::getBookedRoomsCount('1', $V->dateofarrival);
						$rs_kohinoor = Accommodation::getBookedRoomsCount('2', $V->dateofarrival);
						$total = $member_total->FA+$member_total->CA+$member_total->IP+$member_total->PG+$member_total->ST_CA+$t_member_total->TECH+$n_member_total->NURSE;
						$totalRenaissance = $rs_renaissance->Single+$rs_renaissance->Twin;
						$totalKohinoor = $rs_kohinoor->Single+$rs_kohinoor->Twin;
						$totalRoomsR += $totalRenaissance;
						if($totalRoomsR==0) { $totalRoomsR = ''; } else { $totalRoomsR = $totalRoomsR; }
						$totalRoomsK += $totalKohinoor;
						if($totalRoomsK==0) { $totalRoomsK = ''; } else { $totalRoomsK = $totalRoomsK; }
					?>
                  <tr>
                  <? if($total>0) { ?>
                  	<td align="left" width="60%">
                    	<table width="98%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border:1px #999 solid; margin-bottom:20px;">
                          <tr bgcolor="#0099FF" style="color:#FFF; font-weight:bold">
                            <td width="193" rowspan="2" align="center" bgcolor="#FF6600" style="font-size:24px;"><?=date('M d,Y',strtotime($V->dateofarrival))?></td>
                            <td width="104" height="33" align="center">FA</td>
                            <td width="104" align="center">CA</td>
                            <td width="104" align="center">IP</td>
                            <td width="104" align="center">PG</td>
                            <td width="104" align="center">ST-CA</td>
                            <td width="104" align="center">TECH</td>
                            <td width="104" align="center">NURSE</td>
                            <td width="104" align="center">TOTAL</td>
                          </tr>
                          <tr style="font-size:24px;">
                            <td height="36" align="center"><?=$member_total->FA?></td>
                            <td align="center"><?=$member_total->CA?></td>
                            <td align="center"><?=$member_total->IP?></td>
                            <td align="center"><?=$member_total->PG?></td>
                            <td align="center"><?=$member_total->ST_CA?></td>
                            <td align="center"><?=$t_member_total->TECH?></td>
                            <td align="center"><?=$n_member_total->NURSE?></td>
                            <td style="font-size:30px;" align="center"><?=$total?></td>
                          </tr>
                        </table>
                        
                    </td>
                    <td width="40%">
                    	<table width="99%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border:1px #999 solid; margin-bottom:20px;">
                          <tr bgcolor="#0099FF" style="color:#FFF; font-weight:bold">
                            <td align="center" colspan="3" style="border-right:1px solid #999;" height="25">Renaissance</td>
                            <td align="center" colspan="3">Kohinoor</td>
                          </tr>
                          <tr style="font-size:20px; color:#fff;" bgcolor="#FF6600">
                          	<td width="13%" align="center">S</td>
                            <td width="16%" align="center">TW</td>
                            <td width="22%" align="center" style="border-right:1px solid #999;">Total</td>
                            <td width="13%" align="center">S</td>
                            <td width="15%" align="center">TW</td>
                            <td width="21%" align="center" style="border-right:1px solid #999;">Total</td>
                          </tr>
                          <tr style="font-size:20px;">
                            <td width="13%" align="center"><span style="cursor:pointer; text-decoration:underline;" onclick="openAccommodationPopup('1', 'S', '<?=$V->dateofarrival?>')"><?=$rs_renaissance->Single?></span></td>
                            <td width="16%" align="center"><span style="cursor:pointer; text-decoration:underline;" onclick="openAccommodationPopup('1', 'TW', '<?=$V->dateofarrival?>')"><?=$rs_renaissance->Twin?></span></td>
                            <td width="22%" align="center" style="border-right:1px solid #999;"><b><?=$totalRenaissance?> (<?=$totalRoomsR?>)</b></td>
                            <td width="13%" align="center"><span style="cursor:pointer; text-decoration:underline;" onclick="openAccommodationPopup('2', 'S', '<?=$V->dateofarrival?>')"><?=$rs_kohinoor->Single?></span></td>
                            <td width="15%" align="center"><span style="cursor:pointer; text-decoration:underline;" onclick="openAccommodationPopup('2', 'TW', '<?=$V->dateofarrival?>')"><?=$rs_kohinoor->Twin?></span></td>
                            <td width="21%" align="center" style="border-right:1px solid #999;"><b><?=$totalKohinoor?> (<?=$totalRoomsK?>)</b></td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                  <? } } }else{
					  	$member_total = Registration::getMemberCount('',$_POST['seltab']);	
						$t_member_total = Registration::getTechnicianMemberCount('',$_POST['seltab']);	
						$n_member_total = Registration::getNurseMemberCount('',$_POST['seltab']);
					   ?>
                  <tr>
                  	<td align="center">
                    	<table width="90%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border:1px #999 solid; margin-bottom:20px;">
                          <tr bgcolor="#0099FF" style="color:#FFF; font-weight:bold">
                            <td width="104" height="33" align="center">FA</td>
                            <td width="104" align="center">CA</td>
                            <td width="104" align="center">IP</td>
                            <td width="104" align="center">PG</td>
                            <td width="104" align="center">ST-CA</td>
                            <td width="104" align="center">TECH</td>
                            <td width="104" align="center">NURSE</td>
                            <td width="104" align="center">TOTAL</td>
                          </tr>
                          <tr style="font-size:24px;">
                            <td height="36" align="center"><?=$member_total->FA?></td>
                            <td align="center"><?=$member_total->CA?></td>
                            <td align="center"><?=$member_total->IP?></td>
                            <td align="center"><?=$member_total->PG?></td>
                            <td align="center"><?=$member_total->ST_CA?></td>
                            <td align="center"><?=$t_member_total->TECH?></td>
                            <td align="center"><?=$n_member_total->NURSE?></td>
                            <td style="font-size:30px;" align="center"><?=$member_total->FA+$member_total->CA+$member_total->IP+$member_total->PG+$member_total->ST_CA+$t_member_total->TECH+$n_member_total->NURSE?></td>
                          </tr>
                        </table></td>
                  </tr>
                  <? } ?>
				</table>
	<?		} 
			$rs_departure = Registration::getDateofDeparture();
			
		exit();
	}
	
	if($_POST['act']=='fn_UpdateWorkshop'){
		
		ob_clean();
			
			if($_POST['d1workshop1']=='N'){
				$_POST['ws1'] = '';
			}
			if($_POST['d1workshop2']=='N'){
				$_POST['ws2'] = '';
			}
			if($_POST['day1_workshoptype']=='BLS'){
				
				$_POST['ws1'] = '';
				$_POST['ws2'] = '';
			
			}
			if($_POST['d1workshop1']=='N' && $_POST['d1workshop2']=='N' && $_POST['day1_workshoptype']=='WS'){
				$_POST['day1_workshoptype']='';
			}
			
			if($_POST['d2workshop3']=='N'){
				$_POST['ws3'] = '';
			}
			if($_POST['d2workshop4']=='N'){
				$_POST['ws4'] = '';
			}
			
			if($_POST['day2_workshoptype']=='ACLS'){
				
				$_POST['ws3'] = '';
				$_POST['ws4'] = '';
			
			}
			if($_POST['d2workshop3']=='N' && $_POST['d2workshop4']=='N' && $_POST['day2_workshoptype']=='WS'){
				$_POST['day2_workshoptype']='';
			}
			
			if($_POST['whom']=='Doctor'){
				
				$user_obj = new Users(); 
				$user_obj->day1_workshoptype = $_POST['day1_workshoptype'];
				$user_obj->ws1 = $_POST['ws1'];
				$user_obj->ws2 = $_POST['ws2'];
				$user_obj->day2_workshoptype = $_POST['day2_workshoptype'];
				$user_obj->ws3 = $_POST['ws3'];
				$user_obj->ws4 = $_POST['ws4'];
				$user_obj->id =$_POST['reg_id'];
				$user_obj->update_workshop();
				
			}elseif($_POST['whom']=='Technician'){
				
				$user_obj = new Users();
				$user_obj->t_day1_workshoptype = $_POST['day1_workshoptype'];
				$user_obj->t_ws1 = $_POST['ws1'];
				$user_obj->t_ws2 = $_POST['ws2'];
				$user_obj->t_day2_workshoptype = $_POST['day2_workshoptype'];
				$user_obj->t_ws3 = $_POST['ws3'];
				$user_obj->t_ws4 = $_POST['ws4'];
				$user_obj->id =$_POST['reg_id'];
				$user_obj->update_t_workshop();
				
			}elseif($_POST['whom']=='Nurse'){
				
				$user_obj = new Users();
				$user_obj->n_day1_workshoptype = $_POST['day1_workshoptype'];
				$user_obj->n_ws1 = $_POST['ws1'];
				$user_obj->n_ws2 = $_POST['ws2'];
				$user_obj->n_day2_workshoptype = $_POST['day2_workshoptype'];
				$user_obj->n_ws3 = $_POST['ws3'];
				$user_obj->n_ws4 = $_POST['ws4'];
				$user_obj->id =$_POST['reg_id'];
				$user_obj->update_n_workshop();
				
			}
	
			
		exit();
	}
	
		
	if($_POST['act']=='fn_showWorkshopDtl'){
		
		ob_clean();
		
		$obj = new Users();
		$obj->id=$_POST['reg_id'];
		$rs_UserDtl = $obj->getNewUserDtl();
		
		if($_POST['whom']=='Doctor'){
			$day1_workshoptype = $rs_UserDtl->day1_workshoptype;
			$ws1 = $rs_UserDtl->ws1;
			$ws2 = $rs_UserDtl->ws2;
			$day2_workshoptype = $rs_UserDtl->day2_workshoptype;
			$ws3 = $rs_UserDtl->ws3;
			$ws4 = $rs_UserDtl->ws4;
			
		}elseif($_POST['whom']=='Technician'){
			
			$day1_workshoptype = $rs_UserDtl->t_day1_workshoptype;
			$ws1 = $rs_UserDtl->t_ws1;
			$ws2 = $rs_UserDtl->t_ws2;
			$day2_workshoptype = $rs_UserDtl->t_day2_workshoptype;
			$ws3 = $rs_UserDtl->t_ws3;
			$ws4 = $rs_UserDtl->t_ws4;
		}elseif($_POST['whom']=='Nurse'){
			
			$day1_workshoptype = $rs_UserDtl->n_day1_workshoptype;
			$ws1 = $rs_UserDtl->n_ws1;
			$ws2 = $rs_UserDtl->n_ws2;
			$day2_workshoptype = $rs_UserDtl->n_day2_workshoptype;
			$ws3 = $rs_UserDtl->n_ws3;
			$ws4 = $rs_UserDtl->n_ws4;
		}
			
		?>	
		<table width="100%" border="0" class="reg_det_tbl" style="border-right:1px solid #b8b8b8;">

         <tr>
			<td  colspan="2"class="reg_det_popup_hd">
				<div id="workshop_closebtn" style="position: relative; top:0; float:right; margin-left:15px;" class="popup_closebtn" title="Close">X</div>
                <span style="float:center;"><?=$_POST['whom']?>&nbsp;&nbsp;-&nbsp;&nbsp;Workshop Registration</span>
			</td>
		  </tr>
          <tr>
          	<td colspan="2"><? include "optworkshop.php"; ?></td>
          </tr>
          
    	 <tr>
            <td colspan="2" align="left">
                <img src="images/update_btn.jpg" border="0" style="cursor:pointer" onclick="submit_workshop('<?=$_POST['reg_id']?>','<?=$_POST['type']?>','<?=$_POST['page']?>','<?=$_POST['whom']?>')"/>
  		  </tr>                
          
         </table>
		
        <script type="text/javascript">
		$('#workshop_closebtn').click(function(){
			$("#workshop_popup").dialog('close');
		});
		
		<? if($ws1!=''){ ?>
		showD1W1Hall();
		<? } ?>
		
		<? if($ws2!=''){ ?>
		showD1W2Hall();
		<? } ?>
		
		<? if($ws3!=''){ ?>
		showD2W3Hall();
		<? } ?>
		
		<? if($ws4!=''){ ?>
		showD2W4Hall();
		<? } ?>
		<? if($day1_workshoptype!=''){ ?>
		showDay1WorkShop();
		<? } ?>
		<? if($day2_workshoptype!=''){ ?>
		showDay2WorkShop();
		<? } ?>
		
		//showD1W2Hall();
		
		
		function showD1W2Hall(){
			
			if($('input[name=d1workshop2]:checked').val()=='Y'){
				$('#day1_w2_hall_div').show();
			}else{
				$('#day1_w2_hall_div').hide();
			}
		}
		
		//showD1W1Hall();
		
		function showD1W1Hall(){
			
			if($('input[name=d1workshop1]:checked').val()=='Y'){
				$('#day1_w1_hall_div').show();
			}else{
				$('#day1_w1_hall_div').hide();
			}
		}

		
		function showDay1WorkShop(){
		
			if($('input[name=day1_workshoptype]:checked').val()=='WS'){
				
				$('#day1_w1_div').show();
				$('#day1_w2_div').show();
				showD1W1Hall();
				showD1W2Hall();
			}else{
				
				$('#day1_w1_div').hide();
				$('#day1_w2_div').hide();
				$('#day1_w1_hall_div').hide();
				$('#day1_w2_hall_div').hide();
			}
		}
		
		//showD2W3Hall();
		
		function showD2W3Hall(){
			
			if($('input[name=d2workshop3]:checked').val()=='Y'){
				$('#day2_w3_hall_div').show();
			}else{
				$('#day2_w3_hall_div').hide();
			}
		}
		
		//showD2W4Hall();
		
		function showD2W4Hall(){
			
			if($('input[name=d2workshop4]:checked').val()=='Y'){
				$('#day2_w4_hall_div').show();
			}else{
				$('#day2_w4_hall_div').hide();
			}
		}
		
		//showDay2WorkShop();
		
		function showDay2WorkShop(){
			
			if($('input[name=day2_workshoptype]:checked').val()=='WS'){
				
				$('#day2_w3_div').show();
				$('#day2_w4_div').show();
				showD2W3Hall();
				showD2W4Hall();
			}else{
				
				$('#day2_w3_div').hide();
				$('#day2_w4_div').hide();
				$('#day2_w3_hall_div').hide();
				$('#day2_w4_hall_div').hide();
			}
		}
		
		function submit_workshop(reg_id,type,page,whom){
			
			var err=0;
			
			if($('input[name=day1_workshoptype]:checked').val()=='WS'){
				
				if(!$('input[name=d1workshop1]:checked').val() && !$('input[name=d1workshop2]:checked').val()){
					err=1;
					alert('choose any one workshop type for day1');
				}else{
					
					if($('input[name=d1workshop1]:checked').val()){
						
						if(!$('input[name=ws1]:checked').val()){
							
							err=1;
							alert('choose any one hall for day1');
						}
					
					}
					
					
					if($('input[name=d1workshop2]:checked').val()){
						
						if(!$('input[name=ws2]:checked').val()){
							
							err=1;
							alert('choose any one hall for day1');
						}
					
					}
					
					
				}
				
			}
			
			
			if($('input[name=day2_workshoptype]:checked').val()=='WS'){
				
				if(!$('input[name=d2workshop3]:checked').val() && !$('input[name=d2workshop4]:checked').val()){
					err=1;
					alert('choose any one workshop type for day2');
				}else{
					
					if($('input[name=d2workshop3]:checked').val()){
						
						if(!$('input[name=ws3]:checked').val()){
						
							err=1;
							alert('choose any one hall for day2');
						}
						
					}
					
					if($('input[name=d2workshop4]:checked').val()){
						
						if(!$('input[name=ws4]:checked').val()){
						
							err=1;
							alert('choose any one hall for day2');
						}
						
					}
					
					
					
				}
				
			}
			
			if($('input[name=day1_workshoptype]:checked').val()=='BLS'){
				var day1_workshoptype = 'BLS';
			}else{
				var day1_workshoptype = 'WS';
			}
			if($('input[name=d1workshop1]:checked').val()){
				var d1workshop1 = 'Y';
			}else{
				var d1workshop1 = 'N';
			}
			var ws1 = $('input[name=ws1]:checked').val();
			
			if($('input[name=d1workshop2]:checked').val()){
				var d1workshop2 = 'Y';	
			}else{
				var d1workshop2 = 'N';
			}
			var ws2 = $('input[name=ws2]:checked').val();
			
			
			if($('input[name=day2_workshoptype]:checked').val()=='ACLS'){
				var day2_workshoptype = 'ACLS';	
			}else{
				var day2_workshoptype = 'WS';
			}
			if($('input[name=d2workshop3]:checked').val()){
				var d2workshop3 = 'Y';	
			}else{
				var d2workshop3 = 'N';
			}
			var ws3 = $('input[name=ws3]:checked').val();
		
			if($('input[name=d2workshop4]:checked').val()){
				var d2workshop4 = 'Y';	
			}else{
				var d2workshop4 = 'N';
			}
			var ws4 = $('input[name=ws4]:checked').val();
			
			
			
			if(err==0){
				
				
				ajax({
					a:'dashboard',
					b:'act=fn_UpdateWorkshop&reg_id='+reg_id+'&day1_workshoptype='+day1_workshoptype+'&d1workshop1='+d1workshop1+'&ws1='+ws1+'&d1workshop2='+d1workshop2+'&ws2='+ws2+'&day2_workshoptype='+day2_workshoptype+'&d2workshop3='+d2workshop3+'&ws3='+ws3+'&d2workshop4='+d2workshop4+'&ws4='+ws4+'&page='+page+'&whom='+whom,
					c:function(){},
					d:function(data){
						//alert(data);
						$("#workshop_popup").dialog('close');
						show_reg_tab(type);
					 }
				});
				
					
			}
				
		}

		</script>
        <?
		exit();
	}
	
	if($_POST['act']=='fn_updateregtype'){
		ob_clean();
		
		$reg_obj = new Registration();
		$reg_obj->id = $_POST['reg_id'];
		$rs_UserDtl = $reg_obj->getRegDtl();
		
		if($_POST['Fac_searchTxtId']>0 && $_POST['registration_type'] =='FA') {
			$facObj = new Faculty();
			$facObj->id=$_POST['Fac_searchTxtId'];
			$fac_dtls = $facObj->getFacultyDtl();
			
			if($rs_UserDtl->registration_type == 'ST') {
				$reg_obj                    = new Registration();
				$reg_obj->id 				= $_POST['reg_id'];
				$reg_obj->isfaculty         = 'Y';
				$reg_obj->registration_type = $rs_UserDtl->registration_type;
				//$reg_obj->registration_type = $_POST['registration_type'];
				$reg_obj->facultyid         = $_POST['Fac_searchTxtId'];
				$ra_update_facreg = $reg_obj->update_facreg();
			}
		}
		
		$rs_Update_regtype = $reg_obj->update_regtype();
		
		ob_start();
			$fileName= 'registrationtypeupdate_thankyoumail.php';
			include "mail_template.php";
			$MailContent = ob_get_contents();
		 ob_end_clean();
			
			$From       = "kavitharjn@stemiindia2014.com";
			$fromName  = "Online Co-ordinator";
			$Subject    = "[STEMI INDIA 2014] Your registration Type has been updated";
			//$emailAddress = 'kavitharjn@gmail.com';
			//$emailAddress = 'karthiinfotech@gmail.com';
			$emailAddress = $reg_obj->emailaddress;
			 include "sendgrid.php";
		exit();
		
	}
 	
	if($_POST['act']=='fn_showTypeDetails'){
		ob_clean();

		$reg_obj = new Registration();
		$reg_obj->id = $_POST['reg_id'];
		$rs_UserDtl = $reg_obj->getRegDtl();
		
		if($rs_UserDtl->registration_type=='CA'){ $rs_category = 'Cardiologist'; }elseif($rs_UserDtl->registration_type=='ST'){ $rs_category = 'STEMI team'; }elseif($rs_UserDtl->registration_type=='PG') { $rs_category = 'PG - Student'; }elseif($rs_UserDtl->registration_type=='IP') { $rs_category = 'Industry Partner'; }elseif($rs_UserDtl->registration_type=='FA') { $rs_category = 'Faculty'; }
			?>
            <input type="hidden" id="reg_id" name="reg_id" value="<?=$rs_UserDtl->id?>" />
            <input type="hidden" id="page" name="page" value="<?=$_POST['page']?>"/>
            <input type="hidden" id="type" name="type" value="<?=$_POST['type']?>"/>
            
	<table width="100%" border="0" class="reg_det_tbl" style="border-right:1px solid #b8b8b8;">

         <tr>
			<td  colspan="2"class="reg_det_popup_hd">
				<div id="type_det_popup_closebtn" style="position: relative; top:0; float:right; margin-left:15px;" class="popup_closebtn" title="Close">X</div>
				<span style="float:center;">Now You Are belong to &nbsp;<span style="color:#FF3"><?=$rs_category?></span>&nbsp;Type</span>
			</td>
		  </tr>
          <tr>
            <td width="12%" align="right">Choose Type</td>
            <td width="33%">
                <select class="listbox1" style="width:270px;" id="registration_type" name="registration_type" onchange="showStemiTeams(this.value)">
                <option value="">--Select Type--</option>
                <option value="CA">Cardiologist </option>
                <option value="ST">Stemi Teams </option>
                <option value="PG">PG - Student </option>
                <option value="IP">Industry Partner </option>
                <option value="FA">Faculty </option>
                </select>
            </td>
  		  </tr>
          <tr id="showStemiTeams" style="display:none">
          	<td colspan="2">
			<table style="margin-bottom:10px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="2" class="boldtxt" style="padding-bottom:15px;"><u> ER Physician</u></td>
                  </tr>
				  <tr>
                    <td width="41%" align="right">
                    <span style="margin-right:10px; float:left">&nbsp;
                        <select class="listbox1" style="width:80px; float:none" id="t_prefix" name="t_prefix">
						<option value="">--Prefix---</option>
						<option value="Mr">Mr</option>
						<option value="Mrs">Mrs.</option>
						<option value="Ms">Ms.</option>
						<option value="Miss">Miss.</option>                        
						</select>
                   </span>                    
                    <span style="padding-right:15px;">Name</span></td>
                    <td width="59%"><input type="text" style="width:270px;" class="txtbox2" id="t_firstname" name="t_firstname" /></td>
                  </tr>
				   <tr>
                    <td align="right" style="padding-right:15px;">Gender</td>
                    <td>
                    	<span style="margin-right:10px;"><input type="radio" id="t_gender" name="t_gender" value="M"/> Male</span>
                    	<span><input type="radio" id="t_gender" name="t_gender" value="F" /> Female</span></td>
                  </tr>
				   <tr>
                    <td align="right" style="padding-right:15px;">Email</td>
                    <td><input type="text" style="width:270px;" class="txtbox2" id="t_emailaddress" name="t_emailaddress" onblur="checkPhysicianmail()" />&nbsp;<span id="temaildiv" style="color:#F00"></span><span id="temailerror" style="color:#F00"><?=$temailerrormsg?></span></td>
                  </tr>
                  <tr>
                   <td align="right" style="padding-right:15px;">Mobile Number</td>
                    <td><input type="text" style="width:270px;" class="txtbox2" id="t_mobile" name="t_mobile" onkeypress="return isNumberKey(event)"/></td>
                  </tr>
				   <tr>
                    <td colspan="2" class="boldtxt" style="padding-bottom:15px;padding-right:15px;"><u>Nurse</u></td>
                  </tr>
				  <tr>
                    <td width="41%" align="right">
                    <span style="margin-right:10px; float:left;padding-right:15px;">&nbsp;
                        <select class="listbox1" style="width:80px; float:none" id="n_prefix" name="n_prefix">
						<option value="">--Prefix---</option>
						<option value="Mr">Mr</option>
						<option value="Mrs">Mrs.</option>
						<option value="Ms">Ms.</option>
						<option value="Miss">Miss.</option>                        
						</select>
                   </span>                    
                    <span style="padding-right:15px;">Name</span></td>
                    <td width="59%"><input type="text" style="width:270px;" class="txtbox2" id="n_firstname" name="n_firstname" /></td>
                  </tr>
				   <tr>
                    <td align="right" style="padding-right:15px;">Gender</td>
                    <td>
                    	<span style="margin-right:10px;"><input type="radio" id="n_gender" name="n_gender" value="M" /> Male</span>
                    	<span><input type="radio" id="gender2" name="n_gender" value="F" /> Female</span>                    </td>
                  </tr>
				   <tr>
                    <td align="right" style="padding-right:15px;">Email</td>
                    <td><input type="text" style="width:270px;" class="txtbox2" id="n_emailaddress" name="n_emailaddress" onblur="checkNursemail()"/>&nbsp;<span id="nemaildiv" style="color:#F00"></span><span id="nemailerror" style="color:#F00"><?=$nemailerrormsg?></span></td>
                  </tr>
                  <tr>
                   <td align="right" style="padding-right:15px;">Mobile Number</td>
                    <td><input type="text" style="width:270px;" class="txtbox2" id="n_mobile" name="n_mobile" onkeypress="return isNumberKey(event)"/></td>
                  </tr>
 	</table> 
    		</td>
         </tr>
		  <tr id="showFaculty" style="display:none">
          	<td colspan="2">
            	<table style="margin-bottom:10px;" width="100%" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                   <td width="12%" align="right">Faculty Name</td>
           		   <td width="33%">
              			<input type="text" style="width:270px;" class="txtbox2" id="Fac_searchTxt" name="Fac_searchTxt" />
                    	<input type="hidden" style="width:270px;" class="txtbox2" id="Fac_searchTxtId" name="Fac_searchTxtId" />
                   </td>
                  </tr>
                </table>
            </td>
          </tr>
          
    	 <tr>
            <td width="12%" align="right"></td>
            <td width="33%">
                <img src="images/update_btn.jpg" border="0" style="cursor:pointer" onclick="submit_type('<?=$_POST['type']?>','<?=$_POST['page']?>')"/>
            </td>
  		  </tr>                
          
         </table>
   <script type="text/javascript">
	 $().ready(function()
	 { 
		$("#Fac_searchTxt").autocomplete("faculty_search.php",{ 
			width:230,selectFirst: false,
			 select: function(event, ui) { alert(event); }});	
			$("#Fac_searchTxt").result(function(event, data, formatted) {
			$("#Fac_searchTxtId").val(data[1]);			
			
		});
		
	 });
   </script>              
                 
	<? exit();
	}
	
	if($_POST['act']=='fn_showViewDetails')
	{ 
		ob_clean();
			
		$rsRegDtl = Registration::getRegistrationById($_POST['reg_id']);
		if($rsRegDtl->registration_type=='FA') $regType='Faculty';
		else $regType = ($rsRegDtl->registration_type=='ST')?'STEMI Team':'Cardiologist';
		if($rsRegDtl->registration_type=='PG') $regType='PG Student';
		$paymentType='FREE';
		if($rsRegDtl->payment_type=='CC') $paymentType = 'CARD';
		
	
		
			?>
			<table width="960" border="0" cellspacing="0" cellpadding="0" class="reg_det_tbl">
		  <tr>
			<td class="reg_det_popup_hd">
				<div id="reg_det_popup_closebtn" style="position: relative; top:0; float:right; margin-left:15px;" class="popup_closebtn" title="Close">X</div>
				Registration Details <span style="float:right;"><?=$regType?></span>
			</td>
		  </tr>
		  <tr>
			<td bgcolor="#cccccc">
			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="reg_det_innertbl">
				  <tr>
					<td width="33%" valign="top" class="reg_bdr_right">
					
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="38%" class="boldtxt" align="right">Reg ID :</td>
							<td width="62%"><?=$rsRegDtl->id?></td>
						  </tr>
						  <tr>
							<td class="boldtxt" align="right">Date of Reg :</td>
							<td><?=date('d M,Y',strtotime($rsRegDtl->created_date))?></td>
						  </tr>
						</table>
						
					</td>
					<td width="35%" valign="top" class="reg_bdr_right">
	
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="31%" align="right" class="boldtxt">Email :</td>
							<td width="69%"><?=$rsRegDtl->emailaddress?></td>
						  </tr>
						  <tr>
							<td class="boldtxt" align="right">Password :</td>
							<td><?=$rsRegDtl->password?></td>
						  </tr>
						</table>
						
					</td>
					<td width="32%" valign="top">
	
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td width="47%" align="right" class="boldtxt" style="padding-bottom:100px;">Contact Details</td>
							<td width="53%">
							  <?=$rsRegDtl->organization?><?=$rsRegDtl->address?><br /><?=$rsRegDtl->city?><br /><?=$rsRegDtl->state?>-<?=$rsRegDtl->zipcode?>
							</td>
						  </tr>
						</table>
						
					</td>
				  </tr>
				</table>
			
			</td>
		  </tr>
		  <tr>
			<td>
			
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="reg_det_innertbl">
				  <tr>
					<td width="42%" valign="top"  >
					
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="personal_det_tbl">
						
						  <tr>
							<td width="39%" class="boldtxt"><u>Personal Details</u></td>
						  </tr>
						  <tr>
							<td> 
								<span class="boldtxt">Cardiologist / Physician</span><br/>
								<?=$rsRegDtl->prefix.' '.$rsRegDtl->firstname.' '.$rsRegDtl->lastname?><br />
								 <?=$rsRegDtl->mobile?></td>
								   
							  <td width="37%">Accommodation :
								   <? 
                                        if($rsRegDtl->is_accommodation=='Y') echo 'Yes';
                                        elseif($rsRegDtl->is_accommodation=='N') echo 'No';  	
                                        else echo 'Not Assigned';
                                    ?>
									 <br/>
                                     Accommodation Notes : 
								   <? 
                                        echo $rsRegDtl->accommodation_notes;
                                    ?><br />
									 Local Transport :
									 <? 
                                        if($rsRegDtl->local_transport=='Y') echo 'Yes';
                                        elseif($rsRegDtl->local_transport=='N') echo 'No';  	
                                        else echo 'Not Assigned';
                                    ?> <br/>
                                     Pickup & Drop :
									<? 
                                        if($rsRegDtl->pickupdrop=='Y') echo 'Yes';
                                        elseif($rsRegDtl->pickupdrop=='N') echo 'No';  	
                                        else echo 'Not Assigned';
                                    ?><br/>
                                    Room Preference :  <? 
                                        if($rsRegDtl->room_preference=='TW') echo 'Twin';
                                        elseif($rsRegDtl->room_preference=='S') echo 'Single';
										elseif($rsRegDtl->room_preference=='T') echo 'Triple';  	
                                        else echo 'Not Assigned';
                                    ?>
                                      </td>
						   </tr>
                          
                           <? if($rsRegDtl->book_flight=='Y'){?>
                           <tr>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                             <td>&nbsp;</td>
                           </tr>
                           <tr>
                             <td><strong>Arrival</strong></td>
                             
                             <td><strong>Departure</strong></td>
                           </tr>
                           <tr>
                             <td>Date/Time : <span style="padding-top:30px;">
                               <? if($rsRegDtl->dateofarrival == "1970-01-01" || $rsRegDtl->dateofarrival =="0000-00-00" ||  $rsRegDtl->dateofarrival =="1969-12-31"){
									 $dateofarrival = "--"; } else { $dateofarrival = date('d/m/y',strtotime($rsRegDtl->dateofarrival));}
									 if($rsRegDtl->arrivaltime == ': AM' || $rsRegDtl->arrivaltime == '' || $rsRegDtl->arrivaltime == 'undefined:undefined undefined' || $rsRegDtl->arrivaltime == ': undefined'){ 
									 $arrivaltime  = "--";} else{ $arrivaltime = $rsRegDtl->arrivaltime;} 
									 
									 echo $dateofarrival.'&nbsp&nbsp&nbsp;'.$arrivaltime;?>
                             </span></td>
                             
                             <td>Date/Time : <span style="padding-top:30px;">
                               <? if($rsRegDtl->dateofdeparture == "1970-01-01" || $rsRegDtl->dateofdeparture == "0000-00-00" || $rsRegDtl->dateofdeparture =="1969-12-31"){
									 $dateofdeparture = "--"; } else { $dateofdeparture = date('d/m/y',strtotime($rsRegDtl->dateofdeparture));}
									 if($rsRegDtl->departuretime == ': AM' || $rsRegDtl->departuretime == '' || $rsRegDtl->departuretime == 'undefined:undefined undefined' || $rsRegDtl->departuretime == ': undefined'){ 
									 $departuretime  = "--";} else{ $departuretime = $rsRegDtl->departuretime;} 
									 echo $dateofdeparture.'&nbsp&nbsp&nbsp;'.$departuretime?>
                             </span></td>
                           </tr>
                           <tr>
                             <td>Flight No : <?=$rsRegDtl->arrivalflightnumber?></td>
                              
                             <td>Flight No : <?=$rsRegDtl->departureflightnumber?></td>
                           </tr>
                           <tr>
                             <td> Airline Name : <?=$rsRegDtl->arrivalflightname?></td>
                            
                             <td>Airline Name : <?=$rsRegDtl->departureflightname?></td>
                           </tr>
						   <? } else {?>
                           <tr>
                             <td>Check In : <span style="padding-top:30px;">
                               <? if($rsRegDtl->dateofarrival == "1970-01-01" || $rsRegDtl->dateofarrival =="0000-00-00" ||  $rsRegDtl->dateofarrival =="1969-12-31"){
									 $dateofarrival = "--"; } else { $dateofarrival = date('d/m/y',strtotime($rsRegDtl->dateofarrival));}
									 if($rsRegDtl->arrivaltime == ': AM' || $rsRegDtl->arrivaltime == '' || $rsRegDtl->arrivaltime == 'undefined:undefined undefined' || $rsRegDtl->arrivaltime == ': undefined'){ 
									 $arrivaltime  = "--";} else{ $arrivaltime = $rsRegDtl->arrivaltime;} 
									 
									 echo $dateofarrival.'&nbsp&nbsp&nbsp;'.$arrivaltime;?>
                             </span></td>
                             <td>Check Out : <span style="padding-top:30px;">
                               <? if($rsRegDtl->dateofdeparture == "1970-01-01" || $rsRegDtl->dateofdeparture == "0000-00-00" || $rsRegDtl->dateofdeparture =="1969-12-31"){
									 $dateofdeparture = "--"; } else { $dateofdeparture = date('d/m/y',strtotime($rsRegDtl->dateofdeparture));}
									 if($rsRegDtl->departuretime == ': AM' || $rsRegDtl->departuretime == '' || $rsRegDtl->departuretime == 'undefined:undefined undefined' || $rsRegDtl->departuretime == ': undefined'){ 
									 $departuretime  = "--";} else{ $departuretime = $rsRegDtl->departuretime;} 
									 echo $dateofdeparture.'&nbsp&nbsp&nbsp;'.$departuretime?>
                             </span></td>
                             <td>&nbsp;</td>
                           </tr>
                           <? }?>
                           
                           
                           
                           
                           
						  <?
						  if($regType=='STEMI Team') {
						  ?>
						 
						  <tr>
							<td>
								<span class="boldtxt">ER Physician</span><br/>
								<?=$rsRegDtl->t_prefix.' '.$rsRegDtl->t_firstname.' '.$rsRegDtl->t_lastname?><br />
								 <?=$rsRegDtl->t_mobile?></td>
							<td><span style="padding-top:30px;">Check In :
							 <? if($rsRegDtl->t_dateofarrival == "1970-01-01" || $rsRegDtl->t_dateofarrival == "0000-00-00" || $rsRegDtl->t_dateofarrival =="1969-12-31"){
									 $t_dateofarrival = "--"; } else { $t_dateofarrival = date('d/m/y',strtotime($rsRegDtl->t_dateofarrival));}
									 if($rsRegDtl->t_arrivaltime == ': AM' || $rsRegDtl->t_arrivaltime == '' || $rsRegDtl->t_arrivaltime == 'undefined:undefined undefined' || $rsRegDtl->t_arrivaltime == ': undefined'){ 
									 $t_arrivaltime  = "--";} else{ $t_arrivaltime =$rsRegDtl->t_arrivaltime;} 
									 echo $t_dateofarrival.'&nbsp&nbsp&nbsp;'.$t_arrivaltime;?>
								<br/>
								Check Out :
								 <? if($rsRegDtl->t_dateofdeparture == "1970-01-01" || $rsRegDtl->t_dateofdeparture == "0000-00-00" || $rsRegDtl->t_dateofdeparture =="1969-12-31"){
									$t_dateofdeparture = "--"; } else { $t_dateofdeparture = date('d/m/y',strtotime($rsRegDtl->t_dateofdeparture));}
									if($rsRegDtl->t_departuretime == ': AM' || $rsRegDtl->t_departuretime == '' || $rsRegDtl->t_departuretime == ': undefined'){ 
									$t_departuretime  = "--";} else{ $t_departuretime = $rsRegDtl->t_departuretime;} 
									echo $t_dateofdeparture.'&nbsp&nbsp&nbsp;'.$t_departuretime?>
							</span></td>
							<td style="padding-top:30px;">Accommodation : <? 
                                        if($rsRegDtl->t_is_accommodation=='Y') echo 'Yes';
                                        elseif($rsRegDtl->t_is_accommodation=='N') echo 'No';  	
                                        else echo 'Not Assigned';
                                    ?><br/>
                                     Tech Accommodation Notes : <br />
								   <? 
                                        echo $rsRegDtl->t_accommodation_notes;
                                    ?><br />
                            Room Preference :   <? 
                                        if($rsRegDtl->t_room_preference=='TW') echo 'Twin';
                                        elseif($rsRegDtl->t_room_preference=='S') echo 'Single';
										elseif($rsRegDtl->t_room_preference=='T') echo 'Triple';  	
                                        else echo 'Not Assigned';
                                    ?></td>
						  </tr>
						  <tr>
							<td>
							<span class="boldtxt">Nurse</span><br/>
							<?=$rsRegDtl->n_prefix.' '.$rsRegDtl->n_firstname.' '.$rsRegDtl->n_lastname?><br />
							 <?=$rsRegDtl->n_mobile?>
							</td>
							<td><span style="padding-top:30px;">Check In :
							  <? if($rsRegDtl->n_dateofarrival == "1970-01-01" || $rsRegDtl->n_dateofarrival == "0000-00-00" || $rsRegDtl->n_dateofarrival == "1969-12-31"){
								 $n_dateofarrival = "--"; } else { $n_dateofarrival = date('d/m/y',strtotime($rsRegDtl->n_dateofarrival));}
								 if($rsRegDtl->n_arrivaltime == ': AM' || $rsRegDtl->n_arrivaltime == '' || $rsRegDtl->n_arrivaltime == 'undefined:undefined undefined' || $rsRegDtl->n_arrivaltime == ': undefined'){ 
								 $n_arrivaltime  = "--";} else{ $n_arrivaltime = $rsRegDtl->n_arrivaltime;} 
								 echo $n_dateofarrival.'&nbsp&nbsp&nbsp;'.$n_arrivaltime?>
								 <br/>
								 Check Out :
								  <? if($rsRegDtl->n_dateofdeparture == "1970-01-01" || $rsRegDtl->n_dateofdeparture == "0000-00-00" || $rsRegDtl->n_dateofdeparture == "1969-12-31"){
								$n_dateofdeparture = "--"; } else { $n_dateofdeparture = date('d/m/y',strtotime($rsRegDtl->n_dateofdeparture));}
								if($rsRegDtl->n_departuretime == ': AM' || $rsRegDtl->n_departuretime == '' || $rsRegDtl->n_departuretime == 'undefined:undefined undefined' || $rsRegDtl->n_departuretime == ': undefined'){ 
								$n_departuretime  = "--";} else{ $n_departuretime = $rsRegDtl->n_departuretime;} 
								echo $n_dateofdeparture.'&nbsp&nbsp&nbsp;'.$n_departuretime?>
							 </span>
							</td>
								 <td style="padding-top:30px;">Accommodation : <? 
                                        if($rsRegDtl->n_is_accommodation=='Y') echo 'Yes';
                                        elseif($rsRegDtl->n_is_accommodation=='N') echo 'No';  	
                                        else echo 'Not Assigned';
                                    ?>
                                 <br/>
                                  Nurse Accommodation Notes : <br />
								   <? 
                                        echo $rsRegDtl->n_accommodation_notes;
                                    ?><br />
                            Room Preference : <? 
                                        if($rsRegDtl->n_room_preference=='TW') echo 'Twin';
                                        elseif($rsRegDtl->n_room_preference=='S') echo 'Single';
										elseif($rsRegDtl->n_room_preference=='T') echo 'Triple';  	
                                        else echo 'Not Assigned';
                                    ?>
									</td>
						  </tr>
						 <?
						  }
						 ?>
						</table>
					
					</td>
				   
				  </tr>
				</table>
	
			</td>
		  </tr>
		  <tr>
			<td valign="top" style="border-top:1px solid #ccc;">
			<?
			if($rsRegDtl->paid=='Y') {
			?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="reg_det_innertbl1">
				  <tr>
					<td colspan="2" class="boldtxt"><u>Payment Details</u></td>
				  </tr>
				  <tr>
					<td width="42%" class="reg_bdr_right">Payment Type : <span class="boldtxt"><?=$paymentType?></span> <? if($rsRegDtl->couponname!=''){ ?>(<span><?=$rsRegDtl->couponname?></span>)<? } ?></td>
					<td width="58%">Total Amount Paid : <span class="boldtxt">Rs.<?=number_format($rsRegDtl->totalamount,2)?></span></td>
				  </tr>
				</table>
		   <?
			} else {
		   ?> 
		   Not Yet Paid
		   <?
			}
		   ?>
			</td>
		  </tr>
	 
		   <tr>
			<td valign="top" style="border-top:1px solid #ccc;">
			<?
			if($rsRegDtl->pcompanyname!='' || $rsRegDtl->coupon_sponsorid>0) {
				if($rsRegDtl->coupon_sponsorid>0) {
				   $rsSponsor = Sponsor::getSponsorsById($rsRegDtl->coupon_sponsorid);	
					$pcompanyname = $rsSponsor->CompanyName;
					$pcontactname = $rsSponsor->Name;
					$pemailaddress = $rsSponsor->EmailAddress;
				   
				} else {
					$pcompanyname = $rsRegDtl->pcompanyname;
					$pcontactname = $rsRegDtl->pcontactname;
					$pemailaddress = $rsRegDtl->pemailaddress;
				}
				$couponname = $rsRegDtl->couponname;
			?>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="reg_det_innertbl1">
				  <tr>
					<td colspan="2" class="boldtxt"><u>Partner Details</u></td>
				  </tr>
				  <tr>
					<td><?=$pcompanyname?><br />
					<?=$pcontactname?><br />
					<?=$pemailaddress?></td>
				  </tr>
				</table>
		   <?
			}  ?>
			</td>
		  </tr>
		<?php /*?>  <? if($rsRegDtl->dateofarrival!='0000-00-00' && $rsRegDtl->dateofarrival>0 && $rsRegDtl->dateofarrival!='1969-12-31' && $rsRegDtl->dateofarrival!='1970-01-01'){ ?>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="reg_det_innertbl1">
					  <tr>
						<td colspan="2" class="boldtxt"><u>Itinerary Details</u></td>
					  </tr>
					  <tr>
						<td>
							Date Of Arrival : <b><?=date('M d,Y',strtotime($rsRegDtl->dateofarrival))?></b><br />
							<? if($rsRegDtl->arrivaltime!=''){ ?>Arrival Time : <b><?=$rsRegDtl->arrivaltime?></b><br /><? } ?>
							Date Of Departure : <b><?=date('M d,Y',strtotime($rsRegDtl->dateofdeparture))?></b><br />
							<? if($rsRegDtl->departuretime!=''){ ?>Departure Time : <b><?=$rsRegDtl->departuretime?></b><? } ?>
						</td>
					  </tr>
					  
					</table>
				</td>
			</tr>
			<? } ?><?php */?>
		</table>
		  
			<?
			
		exit();
	}
	

if($_POST['act']=='func_showReg')
{
	ob_clean();	

		/*$rs_obj = new Registration();
		$rs_obj->type = $_POST['type'];
		
		if($_POST['filter_type']!=''){
			if($_POST['type']=='F' && $_POST['couponname']!='' && $_POST['couponname']!='undefined'){
				if($_POST['filter_type']=='CouponName'){
					$rs_obj->qry_couponnamestring = $_POST['couponname'];
				}
			}
			
			if($_POST['type']=='F' && $_POST['sponsorid']!='' && $_POST['sponsorid']!='undefined'){
				if($_POST['filter_type']=='CouponSponsor'){
					$rs_obj->qry_couponsponsorstring = $_POST['sponsorid'];
				}
			}
		}
		
		if($_POST['searchType']!=''){
			if($_POST['searchType']=='emailaddress'){
				$rs_obj->qry_emailstring = $_POST['searchTxt_emailaddress'];
			}
			
			if($_POST['searchType']=='name'){
				$rs_obj->qry_firstnamestring = $_POST['searchTxt'];
			}
	
			if($_POST['searchType']=='id'){ 
				$rs_obj->searchTxt_id = $_POST['searchTxt_id'];
			}
		}
		
		$rs_obj->sortby = 'desc';
		$rs_obj->orderby = 'id';
		$rsRegistrations = $rs_obj->getRegDtl();	
		
		
		if($_POST['page']=='')
		$page=1;
		else
		$page = $_POST['page'];
		$totalReg = count($rsRegistrations);
		$PageLimit= 100;
				
		$totalPages= ceil(($totalReg)/($PageLimit));
		if($totalPages==0) $totalPages=1;
		$StartIndex= ($page-1)*$PageLimit; 
			
		if(count($rsRegistrations)>0) $rsRegistrations_arr = array_slice($rsRegistrations,$StartIndex,$PageLimit,true);
			
		include "reg_details_ajax.php";*/
		
	exit();	
}
	
?>

<table width="100%" border="0" class="statisticstbl" cellpadding="0" cellspacing="0">
  <tr bgcolor="#7d7d7d">
    <td width="33%" style="color:#FFF; padding:10px;">Total Statistics</td>
    <td width="67%" align="right"></td>
    <td width="67%" align="right"></td>
  </tr>
  <tr>
    <td colspan="2">
        <table width="100%" border="0">
          <tr>
            <td width="43%">
                <table width="96%" border="0" class="statisticstbl1">
                  <tr>
                    <td width="40%" align="right">Total Registration : </td>
                    <td colspan="3">0</td>
                  </tr>
				  
					<tr>
						<td width="40%" align="right">Members : </td>
						<td width="11%">0</td>
						<td width="34%" align="right">PG - Student : </td>
						<td width="15%">0</td>
                    </tr>
                    
                </table>
            
            </td>
            <td width="35%">
            
                <table width="100%" border="0" class="statisticstbl2">
                  <tr>
                    <td width="61%" align="right">Faculty Registration : </td>
                    <td width="39%">0</td>
                  </tr>
                  <tr>
                    <td align="right">Sponsor  Registration : </td>
                    <td>0</td>
                  </tr>
                </table>
            
            </td>
            <td width="22%" align="center">
            
                <table width="45%" border="0" class="statisticstbl3">
                  <tr>
                    <td align="center" style="border-bottom:1px solid #9c9c9c;">Total Amount</td>
                  </tr>
                  <tr>
                    <td align="center">Rs.<?=number_format($rs_gettotalAmount->total,0);?> </td>
                  </tr>
                </table>
                
            </td>
          </tr>
        </table>
        
    </td>
  </tr>
</table>


<input type="hidden" name="page" id="page"  />
<input type="hidden" name="type" id="type" value="P" />

<table width="100%" border="0" style="margin-top:15px;" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <div id="dbtabP" class="dbtab dbtabactive" onclick="show_reg_tab('P')" >Paid Registration</div>
            <div id="dbtabF" class="dbtab" onclick="show_reg_tab('F')">Free Registration</div>
            <div id="dbtabI" class="dbtab" onclick="show_reg_tab('I')">Incomplete Registration</div>
            <? if($_SESSION['admin_type']!="EM") { ?>
            <div id="dbtabNA" class="dbtab" style="float:right;" onclick="show_non_accommodation('NA')">Non Accommodation List</div>
            <? } ?>
        </td>
    </tr>
    <tr>
        <td bgcolor="#dfdfdf" align="center" style="padding:10px 0" id="reg_details"></td>
    </tr>
 </table>
 
<div id="popup_reg" style="display:none;"></div>

<div id="reg_det_popup" style="display:none; padding:2px 1px; margin:0;"></div>

<div id="invoice_popup" style="display:none; padding:2px 1px; margin:0;"></div>

<div id="certificate_popup" style="display:none; padding:2px 1px; margin:0;"></div>

<div id="type_det_popup" style="display:none; padding:2px 1px; margin:0;"></div>

<div id="workshop_popup" style="display:none; padding:2px 1px; margin:0;"></div>

<div id="popup_itinerary" style="display:none; padding:2px; margin:0;"></div>

<div id="popup_delegates"></div>

<div id="popup_accommdation"></div>


<script type="text/javascript">
show_sta_reg_tab('Y');
function show_sta_reg_tab(seltab){ 
	
	$('.dbtabA').removeClass('dbtabactiveA');
	$('#dbtab'+seltab).addClass('dbtabactiveA');
	
	ajax({ 
			a:'dashboard',
			b:'act=func_showRegStat&seltab='+seltab,
			c:function(){},
			d:function(data){ //alert(data);
				$('#reg_statistics_details').html(data);
				
			}
		});
}

function show_reg_tab(seltab){ 

	var couponnameTxt = $('#couponnameTxt').val();
	var filter_type = $('#filter_type').val();
	var sponsorid = $('#sponsorid').val();
	var page = $('#page').val();
	var type = $('#type').val(seltab);
	
	$('.dbtab').removeClass('dbtabactive');
	$('#dbtab'+seltab).addClass('dbtabactive');
	
	ajax({ 
			a:'dashboard',
			b:'act=func_showReg&type='+seltab+'&couponname='+couponnameTxt+'&sponsorid='+sponsorid+'&filter_type='+filter_type+'&page='+page,
			c:function(){},
			d:function(data){ //alert(data);
				$('#reg_details').html(data);
				
			}
		});
}

function show_non_accommodation(type) {
	
	$('.dbtab').removeClass('dbtabactive');
	$('#dbtab'+type).addClass('dbtabactive');
	
	ajax({ 
		a:'dashboard',
		b:'act=getAccommodationList&type='+type,
		c:function(){},
		d:function(data){ //alert(data);
			$('#reg_details').html(data);
			
		}
	});
	
}

function func_pagination(page) {
	
	var type = $('#type').val();
	var couponnameTxt = $('#couponnameTxt').val();
	var filter_type = $('#filter_type').val();
	var sponsorid = $('#sponsorid').val();
	
	//alert(type);
	ajax({
		a:'dashboard',
		b:'act=func_showReg&page='+page+'&type='+type+'&couponname='+couponnameTxt+'&sponsorid='+sponsorid+'&filter_type='+filter_type,
		c:function(){},
		d:function(data){
		if($.trim(data)){
				//alert(sortbypagelimit);
				$('#reg_details').html(data);			
			}
		}
	});

}

<!--------------------- Autocomplete in TextBox--------------------------->

 $().ready(function()
 { 
	$("#searchTxt_emailaddress").autocomplete("RegistrationByEmailSearch.php",{ 
		width:230,selectFirst: false,
		 select: function(event, ui) { alert(event); }});	
		$("#searchTxt_emailaddress").result(function(event, data, formatted) {
		
	});
	
	$().ready(function()
 { 
	$("#searchTxt").autocomplete("RegistrationByNameSearch.php",{ 
		width:230,selectFirst: false,
		 select: function(event, ui) { alert(event); }});	
		$("#searchTxt").result(function(event, data, formatted) {
	
	});
	
 });
	
 });
 
 
show_reg_tab('P');

<!--------------------- General Search--------------------------->

function gen_search() 
{
	var err=0;
	
	if($('#searchType').val()==''){  err =1;  $('#searchType').addClass('boxerror'); }else{  $('#searchType').removeClass('boxerror'); 	}
	
	if($('#searchTxt').val()==''){  err =1;  $('#searchTxt').addClass('boxerror'); }else{  $('#searchTxt').removeClass('boxerror');  }
	if($('#searchTxt_id').val()==''){  err =1;  $('#searchTxt_id').addClass('boxerror'); }else{  $('#searchTxt_id').removeClass('boxerror');  }
	if($('#searchTxt_emailaddress').val()==''){  err =1;  $('#searchTxt_emailaddress').addClass('boxerror'); }else{  $('#searchTxt_emailaddress').removeClass('boxerror'); 	}
	
	
	if($('#searchType').val()!=''){  
		err=0;
		if($('#searchType').val()=='name' && $('#searchTxt').val()==''){  err =1; $('#searchTxt').addClass('boxerror'); }else{ 	$('#searchTxt').removeClass('boxerror'); }
		if($('#searchType').val()=='id' && $('#searchTxt_id').val()==''){ err =1; $('#searchTxt_id').addClass('boxerror'); }else{ $('#searchTxt_id').removeClass('boxerror'); }
		if($('#searchType').val()=='emailaddress' && $('#searchTxt_emailaddress').val()==''){ err =1; $('#searchTxt_emailaddress').addClass('boxerror'); }else{ $('#searchTxt_emailaddress').removeClass('boxerror'); }
		
	}


	if(err==0){
		
		
		var searchType = $('#searchType').val();
		var searchTxt = $('#searchTxt').val();
		var searchTxt_id = $('#searchTxt_id').val();
		
		var searchTxt_emailaddress = $('#searchTxt_emailaddress').val();


		ajax({
			a:'dashboard',
			b:'act=func_showReg&searchType='+searchType+'&searchTxt='+searchTxt+'&searchTxt_id='+searchTxt_id+'&searchTxt_emailaddress='+searchTxt_emailaddress,
			c:function(){},
			d:function(data){
				//alert(data);
				$('#search_td').html(data);
			}
		});

	}
	
}

<!---------------------Show or Hide Text Box--------------------------->

function show_type()
{
	
	$('#searchTxt').val('');
	$('#searchTxt_emailaddress').val('');
	$('#searchTxt_id').val('');

	if($('#searchType').val()=='emailaddress'){
		$('#showEmail').show();
		$('#showTxt').hide();
		$('#showId').hide();
		
	}
	if($('#searchType').val()=='name'){
		$('#showEmail').hide();
		$('#showTxt').show();
		$('#showId').hide();
		
	}
	if($('#searchType').val()=='id'){
		$('#showEmail').hide();
		$('#showTxt').hide();
		$('#showId').show();
		
	}
	
}


<!---------------------Show Edit popup--------------------------->
function showreg(reg_id,type,page){
	
	ajax({
		a:'dashboard',
		b:'act=fn_ShowReg&reg_id='+reg_id+'&type='+type+'&page='+page,
		c:function(){},
		d:function(data){
			$('#popup_reg').html(data);
			
			$("#popup_reg").dialog({
				autoOpen: true,
				resizable: false,
				height: 'auto',
				width: 'auto',
				modal: true	,
				draggable: true
			});
								
			$(".ui-widget-header").css({"display":"none"});
			$('#reg_closebtn').click(function(){
			$("#popup_reg").dialog('close');
			});
		}
	});
	
}

<!---------------------Update reg--------------------------->
function RegViewDetails(type,page)
{			  
	$('#reg_det_popup').dialog('close');
			
}

function close_certificatepopup(type,page)
{			  
	$('#certificate_popup').dialog('close');
			
}


function closeOptions()
{			  
	$('#invoice_popup').dialog('close');
			
}

function show_filtertype()
{
	
	if($('#filter_type').val()=='CouponName'){
		$('#show_couponname').show();
		$('#show_couponsponsor').hide();
		
	}
	if($('#filter_type').val()=='CouponSponsor'){
		$('#show_couponsponsor').show();
		$('#show_couponname').hide();
	}
	
	if($('#filter_type').val()=='Filter'){
		show_reg_tab('F');
	}
	
}

function show_viewdetails(reg_id,type,page){
	
	ajax({ 
			a:'dashboard',
			b:'act=fn_showViewDetails&reg_id='+reg_id+'&type='+type+'&page='+page,
			c:function(){},
			d:function(data){
			
			$("#reg_det_popup").html(data);
	
			$("#reg_det_popup").dialog({
				autoOpen: true,
				resizable: false,
				height: 'auto',
				width: 'auto',
				modal: true	,
				draggable: true
			});
								
			$(".ui-widget-header").css({"display":"none"});
			$('#reg_det_popup_closebtn').click(function(){
			$("#reg_det_popup").dialog('close');
			});
		}
	});
	
}
function show_typedetails(reg_id,reg_type,page,type){
	
	ajax({ 
			a:'dashboard',
			b:'act=fn_showTypeDetails&reg_id='+reg_id+'&reg_type='+reg_type+'&page='+page+'&type='+type,
			c:function(){},
			d:function(data){
			
			$("#type_det_popup").html(data);
	
			$("#type_det_popup").dialog({
				autoOpen: true,
				resizable: false,
				height: 'auto',
				width: '700',
				modal: true	,
				draggable: true
			});
								
			$(".ui-widget-header").css({"display":"none"});
			$('#type_det_popup_closebtn').click(function(){
			$("#type_det_popup").dialog('close');
			});
		}
	});
}

function showWorkshopDtl(reg_id,type,page,whom){
	
	ajax({ 
			a:'dashboard',
			b:'act=fn_showWorkshopDtl&reg_id='+reg_id+'&type='+type+'&page='+page+'&whom='+whom,
			c:function(){},
			d:function(data){
			
			$("#workshop_popup").html(data);
	
			$("#workshop_popup").dialog({
				autoOpen: true,
				resizable: false,
				height: 'auto',
				width: '700',
				modal: true	,
				draggable: true
			});
								
			$(".ui-widget-header").css({"display":"none"});
			
		}
	});
	
}

function showStemiTeams(type)
{
	if(type=='ST'){
		$('#showTypedtls').hide();
		$('#showStemiTeams').show();
		$('#showFaculty').hide();
	}
	 if(type=='CA' || type=='IP' || type=='PG' || type==''){
		$('#showStemiTeams').hide();
		$('#showFaculty').hide();
	}
	if(type=='FA'){
		$('#showTypedtls').hide();
		$('#showStemiTeams').hide();
		$('#showFaculty').show();
	} 
}

function showMState(val){
	
	if(val=='Maharashtra'){
		$('#mahadis_id').show();
		$('#city_textid').hide();
	}else{
		$('#city_textid').show();
		$('#mahadis_id').hide();
	}
}

function show_state(val){
	
	if(val=='UNITED STATES'){
		
		//$('#tndistrict_id').hide();
		$('#othercity_id').show();
		
		$('#usstate_id').show();
		$('#indstate_id').hide();
		$('#state_textid').hide();
		$('#CountryCode').val('1');
		
	}else if(val=='INDIA'){
		$('#indstate_id').show();
		$('#usstate_id').hide();
		$('#state_textid').hide();
		$('#CountryCode').val('91');
		if($('#INDState').val()=='Tamil Nadu' && $('#indstate_id').is(':visible')){
			//$('#tndistrict_id').show();
			$('#othercity_id').hide();
		}else{
			//$('#tndistrict_id').hide();
			$('#othercity_id').show();
		}
		
	}else{
		//$('#tndistrict_id').hide();
		$('#othercity_id').show();
		$('#state_textid').show();
		$('#indstate_id').hide();
		$('#usstate_id').hide();
		
	}
}

function show_st_state(val){
	
	if(val=='UNITED STATES'){
		
		$('#st_usstate_id').show();
		$('#st_indstate_id').hide();
		$('#st_state_textid').hide();
		$('#st_CountryCode').val('1');
		
	}else if(val=='INDIA'){
		$('#st_indstate_id').show();
		$('#st_usstate_id').hide();
		$('#st_state_textid').hide();
		$('#st_CountryCode').val('91');
		if($('#st_INDState').val()=='Tamil Nadu' && $('#st_indstate_id').is(':visible')){
			//$('#tndistrict_id').show();
		}else{
			//$('#tndistrict_id').hide();
		}
		
	}else{
		//$('#tndistrict_id').hide();
		$('#st_state_textid').show();
		$('#st_indstate_id').hide();
		$('#st_usstate_id').hide();
		
	}
}

function submit_type(type,page){
	
err=0;

if($('#registration_type').val()=='') { err=1; $('#registration_type').addClass('boxerror');  } else {  $('#registration_type').removeClass('boxerror'); }

if($('#registration_type').val()=='ST'){
	
	if($('#t_firstname').val()=='' && $('#n_firstname').val()=='' ){err=1; alert('Nurse and ER Physician should not be empty!'); } 
}

if($('#registration_type').val()=='FA'){ 
	
	if($('#Fac_searchTxt').val()=='') { err=1; $('#Fac_searchTxt').addClass('boxerror');  } else {  $('#Fac_searchTxt').removeClass('boxerror'); }
}
	 
if(err==0){	
		ajax({
		a:'dashboard',
		b:'act=fn_updateregtype&reg_id='+$('#reg_id').val()+'&registration_type='+$('#registration_type').val()+'&t_prefix='+$('#t_prefix').val()+'&t_firstname='+$('#t_firstname').val()+'&t_gender='+$('#t_gender').val()+'&t_emailaddress='+$('#t_emailaddress').val()+'&t_mobile='+$('#t_mobile').val()+'&n_prefix='+$('#n_prefix').val()+'&n_firstname='+$('#n_firstname').val()+'&n_gender='+$('#n_gender').val()+'&n_emailaddress='+$('#n_emailaddress').val()+'&n_mobile='+$('#n_mobile').val()+'&Fac_searchTxtId='+$('#Fac_searchTxtId').val(),
		c:function(){},
		d:function(data){
		   //alert(data);
		   $("#type_det_popup").dialog('close');
		   show_reg_tab(type);
		 
		}
	});	
	}

}


function showtraveldtls(value) {
	
	if(value=='Y') {
		$("#traveldetails").show();
	} else {
		$("#traveldetails").hide();
	}
	
	if($('input[name=is_accommodation]:checked').val()=='N'){
		
		$('#dateofarrival').val('');
		$('#arrivaltime_hh').val('');
		$('#arrivaltime_mm').val('');
		$("input:radio[name=arrivaltime_ampm]").attr("checked", false);
		
		$('#t_dateofarrival').val('');
		$('#t_arrivaltime_hh').val('');
		$('#t_arrivaltime_mm').val('');
		$("input:radio[name=t_arrivaltime_ampm]").attr("checked", false);
		
		$('#n_dateofarrival').val('');
		$('#n_arrivaltime_hh').val('');
		$('#n_arrivaltime_mm').val('');
		$("input:radio[name=n_arrivaltime_ampm]").attr("checked", false);
		
		$('#dateofdeparture').val('');
		$('#departuretime_hh').val('');
		$('#departuretime_mm').val('');
		$("input:radio[name=departuretime_ampm]").attr("checked", false);
		
		$('#t_dateofdeparture').val('');
		$('#t_departuretime_hh').val('');
		$('#t_departuretime_mm').val('');
		$("input:radio[name=t_departuretime_ampm]").attr("checked", false);
		
		$('#n_dateofdeparture').val('');
		$('#n_departuretime_hh').val('');
		$('#n_departuretime_mm').val('');
		$("input:radio[name=n_departuretime_ampm]").attr("checked", false);
		
		$("input:radio[name=local_transport]").attr("checked", false);
		$("input:radio[name=room_preference]").attr("checked", false);
		$("input:radio[name=t_room_preference]").attr("checked", false);
		$("input:radio[name=n_room_preference]").attr("checked", false);
		
	}
}

$("#popup_delegates").dialog({
	autoOpen: false,
	resizable: false,
	height: 'auto',
	width: 'auto',
	modal: true	,
	draggable: true
});
					
$(".ui-widget-header").css({"display":"none"});
$('#popup_delegates_closebtn').click(function(){
$("#popup_delegates").dialog('close');
});

function openDelegatesPopup(type) {
	
	$('#popup_delegates').dialog('open');
	
	ajax({
		a:'dashboard',
		b:'act=showDelegatesDtls&type='+type,
		c:function(){},
		d:function(data){
			$('#popup_delegates').html(data);
		}
	});
	
}

function closeDelegatesPopup() { $('#popup_delegates').dialog('close'); }

function showDelegateRange(range) {
	if(range=='R') {
		$('#range_box').show();
	} else {
		$('#range_box').hide();
	}
}

function downloadCSV() {
	var delegate = $('input[name=delegates_csv]:checked').val();
	var minVal = $('#range_min').val();
	var maxVal = $('#range_max').val();
	
	window.location.href='genTotalRecords.php?type=Delegates&range='+delegate+'&minVal='+minVal+'&maxVal='+maxVal;
}

$("#popup_accommdation").dialog({
	autoOpen: false,
	resizable: false,
	height: 'auto',
	width: 'auto',
	modal: true	,
	draggable: true
});
					
$(".ui-widget-header").css({"display":"none"});

function closeAccommodationPopup() { $("#popup_accommdation").dialog('close'); }

function openAccommodationPopup(hotelId, occupancyType, arrivalDate) {
	
	$('#popup_accommdation').dialog('open');
	
	ajax({
		a:'dashboard',
		b:'act=showAccommodationDtls&hotelId='+hotelId+'&occupancyType='+occupancyType+'&arrivalDate='+arrivalDate,
		c:function(){},
		d:function(data){
			//alert(data);
			$('#popup_accommdation').html(data);
		}
	});
	
}


</script>
<?
}
include "admin_template.php";
?>