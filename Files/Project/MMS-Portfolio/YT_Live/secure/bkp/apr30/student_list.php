<input type="hidden" name="school_db_id" id="school_db_id" value="<?=$schoolId?>" />
<input type="hidden" name="student_action_page" id="student_action_page" value="<?=$actionPage?>" />
<input type="hidden" name="student_list_page_limit" id="student_list_page_limit" value="<?=$page_limit?>" />
<div class="pull_left padlr10 padtb10 txtbold letterspac f18">Search By
    <select name="search_by" id="search_by" class="listbox" onchange="showSearchOption()">
        <option value="N">Name</option>
        <option value="Id">ID</option>
        <option value="E">Email Address</option>
        <option value="All">Show All</option>
    </select>
    
    <span id="searchnametab" style="display:none;">
        <input type="text" name="search_by_name" id="search_by_name" value="" class="txtbox" placeholder="Enter Student Name" />
        <input type="hidden" name="search_by_name_id" id="search_by_name_id" class="txtbox" value="" />
    </span>
    <span id="searchidtab" style="display:none;">
        <input type="text" name="search_by_id" id="search_by_id" value="" class="txtbox" placeholder="Enter Student Id" />
    </span>
    <span id="searchemailtab" style="display:none;">
        <input type="text" name="search_by_email" id="search_by_email" value="" class="txtbox" placeholder="Enter Email Address" />
    </span>
    <span>
        <div class="combutton pull_right marginleft20" onclick="showStudentDtls('<?=$schoolId?>', 'first_name', 'ASC')" style="clear:both;">Search</div>
    </span>
    
</div>
<div class="pull_right padlr10 padtb10 txtbold letterspac f18">
	<img src="images/refresh_icon.png" alt="Refresh Records" title="Refresh Records" align="absmiddle" border="0" onclick="showSearchOption('R')" class="cursor" />
</div>

<div id="studentslistdtltab" style="clear:both;"></div>



<script type="text/javascript">

$().ready(function() { 

	$("#search_by_name").autocomplete("search_details.php?search_type=student&type=name&school_id=<?=$schoolId?>&grade_id=<?=$gradeId?>",{ 
		width:'auto',selectFirst: false,
		select: function(event, ui) { alert(event); }});	
	$("#search_by_name").result(function(event, data, formatted) {
		$("#search_by_name_id").val(data[1]);
		showStudentDtls('<?=$schoolId?>', 'first_name', 'ASC');	
	});
	
});

showSearchOption();
function showSearchOption(action) {
	
	var sOption = $('#search_by').val();
	$('#searchnametab').hide();
	$('#searchidtab').hide();
	$('#searchemailtab').hide();
	$('#search_by_name_id').val('');
	$('#search_by_id').val('');
	$('#search_by_email').val('');
	
	if(action=="R") {
		$('#search_grade').val('');
		showStudentDtls('<?=$schoolId?>', 'first_name', 'ASC');
	}
	
	if(sOption=="N") {
		$('#searchnametab').show();
	} else if(sOption=="Id") {
		$('#searchidtab').show();
	} else if(sOption=="E") {
		$('#searchemailtab').show();
	} else if(sOption=="All") {
		showStudentDtls('<?=$schoolId?>', 'first_name', 'ASC');
	}
}

showStudentDtls('<?=$schoolId?>', 'first_name', 'ASC');

