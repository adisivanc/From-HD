<?
function main(){
	
	$token = md5(rand(1000,9999)); //you can use any encryption
	$_SESSION['token'] = $token; //store it as session variable
		
	if($_POST['act']=='addleads') {
		  ob_clean();
		  foreach($_POST as $K=>$V) { $$K=$V; if($K!='act') $params[$K]=$V; }
		  if($company_id>0) echo Leads::updateLead($params); else echo Leads::insertLead($params);
		  exit();	
	}
	
	if($_POST['act']=='add_followup') {
		ob_clean();
		
		
		foreach($_POST as $K=>$V) { $$K=$V; if($K!='act') $params[$K]=urldecode($_POST[$K]); }
		if($followup_id>0) echo Leads::updateLeadFollowup($params); else echo Leads::insertLeadFollowup($params);
		exit();	
	}
	
	if($_POST['act']=='getAllLeads') {
		ob_clean();
		include "include_leads.php";
		exit();
	}
	
	
	if($_POST['act']=='showLeadDtls') {
	  ob_clean();
	  include "show_lead_dtls.php";
	  exit();	
	}
	

	if($_POST['act']=='showNotes') {
	  ob_clean();
	  include "leads_followup.php";
	  exit();	
	}


	if($_POST['act']=='showLog') {
	  ob_clean();
	 echo 'log';
	  exit();	
	}
	
	
	if($_POST['act']=='editLeadDtls') {
		ob_clean();
		include "update_lead_dtls.php";
		exit();
	}	
	
	if($_POST['act']=='getAllFollowupNotes') {
	  ob_clean();
	  include "include_followups.php";
	  exit();  
}


	if($_POST['act']=='showFollowup') {
	  ob_clean();
	  include "update_followup_lead.php";
	  exit();  
}

	if($_POST['act']=='editFollowup') {
	  ob_clean();
	  include "update_followup_lead.php";
	  exit();  
}

   if($_POST['act']=='deleteFollowup') {
	 
	 $affectedRows = Leads::deleteFollowup($_POST['followup_id']);
	 ob_clean();
	 if($affectedRows>0) echo 'Success';
	 exit();   
   }


?>



<table width="100%" border="0" cellspacing="0" cellpadding="5" style=" height:auto">
<tr>
    <td colspan="2" bgcolor="#CCCCCC"><h2 style=" padding:25px 0; text-indent:10px;">Manage Leads</h2> </td>
</tr>
<tr bgcolor="#FFFFFF">  
    <td  style="width:350px; background-color:#CCCCCC; height:auto;" valign="top" id="allLeads">
    
     </td>
    <td style="text-align:left; padding-left:15px; padding:10px;" align="left"  valign="top" id="leadDtls">
    
    

    
     </td>
</tr>
</table>


<div id="show_followup" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">
</div>


<div id="show_notes" class="popupbox" style="padding:0; margin:0; display:none; font-family:Arial, Helvetica, sans-serif; ">
	<form id="addnotesfrm" name="addnotesfrm" method="post">
    <table width="500" border="0" cellspacing="0" cellpadding="0" class="followuptbl">
      <tr>
        <th colspan="3">Add Notes
        <span class="cursor" onClick="close_notes_popup()" style="float:right; margin-right:10px;">X</span></th>
      </tr>
      <tr>
        <td valign="top" width="150">Date</td>
        <td colspan="2"> <input type="text" class="txtbox datepicker" id="notes_date" name="notes_date" value="" /> </td>
      </tr>
      <tr>
        <td valign="top">Notes</td>
        <td colspan="2"><textarea class="txtarea" id="notes" name="notes" value="" ></textarea></td>
      </tr>
      <tr>
        <td colspan="3" align="right"> 
            <input type="button" class="btn" value="SUBMIT" onclick="addnew_notes()" />
        </td>
      </tr>
    </table>
    </form>
</div>


<script type="text/javascript">

// Follow Up


$('.leads_tab').click(function(){
	$('.leads_tab').removeClass('active');
	$(this).addClass('active');
});



function editFollowup(lead_followup_id,lead_id){
	
paramData = {'act':'editFollowup','followup_id':lead_followup_id,'lead_id':lead_id};
$("#show_followup").dialog('open');
$('#show_followup').html('Loading followups..please wait');	
paramData = {'act':'showFollowup','followup_id':lead_followup_id,'lead_id':lead_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		$('#show_followup').html(data);	
		//$('#followup_lead_id').val(lead_id);
		load_followups(lead_id);
	}});
	
	
	}

  	$("#show_followup").dialog({
		autoOpen: false,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});


	$(".ui-widget-header").css({"display":"none"});

