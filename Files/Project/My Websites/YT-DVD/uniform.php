<?
function main() {
	
if($_POST['act']=="saveUniformFrm") {
	ob_clean();
	$studentId = base64_decode($_POST['studentId']); 
	$fieldsArr=array();
	$fieldsArr[] = "t_shirts='".$_POST['extraDress1']."'";
	$fieldsArr[] = "skirts_pants='".$_POST['extraDress2']."'";
	$fieldsArr[] = "dress_notes='".check_input($_POST['extraNotes'])."'";
	Student::updateStudentByFields($fieldsArr, $studentId);
	$studentGender = explode("~~", $_POST['studentGender']);
	if($studentGender[0]=="F") $text = "Skirts";
	else { if($studentGender[1]==9) $text="Pants"; 
		else if($studentGender[1]>=4 && $studentGender[1]<=8) $text="Shorts";
	}
	?>
    <p style="color:#096">Thank you for submitting details.</p>
    <p style="color:#096">You have chosen extra <?=$_POST['extraDress1']?> T-Shirts and <?=$_POST['extraDress2']?> <?=$text?><br />
     If you wish you change the details, please refresh the page to load the form again!</p>
	<?
	
	exit();
}

?>

<div class="full_width"> 
<div class="content">

    <div class="full_width ytmethod_row2out"> 
        <div class="" style="height:30%; clear:both;">
            <?
			$error=0;
			if($_REQUEST['student_id']!="" && $_REQUEST['email_address']!="") {
				$studentId = base64_decode($_REQUEST['student_id']); 
				$emailAddress = base64_decode($_REQUEST['email_address']);
				$rs_student = Student::getStudentById($studentId);
				$rs_grade = Grade::getGradeById($rs_student->grade_id);
				$student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
				if($rs_student->gender=="F") $extraHead="Skirts";
				else if($rs_student->gender=="M") {
					if($rs_student->grade_id==9) $extraHead="Pants"; 
					else if($rs_student->grade_id>=4 && $rs_student->grade_id<=8) $extraHead="Shorts";
				}
				$subValue = $rs_student->gender."~~".$rs_student->grade_id;
			?>
            <div class="contact_background" align="center" style="margin:0 auto;" id="contentTbl">
         
            <table border="0" cellpadding="5" cellspacing="0" width="98%" style="margin-top:20px;">
            	<tr>
                	<td height="40" colspan="2" valign="top" style="padding-left:10px;"><strong><?=$student_name?>
               	    <br /><?=$rs_grade->grade_name?></strong></td>
                </tr>
                <tr><td style="border-top:1px solid #666" colspan="2">&nbsp;</td></tr>
            	<tr>
                	<td colspan="2" height="40">Please fill the following form with your requirements for extra uniform.</td>
                </tr>
                <tr>
                	<td width="32%" height="40" align="right" style="padding-right:10px;"><strong>T-Shirts:</strong></td>
                    <td width="68%" valign="middle"><input type="text" style="width:50%; padding:5px; max-width:50px;" class="txtbox" id="extra_dress1" name="extra_dress1" value="<?=$rs_student->t_shirts?>" onKeyPress="return isNumberKey(event)" /> 
                      Nos</td>
                </tr>
                <tr>
                	<td height="40" align="right" style="padding-right:10px;"><strong><?=$extraHead?>:</strong></td>
                    <td valign="middle"><input type="text" style="width:50%; padding:5px;max-width:50px;" class="txtbox" id="extra_dress2" name="extra_dress2" value="<?=$rs_student->skirts_pants?>" onKeyPress="return isNumberKey(event)" /> 
                      Nos</td>
                </tr>
                <tr>
                	<td height="40" valign="top" align="right" style="padding-right:10px;"><strong>Notes(if any):</strong></td>
                    <td><textarea style="width:50%; padding:5px;" class="msgbox" id="extra_dress_notes" name="extra_dress_notes"><?=$rs_student->dress_notes?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" align="right" height="80" valign="bottom">
                    	<div class="contact_submitbtn" onclick="submitUniformFrm('<?=$_REQUEST['student_id']?>', '<?=$subValue?>')" style="background:url(images/menu_bg.jpg) no-repeat; font-weight:bold;" id="submitBtn">Submit</div>
                        <div class="contact_submitbtn" style="background:url(images/menu_bg.jpg) no-repeat; font-weight:bold; display:none;" id="saveBtn">Saving..</div>
                        <div id="updatedMsg" style="display:none;"></div>
                    </td>
                </tr>
            </table>
            </div>
            <?
			} 
			else {
				echo $err_msg = "Could not find the student details";
			} 
			?>
        	
        </div>
    </div>

</div>
</div>

<div class="full_width" style="height:230px; background:url(images/slide_texture.png) repeat;"></div>

<script type="text/javascript">

function submitUniformFrm(studentId, gender) {
	
	var err = 0;
	var extraNotes = escape($.trim($('#extra_dress_notes').val()));
	if($('#extra_dress1').val()=='') { err=1; $('#extra_dress1').addClass('boxred'); } else { var extraDress1 = $.trim($('#extra_dress1').removeClass('boxred').val()); }
	if($('#extra_dress2').val()=='') { err=1; $('#extra_dress2').addClass('boxred'); } else { var extraDress2 = $.trim($('#extra_dress2').removeClass('boxred').val()); }
	
	if(err==0){
		$('#saveBtn').show();
		$('#submitBtn').hide();
		ajax({
			a:'uniform',
			b:'act=saveUniformFrm&extraDress1='+extraDress1+'&extraDress2='+extraDress2+'&studentId='+studentId+'&extraNotes='+extraNotes+'&studentGender='+gender,		
			c:function(){},
			d:function(data){ //alert(data); return false;
				$('#saveBtn').hide();
				$('#submitBtn').hide();
				$('#contentTbl').html(data);
			}			
		});
	}
}

</script>


<? 
}
include "template.php";
?>