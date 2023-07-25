<?
$teacher_name = $rs_teacher->prefix.".".$rs_teacher->first_name." ".$rs_teacher->last_name;
$rs_subject = Subject::getSubjectsByIds($rs_teacher->subject_id);
$subjects = implode(", ", $rs_subject);
$rs_school = School::getSchoolById($rs_teacher->school_id);
?>
<div class="fullsize_pad padtb10 lineht1_8 border_bottom">
    <p class="pull_left marginright20 f20"><strong><?=trim($teacher_name)?>, <?=$rs_teacher->qualification?></strong></p>
    <p class="pull_right"><?=$rs_school->school_name?></p>
</div>
<div class="teacher_details">
    <div class="teacher_address">
        <h2>DOB: <?=date("M d, Y", strtotime($rs_teacher->date_of_birth))?></h2>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="margintop25">
          <tr>
            <td>
                <h4>Contact Info:</h4>
                <?=$rs_teacher->address?><br />
                <?=$rs_teacher->phone?> <br />
                <?=$rs_teacher->mobile?>
            </td>
            <td>
                <h4>Emegency Contact</h4>
                <?=$rs_teacher->emergency_name?> <br/>
                <?=$rs_teacher->emergency_relation?> <br/>
                <?=$rs_teacher->emergency_number?> <br/>
            </td>
          </tr>
          <tr>
            <td class="padtop20">
                <h4>Preferred Subjects</h4>
                <?=$subjects?>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td class="padtop20">
            <? 
			$rs_tsubjects = Teacher::getTeachersSubjectsById($rs_teacher->id);
			?>
                <h4>Subjects</h4>
                <?
				if(!empty($rs_tsubjects)) {
					foreach($rs_tsubjects as $k=>$v) {
						echo $v."<br>";
					}
				} else {
					echo "No subjects are alloted";
				}
				?>
               
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
    </div>
    <div class="teacher_photo">
        <img src="<?=TEACHERS_FILE_HREF.$rs_teacher->photo?>" alt="<?=$teacher_name?>" title="<?=$teacher_name?>" height="200px" width="100%" />
    </div>
</div>

<div class="fullsize txtwhite txtcenter f18">
    <div class="bgbrown pull_right marginleft20 marginright10 margintb10 cursor padlr20 padtb10" onClick="showTeacherDtls('C', '', '<?=$rs_teacher->teacher_status?>')"><strong>CANCEL</strong></div>
    <? if($GLOBALS['isUpdate']){ ?><div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onClick="showTeacherDtls('E', '<?=$rs_teacher->id?>')"><strong>EDIT</strong></div><? } ?>
</div> 