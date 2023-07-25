<?
function main(){
?>

<div class="container_fluid" style="background:#f8f8f8;">
    <div class="container">
        <div class="wall_slide_left">
            <img src="images/Bag_img1.png" alt="Wall Putty" />
        </div>
        <div class="wall_slide_right">
            <h3>WE'VE DOUBLED UP OUR 20% OFFER!</h3>
            <h1>40% OFF </h1>
            <h4>On Green Wall Putty</h4>
            <ul>
            	<li>Can be used for both internal and external of concrete and mortar wall, ceilings</li>
                <li>Gives very good smooth and glossy finish</li>
                <li>All type of paints or distemper can be applied on it</li>
            </ul>
            <p>all prices exclude delivery and VAT*.</p>
            <div>
                <a href="<?=getSeoUrl(array('pn'=>'dealer.php'))?>"> <input type="button" class="putty_btn bg-green" name="become_dealer" value="Become a Dealer" /> </a>
                <a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>"> <input type="button" class="putty_btn bg-pink" name="order_sample" value="Order a Sample" /> </a>
            </div>
        </div>
    </div>
</div>

 
<div class="container_fluid wallputty_features">
    <div class="container">
		
        <h2>Green India Wall Putty gives you best value for your money <br/> as it reduces repainting frequency</h2>
        
        <div class="gi_features">
            <div class="row">
            	<div class="features_tab active" id="show_whyus"> Why Us? </div>
                <div class="features_tab" id="show_technical"> Technical Specification </div>
                <div class="features_tab" id="show_video"> Comparison Video </div>
            </div>
            
            <div class="row">
                <div class="show_whyus">
                    <p>Built on the philosophy of making life simpler and better for builders, architects, contractors, masons and customers. <span> GREEN INDIA </span> introduces 
                    <span> Green wall putty </span>, new age wall putty based on Japanese technology that facilitates smooth wall finishes. Finally, there is putty that offers 
                    more than just whiteness. Our research indicates that our technology is unique and will offer significant advantage over all available similar and competing products.</p>
                    
                    <p>Green wall putty comprises micronized particles that are much finer and far lighter than ordinary wall putties. These properties make our putty easier to 
                    mix and generate a super smooth paste that results in smoother walls and 25% higher coverage than other putties. Green wall putty provides a better skim coat 
                    for fresher looking colors and consumes less paint. It  has high resistance to moisture, efflorescence and fungus, which ensures better longevity.</p>
                    
                    <p>Green wall putty is gentler on the hands and does not cause acute dryness or cracking of skin while working.</p>
                    
                    <p>Green wall putty will revolutionize the way India looks at construction materials. It is a  white cement based putty  developed using Company's state of 
                    the art, modern, well researched and proven Japanese technology, customized for Indian conditions.</p>
                </div>
            
                <div class="show_technical">
					<div class="tech_spec_left">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tech_spectbl">
                          <tr>
                            <th>CHARACTERISTICS</th>
                            <th>TEST RESULT</th>
                          </tr>
                          <tr>
                            <td>Tensile Adhesion Strength</td>
                            <td> > 1.5 N/MM2 </td>
                          </tr>
                          <tr>
                            <td>Compressive Strength</td>
                            <td> > 10 N/MM2 </td>
                          </tr>
                          <tr>
                            <td>Putty: Water ratio</td>
                            <td> 3:1 </td>
                          </tr>
                          <tr>
                            <td>Coverage on smooth surface*</td>
                            <td> > 10-12 sq.ft/kg/mm </td>
                          </tr>
                          <tr>
                            <td>Water Retentivity %</td>
                            <td> > 97 </td>
                          </tr>
                          <tr>
                            <td>Setting time (minutes)</td>
                            <td> Initial - > 120 min, Final - < 360 min </td>
                          </tr>
                          <tr>
                            <td>V.O.C</td>
                            <td> Nil </td>
                          </tr>
                          <tr>
                            <td>Storage life**</td>
                            <td> 12 months </td>
                          </tr>
                        </table>
                        <p>* When applied under controlled environment by skilled applicator and with proper tools <br/> ** When stored in proper location with reasonable care. Under packed conditions.</p>
                        <div class="row" align="center">
                        	<a href="<?=getSeoUrl(array('pn'=>'contact.php'))?>"> <input type="button" class="order_btn bg-pink" name="send_enquiry" value="Order a Sample" /> </a>
                        </div>
                    </div>
                    <div class="tech_spec_right">
                    	<div class="technical_hex1 cursor" onclick="show_how_apply_popup()">
                        	<h4>HOW <br/>TO<br/> APPLY?</h4>
                        </div>
                        <div class="technical_hex2 cursor" onclick="show_special_features_popup()">
                        	<h4>SPECIAL <br/> FEATURES</h4>
                        </div>
                        <div class="technical_hex3 cursor" onclick="show_faq_popup()">
                        	<h4>FAQS</h4>
                        </div>
                    </div>
                </div>
                
                <div class="show_video" align="center">
                    <h4>Video will Coming soon..</h4>
                    <div class="row" style=" display:none;">
                        <video controls>
                          <source src="mov_bbb.mp4" type="video/mp4">
                          <source src="mov_bbb.ogg" type="video/ogg">
                          Your browser does not support HTML5 video.
                        </video>
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </div>
</div>



<div class="container_fluid">
	<? include "testimonial.php"; ?>
</div>


<!--- Popup --->

<div id="how_to_apply_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'latoregular';">
    <div class="how_to_apply_inner">
        <h3>How to Apply? </h3>
        <span class="pop_closebtn" onclick="close_how_apply_popup()">X</span> 
        <p>The way you apply the green wall putty- white cement based wall putty is important for the hardness, durability and smooth finish of a wall surface prior to painting. It is 
        therefore as important to prepare the surface as mixing and applying the wall putty.</p>
        
        <div class="instruction_detail">
            <ul>
                <li class="inst_level active" id="inst_surface">SURFACE PREPARATION </li>
                <div class="instruct_details" id="show_surface">
                    <div class="apply_img"><img src="images/001.jpg" alt="" /></div>
                    <div class="apply_parag">
                        <p>The surface should be clean, free from dust, grease and loose materials. All loosely adhering material should be removed from the surface by using emery stone, wire brush 
                        or putty blade and finally with clean water. Dry and absorbent surface should be moistened with clean water.</p>
                    </div>
                </div>
                <li class="inst_level" id="inst_mixing">MIXING</li>
                <div class="instruct_details" id="show_mixing">
                    <div class="apply_img"><img src="images/002.jpg" alt="" /></div>
                    <div class="apply_parag">
                        <ul>
                            <li> Mix Green Wall putty with clean water in the ratio of 3:1 to make uniform paste. </li>
                            <li> Stir continuously by hand or an electric mixer for about 10-15 minutes to obtain homogeneous lump free paste. </li>
                            <li> The mixture is now ready to use. </li>
                            <li> Use the mix within 2 hours. </li>
                        </ul> 
                    </div>
                </div>
                <li class="inst_level" id="inst_application">APPLICATION </li>
                <div class="instruct_details" id="show_application">
                    <div class="apply_img"><img src="images/003.jpg" alt="" /></div>
                    <div class="apply_parag">
                        <ul>
                            <li>After completing the mixing of Green wall putty start applying the first coat in any one direction uniformly by using a putty blade or any finishing tool.</li>
                            <li>After finishing the first coat when material reaches its initial set then start applying the second coat.</li>
                            <li>Leave the surface to dry completely. After complete drying of second coat remove marks if any with the help of moist sponge or rub the surface very gently with the putty blade.</li>
                            <li>Gently apply wet putty blade or finishing tool to achieve smooth & glossy finish.</li>
                            <li>Always prepare a required quantity of putty and use within 2-3 hrs of mixing.</li>
                            <li>There is no restriction for thickness but it is strongly recommended to limit the total thickness of the coats in maximum range of 1-3mm.</li>
                            <li>If needed gently level the surface with very fine emery paper of not less than 500 number to get a smooth glossy surface.</li>
                        </ul> 
                    </div>
                </div>
                <li class="inst_level" id="inst_care">CARE TO BE TAKEN DURING APPLICATION </li>
                    <div class="instruct_details" id="show_care">
                        <div class="apply_img"><img src="images/004.jpg" alt="" /></div>
                        <div class="apply_parag">
                            <ul>
                                <li>Mixing of Green wall putty plays very important role in the application hence it should be thoroughly mixed with hands or an electric stirrer in order to get best result.</li>
                                <li>Sanding should not be done using rough emery paper. This may give scratches or marks on the final finish.</li>
                                <li>Green wall putty should be applied to fully cured surface.</li>
                                <li>The total thickness of Green wall putty should not exceed 3mm.</li>
                            </ul> 
                        </div>
                    </div>
            </ul>
        </div>
	</div>
</div>


<div id="special_features_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'latoregular';">
    <div class="special_features_inner">
        <h3>Special Features </h3>
        <span class="pop_closebtn" onclick="close_special_features_popup()">X</span> 
        
        <div class="instruction_detail">
            <ul>
                <li class="spl_features active" id="spl_feature1">FEATURES</li>
                <div class="instruct_details" id="show_feature1">
                    <div class="spl_parag">
                        <ul>
                            <li>Whitest Putty</li>
                            <li>Highly water resistant</li>
                            <li>Strong bonding to the base plaster</li>
                            <li>Smooth finish</li>
                            <li>Excellent workability</li>
                            <li>UV Resistance</li>
                        </ul> 
                    </div>
                </div>
                <li class="spl_features" id="spl_feature2">ADVANTAGES</li>
                <div class="instruct_details" id="show_feature2">
                    <div class="spl_parag">
                        <ul>
                            <li>True colour tone of the paint is maintained, primer is not required</li>
                            <li>Protects expensive paint from dampless, peeling off and flaking</li>
                            <li>Makes paint durable</li>
                            <li>Paint finish is superior</li>
                            <li>Suitable for interior as well as exterior</li>
                        </ul> 
                    </div>
                </div>
                <li class="spl_features" id="spl_feature3">BENEFITS </li>
                <div class="instruct_details" id="show_feature3">
                    <div class="spl_parag">
                        <ul>
                            <li>Reduces paint consumption</li>
                            <li>Avoid frequent repainting</li>
                            <li>Cost - effective</li>
                            <li>Aesthetic look for ceiling, interior and external wall</li>
                            <li>Ease of use at site.</li>
                        </ul> 
                    </div>
                </div>
            </ul>
        </div>
	</div>
</div>


<div id="faq_popup" class="popupbox" style="padding:0; margin:0; display:none; font-family: 'latoregular';">
    <div class="faq_inner">
        <h3>Green Wall Putty - FAQ </h3>
        <span class="pop_closebtn" onclick="close_faq_popup()">X</span> 
        
        <ul>
            <li>
                <h4 class="faqs">What is Green Wall Putty? </h4>
                <p>Green Wall Putty is a water repellant base coating which provides a protective, even and smooth base for your costly paints.</p>
            </li>
            <li>
                <h4 class="faqs">In what form the Green Wall Putty is available?</h4>
                <p>Its available in free flowing powder form.</p> 
            </li>
            <li>
                <h4 class="faqs">What are the main constituents of Green wall putty?</h4> 
                <p>Green Wall Putty consists of white cement, high performance polymers, minerals & speciality chemicals.</p>
            </li>
            <li>
                <h4 class="faqs">How many coats of Green wall putty are applied on the surface before painting?</h4>
                <p>Normally 2 coats of Green wall putty is used.</p>
            </li>    
            <li>     
                <h4 class="faqs">Can I use Green wall putty on damp wall?</h4>
                <p>Yes, you can use Green wall putty on damp Wall.</p>
            </li>    
            <li>     
                <h4 class="faqs">What type of surface is ideal for applying Green wall putty?</h4>
                <p>Even plaster surface & level in line free from loose particles, oil stains etc.</p>
            </li>   
            <li>     
                <h4 class="faqs">Do we need to cure the surface before applying Green wall putty?</h4>
                <p>The surface should be wet prior to application. This helps in strong bond with substrate.</p>
            </li>    
            <li>    
                <h4 class="faqs">Does Green wall putty provide a breathable surface?</h4>
                <p>Yes, Green wall putty provides a breathable surface.</p>
            </li>   
            <li>     
                <h4 class="faqs">What is the ideal thickness for Green wall putty?</h4>
                <p>1.5mm for normal application.</p>
            </li>   
            <li>    
                <h4 class="faqs">Is it required to cure the surface after applying Green wall putty?</h4>
                <p>As such it requires no curing. But it is advisable to cure it for 2 days with water to achieve its maximum strength in minimum days.</p>
            </li>   
            <li>    
                <h4 class="faqs">What is the reason of withering of wall putty from some surfaces? What is the remedy for it?</h4>
                <p>Its due to the problem of efflorescence of brick masonry. If the efflorescence problem of brick masonry is present, it vitiate the bonding of any 
                cement based product. The general cause of efflorescence on the wall surface are the quality of bricks, sand and water. Hence it is strongly 
                advisable to take the proper care to control the efflorescence. </p>           
            </li>
        </ul>
        
	</div>
</div>




<script type="text/javascript">

$(".testimonial_right p").prepend("<img src='images/quote1.png' alt='' align='top' />");
$(".testimonial_right p").append("<img src='images/quote2.png' alt='' align='absmiddle' />");

$(".features_tab").click( function() {
	$(".features_tab").removeClass('active');
	$(this).addClass('active');
});

$("#show_whyus").click( function() {
	$(".show_whyus").show();
	$(".show_technical").hide();
	$(".show_video").hide();
});

$("#show_technical").click( function() {
	$(".show_whyus").hide();
	$(".show_technical").show();
	$(".show_video").hide();
});

$("#show_video").click( function() {
	$(".show_whyus").hide();
	$(".show_technical").hide();
	$(".show_video").show();
});


$(".tech_spectbl tr td:first-child").prepend("<img src='images/tick_img.png' alt='' align='absmiddle' style='margin-right:7px;' />");


<!-- Apply Popup  --->

function show_how_apply_popup(){
	
  	$("#how_to_apply_popup").dialog({
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

function close_how_apply_popup(){  $("#how_to_apply_popup").dialog('close');  }


<!-- SPL Popup  --->

function show_special_features_popup(){
	
  	$("#special_features_popup").dialog({
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

function close_special_features_popup(){  $("#special_features_popup").dialog('close');  }



<!-- FAQ Popup  --->

function show_faq_popup(){
	
  	$("#faq_popup").dialog({
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

function close_faq_popup(){  $("#faq_popup").dialog('close');  }


$(".inst_level").click( function() {
	$(".inst_level").removeClass('active');
	$(this).addClass('active');
});

$("#inst_surface").click( function() {
	$("#show_surface").show();
	$("#show_mixing").hide();
	$("#show_application").hide();
	$("#show_care").hide();
});

$("#inst_mixing").click( function() {
	$("#show_surface").hide();
	$("#show_mixing").show();
	$("#show_application").hide();
	$("#show_care").hide();
});

$("#inst_application").click( function() {
	$("#show_surface").hide();
	$("#show_mixing").hide();
	$("#show_application").show();
	$("#show_care").hide();
});

$("#inst_care").click( function() {
	$("#show_surface").hide();
	$("#show_mixing").hide();
	$("#show_application").hide();
	$("#show_care").show();
});

$(".spl_features").click( function() {
	$(".spl_features").removeClass('active');
	$(this).addClass('active');
});

$("#spl_feature1").click( function() {
	$("#show_feature1").show();
	$("#show_feature2").hide();
	$("#show_feature3").hide();
});

$("#spl_feature2").click( function() {
	$("#show_feature1").hide();
	$("#show_feature2").show();
	$("#show_feature3").hide();
});

$("#spl_feature3").click( function() {
	$("#show_feature1").hide();
	$("#show_feature2").hide();
	$("#show_feature3").show();
});


$(".faqs").click( function() {
	$(".faqs").next("p").hide();
	$(this).next("p").show();
});

</script>


<?
}
include "template.php";
?>