function show_followup(lead_id){

$("#show_followup").dialog('open');
$('#show_followup').html('Loading followups..please wait');	
paramData = {'act':'showFollowup','lead_id':lead_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		$('#show_followup').html(data);	
		//$('#followup_lead_id').val(lead_id);
		load_followups(lead_id);
	}});


	
}

function close_followup(){ $("#show_followup").dialog('close'); }


// Notes

function show_notes_popup(){
	
  	$("#show_notes").dialog({
		autoOpen: true,
		resizable: false,
		height: 'auto',
		width: 'auto',
		modal: true,
		show: { effect: "blind", duration: 800 },
		//hide: { effect: "blind", duration: 800 },		
		draggable: true
	});
	
	$(".ui-widget-header").css({"display":"none"});
}

function close_notes_popup(){ $("#show_notes").dialog('close'); }







function addLead() {

	var err = 0;
	
	var company_name,address,city,area,contact_person,email,mobile,phone,remarks, lead_type,company_type,user_id,distance,rate;
	
	if(	$('#user_id').val()=='' ){ err=1; $('#user_id').addClass('boxred'); } else { $('#user_id').removeClass('boxred');  user_id = $('#user_id').val(); }
	
	if(	$('#company_name').val()=='' ){ err=1; $('#company_name').addClass('boxred'); } else{ $('#company_name').removeClass('boxred');  company_name = $('#company_name').val(); }
	if(	$('#company_address').val()=='' ){ err=1; $('#company_address').addClass('boxred'); } else { $('#company_address').removeClass('boxred');  address = $('#company_address').val(); }
	if(	$('#city').val()=='' ){ err=1; $('#city').addClass('boxred'); } else { $('#city').removeClass('boxred');  city = $('#city').val(); }
	if(	$('#area').val()=='' ){ err=1; $('#area').addClass('boxred'); } else { $('#area').removeClass('boxred');  area = $('#area').val(); }
	if(	$('#contact_person').val()=='' ){ err=1; $('#contact_person').addClass('boxred'); } else { $('#contact_person').removeClass('boxred');  contact_person = $('#contact_person').val(); }
	if(	$('#email').val()=='' ){ err=1; $('#email').addClass('boxred'); } else { $('#email').removeClass('boxred');  email = $('#email').val(); }
	if(	$('#mobile').val()=='' ){ err=1; $('#mobile').addClass('boxred'); } else { $('#mobile').removeClass('boxred');  mobile = $('#mobile').val(); }
	if(	$('#phone').val()=='' ){ err=1; $('#phone').addClass('boxred'); } else { $('#phone').removeClass('boxred');  phone = $('#phone').val(); }
	if(	$('#remarks').val()=='' ){ err=1; $('#remarks').addClass('boxred'); } else { $('#remarks').removeClass('boxred');  remarks = $('#remarks').val(); }
	
	if(!$('input[name="company_type"]:checked').val()){ err=1; $('.err_leadtype').addClass('txterror'); } else { $('.err_leadtype').removeClass('txterror');  company_type = $('input[name="company_type"]:checked').val(); }
	if(!$('input[name="lead_type"]:checked').val()){ err=1; $('.err_leadtype').addClass('txterror'); } else { $('.err_leadtype').removeClass('txterror');  lead_type = $('input[name="lead_type"]:checked').val(); }
	
	if(	$('#email').val()=='' ){ err=1; $('#email').addClass('boxred'); } else { $('#email').removeClass('boxred');  var email_id = $('#email').val(); }
	
	if(	$('#rate').val()=='' ){ err=1; $('#rate').addClass('boxred'); } else { $('#rate').removeClass('boxred');  rate = $('#rate').val(); }
	if(	$('#distance').val()=='' ){ err=1; $('#distance').addClass('boxred'); } else { $('#distance').removeClass('boxred');  distance = $('#distance').val(); }
	

	var lead_id = $('#company_id').val();
	
	if(err==0){ 
	
	$('#add').val('processing..');
	
	if(lead_id==0)
	 var paramData = {'act':'addleads','company_name':company_name,'address':address,
	 					'city':city,'area':area,'contact_person':contact_person,'email':email,'mobile':mobile,'phone':phone,'remarks':remarks, 'lead_type':lead_type,'company_type':company_type,'user_id':user_id,'rate':rate,'distance':distance}
	else
	 var paramData = {'act':'addleads','company_name':company_name,'address':address,
	 					'city':city,'area':area,'contact_person':contact_person,'email':email,'mobile':mobile,'phone':phone,'remarks':remarks, 'lead_type':lead_type,'company_id':lead_id,'company_type':company_type,'user_id':user_id,'rate':rate,'distance':distance}
	
	
		ajax({ 
			a:'leads',
			b:$.param(paramData),
			c:function(){},
			d:function(data){
			
           	data = $.trim(data);
			dataArr = data.split('::');
			
			if(dataArr[0]=='Success') { 
				alert('Lead Successfully added');
				loadLeadDtls(dataArr[2]);
				$('.error').hide(); 
				load_leads(); //loadLeadDtls(0);
			 } 
			else { if(dataArr[0]=='Error1') {
				if(confirm('We see that you already have this company in the database. Would you like to view the existing company details?')){
				loadLeadDtls(dataArr[2]); 
				}
				else {
				$('.error').html("Lead already exists");
				$('.error').show();				
				}
		   } else {
		 
		 showLeadDtls(dataArr[2]);
		   }
			}
			if($('#company_id').val()>0)	
				$('#add').val('Update Lead');			
			else 		
				$('#add').val('Add Lead');				 
			}
			});
	

	}
}


