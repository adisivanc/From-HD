<?
function main(){
?>

<script type="text/javascript">
$(function() {
   $(".datepicker").datepicker({
		changeMonth: true
   });  
});
</script>


<link rel="stylesheet" type="text/css" href="css/default_style.css" />


<div class="fullsize">
    <div class="content">
    
    <div class="fullsize menu_head padtb10">
        <div class="pull_left">
            <table width="260" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td> <img src="images/newsletter_icon.png" alt="Logo" class="marginright10" /></td>
                <td>Manage <br/> <span class="f30"><strong>Newsletter</strong></span></td>
              </tr>
            </table>
        </div>
        <div class="pull_right f24 padtop50">
            Add Newsletter
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
                    	<div class="newcircular_head" id="show_newcircular">New Circulars<span></span></div>
                        <ul class="newcircular_content txttheme">
                        	<li><a href="">Circular Name 1</a></li>
                            <li><a href="">Circular Name 2</a></li>
                            <li><a href="">Circular Name 3</a></li>
                        </ul>
                    </div>
                    
                    <div class="circular_outer">
                    	<div class="newcircular_head" id="show_draftcircular">Draft Circulars <span></span></div>
                        <ul class="draftcircular_content">
                        	<li><a href="">Circular Name 4</a></li>
                            <li><a href="">Circular Name 5</a></li>
                        </ul>
                    </div>
                    
                    <div class="circular_outer">
                    	<div class="newcircular_head">Sent Circulars <span></span></div>
                    </div>
                </div>
            </div><!-- Newsletter Circular -->
            
            <div class="newsletter_right border_theme bgwhite"> <!-- Newsletter Form -->
				<h3>Add Circular Two Column</h3>
                <div class="fullsize_pad padtb10 lineht1_8">
                	<p class="pull_left marginright20">Newsletter Type</p>
                    <select class="listbox">
                    	<option>Termly Express</option>
                        <option></option>
                    </select>
                </div>
                <div class="newsletter_cntr">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="newsheadertbl border_bottom">
                      <tr>
                        <td width="30%" valign="top" class="txtright"><span class="marginright20">Newsletter title</span></td>
                        <td width="70%"><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtright"><span class="marginright20">Subject</span></td>
                        <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtright"><span class="marginright20">Newsletter Header Type</span></td>
                        <td>
                        	<input type="radio" class="" id="image_headertype" name="header_type" value="" /> Image
                            <input type="radio" class=" marginleft20" id="text_headertype" name="header_type" value="" /> Text
                            
                            <div class="fullsize padtb10" id="showimg_headertype"> <input type="file" class="" id="" name="" value="" /></div>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="padtb10" id="showtext_headertype">
                              <tr>
                                <td width="26%" valign="top">Head Line1</td>
                                <td><input type="text" style="width:80%;" class="txtbox" id="" name="" value="" /></td>
                              </tr>
                              <tr>
                                <td valign="top">Head Line2</td>
                                <td><input type="text" style="width:90%;" class="txtbox" id="" name="" value="" /></td>
                              </tr>
                              <tr>
                                <td valign="top">Description</td>
                                <td><textarea  style="width:90%; height:100px;" class="msgbox" id="" name="" value=""></textarea></td>
                              </tr>
                            </table>
                            
                        </td>
                      </tr>
                    </table>
                    
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="newsheadertbl border_bottom">
                      <tr>
                        <td width="30%" valign="top" class="txtright"><span class="marginright20">Welcome Note</span></td>
                        <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtright"><span class="marginright20">Text</span></td>
                        <td><textarea  style="width:90%; height:100px;" class="msgbox" id="" name="" value=""></textarea></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtright"><span class="marginright20">Inner Images</span></td>
                        <td>
                            <select style="width:80px;" class="listbox">
                                <option>1</option>
                                <option>2</option>
                            </select>
                            Image Size: 745px X 210px
                            <div class="fullsize padtb10"> <input type="file" class="" id="" name="" value="" /></div>
                        </td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtright"><span class="marginright20">Decription</span></td>
                        <td><textarea  style="width:90%; height:100px;" class="msgbox" id="" name="" value=""></textarea></td>
                      </tr>
                    </table>
                    
                    
                    <div class="fullsize_pad margintb15">
                    	<h4 class="newslt_modulehead">Modules</h4>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl bgtheme">
                          <tr>
                            <td width="30%" valign="top" class="txtright">Module Title</td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright">Sub Title</td>
                            <td><input type="text" style="width:70%;" class="txtbox" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright">Description</td>
                            <td><textarea style="width:90%; height:100px;" class="msgbox" id="" name="" value=""></textarea></td>
                          </tr>
                          <tr>
                            <td valign="top" class="txtright">Highlight Box</td>
                            <td>
                            	<input type="radio" class="" id="img_highlight" name="highlight_box" value="" /> Image
                                <input type="radio" class="" id="txt_highlight" name="highlight_box" value="" /> Text
                                <input type="radio" class="" id="none_highlight" name="highlight_box" value="" /> None
                                <div class="fullsize padtb10"> <input type="file" class="" id="showimg_highlight" name="" value="" /></div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="padtb10" id="showtxt_highlight">
                                  <tr>
                                    <td valign="top" width="26%">Head Line</td>
                                    <td><input type="text" style="width:90%;" class="txtbox" id="" name="" value="" /></td>
                                  </tr>
                                  <tr>
                                    <td valign="top">Description</td>
                                    <td><textarea  style="width:90%; height:100px;" class="msgbox" id="" name="" value=""></textarea></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td class="txtright" valign="top">Highlight Box Position</td>
                            <td>
                            	<input type="radio" class="" id="" name="" value="" /> Left
                                <input type="radio" class="" id="" name="" value="" /> Right
                                <div class="fullsize"><div class="pull_right txtbold f24 cursor">+</div></div>
                            </td>
                          </tr>
                        </table>
					</div>
                    
                    
                    <div class="fullsize border_top">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl border_bottom">
                          <tr>
                            <td width="30%" class="txtright"><span class="marginright20">Term Calender</span></td>
                            <td>
                            	<input type="radio" class="" id="" name="" value="" /> Left
                                <input type="radio" class="" id="" name="" value="" /> Right
                            </td>
                          </tr>
                          <tr>
                            <td class="bgtheme">&nbsp;</td>
                            <td class="bgtheme">
                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td valign="top" width="26%">Date</td>
                                    <td style="position:relative;">
                                    	<input type="text" style="width:50%;" class="txtbox datepicker" id="" name="" value="" />
                                        <img src="images/cal_icon.png" alt="" style="position:absolute; right:49%; bottom:11px;" />
                                    </td>
                                  </tr>
                                  <tr>
                                    <td valign="top">Event Name</td>
                                    <td><input type="text" class="txtbox" id="" name="" value="" /> <div class="fullsize"><div class="pull_right txtbold f24 cursor">+</div></div></td>
                                  </tr>
                                </table>
                            </td>
                          </tr>
                        </table>
                    </div>
                    
                    
                    <div class="fullsize margintb15">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl border_bottom">
                          <tr>
                            <td width="40%" class="txtright" valign="top"><span class="marginright10">Conclusion Text</span></td>
                            <td><textarea style="width:95%; height:100px;"  class="msgbox" id="" name="" value=""></textarea></td>
                          </tr>
                        </table>
                    </div>
                    
                    
                    
                    <div class="fullsize margintb15">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl">
                          <tr>
                            <td width="30%" class="txtright" valign="top"><span class="marginright10">Regards Text</span></td>
                            <td><input type="text" class="txtbox" onBlur="chkField(this)" onFocus="chkField(this)" id="" name="" value="Warm Regards" /></td>
                          </tr>
                          <tr>
                            <td class="txtright" valign="top"><span class="marginright10">From text</span></td>
                            <td><input type="text" class="txtbox" onBlur="chkField(this)" onFocus="chkField(this)" id="" name="" value="YT Communications Team" /></td>
                          </tr>
                        </table>
                    </div>
                    
                    <div class="fullsize bgtheme">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="moduletbl">
                          <tr>
                            <td colspan="2"><strong>Other Options</strong></td>
                          </tr>
                          <tr>
                            <td width="30%" class="txtright" valign="top"><span class="marginright10">File</span></td>
                            <td><input type="file" class="" id="" name="" value="" /></td>
                          </tr>
                          <tr>
                            <td width="30%" class="txtright" valign="top"><span class="marginright10">Send to</span></td>
                            <td>
                            	<input type="checkbox" class="" id="" name="" value="" /> Teacher
                                <input type="checkbox" class="marginleft20" id="" name="" value="" /> Parents
                            </td>
                          </tr>
                          <tr>
                            <td width="30%" class="txtright" valign="top"><span class="marginright10">Set Send Date</span></td>
                            <td>
                            	<input type="radio" class="" id="" name="" value="" /> Left
                                <input type="radio" class="marginleft20" id="" name="" value="" /> Right
                            </td>
                          </tr>
                          <tr>
                            <td width="30%" class="txtright" valign="top"><span class="marginright10">Select Date</span></td>
                            <td style="position:relative;">
                            	<input type="text" style="width:50%;" class="txtbox datepicker" id="" name="" value="" />
                                <img src="images/cal_icon.png" alt="" style="position:absolute; right:49%; bottom:11px;" />
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
                
            </div><!-- Newsletter Form -->
            
        </div>
    
    </div>
</div>



<script type="text/javascript">

$("#image_headertype").click(function(){
   $("#showimg_headertype").show();
   $("#showtext_headertype").hide(); 
});


$("#text_headertype").click(function(){
   $("#showtext_headertype").show(); 
   $("#showimg_headertype").hide();
});


$("#img_highlight").click(function(){
   $("#showimg_highlight").show();
   $("#showtxt_highlight").hide(); 
});


$("#txt_highlight").click(function(){
   $("#showtxt_highlight").show(); 
   $("#showimg_highlight").hide();
});


$("#none_highlight").click(function(){
   $("#showtxt_highlight").hide(); 
   $("#showimg_highlight").hide();
});







$("#show_newcircular").click(function(){
   $(this).addClass('active');
   $("#show_draftcircular").removeClass('active');
   $(".newcircular_content").show();
   $(".draftcircular_content").hide();  
});


$("#show_draftcircular").click(function(){
   $(this).addClass('active');
   $("#show_newcircular").removeClass('active');
   $(".newcircular_content").hide(); 
   $(".draftcircular_content").show(); 
});


</script>



<?
}
include "template.php";
?>