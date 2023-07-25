<?
include "includes.php";
if($_POST['act']=="select_members")
{
ob_clean();
$gradeId=$_POST['gradeId'];
$memberArr=explode(',',$_POST['member']);
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="compose_tbl2">
 <?
 	if(in_array('T',$memberArr)){		
            $rs_getGradeTeacher=Teacher::getTeachersByGrade($gradeId);
            $index=0;
            if(count($rs_getGradeTeacher)>0)
            {
                foreach($rs_getGradeTeacher as $GK=>$GV)
                {
                    $teacherSubject="";
                    if($GV->is_class_teacher=="Y")
                    {$teacherSubject="Class Teacher";}
                    else
                    {
                    $rs_subject=Subject::getSubjectById($GV->subject_id);
                    $teacherSubject=$rs_subject->subject_name." Teacher";		
                    }
                    $rs_teacher=Teacher::getTeachersById($GV->teacher_id);
                    if(count($rs_teacher)>0){												
                  ?>
                
                  <tr>
                    <td width="24" valign="top"><input type="checkbox" value="T-<?=$rs_teacher->id?>" name="members[]" id="teacherid_<?=$index?>" class="dash_checkbox"/> <input type="hidden" name="emailIds[]" id="emailids<?=$index?>" value="<?=$rs_teacher->email_address?>" /></td>
                    
                    <td valign="top"><?=$rs_teacher->first_name;?></td>
                    <td valign="top"><?=$teacherSubject?></td>
                    <td valign="top"><?=$rs_teacher->email_address?></td>
                    <td valign="top"><img src="<?=TEACHERS_FILE_HREF.$rs_teacher->photo?>" style="width:100px; height:70px;"/></td>
                  </tr>
                       <?
          $index++;
                   }
                }
            }
	}
	if(in_array('SA',$memberArr)){
		$user_obj=new User();
						$user_obj->user_type="SA";
						$user_obj->parent_portal="Y";
						$rs_user=$user_obj->getAllUserDtls();
						if(count($rs_user)>0)
						foreach($rs_user as $UK=>$UV)
						{
						?>
                        <tr>
                        <td width="35"><input type="checkbox" id="select_memeber" name="members[]" value="SA-<?=$UV->id?>" class="dash_checkbox"/></td>
                        <td><?=$UV->name?></td>
                        <td>Admin</td>
                        <td><?=$UV->email_address?></td>
                        <td></td>
                        
                      </tr>
                        <?
						}
		
		
		
			}
	if(in_array('FO',$memberArr)){
		$user_obj=new User();
						$user_obj->user_type="FO";
						$user_obj->parent_portal="Y";
						$rs_user=$user_obj->getAllUserDtls();
						if(count($rs_user)>0)
						foreach($rs_user as $UK=>$UV)
						{
						?>
                        <tr>
                        <td width="35"><input type="checkbox" id="select_memeber" name="members[]" value="FO-<?=$UV->id?>" class="dash_checkbox"/></td>
                        <td><?=$UV->name?></td>
                        <td>Front Office</td>
                        <td><?=$UV->email_address?></td>
                        <td></td>
                        
                      </tr>
                        <?
						}
		
		
		
			}
	
          ?>
          </table>
<?	

exit();
}
if($_POST['act']=="getDelete")
{
	ob_clean();
	print_r($_POST);
	$ids=explode(',',$_POST['ids']);
	if($ids!=="")
		foreach($ids as $K=>$V)		
		{
		$rs_communication_cheack=Communication::getCommunication($param=array("id"=>$V),'','');
		print_r($rs_communication_cheack->id);
		foreach($rs_communication_cheack as $CMK=>$CMV)
		{
			if($CMV->delete_by!="N")
			{$postArrs=array('id'=>$V,'delete_by'=>"B");
				}
			else{$postArrs=array('id'=>$V,'delete_by'=>$_POST['delete_by']);}
		}
		$rs_communication_delete=Communication::updateCommunication($postArrs);
		}
	exit();
}
if($_POST['act']=="getConvertation")
{
	ob_clean();
	$type=$_POST['type'];
	$studentId=$_POST['student_id'];
	if($type=="S")
	{
		$received="To";
		$resultArr=array("sender_id"=>$studentId."-INT","delete_by"=>"'N','R'-IN","status"=>"'N','R'-IN");
		$rs_communication=Communication::getCommunication($resultArr,'id','DESC');
	}
	
	if($type=="I")
	{
		$received="From";
		
		//$resultArr=array("delete_by"=>"'N' OR delete_by='S'","receiver_id"=>$studentId."-STRING","receiver_type"=>"P");
		$resultArr=array("receiver_id"=>$studentId."-INT","delete_by"=>"'N','S'-IN","status"=>"'N','R'-IN","receiver_type"=>"'P','".$_SESSION['user_type']."'-IN");
		$rs_communication=Communication::getCommunication($resultArr,'id','DESC');
	}
	if($_POST['page']=='')
		$page=1;
	else
		$page = $_POST['page'];
		$totalReg = count($rs_communication);
	if($_POST['page_limit']=="" || $_POST['page_limit']=="undefined") $PageLimit = 5; else $PageLimit = $_POST['page_limit'];
	$adjacents = 1;
	$totalPages= ceil(($totalReg)/($PageLimit));
	if($totalPages==0) $totalPages=1;
	$StartIndex= ($page-1)*$PageLimit; 								
	if(count($rs_communication)>0) $rs_communicationArr = array_slice($rs_communication,$StartIndex,$PageLimit,true);
	if(count($rs_communication)>0 && $totalPages > 1){ 
		$rsPagination = generatePagination("studentLeaveList", $totalReg, count($rs_communicationArr), $PageLimit, $adjacents, $page); 
	}
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="inboxtbl">
      <tr style="background:#ecdbc8;">
        <th></th>
        <th width="22%">Subject</th>
        <th>Message</th>
        <th width="150"><?=$received?></th>
        <th width="95">Date</th>
      </tr>
          <input type="hidden" name="type" id="type" value="<?=$type?>" />
          <input type="hidden" name="student_id" id="student_id" value="<?=$studentId?>" />
          <input type="hidden" name="page_limit" id="student_list_page_limit" value="<?=$PageLimit?>" />
		  <?
          if(count($rs_communicationArr)>0)
          foreach($rs_communicationArr as $CK=>$CV)
		  {
			  ?>
		  <tr>
			<td width="35" align="center" id="cheack_contant"><input class="dash_checkbox" type="checkbox" onchange="cheackbox_validate()" id="communication_id" name="communication_id[]" value="<?=$CV->id?>" /></td>
			<td onclick="getMessagePopup('<?=$CV->id?>','<?=$type?>')"><? echo substr($CV->subject,0,10)."...";?></td>
			<td onclick="getMessagePopup('<?=$CV->id?>','<?=$type?>')"><? echo substr($CV->message,0,20)."...";?></td>
			<td onclick="getMessagePopup('<?=$CV->id?>','<?=$type?>')"><?
				if($received!="From")
				{
					 $Ids=explode(',',$CV->receiver_id);
					 $rec_type=$CV->receiver_type;
				}
				else
				{
					 $Ids=explode(',',$CV->sender_id);
					 $rec_type=$CV->sender_type;	
				}												
					$i=0;
				foreach($Ids as $tid)
				{
						if($rec_type=='T')
						{
							if($i>0)
							echo ",";
							$rs_teahers=Teacher::getTeachersById($tid);
							echo $rs_teahers->prefix." ".$rs_teahers->first_name." ".$rs_teahers->middle_name." ".$rs_teahers->last_name;
						}
						if($rec_type=='SA')
						{
							if($i>0)
							echo ",";
							$rs_users= User::getUserById($tid);;
							echo $rs_users->name." ";
						}
						if($rec_type=='FO')
						{
							if($i>0)
							echo ",";
							$rs_users= User::getUserById($tid);;
							echo $rs_users->name." ";
						}
				$i++;
				}
			
			?></td>
			<?
			$timestamp = strtotime($CV->added_date);
			$formattedDate = date('F d', $timestamp);
			?>
			<td style="font-size:15px;" onclick="getMessagePopup('<?=$CV->id?>','<?=$type?>')"><? echo $formattedDate; echo "<br>".date('H:i A',$timestamp);?></td>
		  </tr>
					  
		  <?
		}
      ?>
      <tr>
        <td colspan="5" style="padding:10px;"><?=$rsPagination?></td>
      </tr>
    </table>
	<?
	exit();	
}
if($_POST['act']=="sendEmail")
{
ob_clean();
$membersArr =explode(',',$_POST['members']);
$msg="";
$execute=0;
if($_FILES['attach_file']['name']!="")
{
			if($_FILES['attach_file']['size'] > 0 && $_FILES['attach_file']['size']<=2000000)
			{
				$communication_fileArr = $_FILES['attach_file']; 
				$rExt = array('jpg','jpeg','png','gif','pdf');
				$communicationObj = new FileUpload();
				$FileResult = $communicationObj->AssignAndCheck(array('FileRef'=>$communication_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>COMMUNICATION_PATH));
				if($FileResult['Type']==1)
				{
					$Err[]=$FileResult['Error'];					
					$execute=1;
					$ErrFlag = false;
				if($FileResult['ErrorNo']==1 )
				{
					$Err[] = "Valid file formats are ".implode(',',$rExt);
					$execute=1;
					$ErrFlag = true;
				}
			}
			elseif($FileResult['Type']==2)
				{
					$communicationUploadup_file = true;
				}
			
			else{
					$msg="File Size is To large";
					$execute=0;
				}
			if($communicationUploadup_file)
			{
					$communicationObj->AssignFileName(rand());
					$communicationFilepath = $communicationObj->Upload();
			}
			else{$execute=1; $msg='Your File Format Is Not Supportted and the Valid Formats are :'.implode(',',$rExt);}		
			
		}
		else{
				$msg="Please Select a file within 2MB";
				$execute=1;
			}
}
	if($execute==0)
	{
		if(count($membersArr)>0)
			{
							
					$postArrs = array('subject','message','sender_id','sender_type','receiver_type','receiver_id','status','delete_by','attach_file');
					$stringArr = array('subject','meaage');
					$i=0;
					foreach($membersArr as $TK=>$TV)
					{
					$members=explode('-',$TV);							
					foreach($postArrs as $K=>$V) {
						$$V=$_POST[$V];
						if($V=="receiver_id"){$$V=$members[1];}
						if($V=="receiver_type"){$$V=$members[0];}
						if($V=="attach_file"){$$V=$communicationFilepath;}
						if($V=="sender_type"){$$V=$_SESSION['user_type'];}
						if($V=="status"){$$V="N";}
						if($V=="deleted_by"){$$V="N";}
						if(in_array($V,$stringArr)) $$V = addslashes($$V);
						if($$V!='') $argV[$V]=$$V;	 
					}						
					$communication=Communication::insertCommunication($argV);
					$msg="Message Sent Successfully";	
					}
				
			}
			else{$msg="Member is Not Defined";}
	}
	
	else{}
 echo $msg;
exit();
}
if($_POST['act']=="getSendEmail")
{
	ob_clean();
	$members=array();
	$members=$_POST['members'];
	
?>    
	<div class="compose_mail_home" id="showon_compose">
		<h3 class="inbox_title">Send Email</h3>
		<div class="teacher_list_header">
			<div style="float:right;">* Mandatory Fields</div>
		</div>
		
		<div class="teacher_list_content">
			<form name="myFrm" id="myFrm">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="composetbl">
			  <tr>
				<th>Message Details</th>
			  </tr>
			  <tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="replytbl">
					  <tr>
						<td valign="top" width="120">* Subject :</td>
						<td valign="top">
                        <input type="hidden" name="members" id="members" value="<?=implode(',',$members)?>" />
						<input type="hidden" name="act" id="act" value="sendEmail" />
                        <input type="hidden" name="gradeId" id="gradeId" value="<?=$_POST['gradeId'];?>" />
                        <input type="hidden" name="sender_id" id="sender_id" value="<?=$_POST['student_id']?>" />
						<input type="text" class="txtbox_full" style="width:50%;" id="subject" name="subject" value="" />
						<input type="hidden" name="type" id="type" value="S"   />
						<input type="hidden" name="status" id="status" value="S"   />
						</td>
					  </tr>
					  <tr>
						<td valign="top" style="text-indent:62px;"> To :</td>
						<td valign="top"> Teachers:
						<?
						$execute=0;
						if(count($members)>0)
						
						foreach($members as $TK=>$TV)
						{
							$memberArr=explode('-',$TV);
							if($memberArr[0]=='T')
							{
							if($execute>0)
							echo ",";
							$rs_teacher_send=Teacher::getTeachersById($memberArr[1]);
							if(count($rs_teacher_send)>0){
							echo $rs_teacher_send->prefix." ".$rs_teacher_send->first_name." ".$rs_teacher_send->middle_name." ".$rs_teacher_send->last_name;
							}
							$execute++;
							}
							if($memberArr[0]=='SA')
							{
								if($execute>0) echo ",";
								$rs_user=User::getUserById($memberArr[1]);
								if(count($rs_user)>0)
								{
									echo $rs_user->name;
								}
							}
							if($memberArr[0]=='FO')
							{
								if($execute>0) echo ",";
								$rs_user=User::getUserById($memberArr[1]);
								if(count($rs_user)>0)
								{
									echo $rs_user->name;
								}
							}
							?>
							
							<?
						
						}
						?>                                              
						 </td>
					  </tr>
					  <tr>
						<td valign="top">* Message :</td>
						<td valign="top">
							<textarea class="txtarea_full" id="message" name="message" value=""></textarea>
						</td>
					  </tr>
					  <tr>
						<td valign="top"> Attach File</td>
						<td valign="top">
						   <input type="file" name="attach_file" id="attach_file" />
					   
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>
												
							<div class="reply_mail" style="float:left;" onclick="validate_mail('S')">Send</div>
						   <!-- <div class="reply_mail" style="float:left;" onclick="validate_mail('D')">Draft</div>-->
						</td>
					  </tr>
					</table>
				</td>
			  </tr>
			</table>
		</form>
		</div>
	</div>
  <?
exit();
}
 ?>

