<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

<script type="text/javascript" language="javascript">
   
   $(document).ready(function() {

      $("div").click(function(event){
          alert("This is : " + $(this).text());
          // Comment the following to see the difference
          event.stopPropagation();
      });

   });

   </script>
   <style>
      div{ margin:10px;padding:12px;
             border:2px solid #666;
             width:160px;
           }
  </style>
</head>
<body>
   <p>Click on any box to see the effect:</p>
   <div id="div1" style="background-color:blue;">
       OUTER BOX
       <div id="div2" style="background-color:red;">
             INNER BOX
      </div> 
  </div>
</body>
</html>