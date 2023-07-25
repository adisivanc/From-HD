<?
function main(){

ini_set('max_execution_time', 500000000000); // For Bulk mail it take more Execution Time
	
$Newsletter_obj = new Newsletter();
$Newsletter_list= $Newsletter_obj->getNewsletterDtl();

if($_POST['act']=='showTestNewsletterEmail'){
	
	ob_clean();
		
		$newsletter_obj= new Newsletter();
		$newsletter_obj->Id=$_POST['id']; // Initially ID Not created for Newsletter.
		$rs_selectnewsletter = $newsletter_obj->getNewsletterDtl();	

	?>
    <input type="hidden" name="test_nid" id="test_nid" value="<?=$_POST['id']?>" />
    <table width="500" border="0" style="background:#FFF;" class="tbldetdesc" cellpadding="2" cellspacing="2">
        <tr class="tbldetdeschd">
        	<td colspan="2">Newsletter Email<div onclick="closeTestNewsletter()" class="popup_closebtn" title="Close">X</div></td>
        </tr>
    
        <tr>
            <td id="test_newsletter_td" style="padding:10px;">
                <table border="0" cellpadding="0" cellspacing="0">
                
                    <tr>
                        <td width="40%" height="40" id="td_from_address"><strong>From Address</strong></td>
                        <td><input name="test_from_address" type="text" class="txtbox" id="test_from_address" size="40" value="<?=FROM_EMAIL?>"  readonly="readonly"/></td>
                    </tr>
                
                    <tr>
                        <td width="40%" height="40" id="td_Subject"><strong>Subject</strong></td>
                        <td><input name="test_Subject" type="text" class="txtbox" id="test_Subject" size="40" value="<?=stripslashes($rs_selectnewsletter->Subject);?>"/></td>
                    </tr>
                
                    <tr>
                        <td width="40%" height="40" id="td_Subject"><strong>To Email</strong></td>
                        <td><input name="to_email" type="text" class="txtbox" id="to_email" size="40" value="<?=TO_EMAIL?>" /></td>
                    </tr>
                
                    <tr>
                        <td colspan="2" height="40" align="center"><input type="checkbox" name="test_addschedule" id="test_addschedule" value="Y" /><strong>Add Schedule</strong></td>
                    </tr>
                
                    <tr>
                        <td  width="40%" height="30" colspan="2" align="center"><span id="butdiv">
                        <div class="submitbtn bggreen" onclick="func_TestValidateForm('<?=$Id?>');">Send Now</div>
                        </span></td>
                    </tr>
                    
                </table>
            </td>
        </tr>   
    </table>
    <?	
	exit();

}

if($_POST['act']=='sendTestNewsletterEmail'){
	
	ob_clean();
	
	//ini_set("display_errors", 1);
	
	$newsletter_obj= new Newsletter();
	$newsletter_obj->Id=$_POST['nid'];
	$rs_selectnewsletter = $newsletter_obj->getNewsletterDtl();	

		$totalCnt = 1;  
		
		$emailAddress = $_POST['to_email'];
				
		$email_type='T';
		$unsubscribe_details="";
		$unsubemailaddress = $emailAddress."||".$email_type;
		$unsubemail = base64_encode($unsubemailaddress);
		$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
		
		ob_clean();
		include "newsletter_mail_content.php";					
		$MailContent=ob_get_contents();
		ob_end_clean();

		$From       = $_POST['test_from_address'];
		$fromName  = "Online Co-ordinator";
		$Subject=$_POST['test_Subject'];
		if($_POST['test_addschedule']=='Y'){
			$attachmentFile = '../pdf/schedule.pdf';
		}
		if(is_file(NEWSLETTER_PATH.$rs_selectnewsletter->File)){
			$attachmentFile = NEWSLETTER_PATH.$rs_selectnewsletter->File;
		}
		//include "sendgrid.php";
		
		echo $emailAddress."...".$totalCnt;
		echo '<br />';
				
	
	exit();
}

if($_POST['act']=='sendNewsletterEmail'){
	
	ob_clean(); ini_set('display_errors', 0);
	
	$newsletter_obj= new Newsletter();
	$newsletter_obj->Id=$_POST['nid'];
	$rs_selectnewsletter = $newsletter_obj->getNewsletterDtl();	

	extract($_POST);
	
	if(count($rs_selectnewsletter)>0){

		$user_type = '';
		$siteEmail=SITE_EMAIL;

		$Subject=$_POST['Subject'];
		  
		$newsletter_group = explode(',',$newsletter_group);
		
		$UpdNL = false;
		if(count($newsletter_group)>0){
		foreach($newsletter_group as $K_UG=>$V_UG){
			$today=time();
			$sqlDateTime=date('Y-m-d H:i:s',$today);
			
			if($V_UG!='')
			{
				$rs_tt = explode(':',$V_UG);
				if($rs_tt[1]=='registration') {
					if($rs_tt[0]!='ALL'){
						$rs_paid = "Paid = '".$rs_tt[0]."'";
					}else{
						$rs_qry = "1=1";
					}
				} elseif($rs_tt[1]=='sponsors') {
					$rs_qry = "1=1";
				} elseif($rs_tt[1]=='faculty') {
					$rs_qry = "Email!=''";
				} else {
					if($rs_tt[0]!='ALL'){
						$rs_qry = "Type='".$rs_tt[0]."' and Id > 130 order by Id ASC";
					}else{
						$rs_qry = "1=1";
					}
				}
				$qry="SELECT * FROM  ".$rs_tt[1]." where ".$rs_qry." ".$rs_paid." ";
				$rs_SelNLMember[]=dB::mExecuteSql($qry);
				$rs_Type[]=$rs_tt[0];
					
			}
			
		}

		if(count($rs_SelNLMember)>0){
			foreach($rs_SelNLMember as $key=>$val){ 
				if(count($val))
				foreach($val as $key1=>$val1){
					if($val1->emailaddress!=''){
						$rs_EmailArr[] = $val1->emailaddress.'~'.$rs_Type[$key];
					}
					if($val1->EmailAddress!=''){
						$rs_EmailArr[] = $val1->EmailAddress.'~'.$rs_Type[$key];
					}
					if($val1->Email!=''){
						$rs_EmailArr[] = $val1->Email.'~'.$rs_Type[$key];
						$rs_NameArr[] = $val1->Name;
					}
				}	
			}
		}
		
		if(count($rs_EmailArr)>0) {
		
		$UpdNL = true;
		ini_set('display_errors', 1);
		
		$sentCnt=0;
		$arrayCnt=0;
		
		$Sentemail_idArr = array();
		$arrayCnt=0;
		$totalCnt = count($rs_EmailArr); 
		
			/*if($rs_selectnewsletter->Url!='')
			{
				$MailContent=$rs_selectnewsletter->Url;
			}
			else
			{*/
				/*ob_clean();
				include "newsletter_mail_content.php";					
				$MailContent=ob_get_contents();
				ob_end_clean();*/
			//}
			
			
			
			foreach($rs_EmailArr as $K_Mem=>$V_Mem){
					$MailContent="";
					$emailid=explode('~',$V_Mem);
					//$emailid[0] = 'karthiinfotech@gmail.com';
					$sentCnt++;
					$email_type = trim($emailid[1]);
				
					if($sentCnt<=500) {
						
						$send=0;
		
						$From       = FROM_EMAIL;
						$fromName   = FROM_NAME;
						$Subject    = $_POST['Subject'];
						$emailAddress = $emailid[0];
						if($_POST['addschedule']=='Y'){
							$attachmentFile = '../pdf/schedule.pdf';
						}
						if(is_file(NEWSLETTER_PATH.$rs_selectnewsletter->File)){
							$attachmentFile = NEWSLETTER_PATH.$rs_selectnewsletter->File;
						}
						
						$unsubscribe_details="";
						$unsubemailaddress = $emailid[0]."||".$email_type;
						$unsubemail = base64_encode($unsubemailaddress);
						$unsubscribe_details = BASE_URL."unsubscribe.php?id=".$unsubemail;
						
						ob_start();
						include "newsletter_mail_content.php";					
						$MailContent=ob_get_contents();
						ob_end_clean();
						
						//$emailAddress = 'kavitharjn@gmail.com';
						//include "sendgrid.php";
						
						echo $emailid[0]."...".$totalCnt;
						echo '<br />';
					
					}else{
						
						$arrayCnt++;
				
						$Sentemail_idArrLater[] = $emailid[0].'-'.$emailid[1];
						$Sentemail_idArr[] = $emailid[0];
						if($arrayCnt>=500 || $sentCnt==$totalCnt) {
							
							$arrayCnt=0;
							$members = implode('~',$Sentemail_idArrLater);
						
							$temp=time();
							$currentdate=date("Y-m-d H:i:s", $temp);
							$newsletter_obj= new Newsletter();
							$newsletter_obj->newsletter_id=$_POST['nid'];
							$newsletter_obj->created_date=$currentdate;
							$newsletter_obj->members= $members;
							$rs_NewsDtl = $newsletter_obj->insertNewsletterLog();
							$Sentemail_idArrLater= array();
						
						}
				
					}
					
				}
				
			}
		
	    }
		
	}	
	
	exit();
}

if($_POST['act']=='showNewsletterEmail'){
	
	ob_clean();
		
		$query = "select * from `newsletter_contacts` group by Type";
		//$rs_Dtl = dB::mExecuteSql($query);
		
		
		$newsletter_obj= new Newsletter();
		$newsletter_obj->Id=$_POST['id'];
		$rs_selectnewsletter = $newsletter_obj->getNewsletterDtl();	
	
	?>
    <input type="hidden" name="nid" id="nid" value="<?=$_POST['id']?>" />
    <table width="500" border="0" style="background:#FFF;" class="tbldetdesc" cellpadding="2" cellspacing="2">
        <tr class="tbldetdeschd">
        	<td colspan="2">Newsletter Email<div onclick="closeNewsletter()" class="popup_closebtn" title="Close">X</div></td>
        </tr>
    
        <tr>
            <td id="newsletter_td" style="padding:10px; line-height:30px;">
                <table border="0" cellpadding="0" cellspacing="0">
                
                    <tr>
                        <td width="40%" height="40" id="td_from_address"><strong>From Address</strong></td>
                        <td><input name="from_address" class="txtbox" type="text" id="from_address" size="40" value="<?=FROM_EMAIL?>"  readonly="readonly"/></td>
                    </tr>
                
                    <tr>
                        <td  width="40%" height="40" id="td_Subject"><strong>Subject</strong></td>
                        <td><input name="Subject" class="txtbox" type="text" id="Subject" size="40" value="<?=stripslashes($rs_selectnewsletter->Subject);?>"/></td>
                    </tr>
                
                    <tr>
                        <td colspan="2" style="padding:10px;"><br />
                        <?
                        if(count($rs_Dtl)>0)
                        foreach($rs_Dtl as $K=>$V){
                        if($V->Type!=''){
                        
                        //$query = "select * from newsletter_contacts where Type='".$V->Type."' ";
                        //$rs_CntDtl = dB::mExecuteSql($query);
                        
                        ?>
                        <input type="checkbox" name="newsletter_group[]" id="newsletter_group" class="newsletter_group" value="<?=trim($V->Type).':'.'newsletter_contacts'?>" checked/><?=$V->TypeName?> (<?=count($rs_CntDtl)?>)<br />
                        <?
                        } }
                        ?>
                        <input type="checkbox" name="newsletter_group[]" id="newsletter_group" class="newsletter_group" value="ALL:faculty" checked/>Faculty<br />
                        </td>
                    </tr>
                
                    <tr>
                        <td colspan="2" align="center"><input type="checkbox" name="addschedule" id="addschedule" value="Y" /><strong>Add Schedule</strong></td>
                    </tr>
                
                    <tr>
                        <td  width="40%" height="30" colspan="2" align="center"><span id="butdiv">
                        <div class="submitbtn bggreen" onclick="func_ValidateForm('<?=$Id?>');">Send Now</div>
                        <!--<input type="button" name="btnSubmit1" value="Send Now"  style="cursor:pointer" onclick="func_ValidateForm()"/>&nbsp;-->
                        </span></td>
                    </tr>
                
                </table>
            </td>
        </tr>   
    </table>
    <?	
	exit();
}


// On Submit New Newsletter 


if($_POST['act']=='Submit'){
	

	if($_FILES['File']['size'] > 0)
	{ 
		$FileArr = $_FILES['File'];	
		$rExt1 = array('pdf','xls','doc','docx','xlsx','ppt','pptx','jpg','jpeg','png','gif');
		$FileObj = new FileUpload();
		$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$FileArr, 'Extension'=>implode(',', $rExt1),'PathPrefix'=>NEWSLETTER_PATH));
		
		if($FileResult['Type']==1)
		{ 
			$Err['Photo']=$FileResult['Error'];
			$ErrFlag = false;
			if($FileResult['ErrorNo']==1 )
			{
				$Err['Photo'] = "Valid file formats are ".implode(',',$rExt);
				$ErrFlag = true;
			}
		}
		elseif($FileResult['Type']==2)
		{
			$UploadFile = true;
		}

	}

	// On Submit New Newsletter save all details in DB
	
	$Newsletter_obj->Name = $_POST['Name'];
	$Newsletter_obj->Subject = $_POST['Subject'];
	$Newsletter_obj->Content=$_POST['Content'] ;
	$Newsletter_obj->Url=$_POST['Url'] ;

	if($_REQUEST['Id']==""){		 
		 $Newsletter_id =$Newsletter_obj->insertNewsletter();
		 $rs_id = $Newsletter_id;
		 $val="Inserted Successfully";
	 }else{
		 $Newsletter_obj->Id = $_REQUEST['Id'];
		 $Newsletter_update= $Newsletter_obj->updateNewsletter();
		 $rs_id = $_REQUEST['Id'];
		 $val="Updated Successfully";
	}
	
	 $Newsletter_list=$Newsletter_obj->getNewsletterDtl();
	
	if($UploadFile)
	{ 
		if($_POST['FileName']==''){ $filename = $rs_id;}else{ $filename=$_POST['FileName']; } 	
		$FileObj->AssignFileName($filename);
		$filepath = $FileObj->Upload();
		
		$Newsletter_obj->field='File';
		$Newsletter_obj->fieldvalue=$filepath;
		$Newsletter_obj->id=$rs_id;
		$Newsletter_obj->UpdateNewsletterByField();
	}
	//exit();	
	header('location:manage_newsletter.php');		
} 