<div class="mail_home" id="hide_inbox">
    <h3 class="inbox_title">Inbox</h3>
   

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" style="background:#dab791;">
            <div class="message_center_head">Message Center &nbsp; &nbsp; &nbsp; &nbsp;
            Select <span onclick="cheackAllMessage()" class="check_all" style="cursor:pointer;">All</span>, <span onclick="uncheackAllMessage()" style="cursor:pointer;">None</span> 
            <span class="delete_mail" style="display:none;" onclick="getDelete('<?=$studentId?>')">Delete</span><span id="error_select_chk" style="color:#F00; font-size:14px; letter-spacing:-0.9px;"></span></div>
        </td>
      </tr>
      <tr>
        <td width="150" valign="top">
            <ul class="mail_menu">
                <li class="mail_item" id="show_compose">Compose</li>
                <li class="mail_item active" onclick="getMessageContainer('I','<?=$studentId?>')">Inbox</li>
                <!--<li class="mail_item" onclick="getMessageContainer('D','<?=$studentId?>')">Draft</li>--->
                <li class="mail_item" onclick="getMessageContainer('S','<?=$studentId?>')">Sent</li>
            </ul>
        </td>
        
        <td valign="top" id="mail_content">
            
        </td>
      </tr>
    </table>

</div>

<div class="compose_mail_home" id="hideon_compose">
    <h3 class="inbox_title">Compose</h3>
    
    <div class="teacher_list_header">
        <div class="teacher_list_title">Address Book</div>
        <div class="send_mailbtn" id="show_compose_mail">Send email</div>
    </div>
     
    <div class="teacher_list_content" id="dynamic_addressbook">
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="akka_listtbl">
          <tr>
          	<td colspan="5">
            <input type="checkbox" name="select_member[]" id="" value="SA" onchange="loadMailId('<?=$gradeId?>')" checked="checked"/>Admin
            <input type="checkbox" name="select_member[]" id="" value="FO" onchange="loadMailId('<?=$gradeId?>')" checked="checked"/>Front Office
            <input type="checkbox" name="select_member[]" id="" value="T" onchange="loadMailId('<?=$gradeId?>')" checked="checked">Teachers
            </td>
          
          </tr>
          <tr>
            <th width="35">
            <input type="hidden" value="<?=$studentId?>" name="student_id" id="student_id"/>
            <input type="hidden" value="<?=$gradeId?>" name="gradeId" id="gradeId"/>
            <input type="checkbox" value="" name="" id="" class="dash_checkbox check_all"/></th>
            <th>Name</th>
            <th>Designation</th>
            <th>Email Address</th>
            <th>Image</th>
          </tr>
         <tr>
         	<td colspan="5" id="dynamicMember">
            
            </td>
         
         </tr>
        

        </table>
    </div>
