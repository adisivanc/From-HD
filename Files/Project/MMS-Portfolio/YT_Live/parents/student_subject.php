<?

$subjectObj = new Subject();
$subjectObj->grade_id =$gradeId;
$subjectObj->fields = '*';
$rsSubjects =$subjectObj->getAllGradeSubjectDtls(); 
?>


    <table width="97%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; ">
      <tr>
        <td>
			<?
			if(count($rsSubjects)>0)
			{
			 foreach($rsSubjects as $K=>$V) 
			{
			$rsSubject=Subject::getSubjectById($V->subject_id);
			
			
			$teacherObj = new Teacher();
			$teacherObj->grade_id =$gradeId;
			$teacherObj->subject_id =$V->subject_id;
			$teacherObj->fields ='teacher_id';
			$rsTeacher = $teacherObj->getAllGradeTeacherDtls();
			
		if($rsTeacher[0]->teacher_id>0) {
			
			$teacherObj = new Teacher();
			$teacherObj->id = $rsTeacher[0]->teacher_id;
			$teacherDtl = $teacherObj->getTeachersDtls();
			$teacherName = $teacherDtl->first_name.' '.$teacherDtl->middle_name.' '.$teacherDtl->last_name;
			$email_address=$teacherDtl->email_address;
			
			?>
            <div class="student_teacher">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2"><img src="../uploads1/teachers_photos/<?=$teacherDtl->photo?>" alt="<?=$teacherName ?>"/></td>
                  </tr>
                  <tr>
                    <td><p><?=$teacherName ?> <br/><? echo $rsSubject->subject_name;?></p></td>
                    <td width="60"><img src="images/mail1_icon.png" alt="" align="absmiddle" style="width:27px; height:27px; cursor:pointer;" onclick="getSendEmail('T-<?=$rsTeacher[0]->teacher_id?>','<?=$student_id?>','<?=$email_address?>')"/></td>
                  </tr>
                </table>
            </div>
			<?
			}
			}
			}
			else
			{echo "No Teachers Assigned";}
			?>
        </td>
      </tr>
    </table>
<script type="text/javascript">
function getSendEmail(teacher_id,student_id,email_address)
{
	var members=[];
	var emailIds=[];
	members.push(teacher_id);
	emailIds.push(email_address);
	var paramData={"act":"getSendEmail",
						"members":members,"emailIds":emailIds,"student_id":student_id}
	ajax({
				a:'communications',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#student_content').html(data);
					$("#showon_compose").show();
					$('.sub_nav').removeClass('active');
					$('#comm_mail').addClass('active');
				
				}
			});	
	
		
}


</script>