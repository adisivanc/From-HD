<? 
include "includes.php";
?> 
<style>
.lablebox { float:left; background-color:#F4F4F4; border:1px solid #D8D8D8; border-left:none; padding:10px; cursor:pointer; color:#222222; font-size:12px; }
.blogtxt { font-size:12px; color:#39F; cursor:pointer; }
</style>


<div class="fullsize lineht2 border_bottom" id="blogcountdtls">
    <div class="pull_left padlr10 padtb10 txtbold letterspac f18"><?=ucfirst($tabType)?> Events</div>
    <div class="pull_right padlr10 padtb10 txtbold letterspac f18">Total Events: <?=count($rs_events)?></div>
</div>

<input type="hidden" name="event_list_type" id="event_list_type" value="<?=$_POST['tabType']?>" />

<div class="fullsize">
    <div id="blogslisttab">
    <input type="hidden" name="blogpost_school_id" id="blogpost_school_id" value="<?=$schoolId?>">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td valign="top" class="border_theme" style="border-bottom:0px; border-left:0px; border-top:0px;" width="30%">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td> 
                            <table width="100%" border="0" class="gradetbl" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td colspan="2">
                                    	<input type="text" class="txtbox" name="search_event_name" id="search_event_name" placeholder="Enter Event Name" />
                                    </td>
                                </tr>
                                
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
                                	<tr style="<?=$bgcolor?>">
                                        <td align="left" class="cursor"><a onclick="showEventListDlts(<?=$vv->id?>);" style="cursor:pointer;"><?=$vv->event_name?></a></td>
										<td width="35%" align="right"><img src="images/comment_icon.png" align="absmiddle" alt="Event Comments" title="Event Comments" onclick="showEventCmdPopup('<?=$vv->id?>')" class="cursor" /> (<?=count($rs_evnt_cmts)?>)</td>
                                    </tr>
								<?
									}
									if($table_val!='') { ?><tr><td colspan="2"><?=$table_val?></td></tr><? }
									
								} else {
								?>
									<tr><td colspan="2">No events found..!</td></tr>
								<?
								}
								?>
                                
                            </table>
                           
                        </td>
                    </tr>		
                </table>
            </td>
        
            <td width="70%" valign="top" align="left" style="padding-left:10px; padding-right:10px;" id="eventlistdtls">
                
            
            </td>
        </tr>
    </table>
	</div>
</div>

<script type="text/javascript">

$().ready(function() { 
	$("#search_event_name").autocomplete("search_details.php?search_type=event&type=name&event_type=<?=$_POST['tabType']?>",{ 
		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#search_event_name").result(function(event, data, formatted) {
		$("#search_event_name_id").val(data[1]);
		showEventListDlts(data[1]);
	});
});

showEventListDlts('<?=$rs_eventsArr[$StartIndex]->id?>');
</script>