</div>

                            <!-- Teachers List -->
<?
	if($_POST['act']=="showMessage")
	{
		ob_clean();
		$id=$_POST['id'];		
		$rs_communication_message=Communication::getCommunicationById($id);
		$rs_communication_message->subject;
?>
         <div class="inboxpopup_inner">   		    	
        <div class="inbox_header">
        	<div style="float:left;"><?=$rs_communication_message->subject?></div>
            <div style="float:right;" ><?
            							$timestamp = strtotime($rs_communication_message->added_date);
										$formattedDate = date('F d H:i A', $timestamp);
										echo $formattedDate
									  ?>
			 <span class="cursor" onClick="close_inbox_popup()">X</span> </div>
        </div>
        
   		<div class="inbox_content">
            <?=$rs_communication_message->message?>      
        </div>
        <?
        	if($rs_communication_message->attach_file!="")
			{
			?>
           <a href="<?=COMMUNICATION_HREF.$rs_communication_message->attach_file?>" > <div class="reply_mail" style="float:left;">Download</div></a>
            <?	
			}
		?>
        </div>

<?
		exit();	
	}

	if($_POST['act']=="showInboxMessage")
	{
		ob_clean();
		$id=$_POST['id'];
		$param=array("id"=>$id."-INT");
		$rs_communication_message=Communication::getCommunicationById($id);
		$rs_communication_message->subject;
		$param=array('status'=>'R','id'=>$id);
		$rs_communication_update=Communication::updateCommunication($param);
?>
          <div class="inboxpopup_inner">   		    	
                <div class="inbox_header">
                    <div style="float:left;"><?=$rs_communication_message->subject?></div>
                    <div style="float:right;" ><?
                                                $timestamp = strtotime($CV->added_date);
                                                    echo $formattedDate = date('F d H:i A', $timestamp);
                                              ?>
                     <span class="cursor" onClick="close_inbox_popup()">X</span> </div>
                </div>
        
                <div class="inbox_content">
                    <?=$rs_communication_message->message?>      
                </div>
        		 <?
					if($rs_communication_message->attach_file!="")
					{
					?>
				   <a href="<?=COMMUNICATION_HREF.$rs_communication_message->attach_file?>" > <div class="reply_mail" style="float:left;">Download</div></a>
					<?	
					}
				?>
                <div class="full_width">
                    <div class="reply_mail hide_btn" onclick="show_reply()">Reply</div>
                </div>
        
                <div class="inbox_footer">
                <form id="myFrm" name="myFrm">
                <input type="hidden" name="act" id="act" value="sendEmail" />
                <input type="hidden" name="members" id="members" value="<?=$rs_communication_message->sender_type?>-<?=$rs_communication_message->sender_id?>" />
				<input type="hidden" name="student_id" id="student_id" value="<?=$rs_communication_message->receiver_id?>" />
				<input type="hidden" name="sender_id" id="sender_id" value="<?=$rs_communication_message->receiver_id?>" />
                <input type="hidden" name="receiver_id[]" id="receiver_id" value="<?=$rs_communication_message->sender_id?>" />
				<input type="hidden" name="type" id="type" value="S"   />
				<input type="hidden" name="status" id="status" value="S"   />
                     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="replytbl">
                      <tr>
                        <td valign="top" width="120">* Subject :</td>
                        <td valign="top"><input type="text" class="txtbox_full" id="subject" name="subject" value="" /></td>
                      </tr>
                      <tr>
                        <td valign="top">* Message :</td>
                        <td valign="top">
                            <textarea class="txtarea_full" id="message" name="message" value=""></textarea>
                        </td>
                      </tr>
                      <tr>
						<td valign="top"> Attach File</td>
						<td valign="top">
                        	
						   <input type="file" name="attach_file" id="attach_file" />					   
						</td>
					  </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>
                        	
                            <div class="reply_mail" style="float:left;" onclick="validate_mail('S');close_inbox_popup();">Reply</div>
                        </td>
                      </tr>
                    </table>
                    </form>
                </div>
        </div>

<?
		exit();	
	}
