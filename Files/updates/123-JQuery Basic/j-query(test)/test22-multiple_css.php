<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

</head>
<body>


	<table width="500" border="1" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="table1">
      <tr>
        <td width="50%">1</td>
        <td width="50%">2</td>
      </tr>
      <tr>
        <td>3</td>
        <td>
          	
            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;" class="table2">
              <tr>
                <td>10</td>
              </tr>
              <tr>
                <td>11</td>
              </tr>
              <tr>
                <td>12</td>
              </tr>
            </table>
  
        </td>
      </tr>
      <tr>
        <td>4</td>
        <td>5</td>
      </tr>
      <tr>
        <td>6</td>
        <td>7</td>
      </tr>
    </table>
 
 
 
 
	<script type="text/javascript" language="javascript">
    
        $(document).ready(function() {
          $(".table1 tr:nth-child(2) .table2 tr:nth-child(2)").css("color","red").css("background-color","#d7d8d9");
        });
    
    </script>
   
   
</body>
</html>