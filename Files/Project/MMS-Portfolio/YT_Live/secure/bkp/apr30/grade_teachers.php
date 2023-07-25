<?
$grade_obj = new Teacher();
$grade_obj->grade_id=$gradeId;
$rs_grade_teacher = $grade_obj->getAllGradeTeacherDtls();
?>
<div>
<?
if(count($rs_grade_teacher)>0) {
	$classTeaArr=array();
	foreach($rs_grade_teacher as $K=>$V) { 
		$classTeaArr[] = $V->is_class_teacher;
		$rs_teacher = Teacher::getTeachersByID($V->teacher_id);
		$teacherName = $rs_teacher->first_name." ".$rs_teacher->middle_name." ".$rs_teacher->last_name;
		
		$subArr = explode(",", $V->subject_id); $subNameArr=array();
		foreach($subArr as $kk=>$vv) {
			$rs_subject = Subject::getSubjectById($vv);
			$subNameArr[] = $rs_subject->subject_name;
		}
		$subject_name = "";
		$subject_name = implode(", ", $subNameArr);
?>
<div class="gradeteacher_list">
    <img src="<?=TEACHERS_FILE_HREF.$rs_teacher->photo?>" alt="<?=$rs_teacher->teacher_name?>" title="<?=$rs_teacher->teacher_name?>" width="161" height="120" /><br />
    <div style="width:75%; padding:5px; margin-left:19px;">
    	<img src="images/edit_icon.png" alt="Edit" title="Edit" align="absmiddle" class="cursor" onclick="showTeacherFrm('E', '<?=$gradeId?>', '<?=$V->id?>', '<?=$V->teacher_id?>')" />
        <? if($GLOBALS['isDelete']){ ?>
        <img src="images/delete_icon.png" alt="Un Assign Teacher" title="Un Assign Teacher" align="absmiddle" onclick="showTeacherFrm('D', '<?=$gradeId?>', '<?=$V->id?>')" class="cursor" />
        <? } ?>
       <? if($V->is_class_teacher=="Y") { ?> <img src="images/class_teacher_icon.png" alt="Class Teacher" title="Class Teacher" align="absmiddle" /> <? } ?>
       <span id="spSt<?=$V->id?>"></span>
       <script type="text/javascript">drwStatusChecked('<?=$V->id?>','<?=$V->is_class_teacher?>', '<?=$gradeId?>')</script>
    </div>
    <?=trim($teacherName)?> <br/>  <?=$subject_name?>
</div>
<?
	}
	if(!in_array("Y", $classTeaArr)) {
	?>
    <div class="txterror" style="clear:both; padding:20px;">Class teacher not yet added..!</div>
    <?
	}
	
} else {
	?>
    <div class="gradeteacher_list" style="padding:10px;">No teachers found..!</div>
    <?
}
?>
</div>