?>           

                            <!-- Teachers List -->


<!--- Popup --->
                    


<script type="text/javascript">
function studentLeaveListPaging(page) {
	var action_page = $('#student_action_page').val();
	var page_limit = $('#page_limit').val(); 
	var status=$('#status').val();
	
	var type=$('#type').val();
	var student_id=$('#student_id').val();
	
	$("#studentslistdtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
	ajax({
		a:'communications',
		b:'act=getConvertation&page='+page+'&actionPage='+action_page+'&page_limit='+page_limit+'&status='+status+'&type='+type+'&student_id='+student_id,
		c:function(){},
		d:function(data){
			$("#mail_content").html(data);
		}
	});
}
function getDelete(student_id)
	{
			
			 var ids=$('input[name="communication_id[]"]:checked').map(function() {return this.value;}).get().join(',');
			var type=$('#type').val();
			var delete_by="";
			if(type=="I"){
				delete_by="R";
				}
			else
			{
				delete_by="S";	
			}  
			if(ids==""){$('#error_select_chk').text("Please Select ");}
		
		if(ids!="")
		{
			$('#error_select_chk').text();
				ajax({
				a:'communications',
				b:'act=getDelete&ids='+ids+'&delete_by='+delete_by,
				c:function(){},
				d:function(data){
					$("#mail_content").html(data);
					getCommunication(student_id);
					}
			});
		}
	}
function validate_popup_mail() {

	if(	$('#mail_subject').val()=='' ){ err=1; $('#mail_subject').addClass('boxerror'); } else { $('#mail_subject').removeClass('boxerror'); }
	if(	$('#mail_content').val()=='' ){ err=1; $('#mail_content').addClass('boxerror'); } else { $('#mail_content').removeClass('boxerror'); }
	
}

function validate_mail(type) {
	var subject;
	var message;
	var err=0;
	if(	$('#subject').val()=='' ){ err=1; $('#subject').addClass('boxerror'); } else {subject=$('#ubject').val(); $('#subject').removeClass('boxerror'); }
	if(	$('#message').val()=='' ){ err=1; $('#message').addClass('boxerror'); } else {message=$('#message').val(); $('#message').removeClass('boxerror'); }

 	var teacher_id=$('input[name="teacher_id[]"]').map(function() {
    return this.value;
}).get();
	var student_id=$('#sender_id').val();
	var gradeId=$('#gradeId').val();
	var paramData={"act":"sendEmail",
						"subject":subject,"message":message,"type":type,"receiver_id":teacher_id,"sender_id":student_id,"status":type,
			};
			
			if(err==0)
			{
			/*ajax({
				a:'communications',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					
					$("#showon_compose").show();
					alert("Successfully Sended");					
					getCommunication(student_id);
								
				}
			});	*/
			$.ajax({
			url: 'communications.php',
			type: 'POST',
			data: new FormData(myFrm),
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				//$("#showon_compose").show();
					
					var result=$.trim(data);
					$("#retrun_data").val(data);
					if(result=="Message Sent Successfully")
					{
					alert(data);
					getCommunication(student_id);
					}
					else
					{
						alert(result);
					}
			}
			});
		}
}

