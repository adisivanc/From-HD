<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>

<button class="btn1">Change color of the animated element</button>

<table width="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <div style="background:blue;">Div 1</div>
        <div style="background:green;">Div 2</div>
        <div style="background:yellow;">Div 3</div>
    </td>
  </tr>
</table>


<script> 

$(document).ready(function(){
    function aniDiv(){
        $("div:eq(1)").animate({width: "55%"}, 5000);
        $("div:eq(1)").animate({width: "100%"}, "slow", aniDiv);
    }
    aniDiv();
    $(".btn1").click(function(){
        $(":animated").css("background-color", "red");
    });
});
</script>




</body>
</html>