function showStudentDtls(school_id, order_by, sort_by){ //alert(school_id); alert(order_by); alert(sort_by);
	
	if(order_by==undefined) order_by=""; else order_by=order_by;
	if(sort_by==undefined) sort_by=""; else sort_by=sort_by;
	
	var sschool_id = $.trim($('#school_db_id').val());
	if(school_id==undefined || school_id=='') school_id=sschool_id; else school_id=school_id;
	
	var grade_id;
	var action_page = $('#student_action_page').val();
	if(action_page=="Grade") grade_id = $('#student_grade_id').val();
	else grade_id = $('#search_grade').val();
	var student_list_page_limit = $('#student_list_page_limit').val();
	
	$('#studentcountdtls').show();
	
	var search_by = $('#search_by').val();
	var search_by_name = $('#search_by_name').val();
	var search_by_name_id = $('#search_by_name_id').val();
	var search_by_id = $('#search_by_id').val();
	var search_by_email = $('#search_by_email').val();
	
	$("#studentslistdtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
  	ajax({
		a:'students',
		b:'act=loadStudentsListDtls&gradeId='+grade_id+'&schoolId='+school_id+'&orderBy='+order_by+'&sortBy='+sort_by+'&searchBy='+search_by+'&searchByName='+search_by_name+'&searchByNameId='+search_by_name_id+'&searchByEmail='+search_by_email+'&searchById='+search_by_id+'&actionPage='+action_page+'&page_limit='+student_list_page_limit,		
		c:function(){},
		d:function(data){ //alert(data);
			var dataArr = data.split('::::');
			$("#studentslistdtltab").html(dataArr[0]);
			$("#studentscount").html(dataArr[1]);
			$("#masterschoolname").html(dataArr[2]);
 		}			
	});
}

function studentListPaging(page) {

	var school_db_id = $('#school_db_id').val();
	
	var grade_id;
	var action_page = $('#student_action_page').val();
	if(action_page=="Grade") grade_id = $('#student_grade_id').val();
	else grade_id = $('#search_grade').val();
	var student_list_page_limit = $('#student_list_page_limit').val(); 
	$('#studentcountdtls').show();
	
	var search_by = $('#search_by').val();
	var search_by_name = $('#search_by_name').val();
	var search_by_name_id = $('#search_by_name_id').val();
	var search_by_id = $('#search_by_id').val();
	var search_by_email = $('#search_by_email').val();
	var student_list_page_limit = $('#student_list_page_limit').val();
	
	$("#studentslistdtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
	ajax({
		a:'students',
		b:'act=loadStudentsListDtls&page='+page+'&gradeId='+grade_id+'&schoolId='+school_db_id+'&searchBy='+search_by+'&searchByName='+search_by_name+'&searchByNameId='+search_by_name_id+'&searchByEmail='+search_by_email+'&searchById='+search_by_id+'&actionPage='+action_page+'&page_limit='+student_list_page_limit,
		c:function(){},
		d:function(data){
			var dataArr = data.split('::::');
			$("#studentslistdtltab").html(dataArr[0]);
			$("#studentscount").html(dataArr[1]);
			$("#masterschoolname").html(dataArr[2]);
		}
	});
}

function showGradeforUpgrade(grade_id) {
	
	var err=0;
	var studentIds = $('input[class=upgrade_student_list]:checked').map(function(){
		return this.value;
	}).get();
	var school_id = $('#master_school_id').val();
	var grade_section = $('#master_grade_section').val();

	if(studentIds=="" || studentIds==undefined) {
		alert('Please select rows'); return false;
	}
	
	ajax({
		a:'grade',
		b:'act=loadGradeforUpgrade&studentIds='+studentIds+'&schoolId='+school_id+'&gradeSection='+grade_section+'&grade_id='+grade_id,		
		c:function(){},
		d:function(data){
			popupDtls(data);
		}			
	});
	
	
}

function upgradeStudentGrade(student_ids, grade_id, action) {
	
	var err=0, new_grade_id='';
	var school_id = $('#master_school_id').val();
	var grade_section = $('#master_grade_section').val();
	var studentIds = $('input[class=upgrade_student_list]:checked').map(function(){
		return this.value;
	}).get();

	if(action=="N") {
		if($('#upgrade_grade_id').val()=='') { err=1; $('#upgrade_grade_id').addClass('boxerror'); } else { new_grade_id = $.trim($('#upgrade_grade_id').removeClass('boxerror').val()); }
	}
	
	if(new_grade_id=="" || new_grade_id==undefined) new_grade_id = grade_id; else new_grade_id = new_grade_id; 
	
	if(err==0) {
		ajax({
			a:'grade',
			b:'act=updateStudentGrade&gradeId='+grade_id+'&studentIds='+studentIds+'&schoolId='+school_id+'&gradeSection='+grade_section+'&newGradeId='+new_grade_id,		
			c:function(){},
			d:function(data){ //alert(data); return false;
				alert('Updated Successfully..!');
				closePopup();
				//showGradeStudents('S', grade_id);
				showGradebySchl(school_id);
			}			
		});
	}
}

function showNewStudentOption(grade_id, type) {
	
	var err=0;
	var studentIds = $('input[class=upgrade_student_list]:checked').map(function(){
		return this.value;
	}).get();
	var school_id = $('#master_school_id').val();
	var grade_section = $('#master_grade_section').val();

	if(studentIds=="" || studentIds==undefined) {
		alert('Please select rows'); return false;
	}
	ajax({
		a:'grade',
		b:'act=loadAllGradeStudents&studentIds='+studentIds+'&schoolId='+school_id+'&gradeSection='+grade_section+'&grade_id='+grade_id+'&type='+type,		
		c:function(){},
		d:function(data){
			popupDtls(data);
		}			
	});
}

function updateNewStudent(grade_id, type) {
	
	var err=0;
	var school_id = $('#master_school_id').val();
	var grade_section = $('#master_grade_section').val();
	var studentIds = $('input[class=new_student]:checked').map(function(){
		return this.value;
	}).get();
	
	if($('#new_batch_year').val()=='') { err=1; $('#new_batch_year').addClass('boxerror'); } else { var new_batch = $.trim($('#new_batch_year').removeClass('boxerror').val()); }
	
	if(err==0) {
		$('#processBtn').show();
		$('#saveBtn').hide();
		ajax({
			a:'grade',
			b:'act=setNewStudents&gradeId='+grade_id+'&studentIds='+studentIds+'&schoolId='+school_id+'&gradeSection='+grade_section+'&newBatch='+new_batch+'&type='+type,		
			c:function(){},
			d:function(data){ //alert(data); return false;
				alert('Updated Successfully..!');
				$('#processBtn').hide();
				$('#saveBtn').show();
				closePopup();
				showGradeStudents('S', grade_id);
			}			
		});
	}
}

</script>
