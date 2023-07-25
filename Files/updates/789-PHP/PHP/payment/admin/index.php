<?
require_once("includes.php");

if(isset($_SESSION['NEWSAdminId'])){
	header('location:dashboard.php');
	exit();
}

if(isset($_POST['Submit'])) {
	
	extract($_POST);
	$ErrEmpty = $Err = $ErrorList = array();
	$ErrFlag = false;
	$ValidationArr = array('UserName','Password');
	
	foreach($ValidationArr as $V)
	{
		if($$V=='')
		{
			$ErrEmpty[$V] = $V.' is Mandatory';
			$ErrFlag = true;
		}
	}
	
	if(!$ErrFlag)
	{
		//Chk Username & password correct in db
		
		 $selectdetail=array();
		 $selectdetail['Where']=array('AdminUname'=>$UserName,'AdminPass'=>$Password);
		 $selectdetail['TableName']='TBL_NEWSET';
		 $result_detail=Table::selectRecords(serialize($selectdetail));	
		 if(count($result_detail) > 0)
		 {
		    $result_detail=$result_detail[0];
			SessionWrite('AdminId',$result_detail->Id);
			SessionWrite('WRCAdminType',$result_detail->Type);
			session_write_close();
		    header("location:dashboard.php");		   
		 }
		 else
		 {
		 	$ErrorList['Invalid'] = '<span class="text-red">Invalid Username or Password.</span>';
		 }
		}
	}


?>
<html>
<head>
 <title>Administration Panel</title>
<style type="text/css">
	.text-red { color:#F00;}
</style> 
</head>
<body onLoad="document.form1.UserName.focus();" style="background:none">
<table width="100%" border="0" >
  <tr>
    <td height="500" align="center" style="padding-top:80px">
	<table width="50%" border="0" align="center" cellpadding="15" cellspacing="0" class="Content" style="border:1px solid #D9DEE2; background-image:url(images/bg.jpg);">
      <tr>
        <td>
			<form id="form1" name="form1" method="post" action="">
			<table width="70%" border="0" align="center" cellpadding="8" class="table_content" style="color:#83b123">
			<tr>
			  <td colspan="2" align="left" style="font-size:20px"><span style="color:#000" ><strong>Log in to Admin Panel</strong></span></td>
			  </tr>
			<? if($ErrorList['Invalid']!='') { ?>
			<tr>
			<td colspan="2" align="center" class="text-red">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_error">
              <tr>
                <td><?=$ErrorList['Invalid']?></td>
              </tr>
            </table></td>
			</tr>
			<? } ?>
			<tr>
			<td <? if($ErrEmpty['UserName']!='') { ?> class="text-red" <? } ?>><strong>User Name</strong></td>
			<td <? if($ErrEmpty['Password']!='') { ?> class="text-red" <? } ?>><strong>Password</strong></td>
			</tr>
			<tr>
			<td width="41%"><input name="UserName" type="text"  id="UserName"  value="<?=$UserName?>" size="40" style="height:25px" /></td>
			<td width="51%"><input name="Password" type="password"  id="Password" size="40" style="height:25px"/></td>
			</tr>
			
			<tr>
			<td height="30" colspan="2" align="right">
				<input type="submit" name="Submit" value="Login" />
            </td>
			</tr>			
			</table>
			</form>		</td>
      </tr>
      
    </table></td>
  </tr>
</table>
</body>
</html>