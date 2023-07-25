<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

<style>

.ghghgh { background:#d7e7f7; height:50px; widows:87px; float:left; padding:5px 10px; } 

</style>

</head>
<body>


<div>
    <em title="Bold and Brave" data-source="Hello">This is first paragraph.</em>
    <p id="myid">This is second paragraph.</p>
    <div id="divid"></div>
</div>
 
<script type="text/javascript" language="javascript">

   $(document).ready(function() {
      var title = $("em").attr("data-source");
      $("#divid").text(title);
   });

</script>

</body>
</html>