if($_POST['act'] == "show_newsletter")
{ 
	 ob_clean();
	 
		//$rs_Newsletter = Newsletter::getNewsletterbyId($_POST['id']);
		 
		$newsletter_obj= new Newsletter();
		$newsletter_obj->Id=$_POST['id'];
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
     <table width="100%" border="0" style="background:#FFF;" class="tbldetdesc" cellpadding="0" cellspacing="0">
          <tr class="tbldetdeschd">
            <td style="padding:0px; margin:0px;">
            <div style="float:right; position:relative; ">
                
                <a href="manage_newsletter.php?Id=<?=$Id?>"><div class="submitbtn bggreen" onclick="submit_newsletter_frm()" style="padding:0px 20px; margin:5px; float:left;">Edit</div></a>
                <div class="submitbtn bggreen" onclick="delete_manageNewsletter('<?=$Id?>');" style="padding:0px 20px; margin-left:5px; margin:5px; float:left;">Delete</div>
                <div class="submitbtn bggreen" onclick="sendNewsletter('<?=$Id?>')" style="padding:0px 20px; margin-left:5px; margin:5px; float:left;">Email</div>
                <div class="submitbtn bggreen" onclick="sendTestNewsletter('<?=$Id?>')" style="padding:0px 20px; margin-left:5px; margin:5px; float:left;">Test Email</div>
                
            </div>
            </td>
          </tr>
          <? if(is_file(NEWSLETTER_PATH.$File)){ ?>
          <tr>
          	<td align="right">
				<a href="<?=NEWSLETTER_HREF.$File?>" target="_blank">Download File</a>
            </td>
          </tr>
          <? } ?>
          <tr>
            <td>
                <?=stripslashes(trim($Content));?>
            </td>
          </tr>
     </table>
     <?
	 
	 exit();
}

