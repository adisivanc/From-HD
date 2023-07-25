<? if($rs_teacher->id!="") $headName = "Update"; else $headName = "Add New"; ?>
<h3 class="pull_left">
<strong><?=$headName?> Teacher</strong>
<div class="combutton pull_right" onClick="showTeacherDtls('TL', '', '<?=$status?>');">Teacher List</div>
</h3>

<form name="teacherFrm" id="teacherFrm" method="post" enctype="multipart/form-data" action="teacher.php">
<input type="hidden" name="act" value="saveTeacherFrm" />
<input type="hidden" name="submit_action" id="submit_action" value="" />
<input type="hidden" name="teacher_db_id" id="teacher_db_id" value="<?=$rs_teacher->id?>" />
<div class="fullsize_pad padtb10 lineht1_8">
    <p class="pull_left marginright20">Select School</p>
    <select id="school_id" name="school_id" class="listbox">
    <option value="">Select</option>
    <? $school_name = School::getAllSchool();
    foreach($school_name as $M=>$N){
    ?>
    <option <? if($rs_teacher->school_id==$N->id){ ?>selected="selected"<? } ?> value="<?=$N->id?>"><?=$N->school_name?></option>
    <? }?>
    </select>
</div>
<div class="newsletter_cntr">
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl border_bottom">
      <tr>
        <td width="25%" valign="top" class="txtright"><span class="marginright20">Name</span></td>
        <td>
            <!--<input type="text" style="width:8%;" class="txtbox" id="teacher_prefix" name="teacher_prefix" value="" />-->
            <select name="teacher_prefix" id="teacher_prefix" style="width:8%;" class="listbox">
                <? foreach($GLOBALS['Prefixes'] as $k=>$v) { ?>
					<option value="<?=$v?>" <?=($rs_teacher->prefix==$v)?"selected":""?>><?=$v?></option>
				<? } ?>
            </select>
            <input type="text" style="width:26%;" class="txtbox" id="teacher_firstname" name="teacher_firstname" value="<?=$rs_teacher->first_name?>" />
            <input type="text" style="width:26%;" class="txtbox" id="teacher_middlename" name="teacher_middlename" value="<?=$rs_teacher->middle_name?>" />
            <input type="text" style="width:26%;" class="txtbox" id="teacher_lastname" name="teacher_lastname" value="<?=$rs_teacher->last_name?>" />
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="txtright"><span class="marginright20" id="gendererr">Gender</span></td>
        <td>
            <input type="radio" class="" id="teacher_gender" name="teacher_gender" value="M" <?=($rs_teacher->gender=="M")?"checked":""?> /> Male
            <input type="radio" class=" marginleft20" id="teacher_gender" name="teacher_gender" value="F" <?=($rs_teacher->gender=="F" || $rs_teacher->gender=="")?"checked":""?> /> Female
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="txtright"><span class="marginright20">Date of Birth</span></td>
        <td>
        	<? $dobArr = explode("-", $rs_teacher->date_of_birth); ?>
            <select name="birth_date" id="birth_date" class="listbox" style="width:80px;">
                <option value="">Date</option>
                <? for($i=1;$i<32;$i++){ ?>
                <option <? if($dobArr[2]==$i){ ?>selected="selected"<? } ?>  value="<?=$i?>"><?=$i?></option>
                <? } ?>
            </select>
            
            <? $rs_month = currentYearMonth(); ?>
            <select  name="birth_month" id="birth_month" class="listbox" style="width:150px;">
                <option value="">Month</option>
                <? foreach($rs_month as $mk=>$mv){ ?>
                <option <? if($dobArr[1]==$mk){ ?>selected="selected"<? } ?>  value="<?=$mk?>"><?=$mv?></option>
                <? } ?>
            </select>
            
            <? $rs_year = listofyears(1947, date('Y', strtotime("-15 years"))); ?> 
            <select  name="birth_year" id="birth_year" class="listbox" style="width:70px;">
                <option value="">Year</option>
                <? foreach($rs_year as $yk=>$yv){ ?>
                <option <? if($dobArr[0]==$yv){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
                <? } ?>
            </select>
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="txtright"><span class="marginright20" id="gendererr">Marital Status</span></td>
        <td>
            <input type="radio" class="" id="marital_status" name="marital_status" value="S" <?=($rs_teacher->marital_status=="S" || $rs_teacher->marital_status=="")?"checked":""?> /> Single
            <input type="radio" class=" marginleft20" id="marital_status" name="marital_status" value="M" <?=($rs_teacher->marital_status=="M")?"checked":""?> /> Married
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="txtright"><span class="marginright20" id="photoerr">Photo</span></td>
        <td>
        	<input type="file" class="" id="teacher_photo" name="teacher_photo" value="<?=$rs_teacher->photo?>" /> <?=$rs_teacher->photo?>
            <input type="hidden" name="h_teacher_photo" id="h_teacher_photo" value="<?=$rs_teacher->photo?>" />
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="txtright"><span class="marginright20">Username</span></td>
        <td><input type="text" style="width:70%;" class="txtbox" id="teacher_user_name" name="teacher_user_name" onblur="chkUserNameExist();" value="<?=$rs_teacher->user_name?>" />
        	<div id="userNameErr" class="txterror" style="display:none;"></div>
        </td>
      </tr>
      <tr>
        <td width="25%" valign="top" class="txtright"><span class="marginright20">Password</span></td>
        <td><input type="password" style="width:70%;" class="txtbox" id="teacher_password" name="teacher_password" value="<?=$rs_teacher->password?>" /></td>
      </tr>
      
    </table>

    
    <div class="fullsize border_bottom padtop15">
        <h2 class="form_head">Contact Info</h2>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
          <tr>
            <td width="25%" valign="top" class="txtright"><span class="marginright20">Address</span></td>
            <td><textarea style="width:70%;" class="msgbox" id="teacher_address" name="teacher_address"><?=$rs_teacher->address?></textarea></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Email Address</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="teacher_email" name="teacher_email" value="<?=$rs_teacher->email_address?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Phone Number</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="teacher_phone" name="teacher_phone" value="<?=$rs_teacher->phone?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Mobile Number</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="teacher_mobile" name="teacher_mobile" value="<?=$rs_teacher->mobile?>" /></td>
          </tr>
        </table>

        <h2 class="form_head padtop10">Emegency Contact Info</h2>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
          <tr>
            <td width="25%" valign="top" class="txtright"><span class="marginright20">Name</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="emer_name" name="emer_name" value="<?=$rs_teacher->emergency_name?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Relationship</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="emer_relations" name="emer_relations" value="<?=$rs_teacher->emergency_relation?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Contact Number</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="emer_number" name="emer_number" value="<?=$rs_teacher->emergency_number?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20" id="verifiederr">Verified</span></td>
            <td>
                <input type="radio" class="" id="is_verified" name="is_verified" value="Y" <?=($rs_teacher->is_verified=="Y" || $rs_teacher->is_verified=="")?"checked":""?> /> Yes
                <input type="radio" class=" marginleft20" id="is_verified" name="is_verified" value="N" <?=($rs_teacher->is_verified=="N")?"checked":""?> /> No
            </td>
          </tr>
        </table>
    </div>
    
    <style>
	.threecolumdiv{ float:left; width:100%;}
    </style>
    <div class="fullsize border_bottom padtop15">
        <h2 class="form_head">Education Info</h2>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
          <tr>
            <td width="25%" valign="top" class="txtright"><span class="marginright20">Qualification</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="teacher_qualification" name="teacher_qualification" value="<?=$rs_teacher->qualification?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Desigination</span></td>
            <td><input type="text" style="width:70%;" class="txtbox" id="teacher_designation" name="teacher_designation" value="<?=$rs_teacher->designation?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20" id="handlingerr">Subject Handling</span></td>
            <td>
            <div class="threecolumdiv">
			<? 	$subjectArr=explode(",", $rs_teacher->subject_id);
				$sub_obj = new Subject();
				$sub_obj->orderby = 'id';
				$sub_obj->sortby = 'ASC';
				//$sub_obj->groupby = 'subject_name';
				$sub_obj->fields = 'id, subject_name';
				$rs_subjects = $sub_obj->getAllSubjectDtls();
				$index=1;
				if(count($rs_subjects)>0) {
					foreach($rs_subjects as $kk=>$vv) {
					?>
                    <div style="float:left; width:33%;">
                    	<input type="checkbox" class="teacher_handling" id="teacher_handling" name="teacher_handling[]" value="<?=$vv->id?>" <?=(in_array($vv->id, $subjectArr))?"checked":""?> /> <?=$vv->subject_name?>
                    </div>
					<?	
					if($index%3==0) echo "</div> <div class='threecolumdiv'>"; $index++;
					}
				} else {
					echo "Subjects not yet added, first add subjects and then add teachers.";
				}
            ?>
            </div>
            	
            </td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Year of Experience</span></td>
            <td><input type="text" style="width:25%;" class="txtbox" id="teacher_exp" name="teacher_exp" value="<?=$rs_teacher->year_of_experience?>" /></td>
          </tr>
          <tr>
            <td valign="top" class="txtright"><span class="marginright20">Date of Joining</span></td>
            <td>
                <? $dobArr = explode("-", $rs_teacher->date_of_joining); ?>
                <select name="joining_date" id="joining_date" class="listbox" style="width:80px;">
                    <option value="">Date</option>
                    <? for($i=1;$i<32;$i++){ ?>
                    <option <? if($dobArr[2]==$i){ ?>selected="selected"<? } ?>  value="<?=$i?>"><?=$i?></option>
                    <? } ?>
                </select>
                
                <? $rs_month = currentYearMonth(); ?>
                <select name="joining_month" id="joining_month" class="listbox" style="width:150px;">
                    <option value="">Month</option>
                    <? foreach($rs_month as $mk=>$mv){ ?>
                    <option <? if($dobArr[1]==$mk){ ?>selected="selected"<? } ?>  value="<?=$mk?>"><?=$mv?></option>
                    <? } ?>
                </select>
                
                <? $rs_year = listofyears(2005, date('Y', strtotime("+20 years"))); ?> 
                <select name="joining_year" id="joining_year" class="listbox" style="width:70px;">
                    <option value="">Year</option>
                    <? foreach($rs_year as $yk=>$yv){ ?>
                    <option <? if($dobArr[0]==$yv){ ?>selected="selected"<? } ?>  value="<?=$yv?>"><?=$yv?></option>
                    <? } ?>
                </select>
            </td>
          </tr>
        </table>
    </div>
    
    <div class="fullsize txtwhite txtcenter f18">
    	<? if($rs_teacher->id!="") $buttonName = "UPDATE"; else $buttonName = "ADD"; ?>
        <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="submitTeacher('C')"><strong>CANCEL</strong></div>
        <? if($rs_teacher->teacher_status!="A") { ?><div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="submitTeacher('N')"><strong>SAVE</strong></div><? } ?>
        <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="submitTeacher('A')"><strong><?=$buttonName?></strong></div>
        <? if($rs_teacher->id!="") { ?><div class="bgbrown pull_right margintb10 cursor padlr20 padtb10" onClick="submitTeacher('I')"><strong>Archive</strong></div><? } ?>
    </div> 
    
    
</div>
</form>

<script type="text/javascript">

function chkUserNameExist() { 
	
	var err=0;
	var user_name = $('#teacher_user_name').val();
	var param = '&user_name='+user_name;
	
	if($('#teacher_user_name').val()==''){ err=1; $('#teacher_user_name').addClass('boxerror'); } else { $('#teacher_user_name').removeClass('boxerror'); }
	if($('#teacher_db_id').val()>0 && $('#teacher_db_id').val()!=undefined) param += '&teacher_id='+$('#teacher_db_id').val();
	
	if(err==0) { 
		ajax({
			a:'teacher',
			b:'act=checkUserNameExist'+param,
			c:function(){},
			d:function(data){
				//alert(data);
				if($.trim(data)=='already exist'){
					$('#userNameErr').show();
					$('#userNameErr').html('Username already exists..!');
					$('#teacher_user_name').val('');
					$('#teacher_user_name').focus();
				}
				else{
					$('#userNameErr').hide();
					$('#userNameErr').html('');
				}
			}
		});
	}
	
}

function submitTeacher(action){ 

	$('#submit_action').val(action);
	
	if(action=="C") {
		showTeacherDtls('TL', '', '<?=$status?>');
		return false;
	}
	
	var err=0;
	if($('#school_id').val()==''){ err=1; $('#school_id').addClass('boxerror'); } else { $('#school_id').removeClass('boxerror'); }
	if($('#teacher_prefix').val()==''){ err=1; $('#teacher_prefix').addClass('boxerror'); } else { $('#teacher_prefix').removeClass('boxerror');}
	if($('#teacher_firstname').val()==''){ err=1; $('#teacher_firstname').addClass('boxerror'); } else { $('#teacher_firstname').removeClass('boxerror'); }
	if($('input[name=teacher_gender]:checked').val()==undefined){ err=1; $('#gendererr').addClass('txterror'); } else { $('#gendererr').removeClass('txterror'); }
	if($('#birth_date').val()==''){ err=1; $('#birth_date').addClass('boxerror'); } else { $('#birth_date').removeClass('boxerror'); }
	if($('#birth_month').val()==''){ err=1; $('#birth_month').addClass('boxerror'); } else { $('#birth_month').removeClass('boxerror'); }
	if($('#birth_year').val()==''){ err=1; $('#birth_year').addClass('boxerror'); } else { $('#birth_year').removeClass('boxerror'); }
	if($('#teacher_user_name').val()==''){ err=1; $('#teacher_user_name').addClass('boxerror'); } else { $('#teacher_user_name').removeClass('boxerror'); }
	if($('#teacher_password').val()==''){ err=1; $('#teacher_password').addClass('boxerror'); } else { $('#teacher_password').removeClass('boxerror'); }
	
	<? if($rs_teacher->id!="") { ?>
	if($('#h_teacher_photo').val()==''){ err=1; $('#photoerr').addClass('txterror'); } else { $('#photoerr').removeClass('txterror');}
	<? } else { ?>
	if($('#teacher_photo').val()==''){ err=1; $('#photoerr').addClass('txterror'); } else { $('#photoerr').removeClass('txterror');}
	<? } ?>
	
	if($('#teacher_address').val()==''){ err=1; $('#teacher_address').addClass('boxerror'); } else { $('#teacher_address').removeClass('boxerror'); }
	if($('#teacher_email').val()=='')
	{
		err=1;
		$('#teacher_email').addClass('boxerror');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#teacher_email').val()) == false) 
		{
			err=1;
			$('#teacher_email').addClass('boxerror');
		}
		else{
			$('#teacher_email').removeClass('boxerror');
		}
	}
	
	if($('#teacher_phone').val()==''){ err=1; $('#teacher_phone').addClass('boxerror'); } else { $('#teacher_phone').removeClass('boxerror'); }
	if($('#teacher_mobile').val()==''){ err=1; $('#teacher_mobile').addClass('boxerror'); } else { $('#teacher_mobile').removeClass('boxerror'); }
	
	if($('#emer_name').val()==''){ err=1; $('#emer_name').addClass('boxerror'); } else { $('#emer_name').removeClass('boxerror'); }
	if($('#emer_relations').val()==''){ err=1; $('#emer_relations').addClass('boxerror'); } else { $('#emer_relations').removeClass('boxerror'); }
	if($('#emer_number').val()==''){ err=1; $('#emer_number').addClass('boxerror'); } else { $('#emer_number').removeClass('boxerror'); }
	if($('input[name=is_verified]:checked').val()==undefined){ err=1; $('#verifiederr').addClass('txterror'); } else { $('#verifiederr').removeClass('txterror'); }
	
	if($('#teacher_qualification').val()==''){ err=1; $('#teacher_qualification').addClass('boxerror'); } else { $('#teacher_qualification').removeClass('boxerror'); }
	if($('#teacher_designation').val()==''){ err=1; $('#teacher_designation').addClass('boxerror'); } else { $('#teacher_designation').removeClass('boxerror'); }
	if($('input[class=teacher_handling]:checked').val()==undefined){ err=1; $('#handlingerr').addClass('txterror'); } else { $('#handlingerr').removeClass('txterror'); }
	if($('#teacher_exp').val()==''){ err=1; $('#teacher_exp').addClass('boxerror'); } else { $('#teacher_exp').removeClass('boxerror'); }
	if($('#joining_date').val()==''){ err=1; $('#joining_date').addClass('boxerror'); } else { $('#joining_date').removeClass('boxerror'); }
	if($('#joining_month').val()==''){ err=1; $('#joining_month').addClass('boxerror'); } else { $('#joining_month').removeClass('boxerror'); }
	if($('#joining_year').val()==''){ err=1; $('#joining_year').addClass('boxerror'); } else { $('#joining_year').removeClass('boxerror'); }

	if(err==0) {
		document.teacherFrm.submit();
	}
}
</script>