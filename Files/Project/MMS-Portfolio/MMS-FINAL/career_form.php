<?
function main(){
?>

<? include "page_header.php"; ?>


<div class="content_outer">
    <div class="content">
    
    <div class="page_title">
		<? if($_REQUEST['Type']=='PHPDEV'){ ?>PHP DEVELOPER<? } ?> 
        <? if($_REQUEST['Type']=='JPHPDEV'){ ?>JUNIOR PHP DEVELOPER<? } ?>
    </div>
    
    <form>
		<div class="carrerform_cntr">
			<div class="carrerform_inr">
				
			 <div class="career_details">Name</div>
			 <div><input type="text" class="career_txtbx" id="career_name" name="career_name" value="" /></div>
			 
			 <div class="career_details">Email</div>
			 <div><input type="text" class="career_txtbx" id="career_email" name="career_email" value="" /></div> 
			 
			 <div class="career_details">Contact Number</div>
			 <div><input type="text" class="career_txtbx" id="career_mobile" name="career_mobile" value="" /></div>
			 
			 <div class="career_details">Where are you currently located</div>
			 <div><input type="text" class="career_txtbx" id="career_location" name="career_location" value="" /></div> 
			 
			 <div class="career_details">Availabilty</div>
			 <div><input type="text" class="career_txtbx" id="availabilty" name="availabilty" value="" /></div>
			 
			 <div class="career_details">Salary Expectations</div>
			 <div><input type="text" class="career_txtbx" id="career_salary" name="career_salary" value="" /></div>    
			   
			 <div class="career_details">Portfolio link, blog, urls of the projects you have worked on, or other additional information</div>
			 <div><textarea class="career_txtbx career_txtarea" id="career_message" name="career_message"></textarea></div>
			 
			 <div class="career_details">Upload CV (.doc, .docx, .odt)</div>
			 <div><input type="file" name="cv" id="FileUpload1"></div>
			 
			 <div class="career_details"><img src="images/submit_btn.jpg" onclick="submit_careerfrm()" alt="Submit"/></div>
			 		
			</div>
		</div>
    </form>
    
    </div>
</div>


<script type="text/javascript">

function submit_careerfrm(){
	
	var err = 0;

	if(	$('#career_name').val()=='' || $('#career_name').val()=='Enter your name'){ err=1; $('#career_name').addClass('boxred'); } else { $('#career_name').removeClass('boxred'); }
	
	if($('#career_email').val()=='')
	{
	err=1;
	$('#career_email').addClass('boxred');
	}
	else
	{	
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(reg.test($('#career_email').val()) == false) 
		{
			err=1;
			$('#career_email').addClass('boxred');
		}
		else{
			$('#career_email').removeClass('boxred');
		}
	}
	
	if(	$('#career_mobile').val()=='' || $('#career_mobile').val()=='Enter your name'){ err=1; $('#career_mobile').addClass('boxred'); } else { $('#career_mobile').removeClass('boxred'); }
	
	if(	$('#availabilty').val()=='' || $('#availabilty').val()=='Enter your name'){ err=1; $('#availabilty').addClass('boxred'); } else { $('#availabilty').removeClass('boxred'); }
	
	if(	$('#career_salary').val()=='' || $('#career_salary').val()=='Enter your name'){ err=1; $('#career_salary').addClass('boxred'); } else { $('#career_salary').removeClass('boxred'); }
	
	//if(	$('#contact_website').val()==''){ err=1; $('#contact_website').addClass('boxred'); } else { $('#contact_website').removeClass('boxred'); }
	if(	$('#career_message').val()==''){ err=1; $('#career_message').addClass('boxred'); } else { $('#career_message').removeClass('boxred'); }
	
	if(err==0)
	{
		//alert('success');

	}
	
	
	// Browse Validation
	
	var myfile = document.getElementById('FileUpload1');
	var mysplit = myfile.value.split('.');
	var len = mysplit.length;
	var ext = mysplit[len-1];
	ext=ext.toLowerCase();

	if(ext=='doc' || ext=='docx' || ext=='pdf')
	{
		$('#FileUpload1').css( "border", "0px solid #FF0000" );
	}
	else
	{
		//alert('Upload your Resume');    //Error message
		
		$('#FileUpload1').css( "border", "1px solid #FF0000" );
		return false;
	}
	

}

</script>



<?
}
include "template.php";
?>