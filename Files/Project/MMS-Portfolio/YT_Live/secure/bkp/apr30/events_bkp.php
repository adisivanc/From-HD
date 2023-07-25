<?
function main() {
	
if($_POST['act']=="deleteReg"){
	ob_clean();
	$deleteReg = EventRegistration::deleteEventReg($_POST['reg_id']);
	$deleteRegSession = EventRegistration::deleteEventSessionByRegId($_POST['reg_id']);
	exit();
}

if($_POST['act']=="showRegDtls"){
	ob_clean();
	include "view_event_reg_dtls.php";
	exit();
}
	
if($_POST['act']=="loadEventFrm") {
	ob_clean();
		$eventId = $_POST['eventId'];
		$rs_event = Events::getEventsById($eventId);
		$rs_sessions = EventSession::getSessionByEventId($eventId);
		if($_POST['tabType']=="events") { include "event_add.php"; }
	exit();
}

if($_POST['act']=="loadEventDtls") {
	ob_clean();

		$evnt_obj = new Events();
		if($_POST['tabType']=="upcoming") { $evnt_obj->upcoming_date = date("Y-m-d"); }
		else if($_POST['tabType']=="past") { $evnt_obj->past_date = date("Y-m-d"); }
		$evnt_obj->sortby = "ASC";
		$evnt_obj->orderby = "event_from_date";
		$rs_events =$evnt_obj->getEventsDtls();
		
		if ($_POST['page'] == '')
            $page = 1;
        else
            $page = $_POST['page'];
        $totalReg = count($rs_events);
        $PageLimit = ($_POST["page_limit"] == "") ? 20 : $_POST["page_limit"];

        $totalPages = ceil(($totalReg) / ($PageLimit));
        if ($totalPages == 0) $totalPages = 1;
        $StartIndex = ($page - 1) * $PageLimit;
        if (count($rs_events) > 0) $rs_eventsArr = array_slice($rs_events, $StartIndex, $PageLimit, true);
		
		$arrayCount = count($rs_events);
		$arraySliceCount = count($rs_eventsArr);
				
		if($arrayCount>0 && $totalPages > 1) { 
			$table_val = generatePagination($functionName="eventsList", $arrayCount, $arraySliceCount, $pageLimit=$PageLimit, $adjacent=1, $page=$page, $type=$_POST['tabType']);
		}
		?>
        
        <? 
		if(count($rs_eventsArr)>0) {
			foreach($rs_eventsArr as $kk=>$vv) {
				$bgcolor="#FFFFFF";
				if($kk%2==0) $bgcolor="#E5F1FE";
				$rs_event = Events::getEventsById($eventId);
				$ecmd_obj = new EventComments();
				$ecmd_obj->event_id=$vv->id;
				$ecmd_obj->parent_comment_id="0";
				$rs_evnt_cmts = $ecmd_obj->getEventCommentsDtls();
		?>
            <li style="<?=$bgcolor?>">
            	<a onclick="showEventListDlts(<?=$vv->id?>);" style="cursor:pointer;"><?=$vv->event_name?></a>
                <img src="images/event_comment_icon.png" align="absmiddle" alt="Event Comments" title="Event Comments" onclick="showEventCmdPopup('<?=$vv->id?>')" class="cursor" /> (<?=count($rs_evnt_cmts)?>)
            </li>
		<?
			}
			if($table_val!='') { ?><li><div><?=$table_val?></div></li><? }
			
		} else {
		?>
        	<li>No events found..!</li>
        <?
		}
		?>

        <input type="hidden" name="event_list_type" id="event_list_type" value="<?=$_POST['tabType']?>" />
        </li>
        <?
		
	exit();
}

if($_POST['act']=="loadListDtls") {
	ob_clean();
		$eventId = $_POST['eventId'];
		$tabType = $_POST['tabType'];
		include "event_details_include.php";
	exit();
}
	
if($_POST['act']=="eventSubmit") {
	
	//print_r($_POST); exit();
	$event_db_id = trim($_POST['event_db_id']);
	$event_name = trim($_POST['event_name']);
	$description = trim($_POST['event_desc']);
	$event_type = trim($_POST['event_type']);
	if($_POST['event_from_date']!="" && $_POST['event_from_date']!="0000-00-00" && $_POST['event_from_date']!="1970-01-01") $eventfdate = date("Y-m-d", strtotime(trim($_POST['event_from_date'])));
	else $eventfdate = "";
	$event_from_date = $eventfdate;
	if($_POST['event_to_date']!="" && $_POST['event_to_date']!="0000-00-00" && $_POST['event_to_date']!="1970-01-01") $eventtdate = date("Y-m-d", strtotime(trim($_POST['event_to_date'])));
	else $eventtdate = "";
	if($_POST['event_to_date']!="" && $_POST['event_to_date']!="undefined") $event_to_date = $eventtdate;
	if($_POST['event_from_hh']!="" && $_POST['event_from_mm']!="") $from_time = trim($_POST['event_from_hh']).":".trim($_POST['event_from_mm'])." ".trim($_POST['event_from_ampm']);
	if($_POST['event_to_hh']!="" && $_POST['event_to_mm']!="") $to_time = trim($_POST['event_to_hh']).":".trim($_POST['event_to_mm'])." ".trim($_POST['event_to_ampm']);
	$event_address = trim($_POST['event_address']);
	$contact_person = trim($_POST['contact_name']);
	$contact_phone = trim($_POST['contact_phone']);
	$contact_email = trim($_POST['contact_email']);
	$event_place = trim($_POST['event_place']);
	
	$event_file = trim($_POST['event_file']);
	
	if($_FILES['event_file']['size'] > 0)
	{
		//print_r($_POST);
		$up_fileArr = $_FILES['event_file']; 
		$rExt = array('jpg','jpeg','png','gif','pdf','psd','xls','xlsx','doc','docs','txt','bmp');
		$FileObj = new FileUpload();
		$FileResult = $FileObj->AssignAndCheck(array('FileRef'=>$up_fileArr, 'Extension'=>implode(',', $rExt),'PathPrefix'=>EVENT_FILE_PATH));
		if($FileResult['Type']==1)
		{
			$Err[]=$FileResult['Error'];
			$ErrFlag = false;
			if($FileResult['ErrorNo']==1 )
			{
				$Err[] = "Valid file formats are ".implode(',',$rExt);
				$ErrFlag = true;
			}	
		}
		elseif($FileResult['Type']==2)
		{
			$Uploadup_file = true;
		}
	}

	if($event_db_id != "" && $event_db_id != "undefined") {
		$rs_event_id = Events::updateEvents($event_db_id, $event_name, addslashes($description), $event_type, $event_from_date, $event_to_date, $from_time, $to_time, $event_place, $event_address, $contact_person, $contact_phone, $contact_email);
		$rs_event_id = $event_db_id;
	} else {
		$rs_event_id = Events::insertEvents($event_name, addslashes($description), $event_type, $event_from_date, $event_to_date, $from_time, $to_time, $event_place, $event_address, $contact_person, $contact_phone, $contact_email, $event_file);
	}
	
	if($Uploadup_file){
		//$FileObj->AssignFileName(UniqueIdGen());
		
		$rs_events_file = Events::getEventsById($rs_event_id);
		if($rs_events_file->event_file!="") {  echo "../".EVENT_FILE_REL.$rs_events_file->event_file;
			$delete_file = EVENT_FILE_PATH.$rs_events_file->event_file;
			@unlink($delete_file);
		} 
		
		$FileObj->AssignFileName($rs_event_id);
		$filepath = $FileObj->Upload();
		$rs_user_img = Events::updateEventsByfield('event_file', $filepath, $rs_event_id);
	}
		
	$evtSessionArr = $_POST['evntSessionArr'];	
	$evtSessionTimeArr = $_POST['evntSessionTimeArr'];	
	
	
	if(count($evtSessionArr['session_name'])>0 && !empty($evtSessionArr['session_name'])) {
		foreach($evtSessionArr['session_name'] as $K=>$V) { 
		
		/*echo "<pre>";
		print_r($_POST['evntSessionTimeArr'][$K]);
		echo "</pre>";*/
		if( $evtSessionArr['session_name'][$K]=="") continue;
		
		$timeArr = $_POST['evntSessionTimeArr'][$K];
		
		
		$ssTime=array();
		if(count($timeArr)>0) {
			foreach($timeArr as $kk=>$vv) {
				if($vv['session_ftime_hh']!="") {
				$ssTime[] = $vv['session_ftime_hh'].":".$vv['session_ftime_mm']." ".$vv['session_ftime_ampm']." - ".$vv['session_ttime_hh'].":".$vv['session_ttime_mm']." ".$vv['session_ttime_ampm'];
				}
			}
		}

			$session_id = $evtSessionArr['session_db_id'][$K]; 
			$session_name = $evtSessionArr['session_name'][$K]; 
			$session_date = date("Y-m-d", strtotime($evtSessionArr['session_date'][$K]));
			//$session_time = $evtSessionArr['session_ftime_hh'][$K].":".$evtSessionArr['session_ftime_mm'][$K]." ".$evtSessionArr['session_ftime_ampm'][$K]." - ".$evtSessionArr['session_ttime_hh'][$K].":".$evtSessionArr['session_ttime_mm'][$K]." ".$evtSessionArr['session_ttime_ampm'][$K];
			$session_time = implode(",", $ssTime);
			$session_type = $evtSessionArr['session_type'][$K];
			$session_amount = $evtSessionArr['session_amount'][$K];
			$session_place = $evtSessionArr['session_place'][$K];
			$session_description = $evtSessionArr['session_description'][$K];
			if($session_id!="" && $session_id!="undefined") {
				$rs_ss_id = EventSession::updateSession($session_id, $rs_event_id, $session_name, addslashes($session_description), $session_date, $session_time, $session_type, $session_amount, $session_place);
				$rs_ss_id = $session_id;
			} else {
				$rs_ss_id = EventSession::insertSession($rs_event_id, $session_name, addslashes($session_description), $session_date, $session_time, $session_type, $session_amount, $session_place);
			}
		}
	}
	
	//exit();
	if($rs_ss_id >0 || $rs_event_id>0) {
		//@SetUpHtAccess();
		?><script type="text/javascript">window.location.href="events.php";</script><?
		require_once('setHtaccess.php');
	}
	
}

if($_POST['act']=="deleteSessionDtls") {
	ob_clean();
		$rs_ssdelete = EventSession::deleteSession($_POST['sessionId']);
	exit();
}

if($_POST['act']=="loadEventReg") {
	ob_clean();
		$reg_obj = new EventRegistration();
		$reg_obj->event_id = $_POST['eventId'];
		$reg_obj->sortby = "DESC";
		$reg_obj->orderby = "id";
	
		if($_POST['searchType']!=''){
			if($_POST['searchType']=='name'){
				$reg_obj->reg_name = $_POST['searchTxt'];
 			}
			if($_POST['searchType']=='emailaddress'){
				$reg_obj->reg_email_address = $_POST['searchTxt_emailaddress'];
 			}
			if($_POST['searchType']=='id'){ 
				$reg_obj->searchTxt_id = $_POST['searchTxt_id'];
 			}
			if($_POST['searchType']=='session'){ 
				$getEventSessionId = $reg_obj->getEventSessionRegByEventSessionId($_POST['session_id']);
				if(count($getEventSessionId)>0){
					foreach($getEventSessionId as $M=>$N){
						$rs_regs[] = $reg_obj->getEventRegById($N->reg_id);
					}
				} 
			}
			if($_POST['searchType']=='date'){ 
				$searchTxt_fromDate = date('Y-m-d',strtotime($_POST['searchTxt_fromDate']));
				$searchTxt_toDate = date('Y-m-d',strtotime($_POST['searchTxt_toDate']));
			
 				$rs_event_regs = $reg_obj->getEventSessionRegByEventSessionDate($searchTxt_fromDate,$searchTxt_toDate,$_POST['eventId']);
				if(count($rs_event_regs)>0){
					foreach($rs_event_regs as $M=>$N){
						$rs_regs[] = $reg_obj->getEventRegById($N->reg_id);
					}
				} 
 			}
			
 		}
		
		if($_POST['searchType']!='session' && $_POST['searchType']!='date'){ 
			$rs_regs = $reg_obj->getEventRegDtls();
		}
 		
		if ($_POST['page'] == '')
            $page = 1;
        else
            $page = $_POST['page'];
        $totalReg = count($rs_regs);
        $PageLimit = ($_POST["page_limit"] == "") ? 5 : $_POST["page_limit"];

        $totalPages = ceil(($totalReg) / ($PageLimit));
        if ($totalPages == 0) $totalPages = 1;
        $StartIndex = ($page - 1) * $PageLimit;
        if (count($rs_regs) > 0) $rs_regsArr = array_slice($rs_regs, $StartIndex, $PageLimit, true);
		include "registration_details.php";
		
	exit();
}

if($_POST['act']=="loadGalleryList") {
	ob_clean();
		$eventId = $_POST['eventId'];
		$tabType = $_POST['tabType'];
		include "view_gallery.php";
	exit();
}

if($_POST['act']=="editGalleries") {
	ob_clean();
		$eventId = $_POST['eventId'];
		$tabType = $_POST['tabType'];
		include "add_gallery.php";
	exit();
}

if($_POST['act']=="deleteGalleryFile") {
	ob_clean();
		$rs_photo = EventPhotos::getEventPhotosById($_POST['galleryId']);
		$rs_delete = EventPhotos::deleteEventPhotos($_POST['galleryId']);
		if($rs_photo->photo_file!="") { 
			$delete_file = EVENT_GALLERY_PATH.$rs_photo->photo_file;
			@unlink($delete_file);
		} 
	exit();
}

if($_POST['act']=="eventGallerySubmit") {
	//echo "<pre>"; print_r($_POST); echo "</pre>"; exit();	
	extract($_POST);
	$today = time() ; $sqlDateTime = date('Y-m-d H:i:s', $today) ;
	$ErrorObj = array();
	$regimagepath=array();
	//$regfilepath=array();
	$regimagepath=is_array($regimagepath)?$regimagepath:array();
	$rExt = array('jpg', 'png', 'gif','jpeg');

	$photostr='';
	//echo count($heventfiles);
	$regfilepath=is_array($regfilepath)?$regfilepath:array();
	$EvtFileObjData = array();
	$heventfilescnt = count($heventfiles);
	if($heventfilescnt>0){
		foreach($heventfiles as $index=>$value){
			$EvtFileObjData[$index]['File'] = $_FILES['eventfiles_'.$index];
			$EvtFileObjData[$index]['Obj'] = new FileUpload();
			$EvtFileObjData[$index]['Result']=false;
			$FileResultData = $EvtFileObjData[$index]['Obj']->AssignAndCheck(array('FileRef'=>$EvtFileObjData[$index]['File'], 'Extension'=>implode(',', $rExt)));
			if($FileResultData['Type']==1){
				//$ErrorObj['evtfiles'.$index]=$FileResult['Error'];
			}
			elseif($FileResultData['Type']==2){
				$EvtFileObjData[$index]['Result']=true;
				$EvtFileObjData[$index]['Obj']->AssignFilePrefix(SITE_TMP_DIR);
				$EvtFileObjData[$index]['Obj']->AssignFileName(getUnique());
				$filepath = $EvtFileObjData[$index]['Obj']->Upload();	
				if($filepath!='')
					$regfilepath[] = $filepath ;
			}
		}
	}
	$folderPathData = EVENT_GALLERY_PATH;
	$folderPathHrefData = EVENT_GALLERY_HREF;
	@mkdir($folderPathData, 0777);
	@chmod($folderPathData, 0777);
	if(is_array($regfilepath)){
		foreach($regfilepath as $K=>$V){
			if(fileExists(SITE_TMP_DIR . $V)){						
				@copy(SITE_TMP_DIR . $V, $folderPathData . $V);
				@unlink(SITE_TMP_DIR . $V);
			}
		}
	}
	
	if(is_array($oldregfilepath)){
		foreach($oldregfilepath as $K=>$V1){
			if( !in_array($V1, $regfilepath) ) { 
				@unlink($folderPathData.$V1);
				}
		}
	}
	
	foreach($filetitle as $K=>$V){
		if(!empty($heventfiles[$K])) {
			$val2[] = $heventfiles[$K]."::::".$fileid[$K];
		}
		elseif(!empty($regfilepath[$K])){
			$val2[] = $regfilepath[$K]."::::".$fileid[$K];
		}
	}
	
	$regfilepath = $val2;
	$photostr=is_array($regfilepath)?implode('~', $regfilepath):'';
		
	/*$postArr = array('title');
	foreach($postArr as $v) $$v=$_POST[$v];*/

	if(count($regfilepath)>0) {			
		foreach($regfilepath as $kk=>$vv) { 
			$vvArr = explode("::::", $vv);
			if($vvArr[0]!="" && $vvArr[0]!="undefined") { 
				if($vvArr[1]=="" || $vvArr[1]=="undefined") {
					$insert_id = EventPhotos::insertEventPhotos($_POST['event_gdb_id'], $vvArr[0], "");
				} else { 
					$insert_id = EventPhotos::updateEventPhotos($vvArr[1], $_POST['event_gdb_id'], $vvArr[0], "");
					$insert_id = $vvArr[1];
				}
				if($_POST['make_coverphoto'][$kk]=="Y") $_POST['make_coverphoto'][$kk]="Y"; else $_POST['make_coverphoto'][$kk]="N";
				$field='is_coverphoto';
				$fieldvalue=$_POST['make_coverphoto'][$kk]; 
				$id=$insert_id;
				EventPhotos::updateEventPhotosByfield($field,$fieldvalue,$id);
			}
		}
	}
	
	//exit();	
	?><script type="text/javascript">window.location.href="events.php";</script><?
	
}

if($_POST['act']=="showEventCommentPopup") {
	ob_clean();
	$eventId = $_POST['eventId'];
	$rs_event = Events::getEventsById($eventId);
	$ecmd_obj = new EventComments();
	$ecmd_obj->event_id=$eventId;
	$ecmd_obj->parent_comment_id="0";
	//$ecmd_obj->isactive="N";
	$rs_event_cmds = $ecmd_obj->getEventCommentsDtls();
	?>
    <div style="max-height:750px;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
    <tr>
        <th align="left"><strong>EVENT COMMENTS</strong>
        <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
     </tr>
      <tr>
        <td colspan="2" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtbl">
            <?
			if(count($rs_event_cmds)>0) {
				foreach($rs_event_cmds as $ck=>$cv) {
					$bgcolor="#FFFFFF";
					if($ck%2==0) $bgcolor="#E5F1FE";
					$reply_obj = new EventComments();
					$reply_obj->parent_comment_id=$cv->id;
					$rs_replys = $reply_obj->getEventCommentsDtls();
			?>
            	<tr bgcolor="<?=$bgcolor1?>">
                	<td width="80%" style="padding:10px; font-family:open_sansregular;">
                        <span class="blue"><b><?=ucwords($cv->name)?></b></span> <span style="color:#666; margin-left:10px; font-size:11px;"><?=date("M d, Y H:i A", strtotime($cv->added_date))?></span> - <?=$cv->email?><br />
                        <div style="margin-top:10px;"><?=$cv->comments?></div>
                    </td>
                    <td width="20%" style="padding:10px;" valign="bottom">
                    	<span style="text-decoration:underline; cursor:pointer;" onclick="showReplyFrm(<?=$cv->id?>, 'N')">Reply</span>
                        <span style="text-decoration:underline; cursor:pointer; margin-left:10px;" onclick="showEventCmtReplyMsgs(<?=$cv->id?>, 'S')" id="rlycounttab<?=$cv->id?>">(<?=count($rs_replys)?>)</span>
                    </td>
                </tr>
                <tr>
                	<td id="cmdreplyform<?=$cv->id?>" colspan="2"></td>
                </tr>
                <tr>
                	<td id="cmdreplymessages<?=$cv->id?>" colspan="2"></td>
                </tr>
                <tr><td style="height:1px; border-bottom:1px solid #cccccc;" colspan="2"></td></tr>
            <?
				}
			} else {
				?>
                <div style="padding:10px;">No new comments are available..!</div>
                <?
			}
			?>
            </table>
       </td>
      </tr>
      
      <tr>
      	<td id="glrycommentsdltstab"></td>
      </tr>
      
    </table>
    </div>
    <?
	exit();
}

if($_POST['act']=="showReplyForm") {
	ob_clean();
	$commentId = $_POST['commentId'];
	?>
    <table width="282" border="0" cellspacing="0" cellpadding="0" class="tbl">
      <tr>
        <td>
        	<textarea class="msgbox message_icon" id="event_cmt_reply_msg" name="event_cmt_reply_msg" placeholder="Message.."></textarea>
        </td>
      </tr>
      <tr>
        <td>
        	<div class="fullsize txtwhite txtcenter f18">
	            <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="showReplyFrm('<?=$commentId?>', 'S')"><strong>Submit</strong></div>
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="showReplyFrm('<?=$commentId?>', 'C');"><strong>Cancel</strong></div>
            </div>
        </td>
      </tr>
    </table>
    <?
	exit();
}

if($_POST['act']=="saveReplyMsg") {
	ob_clean();
	$commentId = $_POST['commentId'];
	$rs_event_cmt = EventComments::getEventCommentsById($commentId);
	$rs_user = User::getUserById($_SESSION['UserId']);
	$rs_event_cmt_id = EventComments::insertEventComments($rs_event_cmt->event_id, $commentId, $rs_user->name, $rs_user->email_address, $rs_user->phone, addslashes($_POST['eReplyMsg']));
	
	if($rs_event_cmt>0) {
		EventComments::updateEventCommentsByfield("replied_by", $_SESSION['UserId'], $commentId);
		EventComments::updateEventCommentsByfield("replied_by", $_SESSION['UserId'], $rs_event_cmt_id);
		
		$subject = "YELLOW TRAIN: Replay message for your question of ".limit_words($rs_event->event_name, 10)."..";
		$filename = 'mail_event_comment_reply.php';
		$toemail = $rs_event_cmt->email;
		$toname = $rs_event_cmt->name;
		$rs_email = EventComments::sendEventMail($rs_event_cmt->event_id, $rs_event_cmt_id, $subject, $filename, $toemail, $toname);
		ob_clean();
		echo "Replied successfully..!";
	} else { 
	}	
	exit();
}

if($_POST['act']=="loadReplyMsgs") {
	ob_clean();
	$commentId = $_POST['commentId'];
	$cmt_obj = new EventComments();
	$cmt_obj->parent_comment_id=$commentId;
	$rs_comments = $cmt_obj->getEventCommentsDtls();
	?>
    <div align="right" style="padding:10px; text-decoration:underline; cursor:pointer;" onclick="showEventCmtReplyMsgs(<?=$commentId?>, 'H')">Hide</div>
    <?
	if(count($rs_comments)>0) {
		foreach($rs_comments as $kk=>$vv) {
		?>
        <div style="border:1px solid #999; padding:10px; margin-bottom:10px; float:right; width:90%; margin-left:10px; margin-right:10px;">
            <span class="blue"><b><?=ucwords($vv->name)?></b></span> 
            <span style="color:#666; margin-left:10px; font-size:11px;"><?=date("M d, Y H:i A", strtotime($vv->added_date))?></span> - <?=$vv->email?><br />
            <div style="margin-top:10px;"><?=$vv->comments?></div>
        </div>
        <?
		}
	} else {
	?>
    <div style="border:1px solid #999; padding:10px; margin-bottom:10px; float:right; width:90%; margin-left:10px; margin-right:10px;">No Replys are available..!</div>
    <?
	}
	echo "::::::";
	echo count($rs_comments);
	exit();
}

if($_POST['act']=="showGalleryCmdPopup") {
	ob_clean();
	$photoId = $_POST['photoId'];
	$rs_photo = EventPhotos::getEventPhotosById($photoId);
	$gcmd_obj = new EventPhotoComments();
	$gcmd_obj->photo_id=$photoId;
	$gcmd_obj->is_active="N";
	$rs_photo_cmds = $gcmd_obj->getPhotoCommentsDtls();
	//$rs_photo_cmds = EventPhotoComments::getPhotoCommentsByPhotoId($photoId);
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
     <tr>
        <th align="left"><strong>GALLERY COMMENTS</strong>
        <span onclick="closePopup()" class="popup_closebtn" title="Close" style="cursor:pointer;" align="right"><strong>X&nbsp;&nbsp;</strong></span></th>
     </tr>
      <tr>
        <td colspan="2" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> <td> <table width="100%" border="0" cellspacing="0" cellpadding="0" class="listtbl">
            <?
			if(count($rs_photo_cmds)>0) {
				foreach($rs_photo_cmds as $ck=>$cv) {
			?>
            	<tr bgcolor="<?=$bgcolor1?>">
                	<td width="80%" style="padding:10px; font-family:open_sansregular;">
                        <span class="blue"><b><?=ucwords($cv->name)?></b></span> <span style="color:#666; margin-left:10px; font-size:11px;"><?=date("M d, Y H:i A", strtotime($cv->added_date))?></span> - <?=$cv->email?><br />
                        <div style="margin-top:10px;"><?=$cv->comments?></div>
                    </td>
                    <td width="20%" style="padding:10px;" valign="bottom">
                    	<div class="fullsize txtwhite txtcenter f18">
                            <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="setGlryCmdStatus('A', '<?=$cv->id?>', '<?=$cv->photo_id?>')"><strong>Approve</strong></div>
                            <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" onclick="setGlryCmdStatus('R', '<?=$cv->id?>', '<?=$cv->photo_id?>')"><strong>Reject</strong></div>
                        </div>
                    </td>
                </tr>
            <?
				}
			} else {
				?>
                <tr>
                	<td colspan="2">No new comments are available..!</td>
                </tr>
                <?
			}
			?> </table>
            <td>
            </tr>
            </table>
       </td>
      </tr>
      
      <tr>
      	<td id="glrycommentsdltstab"></td>
      </tr>
      
    </table>
    <script type="text/javascript">showApprovedCmds('A', <?=$photoId?>);</script>
    <?
	exit();
}

if($_POST['act']=="updateGlryCmdStatus") {
	ob_clean();
		$today=time();
		$sqlDateTime = date('Y-m-d H:i:s', $today);
		$rs_update = EventPhotoComments::updateCommendStatus($_POST['photoCmdId'], $_POST['status'], $_SESSION['UserId'], $sqlDateTime);
	exit();
}

if($_POST['act']=="getApprovedCmds") {
	ob_clean();
	$gcmd_obj = new EventPhotoComments();
	$gcmd_obj->photo_id=$_POST['photoId'];
	$gcmd_obj->is_active=$_POST['cmdStatus'];
	$rs_app_glry_cmds = $gcmd_obj->getPhotoCommentsDtls();
	?>
    
    <div class="gradetab_outer">
        <div id="tabbtn_A" class="grade_tab tabbtn <?=($_POST['cmdStatus']=="A")?"active":""?>" onClick="showApprovedCmds('A', '<?=$_POST['photoId']?>')">Approved Comments</div>
        <div id="tabbtn_R" class="grade_tab tabbtn <?=($_POST['cmdStatus']=="R")?"active":""?>" onClick="showApprovedCmds('R', '<?=$_POST['photoId']?>')">Rejected Comments</div>
    </div>
    <div class="gradetab_outer" style="border-top-left-radius:0px; border:1px solid #DAB791">
    <table border="0" cellpadding="0" cellspacing="0" class="tbl" width="100%" style="border:0px; padding:10px;">
    <?
	if(count($rs_app_glry_cmds)>0) {
		foreach($rs_app_glry_cmds as $gk=>$gv) {
			$rs_user = User::getUserById($gv->approved_by);
			$bgcolor="#FFFFFF";
			if($gk%2==0) $bgcolor="#E5F1FE";
		?>
        	<tr bgcolor="<?=$bgcolor?>">
                <td>
                	<span class="blue"><b><?=ucwords($gv->name)?></b></span> <span style="color:#666; margin-left:10px; font-size:11px;"><?=date("M d, Y H:i A", strtotime($gv->added_date))?></span> - <?=$gv->email?><br />
                    <div style="margin-top:10px;"><?=$gv->comments?></div><br />
                </td>
                <td valign="top">
                    <div align="center"><?=$rs_user->user_name?> <br /> <?=$gv->approved_date?></div>
                </td>
            </tr>
        <?
		}
	} else {
	?>
    	<div style="padding:10px;">No approved comments are available..!</div>
    <?
	}
	?>
    </table>
    </div>
    <?
	exit();
}	
	
	
?>

<script type="text/javascript">
$(function() {
   $(".datepicker").datepicker({
		changeMonth: true
   });  
});
</script>

<style>
.boxerror {border:1px solid #F00;}
.txterror {color: #F00;}
</style>

<link rel="stylesheet" type="text/css" href="css/default_style.css" />


<div class="fullsize">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Events</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop40">
            <div class="combutton pull_right f24 cursor"><span onclick="showEventTabs('events')" class="cursor">Add Events</span></div>
        </div>
    </div>
    
</div>



<div class="fullsize">
    
        <div class="fullsize newsletter_outer">
        	
            <div class="newsletter_left"> <!-- Newsletter Circular -->
            	<div class="newsletter_submenu txtwhite">
                
					<div class="circular_outer">
                    	<div class="newcircular_head tabbtn" id="tabbtn_upcoming" onClick="showEventsList('upcoming')">Upcoming Events<span></span></div>
                        <ul class="listoption txttheme" id="curcularmenutab_upcoming" style="padding-right:10px; float:left;"></ul>
                    </div>
                    
                    <div class="circular_outer" style="clear:both;">
                    	<div class="newcircular_head tabbtn" id="tabbtn_past" onClick="showEventsList('past')">Past Events<span></span></div>
                        <ul class="listoption txttheme" id="curcularmenutab_past" style="padding-right:10px;"></ul>
                    </div>
                    
                </div>
            </div><!-- Newsletter Circular -->
            
            
            <!-- Newsletter Form -->
            <div class="newsletter_right border_theme bgwhite" id="eventformdtls" style="width:78.8%;"><? include "event_add.php"; ?></div><!-- Newsletter Form -->
            
        </div>
    
</div>


<div id="event_popup" style="display:none; padding:0px; margin:0px;"></div>
<div id="event_reg_details_popup" style="display:none; padding:0; max-height:700px;"></div>

<script type="text/javascript">
 
function showEventTabs(tabVal, event_id) { 

	if(event_id=="" || event_id==undefined) event_id=""; else event_id=event_id;
	var type = $('#type').val(tabVal);
	$('.tabbtn').removeClass('active');
	$('#tabbtn_'+tabVal).addClass('active');
	$("#eventformdtls").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'events_bkp',
		b:'act=loadEventFrm&tabType='+tabVal+'&eventId='+event_id,
		c:function(){},
		d:function(data){
			$('#eventformdtls').html(data);
		}
	});
	
}

showEventsList('upcoming');
function showEventsList(tabVal) { 
	
	var type = $('#type').val(tabVal);
	$('.tabbtn').removeClass('active');
	$('#tabbtn_'+tabVal).addClass('active');
	$(".listoption").hide();
	$(".listoption").html('');
	$('#curcularmenutab_'+tabVal).show(); 
	$("#curcularmenutab_"+tabVal).html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');

	ajax({
		a:'events_bkp',
		b:'act=loadEventDtls&tabType='+tabVal,
		c:function(){},
		d:function(data){ //alert(data);
			$("#curcularmenutab_"+tabVal).html(data);
		}
	});

}

function eventsListPaging(page, tabVal) { //alert(page); alert(tabVal);
	
	var type = $('#type').val(tabVal);
	$('.tabbtn').removeClass('active');
	$('#tabbtn_'+tabVal).addClass('active');
	$(".listoption").hide();
	$(".listoption").html('');
	$('#curcularmenutab_'+tabVal).show(); 
	$("#curcularmenutab_"+tabVal).html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	
	ajax({
		a:'events_bkp',
		b:'act=loadEventDtls&tabType='+tabVal+'&page='+page,
		c:function(){},
		d:function(data){ 
			$("#curcularmenutab_"+tabVal).html(data);
		}
	});

}

function showEventListDlts(event_id) { //alert(event_id);
	
	$('#eventformdtls').html('');
	var tabType = $('#event_list_type').val();
	if(event_id!="" && event_id!=undefined) {
		$("#eventformdtls").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
		ajax({
			a:'events_bkp',
			b:'act=loadListDtls&eventId='+event_id+'&tabType='+tabType,
			c:function(){},
			d:function(data){
				$('#eventformdtls').html(data);
			}
		});
	}
	
}

function showGallery(event_id, tabType) {
	
	$('#eventformdtls').html('');
	if(event_id!="" && event_id!=undefined) {
		$("#eventformdtls").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
		ajax({
			a:'events_bkp',
			b:'act=loadGalleryList&eventId='+event_id+'&tabType='+tabType,
			c:function(){},
			d:function(data){
				$('#eventformdtls').html(data);
				$('#editglryimg').show();
				$('#listglryimg').hide();
			}
		});
	}
	
}

function editGalleryDtls(event_id, tabType) {

	if(event_id!="" && event_id!=undefined) {
		$("#gallerylisttab").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
		ajax({
			a:'events_bkp',
			b:'act=editGalleries&eventId='+event_id+'&tabType='+tabType+'&actionType='+tabType,
			c:function(){},
			d:function(data){
				$('#gallerylisttab').html(data);
				$('#editglryimg').hide();
				$('#listglryimg').show();
			}
		});
	}
}

function openSessionDesc(id) { 
	if($('#sessiondesctab'+id).is(':visible')){ 
		$('#sessiondesctab'+id).hide();
		$('#opensessionimg'+id).show();
		$('#closesessionimg'+id).hide();
	}else{ 
		$('#sessiondesctab'+id).show();
		$('#opensessionimg'+id).hide();
		$('#closesessionimg'+id).show();
	}
}

function showEventRegList() { 
	
	var event_id= $('#event_h_id').val();
	var page = $('#reg_page_number').val(); 
	if(page=="" || page==undefined) page=1; else page=page;
	
	$("#eventregtab").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'events_bkp',
		b:'act=loadEventReg&eventId='+event_id+'&page='+page,
		c:function(){},
		d:function(data){ 
			$('#eventregtab').html(data);
		}
	});

}

