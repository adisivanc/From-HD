<?
function main(){

if($_POST['act']=="loadSubjectList"){
	ob_clean();
	$subjectObj = new Subject();
	if($_POST['school_id']!='' && $_POST['school_id']!='undefined') $subjectObj->school_id = $_POST['school_id'];  
	$subjectObj->orderby = 'id';
	$subjectObj->sortby = 'Desc';
	$rsSubject = $subjectObj->getAllSubjectDtls();
	//Pagination 
		
		if($_POST['page']=='')
		$page=1;
		else
		$page = $_POST['page'];
		$totalReg = count($rsSubject);
		$PageLimit= 20;
		$adjacents = 1;
				
		$totalPages= ceil(($totalReg)/($PageLimit));
		if($totalPages==0) $totalPages=1;
		$StartIndex= ($page-1)*$PageLimit; 
			
		if(count($rsSubject)>0) $rsSubjectArr = array_slice($rsSubject,$StartIndex,$PageLimit,true);
		if(count($rsSubject)>0 && $totalPages > 1){ 
			$rsPagination = generatePagination("subject", $totalReg, count($rsSubjectArr), $PageLimit, $adjacents, $page); 
		}
?>
<input type="hidden" name="school_db_id" id="school_db_id" value="<?=$_POST['school_id']?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl" id="grade_studentab">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" class="listtbl" bgcolor="<?=$GLOBALS['TableColor']['Table']?>">
                <tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>">
                    <th width="8%" align="center" scope="col">Id</th>
                    <th width="24%" align="left" scope="col">Name</th>
                    <th width="23%" align="left" scope="col">Grade</th>
                    <th width="34%" align="left" scope="col">Description</th>
                    <th width="11%" align="center" scope="col">Action</th>
                </tr>
            <?
            if(count($rsSubjectArr)>0){
				foreach($rsSubjectArr as $K=>$V){
				$rsSchoolName = School::getSchoolById($V->school_id);
				$gradeArr = explode(",", $V->grade_id);
				$gradeNameArr=array();
				if(!empty($gradeArr)){
					foreach($gradeArr as $kk=>$vv) {
						$rs_grade = Grade::getGradeById($vv);
						$gradeNameArr[] = $rs_grade->grade_name;
					}
				}
				$grade_names = implode(", ", $gradeNameArr);
				if($K%2==0) $bgColor = $GLOBALS['TableColor']['TR'];
				?>
					<tr bgcolor="<?=$bgColor?>">
						<td align="center"><?=$K+1?></td>
						<td align="left"><?=$V->subject_name?></td>
						<td align="left"><?=$grade_names?></td>
						<td align="left"><?=stripslashes($V->description)?></td>
						<td align="center">
						<div class="btn_group">
						<img src="images/edit_icon.png" alt="Edit Subject" title="Edit Subject" onclick="showSubjectsPopup(<?=$V->id;?>)" class="actionicons" /> 
						<img src="images/delete_icon.png" alt="Delete Subject" title="Delete Subject" onclick="if(confirm('Are you sure want to delete the selected Subject?')) deleteSubject(<?=$V->id;?>, '<?=$_POST['school_id']?>')" class="actionicons" />
						</div>
						</td>
					</tr>
				<?
				}
				if($rsPagination!=''){
				?>
					<tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>"><td colspan="5"><?=$rsPagination?></td></tr>
				<?
				}
            } else {
            ?>
            	<tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>"><td colspan="5">No subjects are avaliable..!</td></tr>
            <?
            }
            ?>
            </table>
        </td>
    </tr>
</table>
<? echo "::::".count($rsSubject); ?>
<? 	exit();
}

if($_POST['act']=='loadSubjectsFrm'){
	ob_clean();
	$rs_subjects = Subject::getSubjectById($_POST['subject_id']);
	$rsSchool = School::getSchoolById($_POST['school_id']);
	$gradeIdsArr = explode(",", $rs_subjects->grade_id);

?>
<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>
    <form name="subjectFrm" id="subjectFrm" method="post">
    <input type="hidden" name="subject_id" id="subject_id" value="<?=$_POST['subject_id']?>" />
    <table width="450" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;<?=($_POST['subject_id']!='')?"Edit Subject":"Add Subject"?> for <?=$rsSchool->school_name?></strong>
            <span onclick="closeSubjectPopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2" width="100%">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="33%">Subject Name</td>
                        <td width="67%"><input type="text" class="txtbox" name="subject_name" id="subject_name" onblur="chkSubjectNameExist()" value="<?=ucfirst($rs_subjects->subject_name)?>">
                        	<div style="color:#F00; display:none;" id="subjectNameErr">Subject Name Already Exists!</div>
                        </td>
                    </tr>
                    <tr>
                        <td id="gradeerr">Grades</td>
                        <td><?
							$index=1;
							$grade_obj = new Grade();
							$grade_obj->school_id = $_POST['school_id']; 
							$rs_grades = $grade_obj->getGradeDtls();
							
							if(count($rs_grades)>0) { ?>
                            <input type="checkbox" name="school_grades" id="school_grades" value="All" onclick="checkAllBox('All')" class="subclass1" /> All<br />
                            <?
								foreach($rs_grades as $k=>$v) {
							?>
                        	<input type="checkbox" name="school_grades" id="school_grades" class="school_grades" value="<?=$v->id?>" <?=(in_array($v->id, $gradeIdsArr))?"checked":""?> onclick="checkAllBox('<?=$v->id?>')" /> <?=$v->grade_name?>
                            <? 	if($index%3==0) echo "<br />"; $index++;
								} 
							} else { ?>
                            Grades are not available.. Please add Grade and then insert subject..!
                            <? } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea class="msgbox" name="description" id="description"><?=$rs_subjects->description?></textarea></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">
                        <? if($_POST['subject_id']!='') $actionName="Update"; else $actionName="Add"; ?>
                        <div class="combutton pull_right" id="saveImg" onClick="submitSubject('<?=$rs_subjects->id?>')"><?=$actionName?></div>
                        <img src="images/loader.gif" alt="Loading.." title="Loading.." id="lodingImg" style="display:none;" />
                    	</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>
<?	
	exit();
}

if($_POST['act']=='saveSubjectsFrm'){
	ob_clean(); 
	$_POST = array_map("trim", $_POST);
	extract($_POST);
	
	if($subject_grades=="All") {
		$grade_obj = new Grade();
		$grade_obj->school_id = $school_id; 
		$rs_grades = $grade_obj->getGradeDtls();
		$gradeIdArr=array();
		if(count($rs_grades)>0) {
			foreach($rs_grades as $kk=>$vv) {
				$gradeIdArr[] = $vv->id;
			}
		}
		$gradeIds = implode(",", $gradeIdArr);
	} else {
		$gradeIds = $subject_grades;
	}
	
	if($_POST['subject_id']!=''){
		$rsSubjectUpd = Subject::updateSubject($school_id, $gradeIds, ucwords($subject_name), addslashes($description), $subject_id);
	} else {
		$rsSubjectIns = Subject::insertSubject($school_id, $gradeIds, ucwords($subject_name), addslashes($description));
	}
	exit();
}

if($_POST['act']=='delSubjects'){
	ob_clean();
	$rsDeleteSubject = Subject::deleteSubject($_POST['subject_id']);
	exit();
}

if($_POST['act']=='loadSubjectNameExist') {
	ob_clean(); 
	$subjectNameObj = new Subject();
	$subjectNameObj->subject_name=$_POST['subject_name'];
	$subjectNameObj->subject_id=$_POST['subject_id'];
	$subjectNameObj->school_id=$_POST['school_id'];
	$rsSubjectName = $subjectNameObj->getAllSubjectDtls();	
	if(count($rsSubjectName)>0){
		echo 'already exist';
	} else{
		echo 'not exist';
	}
	exit();	
}


?>
<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

<link rel="stylesheet" type="text/css" href="css/default_style.css" />

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright5" /></td>
                <td>List <br/> <span class="f30"><strong>Subjects</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
            
        </div>
    </div>
    
</div>



<div class="fullsize">
    
    <div class="fullsize padtb15">

        <div class="newsletter_left"> <!-- Menu -->
            <div class="newsletter_submenu txtwhite">
                <div class="circular_outer">
                    <div class="newcircular_head" id="show_currentteacher">Subjects</div>
                    <? $rs_schools = School::getAccessedSchools($GLOBALS['schoolAccess']); ?>
                    <ul class="currentteacher_content txttheme" id="teachermenutab_A" style="padding-right:10px;">
                    <? foreach($rs_schools as $sk=>$sv) { ?>
                    	<? if($GLOBALS['schoolAccess'][$sv->id]) { ?>
                        	<li onclick="showSubjectDtls('<?=$sv->id?>')" style="cursor:pointer;"><?=$sv->school_name?> <span class="tabbtn" id="tabbtn_<?=$sv->id?>"></span></li>
						<? } ?>
                    <? } ?>
                    </ul>
                </div>
                
            </div>
        </div><!-- Menu -->
        
        <div class="newsletter_right border_theme bgwhite" id="hide_allgradelist" style="width:79%;"> <!-- Grade -->
        
        	<div class="fullsize lineht2 border_bottom">
                <div class="pull_left padlr10 padtb10 txtbold letterspac f18">Master Subjects List</div>
                <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Subjects: <span id="subjectscount"></span></div>
                <div class="combutton pull_right" onclick="showSubjectsPopup('')" style="clear:both;">Add Subject</div>
            </div>
            
            <div class="fullsize">
                <div id="showSubjectList"></div>
            </div>

        </div>

    </div>
    
</div>

<div id="subject_popup" style="display:none; padding:0;"></div>



<script type="text/javascript">

showSubjectDtls('<?=$rs_schools[0]->id?>');

function showSubjectDtls(school_id) { //alert(school_id);

	$("#showSubjectList").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	$('.tabbtn').removeClass('arrow');
	$('#tabbtn_'+school_id).addClass('arrow');
  	ajax({
		a:'subjects',
		b:'act=loadSubjectList&school_id='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			var dataArr = data.split('::::');
			$("#showSubjectList").html(dataArr[0]);
			$("#subjectscount").html(dataArr[1]);
 		}			
	});
}

