<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>


<input type="checkbox" class="check_all" id="" name="" value="" checked="checked"  /> All

<br/> <br/>

<input type="checkbox" class="dash_checkbox" id="" name="" value=""  /> 1

<br/> <br/>

<input type="checkbox" class="dash_checkbox" id="" name="" value=""  /> 2 

<br/> <br/>

<input type="checkbox" class="dash_checkbox" id="" name="" value=""  /> 3



<script type="text/javascript">

	
	
	$('.dash_checkbox').click(function(){
		if($('.dash_checkbox').is(':checked'))
		$('.check_all').prop('checked',false);
		else
		$('.check_all').prop('checked',true);
	});
	
	
	$('.check_all').click(function(){
		if($('.dash_checkbox').is(':checked'))
		$('.dash_checkbox').prop('checked',false);
		else
		$('.dash_checkbox').prop('checked',true);
	});
	
		
</script>




</body>
</html>