function editLeadDtls(lead_id) {
paramData = {'act':'editLeadDtls','lead_id':lead_id};

ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		$('#leadDtls').html(data);	
	}});	
}

function loadLeadDtls(lead_id) {

paramData = {'act':'showLeadDtls','lead_id':lead_id};

ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		$('#leadDtls').html(data);	
	}});
}


loadLeadDtls(0);


function load_leads() {
	
paramData = {'act':'getAllLeads'};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		
		var dataArr = data.split(':::');
		
		$('#allLeads').html(dataArr[1]);	if(dataArr[0]>0) {
		
		var table = $('#leadListTbl').DataTable( {  
		 "oLanguage": {
				  "sSearch": "",
				  "sZeroRecords": "No Records Found",
					},
		 "displayLength": 10,
		 "bLengthChange": false, 
		 "pagingType": "full_numbers" 
		});
		$('.dataTables_filter input').attr("placeholder", "search lead here");
		$('.dataTables_filter input').attr("class", "searchbox");
		var info = table.page.info();
		if(info.pages>1) 
			 $('#leadsListTbl_paginate')[0].style.display = "block";
		else  	$('#leadsListTbl_paginate')[0].style.display = "none";
		}} }
		);
		
}

load_leads();



function load_followups(lead_id) {
	
	//alert(lead_id);
var paramData = {'act':'getAllFollowupNotes','lead_id':lead_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		//alert(data);
		var dataArr = data.split(':::');
		$('#followup_dtls').html(dataArr[1]);	
		if(dataArr[0]>0) {
		
		var table = $('#followupListTbl').DataTable( {  
		 "oLanguage": {
				  "sSearch": "",
				  "sZeroRecords": "No Records Found",
					},
		 "displayLength": 10,
		 "bLengthChange": false, 
		 "pagingType": "full_numbers" 
		});
		$('.dataTables_filter input').attr("placeholder", "search notes here");
		$('.dataTables_filter input').attr("class", "searchbox");
		var info = table.page.info();
		if(info.pages>1) 
			 $('#followupListTbl_paginate')[0].style.display = "block";
		else  	$('#followupListTbl_paginate')[0].style.display = "none";
		}} }
		);
		
}


