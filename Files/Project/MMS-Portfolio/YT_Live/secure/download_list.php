
<input type="hidden" name="school_db_id" id="school_db_id" value="<?=$schoolId?>" />
<input type="hidden" name="student_action_page" id="student_action_page" value="<?=$actionPage?>" />
<input type="hidden" name="student_list_page_limit" id="student_list_page_limit" value="<?=$page_limit?>" />
<div class="pull_left padlr10 padtb10 txtbold letterspac f18">Search By
    <select name="search_by" id="search_by" class="listbox" onchange="showSearchOption()">
        <option value="N">File Name</option>
   <!--     <option value="Id">File ID</option>-->
        <option value="All">Show All</option>
    </select>
    
    <span id="searchnametab" style="display:none;">
        <input type="text" name="search_by_name" id="search_by_name" value="" class="txtbox" placeholder="Enter File Name" />
        <input type="hidden" name="search_by_name_id" id="search_by_name_id" class="txtbox" value="" />
    </span>
   <!-- <span id="searchidtab" style="display:none;">
        <input type="text" name="search_by_id" id="search_by_id" value="" class="txtbox" placeholder="Enter File Id" />
    </span>-->
    <span> 
        <div class="combutton pull_right marginleft20" onclick="showFileDtls('<?=$schoolId?>', 'filename', 'ASC')" style="clear:both;">Search</div>
    </span>
    
</div>
	
<div class="pull_right padlr10 padtb10 txtbold letterspac f18">
	<img src="images/refresh_icon.png" alt="Refresh Records" title="Refresh Records" align="absmiddle" border="0" onclick="showSearchOption('R')" class="cursor" />
</div>

<div id="filelistdtltab" style="clear:both;"></div>



<script type="text/javascript">

$().ready(function() { 

	$("#search_by_name").autocomplete("search_details.php?search_type=file&type=name&school_id=<?=$schoolId?>&grade_id=<?=$gradeId?>",{ 
		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#search_by_name").result(function(event, data, formatted) {
		$("#search_by_name_id").val(data[1]);
		showFileDtls('<?=$schoolId?>', 'filename', 'ASC');	
	});
	
});

showSearchOption();
function showSearchOption(action) {
	
	var sOption = $('#search_by').val();
	$('#searchnametab').hide();
	$('#searchidtab').hide();
	$('#search_by_name_id').val('');
	$('#search_by_id').val('');
	
	
	if(action=="R") {
		$('#search_grade').val('');
		showFileDtls('<?=$schoolId?>', 'filename', 'ASC');
	}
	
	if(sOption=="N") {
		$('#searchnametab').show();
	} else if(sOption=="Id") {
		$('#searchidtab').show();
	} else if(sOption=="All") {
		showFileAll('filename', 'ASC');
	}
}

showFileDtls('<?=$schoolId?>', 'filename', 'ASC');


function showFileDtls(school_id, order_by, sort_by){ //alert(school_id); alert(order_by); alert(sort_by);
	
	if(order_by==undefined) order_by=""; else order_by=order_by;
	if(sort_by==undefined) sort_by=""; else sort_by=sort_by;
	
	var sschool_id = $.trim($('#school_db_id').val());
	if(school_id==undefined || school_id=='') school_id=sschool_id; else school_id=school_id;
	var grade_id;
	var action_page = $('#student_action_page').val();
	if(action_page=="Grade") grade_id = $('#student_grade_id').val();
	else grade_id = $('#search_grade').val();
	var student_list_page_limit = $('#student_list_page_limit').val();
	
	$('#filecountdtls').show();
	
	var search_by = $('#search_by').val();
	var search_by_name = $('#search_by_name').val();
	var search_by_name_id = $('#search_by_name_id').val();
	var search_by_id = $('#search_by_id').val();
	var search_by_all = $('#search_by_all').val();
	
	
	$("#filelistdtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
  	ajax({
		a:'downloads',
		b:'act=loadFileListDtls&gradeId='+grade_id+'&school_id='+school_id+'&orderBy='+order_by+'&sortBy='+sort_by+'&searchBy='+search_by+'&searchByName='+search_by_name+'&searchByNameId='+search_by_name_id+'&searchById='+search_by_id+'&searchByAll='+search_by_all+'&actionPage='+action_page+'&page_limit='+student_list_page_limit,		
		c:function(){},
		d:function(data){ //alert(dataArr);
			var dataArr = data.split('::::');
			$("#filelistdtltab").html(dataArr[0]);
			$("#filecount").html(dataArr[1]);
			$("#masterschoolname").html(dataArr[2]);
 		}			
	});
}

function showFileAll(order_by, sort_by){
	var search_by = $('#search_by').val();
	ajax({
		a:'downloads',
		b:'act=loadAllFile&orderBy='+order_by+'&sortBy='+sort_by+'&searchBy='+search_by+'&actionPage='+action_page+'&page_limit='+student_list_page_limit,		
		c:function(){},
		d:function(data){ alert(dataArr);
			var dataArr = data.split('::::');
			$("#filelistdtltab").html(dataArr[0]);
			$("#filecount").html(dataArr[1]);
			$("#masterschoolname").html(dataArr[2]);
 		}			
	});
	
}

function fileListPaging(page) {

	var school_db_id = $('#school_db_id').val();
	
	var grade_id;
	var action_page = $('#student_action_page').val();
	if(action_page=="Grade") grade_id = $('#student_grade_id').val();
	else grade_id = $('#search_grade').val();
	var student_list_page_limit = $('#student_list_page_limit').val(); 
	
	$('#filecountdtls').show();
	
	var search_by = $('#search_by').val();
	var search_by_name = $('#search_by_name').val();
	var search_by_name_id = $('#search_by_name_id').val();
	var search_by_id = $('#search_by_id').val();
	var search_by_email = $('#search_by_email').val();
	var student_list_page_limit = $('#student_list_page_limit').val();
	
	$("#filelistdtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
	ajax({
		a:'downloads',
		b:'act=loadFileListDtls&page='+page+'&gradeId='+grade_id+'&school_id='+school_db_id+'&searchBy='+search_by+'&searchByName='+search_by_name+'&searchByNameId='+search_by_name_id+'&searchById='+search_by_id+'&actionPage='+action_page+'&page_limit='+student_list_page_limit,
		c:function(){},
		d:function(data){
			var dataArr = data.split('::::');
			$("#filelistdtltab").html(dataArr[0]);
			$("#filecount").html(dataArr[1]);
			$("#masterschoolname").html(dataArr[2]);
		}
	});
}



</script>
