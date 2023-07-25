<input type="hidden" name="student_grade_id" id="student_grade_id" value="<?=$gradeId?>" />
<div class="pull_right pad5">
    Show Records:
    <select name="student_page_limit" id="student_page_limit" class="listbox" onchange="showGradeStudents('S', '<?=$gradeId?>')">
        <?
        foreach($GLOBALS['PageLimits'] as $pk=>$pv) { ?>
        <option value="<?=$pv?>" <?=($_POST["page_limit"]==$pv || $pv==20)?"selected":""?>><?=$pv?></option>
        <?
        }
        ?>
    </select>
</div>
<? 
$actionPage="Grade";
$page_limit = $_POST["page_limit"];
include "student_list.php"; 
?>