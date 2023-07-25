<?
function main(){
	
if($_POST['act']=="loadMasSubjects") {
	ob_clean();
	$sub_obj = new Subject();
	$sub_obj->school_id = $_POST['schoolId'];
	$sub_obj->orderby = 'id';
	$sub_obj->sortby = 'ASC';
	$sub_obj->fields = 'id, subject_name';
	$rs_subjects = $sub_obj->getAllSubjectDtls();
	
	$subjectArr=explode(",", $_POST['oldSubIds']);
	?>
    <div class="threecolumdiv">
    <? 	
        $index=1;
        if(count($rs_subjects)>0) {
            foreach($rs_subjects as $kk=>$vv) {
            ?>
            <div style="float:left; width:33%;">
                <input type="checkbox" class="teacher_handling" id="teacher_handling" name="teacher_handling[]" value="<?=$vv->id?>" <?=(in_array($vv->id, $subjectArr))?"checked":""?> /> <?=$vv->subject_name?>
            </div>
            <?	
            if($index%3==0) echo "</div> <div class='threecolumdiv'>"; $index++;
            }
        } else {
            echo "Subjects not yet added, first add subjects and then add teachers.";
        }
    ?>
    </div>
	<?
	exit();
}

if($_POST['act']=='checkUserNameExist') {
	ob_clean(); 
	/*$userNameObj = new Teacher();
	$userNameObj->user_name=$_POST['user_name'];
	$userNameObj->check_id=$_POST['teacher_id'];
	$rs_user_teacher = $userNameObj->getTeachersDtls();	*/
	$user_obj = new User();
	$user_obj->user_name=$_POST['user_name'];
	$user_obj->id_not=$_POST['user_id'];
	$rsUserName = $user_obj->getAllUserDtls();	
	if(count($rsUserName)>0){
		echo 'already exist';
	} else{
		echo 'not exist';
	}
	exit();	
}

if($_POST['act']=="loadTeacherList"){
	ob_clean();
	$menuType=$_POST['type']; $teacherId=$_POST['id']; $status = $_POST['status'];
	$searchById=$_POST['mas_search_id']; $searchByName=$_POST['mas_search_tname']; $searchBy=$_POST['search_by']; $listType = $_POST['list_type'];
	
	$rs_teacher = Teacher::getTeachersById($teacherId);
	
	if($menuType=="N" || $menuType=="E") include "teacher_add.php";
	if($menuType=="TL" || $menuType=="C") include "teacher_list.php";
	if($menuType=="TD") include "teacher_details.php";
	exit();
}

if($_POST['act']=="loadTeacherListDtls") {
	ob_clean();
	$status = $_POST['status'];
	$searchById=$_POST['mas_search_id']; $searchByName=$_POST['mas_search_tname']; $searchByNameId=$_POST['mas_search_tname_id']; $searchByEmail = $_POST['mas_search_email']; $searchBy=$_POST['search_by'];
	
	$teacher_obj = new Teacher();
	
	if($searchBy=="ID" && $searchById!="" && $searchById!="undefined") $teacher_obj->search_id=$searchById;
	if($searchBy=="E" && $searchByEmail!="" && $searchByEmail!="undefined") $teacher_obj->email_address=$searchByEmail;
	if($searchBy=="N" && $searchByName!="" && $searchByName!="undefined") { 
		if($searchByNameId!="" && $searchByNameId!="undefined") $teacher_obj->search_id=$searchByNameId;
		else $teacher_obj->name_search=$searchByName;
	}
	
	$teacher_obj->sortby="DESC";
	$teacher_obj->orderby="id";
	$teacher_obj->teacher_status=$status;
	$rs_teacher = $teacher_obj->getTeachersDtls();
	
	if($_POST['listType']=="D") {
	if(count($rs_teacher)>0) {
		foreach($rs_teacher as $k=>$v) {
			$subjects="--";
			if($v->subject_id!="" && $v->subject_id!="0") {
			$rs_subject = Subject::getSubjectsByIds($v->subject_id);
			$subjects = implode(", ", $rs_subject);
			}
			$teacher_name = $v->prefix.".".$v->first_name." ".$v->middle_name." ".$v->last_name;
			$teacher_name = trim($teacher_name);
			
		?>
        <div class="teacherlist_inner cursor" id="teacher_deatils1">
            <div style="width:100%; height:160px; border:1px solid #999999;" onclick="showTeacherDtls('TD', '<?=$v->id?>', '<?=$v->teacher_status?>');">
            	<img src="resize.php?w=250&h=160&img=<?="../".TEACHERS_FILE_REL.$v->photo?>" alt="<?=$teacher_name?>" title="<?=$teacher_name?>" />
            </div>	
            <h4><?=$teacher_name?></h4>
            <h5><?=$subjects?></h5>
        </div>
        <?
		}
	} else {
		echo "No results found..!";
	}
	}
	
	if($_POST['listType']=="L") {
	?>
    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="gradetbl" id="grade_studentab" style="margin:0px;">
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="1" cellpadding="0" class="listtbl" bgcolor="<?=$GLOBALS['TableColor']['Table']?>">
                    <tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>">
                        <th width="7%" align="center" scope="col">Id</th>
                        <th width="19%" align="left" scope="col">Name</th>
                        <th width="22%" align="left" scope="col">Contact</th>
                        <th width="18%" align="left" scope="col">School</th>
                        <th width="16%" align="center" scope="col">Subjects</th>
                        <th width="18%" align="center" scope="col">Action</th>
                    </tr>
                <?
                if(count($rs_teacher)>0){
                    foreach($rs_teacher as $k=>$v){
						$rs_subject = Subject::getSubjectsByIds($v->subject_id);
						$subjects="--";
						if($v->subject_id!="" && $v->subject_id!="0") {
						$rs_subject = Subject::getSubjectsByIds($v->subject_id);
						$subjects = implode(", ", $rs_subject);
						}
						$teacher_name = $v->prefix.".".$v->first_name." ".$v->middle_name." ".$v->last_name;
						$teacher_name = trim($teacher_name);
                    	if($k%2==0) $bgColor = $GLOBALS['TableColor']['TR'];
						$is_log = UserLog::checkLogExistsById(TBL_TEACHER, $v->id);
                    ?>
                        <tr bgcolor="<?=$bgColor?>">
                            <td align="center"><?=$k+1?></td>
                            <td align="left"><?=$teacher_name?></td>
                            <td align="left"><?=$v->email_address?> <br /> <?=$v->phone?></td>
                            <td align="left"><?=$rs_school->school_name?></td>
                            <td><?=$subjects?></td>
                            <td align="center">
                            <div class="btn_group">
                            <? if($GLOBALS['isView']){ ?><img src="images/view_icon.png" alt="Edit Subject" title="Edit Subject" onclick="showTeacherDtls('TD', '<?=$v->id?>', '<?=$v->teacher_status?>', '<?=$_POST['listType']?>');" class="actionicons" /> <? } ?>
                            <? if($GLOBALS['isUpdate']){ ?><img src="images/edit_icon.png" alt="Edit Subject" title="Edit Subject" onClick="showTeacherDtls('E', '<?=$v->id?>', '<?=$v->teacher_status?>', '<?=$_POST['listType']?>')" class="actionicons" /> <? } ?>
                            <? if($_SESSION['viewLog'] && $is_log==1) { ?><img src="images/log.png" alt="Log Details" title="Log Details" onClick="showLogDetails('<?=TBL_TEACHER?>', '<?=$v->id?>')" class="actionicons" /> <? } ?>
                            </div>
                            </td>
                        </tr>
                    <?
                    }
                } else {
                ?>
                    <tr bgcolor="<?=$GLOBALS['TableColor']['TR']?>"><td colspan="5">No results found..!</td></tr>
                <?
                }
                ?>
                </table>
            </td>
        </tr>
    </table>
	<?	
	}
	
	exit();	
}

if($_POST['act']=="loadTeacherMenuList") {
	ob_clean();
	$teacher_obj = new Teacher();
	$teacher_obj->sortby="DESC";
	$teacher_obj->orderby="id";
	$teacher_obj->fields="id, prefix, first_name, middle_name, last_name, teacher_status";
	$teacher_obj->teacher_status=$_POST['type'];
	$rs_teacher1 = $teacher_obj->getTeachersDtls();
	
	if ($_POST['page'] == '')
		$page = 1;
	else
		$page = $_POST['page'];
	$totalReg = count($rs_teacher1);
	$PageLimit = ($_POST["page_limit"] == "") ? 5 : $_POST["page_limit"];

	$totalPages = ceil(($totalReg) / ($PageLimit));
	if ($totalPages == 0) $totalPages = 1;
	$StartIndex = ($page - 1) * $PageLimit;
	if (count($rs_teacher1) > 0) $rs_teacherArr1 = array_slice($rs_teacher1, $StartIndex, $PageLimit, true);
		
	$arrayCount = count($rs_teacher1);
	$arraySliceCount = count($rs_teacherArr1);
			
	if($arrayCount>0 && $totalPages > 1) { 
		$table_val = generateMenuPagination($functionName="teacherList", $arrayCount, $arraySliceCount, $pageLimit=$PageLimit, $adjacent=1, $page=$page, $type=$_POST['type']);
	}
	
	if(count($rs_teacherArr1)>0 && !empty($rs_teacherArr1)) {
		
		$keys = array_keys($rs_teacherArr1);
		$lastkey = array_pop($keys);
		$lastvalue = $rs_teacherArr1[$lastkey]->id;
		
		foreach($rs_teacherArr1 as $k=>$v) { 
			$teacher_name = $v->prefix.".".$v->first_name." ".$v->middle_name." ".$v->last_name; $teacher_name = trim($teacher_name);
			if($lastvalue!=$v->id) $border_style = "border-bottom:1px dashed #FFF;"; else $border_style = ""; 
		?>
			<li style="<?=$border_style?>"><a onclick="showTeacherDtls('TD', '<?=$v->id?>', '<?=$v->teacher_status?>');" style="cursor:pointer;"><?=$teacher_name?></a></li>
		<?
		}
		
		if($table_val!='') { ?>
			<li><?=$table_val?></li>
		<?
		}
	} else {
		?>
			<li><a>No results found..!</a></li>
		<?
	}
					
	exit();
}

if($_POST['act']=="saveTeacherFrm") {
	extract($_POST);
	$subject_id = "";
	
	if(is_array($teacher_handling)) $subject_id = implode(",", $teacher_handling);
	$date_of_birth = $birth_year."-".$birth_month."-".$birth_date;
	$date_of_joining = $joining_year."-".$joining_month."-".$joining_date;
	if($submit_action=="S") $teacher_status = "N"; else if($submit_action=="U") $teacher_status = $teacher_db_status; else $teacher_status = $submit_action; 
	
	if($_FILES['teacher_photo']['size'] > 0)
	{
		$up_fileArr = $_FILES['teacher_photo']; 
		$rExt = array('jpg','jpeg','png','gif');
		$FileObj = new FileUpload();
		$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>TEACHERS_FILE_PATH));
		if($FileResult['Type']==1)
		{
		$Err[]=$FileResult['Error'];
		$ErrFlag = false;
		if($FileResult['ErrorNo']==1 )
		{
			$Err[] = "Valid file formats are ".implode(',',$rExt);
			$ErrFlag = true;
		}
		}
		elseif($FileResult['Type']==2)
		{
			$Uploadup_file = true;
		}
	}
	
	if($teacher_db_id!="" && $teacher_db_id!="undefined") {
		Teacher::updateTeachers($teacher_db_id, $school_id, $subject_id, $teacher_prefix, $teacher_firstname, $teacher_middlename, $teacher_lastname, $teacher_gender, $date_of_birth, $marital_status, $teacher_email, $teacher_phone, $teacher_mobile, $teacher_address, $emer_name, $emer_number, $emer_relations, $is_verified, $teacher_qualification, $teacher_designation, $teacher_exp, $date_of_joining, $teacher_status, $teacher_user_name, $teacher_password, $user_db_id);
		$teacher_id = $teacher_db_id;
	} else {
		$teacher_id = Teacher::insertTeachers($school_id, $subject_id, $teacher_prefix, $teacher_firstname, $teacher_middlename, $teacher_lastname, $teacher_gender, $date_of_birth, $marital_status, $teacher_email, $teacher_phone, $teacher_mobile, $teacher_address, $emer_name, $emer_number, $emer_relations, $is_verified, $teacher_qualification, $teacher_designation, $teacher_exp, $date_of_joining, $teacher_status, $teacher_user_name, $teacher_password, $user_db_id);
	}
	
	if($teacher_id>0) {
		
		if($Uploadup_file){
			$FileObj->AssignFileName($teacher_id);
			$filepath = $FileObj->Upload();
			Teacher::updateTeachersByfield('photo', $filepath, $teacher_id);
		}
		
		$circular_id = $circular_id;
		if($circular_id!="" && $circular_id!="undefined" && $send_circular=="Y" && $teacher_id!="" && $teacher_id!="undefined") {
			$teacher = $teacher_id;
			$circularIds = $circular_id;
			$action_type = "Teacher";
			include_once "circular_mail_process.php";
		}
		
		?>
        <script type="text/javascript">window.location.href="teacher.php";</script>
        <?
	}
	
}

	
?>


