<input type="hidden" name="mas_teacher_status" id="mas_teacher_status" value="<?=$status?>" />
<div class="fullsize_pad padtb10 lineht1_8 border_bottom">
    <p class="pull_left marginright20">Search By</p>
    <select class="listbox" name="search_by" id="search_by" onChange="showSearchOptions();">
        <option value="N">Name</option>
        <option value="ID">ID</option>
        <option value="E">Email Address</option>
        <option value="All">Show All</option>
    </select>
    <script type="text/javascript">
	$('#search_by').val('<?=$searchBy?>');
	</script>
    
    <span id="rezSearchId" style="display:none;">
    <input type="text" style="margin:0 10px 0 10px; min-width:100px;" class="txtbox" id="mas_search_id" name="mas_search_id" value="<?=$searchById?>" placeholder="Enter Teacher #" />
    </span>
    <span id="rezSearchTxt" style="display:none;">
    <input type="text" style="margin:0 10px 0 10px; min-width:100px;" class="txtbox" id="mas_search_tname" name="mas_search_tname" value="<?=$searchByName?>" placeholder="Enter Name" onkeyup="document.getElementById('mas_search_tname_id').value=''" />
    <input type="hidden" value="" name="mas_search_tname_id" id="mas_search_tname_id" class="txtbox" />
    </span>
    <span id="rezSearchEmail" style="display:none;">
    <input type="text" style="margin:0 10px 0 10px; min-width:100px;" class="txtbox" id="mas_search_email" name="mas_search_email" value="<?=$searchById?>" placeholder="Enter Email Address" />
    </span>
    <div class="pull_right bgbrown txtwhite padtb5 padlr20 cursor" onClick="showTeacherListDtls('<?=$status?>', 'D')" style="margin-right:120px;"><strong>Search</strong></div>
</div>

<div>
	<div class="pull_right" style="margin-top:10px;">
    	<span class="cursor" onclick="showTeacherListDtls('<?=$status?>', 'D');"><u>Detailed View</u></span> / 
        <span style="margin-right:5px;" class="cursor" onclick="showTeacherListDtls('<?=$status?>', 'L');"><u>List View</u></span>
    </div>
</div>

<div class="teacherlist" id="teacherListTab" style="margin:0px; width:98%;"></div>

<script type="text/javascript">

showTeacherListDtls('<?=$status?>', '<?=$listType?>');

$().ready(function() { 

	$("#mas_search_tname").autocomplete("search_details.php?search_type=teacher&type=name&status=<?=$status?>",{ 
		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#mas_search_tname").result(function(event, data, formatted) {
		$("#mas_search_tname_id").val(data[1]);	
		showTeacherListDtls('<?=$status?>', 'D');
	});
	
});


showSearchOptions('<?=$searchBy?>');
function showSearchOptions(search_option) { //alert(search_option);
	var search_option = $('#search_by').val();
	
	$("#rezSearchId").hide();
	$("#rezSearchTxt").hide(); 
	$("#rezSearchEmail").hide();
	$("#mas_search_id").val('');
	$("#mas_search_tname_id").val('');
	$("#mas_search_tname").val('');
	$("#mas_search_email").val('');

	if(search_option=="ID") {
		$("#rezSearchId").show();
	} else if(search_option=="N") {
		$("#rezSearchTxt").show();
	} else if(search_option=="E") {
		$("#rezSearchEmail").show();
	} else if(search_option=="All") {
		showTeacherListDtls('<?=$status?>', 'D');
	}
	
}
</script>
    