if($_POST['act']=='fn_deletenewsletter') {
	
	ob_clean();
	//print_r($_POST);
	$resourcestypeObj = new Newsletter();
	$resourcestypeObj->Id=$_POST['id'];
	
	$resourcestypeObj->delNewsletter();	
	
	exit();	
}

if($_POST['act']=='show_newsletterlist') {
	
	ob_clean(); 
		$Newsletter_obj = new Newsletter();
		$Newsletter_list= $Newsletter_obj->getNewsletterDtl();
		
		if($_POST['page']=='')
				$page=1;
				else
				$page = $_POST['page'];
				$totalReg = count($Newsletter_list); // calculate total number of newsletter
				$PageLimit= 1; // Set Page Limit (How much newsletter per page
				
				$totalPages= ceil(($totalReg)/($PageLimit)); // Totally 25 newsletter, per page 5 only allowed (page limit), so 25/ 5 is 5 pages.
				if($totalPages==0) $totalPages=1; // if total newsletter is 4, but our limit is 5, then total page becomes 1 only.
				$StartIndex= ($page-1)*$PageLimit; // Its related to Array
				
					if(count($Newsletter_list)>0){
					$Newsletter_list_arr = array_slice($Newsletter_list,$StartIndex,$PageLimit,true); 
					
					$prev=$next=$last=$first='&nbsp;';

					if($page > 1)
					$first = "<img src='images/first_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_pagination(\"1\")'/>";
					
					if($page < $totalPages)
					$last = "<img src='images/last_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_pagination(\"$totalPages\")'/>";
						if(count($Newsletter_list)>0 && $totalPages > 1){
							if($page > 1){
								$pageNo = $page - 1;
								$prev = "<img src='images/prev_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_pagination(\"".$pageNo."\")'/>";
							} 
								
							if ($page < $totalPages){
								$pageNo = $page + 1;
								$next = " <img src='images/next_page.png' style='cursor:pointer; margin-top:3px;' border='0' onclick='func_pagination(\"".$pageNo."\")'/>";
							} 
							
							if($pageNo=='')
								$pageNo=1;
							if($totalPages>1) {
							$pagebox="<td style='border:0;'><input type='text' name='page' id='page' value='".$page."' onchange='func_pagination(this.value)' style='border: 1px solid rgb(170, 170, 170); text-align: center; width: 25px; height: 15px; vertical-align: middle;' size='4'> of $totalPages</td>";
							}	
						
							 $table_val = "<table width='100%' cellpading='2' cellspacing='0' border='0' style='border:0;'><tr style=''><td align='left' style='border:0; vertical-align:middle'><b>Showing ".(count($Newsletter_list_arr))." of ".(count($Newsletter_list))."</b>&nbsp;&nbsp;</td><td align='right' style='border:0;'><table align='right' border='0' cellpadding='5' cellspacing='2' style='border:0;'><tr style=''><td style='border:0;'>&nbsp;&nbsp;$first&nbsp;&nbsp;</td><td style='border:0;'>&nbsp;&nbsp;$prev&nbsp;&nbsp;</td>$pagebox<td style='border:0;'>&nbsp;&nbsp;$next&nbsp;&nbsp; </td><td style='border:0;'>&nbsp;&nbsp;$last&nbsp;&nbsp;</td></tr></table></td></tr></table>";
						}
 ?>
    
		<table width="268" border="0" class="searchtbl" cellpadding="0" cellspacing="0">
			<? if(count($Newsletter_list_arr)>0){foreach($Newsletter_list_arr as $key=>$val){ if($key%2==0) $bgcolor="#FFFFFF"; else $bgcolor="#F5F5F5"; ?>
            <tr bgcolor="<?=$bgcolor?>">					
            <td style="cursor:pointer;" onclick="func_newsletter('<?=$val->Id?>')"><?=$val->Name?></td>
            </tr>
            <? } 
            if($table_val!='') { ?>
             <tr class="semibold">
                <td colspan="2" style="" class="semibold"><?=$table_val?></td>
             </tr>
            <? } } }?> 
		</table>
	
	<? exit();	
}

