<style>
.boxerror{border:1px solid #F00;}
.txterror{color:#F00}
</style>
<input type="hidden" name="user_db_id" id="user_db_id" value="<?=$rsUserName->id?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtbl">
    
    <tr>
        <td id="showError">User Type</td>
        <td>
        <input type="radio" name="user_type" id="user_type" value="SA" <? if($rsUserName->user_type=='SA') echo "checked='checked'"?> />Super Admin
        <input type="radio" name="user_type" id="user_type" value="A" <? if($rsUserName->user_type=='A' || $rsUserName->user_type=='') echo "checked='checked'"?> />Admin
        <input type="radio" name="user_type" id="user_type" value="FO" <? if($rsUserName->user_type=='FO') echo "checked='checked'"?> />Front Office
        <input type="radio" name="user_type" id="user_type" value="T" <? if($rsUserName->user_type=='T') echo "checked='checked'"?> />Teacher
        </td>
    </tr>

    <tr>
        <td>Name</td>
        <td><input type="text" class="txtbox" name="name" id="name" value="<?=$rsUserName->name?>" /></td>
    </tr>
    
    <tr>
        <td>Email Address</td>
        <td><input type="text" class="txtbox" name="email_address" id="email_address" value="<?=$rsUserName->email_address?>" /></td>
    </tr>
    
    <tr>
        <td>Phone</td>
        <td><input type="text" class="txtbox" name="phone" id="phone" value="<?=$rsUserName->phone?>" /></td>
    </tr>
    
    <tr>
        <td>User Name</td>
        <td><input type="text" class="txtbox" name="user_name" id="user_name" value="<?=$rsUserName->user_name?>" onblur="checkUserExists()" />
        	<span id="userNameErr" class="txterror"></span>
        </td>
    </tr>
    
    <tr>
        <td>Password</td>
        <td><input type="password" class="txtbox" name="password" id="password" value="<?=$rsUserName->password?>" /></td>
    </tr>
    
    <tr>
        <td>Confirm Password</td>
        <td><input type="password" class="txtbox" name="cpassword" id="cpassword" value="<?=$rsUserName->password?>" /></td>
    </tr>

    <tr>
        <td id="showSchlError">School Name</td>
        <td>
			<?
            $schoolObj = new School();
            $rsSchool = $schoolObj->getSchoolDtls();  
			$SchoolArr=array();
			$SchoolArr = explode(",",$rsUserName->school_id);
            ?>
            <input type="checkbox" class="school_id subclass2" id="school_id<?=$index1?>"  name="school_id" value="All" onclick="showAccessType('All', 'S'); showGradeList();" <? if(in_array("All", $SchoolArr)) { echo "checked"; } ?> /> All
        	<?	
            foreach($rsSchool as $K=>$V) { $rs_school = School::getSchoolById($V->id);
            ?>
            <input type="checkbox" class="school_id" id="school_id<?=$index1?>"  name="school_id" value="<?=$V->id?>" onclick="showAccessType('<?=$V->id?>', 'S'); showGradeList();" <? if(in_array($V->id, $SchoolArr)) { echo "checked"; } ?> /> <?=$rs_school->school_name?>
            <? 
            }
            ?>
        
        </td>
    </tr>
    
    <tr id="gradeleveltab" style="display:none;">
        <td id="showGradeLvlError">Grade Level</td>
        <td id="gradelevellist"></td>
    </tr>
    
    <tr>
        <td id="showAccessError">Access Type</td>
        <td>
			<?	$index1=0; 
            $accessTypeArr = explode(",", $rsUserName->access_type);
            
            foreach($GLOBALS['AccessType'] as $FK=>$FV) { $index1++; 
            ?>
            <input type="checkbox" class="accessType <?=($FK=="All")?"subclass1":""?>" id="access_type<?=$index1?>"  name="access_type" value="<?=$FK?>" onclick="showAccessType('<?=$FK?>', 'AT')" <? if(in_array($FK, $accessTypeArr)) { echo "checked"; } ?> /> <?=$FV?>
            <? 
            }
            ?>
        </td>
    </tr>

    <tr>
        <td align="right" colspan="2">
        	<? if($_POST['user_id']!='') $actionName="Edit"; else $actionName="Add"; ?>
            <div class="combutton pull_right" id="userSaveBtn" onClick="submitUser('<?=$_POST['user_id']?>')"><?=$actionName?></div>
            <div class="combutton pull_right" id="userProcessBtn" style="display:none;">Processing..</div>
        </td>
    </tr>

</table>

<script type="text/javascript">


showGradeList('<?=$rsUserName->grade_level?>');
function showGradeList(gradeIds) {
	var school_ids = $('input[name=school_id]:checked').map(function() { return this.value; }).get();
	$('#gradeleveltab').hide();
	$('#gradelevellist').html(''); 
	if(school_ids!="") {
	
	ajax({
		a:'users',
		b:'act=showGradeListDtls&schoolIds='+school_ids+'&gradeIds='+gradeIds,		
		c:function(){},
		d:function(data){
			//alert(data);
			$('#gradeleveltab').show();
			$('#gradelevellist').html(data);
		}			
	});
	}
}

<? if($rsUserName->access_type=="All") { ?>
	showAccessType('<?=$rsUserName->access_type?>', 'AT');
<? } ?>

<? if($rsUserName->school_id=="All") { ?>
	showAccessType('<?=$rsUserName->school_id?>', 'S');
<? } ?>

<? if($rsUserName->grade_level=="All") { ?>
	showAccessType('<?=$rsUserName->grade_level?>', 'G');
<? } ?>

function showAccessType(type, action){  
	if(action=="AT") {
		if(type=='All'){
			if($('.subclass1').is(":checked")) { 
				$("input[name=access_type]").not($('.subclass1')).attr('disabled', 'disabled');
				$("input[name=access_type]").not($('.subclass1')).attr('checked', false);
			}else{
				$("input[name=access_type]").removeAttr('disabled');
			}
		}
	}
	
	if(action=="S") {
		if(type=='All'){
			if($('.subclass2').is(":checked")) {
				$("input[name=school_id]").not($('.subclass2')).attr('disabled', 'disabled');
				$("input[name=school_id]").not($('.subclass2')).attr('checked', false);
			}else{
				$("input[name=school_id]").removeAttr('disabled');
			}
		}
	}
	
	if(action=="G") { 
		if(type=='All'){
			if($('.subclass3').is(":checked")) {
				$("input[name=grade_ids]").not($('.subclass3')).attr('disabled', 'disabled');
				$("input[name=grade_ids]").not($('.subclass3')).attr('checked', false);
			} else {
				$("input[name=grade_ids]").removeAttr('disabled');
			}
		}
	}
}

function checkUserExists() { 
	
	var err=0;
	var user_name = $('#user_name').val();
	
	var param = '&schoolId='+school_id+'&user_name='+user_name;
	
	if($('#user_name').val()==''){ err=1; $('#user_name').addClass('boxerror'); } else { $('#user_name').removeClass('boxerror'); }
	if($('#user_db_id').val()>0 && $('#user_db_id').val()!=undefined) param += '&user_id='+$('#user_db_id').val();
	
	if(err==0) {
		ajax({
			a:'users',
			b:'act=chkUserNameExist'+param,
			c:function(){},
			d:function(data){
				//alert(data);
				if($.trim(data)=='already exist'){
					$('#userNameErr').html('<br />User name already exists');
					$('#user_name').val('');
					$('#user_name').focus();
				}
				else{
					$('#userNameErr').html('');
				}
			}
		});
	}
	
}



</script>