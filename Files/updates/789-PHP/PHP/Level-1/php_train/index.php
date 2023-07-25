<?

include "connection.php";




if($_POST['act']=="saveRegForm") {
	
	ob_clean();
	$customer_name = $_POST['name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$dateofyear = $_POST['dateofyear'];
	$addeddate = date("Y-m-d H:i:s");
	
	echo $query = "INSERT INTO contact_form (custname, custage, gender, addeddate, birthyear) VALUES ('".$customer_name."', '".$age."', '".$gender."', '".$addeddate."', '".$dateofyear."')";
	mysql_query($query); // Above Query run in  Mysql so we give this
	echo mysql_insert_id();
	
	exit();
}





if($_POST['act']=="showList") {
	
	ob_clean();
	
	$query="select * from contact_form";
	$result = mysql_query($query);
	
	?>
    
    
    <table width="700" border="1" cellspacing="0" cellpadding="0" style="margin:150px auto 0 auto;" class="displaytbl">
      <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Age</td>
        <td>Gender</td>
        <td>Add Date</td>
        <td>Update Date</td>
        <td>Birth Year</td>
      </tr>
      <? while ($row = mysql_fetch_assoc($result)) { ?>
      <tr>
        <td><?=$row["id"]?></td>
        <td><?=$row["custname"]?></td>
        <td><?=$row["custage"]?></td>
        <td><?=$row["gender"]?></td>
        <td><?=$row["addeddate"]?></td>
        <td><?=$row["updatedate"]?></td>
        <td><?=$row["birthyear"]?></td>
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
.errortxt{ color:#F00; }

</style>

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script> <!-- For ajax -->


</head>

<body>


<form id="regfrm" name="regfrm" action="" method="post">
    
    <table width="400" border="0" cellspacing="0" cellpadding="0" style="margin:150px auto 0 auto;">
      <tr>
        <td width="40%">Name</td>
        <td width="5%">:</td>
        <td width="55%"><div class="inp_field"> <input type="text" class="txtbox" id="name" name="name" value="" /></div></td>
      </tr>
      <tr>
        <td>Age</td>
        <td>:</td>
        <td><div class="inp_field"> <input type="text" class="txtbox" id="age" name="age" /></div></td>
      </tr>
      <tr>
        <td id="gender_id">Gender</td>
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
             	<option></option>
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


<div class="inp_field" id="customer_info">


</div>






<script type="text/javascript">

function submitRegForm() {
	
	var err=0;
	if ($('#name').val()=='') { err = 1;$('#name').addClass('boxerror'); } else { var name=$('#name').removeClass('boxerror').val(); }
	if ($('#password').val()=='') { err = 1;$('#password').addClass('boxerror'); } else { var password=$('#password').removeClass('boxerror').val(); }
	if ($('#age').val()=='') { err = 1;$('#age').addClass('boxerror'); } else { var age=$('#age').removeClass('boxerror').val(); }
	if ($('#dob_year').val()=='') { err = 1;$('#dob_year').addClass('boxerror'); } else { var dateofyear=$('#dob_year').removeClass('boxerror').val(); }
	
	
	if(!$('input[name="gender"]:checked').val()){ err=1; $('#gender_id').addClass('errortxt'); } else { $('#gender_id').removeClass('errortxt'); var gender=$('input[name="gender"]:checked').val(); }
	
	if(err==0)
	{
		
		ajax({
			a:'index',
			b:'act=saveRegForm&name='+name+'&age='+age+'&dateofyear='+dateofyear+'&gender='+gender,
			c:function () {},
			d:function (data) {
				alert(data);
				alert('Inserted successfully');
				regListDtls();
				}
		});
	
	}
	
}



regListDtls();
function regListDtls() {
	
	ajax({
		a:'index',
		b:'act=showList',
		c:function () {},
		d:function (data) {
			$('#customer_info').html(data);
		}
	});
	
}



</script>



</body>
</html>