<? $rs_student = Student::getStudentById($_POST['student_id']);?> 


<div class="pull_left">
    <div class="grade_tab active" id="grade_tabB" style="border-right:0;" onclick="showStudent('B')">Basic Details</div>
    <div class="grade_tab" id="grade_tabS" style="border-right:0;" onclick="showStudent('S')">Student Details</div>
    <div class="grade_tab" id="grade_tabF" style="border-right:0;" onclick="showStudent('F')">Family Details</div>
    <div class="grade_tab" id="grade_tabP" onclick="showStudent('P')">Previous School</div>
    <div class="grade_tab" id="grade_tabD" onclick="showStudent('D')">Documents</div>
    <div class="grade_tab" id="grade_tabFS" onclick="showStudent('FS')">Fee Setup</div>
</div>
<style>
.tdhead{font-weight:bold;}
</style>

<div class="fullsize border_theme pad10" style="width:98%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showBasicDtls">
    <tr>
        <td><span class="form_head">Personal Details</span></td>
        <td colspan="2"><span class="form_head">Contact Details</span></td>
    </tr>
    <tr>
        <td width="50%" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                <tr>
                    <td colspan="3" align="center"><? if($rs_student->photo!=''){?><img src="<?=STUDENT_FILE_HREF.$rs_student->photo?>" width="100"  height="100"/><? } ?> </td>
                </tr>
                <tr>
                    <td width="40%">First Name</td>
                    <td width="2%">:</td>
                    <td width="58%"><?=$rs_student->first_name?>&nbsp;<?=$rs_student->middle_name?>&nbsp;<?=$rs_student->last_name?></td>
                </tr>
                <tr>
                    <td id="showGenderErr">Gender</td>
                    <td width="2%">:</td>
                    <td><?=($rs_student->gender=='M')?"Male":"Female"?> </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td width="2%">:</td>
                    <td><?=date('d-m-Y',strtotime($rs_student->date_of_birth)); ?> </td>
                </tr>
                <tr>
                    <td>Blood Group</td>
                    <td width="2%">:</td>
                    <td><?=$rs_student->blood_group?></td>
                </tr>
            </table>
        </td>
        
        <td valign="top" style="margin-bottom:150px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td width="48%">Email</td>
                    <td width="2%">:</td>
                    <td width="50%"><?=$rs_student->email_address?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td >:</td>
                    <td><?=$rs_student->phone?></td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td >:</td>
                    <td><?=$rs_student->mobile?></td>
                </tr>
                <tr>
                    <td>Emergency Contact No.</td>
                    <td >:</td>
                    <td><?=$rs_student->emergency_contact_number?></td>
                </tr>
                <tr>
                    <td>Nationality</td>
                    <td >:</td>
                    <td><?=$rs_student->nationality?></td>
                </tr>
                <tr>
                    <td>Mother Tongue</td>
                    <td >:</td>
                    <td><?=$rs_student->mother_tongue?></td>
                </tr>
            </table>
        </td>
    </tr>
    
    <tr>
        <td><span class="form_head">Current Address</span></td>
        <td colspan="2"><span class="form_head">Permanent Address</span></td>
    </tr>
    
    <tr>
        <td valign="top" style="margin-bottom:150px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td width="41%">Address</td>
                    <td width="2%">:</td>
                    <td width="57%" style="line-height:22px;"><?=$rs_student->current_address?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td >:</td>
                    <td><?=$rs_student->current_state?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td >:</td>
                    <td><?=$rs_student->current_city?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td >:</td>
                    <td><?=$rs_student->current_zipcode?></td>
                </tr>
            </table>
        </td>
        
        <td valign="top" style="margin-bottom:150px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td width="41%">Address</td>
                    <td width="2%">:</td>
                    <td width="57%" style="line-height:22px;"><?=$rs_student->permanent_address?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td >:</td>
                    <td><?=$rs_student->permanent_state?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td >:</td>
                    <td><?=$rs_student->permanent_city?></td>
                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td >:</td>
                    <td><?=$rs_student->permanent_zipcode?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showPresonalStudentDtls" style="display:none">
    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td width="50%">Grade in which currently studying </td>
                    <td  width="50%"><?=$rs_student->current_studying?></td>
                </tr>
                <tr>
                    <td  width="50%">Grade to which Admission is sought</td>
                    <td  width="50%"><? $grade_name = Grade::getGradeById($rs_student->grade_id); echo ucfirst($grade_name->grade_name);?></td>
                </tr>
                <tr>
                    <td valign="top">Describe what you experience as an area where you see potential in your child</td>
                    <td><?=$rs_student->child_potential?></td>
                </tr>
                <tr>
                    <td valign="top">What are the languages/areas that your child shows deep interest in and why?</td>
                    <td><?=$rs_student->child_interest?></td>
                </tr>
				<? if($rs_student->child_gifted=='Y') {?>
                <tr>
                    <td valign="top">Is your child gifted in any realms of life </td>
                    <td valign="top"><?=$rs_student->child_gifted_notes?></td>
                </tr>
                <? } 
				if($rs_student->child_difficult=='Y'){?>
				<tr>
                    <td valign="top">Does child face difficulty with any particular area/language?</td>
                    <td valign="top"><?=$rs_student->child_gifted_notes?> </td>
				</tr>
				<? }
				if($rs_student->health_issue=='Y'){?>
				<tr>
                    <td valign="top">Please state any health history ( any illnesses,allergies etc) that is important for us to know.</td>
                    <td valign="top"><?=$rs_student->health_history?> </td>
				</tr>
				<? }if($rs_student->sports_inclination=='Y'){ ?>
                <tr>
                    <td valign="top">Does child play any sport or does he/she show inclination towards any sport?</td>
                    <td valign="top"><?=$rs_student->sports_notes?></td>
                </tr>
                <? }?>
                <tr>
                    <td valign="top">Describe your home environment</td>
                    <td><?=$rs_student->home_environment?></td>
                </tr>
                <tr>
                    <td valign="top">List the activities of child likes to do during his/her leisure time?</td>
                    <td><?=$rs_student->child_hobbies?></td>
                </tr>
				<? if($rs_student->is_pet=='Y') {?>
                <tr>
                    <td valign="top" >Does your child have any pets,if yes,what is it and the name of the pet?</td>
                    <td valign="top" colspan="2"><?=$rs_student->what_pet?>-<?=$rs_student->pet_name?></td>
                </tr>
                <? }?>
                <tr>
                    <td valign="top">Languages Known</td>
                    <td>
                    <? $languages_known = unserialize($rs_student->languages_known);
                    //print_r($languages_known); 
					$langArr=array();
                    for($i=0; $i<count($languages_known['language_name']); $i++){
						$langArr = explode(",", $languages_known['languages_types'][$i]);
                    ?>
						<strong><?=$languages_known['language_name'][$i]?></strong>  -
                        <?=$GLOBALS['LanguageType'][$langArr[0]].", ".$GLOBALS['LanguageType'][$langArr[1]].", ".$GLOBALS['LanguageType'][$langArr[2]]?>
                    <br/>
                    <?  } ?> 
                    </td>	
                </tr>
                <tr>
                    <td valign="top">Details of brothers and sisters of the student</td>
                    <td valign="top"> 
                        <table width="100" border="0" style="border-style: solid; border-width: 2px; border-color:#ccc">
                            <tr>
                                <td>Name</td>
                                <td>Gender</td>
                                <td>Age</td>
                                <td>Class</td>
                                <td>Institution</td>
                            </tr>
                        <?  $siblings_of_student = unserialize($rs_student->siblings_of_student);
                        //print_r($siblings_of_student);
                        $index=0;
                        if(count($siblings_of_student['sibiling_name'])>0){
                        foreach($siblings_of_student['sibiling_name'] as $M=>$N){
                        ?>
                            <tr>
                                <td><?=$siblings_of_student['sibiling_name'][$index]?></td>
                                <td><?=(($siblings_of_student['sibiling_gender'][$index])=="M")?"Male":"Female";?></td>
                                <td><?=$siblings_of_student['sibiling_age'][$index]?></td>
                                <td><?=$siblings_of_student['sibiling_class'][$index]?></td>
                                <td><?=$siblings_of_student['sibiling_name_of_org'][$index]?></td>
                            </tr>
                        <? $index++; } }else{?>
                        	<tr align="center"><td>No Sibilings..!</td></tr>
                        <? }?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showFamilyDtls" style="display:none">
    <tr>
        <td><div style="float:left;">Is Parent/Guardian ?</div>
        <div style="margin-left:50px; float:left;">
        <?=($rs_student->is_parent=='P')?"Parent":"Guardian"; ?>
        </div>
        </td>
    </tr>
    <tr>
        <td width="50%">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td>Father Name</td>
                    <td><?=$rs_student->father_name?></td>
                </tr>
                <tr>
                    <td>Qualification</td>
                    <td><?=$rs_student->father_qualification?></td>
                </tr>
                <tr>
                    <td>Interest</td>
                    <td><?=$rs_student->father_interest?></td>
                </tr>
                <tr>
                    <td>Details of Employment</td>
                    <td>
                    <? if($rs_student->father_employment=='SE') echo "Self Employment" ;?>
                    <? if($rs_student->father_employment=='S') echo "Service" ;?>
                    <? if($rs_student->father_employment=='N') echo "None" ;?>
                    </td>
                </tr>
                <tr>
                    <td>Nature of Job/Business</td>
                    <td><?=$rs_student->father_nature_of_job?></td>
                </tr>
                <tr>
                    <td>Annual Income</td>
                    <td><?=$rs_student->father_annual_income?></td>
                </tr>
            
            </table>
        </td>
        
        <td valign="top" style="margin-bottom:150px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td>Mother Name</td>
                    <td><?=$rs_student->mother_name?></td>
                </tr>
                <tr>
                    <td>Qualification</td>
                    <td><?=$rs_student->mother_qualification?></td>
                </tr>
                <tr>
                    <td>Interest</td>
                    <td><?=$rs_student->mother_interest?></td>
                </tr>
                <tr>
                    <td>Details of Employment</td>
                    <td>
                    <? if($rs_student->mother_employment=='SE') echo "Self Employment" ;?>
                    <? if($rs_student->mother_employment=='S') echo "Service" ;?>
                    <? if($rs_student->mother_employment=='N') echo "None" ;?>
                    </td>
                </tr>
                <tr>
                    <td>Nature of Job/Business</td>
                    <td><?=$rs_student->mother_nature_of_job?></td>
                </tr>
                <tr>
                    <td>Annual Income</td>
                    <td><?=$rs_student->mother_annual_income?></td>
                </tr>
            </table>
        </td>
    </tr>

	<? if($rs_student->is_parent=='G'){?> 
    <tr>
        <td width="50%" colspan="4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td><span class="form_head">Guardian Details</span></td>
                </tr>
                <tr>
                    <td>Guardian Name</td>
                    <td><?=$rs_student->guardian_name?></td>
                </tr>
            </table>
        </td>
    </tr>
	<? }?>

    <tr>
        <td width="50%">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td>Photo</td>
                    <td><? if($rs_student->family_photo!=''){?><img src="<?=FAMILY_FILE_HREF.$rs_student->family_photo?>" width="80"  height="80"/><? } else{ ?> No Family Photo Found..!<? }?></td>
                </tr>
            </table>
        </td>
    </tr>
    
    <tr>
        <td valign="top">What are your educational goals for your child?</td>
        <td><?=$rs_student->educational_goals?></td>
    </tr>
    
    <tr>
        <td valign="top">What is your view on competition?</td>
        <td><?=$rs_student->view_on_competition?></td>
    </tr>
    <tr>
        <td valign="top">What about Yellow Train's offering appeals to you?</td>
        <td><?=$rs_student->yt_offering?></td>
    </tr>
    <tr>
        <td valign="top">What is your idea of a free human being?</td>
        <td><?=$rs_student->idea_free_human?></td>
    </tr>