function cheackbox_validate()
{
		if($('.dash_checkbox').is(':checked'))
		{
			$('.delete_mail').show();
			$('.checknone').prop('checked',false);
		}
		else
		{
			$('.delete_mail').hide();
			$('.checkall').prop('checked',false);
		}
}

function cheackAllMessage()
{
	$('.dash_checkbox').prop('checked',true);	
	var z = $("#communication_id:checked").length;
	if(z!=0){$('.delete_mail').show();}
	else{$('.delete_mail').hide();	}
}

function uncheackAllMessage()
{
	
	$('.dash_checkbox').prop('checked',false);
	$('.delete_mail').hide();
}

$('.check_all').click(function(){
	if($('.check_all').is(':checked'))
	$('.dash_checkbox').prop('checked',true);
	else
	$('.dash_checkbox').prop('checked',false);
});
	
	
$("#show_compose_mail").click(function(){
	
	var checkedNum = $('input[name="members[]"]:checked').length;
	
		if (!checkedNum) 
		{
			alert("Select Any Option");
		}
		else
		{
	var members=$('input[name="members[]"]:checked').map(function(_, el) {
	return $(el).val();
	}).get();
	var emailIds=$('input[name="emailIds[]"]').map(function() {
		return this.value;
	}).get();
	var student_id=$('#student_id').val();
	var gradeId=$('#gradeId').val();
	$("#hideon_compose").hide();
		var paramData={"act":"getSendEmail",
						"members":members,"emailIds":emailIds,"student_id":student_id,"gradeId":gradeId,
			};
			ajax({
				a:'communications',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#student_content').html(data);
					$("#showon_compose").show();
					
				}
			});	
		} 

});	


