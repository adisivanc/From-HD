<center>
 <table width="80%" border="0" cellspacing="0" cellpadding="0" class="approved_leavetbl">
              <tr>
                <td style="border-bottom:1px solid #dab791;">
                <input type="hidden" name="student_action_page" id="student_action_page" value="<?=$actionPage?>" />
                <input type="hidden" name="student_list_page_limit" id="student_list_page_limit" value="<?=$page_limit?>" />
				<input type="hidden" name="status" id="status" value="<?=$type?>" />                   
                 <div class="pull_left"><?=$title?></div>
                 </td>
              </tr>
              <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px auto;">
                    <tr>
                        <td>GRADE</td>
                        <td>NAME</td>
                        <td>DATE</td>
                        <td>ACTION</td>
                    </tr>
                      <?
					   if(count($rs_stdlevArr)>0)
                      foreach($rs_stdlevArr as $K=>$V)
                      {
                         $student_id=$V->student_id;
                         $rs_stu_detail=Student::getStudentById($student_id);
                         $student_name=$rs_stu_detail->first_name." ".$rs_stu_detail->middle_name." ".$rs_stu_detail->last_name;
                         $grade_id=$rs_stu_detail->grade_id;
                         $rs_grade=Grade::getGradeById($grade_id);
                         $gradeName=$rs_grade->grade_name;
                      ?>
                      <tr>
                        <td><?=$gradeName?>
                        
                        </td>
                        <td><?=$student_name?></td>
                       <td><?=date("F j, Y",strtotime($V->leave_date))?></td>
                        <td><? if($type=="p" || $type=="r"){?><div class="approvebtn" onclick="saveLeaveApplicant('<?=$V->id?>','<?=$V->school_id?>')"><img src="images/approve_icon.png" alt="Approved" /></div><? }?>
                        <? if($type==p || $type=='a'){?>
                        <div class="approvebtn" onclick="rejectLeaveApplicant('<?=$V->id?>','<?=$V->school_id?>')"><img src="images/reject_icon.png"  /></div>
                        <? }?></td>
                      </tr>
                      <tr>
                           <td colspan="4" style="color:#F00">
                            <?=$V->reason?>
                          </td>
                      </tr>
                      <?
                      }
                      ?>
                     
                    </table>
            
                </td>
              </tr>
              <?
		
               if($rsPagination!=''){
				   ?>
              <tr>
                <td colspan="2" style="background:#eeeeee;padding:10px;"><?=$rsPagination?>                   
                </td>
              </tr>
              <?
			   }
			  ?>
            </table>
</center>
<script type="text/javascript">

function studentLeaveListPaging(page) {
	var action_page = $('#student_action_page').val();
	var student_list_page_limit = $('#student_list_page_limit').val(); 
	var status=$('#status').val();
	/*
	var school_db_id = $('#school_db_id').val();
	
	var grade_id;
	
	if(action_page=="Grade") grade_id = $('#student_grade_id').val();
	else grade_id = $('#search_grade').val();
	
	$('#studentcountdtls').show();
	
	var search_by = $('#search_by').val();
	var search_by_name = $('#search_by_name').val();
	var search_by_name_id = $('#search_by_name_id').val();
	var search_by_id = $('#search_by_id').val();
	var search_by_email = $('#search_by_email').val();
	var student_list_page_limit = $('#student_list_page_limit').val();
	*/
	$("#studentslistdtltab").html('<div class="loadingimg"><img src="images/loader.gif" alt="Loading..." title="Loading.." /></div>');
	
	ajax({
		a:'leave_process',
		b:'act=showPendingdDetail&page='+page+'&actionPage='+action_page+'&page_limit='+student_list_page_limit+'&status='+status,
		c:function(){},
		d:function(data){
			$("#leave_content").html(data);
		}
	});
}

</script>