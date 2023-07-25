<div class="fullsize_pad padtb10 lineht1_8 border_bottom">
    <p class="pull_left marginright20">Search By</p>
    <select class="listbox" name="search_by" id="search_by" onChange="showSearchOptions();">
        <option value="N">Name</option>
        <option value="ID">ID</option>
    </select>
    <script type="text/javascript">
	$('#search_by').val('<?=$searchBy?>');
	</script>
    
    <span id="rezSearchId" style="display:none;">
    <input type="text" style="margin:0 10px 0 10px; min-width:100px;" class="txtbox" id="mas_search_id" name="mas_search_id" value="<?=$searchById?>" placeholder="Enter Reservation #" />
    </span>
    <span id="rezSearchTxt" style="display:none;">
    <input type="text" style="margin:0 10px 0 10px; min-width:100px;" class="txtbox" id="mas_search_tname" name="mas_search_tname" value="<?=$searchByName?>" placeholder="Enter Name" onkeyup="document.getElementById('mas_search_tname_id').value=''" />
    <input type="hidden" value="" name="mas_search_tname_id" id="mas_search_tname_id" />
    </span>
    <div class="pull_right bgbrown txtwhite padtb5 padlr20 cursor" onClick="showTeacherDtls('TL', '', '<?=$status?>');" style="margin-right:120px;"><strong>Search</strong></div>
</div>

<div class="teacherlist">

	<?
	$teacher_obj = new Teacher();
	if($_SESSION['SchoolId']!='A') $teacher_obj->school_id=$_SESSION['SchoolId'];
	if($searchById!="" && $searchById!="undefined") $teacher_obj->search_id=$searchById;
	if($searchByName!="" && $searchByName!="undefined") $teacher_obj->name_search=$searchByName;
	$teacher_obj->sortby="DESC";
	$teacher_obj->sortby="DESC";
	$teacher_obj->orderby="id";
	$teacher_obj->teacher_status=$status;
	$rs_teacher = $teacher_obj->getTeachersDtls();
	
	if(count($rs_teacher)>0) {
		foreach($rs_teacher as $k=>$v) {
			$rs_subject = Subject::getSubjectsByIds($v->subject_id);
			$subjects = implode(", ", $rs_subject);
			$teacher_name = $v->prefix.".".$v->first_name." ".$v->middle_name." ".$v->last_name;
			$teacher_name = trim($teacher_name);
		?>
        <div class="teacherlist_inner cursor" id="teacher_deatils1">
            <div style="width:100%; height:150px; border:1px solid #999999;" onclick="showTeacherDtls('TD', '<?=$v->id?>', '<?=$v->teacher_status?>');">
            	<img src="<?=TEACHERS_FILE_HREF.$v->photo?>" alt="<?=$teacher_name?>" title="<?=$teacher_name?>" height="150px" width="100%" />
            </div>	
            <h4><?=$teacher_name?></h4>
            <h5><?=$subjects?></h5>
        </div>
        <?
		}
	} else {
		echo "No results found..!";
	}
	?>
</div>

<script type="text/javascript">

$().ready(function() { 

	$("#mas_search_tname").autocomplete("search_details.php?search_type=teacher&type=name&status=<?=$status?>",{ 
		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#mas_search_tname").result(function(event, data, formatted) {
		$("#mas_search_tname_id").val(data[1]);	
	});
	
});


showSearchOptions('<?=$searchBy?>');
function showSearchOptions(search_option) { //alert(search_option);
	var search_option = $('#search_by').val();
	
	$("#rezSearchId").hide();
	$("#rezSearchTxt").hide(); 

	if(search_option=="ID") {
		$("#rezSearchId").show();
		$("#mas_search_id").val('');
	} else if(search_option=="N") {
		$("#rezSearchTxt").show();
		$("#mas_search_tname").val('');
	}
	
}
</script>
    