<link rel="stylesheet" type="text/css" href="css/default_style.css" />
<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>

<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Teacher</strong></span></td>
              </tr>
            </table>
        </div>
        <? if($GLOBALS['isAdd']){ ?><div class="combutton pull_right f24 cursor" id="show_addteacher" onclick="showTeacherDtls('N', '', '');" style="margin-top:50px;">Add Teacher</div><? } ?>
    </div>
    
</div>

<div class="fullsize">
    
        <div class="fullsize newsletter_outer">
        	
            <div class="newsletter_left"> <!-- Newsletter Circular -->
            	<div class="newsletter_submenu txtwhite">
					
					<div class="circular_outer">
                    	<div class="newcircular_head tabbtn" id="tabbtn_A" onclick="showTeacherDtls('TL', '', 'A');">Current Teachers<span></span></div>
                        <ul class="listoption txttheme" id="teachermenutab_A" style="padding-right:10px; float:left;"></ul>
                    </div>
                    
                    <div class="circular_outer" style="clear:both;">
                    	<div class="newcircular_head tabbtn" id="tabbtn_N" onclick="showTeacherDtls('TL', '', 'N');">Applicants<span></span></div>
                        <ul class="listoption" id="teachermenutab_N" style="padding-right:10px; float:left;"></ul>
                    </div>
                    
                    <div class="circular_outer" style="clear:both;">
                    	<div class="newcircular_head tabbtn" id="tabbtn_AR" onclick="showTeacherDtls('TL', '', 'AR');">Archive <span></span></div>
                        <ul class="listoption" id="teachermenutab_AR" style="padding-right:10px;"></ul>
                    </div>
                </div>
            </div><!-- Newsletter Circular -->
            
            <div class="newsletter_right border_theme bgwhite" id="teachercontent"></div>
            
        </div>
    