function addnew_followup(lead_id) {

	var err = 0;
	var followup_date, followup_notes,reminder;
	
	if(	$('#followup_date').val()=='' ){ err=1; $('#followup_date').addClass('boxred'); } else{ $('#followup_date').removeClass('boxred');  followup_date = $('#followup_date').val(); }
	if(	$('#followup_notes').val()=='' ){ err=1; $('#followup_notes').addClass('boxred'); } else { $('#followup_notes').removeClass('boxred');  followup_notes = $('#followup_notes').val(); }

	if(err==0){ 
			paramData = {'act':'add_followup','followup_date':followup_date,'followup_notes':escape(followup_notes),'lead_id':lead_id,'reminder':'Y','followup_id':$('#followup_id').val()};
			
			
			ajax({ 
				a:'leads',
				b:$.param(paramData),
				c:function(){},
				d:function(data){
					
           	data = $.trim(data);
			dataArr = data.split('::');
			$('#followup_date').val('');
			$('#followup_notes').val('');
			$('#followup_id').val('0');
			$('#followup_btn').val('Add');
			
			if(dataArr[0]=='Success') { 
				alert('Followup Successfully added');
				$('.error').hide(); 
				load_followups(lead_id);
			 } 
			else { if(dataArr[0]=='Error1') {
				if(confirm('We see that you already have this followup in the database. Would you like to view the existing company details?')){
				load_followups(lead_id);
				}
				else {
				$('.error').html("Lead already exists");
				$('.error').show();				
				}
		   } else {
		 
		 showLeadDtls(dataArr[2]);
		   }
			}
			if($('#company_id').val()>0)	
				$('#add').val('Update Lead');			
			else 		
				$('#add').val('Add Lead');				 
			}
			});
	

	}
}
					
					
function showLeadDtls(lead_id) {

paramData = {'act':'showLeadDtls','lead_id':lead_id};

ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		$('#leadDtls').html(data);	

	}});
}



function showNotes(lead_id) {
paramData = {'act':'showNotes','lead_id':lead_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		$('#leadContent').html(data);	

	}});
}




function showLog(lead_id) {
paramData = {'act':'showLog','lead_id':lead_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		$('#leadContent').html(data);	

	}});
}


function deleteFollowup(followup_id){
	
if(confirm('Are you sure you want to delete this followup?')) {	
paramData = {'act':'deleteFollowup','followup_id':followup_id};
ajax({ 
	a:'leads',
	b:$.param(paramData),
	c:function(){},
	d:function(data){
		data = $.trim(data);
		if(data=='Success') $('#Fid_'+followup_id).remove();
	}});
}
return;
}


function addnew_notes() {

	var err = 0;
	
	if(	$('#notes_date').val()=='' ){ err=1; $('#notes_date').addClass('boxred'); } else{ $('#notes_date').removeClass('boxred'); var notes_date = $('#notes_date').val(); }
	if(	$('#notes').val()=='' ){ err=1; $('#notes').addClass('boxred'); } else { $('#notes').removeClass('boxred'); var notes = $('#notes').val(); }

	if(err==0){ 

	}
}



</script>



<?
}
include "template.php";
?>