?>
<style>
.text_highlight{color:#009900;font-weight:bold}
</style>
<input type="hidden" name="page" id="page" />

<table width="100%" border="0" class="tblouter" cellpadding="0" cellspacing="0">
    <tr class="tblhd">
        <td width="18%">Newsletter</td>
        <td width="82%" align="right"><span id="print_value" style="padding-right:300px; font-size:16px; color:#00CC99;"><?=$val;?></span><!-- <div class="tblhdbtn">Add New Hotels</div>	-->    </td>
    </tr>
    <tr>
        <td width="18%" valign="top" align="center">
        
            <table width="268" border="0" class="searchtbl">
                <tr class="searchtblhd">
                </tr>
                <tr>
                    <td>
                        <div class="hotelnamefld" id="newsletter_list"> 
                        
                        </div>            
                    </td>
                </tr>
            </table>   
             
        </td>
        <td width="82%" valign="top"> <span id="addednewsletter"><? include "newsletter_include.php";?> </span>    </td>
    </tr>
</table>

<div id="popup_newsletter" style="display:none; padding:0px; margin:0px;"></div>
<div id="popup_test_newsletter" style="display:none; padding:0px; margin:0px;"></div>
<style type="text/css">
.boxerror{border:1px solid #F00;}
.text_highlight{color:#009900;font-weight:bold}
.semibold td {
	font-size: 14px !important;
	padding: 2px !important;
}
.semibold {
	padding: 0 !important;
}
</style>
<script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">

function submit_newsletter_frm(){
	var err = 0;
	
	if($('#Name').val()==''){ err=1; $('#Name').addClass('boxerror'); } else{ $('#Name').removeClass('boxerror'); }
    if($('#Subject').val()==''){ err=1; $('#Subject').addClass('boxerror'); } else{ $('#Subject').removeClass('boxerror');}
	
	if(err==0){	
		document.newsletter_frm.submit();
	}	
}

function func_newsletter(id) {
		
		ajax({
			a:'manage_newsletter',
			b:'act=show_newsletter&id='+id,
			c:function(){},
			d:function(data){
				
				$('#addednewsletter').html(data);
				
			}
		});
}

function delete_manageNewsletter(id){
	
	if(confirm('Are you sure want to delete this Newsletter!')){
	ajax({
			a:'manage_newsletter',							
			b:'act=fn_deletenewsletter&id='+id,
			c:function(){},
			d:function(data)
			{
				window.location='manage_newsletter.php';
			}
		});
	}
	
}

func_newsletterlist();
function func_newsletterlist() {
		
		ajax({
			a:'manage_newsletter',
			b:'act=show_newsletterlist',
			c:function(){},
			d:function(data){
				
				$('#newsletter_list').html(data);
				
			}
		});
}

function func_pagination(page) {
	
	ajax({
		a:'manage_newsletter',
		b:'act=show_newsletterlist&page='+page,
		c:function(){},
		d:function(data){
			//alert(page);
			
			$('#newsletter_list').html(data);
			
		}
	});

}
 
function sendNewsletter(id){
	
	ajax({
		a:'manage_newsletter',							
		b:'act=showNewsletterEmail&id='+id,
		c:function(){},
		d:function(data)
		{
			$("#popup_newsletter").show();
			$("#popup_newsletter").html(data);
			$("#popup_newsletter").dialog({
				autoOpen: true,
				resizable: false,
				height: 400,
				width: 'auto',
				modal: true	,
				draggable: true
			});
								
			$(".ui-widget-header").css({"display":"none"});
	
		}
	});
	
	
}

function closeNewsletter(){
	
	$("#popup_newsletter").dialog('close');
}


function sendTestNewsletter(id){
	
	ajax({
		a:'manage_newsletter',							
		b:'act=showTestNewsletterEmail&id='+id,
		c:function(){},
		d:function(data)
		{
			$("#popup_test_newsletter").show();
			$("#popup_test_newsletter").html(data);
			$("#popup_test_newsletter").dialog({
				autoOpen: true,
				resizable: false,
				height: 'auto',
				width: 'auto',
				modal: true	,
				draggable: true
			});
								
			$(".ui-widget-header").css({"display":"none"});
	
		}
	});
	
}


function closeTestNewsletter(){
	
	$("#popup_test_newsletter").dialog('close');
}


function func_ValidateForm()
{
	
   err=0;
	
	if($('#from_address').val()==''){ err=1; $('#from_address').addClass('boxerror'); } else{ $('#from_address').removeClass('boxerror'); }
	
	if($('#from_address').val()!='')
		{
		 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
			if(reg.test($('#from_address').val()) == false) 
			{
				err=1;
				$('#from_address').addClass('boxerror');
			}
			else{
				$('#from_address').removeClass('boxerror');
			}
		}
	
	if($('#Subject').val()==''){ err=1; $('#Subject').addClass('boxerror'); } else{ $('#Subject').removeClass('boxerror'); }
	
	var from_address = $('#from_address').val();
	var Subject = $('#Subject').val();
	var newsletter_group = $('input[name=newsletter_group[]]:checked').map(function(){
																		   return this.value;
																		   }).get();
	
	if(newsletter_group==''){ err=1; alert('Please choose contacts'); }
	
	var addschedule = $('input[name=addschedule]:checked').val();
	var nid = $('#nid').val();
	
   if(err==0) {
	    
		$('#newsletter_td').html('<span style="font-size:24px; padding:20px; color:#BD220A">sending please wait...</span>');
   		ajax({
			a:'manage_newsletter',							
			b:'act=sendNewsletterEmail&nid='+nid+'&from_address='+from_address+'&Subject='+Subject+'&newsletter_group='+newsletter_group+'&addschedule='+addschedule,
			c:function(){},
			d:function(data){	//alert(data);
				$('#newsletter_td').html(data);
			}
		});
			
		
   }
}


function func_TestValidateForm()
{
	
   err=0;
	
	if($('#test_from_address').val()==''){ err=1; $('#test_from_address').addClass('boxerror'); } else{ $('#test_from_address').removeClass('boxerror'); }
	if($('#test_from_address').val()!='')
	{
	 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#test_from_address').val()) == false) 
		{
			err=1;
			$('#test_from_address').addClass('boxerror');
		}
		else{
			$('#test_from_address').removeClass('boxerror');
		}
	}
	
	if($('#to_email').val()==''){ err=1; $('#to_email').addClass('boxerror'); } else{ $('#to_email').removeClass('boxerror'); }
	if($('#to_email').val()!='')
	{
	 var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#to_email').val()) == false) 
		{
			err=1;
			$('#to_email').addClass('boxerror');
		}
		else{
			$('#to_email').removeClass('boxerror');
		}
	}
	
	if($('#test_Subject').val()==''){ err=1; $('#test_Subject').addClass('boxerror'); } else{ $('#test_Subject').removeClass('boxerror'); }
	
	var test_from_address = $('#test_from_address').val();
	var test_Subject = $('#test_Subject').val();
	var to_email = $('#to_email').val();
	var test_addschedule = $('input[name=test_addschedule]:checked').val();
	var test_nid = $('#test_nid').val();
	
   if(err==0){
	    
		$('#test_newsletter_td').html('<span style="font-size:24px; padding:20px; color:#BD220A">sending please wait...</span>');
   		ajax({
			a:'manage_newsletter',							
			b:'act=sendTestNewsletterEmail&nid='+test_nid+'&test_from_address='+test_from_address+'&test_Subject='+test_Subject+'&to_email='+to_email+'&test_addschedule='+test_addschedule,
			c:function(){},
			d:function(data) {
				//alert(data);
				$('#test_newsletter_td').html(data);
			}
		});
			
		
   }
}


</script>

<?
}
include "admin_template.php";
?>