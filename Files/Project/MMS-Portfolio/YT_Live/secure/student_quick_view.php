<? 
$rs_student = Student::getStudentById($studentId);
$rs_grade = Grade::getGradeById($rs_student->grade_id);
$studentName = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
?> 

<style>
.tdhead{font-weight:bold;}
</style>

<div class="fullsize border_theme pad10" style="width:98%;">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl" id="showBasicDtls">
    
    <tr>
    	<td style="padding:0px" width="50%">
        	<table border="0" cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                    <td><span class="form_head">Student Details</span></td>
                </tr>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                                <td width="42%" class="tdhead">Student Name </td>
                                <td width="2%">:</td>
                                <td width="56%"><?=trim($studentName)?></td>
                            </tr>
                            <tr>
                                <td class="tdhead">Gender </td>
                                <td width="2%">:</td>
                                <td><?=($rs_student->gender=='M')?"Male":"Female"?> </td>
                            </tr>
                            <tr>
                                <td class="tdhead">Date of Birth </td>
                                <td width="2%">:</td>
                                <td><?=date('d-m-Y',strtotime($rs_student->date_of_birth)); ?> </td>
                            </tr>
                            <tr>
                                <td class="tdhead">Grade </td>
                                <td width="2%">:</td>
                                <td><?=$rs_grade->grade_name?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td><span class="form_head">Family Details</span></td>
                </tr>
                <tr>
                    <td valign="top">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                             <? if($rs_student->is_parent=='P') { ?> 
                            <tr>
                                <td style="padding:0px;"> <h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Father Details</h3>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                                        <tr>
                                            <td width="41%" class="tdhead">Father Name </td>
                                            <td width="2%">:</td>
                                            <td width="57%"><?=$rs_student->father_name?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Father Email </td>
                                            <td width="2%">:</td>
                                            <td><?=getEmptyValues($rs_student->father_email)?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Father Phone </td>
                                            <td width="2%">:</td>
                                            <td><?=getEmptyValues($rs_student->father_phone)?></td>
                                        </tr>
                                        <? if($rs_student->father_qualification!="") { ?>
                                        <tr>
                                            <td class="tdhead">Qualification </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->father_qualification?></td>
                                        </tr>
                                        <? } ?>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" style="padding:0px; padding-top:15px;"><h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Mother Details</h3>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                                        <tr>
                                            <td width="41%" class="tdhead">Mother Name </td>
                                            <td width="2%">:</td>
                                            <td width="57%"><?=$rs_student->mother_name?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Mother Email </td>
                                            <td width="2%">:</td>
                                            <td><?=getEmptyValues($rs_student->mother_email)?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Mother Phone </td>
                                            <td width="2%">:</td>
                                            <td><?=getEmptyValues($rs_student->mother_phone)?></td>
                                        </tr>
                                        <? if($rs_student->mother_qualification!="") { ?>
                                        <tr>
                                            <td class="tdhead">Qualification </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->mother_qualification?></td>
                                        </tr>
                                        <? } ?>
                                    </table>
                                </td>
                            </tr>
                            <? } ?>
                        
                            <? if($rs_student->is_parent=='G') { ?> 
                            <tr>
                                <td colspan="4" style="padding:0px;"> <h3 class="txtbold">Guardian Details</h3>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                                        <tr>
                                            <td width="38%" class="tdhead">Guardian Name :</td>
                                            <td width="62%"><?=$rs_student->guardian_name?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <? }?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    
    	<td style="padding:0px" width="50%" valign="top">
        	<table border="0" cellpadding="0" cellspacing="0" width="100%">
            	<tr>
                    <td><span class="form_head">Contact Details</span></td>
                </tr>
                <tr>
                    <td valign="top"> <h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Emergency Contact Details</h3>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                                <td width="43%" class="tdhead">Name </td>
                                <td width="2%">:</td>
                                <td width="55%"><?=getEmptyValues($rs_student->emergency_contact_name)?></td>
                            </tr>
                            <tr>
                                <td class="tdhead">Number </td>
                                <td width="2%">:</td>
                                <td><?=getEmptyValues($rs_student->emergency_contact_number)?> </td>
                            </tr>
                            <tr>
                                <td class="tdhead">Email </td>
                                <td width="2%">:</td>
                                <td><?=getEmptyValues($rs_student->email_address)?> </td>
                            </tr>
                            <tr>
                                <td class="tdhead">Relationship</td>
                                <td width="2%">:</td>
                                <td><?=getEmptyValues($rs_student->emergency_contact_relationship)?> </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td><span class="form_head">Address</span></td>
                </tr>
                <tr>
                    <td valign="top" style="padding:0px">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                                <td> 
                                	<h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Current Address</h3>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                                        <tr>
                                            <td width="41%" class="tdhead">Address </td>
                                            <td width="2%">:</td>
                                            <td width="57%" style="line-height:21px;"><?=$rs_student->current_address?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">State </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->current_state?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">City </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->current_city?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Zipcode </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->current_zipcode?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <? if($rs_student->permanent_address!="") { ?>
                            <tr>
                              <td> <h3 class="txtbold" style="color:#996c2c; font-weight:bold; font-size:17px;">Permanent Address</h3>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="studentinnertbl">
                                        <tr>
                                            <td width="41%" class="tdhead">Address </td>
                                            <td width="2%">:</td>
                                            <td width="57%" style="line-height:21px;"><?=$rs_student->permanent_address?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">State </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->permanent_state?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">City </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->permanent_city?></td>
                                        </tr>
                                        <tr>
                                            <td class="tdhead">Zipcode </td>
                                            <td width="2%">:</td>
                                            <td><?=$rs_student->permanent_zipcode?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <? } ?>
                        
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    
    </tr>
    
</table>


</div>