<?
include "includes.php";

if($_POST['act']=='checkgradeNameExist') {
	ob_clean(); 
	$gradeNameObj = new Grade();
	$gradeNameObj->grade_name=$_POST['grade_name'];
	$gradeNameObj->grade_id=$_POST['grade_id'];
	//$gradeNameObj->school_id=$_POST['schoolId'];
	$rsGradeName = $gradeNameObj->getGradeDtls();	
	if(count($rsGradeName)>0){
		echo 'already exist';
	} else{
		echo 'not exist';
	}
	exit();	
}

if($_POST['act']=="saveGrades"){
	ob_clean();
	$today=time();
	$sqlDateTime = date('Y-m-d H:i:s',$today);
 	
	if($_POST['grade_id']!=""){
		Grade::updateGrade($_POST['school_id'], strtoupper($_POST['grade_name']), $_POST['section'], $_POST['term_fees'], $_POST['registration_fee'], $_POST['material_fee'], $_POST['food_fee'], $_POST['description'], $sqlDateTime, $_POST['grade_id']);
	 	$rs_grade_id = $_POST['grade_id'];
 	} else {
		$rs_grade_id = Grade::insertGrade($_POST['school_id'], strtoupper($_POST['grade_name']), $_POST['section'], $_POST['term_fees'], $_POST['registration_fee'], $_POST['material_fee'], $_POST['food_fee'], $_POST['description'], $sqlDateTime);
	}
	ob_clean();
	echo $rs_grade_id;
	
	exit();
}
if($gradeId!=""){
	$gradeDtls = Grade::getGradeById($gradeId);
}

?>
<input type="hidden" name="grade_id" id="grade_id" value="<?=$gradeId?>" />
<input type="hidden" name="school_id" id="school_id" value="<?=$schoolId?>" />


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="schooltbl">
  <tr>
    <td colspan="2">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
      <!--<tr>
        <td>Select School</td>
        <td valign="top">
            <select name="school_id" id="school_id" class="listbox">
            	<option value="">Choose School</option>
				<? 
                $rs_schools = School::getAllSchool(); 
                foreach($rs_schools as $sk=>$sv) { 
                ?>
                    <option value="<?=$sv->id?>" <?=($sv->id==$gradeDtls->school_id)?"selected":""?>><?=$sv->school_name?></option>
                <?
                }
                ?>
            </select>
        </td>
      </tr>-->
      <tr>
        <td>Grade Name</td>
        <td valign="top">
            <input type="text" class="txtbox" name="grade_name" id="grade_name" onblur="chkGradeNameExist();" value="<?=($gradeDtls->grade_name=="")?"Grade ":$gradeDtls->grade_name?>">
        </td>
      </tr>
      <tr id="gradeNameErr" style="display:none;">
        <td colspan="2" valign="top">
           <div style="color:#F00; float:left; padding-left:151px; margin:-13px;">Grade Name Already Exists!</div>
        </td>
      </tr>
      <tr>
       <td id="checkSectionErr">Section</td>
        <td>
          <?	$index1=0; 
                $sectionArr = explode(",", $gradeDtls->section);
                foreach($GLOBALS['Section'] as $FK=>$FV) { $index1++; 
                ?>
                    <input type="checkbox" id="section_<?=$FK?>" name="section" class="grade_section <?=($FK=="N")?"subclass":""?>" value="<?=$FK?>" <?=(in_array($FK, $sectionArr) || $FK=="N")?"checked":""?> onclick="checkSections('<?=$FK?>')" /><?=$FV?>
                <? 
                }
          ?>
         </td>
      </tr>
      <tr>
        <td>Term Fee</td>
        <td colspan="3"><img src="images/rs_icon.png" height="13" width="10"/>&nbsp;<input type="text" class="txtbox"  name="term_fees" id="term_fees" style="width:286px;" onkeypress="return isNumberKey(event)" value="<?=$gradeDtls->term_fees?>"></td>
      </tr>
      <tr>
        <td>Registration Fee</td>
        <td colspan="3"><img src="images/rs_icon.png" height="13" width="10"/>&nbsp;<input type="text" class="txtbox" name="registration_fee" id="registration_fee" style="width:286px;" onkeypress="return isNumberKey(event)" value="<?=$gradeDtls->registration_fee?>"></td>
      </tr>
      <tr>
        <td>Material Fee</td>
        <td colspan="3"><img src="images/rs_icon.png" height="13" width="10"/>&nbsp;<input type="text" class="txtbox" name="material_fee" id="material_fee" style="width:286px;" onkeypress="return isNumberKey(event)" value="<?=$gradeDtls->material_fee?>"></td>
      </tr>
      <tr>
        <td>Food Fee</td>
        <td colspan="3"><img src="images/rs_icon.png" height="13" width="10"/>&nbsp;<input type="text" class="txtbox" name="food_fee" id="food_fee" style="width:286px;" onkeypress="return isNumberKey(event)" value="<?=$gradeDtls->food_fee?>"></td>
      </tr>
      <tr>
        <td>Description</td>
        <td colspan="3"><textarea id="description" name="description" class="msgbox" cols="36"><?=stripslashes($gradeDtls->description)?></textarea></td>
      </tr>
    </table>
    </td>
  </tr>
  
   <tr>
    <td align="right" colspan="2">
    	<div class="fullsize txtwhite txtcenter f18">
        	<div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="saveGrade('<?=$gradeId?>')"><strong>Submit</strong></div>
        </div>
    </td>
  </tr>
