<?
$rs_events = Events::getEventsById($eventId);
$rs_galleries = EventPhotos::getEventPhotosByEventId($eventId);

/*if($rs_events->event_file!="") {
	$event_photo='../'.(EVENT_FILE_REL.$rs_events->event_file);
	$thumb_event_photo_name='../'.(EVENT_FILE_REL.'thumb_'.$rs_events->event_file);
	if(!file_exists($thumb_event_photo_name) || file_exists($thumb_event_photo_name)) 
	smart_resize_image($event_photo , null, 158 , 121 , true , $thumb_event_photo_name , false , false ,100 );
}*/

?>


<div class="fullsize">   
<input type="hidden" name="event_h_id" id="event_h_id" value="<?=$eventId?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="popuptbl">
   	<tr>
    	<th><strong>Galleries</strong>
        	<? if($GLOBALS['isUpdate']){ ?><div style="float:right; margin-top:10px;" class="cursor"><img src="images/edit_icon.png" alt="Edit Gallery" title="Edit Gallery" align="absmiddle" style="cursor:pointer;" id="editglryimg" onclick="editGalleryDtls(<?=$eventId?>)" /></div><? } ?>
        </th>
    </tr>
    <tr>
    	<td valign="top" id="gallerylisttab" style="padding:20px;">
        	<table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:0px;">
            	<tr>
                	<td><b>Total Photos :</b> <?=count($rs_galleries)?></td>
                </tr>
                
                <tr>
                	<? 
					$index = 1;	
					if(count($rs_galleries)>0) {
						foreach($rs_galleries as $gk=>$gv) {
							$rs_photo_cmts = EventPhotoComments::getPhotoCommentsByPhotoId($gv->id);
					?>
                    	<td valign="top" style="padding:5px;">
                        	<div style="border:1px solid #666; padding:10px; width:200px;">
                            	<div align="center"><a href="<?=EVENT_GALLERY_HREF.$gv->photo_file?>" target="_blank"><img src="resize.php?w=150&h=100&img=<?="../".EVENT_GALLERY_REL.$gv->photo_file?>" /></a></div>
                                <div align="right" style="margin-top:10px; cursor:pointer;" onclick="showGalleryCmts(<?=$gv->id?>)">View Comments(<?=count($rs_photo_cmts)?>)</div>
                            </div>
                        </td>
                    <?
						if($index%3==0) echo "</tr><tr>";  $index++;
						}
					} else {
					?>
                    	<td>Photos not yet added..! <a onclick="editGalleryDtls(<?=$eventId?>)" style="cursor:pointer;"><u>Click here</u></a> to add..!</td>
                    <?
					}
					?>
                </tr>
            </table>
        	
        </td>
    </tr>
    
</table>
</div>