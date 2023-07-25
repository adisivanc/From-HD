<?
		
	if($_POST['act']=='addTax') {
		  ob_clean();

		  exit();	
	}
	
?>

<div class="users_details">
    	<table width="450" border="0" cellspacing="0" cellpadding="0" class="addUsertbl">
          <tr>
            <th colspan="2">Add User</th>
          </tr>
          <tr>
            <td valign="top" width="130">User Name</td>
            <td> <input type="text" class="txtbox" id="username" name="username" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Password</td>
            <td> <input type="password" class="txtbox" id="password" name="password" value="" /> </td>
          </tr>
          <tr>
            <td valign="top">Full Name</td>
            <td> <input type="text" class="txtbox" id="name" name="name" value="" /> </td>
          </tr>
          <tr>
            <td valign="top" id="status_err">Status</td>
            <td> 
            	<input type="radio" id="user_active" name="status" value="A" /> Active
                <input type="radio" id="user_inactive" name="status" value="IA" />  Inactive
            </td>
          </tr>
          <tr>
            <td valign="top">Access Type</td>
            <td> 
            	<select class="combo-lg" id="access_type" name="access_type" >
                	<option value="">Select Access Type</option>
                    <option value="SA">Super Admin</option>
                    <option value="A">Admin</option>
                </select> 
            </td>
          </tr>
          <tr>
            <td valign="top" align="right" colspan="2">
            	<input type="button" class="btn" value="Add" onclick="addUsers()" style="margin-top:10px;" />
            </td>
          </tr>
        </table>
</div>


<script type="text/javascript">

function addUsers(){
	
	var err = 0;
	var username,password,name,access_type,status;

	if(	$('#username').val()=='' ){ err=1; $('#username').addClass('boxred'); } else{ $('#username').removeClass('boxred'); username = $('#username').val(); }
	if(	$('#password').val()=='' ){ err=1; $('#password').addClass('boxred'); } else { $('#password').removeClass('boxred'); password = $('#password').val(); }
	if(	$('#name').val()=='' ){ err=1; $('#name').addClass('boxred'); } else { $('#name').removeClass('boxred'); name = $('#name').val(); }
	if(	$('#access_type').val()=='' ){ err=1; $('#access_type').addClass('boxred'); } else { $('#access_type').removeClass('boxred'); access_type = $('#access_type').val(); }

	if(!$('input[name="status"]:checked').val()){ err=1; $('#status_err').addClass('txterror'); } else { $('#status_err').removeClass('txterror'); status = $('input[name="status"]:checked').val(); }

	if(err==0){ 
	
	 var paramData = {'act':'addUsers','username':username,'password':password,'name':name,'access_type':access_type,'status':status }
	 
		ajax({ 
		a:'users',
		b:$.param(paramData),
		c:function(){},
		d:function(data){}
		});
	
	}
	
}

</script>

