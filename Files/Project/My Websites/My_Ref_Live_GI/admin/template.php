<?
include "includes.php";

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Green India</title>
<script language="javascript" src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

<script type="text/javascript" src="js/jquery.tablednd.js"></script>
<script language="javascript" src="js/jquery-ui-1.8.11.custom.js"></script>
<script src="js/menumaker.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.6/js/jquery.dataTables.js"></script>
<script type='text/javascript' src='js/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script src="js/jquery.validator.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="css/menumaker.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.8.11.custom.css" />





<style>
.boxerror { border:1px solid #FF0000; }


table.dataTable thead .sorting { background:url("images/asc_icon.png");
}
table.dataTable thead .sorting_asc {
 background:url("images/asc_icon.png");
}
table.dataTable thead .sorting_desc {
  background:url("images/asc_icon.png");
}
table.dataTable thead .sorting_asc_disabled {
  background:url("images/asc_icon.png");
}
table.dataTable thead .sorting_desc_disabled {
  background:url("images/asc_icon.png");
}



</style>

</head>
<body>

<div class="container-fluid logo"> <img src="images/logo.png" alt="" /> </div>

<div class="container-fluid" style="border-bottom:1px solid #666666; border-top:1px solid #666666;"> 	
	<? include "menu.php"; ?> 
</div>


<div class="container-fluid" >
 <? main(); ?>
</div>


<script type="text/javascript">
	$("#cssmenu").menumaker({
		title: "Menu",
		format: "multitoggle"
	});	
</script>

</body>
</html>