<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>This Keyword</title>

<script src="js/default.js"></script>
<script src="js/jquery-1.7.2.js"></script>

<style>

.subclass { display:none; }
.click_hello { border:1px solid red; }
table tr td { padding:7px; }
.full_width { width:100%; float:left; background-color:#dddddd; }

</style>

</head>
<body>


<div class="full_width" >
	
    <table width="500" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td><input type="checkbox" value="" id="" name="" class="check" /></td>
        <td>
        	
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><input type="checkbox" value="" id="" name="" class="sub_check1" /></td>
              </tr>
              <tr>
                <td><input type="checkbox" value="" id="" name="" class="sub_check2" /></td>
              </tr>
              <tr>
                <td><input type="checkbox" value="" id="" name="" class="sub_check3" /></td>
              </tr>
              <tr>
                <td>
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="25"> &nbsp; </td>
                        <td><input type="checkbox" value="" id="" name="" class="rv_sub_check1" /></td>
                      </tr>
                      <tr>
                        <td> &nbsp; </td>
                        <td><input type="checkbox" value="" id="" name="" class="rv_sub_check2" /></td>
                      </tr>
                      <tr>
                        <td> &nbsp; </td>
                        <td><input type="checkbox" value="" id="" name="" class="rv_sub_check3" /></td>
                      </tr>
                    </table>
                </td>
              </tr>
            </table>

        </td>
      </tr>
    </table>

</div>



<script type="text/javascript">


	$('.check').click(function(){
		if($('.check').is(':checked'))
		{
			for(i=1; i<=3; i++)
			{
				$('.sub_check'+i).prop('checked',true);
			}
			
			for(i=1; i<=3; i++)
			{
				$('.rv_sub_check'+i).prop('checked',true);
			}
			
		}
		else
		{
			
			for(i=1; i<=3; i++)
			{
				$('.sub_check'+i).prop('checked',false);
			}
			
			for(i=1; i<=3; i++)
			{
				$('.rv_sub_check'+i).prop('checked',false);
			}
			
		}
	});






	$('.sub_check1').add('.sub_check2').add('.sub_check3').add('.rv_sub_check1').add('.rv_sub_check2').add('.rv_sub_check3').click(function(){



			for(i=1; i<=3; i++)
			{
				if($('.sub_check'+i).is(':checked') && $('.rv_sub_check'+i).is(':checked'))
				{
					if(i<=2)
					{
						continue;
					}
					else
					{
						$('.check').prop('checked',true);
					}
					
				}
				else
				{
					$('.check').prop('checked',false);
					break;
				}
			}



	});




	$('.rv_sub_check1').add('.rv_sub_check2').add('.rv_sub_check3').click(function(){



			for(i=1; i<=3; i++)
			{
				if($('.rv_sub_check'+i).is(':checked'))
				{
					if(i<=2)
					{
						continue;
					}
					else
					{
						$('.sub_check3').prop('checked',true);
					}
					
				}
				else
				{
					$('.sub_check3').prop('checked',false);
					break;
				}
			}



	});


</script>



</body>
</html>
