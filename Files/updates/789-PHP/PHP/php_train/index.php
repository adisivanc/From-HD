<?

	include "connection.php";



	function getGender($value) {
		if($value=="F") return "Female";
		else if($value=="M") return "Male";
		else return "";
	}



	if($_POST['act']=="addemp_form") {
		
		ob_clean();
		$emp_name = $_POST['emp_name'];
		$emp_mobnumber = $_POST['emp_number'];
		$emp_paytype = $_POST['emp_paytype'];
		$emp_salary = $_POST['emp_sal'];
		$emp_address = $_POST['emp_address'];
		$gender = $_POST['gender'];
		
	
		$query = "INSERT INTO employee_info (emp_name, emp_mobile, gender, emp_salary, emp_address, salary_type) VALUES ('".$emp_name."', '".$emp_mobnumber."', '".$gender."', '".$emp_salary."', '".$emp_address."', '".$emp_paytype."')";
		mysql_query($query); 
		echo mysql_insert_id();
		
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
.listbox { width:300px; height:32px; padding:2px; font-size:17px; }
.txtbox { width:300px; height:32px; padding:2px 5px; font-size:17px; }
.displaytbl { border:2px solid #d7d7d7; }
.displaytbl tr td { padding:7px 10px; text-align:center; font-size:24px; text-align:left; }
.boxerror{ border:1px solid #F00; }
.errortxt{ color:#FF0000; }

.submitbtn { background-color:#66F; color:#FFFFFF; width:200px; font-size:18px; text-align:center; padding:12px 0; margin:20px auto 0 auto ; cursor:pointer; }

</style>

<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="js/default.js"></script> <!-- For ajax -->


</head>

<body>



<div class="inp_field">

    <h2 align="center">Employee Table</h2>
    
    <form id="saveemp_form" name="saveemp_form" action="" method="post">
    
    <table width="600" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="displaytbl">
      <tr>
        <td>Employee Name</td>
        <td>:</td>
        <td><input type="text" class="txtbox" id="emp_name" name="emp_name" value="" /></td>
      </tr>
      <tr>
        <td>Employee Mobile No</td>
        <td>:</td>
        <td><input type="text" class="txtbox" id="emp_number" name="emp_number" value="" /></td>
      </tr>
      <tr>
        <td id="gender_id">Gender</td>
        <td>:</td>
        <td>
            <input type="radio" id="male" class="" name="emp_gender" value="M" /> Male &nbsp; &nbsp;
            <input type="radio" id="female" class="" name="emp_gender" value="F" /> Female
        </td>
      </tr>
      <tr>
        <td>Salary</td>
        <td>:</td>
        <td><input type="text" class="txtbox" id="emp_sal" name="emp_sal" value="" /></td>
      </tr>
      <tr>
        <td valign="top">Address</td>
        <td valign="top">:</td>
        <td>
            <textarea style="height:100px;" class="txtbox" id="emp_address" name="emp_address"></textarea>
        </td>
      </tr>
      <tr>
        <td>Pay Type</td>
        <td>:</td>
        <td>
            <select id="emp_paytype" name="emp_paytype" class="listbox">
                <option></option>
                <option>By Cash</option>
                <option>By Transfer</option>
            </select>
        </td>
      </tr>
      <tr>
        <td align="center" colspan="3"> <div class="submitbtn" onclick="submit_emp_form()">SUBMIT</div>    </td>
      </tr>
    </table>
    
    </form>
    

</div>



<script type="text/javascript">


function submit_emp_form() {
	
	
	var err=0;
	if ($('#emp_name').val()=='') { err = 1;$('#emp_name').addClass('boxerror'); } else { var emp_name=$('#emp_name').removeClass('boxerror').val(); }
	if ($('#emp_number').val()=='') { err = 1;$('#emp_number').addClass('boxerror'); } else { var emp_number=$('#emp_number').removeClass('boxerror').val(); }
	if ($('#emp_sal').val()=='') { err = 1;$('#emp_sal').addClass('boxerror'); } else { var emp_sal=$('#emp_sal').removeClass('boxerror').val(); }
	if ($('#emp_address').val()=='') { err = 1;$('#emp_address').addClass('boxerror'); } else { var emp_address=$('#emp_address').removeClass('boxerror').val(); }
	if ($('#emp_paytype').val()=='') { err = 1;$('#emp_paytype').addClass('boxerror'); } else { var emp_paytype=$('#emp_paytype').removeClass('boxerror').val(); }
	
	
	if(!$('input[name="emp_gender"]:checked').val())
	{ 
		err=1; 
		$('#gender_id').addClass('errortxt'); 
	} 
	else { 
		$('#gender_id').removeClass('errortxt');
		var gender=$('input[name="emp_gender"]:checked').val(); 
	}

	
	if(err==0)
	{
		
		ajax({
			a:'index',
			b:'act=addemp_form&emp_name='+emp_name+'&emp_number='+emp_number+'&emp_sal='+emp_sal+'&emp_address='+emp_address+'&emp_paytype='+emp_paytype+'&gender='+gender,
			c:function () {},
			d:function (data) {
				alert(data);
				alert('Inserted successfully');
				emplist_details();
				}
		});
		
	}

	
}



emplist_details();
function emplist_details() {
	
	ajax({
		a:'index',
		b:'act=show_emp_details',
		c:function () {},
		d:function (data) {
			$('#reglist').html(data);
		}
	});
	
}




</script>


</body>
</html>