<?
function main(){

if($_POST['act']=='checkUserNameExist') {
	ob_clean(); 
	$userNameObj = new Teacher();
	$userNameObj->user_name=$_POST['user_name'];
	$userNameObj->check_id=$_POST['teacher_id'];
	$rs_user_teacher = $userNameObj->getTeachersDtls();	
	if(count($rs_user_teacher)>0){
		echo 'already exist';
	} else{
		echo 'not exist';
	}
	exit();	
}

if($_POST['act']=="loadTeacherList"){
	ob_clean();
	$menuType=$_POST['type']; $teacherId=$_POST['id']; $status = $_POST['status'];
	$searchById=$_POST['mas_search_id']; $searchByName=$_POST['mas_search_tname']; $searchBy=$_POST['search_by'];
	
	$rs_teacher = Teacher::getTeachersById($teacherId);
	
	if($menuType=="N" || $menuType=="E") include "teacher_add.php";
	if($menuType=="TL" || $menuType=="C") include "teacher_list.php";
	if($menuType=="TD") include "teacher_details.php";
	exit();
}

if($_POST['act']=="loadTeacherMenuList") {
	ob_clean();
	$teacher_obj = new Teacher();
	if($_SESSION['SchoolId']!='A') $teacher_obj->school_id=$_SESSION['SchoolId'];
	$teacher_obj->sortby="DESC";
	$teacher_obj->orderby="id";
	$teacher_obj->fields="id, prefix, first_name, middle_name, last_name";
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
	if($submit_action=="S") $teacher_status = "N"; else $teacher_status = $submit_action; 
	
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
		Teacher::updateTeachers($teacher_db_id, $school_id, $subject_id, $teacher_prefix, $teacher_firstname, $teacher_middlename, $teacher_lastname, $teacher_gender, $date_of_birth, $marital_status, $teacher_email, $teacher_phone, $teacher_mobile, $teacher_address, $emer_name, $emer_number, $emer_relations, $is_verified, $teacher_qualification, $teacher_designation, $teacher_exp, $date_of_joining, $teacher_status, $teacher_user_name, $teacher_password);
		$teacher_id = $teacher_db_id;
	} else {
		$teacher_id = Teacher::insertTeachers($school_id, $subject_id, $teacher_prefix, $teacher_firstname, $teacher_middlename, $teacher_lastname, $teacher_gender, $date_of_birth, $marital_status, $teacher_email, $teacher_phone, $teacher_mobile, $teacher_address, $emer_name, $emer_number, $emer_relations, $is_verified, $teacher_qualification, $teacher_designation, $teacher_exp, $date_of_joining, $teacher_status, $teacher_user_name, $teacher_password);
	}
	
	if($teacher_id>0) {
		
		if($Uploadup_file){
			$FileObj->AssignFileName($teacher_id);
			$filepath = $FileObj->Upload();
			Teacher::updateTeachersByfield('photo', $filepath, $teacher_id);
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
    <div class="content">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Teacher</strong></span></td>
              </tr>
            </table>
        </div>
        <? if($GLOBALS['isAdd']){ ?><div class="pull_right f24 padtop50 cursor" id="show_addteacher" onclick="showTeacherDtls('N', '', '');">Add Teacher</div><? } ?>
    </div>
    
    </div>
</div>

<div class="fullsize">
    <div class="content">
    
        <div class="fullsize newsletter_outer">
        	
            <div class="newsletter_left"> <!-- Newsletter Circular -->
            	<div class="newsletter_submenu txtwhite">
					
					<div class="circular_outer">
                    	<div class="newcircular_head" id="show_currentteacher" onclick="showTeacherDtls('TL', '', 'A');">Current Teachers<span></span></div>
                        <ul class="currentteacher_content txttheme" id="teachermenutab_A" style="padding-right:10px; float:left;"></ul>
                    </div>
                    
                    <div class="circular_outer" style="clear:both;">
                    	<div class="newcircular_head" id="show_applicants" onclick="showTeacherDtls('TL', '', 'N');">Applicants<span></span></div>
                        <ul class="applicants_content" id="teachermenutab_N" style="padding-right:10px; float:left;"></ul>
                    </div>
                    
                    <div class="circular_outer" style="clear:both;">
                    	<div class="newcircular_head" id="show_archive" onclick="showTeacherDtls('TL', '', 'I');">Archive <span></span></div>
                        <ul class="archive_content" id="teachermenutab_I" style="padding-right:10px;"></ul>
                    </div>
                </div>
            </div><!-- Newsletter Circular -->
            
            <div class="newsletter_right border_theme bgwhite" id="teachercontent"></div>
            
        </div>
    
    </div>
</div>



<script type="text/javascript">

showTeacherDtls('TL', '', 'A');
function showTeacherDtls(type, id, status) {
	
	var mas_search_id = $.trim($('#mas_search_id').val());
	var mas_search_tname = $.trim($('#mas_search_tname').val());
	var search_by = $.trim($('#search_by').val());
	
	ajax({
		a:'teacher',
		b:'act=loadTeacherList&type='+type+'&id='+id+'&status='+status+'&mas_search_id='+mas_search_id+'&mas_search_tname='+mas_search_tname+'&search_by='+search_by,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#teachercontent").html(data);
			if(status!="" && status!=undefined) showTeacherMenuList(status);
 		}			
	});
	
}

showTeacherMenuList('A');
function showTeacherMenuList(type) { 
	
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
	
	ajax({
		a:'teacher',
		b:'act=loadTeacherMenuList&type='+type+'&page='+page,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#teachermenutab_"+type).html(data);
 		}			
	});
	
}

$("#show_currentteacher").click(function(){
   $(this).addClass('active');
   $("#show_applicants").removeClass('active');
   $("#show_archive").removeClass('active');
   $(".currentteacher_content").show();
   $(".applicants_content").hide();
   $(".archive_content").hide();   
});

$("#show_applicants").click(function(){
   $(this).addClass('active');
   $("#show_currentteacher").removeClass('active');
   $("#show_archive").removeClass('active');
   $(".currentteacher_content").hide(); 
   $(".applicants_content").show(); 
   $(".archive_content").hide(); 
});


$("#show_archive").click(function(){
   $(this).addClass('active');
   $("#show_currentteacher").removeClass('active');
   $("#show_applicants").removeClass('active');
   $(".currentteacher_content").hide(); 
   $(".applicants_content").hide(); 
   $(".archive_content").show(); 
});





/*$("#show_addteacher").click(function(){
   $("#view_addteacher").show();
   $("#list_teacher").hide(); 
   $("#view_teacherdetails").hide(); 
});
*/


$("#teacher_deatils1").click(function(){
   $("#view_addteacher").hide();
   $("#list_teacher").hide(); 
   $("#view_teacherdetails").show(); 
});


</script>



<?
}
include "template.php";
?>