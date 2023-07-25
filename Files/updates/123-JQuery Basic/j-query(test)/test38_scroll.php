<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>


<style>
	div { width: 100px; height: 70px; border: 1px solid blue; overflow: auto; }
</style>


<script type="text/javascript" language="javascript">

	
	var container = $('div'),
		scrollTo = $('#row_8');
	
	
	// Or you can animate the scrolling:
	container.animate({
		scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
	});​


</script>

</head>
<body>

<div>
    <table id="my_table">
        <tr id='row_1'><td>1</td></tr>
        <tr id='row_2'><td>2</td></tr>
        <tr id='row_3'><td>3</td></tr>
        <tr id='row_4'><td>4</td></tr>
        <tr id='row_5'><td>5</td></tr>
        <tr id='row_6'><td>6</td></tr>
        <tr id='row_7'><td>7</td></tr>
        <tr id='row_8'><td>8</td></tr>
        <tr id='row_9'><td>9</td></tr>
    </table>
</div>

</body>
</html>