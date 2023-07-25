<div class="leave_content">
                    	<table width="90%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;  border:1px solid #dab791;">
                          <tr>
                            <td style=" text-indent:15px;">Staff</td>
                          </tr>
                          <tr>
                            <td>
                            	<div class="leave_content1" onclick="">
                                    <table width="84%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; text-align:center; border:1px solid #dab791;">
                                      <tr>
                                        <td>3</td>
                                      </tr>
                                      <tr>
                                        <td style="background:#dab791;">Pending</td>
                                      </tr>
                                    </table>
                                </div>
                            	<div class="leave_content1" onclick="">
                                    <table width="84%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; text-align:center; border:1px solid #dab791;">
                                      <tr>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td style="background:#dab791;">Approved</td>
                                      </tr>
                                    </table>
                                </div>
                            	<div class="leave_content1">
                                    <table width="84%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; text-align:center; border:1px solid #dab791;">
                                      <tr>
                                        <td>1</td>
                                      </tr>
                                      <tr>
                                        <td style="background:#dab791;">Rejected</td>
                                      </tr>
                                    </table>
                                </div>
                            </td>
                          </tr>
                        </table>
                    </div>
                    <div class="leave_content">
                    	<table width="90%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;  border:1px solid #dab791;">
                          <tr>
                            <td style=" text-indent:15px;">Student</td>
                          </tr>
                          <tr>
                            <td>
                            	<div class="leave_content1" onclick="showPendingdDetail('p')">
                                    <table width="84%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; text-align:center; border:1px solid #dab791;">
                                      <tr>
                                        <td><?=count($rs_stdlev_pen)?></td>
                                      </tr>
                                      <tr>
                                        <td style="background:#dab791;">Pending</td>
                                      </tr>
                                    </table>
                                </div>
                            	<div class="leave_content1" onclick="showPendingdDetail('a')">
                                    <table width="84%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; text-align:center; border:1px solid #dab791;">
                                      <tr>
                                        <td><?=count($rs_stdlev_app)?></td>
                                      </tr>
                                      <tr>
                                        <td style="background:#dab791;">Approved</td>
                                      </tr>
                                    </table>
                                </div>
                            	<div class="leave_content1" onclick="showPendingdDetail('r')">
                                    <table width="84%" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto; text-align:center; border:1px solid #dab791;">
                                      <tr>
                                        <td><?=count($rs_stdlev_rej)?></td>
                                      </tr>
                                      <tr>
                                        <td style="background:#dab791;">Rejected</td>
                                      </tr>
                                    </table>
                                </div>
                            </td>
                          </tr>
                        </table>
                    </div>


<div id="approved_leaves" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">
			

<table width="700" border="0" cellspacing="0" cellpadding="0" class="approved_leavetbl">
  <tr>
    <td style="border-bottom:1px solid #dab791;">
    	<div class="pull_left">Approve The Leaves</div>
        <div class="pull_right closeicon" onClick="close_approved_leaves()"><strong>X</strong></div>
    </td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px auto;">
        <tr>
        	<td>GRADE</td>
            <td>NAME</td>
            <td>REASON</td>
            <td>DATE</td>
            <td>ACTION</td>
        </tr>
          <?
		   if(count($rs_stdlev_pen)>0)
		  foreach($rs_stdlev_pen as $K=>$V)
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
            <td><?=$V->reason?></td>
            <td><?=date("F j, Y",strtotime($V->leave_date))?></td>
            <td><div class="approvebtn" onclick="saveLeaveApplicant('<?=$V->id?>')">Approve</div></td>
          </tr>
          <?
          }
		  ?>
         
        </table>

    </td>
  </tr>
  <tr>
    <td style="background:#eeeeee;">
    	<div class="pull_left">Showing 1 of 4 of 10 Entites</div>
        <div class="pull_right"></div>
    </td>
  </tr>
</table>




</div>


<div id="pending_leave" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">	

            <table width="700" border="0" cellspacing="0" cellpadding="0" class="approved_leavetbl">
              <tr>
                <td style="border-bottom:1px solid #dab791;">
                    <div class="pull_left">Approved Leaves</div>
                    <div class="pull_right closeicon" onClick="close_pending_leave()"><strong>X</strong></div>
                </td>
              </tr>
              <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px auto;">
                    <tr>
                        <td>GRADE</td>
                        <td>NAME</td>
                        <td>REASON</td>
                        <td>DATE</td>
                        <td>ACTION</td>
                    </tr>
                      <?
					   if(count($rs_stdlev_app)>0)
                      foreach($rs_stdlev_app as $K=>$V)
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
                        <td><?=$V->reason?></td>
                        <td><?=date("F j, Y",strtotime($V->leave_date))?></td>
                        <td><div class="approvebtn" onclick="rejectLeaveApplicant('<?=$V->id?>')">Reject</div></td>
                      </tr>
                      <?
                      }
                      ?>
                     
                    </table>
            
                </td>
              </tr>
              <tr>
                <td style="background:#eeeeee;">
                    <div class="pull_left">Showing 1 of 4 of 10 Entites</div>
                    <div class="pull_right"></div>
                </td>
              </tr>
            </table>
</div>

<div id="reject_leave" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'LetterGothicMTStd';">	

            <table width="700" border="0" cellspacing="0" cellpadding="0" class="approved_leavetbl">
              <tr>
                <td style="border-bottom:1px solid #dab791;">
                    <div class="pull_left">Rejected Leaves</div>
                    <div class="pull_right closeicon" onClick="close_reject_leaves()"><strong>X</strong></div>
                </td>
              </tr>
              <tr>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:5px auto;">
                    <tr>
                        <td>GRADE</td>
                        <td>NAME</td>
                        <td>REASON</td>
                        <td>DATE</td>
                        <td>ACTION</td>
                    </tr>
                      <?
					  if(count($rs_stdlev_rej)>0)
                      foreach($rs_stdlev_rej as $K=>$V)
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
                        <td><?=$V->reason?></td>
                        <td><?=date("F j, Y",strtotime($V->leave_date))?></td>
                         <td><div class="approvebtn" onclick="saveLeaveApplicant('<?=$V->id?>')">Approve</div></td>
                      </tr>
                      <?
                      }
                      ?>
                     
                    </table>
            
                </td>
              </tr>
              <tr>
                <td style="background:#eeeeee;">
                    <div class="pull_left">Showing 1 of 4 of 10 Entites</div>
                    <div class="pull_right"></div>
                </td>
              </tr>
            </table>
</div>

