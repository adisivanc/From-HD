<?
include "includes.php";



function getGender($value) {
	if($value=="F") return "Female";
	else if($value=="M") return "Male";
	else return "";
}

if($_POST['act']=="saveRegForm") {
	
	ob_clean();
	
	$user_name = $_POST['name'];
	$password = $_POST['password'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$dateofyear = $_POST['dateofyear'];
	
	if($_POST['regId']!="" && $_POST['regId']!="undefined") {
		Registration::updateRegistration($_POST['regId'], $user_name, $password, $age, $gender, $dateofyear);
	} else {
		$rs_id = Registration::insertRegistration($user_name, $password, $age, $gender, $dateofyear);
	}
	
	exit();
}



if($_POST['act']=="showList") {
	
	ob_clean();
	
	$result = Registration::getAllRegistrations();
	
	?>
    <table width="600" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="displaytbl">
      <tr>
        <td>ID</td>
        <td>NAME</td>
        <td>PASSWORD</td>
        <td>AGE</td>
        <td>GENDER</td>
        <td>DOY</td>
        <td>Action</td>
        <td>Action</td>
      </tr>
      
      <? foreach($result as $K=>$V) { ?>
      <tr>
        <td><?=$V->id?></td>
        <td><?=$V->user_name?></td>
        <td><?=$V->password?></td>
        <td><?=$V->age?></td>
        <td><?=getGender($V->gender)?></td>
        <td><?=$V->date_of_year?></td>
        <td><a href="index.php?Id=<?=$V->id?>">update</a></td>
        <td><a href="index.php?Id=<?=$V->id?>">delete</a></td>
      </tr>
      <? } ?>
    </table>
    <?
	
	exit();
	
}


$form_row = Registration::getRegById($_REQUEST['Id']);
$form_delrow = Registration::delRegById($_REQUEST['Id']);
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Php Training</title>

<style>

.inp_field { width:100%; float:left; margin:10px 0; }
.listbox { height:32px; padding:2px; width:150px; font-size:17px; }
.txtbox { height:32px; padding:2px 5px; width:190px; font-size:17px; }
.displaytbl tr td { padding:5px 0; text-align:center; }
.boxerror{ border:1px solid #F00; }

</style>

<script type="text/javascript" src="jquery-1.7.2.js"></script>
<script type="text/javascript" src="default.js"></script>



</head>

<body>



<form id="regfrm" name="regfrm" action="" method="post">
<input type="hidden" name="reg_id" id="reg_id" value="<?=$form_row->id?>" />
    
    <table width="400" border="0" cellspacing="0" cellpadding="0" style="margin:150px auto 0 auto;">
      <tr>
        <td width="40%">Name</td>
        <td width="5%">:</td>
        <td width="55%"><div class="inp_field"> <input type="text" class="txtbox" id="name" name="name" value="<?=$form_row->user_name?>" /></div></td>
      </tr>
      <tr>
        <td width="40%">Password</td>
        <td width="5%">:</td>
        <td width="55%"><div class="inp_field"> <input type="password" class="txtbox" id="password" name="password" value="<?=$form_row->password?>" /></div></td>
      </tr>
      <tr>
        <td>Age</td>
        <td>:</td>
        <td><div class="inp_field"> <input type="text" class="txtbox" id="age" name="age" value="<?=$form_row->age?>" /></div></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>:</td>
        <td>
        	<div class="inp_field">
             <input type="radio" id="male" name="gender" value="M" <?=($form_row->gender=="M")?"checked":""?> /> &nbsp; Male
             <input type="radio" id="female" name="gender" value="F" <?=($form_row->gender=="F")?"checked":""?> /> &nbsp; Female
            </div>
        </td>
      </tr>
      <tr>
        <td>Date Of Year</td>
        <td>:</td>
        <td>
        	<div class="inp_field">
             <select class="listbox" id="dob_year" name="dob_year">
             	<option>1988</option>
                <option>1989</option>
                <option>1990</option>
                <option>1991</option>
             </select>
             <script type="text/javascript">
			 $('#dob_year').val('<?=$form_row->date_of_year?>');
			 </script>
            </div>
        </td>
      </tr>
      <tr>
        <td colspan="3" align="center">
        	<div class="inp_ftield">
            <input type="button" value="button" onClick="submitRegForm()"  />
            <input type="button" value="Reset" onClick="submitRegForm('C')"   />
            </div>
        </td>
      </tr>
    </table>

</form>


<div>
<a href="index.php">New Form</a>
</div>




<div style="width:100%; float:left; margin:150px 0;" id="reglist">
    
</div>


<script type="text/javascript">

function submitRegForm(action) {
	
	if(action=="C") {
		$(':input', '#regfrm')
					.not(':button, :submit, :reset, :radio, :checkbox')
					.val('');
		return false;			
	}
	
	
	var err=0;
	var id = $('#reg_id').val();
	if ($('#name').val()=='') { err = 1;$('#name').addClass('boxerror'); } else { var name=$('#name').removeClass('boxerror').val(); }
	if ($('#password').val()=='') { err = 1;$('#password').addClass('boxerror'); } else { var password=$('#password').removeClass('boxerror').val(); }
	if ($('#age').val()=='') { err = 1;$('#age').addClass('boxerror'); } else { var age=$('#age').removeClass('boxerror').val(); }
	if ($('#dob_year').val()=='') { err = 1;$('#dob_year').addClass('boxerror'); } else { var dateofyear=$('#dob_year').removeClass('boxerror').val(); }
	
	var gender = $('input[name=gender]:checked').val(); 
	
	ajax({
		a:'index',
		b:'act=saveRegForm&name='+name+'&password='+password+'&age='+age+'&dateofyear='+dateofyear+'&gender='+gender+'&regId='+id,
		c:function () {},
		d:function (data) { //alert(data);
			if(id!=undefined || id!="") {
				alert('Updated successfully');
			} else {
				alert('Inserted successfully');
			}
			regListDtls();
		}
	});
	
	
}



regListDtls();
function regListDtls() {
	
	ajax({
		a:'index',
		b:'act=showList',
		c:function () {},
		d:function (data) {
			$('#reglist').html(data);
		}
	});
	
}


</script>


</body>
</html>