</table>
    
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showPreviousSchoolDtls" style="display:none">
    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td>Name of the School</td>
                    <td><?=$rs_student->previous_school_name?></td>
                    <td>Place of the School</td>
                    <td><?=$rs_student->previous_school_place?></td>
                </tr>
                <tr>
                    <td>Grades Attended</td>
                    <td><?=$rs_student->previous_grades_attended?></td>
                    <td>School Board</td>
                    <td><?=$rs_student->previous_school_board?></td>
                </tr>
                <tr>
                    <td>Year of Study</td>
                    <td><?=$previous_from =  $rs_student->previous_from;?>-<?=$previous_to =  $rs_student->previous_to?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showDocumentDtls" style="display:none">
    <tr>
        <td colspan="2">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td style="font-size:20px;">Document Name</td>
                    <td>&nbsp;</td>
                </tr>
				<? $document_of_student = unserialize($rs_student->document_type);
                $index = 0;
                if(count($document_of_student)>0 && !empty($document_of_student)){
					foreach($document_of_student as $M=>$N){
					?>
					<tr>
						<td><? echo ucfirst($document_of_student[$index]['document_name']);?> </td>
						<td align="left"><? echo ucfirst($document_of_student[$index]['filetitle']);?></td>
					</tr>
					<? $index++;
					}
					
                } else { ?>
                <tr align="center"><td>No Documents Available..!</td></tr>
                <? } ?>
            </table>
        </td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showFeesDtls" style="display:none">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                <tr>
                    <td>Registration Fees &nbsp;<?=$rs_student->registration_fee?></td>
                    <td>Term Fees&nbsp;<?=$rs_student->term_fees?></td>
                </tr>
                <tr>
                    <td>Material Fees&nbsp;<?=$rs_student->material_fee?></td>
                    <td>Food Fees&nbsp;<?=$rs_student->food_fee?></td>
                </tr>
                <tr>
                    <td>Does Student want Transport Facility?&nbsp;<?=($rs_student->is_transport=='Y')?"Yes":"No"; ?></td>
                </tr>
                <br/>
				<? if($rs_student->is_transport=='Y'){?> 
                <tr>
                	<td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                            <tr>
                                <td>Bus Route</td>
                                <td>
                                <?	$busRouteObj = new Transportation();
                                $busRouteObj->school_id = $_SESSION['SchoolId'];
                                $busRouteObj->id = $rs_student->bus_route_id;
                                $rsBusRoute = $busRouteObj->getBusRouteDtls();
                                echo $rsBusRoute->route_name;
                                ?> 
                                </td>
                                <td>Transport Fees</td>
                                <td><?=$rs_student->transportation_fees?></td>
                            </tr>
                            <tr>
                                <td>Bus Order From</td>				
                                <td><?=$rs_student->bus_order_from?></td>
                                <td>Bus Order To</td>
                                <td><?=$rs_student->bus_order_to?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <? }?> 
            
            </table>
        </td>
    </tr>

</table>


</div>