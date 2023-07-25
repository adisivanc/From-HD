
<div class="combutton pull_right" onclick="printList('sessionlist')">
	<a href="generateCSV.php?filename=Student&<?=$exportValues?>" style="color:#FFF;">Export</a>
</div>
                    
<input type="hidden" name="student_list_page" id="student_list_page" value="<?=$page?>" />

<table width="100%" border="0" cellspacing="1" cellpadding="0" class="gradetbl" bgcolor="#dab791" style="clear:both;">
    <tr bgcolor="#FFFFFF">
    	<? if($actionPage=="Grade") { ?><th width="3%" align="center" scope="col">
        <input type="checkbox" class="checkallstudent" id="checkallstudent[]" name="checkallstudent[]" />
        </th><? } ?>
        <th width="7%" align="center" scope="col">S.No
            <span style="margin:0 0 0 5px; position:relative; top:4px;">
            <img src="images/up_icon.png" alt="Ascending Order" title="Ascending Order" onclick="showStudentDtls('<?=$schoolId?>', 'id', 'ASC')" style="float: right;position: absolute;cursor: pointer;"   >
            <img src="images/down_icon.png" alt="Descending Order" title="Descending Order" onclick="showStudentDtls('<?=$schoolId?>', 'id', 'DESC')" style="vertical-align: bottom;margin-top:11px;position: absolute;cursor: pointer; float: right;" />    
            </span>
        </th>
        <th width="18%" align="left" scope="col">Name
            <span style="margin:0 0 0 5px; position:relative; top:4px;">
            <img src="images/up_icon.png" alt="Ascending Order" title="Ascending Order" onclick="showStudentDtls('<?=$schoolId?>', 'first_name', 'ASC')" style="float: right;position: absolute;cursor: pointer;"   >
            <img src="images/down_icon.png" alt="Descending Order" title="Descending Order" onclick="showStudentDtls('<?=$schoolId?>', 'first_name', 'DESC')" style="vertical-align: bottom;margin-top:11px;position: absolute;cursor: pointer; float: right;" />
            </span>
        </th>
        <? if($actionPage!="Grade") { ?>
        <th width="8%" align="left" scope="col">
        <?
            $grade_obj = new Grade();
            $grade_obj->school_id = $schoolId; 
            $grade_obj->fields = "id, grade_name";
            $rs_grades = $grade_obj->getGradeDtls();
        ?>
            <select name="search_grade" id="search_grade" class="listbox" onChange="showStudentDtls('<?=$schoolId?>', '<?=$orderBy?>', '<?=$sortBy?>');" style="width:90%;">
                <option value="">All Grade</option>
                <? if(count($rs_grades)>0) {
                    foreach($rs_grades as $gk=>$gv) { ?>
                    <option value="<?=$gv->id?>" <?=($gradeId==$gv->id)?"selected":""?>><?=$gv->grade_name?></option>
                <? } } ?>
                
            </select>
        </th>
        <? } ?>
        <th width="23%" align="left" scope="col">Father Details</th>
        <th width="22%" align="left" scope="col">Mother Details</th>
        <th width="19%" scope="col">Action</th>
    </tr>
