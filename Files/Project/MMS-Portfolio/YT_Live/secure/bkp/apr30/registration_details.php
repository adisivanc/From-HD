<?
$arrayCount = count($rs_regs);
$arraySliceCount = count($rs_regsArr);
		
if($arrayCount>0 && $totalPages > 1) { 
	$table_val = generatePagination($functionName="eventRegList", $arrayCount, $arraySliceCount, $pageLimit=$PageLimit, $adjacent=1, $page=$page, $type=$_POST['tabType']);
}

?>
<input type="hidden" name="reg_page_number" id="reg_page_number" value="<?=$page?>" />
<div class="fullsize">
    <div class="pull_left"><b>Registration Details</b></div>
</div>

<div class="fullsize">
	<div class="pull_left margin10">
    Search By: 
    <select style="width:150px;" class="listbox" id="searchType" name="searchType" onchange="show_type()">
        <option value="">Select</option>
        <option <? if($_POST['searchType']=="name"){ ?>selected="selected"<? } ?> value="name">Name</option>
        <option <? if($_POST['searchType']=="emailaddress"){ ?>selected="selected"<? } ?>value="emailaddress">Email Address</option>
        <option <? if($_POST['searchType']=="id"){ ?>selected="selected"<? } ?>value="id">Reg Id</option>
        <option <? if($_POST['searchType']=="session"){ ?>selected="selected"<? } ?>value="session">Session</option>
        <option <? if($_POST['searchType']=="date"){ ?>selected="selected"<? } ?>value="date">Date</option>
    </select>
    
    <span id="showTxt" <? if($_POST['searchType']!="name"){ ?> style="display:none" <? }?>>
    <input type="text" class="reg_name txtbox" id="searchTxt" name="searchTxt" value="<?=$_POST['searchTxt']?>" placeholder="Enter Name" />
    </span>
    <span <? if($_POST['searchType']!="emailaddress"){ ?> style="display:none" <? }?> id="showEmail">
    <input type="text" class="email_address txtbox" id="searchTxt_emailaddress" name="searchTxt_emailaddress" value="<?=$_POST['searchTxt_emailaddress']?>" placeholder="Enter Email" />
    </span>		
    <span <? if($_POST['searchType']!="id"){ ?> style="display:none" <? }?> id="showId">
    <input type="text" class="txtbox" id="searchTxt_id" name="searchTxt_id" value="<?=$_POST['searchTxt_id']?>" placeholder="Enter Registration Id" />
    </span>
    <span <? if($_POST['searchType']!="session"){ ?> style="display:none" <? }?>  id="showSession">
    <input type="text" class="session txtbox" id="searchTxt_session" name="searchTxt_session" value="<?=$_POST['searchTxt_session']?>" placeholder="Enter Session" />
    </span>
    <span <? if($_POST['searchType']!="date"){ ?> style="display:none" <? }?>  id="showDate">
    <input type="text" class="txtbox search_session_date_picker" id="searchTxt_fromDate" name="searchTxt_fromDate" value="<?=$_POST['searchTxt_fromDate']?>" placeholder="Enter From Date" />&nbsp;
    <input type="text" class="txtbox search_session_date_picker" id="searchTxt_toDate" name="searchTxt_toDate" value="<?=$_POST['searchTxt_toDate']?>" placeholder="Enter To Date" />
    </span>
    <input type="hidden" id="searchId" name="searchId"/>
 	<div class="combutton pull_right marginleft20 cursor" onclick="gen_search('<?=$_POST['eventId']?>')"><strong>Search</strong></div>
    </div>
     
    <div class="pull_right">
        <!--<div class="combutton pull_right marginleft10" onclick="printList('eventregtab')">Print</div>-->
        <div class="combutton pull_right" onclick="printList('sessionlist')">
        <a href="generateCSV.php?filename=EventReg&EventId=<?=$_POST['eventId']?>&searchType=<?=$_POST['searchType']?>&searchTxt=<?=$_POST['searchTxt']?>&searchTxt_emailaddress=<?=$_POST['searchTxt_emailaddress']?>&searchTxt_id=<?=$_POST['searchTxt_id']?>&session_id=<?=$_POST['session_id']?>&searchTxt_fromDate=<?=$_POST['searchTxt_fromDate']?>&searchTxt_toDate=<?=$_POST['searchTxt_toDate']?>" style="color:#FFF;">Export</a>
        </div>
    </div>
    
</div>
            
