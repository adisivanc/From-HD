<?
function main(){
?>


<link rel="stylesheet" type="text/css" href="css/default_style.css" />


<div class="fullsize">
    <div class="content">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Teacher</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50 cursor" id="show_addteacher">
            Add Teacher
        </div>
    </div>
    
    </div>
</div>



<div class="fullsize">
    <div class="content">
    
        <div class="fullsize newsletter_outer">
        	
            <div class="newsletter_left"> <!-- Newsletter Circular -->
            	<div class="newsletter_submenu txtwhite">
					<div class="circular_outer">
                    	<div class="newcircular_head" id="show_currentteacher">Current Teachers<span></span></div>
                        <ul class="currentteacher_content txttheme">
                        	<li><a href="">Name 1</a></li>
                            <li><a href="">Name 2</a></li>
                            <li><a href="">Name 3</a></li>
                        </ul>
                    </div>
                    
                    <div class="circular_outer">
                    	<div class="newcircular_head" id="show_applicants">Applicants<span></span></div>
                        <ul class="applicants_content">
                        	<li><a href="">Name 4</a></li>
                            <li><a href="">Name 5</a></li>
                        </ul>
                    </div>
                    
                    <div class="circular_outer">
                    	<div class="newcircular_head" id="show_archive">Archive <span></span></div>
                        <ul class="archive_content">
                        	<li><a href="">Name 4</a></li>
                            <li><a href="">Name 5</a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- Newsletter Circular -->
            
            <div class="newsletter_right border_theme bgwhite" id="view_addteacher"> <!-- Add Teacher -->
				<h3><strong>Add New Teacher</strong></h3>
                <div class="fullsize_pad padtb10 lineht1_8">
                	<p class="pull_left marginright20">Select School</p>
                    <select class="listbox">
                    	<option>Grade School</option>
                        <option>Grade School</option>
                    </select>
                </div>
                <div class="newsletter_cntr">
					
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl border_bottom">
                      <tr>
                        <td width="25%" valign="top" class="txtright"><span class="marginright20">Name</span></td>
                        <td>
                        	<input type="text" style="width:8%;" class="txtbox" id="" name="" value="" />
                            <input type="text" style="width:26%;" class="txtbox" id="" name="" value="" />
                            <input type="text" style="width:26%;" class="txtbox" id="" name="" value="" />
                            <input type="text" style="width:26%;" class="txtbox" id="" name="" value="" />
                        </td>
                      </tr>
                      <tr>
                        <td width="25%" valign="top" class="txtright"><span class="marginright20">Gender</span></td>
                        <td>
                        	<input type="radio" class="" id="image_headertype" name="header_type" value="" /> Male
                            <input type="radio" class=" marginleft20" id="text_headertype" name="header_type" value="" /> Female
                        </td>
                      </tr>
                      <tr>
                        <td width="25%" valign="top" class="txtright"><span class="marginright20">Date of Birth</span></td>
                        <td>
                            <select class="listbox" style="width:60px;">
                                <option>1</option>
                                <option>2</option>
                            </select>
                            <select class="listbox" style="width:60px;">
                                <option>1</option>
                                <option>2</option>
                            </select>
                            <select class="listbox" style="width:120px;">
                                <option>1</option>
                                <option>2</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td width="25%" valign="top" class="txtright"><span class="marginright20">Photo</span></td>
                        <td><input type="file" class="" id="" name="" value="" /></td>
                      </tr>
                    </table>

                    
                    <div class="fullsize border_bottom padtop15">
                    	<h2 class="form_head">Contact Info</h2>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
                          <tr>
                            <td width="25%" valign="top" class="txtright"><span class="marginright20">Address</span></td>
                            <td><textarea style="width:70%;" class="msgbox" id="" name=""></textarea></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Email Address</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Phone Number</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Mobile Number</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                        </table>

                        <h2 class="form_head padtop10">Emegency Contact Info</h2>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
                          <tr>
                            <td width="25%" valign="top" class="txtright"><span class="marginright20">Name</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Relationship</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Contact Number</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Verified</span></td>
                            <td>
                                <input type="radio" class="" id="image_headertype" name="header_type" value="" /> Yes
                                <input type="radio" class=" marginleft20" id="text_headertype" name="header_type" value="" /> No
                            </td>
                          </tr>
                        </table>
                    </div>
                    
                    
                    
                    <div class="fullsize border_bottom padtop15">
                    	<h2 class="form_head">Education Info</h2>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tbl">
                          <tr>
                            <td width="25%" valign="top" class="txtright"><span class="marginright20">Qualification</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Desigination</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Subject Handling</span></td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Year of Experience</span></td>
                            <td><input type="text" style="width:25%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright"><span class="marginright20">Date of Joining</span></td>
                            <td>
                                <select class="listbox" style="width:60px;">
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                                <select class="listbox" style="width:60px;">
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                                <select class="listbox" style="width:120px;">
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                            </td>
                          </tr>
                        </table>
                    </div>
                    
                    
                    
                    <div class="fullsize txtwhite txtcenter f18">
                    	<div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10"><strong>CANCEL</strong></div>
                        <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10"><strong>SAVE</strong></div>
                        <div class="bgbrown pull_right margintb10 cursor padlr20 padtb10"><strong>ADD</strong></div>
                    </div>                    
                    
                </div>
                
            </div><!-- Add Teacher -->
            
            
            
            <div class="newsletter_right border_theme bgwhite" id="list_teacher"> <!-- List Teacher -->
                <div class="fullsize_pad padtb10 lineht1_8 border_bottom">
                	<p class="pull_left marginright20">Search By</p>
                    <select class="listbox">
                    	<option>Name</option>
                        <option>ID</option>
                    </select>
                    <input type="text" style="width:30%;" class="txtbox" id="" name="" value="" />
                    <div class="pull_right bgbrown txtwhite padtb5 padlr20 cursor marginright150"><strong>Search</strong></div>
                </div>
                <div class="teacherlist">
					<div class="teacherlist_inner cursor" id="teacher_deatils1">
                    	<div style="width:100%; height:200px; border:1px solid #999999;"></div>	
                        <h4>Ms.Praveena</h4>
                        <h5>ENGLISH</h5>
                    </div>	
					<div class="teacherlist_inner">
                    	<div style="width:100%; height:200px; border:1px solid #999999;"></div>	
                        <h4>Ms.Praveena</h4>
                        <h5>ENGLISH</h5>
                    </div>	
					<div class="teacherlist_inner">
                    	<div style="width:100%; height:200px; border:1px solid #999999;"></div>	
                        <h4>Ms.Praveena</h4>
                        <h5>ENGLISH</h5>
                    </div>	
					<div class="teacherlist_inner">
                    	<div style="width:100%; height:200px; border:1px solid #999999;"></div>	
                        <h4>Ms.Praveena</h4>
                        <h5>ENGLISH</h5>
                    </div>	
					<div class="teacherlist_inner">
                    	<div style="width:100%; height:200px; border:1px solid #999999;"></div>	
                        <h4>Ms.Praveena</h4>
                        <h5>ENGLISH</h5>
                    </div>	
                </div>
                
            </div><!-- List Teacher -->
            
            
            <div class="newsletter_right border_theme bgwhite" id="view_teacherdetails"> <!-- Teacher Details-->
                <div class="fullsize_pad padtb10 lineht1_8 border_bottom">
                	<p class="pull_left marginright20 f20"><strong>Ms.Praveena, B.Ed</strong></p>
                    <p class="pull_right">Grade School</p>
                </div>
                <div class="teacher_details">
					<div class="teacher_address">
                    	<h2>DOB: 01/01/1981</h2>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="margintop25">
                          <tr>
                            <td>
                            	<h4>Contact Info:</h4>
                                Ramanathapuram <br/>
                                Coimbatore. <br/>
                                +91 00000 00000 <br/>
                                +91 11111 111111
                            </td>
                            <td>
                            	<h4>Emegency Contact</h4>
                                Raja <br/>
                                Brother <br/>
                                +91 00000 00000 <br/>
                                +91 11111 111111
                            </td>
                          </tr>
                          <tr>
                            <td class="padtop20">
                            	<h4>Subjects</h4>
                                Grade 1 - English<br/>
                                Grade 3 - Maths
                            </td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                    </div>
					<div class="teacher_photo">
                    	<img src="images/teacher2.jpg" alt="" />
                    </div>
                </div>
                
                <div class="fullsize txtwhite txtcenter f18">
                    <div class="bgbrown pull_right marginleft20 marginright10 margintb10 cursor padlr20 padtb10"><strong>CANCEL</strong></div>
                    <div class="bgbrown pull_right marginleft20 margintb10 cursor padlr20 padtb10"><strong>EDIT</strong></div>
                </div> 
                                       
            </div><!-- Teacher Details -->
            
        </div>
    
    </div>
</div>



<script type="text/javascript">


$("#show_currentteacher").click(function(){
   $(this).addClass('active');
   $("#show_applicants").removeClass('active');
   $("#show_archive").removeClass('active');
   $(".currentteacher_content").show();
   $(".applicants_content").hide();
   $(".archive_content").hide();   
});


$("#show_applicants").click(function(){
   $(this).addClass('active');
   $("#show_currentteacher").removeClass('active');
   $("#show_archive").removeClass('active');
   $(".currentteacher_content").hide(); 
   $(".applicants_content").show(); 
   $(".archive_content").hide(); 
});


$("#show_archive").click(function(){
   $(this).addClass('active');
   $("#show_currentteacher").removeClass('active');
   $("#show_applicants").removeClass('active');
   $(".currentteacher_content").hide(); 
   $(".applicants_content").hide(); 
   $(".archive_content").show(); 
});





$("#show_addteacher").click(function(){
   $("#view_addteacher").show();
   $("#list_teacher").hide(); 
   $("#view_teacherdetails").hide(); 
});



$("#teacher_deatils1").click(function(){
   $("#view_addteacher").hide();
   $("#list_teacher").hide(); 
   $("#view_teacherdetails").show(); 
});


</script>



<?
}
include "template.php";
?>