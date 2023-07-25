<?
function main(){
	
	

	if($_POST['act']=='sendmail') {
		
		
		ob_clean(); 
		
		$param_fields = array('parent_name','student_name','grade_id','number','comments','email','student_dob');
		
		
		foreach($param_fields as $K=>$V) {
			
			 $$V=$_POST[$V]; 
		}
		

		$Subject = "[YT] Admission Enquiry Detail ";
		ob_start();
		include 'admission_mail.php';
		$Message = ob_get_contents();
		ob_clean();
		
		$mail = new PHPMailer();
		$mail->IsHTML(true);
		$mail->From       = "info@yellowtrainschool.com";
		$mail->FromName   = "The Yellow Train";
		$mail->Subject    = $Subject;
		$mail->MsgHTML($Message);
		$mail->AddReplyTo('admissions@yellowtrainschool.com','admissions@yellowtrainschool.com');
		$mail->AddAddress('admissions@yellowtrainschool.com','admissions@yellowtrainschool.com'); 
		$mail->Send();
				
		exit();
	}
?>


<div id="campus_container">
<div id="slide1" class="parallax">
<div class="parallax" style="height:auto;">
    
    
    <!-- Header-->
    <div class="page_menu" style="top:110px; z-index:10; padding-top:27px;">
    <div class="content">
        <div class="page_menu_container">
            
            <div class="page_menutop_outer">
            <div class="page_menutop">
                <h1 class="page_menuhd" style="background:none;">Admission Process</h1>
                <div class="pagemenu_right">
                    <div class="pagemenu_desctop"></div>
                </div>
            </div>
            </div>
            
        </div>
    </div>
    </div>
    <!-- Header-->
 
 	<!-- Content-->
    <div class="full_width"> 
        <div class="content">
        
                <div class="full_width admission_container"> 
                    <div class="admission_content"> 
                        <ul>
                            <li>Parents to seek an appointment, meet with the Communications Manager and be oriented on the philosophy of the school.</li>
                            <li>Collect application form after paying a fee of Rs 500.</li>
                            <li>Parents have to submit a fully filled application form within 5 working days.</li>
                            <li>Both parents to attend group orientation meetings as planned by the school. </li>
                            <li>Attend one on one meeting for the management to understand your alignment with the philosophy of the school. (For Grade 
                            School children, a test will be conducted to assess Grade appropriateness).</li>
                            <li>Each application is reviewed carefully by the management and offering admission is at the discretion of the school.</li>
                            <li>Letter of confirmation of admission is sent from school. </li>
                            <li>Policy document to be read and signed by both parents at school.</li>
                            <li>On acceptance of the offer of admission, the non-refundable registration fee has to be paid at the Admissions office 
                            (Garden Campus, Trichy Road) within 15 working days from when the offer is made.</li>
                            <li>Collect receipt for registration fees and the welcome kit.</li>
                        </ul>
                    </div>
                    <div class="admission_form" id="admin_frm"> 
						<form name="admissionFrm" id="admissionFrm" method="post">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admissiontbl">
                          <tr>
                            <th colspan="2">Quick Enquiry Form</th>
                          </tr>
                          <tr>
                            <td colspan="2">Parent Name <br/> <input type="text" class="input_lg" id="parent_name" name="parent_name" value="" /> </td>
                          </tr>
                          <tr>
                            <td colspan="2">Student Name <br/> <input type="text" class="input_lg" id="student_name" name="student_name" value="" /> </td>
                          </tr>
                          <tr>
                            <td colspan="2">Student Date Of Birth <br/> <input type="text" class="input_lg" id="student_dob" name="student_dob" value="" /> </td>
                          </tr>
                          
                          <tr>
                          	<td>
                                <span>Admission sought for</span>
                                <select class="selectbox" id="grade_id" name="grade_id">
                                    <option>Select Grade</option>
                                    <option value="Pre-Kg"> PRE KG</option>
                                    <option value="Lkg">LKG</option>
                                    <option value="Ukg">UKG</option>
                                    <option value="Grade-1">GRADE-1</option>
                                    <option value="Grade-2">GRADE-2</option>
                                    <option value="Grade-3">GRADE-3</option>
                                    <option value="Grade-4">GRADE-4</option>
                                    <option value="Grade-5">GRADE-5</option>
                                    <option value="Grade-6">GRADE-6</option>
                                </select>                           
							 </td>
                          </tr>
                          
                            <!-- 
                            <tr>
                            <td width="55%" id="err_admission"><span>Admission sought for</span> <br/> 
                            <input type="radio" class="radio_lg" id="school_id" name="school_id" value="2"  onclick="showGrades('2')"/> Garden Campus <div class="adm_grade">(Pre KG - Grade 1) </div> </td>
                            <td valign="bottom"><input type="radio" class="radio_lg" id="school_id1" name="school_id" value="1" onclick="showGrades('1')" /> Grade school <div class="adm_grade">(Grade 2 - Grade 6) </div></td>
                            </tr>
                            <tr id="grade_dtls" style="display:none">
                            <td colspan="2" id="grade_dtls_td"></td>
                            </tr>
                            
                            -->
                          
                          <tr>
                            <td colspan="2">Contact Number <br/> <input type="text" class="input_lg" id="contact_number" name="contact_number" onkeypress="return isNumberKey(event)" value="" /> </td>
                          </tr>
                          <tr>
                            <td colspan="2">Email Address <br/> <input type="text" class="input_lg" id="parent_email" name="parent_email" value="" /> </td>
                          </tr>
                          <tr>
                            <td colspan="2">Comment <br/> <textarea class="textarea_lg" id="parent_comments" name="parent_comments" value=""></textarea></td>
                          </tr>
                          <tr>
                            <td colspan="2"><div class="admSubmitBtn" onclick="submitAdmissionFrm()">SUBMIT</div></td>
                          </tr>
                        </table>
                        </form>
                    </div>
                    
                    <div class="admission_form" id="thankyou" style="display:none"> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="thanku_admtbl">
                          <tr>
                            <th> <h2>Thank you for filling out your information!</h2> </th>
                          </tr>
                          <tr>
                            <td>
                                <p>We have received your message and would like to thank you for writing to us. If your enquiry is urgent, please use the telephone number listed 
                                below, to talk to one of our staff members. Otherwise, we will reply by email shortly.</p>
                                <p>Have a great day!</p>
                                
                                <p class="admission_contact"><strong>Phone:</strong> 0422-2904375 <br/>
                                <strong>Mobile:</strong> 8220291777 <br/>
                                <strong>Office hours:</strong> 9.00 AM- 5.00 PM </p>
                            </td>
                          </tr>
                        </table>
                    </div>
                    
                </div>    
        
        </div>
    </div>
	<!-- Content-->
 
</div>
</div>
</div>




<script type="text/javascript">

/*
function showGrades(school_id) {
	
	 var paramData = {'act':'getgrades','school_id':school_id}
	
		ajax({ 
			a:'admission',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				$('#grade_dtls_td').html(data);
				$('#grade_dtls').show();
			  }
			});
} */


function submitAdmissionFrm(){
	
	var err = 0;
	var parent_name,student_name,school_id,grade_id, parent_number, parent_comment;
	
	if(	$('#parent_name').val()=='' ){ err=1; $('#parent_name').addClass('boxred'); } else{ $('#parent_name').removeClass('boxred'); parent_name = $('#parent_name').val(); }
	if(	$('#student_name').val()=='' ){ err=1; $('#student_name').addClass('boxred'); } else { $('#student_name').removeClass('boxred'); student_name = $('#student_name').val(); }
	if(	$('#student_dob').val()=='' ){ err=1; $('#student_dob').addClass('boxred'); } else { $('#student_dob').removeClass('boxred'); student_dob = $('#student_dob').val(); }
	if(	$('#grade_id').val()=='' ){ err=1; $('#grade_id').addClass('boxred'); } else { $('#grade_id').removeClass('boxred'); grade_id=$('#grade_id').val(); }
	if(	$('#contact_number').val()=='' ){ err=1; $('#contact_number').addClass('boxred'); } else { $('#contact_number').removeClass('boxred'); parent_number=$('#contact_number').val(); }
	if(	$('#parent_comments').val()=='' ){ err=1; $('#parent_comments').addClass('boxred'); } else { $('#parent_comments').removeClass('boxred'); parent_comment=$('#parent_comments').val(); }
	
	
	
	if($('#parent_email').val()=='')
	{
	err=1;
	$('#parent_email').addClass('boxred');
	}
	else
	{	 
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#parent_email').val()) == false) 
		{
			err=1;
			$('#parent_email').addClass('boxred');
		}
		else{
			$('#parent_email').removeClass('boxred');
			var parent_email=$('#parent_email').val();
		}
	}
 
	if(err==0){ 

	 	var paramData = {'act':'sendmail','parent_name':parent_name,'student_name':student_name,'grade_id':grade_id,'number':parent_number,'comments':parent_comment,'email':parent_email,'student_dob':student_dob}
	
		ajax({ 
			a:'admission',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
				$('#admin_frm').hide();
				$('#thankyou').show();
				
				
			  }
			});

	}
}



function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	
	return true;
}


</script>

<script type="text/javascript">
$(function() {
   $(".datepicker").datepicker({
		changeMonth: true
   });  
});
</script>

<?
}
include "template.php";
?>