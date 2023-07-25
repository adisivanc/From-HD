<?
function main(){
			

if($_POST['act']=="loadUsersList"){
	ob_clean();
	
	$userObj = new User();
	$userObj->orderby = 'id';
	$userObj->sortby = 'Desc';
	$rs_users = $userObj->getAllUserDtls();
	
	//Pagination 
		
		if($_POST['page']=='')
		$page=1;
		else
		$page = $_POST['page'];
		$totalReg = count($rs_users);
		$PageLimit= 10;
		$adjacents = 1;
				
		$totalPages= ceil(($totalReg)/($PageLimit));
		if($totalPages==0) $totalPages=1;
		$StartIndex= ($page-1)*$PageLimit; 
			
		if(count($rs_users)>0) $rs_usersArr = array_slice($rs_users,$StartIndex,$PageLimit,true);
		if(count($rs_users)>0 && $totalPages > 1){ 
			$rsPagination = generatePagination("user", $totalReg, count($rs_usersArr), $PageLimit, $adjacents, $page); 
		}
?>


<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gradetbl" id="grade_studentab">
    <tr>
        <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtbl">
                <tr>
                    <th width="5%" align="center" scope="col">Id</th>
                    <th width="12%" align="left" scope="col">Name</th>
                    <th width="29%" align="left" scope="col">Email Address</th>
                    <th width="18%" align="left" scope="col">Login Credential</th>
                    <th width="11%" align="left" scope="col">Access Type</th>
                    <th width="12%" align="left" scope="col">Grade Level</th>
                    <th width="13%" scope="col">Action</th>
                </tr>
            <?
			  	if(count($rs_usersArr)>0) {
					foreach($rs_usersArr as $K=>$V) {
						$schoolName = explode(',',$V->school_id); 
						$accType = explode(",", $V->access_type);
						$accTypeArr="";
						foreach($accType as $kk=>$vv){
							$accTypeArr[] = $GLOBALS['AccessType'][$vv];
						}
						$accessTypes = implode(",", $accTypeArr);
						
						if($V->grade_level=="All") { $gradeLevels = "All";
						} else {
						$gradeLvl = explode(",", $V->grade_level);
						$gradeLvlArr="";
						foreach($gradeLvl as $kk=>$vv){
							$rs_grade = Grade::getGradeById($vv);
							$gradeLvlArr[] = $rs_grade->grade_name;
						}
						$gradeLevels = implode(",", $gradeLvlArr);
						}
			  ?>
                      <tr>
                        <td align="center"><?=$K+1?></td>
                        <td align="left"><?=$V->name?></td>
                        <td align="left"><div style="word-break:break-all;"><?=$V->email_address?><br /><?=$V->phone?></div></td>
                        <td align="left"><?=$V->user_name?><br /><?=$V->password?></td>
                        <td align="left"><?=$accessTypes?></td>
                        <td align="left"><?=$gradeLevels?></td>
                        <td align="center">
                            <div class="btn_group">
                            <img src="images/edit_icon.png" alt="Edit User" title="Edit User" onclick="showUsersPopup(<?=$V->id;?>)" class="actionicons" />
                            <img src="images/delete_icon.png" alt="Delete User" title="Delete User" onclick="if(confirm('Are you sure want to delete this User?')) deleteUser('<?=$V->id?>')" class="actionicons" />
                            </div>
                        </td>
                      </tr>
              <?
					}
					if($rsPagination!='') {
			  ?>
              			<tr><td colspan="8"><?=$rsPagination?></td></tr>
              <?
					}
				} else {
			  ?>
              		<tr><td colspan="8" align="center">No User Available..!</td></tr>
              <?
				}
			  ?>
            </table>
        </td>
    </tr>
</table>
<? echo "::::".count($rs_users); ?>
<? 	exit();
}

if($_POST['act']=='loadUsersFrm'){
	ob_clean();
	$rsUserName = User::getUserById($_POST['user_id']); 
?>
    <form name="userFrm" id="userFrm" method="post">
    <input type="hidden" name="user_db_id" id="user_db_id" value="<?=$_POST['user_id']?>" />
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
        <tr>
            <th align="left"><strong>&nbsp;<?=($_POST['user_id']!='')?"Edit User":"Add User"?></strong>
            <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
        </tr>
        <tr>
            <td colspan="2"><? include "user_add.php"; ?></td>
        </tr>
    </table>
    </form>
<?	
	exit();
}

if($_POST['act']=='saveUserFrm'){
	ob_clean(); 
	$schArr = explode(",", $_POST['school_id']);
	$schlArr = array(); 
	foreach($schArr as $kk=>$vv) {
		if($vv=="All")  {
			$schlArr[] = $vv; break;
		}
		else {
			$schlArr[] = $vv;
		}
	}
	$schoolid = implode(",", $schlArr);	
	
	$gArr = explode(",", $_POST['grade_Ids']);
	$gradeArr = array(); 
	foreach($gArr as $kk1=>$vv1) {
		if($vv1=="All")  {
			$gradeArr[] = $vv1; break;
		}
		else {
			$gradeArr[] = $vv1;
		}
	}
	$gradeids = implode(",", $gradeArr);
	
	if($_POST['user_id']!=''){
		User::updateUser($schoolid, $_POST['user_type'], $_POST['name'], $_POST['email_address'], $_POST['phone'], $_POST['user_name'], $_POST['password'], $_POST['access_type'], $gradeids, $_POST['user_id']);
	}else{ 
		User::insertUser($schoolid, $_POST['user_type'], $_POST['name'], $_POST['email_address'], $_POST['phone'], $_POST['user_name'], $_POST['password'],  $_POST['access_type'], $gradeids);
	}
	exit();
}

if($_POST['act']=='delUserDtls'){
	ob_clean();
	User::deleteUser($_POST['user_id']);
	exit();
}

if($_POST['act']=="showGradeListDtls") {
	ob_clean();
	$grade_obj = new Grade();
	if($_POST['schoolIds']!="All") $grade_obj->school_ids = $_POST['schoolIds'];
	$rs_grades = $grade_obj->getGradeDtls();
	$GradeArr=array();
	$GradeArr = explode(",",$_POST['gradeIds']);
	?>
    <input type="checkbox" class="grade_ids subclass3" id="grade_ids<?=$index1?>"  name="grade_ids" value="All" onclick="showAccessType('All', 'G');" <? if(in_array("All", $GradeArr)) { echo "checked"; } ?> /> All <br />
	<?	
    foreach($rs_grades as $K=>$V) { $rs_grade = Grade::getGradeById($V->id);
    ?>
    <input type="checkbox" class="grade_ids" id="grade_ids<?=$index1?>"  name="grade_ids" value="<?=$V->id?>" onclick="showAccessType('<?=$V->id?>', 'G');" <? if(in_array($V->id, $GradeArr)) { echo "checked"; } ?> <? if(in_array("All", $GradeArr)) { echo "disabled"; } ?> /> <?=$rs_grade->grade_name?>
    <? 
    }
    ?>
    <?
	exit();
}

if($_POST['act']=="chkUserNameExist") {
	ob_clean();
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
                <td>List <br/> <span class="f30"><strong>Users</strong></span></td>
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
                    <div class="newcircular_head" id="show_currentteacher">Users<span></span></div>
                    <!--<? $rs_schools = School::getAllSchool(); ?>
                    <ul class="currentteacher_content txttheme" id="teachermenutab_A" style="padding-right:10px;">
                    <? foreach($rs_schools as $sk=>$sv) { ?>
                    	<li onclick="showUsersDtls('<?=$sv->id?>')" style="cursor:pointer;"><?=$sv->school_name?></li>
                    <? } ?>
                    </ul>-->
                </div>
                
            </div>
        </div><!-- Menu -->
        
        <div class="newsletter_right border_theme bgwhite" id="hide_allgradelist" style="width:79%;"> <!-- Grade -->
        
        	<div class="fullsize lineht2 border_bottom">
                <div class="pull_left padlr10 padtb10 txtbold letterspac f18">Master Users List</div>
                <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Users: <span id="userscount"></span></div>
                <div class="combutton pull_right" onclick="showUsersPopup('')" style="clear:both;">Add Users</div>
            </div>
            
            <div class="fullsize">
                <div id="showuserlisttab"></div>
            </div>

        </div>

    </div>
    
</div>

<div id="users_popup" style="display:none; padding:0;"></div>



<script type="text/javascript">

function popupDtls(){
	
  	$("#users_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}

function closePopup(){ $("#users_popup").dialog('close');  }

showUsersDtls();
function showUsersDtls() {
  	ajax({
		a:'users',
		b:'act=loadUsersList',		
		c:function(){},
		d:function(data){ //alert(data);
			var dataArr = data.split('::::');
			$("#showuserlisttab").html(dataArr[0]);
			$("#userscount").html(dataArr[1]);
 		}			
	});
}

function userPaging(page) {
	ajax({
		a:'users',
		b:'act=loadUsersList&page='+page,
		c:function(){},
		d:function(data){
			var dataArr = data.split('::::');
			$("#showuserlisttab").html(dataArr[0]);
			$("#userscount").html(dataArr[1]);
		}
	});
}

function showUsersPopup(user_id){ 
	
  	ajax({
		a:'users',
		b:'act=loadUsersFrm&user_id='+user_id,		
		c:function(){},
		d:function(data){ //alert(data);
			$("#users_popup").html(data);
			popupDtls();
		}			
	});
}

function submitUser(user_id){ 
	var err = 0;  
	
	if($('#name').val()==''){ err =1; $('#name').addClass('boxerror');}else{ $('#name').removeClass('boxerror');}
	if($('#email_address').val()=='')
	{
	err=1;
	$('#email_address').addClass('boxerror');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#email_address').val()) == false) 
		{
			err=1;
			$('#email_address').addClass('boxerror');
		}
		else{
			$('#email_address').removeClass('boxerror');
		}
	}
	if($('#phone').val()==''){ err =1; $('#phone').addClass('boxerror');}else{ $('#phone').removeClass('boxerror');}
	if($('#user_name').val()==''){ err =1; $('#user_name').addClass('boxerror');}else{ $('#user_name').removeClass('boxerror');}
	if($('#password').val()==''){ err=1;  $('#password').addClass('boxerror'); } else{ $('#password').removeClass('boxerror');}
	if($('#cpassword').val()==''){  
		err=1;  $('#cpassword').addClass('boxerror'); 
	} 
	else{ 
	
		if($('#cpassword').val()!=$('#password').val())
		{
			err=1;  $('#cpassword').addClass('boxerror'); 
		} 
		else{	
			$('#cpassword').removeClass('boxerror'); 	
		}
	}
	if($.trim($('input[name=user_type]:checked').val())==''){ err=1; $('#showError').addClass('txterror'); } else{ $('#showError').removeClass('txterror'); }
	if($.trim($('input[name=access_type]:checked').val())==''){ err=1; $('#showAccessError').addClass('txterror'); } else{ $('#showAccessError').removeClass('txterror'); }
	if($.trim($('input[name=school_id]:checked').val())==''){ err=1; $('#showSchlError').addClass('txterror'); } else{ $('#showSchlError').removeClass('txterror'); }
	if($.trim($('input[name=grade_ids]:checked').val())==''){ err=1; $('#showGradeLvlError').addClass('txterror'); } else{ $('#showGradeLvlError').removeClass('txterror'); }
	
	var accessType = new Array();
	$('input[name="access_type"]:checked').each(function() {
		accessType.push(this.value);
	});
	
	var gradeIds = $('input[name=grade_ids]:checked').map(function() { return this.value; }).get();
	var schoolIds = $('input[name=school_id]:checked').map(function() { return this.value; }).get();

	if(err==0){
		ajax({
			a:'users',
			b:'act=saveUserFrm&school_id='+schoolIds+'&name='+$('#name').val()+'&email_address='+$('#email_address').val()+'&phone='+$('#phone').val()+'&user_name='+$('#user_name').val()+'&password='+$('#password').val()+'&user_type='+$('input[name=user_type]:checked').val()+'&access_type='+accessType+'&user_id='+user_id+'&grade_Ids='+gradeIds,		
			c:function(){},
			d:function(data){
				//alert(data); return false;
				if(user_id!='') alert('Updated Successfully');
				else alert('Inserted Successfully');
				closePopup();
				showUsersDtls();
			}			
		});
	}
}

function deleteUser(user_id){
	ajax({
		a:'users',
		b:'act=delUserDtls&user_id='+user_id,		
		c:function(){},
		d:function(data){
			//alert(data);
			alert('Deleted Successfully');
			showUsersDtls();
		}			
	});
}

</script>

<?
}
include "template.php";
?>