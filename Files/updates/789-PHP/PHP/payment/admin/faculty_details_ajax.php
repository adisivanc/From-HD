<?  
$prev=$next=$last=$first='&nbsp;';

if($page > 1)
$first = "<img src='images/first_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_showFacultyPaging(\"1\")'/>";

if($page < $totalPages)
$last = "<img src='images/last_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_showFacultyPaging(\"$totalPages\")'/>";
	if(count($rsFacultyDtls)>0 && $totalPages > 1){
		if($page > 1){
			$pageNo = $page - 1;
			$prev = "<img src='images/prev_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_showFacultyPaging(\"".$pageNo."\")'/>";
		} 
			
		if ($page < $totalPages){
			$pageNo = $page + 1;
			$next = " <img src='images/next_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_showFacultyPaging(\"".$pageNo."\")'/>";
		} 
		
		if($pageNo=='')
			$pageNo=1;
		if($totalPages>1) {
		$pagebox="<td style='border:0;'><input type='text' name='page' id='page' value='".$page."' onchange='func_showFacultyPaging(this.value)' style='border: 1px solid rgb(170, 170, 170); text-align: center; width: 25px; height: 15px; vertical-align: middle;' size='4'> of $totalPages</td>";
		}	
			
			
		 $table_val = "<table width='268' cellpading='5' cellspacing='0' border='0' style='border:0;'><tr style='background-color:#e0e0e0'><td align='left' style='border:1; font-size:14px; vertical-align:middle; color:#000;'><b>Showing ".(count($rsFacultyDtlsArr))." of ".(count($rsFacultyDtls))."</b>&nbsp;&nbsp;</td><td align='right'><table align='right' cellpadding='0' cellspacing='1'><tr style='background-color:#e0e0e0'><td style='padding:0 2px;'>$first</td><td style='padding:0 2px;'> $prev </td>$pagebox<td style='padding:0 2px;'>$next </td><td style='padding:0 2px;'>$last</td></tr></table></td></tr></table>";
		 
	}
 
 	?>
	 <table width="268" border="0" class="searchtbl" cellpadding="0" cellspacing="0">
   <?  
	
	if(count($rsFacultyDtlsArr)>0)
	{
	foreach($rsFacultyDtlsArr as $key=>$val){ if($key%2==0) $bgcolor = "#FFFFFF";
	if($val->Email == "") $Email = "<img src='images/mail-not-found.png' border='0' style='width=25px;height:23px; 'title='Email Not Found'/>";
	else $Email="";

									
		$fid = $val->Id;
		//include "schedule-code.php";							
		
		//$rs_MemDtl = Registration::getRegistrationByFacultyId($val->Id);

									
	  ?>
	  <tr bgcolor="<?=$bgcolor?>">
		<td>
        <? if(count($Session)>0){ ?><a target="_blank" href="showFacultyScheduleMail.php?fid=<?=$val->Id?>&type=<?=$_REQUEST['type']?>"><img src="images/comm.jpeg" border="0" style="cursor:pointer; float:right; margin-right:5px;" alt="commitment" title="commitment" /></a><? } ?>
        <? if($rs_MemDtl->id>0){ ?><img src="images/reg.png" border="0" style="float:left" alt="<?=$rs_MemDtl->id?>" title="<?=$rs_MemDtl->id?>" /><? } ?>
        <span style="cursor:pointer;float:left;" class="desc_ sty_<?=$val->Id?>" onclick="showfacDtls('<?=$val->Type?>',<?=$val->Id?>)"><?=$val->Prefix.' . '.$val->Name?></span>
        <? if($_SESSION['admin_type']=="SA") { ?> 
        <span style="float:right;"><?=$Email;?><img src="images/delete_icon.png" border="0" alt="Delete" title="Delete" style="cursor:pointer; float:right; padding:5px;" onclick="if(confirm('Are You sure want to delete the selected Faculty?')) FacultyDelete('<?=$val->Id?>')" />
        </span>
        <? } ?>
         
		</td>
	  </tr> 
	<? } 
	if($table_val!=''){
	?>
	 <tr style="background-color:#e0e0e0">
	   <td style="float:left"><?=$table_val;?></td>
	 </tr>
    <?
	}
	}else{
	?>
    	<tr><td colspan="2"><div style="background-color:#fff;padding:10px 0; width:260px; text-align:center;">No Result Found..</div></td></tr>
    <?
	}
	?>
	</table>
 