<?
if(count($rs_studentArr)>0){
    foreach($rs_studentArr as $K=>$V){ 
    $rs_grade = Grade::getGradeById($V->grade_id); 
	if($V->is_new_student=="Y") $txtcolor = "color:#000000";  else $txtcolor="";
	$is_log = UserLog::checkLogExistsById(TBL_STUDENT, $V->id);
    ?>
        <tr bgcolor="#FFFFFF" style="<?=$txtcolor?>">
        	<? if($actionPage=="Grade") { ?><td align="center"><input type="checkbox" name="upgrade_student_list" id="upgrade_multi_checkbox" class="upgrade_student_list" value="<?=$V->id?>" /></td><? } ?>
            <td align="center" valign="top"><?=$K+1?></td>
            <td align="left" valign="top"><div style="word-break:break-all;"><?=$V->first_name?> <?=$V->middle_name?> <?=$V->last_name?> <br /><?=($V->roll_no!="")?"# ".$V->roll_no:""?></div></td>
			<? if($actionPage!="Grade") { ?><td align="left" valign="top"><?=$rs_grade->grade_name?></td><? } ?>
            <td align="left" valign="top">
                <div style="word-break:break-all;"><?=$V->father_name?><br /><?=($V->father_email=="")?"--":$V->father_email?><br /><?=$V->father_phone?></div>
            </td>
            <td align="left" valign="top">
                <div style="word-break:break-all;"><?=$V->mother_name?><br /><?=($V->mother_email=="")?"--":$V->mother_email?><br /><?=$V->mother_phone?></div>
            </td>
            <td align="center" valign="top">
            <div class="btn_group">
            <img src="images/mail_icon.png" alt="" title="Mail" class="cursor" align="absmiddle" onclick="studentActions(<?=$V->id?>, 'M', '<?=$V->grade_id?>')" />
            <? if($GLOBALS['isView']){ ?><img src="images/view_icon.png" alt="Quick View Student" title="Quick View Student" class="actionicons" onclick="studentActions(<?=$V->id?>, 'QV')" /><? } ?>
            <? if($actionPage!="Grade" && $GLOBALS['isView']) { ?><img src="images/detail_view.png" alt="Detailed View Student" title="Detailed View Student" class="actionicons" onclick="studentActions(<?=$V->id?>, 'DV')" /><? } ?>
            <? if($GLOBALS['isUpdate']){ ?><img src="images/edit_icon1.png" alt="Quick Edit Student" title="Quick Edit Student" class="actionicons" onClick="showStudentFrm('<?=$V->id?>', 'QF');" /><? } ?><br />
            <? if($actionPage!="Grade" && $GLOBALS['isUpdate']){?><img src="images/edit_icon.png" alt="Detailed Edit Student" title="Detailed Edit Student" class="actionicons" onClick="showStudentFrm('<?=$V->id?>', 'DF');" /><? }?>
            <? if($actionPage!="Grade" && $GLOBALS['isDelete']) { ?><img src="images/delete_icon.png" alt="Delete Student" title="Delete Subject" onclick="if(confirm('Are you sure want to delete the selected Student?')) studentActions(<?=$V->id?>, 'D')" class="actionicons" /><? } ?>
            <? if($GLOBALS['isUpdate']){ ?><img src="images/mailsub_icon.png" alt="Email Subscriptions" title="Email Subscriptions" align="absmiddle" class="actionicons" onclick="showEmailSubscription('<?=$V->id?>')" /><? } ?>
            <? if($_SESSION['viewLog'] && $is_log==1) { ?><img src="images/log.png" alt="Log Details" title="Log Details" align="absmiddle" class="actionicons" onclick="showLogDetails('<?=TBL_STUDENT?>', '<?=$V->id?>')" /><? } ?>
            </div>
            </td>
        </tr>
    <?
    }
    if($rsPagination!=''){
    ?>
        <tr bgcolor="#FFFFFF"><td colspan="8" style="padding:10px;"><?=$rsPagination?></td></tr>
    <?
    }
	?>
    	<tr bgcolor="#FFFFFF">
            <td colspan="8" style="padding:10px;">
            	<div class="combutton pull_left" onclick="showGradeforUpgrade('<?=$gradeId?>');">UPGRADE</div>
                <div class="combutton pull_left marginleft10" onclick="showNewStudentOption('<?=$gradeId?>', 'N');">MAKE AS NEW STUDENT</div>
                <div class="combutton pull_left marginleft10" onclick="showNewStudentOption('<?=$gradeId?>', 'O');">MAKE AS OLD STUDENT</div>
            </td>
        </tr>
    <?
} else {
?>
    <tr bgcolor="#FFFFFF"><td colspan="8" style="padding:10px;">No results found..!</td></tr>
<?
}
?>
</table>
<script type="text/javascript">
$('.checkallstudent').click(function(){
	if($('.checkallstudent').is(':checked')){ $('.upgrade_student_list').prop('checked',true); }
	else{ $('.upgrade_student_list').prop('checked',false); }
});
</script>