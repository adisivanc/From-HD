
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


<?php
$d=cal_days_in_month(CAL_GREGORIAN,2,1965);
echo "There was $d days in February 1965.<br>";

$d=cal_days_in_month(CAL_GREGORIAN,2,400);
echo "There was $d days in February 2000.";
?>

</body>
</html>