$("#show_compose").click(function(){
	$("#hide_inbox").hide();
	$("#hideon_compose").show();
});	



function show_reply(){
	$(".hide_btn").hide();
	$(".inbox_footer").show();
}	

function getMessageContainer(type,student_id)
{
		var paramData={"act":"getConvertation",
						"type":type,"student_id":student_id
			};
			ajax({
				a:'communications',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					$('#mail_content').html(data);
					
				
				}
			});			
}
function getMessagePopup(id,type)
{
if(type=='S')
{
var paramData={"act":"showMessage","id":id}
}
else{
	var paramData={"act":"showInboxMessage","id":id}
}
			ajax({
				a:'communications',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					show_inbox_popup();
					$("#inbox_popup").html(data);
				}
			});		
}
getMessageContainer("I",'<?=$studentId?>');	
<!-- Inbox Popup  --->
function show_inbox_popup(){
	
  	$("#inbox_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_inbox_popup(){ $("#inbox_popup").dialog('close');  }
	
	
$('.panal_menu').click(function(){
	$('.panal_menu').removeClass('active');
	$(this).addClass('active');
	
	$(this).next('.students_list').slideDown('slow');

});


$('.mail_item').click(function(){
	$('.mail_item').removeClass('active');
	$(this).addClass('active');
});

function loadMailId(gradeId){
		var member=$('input[name="select_member[]"]:checked').map(function() {return this.value;}).get().join(',');		
		var paramData={'act':'select_members','member':member,'gradeId':gradeId}
		ajax({
			a:'communications',
				b:$.param(paramData),
				c:function(){},
				d:function(data) {
					
								$('#dynamicMember').html(data);
									}
			});
	}
loadMailId('<?=$gradeId?>');
</script>

