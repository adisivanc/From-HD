<? 
	$newsletter_obj= new Newsletter();
	$newsletter_obj->Id=$_REQUEST['Id'];
	$rs_selNewsletter = $newsletter_obj->getNewsletterDtl();
	if(count($rs_selNewsletter)>0) {
	foreach($rs_selNewsletter as $K=>$V) $$K = $V;			
	}
	
	$key = "rEgIsTrAtIoN";
	$rs_Link = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $ID, MCRYPT_MODE_CBC, md5(md5($key))));
	
	$Content = str_replace('{ISSUE_DATE}',date('M d, Y'),$Content);
	$Content = str_replace('{NEWS_IMAGES}',NEWS_IMAGES,$Content);
	$Content = str_replace('&lt;NEWS_IMAGES&gt;',NEWS_IMAGES,$Content);
	$Content = str_replace('{BASE_URL}',BASE_URL,$Content);
	$Content = str_replace('{ENCID}',$rs_Link,$Content);
	$Content = str_replace('{ID}',$ID,$Content);
	$Content = str_replace('{NAME}',$NAME,$Content);
	$Content = str_replace('{EMAIL}',$EMAIL,$Content);
	if($ADDRESS!='')
	$Content = str_replace('{ADDRESS}',$ADDRESS,$Content);
	if($MOBILE!='')
	$Content = str_replace('{MOBILE}',$MOBILE,$Content);
	$Content = str_replace('{URL}',$url,$Content);
	$Content = str_replace('{URL1}',$url1,$Content);
	$Content = str_replace('{URL2}',$url2,$Content);
	
	$Content = str_replace('&lt;URL&gt;',$url,$Content);
	$Content = str_replace('&lt;URL1&gt;',$url1,$Content);
	$Content = str_replace('&lt;URL2&gt;',$url2,$Content);
	
	$Content = str_replace('{N}',$nz,$Content);
	$Content = str_replace('{NC}',$ncz,$Content);
	$Content = str_replace('{NE}',$nez,$Content);
	$Content = str_replace('{W}',$wz,$Content);
	$Content = str_replace('{SZ}',$sz,$Content);
	
	$Content = str_replace('{USERNAME}',$username,$Content);
	$Content = str_replace('{PASSWORD}',$password,$Content);
	
	$Content = str_replace('{QID}',$QID,$Content);
		
 ?>
 <style type="text/css"> 
.cke_contents {
	height: 700px !important;
}

.boxerror { border:1px solid #F00; }
.texterror { color:#F00; }
</style>
<form id="newsletter_frm" name="newsletter_frm" method="post" enctype="multipart/form-data">
<input type="hidden" name="act" id="act" value="Submit" />

<input type="hidden" name="Id" id="Id" value="<?=$_REQUEST['Id'];?>" />

<table width="100%" border="0" style="background:#FFF;" class="tbldetdesc" cellpadding="0" cellspacing="0">
  <tr class="tbldetdeschd">
    <td><? if($_REQUEST['Id'] ==""){?>Add <? }else {?>Update <? }?>Newsletter</td>
  </tr>
  <tr>
    <td>
        <table width="742" border="0" cellpadding="0" cellspacing="0" class="newslettertbl_td">
          <tr>
            <td style="padding-bottom:5px;" valign="top">Newsletter Name</td>
            <td style="padding-top:0;"><input type="text" class="txtbox2" style="width:330px;" id="Name" name="Name" value="<?=$Name?>"/></td>
          </tr>
          <tr>
            <td style="padding-bottom:5px;" align="left" valign="top">Subject</td>
            <td style="padding-top:0;"><input type="text" class="txtbox2" style="width:330px;" id="Subject" name="Subject" value="<?=$Subject?>"/></td>
          </tr>
          <tr>
            <td style="padding-bottom:5px;" align="left" valign="top" >Content </td>
            <td style="padding-top:0;"><textarea class="ckeditor"  name="Content" id="Content"><?=stripslashes($Content)?></textarea></td>
          </tr>
          
          <tr>
            <td style="padding-bottom:5px;" align="left" valign="top">File</td>
            <td><input type="text" class="txtbox2" style="width:130px;" id="FileName" name="FileName" /><input type="file" class="txtbox2" id="File" name="File" />
            <?
				if(is_file(NEWSLETTER_PATH.$File)){
			?>
            <a href="<?=NEWSLETTER_HREF.$File?>" target="_blank">Download File</a>
            <?		
				}
			?>
            </td>
          </tr>
          
          <tr>
            <td style="padding-bottom:5px;" align="left" valign="top">Url</td>
            <td><input type="text" class="txtbox2" style="width:330px;" id="Url" name="Url" value="<?=$Url?>"/></td>
          </tr>
         
          <tr>
            <td>&nbsp;</td>
            <td align="right"><? if($_REQUEST['Id']==""){ $image_val="Submit";} else { $image_val="Update";}?>
            	<div class="submitbtn bgred" onclick="submit_newsletter_frm()"><?=$image_val?></div>
            </td>
          </tr>
      </table>
    
    </td>
  </tr>
</table>
</form>