<table border="0" cellpadding="0" cellspacing="0" class="gradetbl" width="100%" style="border:0px;">
    <tr style="font-weight:bold; font-size:16px;" bgcolor="#E4C6A0">
        <th width="5%" align="center" style="color:#FFF;">#</th>
        <th width="17%" style="color:#FFF;">Name / Gender</th>
        <th width="13%" style="color:#FFF;">Email / Phone</th>
        <th width="15%" style="color:#FFF;">Child Name/Age</th>
        <th width="25%" style="color:#FFF;">Session Details</th>
        <th width="14%" align="center" style="color:#FFF;">Total Amount</th>
        <th width="11%" style="color:#FFF;">Action</th>
    </tr>
    <?
    if(count($rs_regsArr)>0) {
        foreach($rs_regsArr as $rk=>$rv) {
            $bgcolor="#FFFFFF";
            if($rk%2==0) $bgcolor="#E5F1FE";
            $rs_etss = EventRegistration::getEventSessionRegByRegId($rv->id);  
			
			$sessionArr = array();
			if(count($rs_etss)>0) {
				foreach($rs_etss as $sk=>$sv) {
					$sessionArr[$sv->event_date][] = $sv->event_session_id."~".$sv->session_time;
				}
			}
			 
    ?>
        <tr bgcolor="<?=$bgcolor?>">
            <td align="center" valign="top"><?=$rv->id?></td>
            <td valign="top"><?=$rv->reg_name?><br /><?=$rv->reg_gender?></td>
            <td valign="top"><?=$rv->reg_email_address?><br /><?=$rv->reg_phone?></td>
            <td valign="top"><?=ucfirst($rv->reg_child_name)?><br /><strong>Age :</strong><?=$rv->reg_child_age?></td>
            <td valign="top">
                <? 
                if(count($sessionArr)>0) {
                    foreach($sessionArr as $esk=>$esv) { 
                ?>
                    <div><b><?=date("M d, Y", strtotime($esk))?></b></div>
                    <? if(count($esv)>0) { 
                        foreach($esv as $k1=>$v1) { $v1Arr = explode("~", $v1); $rs_event_session = EventSession::getSessionById($v1Arr[0]); ?>
                    	<div><?=($k1+1)?>) <?=$rs_event_session->event_session_name?> <br /> <?=$v1Arr[1]?></div>
                    <? }
                    } ?>
                <?
                    }
                }
                ?>
            </td>
            <td align="center" valign="top"><? if($rv->total_amount=="" || $rv->total_amount=="0.00") echo "FREE"; else echo "Rs. ".number_format($rv->total_amount,"",".","")."/-"; ?></td>
            <td valign="top">
            <div class="btn_group">
                  <? if($GLOBALS['isView']){ ?><a class="view_btn" title="View" onclick="viewRegDtls(<?=$rv->id;?>)"></a><? }?>
                  <? if($GLOBALS['isDelete'] && $_SESSION['UserType']=="SA"){ ?>
                  <a class="delete_btn" title="Delete" onclick="if(confirm('Are you sure want to delete Registration?')) deleteRegDtls(<?=$rv->id;?>)"></a><? }?>
             </div>
            </td>
        </tr>
    <?
        }
		
		if($table_val!='') {
		?>
		<tr bgcolor="#FFFFFF" height="39" >
			<td colspan="7" style="padding-right:15px;" class="font_bold"><?=$table_val?></td>
		</tr>
			<?
		}
		
    } else {
    ?>
        <tr><td colspan="7" align="center">No details found..!</td></tr>
    <?
    }
    ?>
</table>
<script>

$(".search_session_date_picker").datepicker({
		changeMonth: true
	}); 

 $().ready(function() { 
 	$("#searchTxt").autocomplete("autocomplete_details.php?search_type=parent_name",{ 
 		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#searchTxt").result(function(event, data, formatted) {
		$("#searchId").val(data[1]);
     	});
 });
 $().ready(function() { 
 	$("#searchTxt_emailaddress").autocomplete("autocomplete_details.php?search_type=email_address",{ 
 		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#searchTxt_emailaddress").result(function(event, data, formatted) {
		$("#searchId").val(data[1]);
     	});
 });
 $().ready(function() { 
 	$("#searchTxt_session").autocomplete("autocomplete_details.php?search_type=session",{ 
 		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#searchTxt_session").result(function(event, data, formatted) {
		$("#searchId").val(data[1]);
     	});
 });
</script>