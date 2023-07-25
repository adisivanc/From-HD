<?
$grade_obj = new Subject();
$grade_obj->grade_id=$gradeId;
$rs_grade_subject = $grade_obj->getAllGradeSubjectDtls();
?>

<input type="hidden" name="subject_grade_id" id="subject_grade_id" value="<?=$gradeId?>" />
<input type="hidden" name="subject_school_id" id="subject_school_id" value="<?=$page?>" />

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:7px auto;" class="gradetbl"> <!--Subjects Tab-->
  <tr>
    <th width="11%">S.No</th>
    <th width="26%" align="left">Subject Name</th>
    <th width="27%" align="left">Description</th>
    <th width="20%" align="left">Teacher Name</th>
    <th width="16%">Action</th>
  </tr>
  
  <?
  if(count($rs_grade_subject)>0) {
	  foreach($rs_grade_subject as $K=>$V) {
		  $rs_subject = Subject::getSubjectById($V->subject_id);
		  
		  $teacher_obj = new Teacher();
		  $teacher_obj->subject_id=$V->subject_id;
		  $teacher_obj->grade_id=$V->grade_id;
		  $teacher_obj->school_id=$V->school_id;
		  $rs_teacher = $teacher_obj->getAllGradeTeacherDtls();
		  
		  $teacherArr=array();
		  if(count($rs_teacher)>0) {
			  foreach($rs_teacher as $kk=>$vv) {
				  $rs_teacher_name =  Teacher::getTeachersById($vv->teacher_id);
				  $teacher_name = $rs_teacher_name->first_name." ".$rs_teacher_name->middle_name." ".$rs_teacher_name->last_name;
				  $teacherArr['Name']=trim($teacher_name);
			  }
		  }
		  
	?>
  <tr>
    <td><?=($K+1)?></td>
    <td align="left"><?=$rs_subject->subject_name?></td>
    <td align="left"><?=$rs_subject->description?></td>
    <td align="left"><?=$teacherArr['Name']?></td>
    <td>
    	<? if($GLOBALS['isDelete']){ ?><img src="images/delete_icon.png" alt="Delete" title="Delete" class="cursor" onclick="showSubFrm('D', <?=$gradeId?>, <?=$V->id?>)" /><? } ?>
    </td>
  </tr>
  <?
	  }
  } else {
	  ?>
      <tr>
        <td colspan="5">No subjects found..!</td>
      </tr>
      <?
  }
  ?>
</table>