function subjectPaging(page) {
	
	var school_id = $.trim($('#school_db_id').val());
	$("#showSubjectList").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	ajax({
		a:'subjects',
		b:'act=loadSubjectList&page='+page+'&school_id='+school_id,
		c:function(){},
		d:function(data){
			var dataArr = data.split('::::');
			$("#showSubjectList").html(dataArr[0]);
			$("#subjectscount").html(dataArr[1]);
		}
	});
}

function showSubjectsPopup(subject_id){ 
	
	var school_id = $.trim($('#school_db_id').val());
	$("#subject_popup").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
  	ajax({
		a:'subjects',
		b:'act=loadSubjectsFrm&subject_id='+subject_id+'&school_id='+school_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#subject_popup").html(data);
			popupDtls();
		}			
	});
}

function popupDtls(){
	
  	$("#subject_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

function closeSubjectPopup(){ $("#subject_popup").dialog('close');  }

function submitSubject(subject_id) { 
	var err = 0; 
	var school_id = $.trim($('#school_db_id').val());
	if($('#subject_name').val()==''){ err =1; $('#subject_name').addClass('boxerror');}else{ $('#subject_name').removeClass('boxerror');}
	if($('#description').val()==''){ err =1; $('#description').addClass('boxerror');}else{ $('#description').removeClass('boxerror');}
	
	var subject_grades = $('input[name=school_grades]:checked').map(function() {
		return this.value;
	}).get();
	
	if(subject_grades=='' || subject_grades==undefined){ err =1; $('#gradeerr').addClass('txterror');}else{ $('#gradeerr').removeClass('txterror');}
	
	if(err==0){
		$('#saveImg').hide();
		$('#loadingImg').show();
		ajax({
			a:'subjects',
			b:'act=saveSubjectsFrm&subject_name='+$('#subject_name').val()+'&description='+$('#description').val()+'&subject_id='+subject_id+'&school_id='+school_id+'&subject_grades='+subject_grades,		
			c:function(){},
			d:function(data) { //alert(data);
				$('#saveImg').show();
				$('#loadingImg').hide();
				if(subject_id!=''){
					alert('Subject Updated Successfully');
				}else{
					alert('Subject Added Successfully');
				}
				$("#subject_popup").dialog('close');
				showSubjectDtls(school_id);
			}			
		});
	}
}

function deleteSubject(subject_id, school_id){
	ajax({
		a:'subjects',
		b:'act=delSubjects&subject_id='+subject_id,		
		c:function(){},
		d:function(data){ //alert(data);
			alert('Deleted Successfully');
			showSubjectDtls(school_id);
		}			
	});
}

function chkSubjectNameExist() { 
	var subject_name = $('#subject_name').val();
	var school_id = $.trim($('#school_db_id').val());
	var param = 'act=loadSubjectNameExist&subject_name='+subject_name+'&school_id='+school_id;
	
	if($('#subject_id').val()>0)
		param += '&subject_id='+$('#subject_id').val();
	
	if(subject_name!=''){
		ajax({
			a:'subjects',
			b:param,
			c:function(){},
			d:function(data){
				//alert(data);
				if($.trim(data)=='already exist'){
					$('#subjectNameErr').show();
					$('#subject_name').val('');
					$('#subject_name').focus();
				}
				else{
					$('#subjectNameErr').hide();
				}
			}
		});
	}
}

function checkAllBox(type){  
	if(type=='All'){
		if($('.subclass1').is(":checked")) { 
			$("input[name=school_grades]").not($('.subclass1')).attr('disabled', 'disabled');
			$("input[name=school_grades]").not($('.subclass1')).attr('checked', false);
		}else{
			$("input[name=school_grades]").removeAttr('disabled');
		}
	}
}
</script>

<?
}
include "template.php";
?>