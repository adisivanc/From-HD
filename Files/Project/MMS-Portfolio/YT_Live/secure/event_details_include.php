<?
$rs_events = Events::getEventsById($eventId);
$rs_sessions = EventSession::getSessionByEventId($eventId);
$rs_school = School::getSchoolById($rs_events->event_place);
$rs_regs = EventRegistration::getEventRegByEventId($eventId);


if($rs_events->event_file!="") {
	$event_photo='../'.(EVENT_FILE_REL.$rs_events->event_file);
	$thumb_event_photo_name='../'.(EVENT_FILE_REL.'thumb_'.$rs_events->event_file);
	if(!file_exists($thumb_event_photo_name) || file_exists($thumb_event_photo_name)) 
	smart_resize_image($event_photo , null, 158 , 121 , true , $thumb_event_photo_name , false , false ,100 );
}
?>

<div class="fullsize margintb10">        
        
<input type="hidden" name="event_h_id" id="event_h_id" value="<?=$eventId?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl border_theme">
    <tr>
        <th align="left"><strong><b><?=$rs_events->event_name?></b> <? if($rs_school->school_name!="") { ?>(<?=$rs_school->school_name?> Campus)<? } ?></strong>
        <div style="float:right;">
        <img src="images/edit_icon.png" alt="Edit" title="Edit" align="absmiddle" onclick="showEventTabs('events', <?=$rs_events->id?>, '<?=$rs_events->type_of_event?>')" class="cursor" />
        <img src="images/delete_icon.png" alt="Delete" title="Delete" align="absmiddle" onclick="if(confirm('Are you sure want to delete this event?')) eventDelete(<?=$rs_events->id?>, '<?=$tabType?>')" class="cursor" />
        </div>
        </th>
    </tr>
    
    <tr>
    	<td valign="top" style="padding:10px;">
        	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:0px;">
            	<? if($rs_events->type_of_event=="R") { ?>
                <tr>
                    <td width="17%" valign="top">
                    	<? if($thumb_event_photo_name!="") { ?><img src="resize.php?w=150&h=100&img=<?="../".EVENT_FILE_REL.$rs_events->event_file?>" /><? } ?>
                    </td>
                    <td width="83%" valign="top">
                        <b><?=$rs_events->contact_person?></b><br />
                        <? if($rs_events->contact_email!="") { ?>
                    	<a href="mailto:<?=$rs_events->contact_email?>" style="color:#2B2F3E;"><img src="images/mail_icon1.png" align="absmiddle" /> <?=$rs_events->contact_email?></a><br />
                        <? } ?>
                        <? if($rs_events->contact_phone!="") { ?>
                        <img src="images/phone_icon.png" align="absmiddle" /> <?=$rs_events->contact_phone?><br /><br />
                        <? } ?>
                        <? if($rs_events->event_from_date!="0000-00-00" || $rs_events->event_to_date!="0000-00-00") { ?>
                        <div style="font-weight:bold;"><?=($rs_events->event_from_date!="0000-00-00" && $rs_events->event_from_date!="1970-01-01")?date("M d, Y", strtotime($rs_events->event_from_date)):"--"?>
                        <? if($rs_events->event_type=="M") { ?> - <?=($rs_events->event_to_date!="0000-00-00" && $rs_events->event_to_date!="1970-01-01")?date("M d, Y", strtotime($rs_events->event_to_date)):"--"?><? } ?><br />
                        (<?=$rs_events->from_time?> - <?=$rs_events->to_time?>)</div> <br />
                        <? } ?>
                    </td>
                </tr>
                <? } ?>
                <tr>
                	<td colspan="3" style="padding:20px 10px;"><?=stripslashes($rs_events->description)?></td>
                </tr>
            </table>
        </td>
    </tr>
    
    <? if(!empty($rs_sessions)) { ?>
    <tr>
    	<td valign="top" id="sessionlist" style="padding:10px;">
        	<div>
            	<div class="pull_left"><b>Session Details</b></div>
                <div class="pull_right">
                	<!--<div class="combutton pull_right marginleft10" onclick="printList('sessionlist')">Print</div>-->
                    <div class="combutton pull_right" onclick="printList('sessionlist')">
                    <a href="generateCSV.php?filename=EventSession&EventId=<?=$eventId?>" style="color:#FFF;">Export</a>
                    </div>
                </div>
            </div>
        	<table border="0" cellpadding="0" cellspacing="0" class="gradetbl" id="grade_studentab" width="100%" style="border:0px;">
                <tr bgcolor="#E4C6A0">
                	<th width="22%" style="color:#FFF;">Session Name</th>
                    <th width="26%" style="color:#FFF;">Session Date/Time</th>
                    <th width="22%" style="color:#FFF;">Session Type/Amount</th>
                    <th width="21%" style="color:#FFF;">Session Place</th>
                    <th width="9%" style="color:#FFF;">Details</th>
                </tr>
                <?
				if(count($rs_sessions)>0 && !empty($rs_sessions)) { $timeArr=array();
					foreach($rs_sessions as $kk=>$vv) {
						$bgcolor="#FFFFFF";
						if($kk%2==0) $bgcolor="#F5F5F5";
						$timeArr=explode(",", $vv->session_time);
				?>
                    <tr bgcolor="<?=$bgcolor?>">
                        <td align="left"><?=$vv->event_session_name?></td>
                        <td><?=date("M d, Y", strtotime($vv->session_date))?> <br />
							<?
								if(count($timeArr)>0) {
									foreach($timeArr as $k1=>$v1) {
										echo ($k1+1).") $v1 <br />";
									}
								}
							?>
                        </td>
                        <td><? if($vv->session_type=="P") { echo "Rs. ".$vv->session_amount."/-"; } else echo $GLOBALS['SessionType'][$vv->session_type]; ?></td>
                        <td><?=$vv->session_place?></td>
                        <td>
                        	<img src="images/arrow_close.png" alt="Open Details" title="Open Details" onclick="openSessionDesc(<?=$vv->id?>)" style="cursor:pointer;" id="opensessionimg<?=$vv->id?>" />
                            <img src="images/arrow_open.png" alt="Close Details" title="Close Details" onclick="openSessionDesc(<?=$vv->id?>)" id="closesessionimg<?=$vv->id?>" style="cursor:pointer; display:none;" />
                        </td>
                    </tr>
                    <tr id="sessiondesctab<?=$vv->id?>" style="display:none;">
                    	<td colspan="5"><?=$vv->session_description?></td>
                    </tr>
                <?
					}
				} else {
				?>
                	<tr><td colspan="5">No details found..!</td></tr>
                <?
				}
				?>
            </table>
        </td>
    </tr>
    <? } ?>
   
    <? if($rs_events->type_of_event=="R") { ?>
    <tr>
     	<td valign="top" id="eventregtab" style="padding:10px;"></td>
    </tr>
    <? } ?>
    
    <tr>
    	<td valign="top" style="padding:10px;">
        	<? include "view_gallery.php"; ?>
        </td>
    </tr>
    
</table>
</div>

<script type="text/javascript">
showEventRegList(<?=$eventId?>);
</script>

