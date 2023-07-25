<?	
require("includes.php");

//check state name exist or not
	if($_POST['act']=='check_state')
	{
		ob_clean();
		
		if($_POST['state_name']!='')
		{
			
			$state_obj = new State(); //object for class State
			$state_obj->state_name = trim(ucwords($_POST['state_name'])); //assign object variables
			
			$rsState = $state_obj->checkIfExist(); //check exist or not function in class State 
			
			if($rs_data->status == 'A')
			{
				echo 'already exist';
				exit();
			}
			else
			{
				ob_clean();
				echo 'new state';
			}
			
		}
		
		exit();
	}

//submit form using ajax
	if($_POST['act']=='submit_add')
	{
		ob_clean();
			
			if($_POST['state_name']!='')
			{
				$state_obj = new State();
				$state_obj->state_name = trim(ucwords($_POST['state_name']));
				if($_POST['state_id']>0)
				{
					$state_obj->state_id = $_POST['state_id'];
					$rsState = $state_obj->updateState();
				}
				else
				{
					$rsState = $state_obj->insertState();
				}
				
			}
		
		
		exit();
	}

//submit form using js
	if($_POST['act']=='Submit')
	{
		ob_clean();
		
		$state_obj = new State();
		$state_obj->state_name = trim(ucwords($_POST['state_name']));
		
		$state_obj->insertStateJs();
		
		exit();
	}



?>


<form id="statefrm" name="statefrm" method="post">
	<input type="hidden" id="act" name="act" value="Submit">
	
	<table>
		<tr><td>State Name</td>
			<td><input type="text" id="state_name" name="state_name" style="width:250px; height:25px;" onBlur="checkState()"></td>
				<td><span id="statediv" style="color:#F00; float:left;"></span></td></tr>
		<tr><td></td><td><input type="button" value="Add" onClick="submitAdd()"></td></tr>
	</table>

</form>
<style type="text/css">
.boxerror{border:1px solid #FF0000;}
</style>



<script type="text/javascript" src="../js/default.js"></script>
<script type="text/javascript" src="../js/jquery-1.7.2.js"></script>

<script type="text/javascript">

function checkState() {
	var state_name = $('#state_name').val();
	
	ajax({
		a:'state',
		b:'act=check_state&state_name='+state_name,
		c:function(){},
		d:function(data) {
			//alert(data);
			if($.trim(data)=='already exist')
			{
				$('#stateerror').hide();
				$('#statediv').html('You are already entered, Please enter different!');
				$('#statediv').show();
				$('#state_name').val('');
			}
			else
			{
				$('#stateerror').html('');
				$('#stateerror').hide();
				$('#statediv').html('');
				$('#statediv').hide();
			}
		}	
	});
	
}

function submitAdd()
{ 
	var err = 0;
	if($('#state_name').val()=='')
	{
		err =1;
		$('#state_name').addClass('boxerror');
	}
	else
	{
		$('#state_name').removeClass('boxerror');
	}
	
	if(err==0)
	{
		//document.statefrm.submit(); //js form submit
		var state_name = $('#state_name').val();
		ajax({
				a:'state',
				b:'act=submit_add&state_name='+state_name,
				c:function(){},
				d:function(data)
				{
					//alert(data);
					$('#state_name').val('');
				}
		
		});		
	}
}


</script>