</div>



<script type="text/javascript">

showTeacherDtls('TL', '', 'A');
function showTeacherDtls(type, id, status, list_type) {  //alert(type); alert(id); alert(status);
	
	if(status=="" || status==undefined) status = "A"; else status=status;
	var mas_search_id = $.trim($('#mas_search_id').val());
	var mas_search_tname = $.trim($('#mas_search_tname').val());
	var search_by = $.trim($('#search_by').val());
	if(list_type=="" || list_type==undefined) list_type = "D"; else list_type=list_type;
	
	if(type=="TL") {
		$('.tabbtn').removeClass('active');
		$('#tabbtn_'+status).addClass('active');
		
		$(".listoption").hide();
		$(".listoption").html('');
		$('#teachermenutab_'+status).show(); 
		$("#teachermenutab_"+status).html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	}
	
	ajax({
		a:'teacher',
		b:'act=loadTeacherList&type='+type+'&id='+id+'&status='+status+'&mas_search_id='+mas_search_id+'&mas_search_tname='+mas_search_tname+'&search_by='+search_by+'&list_type='+list_type,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#teachercontent").html(data);
			if(status!="" && status!=undefined && type=="TL") { 
				showTeacherMenuList(status); 
			}
 		}			
	});
	
}

//showTeacherMenuList('A');
function showTeacherMenuList(type) { 
	
	$("#teachermenutab_"+type).html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'teacher',
		b:'act=loadTeacherMenuList&type='+type,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#teachermenutab_"+type).html(data);
 		}			
	});
	
}

