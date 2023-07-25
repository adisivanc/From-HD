<?
$grade_obj = new Student();
$grade_obj->grade_id=$gradeId;
$rs_grade_student = $grade_obj->getAllGradeStudents(); 

if ($_POST['page'] == '')
	$page = 1;
else
	$page = $_POST['page'];
$totalReg = count($rs_grade_student);
$PageLimit = ($_POST["page_limit"] == "" || $_POST["page_limit"] == "undefined") ? 10 : $_POST["page_limit"];

$totalPages = ceil(($totalReg) / ($PageLimit));
if ($totalPages == 0) $totalPages = 1;
$StartIndex = ($page - 1) * $PageLimit;
if (count($rs_grade_student) > 0) $rs_grade_studentArr = array_slice($rs_grade_student, $StartIndex, $PageLimit, true);
	
$arrayCount = count($rs_grade_student);
$arraySliceCount = count($rs_grade_studentArr);
		
if($arrayCount>0 && $totalPages > 1) { 
	$table_val = generatePagination($functionName="studentList", $arrayCount, $arraySliceCount, $pageLimit=$PageLimit, $adjacent=1, $page=$page, $type=$_POST['type']);
}
		
?>
<input type="hidden" name="student_grade_id" id="student_grade_id" value="<?=$gradeId?>" />
<input type="hidden" name="student_grade_page" id="student_grade_page" value="<?=$page?>" />

<div class="pull_right pad5">
    Show Records:
    <select name="student_page_limit" id="student_page_limit" class="listbox" onchange="showGradeStudents('S', '<?=$gradeId?>')">
        <?
        foreach($GLOBALS['PageLimits'] as $pk=>$pv) { ?>
        <option value="<?=$pv?>" <?=($_POST["page_limit"]==$pv)?"selected":""?>><?=$pv?></option>
        <?
        }
        ?>
    </select>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:7px auto;" class="gradetbl" id="grade_studentab"><!--Student Tab-->
  <tr>
    <th width="12%">S No.</th>
    <th width="26%" align="left">Name</th>
    <th width="14%">Gender</th>
    <th width="29%" align="left">Contact</th>
    <!--<th width="15%">Attendance</th>-->
    <th width="19%">Action</th>
  </tr>
  <?
  if(count($rs_grade_studentArr)>0) {
      foreach($rs_grade_studentArr as $K=>$V) {
          $rs_student = Student::getStudentById($V->student_id);
          $student_name = $rs_student->first_name." ".$rs_student->middle_name." ".$rs_student->last_name;
  ?>
  <tr>
    <td><?=($K+1)?></td>
    <td align="left"><?=trim($student_name)?></td>
    <td><?=$GLOBALS['Gender'][$rs_student->gender]?></td>
    <td align="left">F: <?=($rs_student->father_phone!="")?$rs_student->father_phone:"--"?> <br />M: <?=($rs_student->mother_phone!="")?$rs_student->mother_phone:""?></td>
    <!--<td>30/32</td>-->
    <td><img src="images/mail_icon.png" alt="" title="Mail" class="cursor" align="absmiddle" onclick="studentActions(<?=$rs_student->id?>, 'M')" />
    	<? if($GLOBALS['isView']){ ?>
        	<img src="images/view_icon.png" alt="View Student Details" title="View Student Details" class="cursor" align="absmiddle" onclick="studentActions(<?=$rs_student->id?>, 'QV')" />
		<? } ?>
        <img src="images/edit_icon1.png" alt="Student Quick Edit" title="Student Quick Edit" class="cursor" align="absmiddle" onclick="studentActions(<?=$rs_student->id?>, 'QE')" />
    </td>
  </tr>
  <?
      }
	if($table_val!=''){
	?>
	<tr><td colspan="6" style="padding:10px;"><?=$table_val?></td></tr>
	<?
	}
  } else {
  ?>
  <tr><td colspan="6" style="padding:10px;">No students found..!</td></tr>
  <? } ?>
</table>