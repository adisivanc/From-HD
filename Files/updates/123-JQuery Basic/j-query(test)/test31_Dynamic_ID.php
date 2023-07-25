<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>



<style>

div { font-size:24px; }

p:nth-child(1) {
    color: pink;
}

p:nth-child(2) {
    color: green;
}

p:nth-child(3) {
    color: yellow;
}


</style>


</head>
<body>

<div>
 <ul> 
     <li>
             <p>text1</p>
             <p>text2</p>
             <p>text3</p>
     </li>
     <li> .. next item... </li>
 </ul>
</div>



<script type="text/javascript">

$('p').click(function (i) 
{
    $(this).attr('id', 'p_' + i);
});


</script>



</body>
</html>
