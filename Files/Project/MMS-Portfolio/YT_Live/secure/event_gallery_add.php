<?
include "includes.php";
//select value from DB
$rs_event_gallery = EventPhotos::getEventPhotosByEventId($eventId);

if($rs_event->id>0) {
	$headName = "Update";
} else {
	$headName = "Add";
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

<div class="fullsize pad10">
<form name="eventgalleryfrm" id="eventgalleryfrm" method="post" enctype="multipart/form-data">
<input type="hidden" name="act" value="evtGalleryFrm" />
<input type="hidden" name="event_pdb_id" id="event_pdb_id" value="<?=$eventId?>" />
<input type="hidden" name="gallery_plus_count" id="gallery_plus_count" value="" />
<table border="0" cellpadding="0" cellspacing="0" class="tbl" width="98%" style="border:0px;">
    <tr>
        <td><h2><?=$headName?> Gallery</h2></td>
        <td align="right"><div class="combutton pull_right">Event list</div></td>
    </tr>
    
    <tr>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="schoolinnertbl">
          <tr>
            <td>Event Name <span class="txterror">*</span></td>
            <td><input type="text" class="txtbox" name="event_name" id="event_name" value="<?=$rs_event->event_name?>" /></td>
            
            <td>Event Date <span class="txterror">*</span></td>
            <td><input type="text" class="txtbox datepicker"  name="event_from_date" id="event_from_date" value="<?=($rs_event->event_from_date!="" && $rs_event->event_from_date!="1970-01-01")?$rs_event->event_from_date:""?>" /></td>
          </tr>
          
          <tr>
            <td valign="top">Description <span class="txterror">*</span></td>
            <td colspan="3"><textarea class="msgbox" name="event_desc" id="event_desc" style="width:980px; height:200px;"><?=stripslashes($rs_event->description)?></textarea></td>
          </tr>
        </table></td>
    </tr>
    
    <tr>
    	<td height="40" colspan="2"><h2>Galleries</h2></td>
    </tr>
    
    <tr>
        <td height="25" style="padding-top:5px;" colspan="2">
        	<div id="spFileLevelTop_new"></div>
            <div style="margin-top:10px; text-align:center; padding-right:30px;">		
            <span class="spancursor" id="spFileLevel_a_new" style="display: none" onclick="addFileTopLevel_new();">
            	<div class="pull_right txtbold f24 cursor">+</div>
            </span>
            </div> 
        </td>
    </tr>
    
    <tr>
    	<td style="padding-top:10px;" colspan="2">
        	<? if($rs_event->id>0) { $actionName = "Update"; } else { $actionName = "Add"; } ?>
            <div class="fullsize txtwhite txtcenter f18">
	            <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="savebtn" onClick="saveEventDtls('<?=$rs_event->id?>', event)"><strong><?=$actionName?></strong></div>
                <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10" id="loadingbtn" style="display:none;"><strong><?=$actionName?></strong></div>
            </div>
        </td>
    </tr>   
    
</table>
</form>
</div>


<script type="text/javascript">

function defaultLoader(){
	jQuery('#spFileLevelTop_new').empty().html('');
	var vhtm = new Array();
	var whtm = new Array();
	var i = 0;
	var j = 0;
<?

	if(is_array($rs_event_gallery) && count($rs_event_gallery)>0){
		foreach($rs_event_gallery as $k=>$v) {
?>
			//alert('<?=$fileNameStr1?>');
			addFileTopLevel_new({id:<?=$v->id?>, filetitle:unescape('<?=rawurlencode(htmlentities($v->photo_file))?>'), iscoverphoto:unescape('<?=rawurlencode(htmlentities($v->is_coverphoto))?>') });
			j++;
<?
		}
	}
	else {
?>
	addFileTopLevel_new();
<?
	}
?>

}
// for files
function addFileTopLevel_new(a){
	
	//alert(a.filepath);
	if(a==undefined) a={};
	if(a.id==undefined) a.id='';
	if(a.filetitle==undefined) a.filetitle='';
	if(a.iscoverphoto==undefined) a.iscoverphoto='';
	var cover_photo_check="";

	var row = jQuery('div.clvltopfile').length;
	
	if(a.iscoverphoto=="" && row=="0") {
		cover_photo_check = "checked";
	} else {
		if(a.iscoverphoto=="Y") {
			cover_photo_check = "checked";
		}
	}

	var vhtml = '';
	vhtml += '<div id="spFileLevel_'+row+'" class="clvltopfile" style="margin-top:10px; text-align:left; padding-left:0px;">';
	vhtml += '	<div style="border:#999999 1px solid; padding-top:5px; padding-bottom:5px; width:90%;" id="spFileLevel1_'+row+'" class="dfile" >';
	vhtml += '		<div><input type="hidden" name="gallery_db_id'+row+'" value="'+a.id+'" />';
	vhtml += '			<table border="0" cellpadding="4" cellspacing="0" align="center" width="98%">';
	vhtml += '				<tr>';
	vhtml += '					<td valign="top" align="left"><div><span style="float:left; padding-left:5px; padding:right:5px;"><input type="file" class="" id="event_photo'+row+'" name="event_photo_'+row+'" value="'+a.filetitle+'" /> '+a.filetitle+' <input type="hidden" class="" id="h_event_photo'+row+'" name="h_event_photo_'+row+'" value="'+a.filetitle+'" /></span>';
	vhtml += '					</td>';
	vhtml += '					<td><input type="radio" name="make_coverphoto'+row+'" class="make_coverphoto" id="make_coverphoto'+row+'" value="Y" '+cover_photo_check+' onclick="makeOtherUncheck(&quot;'+row+'&quot;)" /> Make Cover Photo';
	vhtml += '					</td>';
	vhtml += '				</tr>';
	vhtml += '			</table></div>';
	vhtml += '		<div style="float:right; position:relative;right:5px; bottom:5px" class="spancursor" id="spFileLevel_r_new" onclick="removeFileTopLevel_new('+row+', &quot;'+a.id+'&quot;);"><div class="pull_right txtbold f24 cursor">-</div></div>';
	vhtml += '		</div>';
	vhtml += '	</div>';
	vhtml += '</div>';
	jQuery('#spFileLevelTop_new').append(vhtml);
	
	$('#gallery_plus_count').val(jQuery('div.clvltopfile').length);

}

function makeOtherUncheck(row) {
	var rowcount = $('#gallery_plus_count').val();
	
	for(var i=0; i<rowcount; i++) {
		if(row==i) {
			$('#make_coverphoto'+i).attr('checked', true);
		} else {
			$('#make_coverphoto'+i).attr('checked', false);
		}
	}
}

function removeFileTopLevel_new(r, gallery_id){ 
	var i1;
	if(r==undefined){
		var row = jQuery('div.clvltopfile').length-1;
		jQuery('#spFileLevel_'+row).remove();
	}
	else{ 
	
		var msg = confirm("Are you sure want to delete this file..?");
		
		if(msg==true) {
			
			if(gallery_id!="" && gallery_id!=undefined) {
				ajax({
					a:'events',
					b:'act=deleteGalleryFile&galleryId='+gallery_id,
					c:function(){},
					d:function(data){ 
						alert('Deleted successfully');
					}
				});
			}
			
			row1 = jQuery('div.clvltopfile').length-1;
			jQuery('#spFileLevel_'+r).remove();
			$('#gallery_plus_count').val(row1);
			
			if(jQuery('div.dfile').length==0){ 
				for(i1=0;i1<100;i1++){
					if(jQuery('div.clvltopfile').length>0)
						jQuery('#spFileLevel_'+i1).remove();
					else
						i1 = 101;
				}
				addFileTopLevel_new();
			}
			
		}
	}
	if(jQuery('div.clvltopfile').length==0)
		addFileTopLevel_new();
}

jQuery(function(){
	jQuery('#spFileLevel_r_new').show();
	jQuery('#spFileLevel_a_new').show();
	defaultLoader();
})

function saveEventDtls(event_id, e){
	var err=0;
	if($("#event_name").val()=='') { err=1; $("#event_name").addClass("boxerror"); } else $("#event_name").removeClass("boxerror");
	if($("#event_desc").val()=='') { err=1; $("#event_desc").addClass("boxerror"); } else $("#event_desc").removeClass("boxerror");
	
	var imageCount = $('#gallery_plus_count').val();
	
	for(var i=0; i<imageCount;i++) {
		if($("#event_photo"+i).val()=='' && $("#h_event_photo"+i).val()=='') { err=1; $("#event_photo"+i).addClass("boxerror"); } else $("#event_photo"+i).removeClass("boxerror");
	}
		
	if(err==0){
		//document.eventgalleryfrm.submit();
		$('#savebtn').hide();
		$('#loadingbtn').show();
		var myfrm = document.getElementById('eventgalleryfrm');
		$.ajax({
			url: "events.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(myfrm), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
			cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
			{
				//alert(data); return false;
				$('#savebtn').show();
				$('#loadingbtn').hide();
				showEventsList('<?=$listType?>', event_id);
			}	        
		});
	}
}
	
</script>
