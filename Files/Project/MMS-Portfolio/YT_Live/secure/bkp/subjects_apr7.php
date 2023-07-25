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
		$PageLimit= 10;
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
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtbl">
                <tr>
                    <th scope="col" align="center">Id</th>
                    <? if($_SESSION['SchoolId']=='A'){?><th scope="col">School Name</th><? } ?>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            <?
            if(count($rsSubjectArr)>0){
				foreach($rsSubjectArr as $K=>$V){
				$rsSchoolName = School::getSchoolById($V->school_id);
				?>
					<tr>
						<td align="center"><?=$K+1?></td>
						<? if($_SESSION['SchoolId']=='A'){?><td align="center"><?=$rsSchoolName->school_name?></td><? } ?>
						<td align="center"><?=$V->subject_name?></td>
						<td align="center"><?=stripslashes($V->description)?></td>
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
					<tr><td colspan="5"><?=$rsPagination?></td></tr>
				<?
				}
            } else {
            ?>
            	<tr><td colspan="5">No subjects are avaliable..!</td></tr>
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
	$rsSubjectVal = Subject::getSubjectById($_POST['subject_id']);
	$rsSchool = School::getSchoolById($_POST['school_id']);

?>
    <form name="subjectFrm" id="subjectFrm" method="post">
    <input type="hidden" name="subject_id" id="subject_id" value="<?=$_POST['subject_id']?>" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;<?=($_POST['subject_id']!='')?"Edit Subject":"Add Subject"?> for <?=$rsSchool->school_name?></strong>
            <span onclick="closeSubjectPopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="95">Subject Name</td>
                        <td><input type="text" class="txtbox" name="subject_name" id="subject_name" onblur="chkSubjectNameExist()" value="<?=ucfirst($rsSubjectVal->subject_name)?>"></td>
                    </tr>
                    <tr id="subjectNameErr" style="display:none;">
                        <td colspan="2" valign="top">
                        <div style="color:#F00; float:left; padding-left:110px; margin:0px;">Subject Name Already Exists in this Grade!</div>
                        </td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea class="msgbox" name="description" id="description"><?=$rsSubjectVal->description?></textarea></td>
                    </tr>
                    <tr>
                        <td align="right" colspan="2">
                        <? if($_POST['subject_id']!='') $actionName="Edit"; else $actionName="Add"; ?>
                        <div class="combutton pull_right" onClick="submitSubject('<?=$rsSubjectVal->id?>')"><?=$actionName?></div>
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
	if($_POST['subject_id']!=''){
		$rsSubjectUpd = Subject::updateSubject($_POST['school_id'],strtoupper($_POST['subject_name']),addslashes($_POST['description']),$_POST['subject_id']);
	}else{
		$rsSubjectIns = Subject::insertSubject($_POST['school_id'],strtoupper($_POST['subject_name']),addslashes($_POST['description']));
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
	$subjectNameObj->school_id=$_SESSION['SchoolId'];
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
                    <div class="newcircular_head" id="show_currentteacher">Subjects<span></span></div>
                    <? $rs_schools = School::getAccessedSchools($GLOBALS['schoolAccess']); ?>
                    <ul class="currentteacher_content txttheme" id="teachermenutab_A" style="padding-right:10px;">
                    <? foreach($rs_schools as $sk=>$sv) { ?>
                    	<? if($GLOBALS['schoolAccess'][$sv->id]) { ?><li onclick="showSubjectDtls('<?=$sv->id?>')" style="cursor:pointer;"><?=$sv->school_name?></li><? } ?>
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
	ajax({
		a:'subjects',
		b:'act=loadSubjectList&page='+page,
		c:function(){},
		d:function(data){
			$('#showSubjectList').html(data);
		}
	});
}

function showSubjectsPopup(subject_id){ 
	
	var school_id = $.trim($('#school_db_id').val());
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
	if(err==0){
		ajax({
			a:'subjects',
			b:'act=saveSubjectsFrm&subject_name='+$('#subject_name').val()+'&description='+$('#description').val()+'&subject_id='+subject_id+'&school_id='+school_id,		
			c:function(){},
			d:function(data) { //alert(data);
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
	var param = 'act=loadSubjectNameExist&subject_name='+subject_name;
	
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
</script>

<?
}
include "template.php";
?>