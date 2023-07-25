<?
include "includes.php";
?>

<style type="text/css">
table.calendar_tbl, table.cal_top_tbl{font-family:open_sanssemibold; font-size:15px; line-height:20px; float:left; }
table.calendar_tbl tr td { font-family:open_sanssemibold; font-size:12px; line-height:20px; border-left:#FFFFFF 1px solid; border-bottom:#FFFFFF 1px solid; width:50px; height:38px; padding:0px; }
table.calendar_tbl tr td:first-child { border-left:none;font-family: 'open_sanssemibold'; }
table.calendar_tbl tr:first-child td { height:30px; background-color:#69c4e5; }
table.calendar_tbl tr:last-child td { border-bottom:none; }
table.cal_top_tbl{background-color:#32a9d4; color:#000; font-family:open_sanssemibold; width:99.7%; height:40px;  margin:0px; padding:2px 2px;  }
table.calendar_tbl td.empty{background-color:#ffffff; font-family:open_sanssemibold;}
table.calendar_tbl td.selected{font-weight:bold}
table.calendar_tbl div.cal_inner_default{width:39px; font-family: 'open_sansregular'; color:#000; height:39px; padding:2px; background:#ebebeb; cursor:pointer; }
table.calendar_tbl div.cal_inner_cur{color:#fff; font-family: 'open_sansregular'; font-weight:normal; width:39px; height:39px; padding:2px; background:#d2d2d2; cursor:pointer; }
</style>
<input type="hidden" name="year" id="year" value="<?=date('Y')?>" />
<input type="hidden" name="month" id="month" value="<?=date('m')?>" />
<input type="hidden" name="tree_company_id" id="tree_company_id" value="<?=$_POST['tree_company_id']?>" />
<input type="hidden" name="user_id" id="user_id" value="<?=$_POST['user_id']?>" />

<input type="hidden" name="day" id="day" value="<?=date('d')?>" />
<input type="hidden" name="currmn" id="currmn" value="<?=date('m')?>" />
<input type="hidden" name="curryr" id="curryr" value="<?=date('Y')?>" />

<div id="calendarview"></div>
<!--<div id="job_list_td"></div>-->
<div style="display:none; padding:2px 1px;" id="popup_job"></div>
<div style="display:none; padding:0px 0px;" id="popup_detailed_job"></div>
<div style="display:none; padding:2px 1px;" id="popup_add_notes"></div>

<script>

$(document).ready(function(){
	var month = $('#month').val();
	var year = $('#year').val();
	callViewCalendar(month,year);
	
	var day = $.trim($('#day').val());
	var currmn = $.trim($('#currmn').val());
	var curryr = $.trim($('#curryr').val());

});

function callViewCalendar(month,year) {
   
   var tree_company_id = $('#tree_company_id').val();
   var user_id = $('#user_id').val();
	   
	ajax({
		a:'calendarView',
		b:'month='+month+'&year='+year+'&tree_company_id='+tree_company_id+'&user_id='+user_id,
		c:function(){},
		d:function(data){
			$('#calendarview').html(data);
			showUpEventDtls("", month, year);
		}
	});
	
}


</script>


