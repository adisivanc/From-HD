<?
function main(){


if($_POST["act"]=='fn_Status'){
	
	ob_clean();
		$status_obj = new Faculty();
		
		if($_POST['field']=='A')	
		$status_obj->field ="Accomodation";
		if($_POST['field']=='N')
		$status_obj->field ="NationalTransport";
		if($_POST['field']=='L')
		$status_obj->field ="LocalTransport";
		
		$status_obj->fieldvalue =$_POST['status'];
		$status_obj->fac_id = $_POST['id'];
		$rsFacDtl = $status_obj->update_facultybyfield();
			
	exit();
}

if($_POST['act'] == "fn_NotesSubmit"){
	
	ob_clean();
	
	$notesObj = new Faculty();
	$notesObj->faculty_id=$_POST['faculty_id'];
	$notesObj->notes=$_POST['notes'];
	
	if($_POST['sent_mail_status']=='Y'){
		
 		$notesObj->sent_mail_status=$_POST['sent_mail_status'];
		$notesObj->emailaddress=$_POST['emailaddress'];
		$sendemail = explode(',',$_POST['emailaddress']);
		
			foreach($sendemail as $K=>$V){
				
				$Subject = "Invitation and Schedule for AROI 2014 ";
				$From       = "kavitharjn@aroitnpy2014.com";
				$fromName  = "Online Co-ordinator";
			    $Subject    = $Subject;
			
				//$emailAddress = $V;
 				//$attachmentFile = '../pdf/schedule.pdf';
				//include "sendgrid.php";
				
			}
	}else{
		$notesObj->sent_mail_status='N';
	}
	
	$rs_NoteaDtl = $notesObj->getFacultyNotesByFId($_POST['faculty_id']);
	if($rs_NoteaDtl->id>0){
		$notesObj->id=$_POST['faculty_id'];
		$notesObj->updateFacultyNotes();
	}else{	
		$notesObj->insertFacultyNotes();
	}
	exit();	
	
}

if($_POST['act']=="fn_ShowNotes") {
	ob_clean();
	
	$Faculty_obj = new Faculty();
	$Faculty_obj->id = $_POST['faculty_id'];
	$rsFacDtl = $Faculty_obj->getFacultyDtl();
	
	$EmailArr[] = $rsFacDtl->Email;
	
?>
<style>
.scroll{max-width:50px; height:50px;overflow:scroll;}
</style>
	<form id="notes_frm" name="notes_frm" method="post">
	<input type="hidden" id="act" name="act" value="Submit" />
	<input type="hidden" id="faculty_id" name="faculty_id" value="<?=$_POST['faculty_id']?>" />

	<table width="600" border="0" style="background:#FFF;" class="tbldetdesc" cellpadding="0" cellspacing="0">
	  <tr class="tbldetdeschd">
		<td>Add Notes
		<div id="notes_closebtn" class="popup_closebtn" title="Close">X</div></td>
	  </tr>
	  <tr>
		<td width="100%" style="padding:10px;">
			<table width="100%" border="0" class="coupontbl" cellpadding="0" cellspacing="0">	
			  <tr>
				<td width="35%">Notes</td>
				<td width="65%"><textarea class="txtbox2" style="width:360px; height:150px;" id="fac_notes" name="fac_notes"><?=$rs_notes->notes?></textarea></td>
			  </tr>
			  <tr>
				<td width="35%">&nbsp;</td>
				<td width="65%"><input type="checkbox" id="sent_mail_status" name="sent_mail_status" value="Y"  onclick="show_sent_mail_status()"/>Send Mail</td> 
			  </tr>
			  <tr id="showemail" style="display:none">
				<td width="35%">Email Address</td>
				<td width="65%"><div id="EmailAddressLevelTop"></div></td> 
			  </tr>
			  <tr>
				<td width="35%">&nbsp;</td>
				<td width="65%">
                	<!--<img src="images/submit_btn.jpg" border="0" style="cursor:pointer; float:right" onclick="submit_notes()"/>-->
                    <div class="submitbtn bgred" onclick="submit_notes();">Submit</div>
                </td> 
			  </tr>
			</table>   
		</td>
	  </tr>
	  <tr>
	  <td width="100%">
	  <div style="max-height:200px; overflow:auto;">
			<table width="100%" border="0" class="regdtltbl" cellpadding="0" cellspacing="0">	
			  <tr bgcolor="#FFFFFF">
				<td width="50%" class="regdtltblhd">Notes</td>
				<td width="50%" class="regdtltblhd">Email Address</td>
			  </tr>
			  <?   $rs_notes = Faculty::getFacultyNotesByFId($_POST['faculty_id']);
			  
			  	   $rowbgCnt=0;
				   if($rs_notes->id>0){ 
				   $rowbgColor = $rowbgCnt % 2 == 0 ? "#eeeeee" : "#FFFFFF";
		 		   $rowbgCnt++;
			 ?>
 
			<tr bgcolor="<?=$rowbgColor?>">
				<td width="50%"><?=$rs_notes->notes;?></td>
				<td width="50%"><?=$rs_notes->emailaddress;?></td>
			  </tr>
			   
			  <? } else {?>
			  <tr>
			 	 <td colspan="3">No Notes Found!</td>
			  </tr>
			  <? }?>
			</table>  
			</div> 
		</td>
	  </tr>
	  
	</table>
	</form>
	<script>
defaultLoader();
function defaultLoader(){

jQuery('#EmailAddressLevelTop').empty().html('');

	var vhtm = new Array();
	var i = 0;
<? 
	if(count($EmailArr)>0){
		for($i=0;$i<count($EmailArr);$i++){
?>
			addEmailAddress({EmailAddress:'<?=$EmailArr[$i]?>', Email:unescape('<?=rawurlencode(htmlentities($EmailArr[$i]))?>'), Emailerr:unescape('<?=rawurlencode(htmlentities($EmailArr[$i]))?>')});
			i++;
<?
		}
	}else{
?>
	addEmailAddress();
<?
	}
?>
	
		
}

		
function addEmailAddress(a){

	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	if(a.Email==undefined) a.Email='';
	if(a.EmailAddress==undefined) a.EmailAddress='';
	if(a.Value==undefined) a.Value='';

	<?
	/*$Faculty_obj = new Faculty();
	$Faculty_obj->id = $_POST['faculty_id'];
	
	//echo "ID :".$_POST['faculty_id'];
	$rsFacDtl = $Faculty_obj->getFacultyDtl();*/
	?>
	
	// alert('<?=$_POST['faculty_id']?>');
	 
	
	//if(a.Email=="") a.Email='<?=$rsFacDtl->Email?>';
	
	var row = jQuery('div.Emailclvltop').length;

	var vhtml = '';
	vhtml += '<div id="spEmailLevel_'+row+'" class="Emailclvltop">';
	vhtml += '<div id="spEmailLevel_'+row+'" class="dimage" >';
	vhtml += '<input type="hidden" name="EmailArr[EmailAddress]['+row+']" id="EmailAddress'+row+'" value="'+a.EmailAddress+'" >';
	vhtml += '<div style="margin-bottom:5px;"><input type="text" name="EmailArr[Email]['+row+']" id="Email'+row+'" value="'+a.Email+'" class="txtbox2 emailaddress" />&nbsp;&nbsp;<span class="spancursor" id="spEmailLevel_a" style=" cursor:pointer;" onclick="addEmailAddress();"><img src="images/add_icon.png" border="0" /></span>&nbsp;&nbsp;<span class="spancursor" id="spEmailLevel_r" style="cursor:pointer;" onclick="removeEmailTopLevel('+row+');"><img src="images/minus_icon.png" border="0" /></span></div>';
	vhtml += '</div>';
	vhtml += '</div>';
	
	jQuery('#EmailAddressLevelTop').append(vhtml);
	
	
	/*$("#Email"+row).autocomplete("ajax_facultysearch.php", {
	  width: 290,
	  selectFirst: false
	});
	$("#Email"+row).result(function(event, data, formatted) {
	if (data) {
			 $('#EmailAddress'+row).val(data[1]);
			
		}
	});*/

}

function removeEmailTopLevel(r){
	var i1;
	if(r==undefined){
		var row = jQuery('div.Emailclvltop').length-1;
		jQuery('#spEmailLevel_'+row).remove();
	}
	else
	{
		jQuery('#spEmailLevel_'+r).remove();
		if(jQuery('div.dimage').length==0){
			for(i1=0;i1<100;i1++){
				if(jQuery('Emailclvltop').length>0)
					jQuery('#spEmailLevel_'+i1).remove();
				else
					i1 = 101;
			}
			addEmailAddress();
		}
	}
	if(jQuery('div.Emailclvltop').length==0)
		addEmailAddress();
}


jQuery(function(){
	
	jQuery('#spEmailLevel_r').show();
	jQuery('#spEmailLevel_a').show();
	defaultLoader();
})

</script>
   <?
	exit();
} ?>


<? if($_POST['act']=='SubmitFacultySchedule'){
	
	$faculty_obj = new Faculty();
	$faculty_obj->id=$_REQUEST['FacultyId'];
	$rs_faculty = $faculty_obj->getFacultyDtl();
	$MailContent = stripslashes($_POST['mailcontent']);
	
	foreach($_POST['EmailArr']['Email'] as $K=>$V){
		
		$Subject = "[AROI 2014] Invitation and Schedule for AROI 2014 ";
		$From       = "kavitharjn@aroitnpy2014.com";
		$fromName  = "Online Co-ordinator";
		$Subject    = $Subject;
		//$emailAddress = "revathipriya.p@gmail.com";
		$emailAddress = $V;
		//$attachmentFile = '../pdf/schedule.pdf';
 		include "sendgrid.php";
		
	}
		
	header('location:faculty.php?msg=success&type='.$_POST['type'].'');
	
}

if($_POST['act']=='fn_sendScheduleMail'){
	ob_clean();
	$rs_obj= new Schedule();
	$rs_obj->fid = $_POST['fid'];
	$rs_obj->sendScheduleMailByFId();
	exit();
}

if($_POST['act']=='fn_deleteFacultyTalks'){
	ob_clean();
	$rs_obj= new Schedule();
	$rs_obj->Id = $_POST['id'];
	$rs_obj->delTalks();
	exit();
}

if($_POST['act']=='saveFacultyTalks'){
	ob_clean();
	$rs_obj= new Schedule();
	$rs_obj->Topic = $_POST['Topic'];
	$rs_obj->SpeakingTime = $_POST['SpeakingTime'];
	$rs_obj->Remarks = $_POST['Remarks'];
	$rs_obj->id = $_POST['id'];
	$rs_obj->updateFacultyTalks();
	exit();
}

if($_POST['act']=='fn_getFacultyTalks'){
	ob_clean();
	$rs_obj= new Schedule();
	$rs_obj->id = $_POST['id'];
	$rs_obj->sorderby='NO';
	$rs_talks_dtl=$rs_obj->getTalksDtl();

	
/*if($_POST['act']=='fn_sendpdfmail'){
		
		ob_clean();
					
 			$PathPrefix = "../tcpdf/";
			
			require($PathPrefix.'config/lang/eng.php');
			require($PathPrefix.'tcpdf.php');
			require($PathPrefix.'htmlcolors.php'); 
			
			class ORDER_PDF extends TCPDF {	
			
				public function Footer() {
					$image_file = "../tcpdf/images/footer.jpg";
					$this->Image($image_file, 11, 280, 189, 0, 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
			
				}
			
				public function __setY_ForRS(){
					if($this->getY()>280)
						$this->addPage();
					else
						$this->setY($this->getY());
				}			
				public function __setX_ForIV($x){
					$this->SetX($x);
				}			
				public function __setY_ForIV($y){
					$this->SetY($y);
				}			
				public function __setXY_ForIV($x, $y){
					$this->SetXY($x, $y);
				}			
					
			}
			
			$fac_obj = new Faculty();
			$fac_obj->id = $_POST['fac_id'];
			$rs_FacultyDtl = $fac_obj->getFacultyDtl();
			
			//print_r($_POST);
			
			if($_POST['fac_id']!=''){
				$msg = 'Invitation Letter';
				include 'genFacultyInvitationpdf.php';
			}
			if($_POST['fac_id']!=''){
				$msg = 'Invitation Letter';				
			}

			
			$fileName = "message-include.php";
			include "mail_template.php";
			$MailContent = ob_get_contents();
			//ob_end_clean();
			
			//$emailAddress = $_REQUEST['email'];
		
			$From       = "kavitharjn@aroitnpy2014.com";
			$fromName  = "Online Co-ordinator";
			$Subject = '[AROI 2014] Thank you for registering for AROI 2014';
			//$additionalEmailAddress = 'kavitharjn@gmail.com';

			
			if($_POST['fac_id']!=''){
				$attachmentFile[] = ('../uploads/bothpdf/FacultyInvitation_'.$_POST['fac_id'].'.pdf');
			}
			$emailAddress = 'karthiinfotech@gmail.com';
			
			//include "sendgrid.php";
		
		exit();
} */


?>
     
<table width="500" border="0" style="background:#FFF;" class="tbldetdesc" cellpadding="0" cellspacing="0">
    <tr class="tbldetdeschd">
        <td>Edit Talks<div onclick="closeFacultyPopup()" class="popup_closebtn" title="Close">X</div></td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" class="addscheduletbl" cellpadding="0" cellspacing="0">
              <tr>
                <td align="right">Topic</td>
                <td><input type="text" style="width:330px;" class="txtbox2" id="Topic" name="Topic" value="<?=$rs_talks_dtl->Topic?>" /></td>
              </tr>
              <tr>
                <td align="right">Speaking Time</td>
                <td><input type="text" style="width:330px;" class="txtbox2" id="SpeakingTime" name="SpeakingTime" value="<?=$rs_talks_dtl->SpeakingTime?>" /></td>
              </tr>
              <tr>
                <td align="right">Remarks</td>
                <td><input type="text" style="width:330px;" class="txtbox2" id="Remarks" name="Remarks" value="<?=$rs_talks_dtl->Remarks?>" /></td>
              </tr>
              <tr>
                <td align="right" colspan="2">
                	<!--<img src="images/submit_btn.jpg" border="0" style="cursor:pointer; float:right" onclick="fn_updateFacultyTalks(<?=$_POST['id']?>,<?=$_POST['fid']?>)" />-->
                	<div class="submitbtn bgred" onclick="fn_updateFacultyTalks(<?=$_POST['id']?>,<?=$_POST['fid']?>)">Submit</div>
                </td>
              </tr>
            </table>
        </td>
    </tr>
</table>
<?
exit();
}

if($_POST['act'] == "Submit_Itinerary") { 	 
	ob_clean();
	if($_POST['id']>0){
	$reg_obj = new Registration();
	$reg_obj->facultyid = $_POST['id']; 
	if($_POST['faculty_id']!="") $Val_Id = $_POST['faculty_id']; else $Val_Id = $_POST['id'];
	$rs_regdtl= $reg_obj->getUserDtl($Val_Id);
	$reg_obj->dateofarrival = date ("Y-m-d",strtotime($_POST['dateofarrival']));	
	$reg_obj->arrivalflightnumber = $_POST['arrivalflightnumber'];
	$reg_obj->arrivaltime = $_POST['arrivalHour'].":".$_POST['arrivalMinute'].":".$_POST['arrivalMeridien'];
	$reg_obj->arrivalflightname = $_POST['arrivalflightname'];
	$reg_obj->dateofdeparture = date ("Y-m-d",strtotime($_POST['dateofdeparture']));	
	$reg_obj->departureflightnumber = $_POST['departureflightnumber'];	
	$reg_obj->departuretime = $_POST['departureHour'].":".$_POST['departureMinute'].":".$_POST['departureMeridien'];
	$reg_obj->departureflightname = $_POST['departureflightname']; 
	
	/////////////////To check whether Faculty Id is Exists in Registeration Table/////////// 
	if($rs_regdtl[0]->id>0){
	$rs_regdtl= $reg_obj->updateFac_Reg();////if Id present in Reg = update
	echo $val="Updated Successfully";
	 
	}else{	//////If Id not present in Reg = Insert	 
	
	$query = "select * from ".TBL_FACULTY." where Id= '".$_POST['id']."'";
  	$rs_list = dB::sExecuteSql($query);
		 ////initial Insert
	$reg_obj->isfaculty = 'Y';
	$reg_obj->prefix = $rs_list->Prefix;
	$reg_obj->registration_type = 'FA';
	$reg_obj->firstname = $rs_list->Name;
	$reg_obj->emailaddress = $rs_list->Email;		
	$reg_obj->mobile = $rs_list->Mobile;		
	$reg_obj->organization = $rs_list->Institute ;
	$reg_obj->designation = $rs_list->Designation ;
	$reg_obj->address = $rs_list->Address;
	$reg_obj->country  = $rs_list->Country ;		
	$reg_obj->city = $rs_list->City;
	$reg_obj->state = $rs_list->State;
	$reg_obj->zipcode = $rs_list->Zipcode;
	$reg_obj->paid = 'Y';
	$reg_obj->created_date = $rs_list->AddedDate;
	
	$rs_facdtl= $reg_obj->insertRegistration();
	if($rs_facdtl!="") echo $val="Inserted Successfully";
   }
  }
  exit();
} 

if($_POST['act']=='fn_ShowFacultyList'){
	
		ob_clean();
		$Faculty_obj = new Faculty();
		$Faculty_obj->type =$_POST['type'];
		
		if($_POST['orderby']=='')
		{
			$Faculty_obj->sortby='ASC';
			$Faculty_obj->orderby='Name';
		}
		$rsFacultyDtls= $Faculty_obj->getAllFacultybyType();
		
		if($_POST['page']=='')
			$page=1;
			else
			$page = $_POST['page'];
			$totalReg = count($rsFacultyDtls);
			$PageLimit=15;
				
			$totalPages= ceil(($totalReg)/($PageLimit));
			if($totalPages==0) $totalPages=1;
			$StartIndex= ($page-1)*$PageLimit;
			if(count($rsFacultyDtls)>0) $rsFacultyDtlsArr = array_slice($rsFacultyDtls,$StartIndex,$PageLimit,true);
			include('faculty_details_ajax.php');
			exit();
}
  	
if($_POST['act'] == "viewfacautoresult")
{
		ob_clean();
		$Faculty_obj = new Faculty();
		$Faculty_obj->searchTxt = $_POST['searchTxt'];
		$Faculty_obj->id = $_POST['Id'];
		$rsFacDtl = $Faculty_obj->getFacultyDtl();
		$Faculty_obj->type = $rsFacDtl->Type;
		$rsFacultyDtls = $Faculty_obj->getAllFacultybyType();
		
		if(count($rsFacultyDtls)>0){
			if($_POST['page']=='')
			$page=1; 
			else
			$page = $_POST['page'];
			$totalReg = count($rsFacultyDtls);
			
			$PageLimit=15;
			
			$totalPages= ceil(($totalReg)/($PageLimit));
			if($totalPages==0) $totalPages=1;
			$StartIndex= ($page-1)*$PageLimit;
			
			if(count($rsFacultyDtls)>0) 
			$ListingRegistrationArr = array_slice($rsFacultyDtls,$StartIndex,$PageLimit,true);
		 } 
  
		include "faculty_details_ajax.php";
		exit();
}

if($_POST['act'] == "fn_sviewEdit")
{
	ob_clean();
	
	header("Location: add_faculty.php?EId=".$_POST['Id']);
	exit();
}

if($_POST['act']=='fn_DeleteFaculty'){
		
	ob_clean();
	
	$del_faculty_obj = new Faculty();
	$del_faculty_obj->Faculty_id = $_POST['Faculty_id'];
	$del_faculty_obj->delFaculty();

	exit();
}

if($_POST['act'] == "fn_showfacDtls")
{ 
	 ob_clean();
	 if($_POST['Type']=='') {
	 $query = "select * from ".TBL_FACULTY." where Id= '".$_POST['Id']."'";
	 } else 
	 $query = "select * from ".TBL_FACULTY." where Id= '".$_POST['Id']."'  and  Type ='".$_POST['Type']."'";
	 $rs_list = dB::sExecuteSql($query);
     if($rs_list->Id>0){
		$reg_obj = new Registration();
		$reg_obj->facultyid = $rs_list->Id; 
		$rs_regdtl= $reg_obj->getUserDtl($rs_list->Id);
		if($rs_regdtl[0]->id>0){
		$Reg_id= $rs_regdtl[0]->id;
		$Reg_id_val ="Reg Id :".$Reg_id;
	    }
	  }
			
?>
<style>
.text_highlight{color:#009900;font-weight:bold}
</style>
  <table width="100%" border="0" class="tbldetdesc" cellpadding="0" cellspacing="0">
  <tr class="tbldetdeschd">
	<td>Faculty Details 
                <? if($_SESSION['admin_type']=="SA") { ?> 
                <div class="tblhdbtn"><a href="add_faculty.php?Id=<?=$_POST['Id']?>">Edit</a></div>
				<div class="tblhdbtn"><span onclick="shownotes('<?=$_POST['Id']?>')">Add Notes</span></div>
                <? } ?>
            </td>
          </tr>
          <tr>
            <td>
                <table width="100%" border="0" class="tbldetdescinner" cellpadding="0" cellspacing="0">
                  <tr>
                    <td>
                        <table width="100%" border="0" class="facultytbl" cellpadding="0" cellspacing="0">
                          <tr>
                            <td valign="top" align="center" style="padding:0;">

                                <table width="96%" border="0" style="border-right:1px solid #dfdfdf;" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td width="25%" valign="top">
                                    <?=$rs_list->Name?><br />
                                    <? if($rs_list->Photo!="") {?>
                                    <a href="<?=FACULTY_HREF.$rs_list->Photo?>" target="_blank"><img src="resize.php?f=<?=doEncode(FACULTY_PATH.$rs_list->Photo)?>&rw=50&rh=50" border="0" style="cursor:pointer;"/></a>
                                    <? } ?>
                                    </td>
                                    <td width="75%" valign="top"><?=$rs_list->Prefix.' '.$rs_list->Name.' '.$rs_list->Degree?><span style="float:right"><?=$Reg_id_val;?></span><br/>                                    			
                                        <?=$rs_list->Email;?><br/>			
                                         <?=$rs_list->Designation ;?><span></span></td>
                                  </tr>
                                </table>                            </td>
                            <td valign="top">
                               <?=$rs_list->Mobile;?><br/>
                               <?=$rs_list->Institute;?><br/>
                               <?=$rs_list->SEO_Name;?>
                                <div class="flag"><?=$rs_list->flag;?></div>
							</td>
                         </tr>
                          <tr>
                            <td colspan="2"style="padding-left:10px; border-top:1px solid #dfdfdf;"> <?=$rs_list->Address;?> </td> 
							
                          </tr>
						  
                        </table>
                    </td>
                  </tr>
                  <tr>
                    <td>
           			 <table width="100%" border="0" class="tbldetinner" cellpadding="0" cellspacing="0">
                          <tr class="tbldetinnerhd">
                            <td>Schedule
                            <? if($_SESSION['admin_type']=="SA") { ?> 
                            <div class="tblhdbtn"><a target="_blank" href="showFacultyScheduleMail.php?fid=<?=$rs_list->Id?>&type=<?=$_REQUEST['type']?>">Email</a></div>
                            <? } ?>
                            </td>
                          </tr>
                          <tr>
                            <td> 
                               <?
									$fid = $rs_list->Id;
									include "schedule-code.php";
									
									include "include-faculty-schedule.php";
							   ?>
                             </td>
                          </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                    <td style="padding-top:10px;">
                       <? ///////////////After Name Clicked (i.e ID passed)
					   include "Itinerary_details_ajax.php";?>
                    </td>
                  </tr>
                   
                </table>
            
            </td>	</tr></table>
<?
	exit();
	}  
?>

<table width="100%" border="0" class="tblouter" cellpadding="0" cellspacing="0">
<? if($_REQUEST['msg']=='success'){ ?>
<tr>
	<td colspan="2" align="center" style="color:#030;">schedule email sent successfully!</td>
</tr>
<? } ?>
  <tr class="tblhd">
    <td width="18%"><? if($_REQUEST['type']=='IF') { ?>International <? } else { ?> National <? } ?>Faculty</td>
    <td width="82%"></td>
  </tr>
  <tr>
    <td width="18%" valign="top" align="center">
        <table width="268" border="0" class="searchtbl" cellpadding="0" cellspacing="0">
          <tr class="searchtblhd">
            <td>
            <div class="searchrow">
            <input type="text" class="txtbox" id="searchTxt" name="searchTxt" style="width:260px;" />
			<input type="hidden" name="searchTxtId" id="searchTxtId" />
            <input type="hidden" class="txtbox" id="page" name="page"  />
            <input type="hidden" name="sortby" id="sortby" value="asc" />
			<input type="hidden" name="orderby" id="orderby" />
           </div>
            </td>
			</tr> 
            <tr>
                <td id="reg_details"></td>
            </tr>
		
		</table>
    </td>
    <td width="82%" valign="top" id="showfacDtls_list">
     </td>
  </tr>
</table> 

<div id="popup_faculty" style="display:none; padding:0px; margin:0px;"></div>
<div id="popup_notes" style="display:none; padding:0px; margin:0px;"></div>         

<style>
.bg{background: #000000; }

</style>
<link rel="stylesheet" type="text/css" href="../css/jquery.tzCheckbox.css" />

<script src="../js/jquery.tzCheckbox.js"></script>
<script src="../js/script.js"></script>
<script type='text/javascript' src='../js/autocomplete/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='../js/autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="../js/autocomplete/jquery.autocomplete_faculty.css" />
<script type="text/javascript">

$("#popup_faculty").dialog({
	autoOpen: false,
	resizable: false,
	height: 'auto',
	width: 'auto',
	modal: true	,
	draggable: true
});
					
$(".ui-widget-header").css({"display":"none"});
			
			
<!-----------------------Active Link Change Colour--------------------------->
  /*$(".activetext").click(function() {
    var selected = $(this).hasClass("texterror");
    $(".activetext").removeClass("texterror");
    if(!selected)
    $(this).addClass("texterror");
});*/
<!-----------------------Show List--------------------------->
function showfacDtls(Type,id){
	
	$(".desc_").removeClass("text_highlight");
    $(".sty_"+id).addClass("text_highlight");
	
	ajax({
		a:'faculty',
		b:'act=fn_showfacDtls&Id='+id+'&Type='+Type,
		c:function(){},
		d:function(data){
			$('#showfacDtls_list').html(data);
		}
	});	
}
<!-----------------------Update Ajax--------------------------->
function viewEdit(id)
{
 //alert(id);
	ajax({
		a:'faculty',
		b:'act=fn_sviewEdit&Id='+id,
		c:function(){},
		d:function(data){
		  //alert(data);////fetch the data under the function fn_sviewEdit
			//$('#viewEditDtls').html(data);
		}
	});	
}
<!-----------------------AutoComplete--------------------------->
$().ready(function()
 { 
	$("#searchTxt").autocomplete("faculty_search.php?stype=<?=$_REQUEST['type']?>",{ 
		width:230,selectFirst: false,
		 select: function(event, ui) { alert(event); }});	
		$("#searchTxt").result(function(event, data, formatted) { 
										
		showfacDtls('<?=$_REQUEST['type']?>',data[1]);								
		$("#searchTxtId").val(data[1]);
		
	});
 });
<!-----------------------General Search--------------------------->
function gen_search() 
{
var searchTxt = $('#searchTxt').val();
var searchTxtID = $('#searchTxtId').val();
alert(searchTxtID);
	ajax({
		a:'faculty',
		b:'act=viewfacautoresult&searchTxt='+searchTxt+'&Id='+searchTxtID,
		c:function(){},
		d:function(data){
			  	
			   $('#reg_details').html(data);
			   //$('#reg_details').hide();
			  // func_showFacultyPaging(page);
			 //showfacDtls(Type,id);
		}
	});
}
show_faculty();
<!-----------------------Faculty List--------------------------->
function show_faculty() 
{
	var page = $('#page').val();
	var sortby = $('#sortby').val();
	var orderby = $('#orderby').val();

	ajax({
		a:'faculty',
		b:'act=fn_ShowFacultyList&page='+page+'&type=<?=$_REQUEST['type']?>'+'&sortby='+sortby+'&orderby='+orderby,
		c:function(){},
		d:function(data){
			 //alert(data); 	
			   $('#reg_details').html(data);
		}
	});
}

<!-------------------------Pagination-------------------------------->
function func_showFacultyPaging(page) {
	
	var sortby = $('#sortby').val();
	var orderby = $('#orderby').val();
	
  ajax({
		a:'faculty',
		b:'act=fn_ShowFacultyList&page='+page+'&type=<?=$_REQUEST['type']?>'+'&sortby='+sortby+'&orderby='+orderby,
		c:function(){},
		d:function(data){ 
		 	$('#reg_details').html(data);
		}
	});
}

function editFacultyTalks(id,fid){
		
	ajax({
		a:'faculty',							
		b:'act=fn_getFacultyTalks&id='+id+'&fid='+fid,
		c:function(){},
		d:function(data)
		{
			$("#popup_faculty").show();
			$("#popup_faculty").html(data);
			$("#popup_faculty").dialog('open');

	
		}
	});
	
}

function closeFacultyPopup(){
	
	$("#popup_faculty").dialog('close');
}

function fn_updateFacultyTalks(id,fid){
	
	var err=0;	
 	
	if(	$('#Topic').val()==''){ err=1; $('#Topic').addClass('boxerror'); } else { $('#Topic').removeClass('boxerror'); }
	if(	$('#SpeakingTime').val()==''){ err=1; $('#SpeakingTime').addClass('boxerror'); } else { $('#SpeakingTime').removeClass('boxerror'); }
	
	var Topic = $('#Topic').val();
	var SpeakingTime = $('#SpeakingTime').val();
	var Remarks = $('#Remarks').val();
	
	
	if(err==0){
		
		ajax({
			a:'faculty',							
			b:'act=saveFacultyTalks&id='+id+'&Topic='+Topic+'&SpeakingTime='+SpeakingTime+'&Remarks='+Remarks,
			c:function(){},
			d:function(data)
			{
				//alert(data);
				closeFacultyPopup();
				showfacDtls('',fid);			
				
			}
		});
		
		
	}

}

function deleteFacultyTalks(id,fid){
	
	if(confirm('Are you sure want to delete this talks!')){
	ajax({
			a:'faculty',							
			b:'act=fn_deleteFacultyTalks&id='+id,
			c:function(){},
			d:function(data)
			{
				//alert(data);	
				showfacDtls('',fid);	
			}
		});
	}
	
}


function hideFacultyScheduleMail(){
	
	$("#popup_showschedule").dialog('close');
}

function sendFacultyScheduleMail(fid){
	
	if(confirm('Are you sure want to mail this schedule?')){
		
		
		ajax({
			a:'faculty',							
			b:'act=fn_sendScheduleMail&fid='+fid,
			c:function(){},
			d:function(data)
			{
				//alert(data);
				
				
			}
		});
		
	}
	
}


function FacultyDelete(Faculty_id)
{

	ajax ({
			a:'faculty', 
			b:'act=fn_DeleteFaculty&Faculty_id='+Faculty_id,	
			c:function(){},
			d:function(data){
				show_faculty();
			}
			
	});

}
<?
if($_REQUEST['type']!='') {
	if($_REQUEST['Id']!='') {
?>
showfacDtls('<?=$_REQUEST['type']?>',<?=$_REQUEST['Id']?>);
<?
} else {
$Faculty_obj = new Faculty();
$Faculty_obj->type=$_REQUEST['type'];
$rsFacDtl= $Faculty_obj->getAllFacultybyType();
$rsFac = $rsFacDtl[0];

?>	
showfacDtls('<?=$rsFac->Type?>',<?=$rsFac->Id?>);
<?	
}
} 
?>

function sendpdfmail(fac_id){
		

		$('#sendnow_td').hide();
		$('#loading_td').show();
		ajax({
			a:'faculty',
			b:'act=fn_sendpdfmail&fac_id='+fac_id,
			c:function(){},
			d:function(data){
				//alert(data);
				alert('Mail Sent Successfully');
				window.location.href = 'faculty.php?fac_id=<?=$fac_id?>&type=<?=$_REQUEST['type']?>';
			}
		});		
}

shownotes(<?=$_POST['faculty_id']?>);

function shownotes(faculty_id){

	$('#popup_notes').dialog('open');
	
	ajax({
		a:'faculty',
		b:'act=fn_ShowNotes&faculty_id='+faculty_id,
		c:function(){},
		d:function(data){
			//alert(data);
		    $('#popup_notes').html(data);
			$("#popup_notes").dialog({
			autoOpen: false,
			resizable: false,
			height: 'auto',
			width: 'auto',
			modal: true	,
			draggable: true
		});
							
		$(".ui-widget-header").css({"display":"none"});
		$('#notes_closebtn').click(function(){
		$("#popup_notes").dialog('close');
		});
		}
	});
 }
 
function show_sent_mail_status()
{ 
	if($('#sent_mail_status:checked').val()=='Y'){
		$('#showemail').show();
		defaultLoader();
	}
	else 
		$('#showemail').hide();
}

function submit_notes(){
var err=0;	
	if(	$('#fac_notes').val()==''){ err=1; $('#fac_notes').addClass('boxerror'); } else { $('#fac_notes').removeClass('boxerror'); }
	
	if($('input[sent_mail_status=accomodate]:checked').val()=='Y'){
	if(	$('#emailaddress').val()==''){ err=1; $('#emailaddress').addClass('boxerror'); } else { $('#emailaddress').removeClass('boxerror'); }
	
	if($('#emailaddress').val()!='')
	{
	 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#emailaddress').val()) == false) 
		{
			err=1;
			$('#emailaddress').addClass('boxerror');
		}
		else{
			$('#emailaddress').removeClass('boxerror');
		}
	}
	}
	
	var emailaddress = $('.emailaddress').map(function(){
		return this.value;
   }).get();

	var mailstatus = $('input[name=sent_mail_status]:checked').val();
	
  	if(err==0){
		ajax({
			a:'faculty',							
			b:'act=fn_NotesSubmit&notes='+$('#fac_notes').val()+'&sent_mail_status='+mailstatus+'&emailaddress='+emailaddress+'&faculty_id='+$('#faculty_id').val(),		
			c:function(){},
			d:function(data) {
				//alert(data);
				$("#popup_notes").dialog('close');
			}
			
		});
	}
}

function chStatus(id,status,field){

//alert('act=fn_Status&id='+id+"&status="+status+"&field="+field);
		ajax({
			a:'faculty',
			b:'act=fn_Status&id='+id+"&status="+status+"&field="+field,		
			c:function(){},
			d:function(data){
				//alert(data);
				
				drwStatus(id,status,field);
			}			
		});  
	
}

function drwStatus(id,status,field){
  
	if(status=='Y'){
		$('#spSt'+id+'_'+field).html('<img src="images/green.gif" />&nbsp;<span style="cursor:pointer" onclick="chStatus(\''+id+'\',\'N\',\''+field+'\')" title="Click to make status inactive"><img src="images/red1.gif" border="0" alt="Click to make status inactive" title="Click to make status inactive" /></span><span style="font-weight:bold">&nbsp;&nbsp;[Yes]</span>');
	} 
	else if(status=='N'){
		$('#spSt'+id+'_'+field).html('<span style="cursor:pointer" onclick="chStatus(\''+id+'\',\'Y\',\''+field+'\')" title="Click to make status active"><img src="images/green1.gif" border="0" alt="Click to make status active" title="Click to make status active"/></span>&nbsp;<img src="images/red.gif" border="0" /></span><span style="font-weight:bold">&nbsp;&nbsp;[No]</span>');
	}
	else{
	$('#spSt'+id+'_'+field).html('<span style="cursor:pointer" onclick="chStatus(\''+id+'\',\'Y\',\''+field+'\')" title="Click to make status active"><img src="images/green1.gif" border="0" alt="Click to make status active" title="Click to make status active"/></span>&nbsp;<span style="cursor:pointer" onclick="chStatus(\''+id+'\',\'N\',\''+field+'\')" title="Click to make status active"><img src="images/red1.gif" border="0" /></span><span style="font-weight:bold">&nbsp;&nbsp;[Not Assigned]</span>');
	}
	
}

</script>

<? 
}
include "admin_template.php";
?>