function teacherListPaging(page, type) { 
	
	$("#teachermenutab_"+type).html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'teacher',
		b:'act=loadTeacherMenuList&type='+type+'&page='+page,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#teachermenutab_"+type).html(data);
 		}			
	});
	
}

function showTeacherListDtls(status, list_type) { 
	
	var mas_search_id = $.trim($('#mas_search_id').val());
	var mas_search_tname = $.trim($('#mas_search_tname').val());
	var mas_search_tname_id = $.trim($('#mas_search_tname_id').val());
	var mas_search_email = $.trim($('#mas_search_email').val());
	var search_by = $.trim($('#search_by').val());
	$("#teacherListTab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');

	ajax({
		a:'teacher',
		b:'act=loadTeacherListDtls&status='+status+'&listType='+list_type+'&mas_search_id='+mas_search_id+'&mas_search_tname='+mas_search_tname+'&mas_search_tname_id='+mas_search_tname_id+'&mas_search_email='+mas_search_email+'&search_by='+search_by,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#teacherListTab").html(data);
 		}			
	});
}

function showSubjects(old_ids) {
	
	var school_id = $.trim($('#school_id').val());
	if(old_ids==undefined)old_ids=''; else old_ids=old_ids;

	ajax({
		a:'teacher',
		b:'act=loadMasSubjects&schoolId='+school_id+'&oldSubIds='+old_ids,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#subjecthandlingtab").html(data);
 		}			
	});
	
}


</script>



<?
}
include "template.php";
?>