function eventRegListPaging(page) { //alert(page); alert(tabVal);
	
	var event_id= $('#event_h_id').val();
	$("#eventregtab").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'events_bkp',
		b:'act=loadEventReg&eventId='+event_id+'&page='+page,
		c:function(){},
		d:function(data){ 
			$('#eventregtab').html(data);
		}
	});

}

function showPopup(){
  	$("#event_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: '600',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}
function closePopup(){ $("#event_popup").dialog('close');  }

function showGalleryCmts(photo_id) {
	
	$("#event_popup").dialog('open');
	$("#event_popup").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'events_bkp',
		b:'act=showGalleryCmdPopup&photoId='+photo_id,
		c:function(){},
		d:function(data){ 
			$("#event_popup").html(data);
			showPopup();
		}
	});
	
}

function showApprovedCmds(status, photo_id) { 
	
	$("#glrycommentsdltstab").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'events_bkp',
		b:'act=getApprovedCmds&photoId='+photo_id+'&cmdStatus='+status,
		c:function(){},
		d:function(data){ //alert(data);
			$("#glrycommentsdltstab").html(data);
		}
	});
	
}

function setGlryCmdStatus(status, id, photo_id) {
	ajax({
		a:'events_bkp',
		b:'act=updateGlryCmdStatus&status='+status+'&photoCmdId='+id,
		c:function(){},
		d:function(data){ 
			if(status=="A") alert("Approved successfully..!");
			else if(status=="R") alert("Rejected successfully..!");
			showApprovedCmds(status, photo_id);
		}
	});
}

