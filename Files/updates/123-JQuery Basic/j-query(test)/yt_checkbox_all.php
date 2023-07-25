<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>


<p class="delete" style="display:none; width:120px; cursor:pointer; background:#dab791; color:#FFFFFF; text-align:center;">delete</p>

<br/> <br/>

<input type="checkbox" class="checkall" id="" name="" value=""  /> All


<br/> <br/>

<input type="checkbox" class="checknone" id="" name="" value=""  /> None


<br/> <br/>


<input type="checkbox" class="dash_checkbox" id="" name="" value=""  /> 1

<br/> <br/>

<input type="checkbox" class="dash_checkbox" id="" name="" value=""  /> 2 

<br/> <br/>

<input type="checkbox" class="dash_checkbox" id="" name="" value=""  /> 3



<script type="text/javascript">

	$('.dash_checkbox').click(function(){
		if($('.dash_checkbox').is(':checked'))
		{
			$('.delete').show();
			$('.checknone').prop('checked',false);
		}
		else
		{
			$('.delete').hide();
			$('.checkall').prop('checked',false);
		}
	});
	
	$('.checkall').click(function(){
		if($('.checkall').is(':checked'))
		{
			$('.delete').show();
			$('.dash_checkbox').prop('checked',true);
			$('.checknone').prop('checked',false);
		}
		else
		{
			$('.delete').hide();
			$('.dash_checkbox').prop('checked',false);
		}
	});


	$('.checknone').click(function(){
		if($('.checknone').is(':checked'))
		{
			$('.delete').hide();
			$('.dash_checkbox').prop('checked',false);
			$('.checkall').prop('checked',false);
		}
		else
		{
			$('.delete').show();
			$('.dash_checkbox').prop('checked',true);
		}
	});
	
		
</script>




</body>
</html>