</table>


<script type="text/javascript">

checkSections();
function checkSections(action) {
	
	/*if(action=="N") {
		$("input[name=option2]").click(function() {
		$("#selectall").prop("checked", false);
		});
	}
	
	var section = $('input[class=grade_section]:checked').map(function(){
		if(this.value=="N") { 
			$('#section_'+this.id).attr("checked", false);
		}
		//return this.value;
	}).get(); */
	
	var action1 = $('input[name=section]:checked').val();
	if(action=="" || action==undefined) action=action1; else action=action;
	if(action=='N'){
		if($('.subclass').is(":checked")) {
			$("input[name=section]").not($('.subclass')).attr('disabled', 'disabled');
			$("input[name=section]").not($('.subclass')).attr('checked', false);
		}else{
			$("input[name=section]").removeAttr('disabled');
		}
	}
	
	
}

function chkGradeNameExist() { 
	
	var err=0;
	var grade_name = $('#grade_name').val();
	var school_id = $('#school_id').val();
	
	var param = '&schoolId='+school_id+'&grade_name='+grade_name;
	
	if($('#grade_name').val()=='' || $('#grade_name').val()=='Grade' || $('#grade_name').val()=='Grade '){ err=1; $('#grade_name').addClass('boxerror'); } else { $('#grade_name').removeClass('boxerror'); }
	if($('#school_id').val()==''){ err=1; $('#school_id').addClass('boxerror'); } else { $('#school_id').removeClass('boxerror'); }
	
	if($('#grade_id').val()>0 && $('#grade_id').val()!=undefined) param += '&grade_id='+$('#grade_id').val();
	
	if(err==0) {
		ajax({
			a:'grade_add',
			b:'act=checkgradeNameExist'+param,
			c:function(){},
			d:function(data){
				//alert(data);
				if($.trim(data)=='already exist'){
					$('#gradeNameErr').show();
					$('#grade_name').val('');
					$('#grade_name').focus();
				}
				else{
					$('#gradeNameErr').hide();
				}
			}
		});
	}
	
}

function saveGrade(grade_id){
	if(grade_id!="" && grade_id!=undefined) grade_id=grade_id; else grade_id="";
	
	var school_id = $.trim($('#school_id').val());
	var	grade_name = $("#grade_name").val();
	var section = new Array();
	$('input[name="section"]:checked').each(function() {
		section.push(this.value);
	});
	var	term_fees = $("#term_fees").val();
	var	registration_fee = $("#registration_fee").val();
	var	material_fee = $("#material_fee").val();
	var	food_fee = $("#food_fee").val();
	var	description = $("#description").val();
	
	var err=0; 

	if($('#school_id').val()==''){ err=1; $('#school_id').addClass('boxerror'); } else { $('#school_id').removeClass('boxerror'); }
	if($('#grade_name').val()=='' || $('#grade_name').val()=='Grade' || $('#grade_name').val()=='Grade '){ err=1; $('#grade_name').addClass('boxerror'); } else { $('#grade_name').removeClass('boxerror'); }
	if($.trim($('input[name=section]:checked').val())==''){ err=1; $('#checkSectionErr').addClass('txterror'); } else { $('#checkSectionErr').removeClass('txterror'); }
	if($('#term_fees').val()==''){ err=1; $('#term_fees').addClass('boxerror'); } else { $('#term_fees').removeClass('boxerror'); }
	if($('#registration_fee').val()==''){ err=1; $('#registration_fee').addClass('boxerror'); } else { $('#registration_fee').removeClass('boxerror'); }
	if($('#material_fee').val()==''){ err=1; $('#material_fee').addClass('boxerror'); } else { $('#material_fee').removeClass('boxerror'); }
	if($('#food_fee').val()==''){ err=1; $('#food_fee').addClass('boxerror'); } else { $('#food_fee').removeClass('boxerror'); }

	if(err==0) {

		ajax({
			a:'grade_add',
			b:'act=saveGrades&grade_name='+grade_name+'&section='+section+'&term_fees='+term_fees+'&registration_fee='+registration_fee+'&material_fee='+material_fee+'&food_fee='+food_fee+'&description='+description+'&grade_id='+grade_id+'&school_id='+school_id,		
			c:function(){},
			d:function(data){
				//alert(data);
				<? if($newAction!="" && $newAction!="undefined") { ?>
					upgradeStudentGrade('', $.trim(data)); 
				<? } else { ?>
				if(grade_id!="") {
					alert("Grade Updated Successfully");
				} else {
					alert("Grade Added Successfully");
				}
				<? } ?>
				closePopup();
				showGradebySchl(school_id);
			}			
		});
	}
}

</script>