function showEventCmdPopup(event_id) { 

	$("#event_popup").dialog('open');
	$("#event_popup").html('<div style="padding:50px;"><img src="images/loader.gif" alt="Loading Data.." title="Loading Data.." /></div>');
	ajax({
		a:'events_bkp',
		b:'act=showEventCommentPopup&eventId='+event_id,
		c:function(){},
		d:function(data){ //alert(data); 
			$("#event_popup").html(data);
			showPopup();
		}
	});
	
}

function showReplyFrm(comment_id, action) {
	
	if(action=="C")  {
		$("#cmdreplyform"+comment_id).html('');
		return false;
	}
	
	else if(action=="N") {
		ajax({
			a:'events_bkp',
			b:'act=showReplyForm&commentId='+comment_id,
			c:function(){},
			d:function(data){ //alert(data); 
				$("#cmdreplyform"+comment_id).html(data);
			}
		});
	}
	
	else if(action=="S") {
		var err=0;
		var	eReplyMsg = $.trim($("#event_cmt_reply_msg").val());
		if(eReplyMsg==''){ err=1; $('#event_cmt_reply_msg').addClass('boxerror'); } else { $('#event_cmt_reply_msg').removeClass('boxerror'); }
		if(err==0) {
			ajax({
				a:'events_bkp',
				b:'act=saveReplyMsg&commentId='+comment_id+'&eReplyMsg='+eReplyMsg,
				c:function(){},
				d:function(data){ alert(data); 
					$("#cmdreplyform"+comment_id).html('');
					showEventCmtReplyMsgs(comment_id, 'RC');
				}
			});
		}
	}
	
}

