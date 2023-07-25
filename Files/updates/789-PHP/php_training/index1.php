<?
include "connection.php";

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
	$addeddate = date("Y-m-d H:i:s");
	
	$query = "INSERT INTO contact_form (user_name, password, age, gender, date_of_year, added_date) VALUES ('$user_name', '".$password."', '".$age."', '".$gender."', '".$dateofyear."', '".$addeddate."')";
	mysql_query($query);
	echo mysql_insert_id();
	
	exit();
}

if($_POST['act']=="showList") {
	ob_clean();
	
	$query="select * from contact_form";
	$result = mysql_query($query);
	?>
    <table width="600" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="displaytbl">
      <tr>
        <td>ID</td>
        <td>NAME</td>
        <td>PASSWORD</td>
        <td>AGE</td>
        <td>GENDER</td>
        <td>DOY</td>
      </tr>
      <? while ($row = mysql_fetch_assoc($result)) { ?>
      <tr>
        <td><?=$row["id"]?></td>
        <td><?=$row["user_name"]?></td>
        <td><?=$row["password"]?></td>
        <td><?=$row["age"]?></td>
        <td><?=getGender($row["gender"])?></td>
        <td><?=$row["date_of_birth"]?></td>
      </tr>
      <? } ?>
    </table>
    <?
	exit();
}


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
    
    <table width="400" border="0" cellspacing="0" cellpadding="0" style="margin:150px auto 0 auto;">
      <tr>
        <td width="40%">Name</td>
        <td width="5%">:</td>
        <td width="55%"><div class="inp_field"> <input type="text" class="txtbox" id="name" name="name" /></div></td>
      </tr>
      <tr>
        <td width="40%">Password</td>
        <td width="5%">:</td>
        <td width="55%"><div class="inp_field"> <input type="password" class="txtbox" id="password" name="password" /></div></td>
      </tr>
      <tr>
        <td>Age</td>
        <td>:</td>
        <td><div class="inp_field"> <input type="text" class="txtbox" id="age" name="age" /></div></td>
      </tr>
      <tr>
        <td>Gender</td>
        <td>:</td>
        <td>
        	<div class="inp_field">
             <input type="radio" id="male" name="gender" value="M" /> &nbsp; Male
             <input type="radio" id="female" name="gender" value="F" /> &nbsp; Female
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
            </div>
        </td>
      </tr>
      <tr>
        <td colspan="3" align="center">
        	<div class="inp_ftield">
            <input type="button" value="button" onClick="submitRegForm()"  />
            </div>
        </td>
      </tr>
    </table>

</form>



<div style="width:100%; float:left; margin-top:150px;" id="reglist">
    
</div>


<script type="text/javascript">

function submitRegForm() {
	
	var err=0;
	if ($('#name').val()=='') { err = 1;$('#name').addClass('boxerror'); } else { var name=$('#name').removeClass('boxerror').val(); }
	if ($('#password').val()=='') { err = 1;$('#password').addClass('boxerror'); } else { var password=$('#password').removeClass('boxerror').val(); }
	if ($('#age').val()=='') { err = 1;$('#age').addClass('boxerror'); } else { var age=$('#age').removeClass('boxerror').val(); }
	if ($('#dob_year').val()=='') { err = 1;$('#dob_year').addClass('boxerror'); } else { var dateofyear=$('#dob_year').removeClass('boxerror').val(); }
	
	var gender = $('input[name=gender]:checked').val(); alert(gender);
	
	ajax({
		a:'index',
		b:'act=saveRegForm&name='+name+'&password='+password+'&age='+age+'&dateofyear='+dateofyear+'&gender='+gender,
		c:function () {},
		d:function (data) {
			alert('Inserted successfully');
			regListDtls();
		}
	});
	
}



regListDtls();
function regListDtls() {
	
	ajax({
		a:'index1',
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