function showEventCmtReplyMsgs(comment_id, action) {
	
	if(action=="H") {
		$("#cmdreplymessages"+comment_id).html('');
		return false;
	}
	
	ajax({
		a:'events_bkp',
		b:'act=loadReplyMsgs&commentId='+comment_id,
		c:function(){},
		d:function(data){ //alert(data); 
			var dataArr = data.split('::::::');
			if(action=="RC") {
				$("#rlycounttab"+comment_id).html(dataArr[1]);
			} else {
				$("#cmdreplymessages"+comment_id).html(dataArr[0]);
			}
		}
	});
	
}

function viewRegDtls(id){
  	ajax({
		a:'events_bkp',
		b:'act=showRegDtls&reg_id='+id,		
		c:function(){},
		d:function(data){
			//alert(data);
			$("#event_reg_details_popup").html(data);
			popupRegDtls();
		}			
	});
}
function popupRegDtls(){
  	$("#event_reg_details_popup").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true	,
		draggable: true
	});
						
	$(".ui-widget-header").css({"display":"none"});
}
function closeRegDtlsPopup(){ $("#event_reg_details_popup").dialog('close');  }

function deleteRegDtls(reg_id){ 
 
	ajax({
			a:'events_bkp',
			b:'act=deleteReg&reg_id='+reg_id,		
			c:function(){},
			d:function(data){
			//alert(data);
				alert('Registration Details Deleted Successfully');
				showEventRegList();
			}			
		});
}
function show_type(){
	
	//$('#searchTxt').val('');
	//$('#searchTxt_emailaddress').val('');
	//$('#searchTxt_id').val('');
	var searchType = $('#searchType').val();
	if(searchType=='name'){
		$('#showEmail').hide();
		$('#showTxt').show();
		$('#showId').hide();
		$('#showSession').hide();
		$('#showDate').hide();
	}
	if(searchType=='emailaddress'){
		$('#showEmail').show();
		$('#showTxt').hide();
		$('#showId').hide();
		$('#showSession').hide();
		$('#showDate').hide();
	}
	if(searchType=='id'){
		$('#showEmail').hide();
		$('#showTxt').hide();
		$('#showId').show();
		$('#showSession').hide();
		$('#showDate').hide();
	}
	if(searchType=='session'){
		$('#showEmail').hide();
		$('#showTxt').hide();
		$('#showId').hide();
		$('#showSession').show();
		$('#showDate').hide();
	}
	if($('#searchType').val()=='date'){
		$('#showEmail').hide();
		$('#showTxt').hide();
		$('#showId').hide();
		$('#showSession').hide();
		$('#showDate').show();
	}
	
}
function gen_search(event_id) 
{
	var err=0;
 
	if($('#searchType').val()==''){  err =1;  $('#searchType').addClass('boxerror'); }else{  $('#searchType').removeClass('boxerror'); 	}
	
	if($('#searchTxt').val()==''){  err =1;  $('#searchTxt').addClass('boxerror'); }else{  $('#searchTxt').removeClass('boxerror');  }
	if($('#searchTxt_id').val()==''){  err =1;  $('#searchTxt_id').addClass('boxerror'); }else{  $('#searchTxt_id').removeClass('boxerror');  }
	if($('#searchTxt_emailaddress').val()==''){  err =1;  $('#searchTxt_emailaddress').addClass('boxerror'); }else{  $('#searchTxt_emailaddress').removeClass('boxerror'); 	}
	
	if($('#searchType').val()!=''){  
		err=0;
		if($('#searchType').val()=='name' && $('#searchTxt').val()==''){  err =1; $('#searchTxt').addClass('boxerror'); }else{ 	$('#searchTxt').removeClass('boxerror'); }
		if($('#searchType').val()=='id' && $('#searchTxt_id').val()==''){ err =1; $('#searchTxt_id').addClass('boxerror'); }else{ $('#searchTxt_id').removeClass('boxerror'); }
		if($('#searchType').val()=='emailaddress' && $('#searchTxt_emailaddress').val()==''){ err =1; $('#searchTxt_emailaddress').addClass('boxerror'); }else{ $('#searchTxt_emailaddress').removeClass('boxerror'); }
		if($('#searchType').val()=='session' && $('#searchTxt_session').val()==''){ err =1; $('#searchTxt_session').addClass('boxerror'); }else{ $('#searchTxt_session').removeClass('boxerror'); }
		if($('#searchType').val()=='date' && $('#searchTxt_fromDate').val()==''){ err =1; $('#searchTxt_fromDate').addClass('boxerror'); }else{ $('#searchTxt_fromDate').removeClass('boxerror'); }
		
	}
	
 	if(err==0){
		
		var searchType = $('#searchType').val();
		var searchTxt = $('#searchTxt').val();
		var searchTxt_id = $('#searchTxt_id').val();
 		var searchTxt_emailaddress = $('#searchTxt_emailaddress').val();
		var searchTxt_fromDate = $('#searchTxt_fromDate').val();
		var searchTxt_toDate = $('#searchTxt_toDate').val();
		var searchId = $('#searchId').val();
		
		ajax({
			a:'events_bkp',
			b:'act=loadEventReg&searchType='+searchType+'&searchTxt='+searchTxt+'&searchTxt_id='+searchTxt_id+'&searchTxt_emailaddress='+searchTxt_emailaddress+'&session_id='+searchId+'&searchTxt_fromDate='+searchTxt_fromDate+'&searchTxt_toDate='+searchTxt_toDate+'&eventId='+event_id,
			c:function(){},
			d:function(data){
				//alert(data);
				$('#eventregtab').html(data);
				 
			}
		});

	}
	
}
</script>

<?
}
include "template.php";
?>