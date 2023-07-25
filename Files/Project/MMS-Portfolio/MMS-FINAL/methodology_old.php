<?
function main(){
?>

<? include "page_header.php"; ?>

<div class="content_outer">
<div class="content">

<div class="page_title">WEB DESIGN WORKFLOW</div>
<div class="page_subtitle1">From web design and development to ongoing marketing and support. As a full service web agency, we are with you every step of the way...</div>

<div id="workflow_container">

    <div id="workflow_slider">
        <div id="cir1" class="circle circle0 active" onclick="setactive(1)">
        	<div class="circletop"><span># 1</span><img src="images/icon/process-icon1.png" border="0" /></div>
        	<div class="circlebtm">Business<br/>Needs Analysis</div>
        </div>
        <div id="cir2" class="circle circle1" onclick="setactive(2)">
        	<div class="circletop"><span># 2</span><img src="images/icon/process-icon2.png" border="0" /></div>
        	<div class="circlebtm">MAPPING <br/>THE WEBSITE</div>
        </div>
        <div id="cir3" class="circle circle0" onclick="setactive(3)">
        	<div class="circletop"><span># 3</span><img src="images/icon/process-icon3.png" border="0" /></div>
        	<div class="circlebtm">QUESTIONNAIRES</div>
        </div>
        <div id="cir4"  class="circle circle1" onclick="setactive(4)">
        	<div class="circletop"><span># 4</span><img src="images/icon/process-icon4.png" border="0" /></div>
        	<div class="circlebtm">ESSENTIAL TOOLS</div>
        </div>
        <div id="cir5" class="circle circle0" onclick="setactive(5)">
        	<div class="circletop"><span># 5</span><img src="images/icon/process-icon6.png" border="0" /></div>
        	<div class="circlebtm">HOME PAGE <br/>DESIGN</div>
        </div>
        <div id="cir6" class="circle circle1" onclick="setactive(6)">
        	<div class="circletop"><span># 6</span><img src="images/icon/process-icon7.png" border="0" /></div>
        	<div class="circlebtm">HOME PAGE <br/>CONFIRMATION</div>
        </div>
        <div id="cir7" class="circle circle0" onclick="setactive(7)">
        	<div class="circletop"><span># 7</span><img src="images/icon/process-icon8.png" border="0" /></div>
        	<div class="circlebtm">HOME PAGE HTML</div>
        </div>
        <div id="cir8" class="circle circle1" onclick="setactive(8)">
        	<div class="circletop"><span># 8</span><img src="images/icon/process-icon10.png" border="0" /></div>
        	<div class="circlebtm">INNER PAGE DESIGN</div>
        </div>
        <div id="cir9" class="circle circle0" onclick="setactive(9)">
        	<div class="circletop"><span># 9</span><img src="images/icon/process-icon11.png" border="0" /></div>
        	<div class="circlebtm">INNER PAGE <br/>CONFIRMATION</div>
        </div>
        <div id="cir10" class="circle circle1" onclick="setactive(10)">
        	<div class="circletop"><span># 10</span><img src="images/icon/process-icon12.png" border="0" style="margin-top:7px;" /></div>
        	<div class="circlebtm">CONTENT AND IMAGES</div>
        </div>
        <div id="cir11" class="circle circle0" onclick="setactive(11)">
        	<div class="circletop"><span># 11</span><img src="images/icon/process-icon13.png" border="0" style="margin-top:7px;" /></div>
        	<div class="circlebtm">INNER PAGE HTML</div>
        </div>
        <div id="cir12" class="circle circle1" onclick="setactive(12)">
        	<div class="circletop"><span># 12</span><img src="images/icon/process-icon15.png" border="0" style="margin-top:7px;" /></div>
        	<div class="circlebtm">CONTENT &amp;<br/>IMAGE TRANSFER</div>
        </div>
        <div id="cir13" class="circle circle0" onclick="setactive(13)">
        	<div class="circletop"><span># 13</span><img src="images/icon/process-icon16.png" border="0" style="margin-top:7px;" /></div>
        	<div class="circlebtm">CONTENT MANAGEMENT SYSTEM (CMS)<br/> INTEGRATION</div>
        </div>
        <div id="cir14" class="circle circle1" onclick="setactive(14)">
        	<div class="circletop"><span># 14</span><img src="images/icon/process-icon17.png" border="0" style="margin-top:7px;" /></div>
        	<div class="circlebtm">TESTING</div>
        </div>
        <div id="cir15" class="circle circle0" onclick="setactive(15)">
        	<div class="circletop"><span># 15</span><img src="images/icon/process-icon18.png" border="0" style="margin-top:5px;" /></div>
        	<div class="circlebtm">FINAL CONFIRMATION</div>
        </div>
        <div id="cir16" class="circle circle1" onclick="setactive(16)">
        	<div class="circletop"><span># 16</span><img src="images/icon/process-icon19.png" border="0" style="margin-top:7px;" /></div>
        	<div class="circlebtm">WEBSITE LAUNCH</div>
        </div>
    </div>
    
	<div id="workflow_title">
    	<div id="workflow_title_left">
        	<span id="workflow_arrow_left" title="Previous" onclick="flowprevnext('prev')"># 1</span> 
            <span id="flowhd_left" class="flowhd">Business Needs Analysis</span>
        </div>
    	<div id="workflow_title_right">
            <span id="flowhd_right" class="flowhd">Questionnaires</span><span id="workflow_arrow_right" title="Next" onclick="flowprevnext('next')"># 3</span> 
        </div>
        <input type="hidden" id="current_cir" value="1" />        
    </div>

</div>

</div>
</div>


<div id="workflow_desc">
<div class="content">

	<div class="workflow_content" id="flow1" style="display:block">
    	<h1 class="workflow_hd">Business Needs Analysis</h1>
        <p>We strive to gain a full understanding of our clients' needs prior to recommending a website design.</p>
        <p>We view your business as a unique entity, hence we do not take a one size fits all approach to web design. No two businesses are identical, consequently your business site should not be like any other on the web.</p>
        <p>Before proceeding, we will learn about the specifics of your business, including</p>
        <ul class="workflowlist">
            <li>The competitive environment;</li>
            <li>Customer demographics;</li>
            <li>Customer buying habits, and more</li>
        </ul>
        <p>We conduct market research which will give us insight into the type of site and functionality that may be advantageous for the business you are involved in and that will fit in with your needs and budget.</p> 
        
        
    	<h1 class="workflow_hd" style="padding-top:10px;">Factors to consider</h1>
        
        <div class="factor">
        <ul class="workflowlist">
            <li>Responsive</li>
            <li>Mobile Website</li>
            <li>Flash</li>
            <li>Infinite Scroll</li>
            <li>What type of code?</li>
            	<ul class="workflowlist1">
                <li>HTML, HTML5, CSS3</li>
                <li>PHP</li>
                <li>MySQL</li>
                </ul>
        </ul>   
        </div>
        
        <div class="factor">
        <ul class="workflowlist">
            <li>Shopping Cart Functionality</li>
            <li>Customer Portal/Login</li>
            <li>Site-Map Creation</li>
            <li>Which CMS an Existing Websites</li>
            <li>Video Animation</li>
            <li>SEO Friendly</li>
            <li>Payment Gateway</li>
            <li>Should you have a Blog?</li>
        </ul>
        </div>
    </div>
    
	<div class="workflow_content" id="flow2">
    	<h1 class="workflow_hd">Mapping the Website</h1>
		<p>We first perform our needs analysis and compile all of the pertinent information.</p>
		<p>After that, we map out the site requirements and assign tasks to the relevant departments, which include:</p>
        <ul class="workflowlist">
            <li>Design</li>
            <li>Development</li>
            <li>Animation</li>
            <li>Project Management</li>
            <li>Content</li>
		</ul>
    </div>
    
	<div class="workflow_content" id="flow3">
    	<h1 class="workflow_hd">Questionnaires</h1>
        <p>In order for us to satisfy your expectations, we request that you answer some questions that pertain to your business.</p>
        <p>This is a vital part of our process. We need to gain more insights into your business and fully understand your goals for the site. Having a more comprehensive view of your style and preferences, enables us to better fulfil your requirements.</p>
        
        <p>The following are examples of questions we may ask:</p>
        <p>Q- What is the purpose of the website?</p>
        <p>Q- Who are your customers?</p>
        <p>Q- Why do your customers do business with you?</p>
        <p>Q- Please list some of your competitors?</p>
        <p>Q- Please list some businesses in your industry you follow closely and why?</p>
        <p>Q- What style would you like the website to reflect i.e. Funky, Professional, Simple, Sober, Cutting Edge?</p>
        <p>Q- What colours would you like incorporated beyond your logo?</p>
        <p>Q- What colours would you not like incorporated into the website?</p>
        <p>Q- Please list some sample websites you like and list some of the reasons why?</p>
    </div>
    
	<div class="workflow_content" id="flow4">
    	<h1 class="workflow_hd">Essential Tools</h1>
        <p>In order to facilitate good communications with our clients, we recommend that they use the following free software tools. These tools make the communications process function smoothly and save time and effort, 
        on both the part of our clients and eTraffic Web Design.</p>
        
        <h1 class="workflow_hd">Drop Box</h1>
        <p>We recommend the use of Dropbox for all file sharing. Sending files by email can be problematic and many large files cannot be sent by email. In addition, it can get very confusing as to what has been sent and what we have actually received.</p>
        <p>DropBox uses folders stored online via an iCloud system so you can simply upload any type of file i.e. Word Doc, Excel Spreadsheet, MP3, JPEG images and even full length videos, which your Project Manager will have instant access to.</p>
        <p>If you currently have any photos or content that your wish to incorporate into your site, please upload it to DropBox.</p>
        
        <h1 class="workflow_hd">Jing</h1>
        <p>A free software which seamlessly integrates into any desktop or laptop computer. Once you have installed this software you are able to take print screens of any designs we send you and write your changes directly onto the image.</p>
        <p>This allows us to instantly visualise your change requirements, rather than attempting to interpret a text only message, which can often lead to a misinterpretation of your needs, saving both of us time and effort.</p>
        
        <h1 class="workflow_hd">Basecamp</h1>
        <p>We use Basecamp for our project management both internally and externally, ensuring continuous communication throughout the entire Web Design process.</p>
        <p>You receive instant email updates as soon as they are completed. You can also see the history of any communications you have with us and vice versa. Any changes you make through 'Jing' can be uploaded directly 
        into Basecamp enabling your Project Manager can act on them immediately.</p>
        
        <h1 class="workflow_hd">Shutterstock</h1>
        <p>This is the website you can use to search through literally millions of separate high quality stock images for your website. Later on, we will present the most effective mechanism for communicating them to your project manager.</p>
        
        <h1 class="workflow_hd">Hosting &amp; Domain Info</h1>
        <p>Unless you know how to upload a website yourself we will require the login information for your website host and domain name. If you do not have one eTraffic Domains offers hosting packages for as little as $19.00 +GST per month.</p>
    </div>
    
	<div class="workflow_content" id="flow5">
        <h1 class="workflow_hd">Home Page Design</h1>
        <p>We go through the detailed steps outlined above and thoroughly analyse all the information that was compiled.</p>
        <p>Once we have a comprehensive view of your requirements, we are ready to proceed with the design of your home page.</p>
    </div>
    
	<div class="workflow_content" id="flow6">
        <h1 class="workflow_hd">Home Page Confirmation</h1>
        <p>We will create a static non-clickable image of your home page so you can visualise the page layout to determine if it is commensurate with your needs.</p>
        <p>During this stage, if you are satisfied with the structure of the page, you can confirm this layout. Otherwise, you can communicate any changes you would like us to make.</p>
        <p>If there are any changes that you would like to make, you can communicate them to us using 'Jing', the free software we recommended. Number the changes on the design, and then send these files to us using DropBox.</p>
        <p>At times, this can be an iterative, back and forth process, until we come up with a design that satisfies your needs. We want you to be 100% satisfied with the appearance of your Home Page.</p>
        <p>NOTE: Once confirmed nothing on the page can be altered structurally. Only images and content can be changed during one of the stages. If changes are required after confirmation, additional charges may apply.</p>
    </div>
    
	<div class="workflow_content" id="flow7">
        <h1 class="workflow_hd">Home Page Html</h1>
		<p>After confirmation that you are completely satisfied with your home page design, we transform your static image into a coded one-page web site.</p>
		<p>This process normally takes 72 hours, as our developer codes the individual sections of your web page. After the coding is complete, the web page is uploaded on our server for you to view.</p>
    </div>
    
	<div class="workflow_content" id="flow8">
        <h1 class="workflow_hd">Inner Page Design</h1>
        <p>The inner pages are simply an extension of the home page theme.</p>
        <p>Most often we will incorporate the same look, feel, flow, typography, font and colour palette of the home page in all of the inner pages.</p>
        <p>Content for these pages will be added in Step 10, below.</p>
    </div>
    
	<div class="workflow_content" id="flow9">
        <h1 class="workflow_hd">Inner page confirmation</h1>
        <p>The confirmation process associated with the inner pages is identical to the home page confirmation process described in step 6, above.</p>
        <p>You will use 'Jing' to make your changes, number them, and then send the files to us on DropBox.</p>
        <p>NOTE: Once confirmed nothing on the page can be altered structurally. Only images and content can be changed during one of the stages. If changes are required after confirmation, additional charges may apply.</p>
    </div>
    
	<div class="workflow_content" id="flow10">
        <h1 class="workflow_hd">Content and Images</h1>
    
        <p>After the design and confirmation of all of the web pages, they must be populated with text and images. You should have a clear concept of the images and text you desire for each page.</p>
        <p>Content: It is vital that you maintain the character and word count that is provided on each page. Inner pages have a specific amount of space that is allocated for image and text content.</p>
        <p>To maintain the appearance of the page, it is imperative to stay within these constraints:</p>
        <ul class="workflowlist">
            <li>If you provide too much content it may not fit in the space provided, which if not altered, will require design changes which could result in additional charges.</li>
            <li>If you don't provide enough content there may be an excess of blank space,destroying the overall look and feel of the page.</li>
        </ul>
        <p>Images: On every page there are images that may need to be replaced. We use stock images from 'Shutterstock' so you can use as many of them as you would like at no cost, since we already have a subscription.</p>
        
        <p>We can also incorporate your own custom images into your site, if you so choose.</p>
        
        <p>For Stock Images please go to:</p>
        
        <p>
        Go to www.shutterstock.com<br/>
        Search for the relevant keyword i.e.; Beautiful Sunset<br/>
        Choose the image you would like to use on the site<br/>
        Right click and save to your computer. The filename should be the same as the page it will appear on i.e. 'About Us' That way we know exactly where you would like it to go.<br/>
        Upload to DropBox<br/>
        </p>
    </div>
    
	<div class="workflow_content" id="flow11">
        <h1 class="workflow_hd">Inner Page Html</h1>
        <p>This process is very similar to step 7, where the Home Page HTML was generated.</p>
        <p>Normally, inner page coding is not nearly as complex as Home Page coding, since these pages are generally not as complex as the Home Page and they are an extension of the Home Page that was already coded.</p>
    </div>
    
	<div class="workflow_content" id="flow12">
        <h1 class="workflow_hd">Content &amp; Image Transfer</h1>
    	<p>Using the text and images you have provided and uploaded to DropBox, our developers will embed this content into the pages of your site.</p>
    </div>
    
	<div class="workflow_content" id="flow13">
        <h1 class="workflow_hd">Content Management System (CMS) Integration</h1>
        <p>Every website we build has a Content Management System (CMS) built in. Which one depends on the type of website you have.</p>
        <p>A CMS is necessary for you to be able to easily add, remove, and alter site content without needing the services of a web developer.</p>
        <p>It provides a straightforward mechanism for our customers to make changes to their site, and it does not require any web development training or knowledge to do so.</p>
        <p>Through the CMS you will be able to:</p>
        <ul class="workflowlist">
            <li>Add/Remove Web Pages</li>
            <li>Add or alter content</li>
            <li>Add/Remove/Change images</li>
        </ul>
    </div>
    
	<div class="workflow_content" id="flow14">
        <h1 class="workflow_hd">Testing</h1>
        <p>At this point, all site design and development is complete.</p>
        <p>We thoroughly test the site to ensure</p>
        <ul class="workflowlist">
            <li>The navigation functions properly; and</li>
            <li>All functionality has been incorporated into the site properly</li>
        </ul>
        <p>We develop very robust sites, and thoroughly test them to ensure that our customers rarely have any issues.</p>
        <p>Our testing is extremely thorough, resulting in a finished product that is normally error free.</p>
    </div>
    
	<div class="workflow_content" id="flow15">
        <h1 class="workflow_hd">Final Confirmation</h1>
        <p>Now its your turn to examine the finished product and make sure it meets with your approval.</p>
        <p>Any issues that you identify will be quickly rectified.</p>
        <p>Once you have confirmed that you are satisfied with your site, we start preparing to launch your new site!</p>
    </div>
    
	<div class="workflow_content" id="flow16">
        <h1 class="workflow_hd">Website Launch</h1>
        <p>When launching your site, we use the domain and host information that you provided to us, or that we have obtained for you at your request.</p>
        <p>We then begin the process of preparing and mapping your site for launch.</p>
        <p>It normally takes a maximum of 48 hours for your site to go live.</p>
    </div>
    
    
</div>
</div>


<script type="text/javascript">

showflow(cirval);

function flowprevnext(btn){
	
	var curval = parseInt($('#current_cir').val());
	var plusval =  parseInt(curval + 1);
	var minusval =  parseInt(curval - 1);
	
	var myArray = [ "Business Needs Analysis", "Mapping the Website", "Questionnaires", "Essential Tools", "Home Page Design", "Home Page Confirmation", "Home Page Html", "Inner Page Design", "Inner page confirmation", "Content and Images", "Inner Page Html", "Content & Image Transfer", "Content Management System (CMS) Integration", "Testing", "Final Confirmation", "Website Launch" ];
	

	if(btn=='prev'){
	
		if(curval==1){
			showflow(1);
		}else{
			var newval = parseInt(curval - 1);
			$('#current_cir').val(newval);
			showflow($('#current_cir').val());
		}
		
		if(curval>1 && curval<16){
			$('#workflow_arrow_left').text('# '+(newval-1));
			$('#workflow_arrow_right').text('# '+(newval+1));	
			
			$('#flowhd_left').text(myArray[newval-2]);
			$('#flowhd_right').text(myArray[newval]);	
		}
		else if(curval==1){
			$('#workflow_arrow_left').text('# 1');
			$('#workflow_arrow_right').text('# 3');	
			
			$('#flowhd_left').text(myArray[0]);
			$('#flowhd_right').text(myArray[2]);	
			
		}else if(curval==16){
			$('#workflow_arrow_left').text('# 15');
			$('#workflow_arrow_right').text('# 16');
			
			$('#flowhd_left').text(myArray[14]);
			$('#flowhd_right').text(myArray[15]);	
		}
		
		
	}else{
		
		if(curval==16){
			showflow(16);
		}else if(curval<16){
			var newval = parseInt(curval + 1);
			$('#current_cir').val(newval);
			showflow($('#current_cir').val());
		}
		
		if(curval>1 && curval<15){
			$('#workflow_arrow_left').text('# '+(newval-1));
			$('#workflow_arrow_right').text('# '+(newval+1));
				
			$('#flowhd_left').text(myArray[newval-2]);
			$('#flowhd_right').text(myArray[newval]);	
		}
		else if(curval==1){
			$('#workflow_arrow_left').text('# 1');
			$('#workflow_arrow_right').text('# 3');	
			
			$('#flowhd_left').text(myArray[0]);
			$('#flowhd_right').text(myArray[2]);	
			
		}else if(curval==16){
			$('#workflow_arrow_left').text('# 15');
			$('#workflow_arrow_right').text('# 16');
			
			$('#flowhd_left').text(myArray[14]);
			$('#flowhd_right').text(myArray[15]);	
		}
	}
}


function showflow(cirval){
	
	$('#current_cir').val(cirval);

	for(var i=1; i<=16; i++)
	{
		if(i<=cirval)
		$('#cir'+i).addClass('active');
		else
		$('#cir'+i).removeClass('active');
	}
	

	if($(window).width()>=1440){
		
		if(cirval>=7 && cirval<=16)
		{
			for(j=1; j<=16; j++){
				if(j>=(cirval-6) && j<=cirval)
				$('#cir'+j).show('slow');
				else
				$('#cir'+j).hide('slow');	
			}
		}
		
	} 
	else if($(window).width()<1440 && $(window).width()>=1280) {	

		if(cirval>=6 && cirval<=16)
		{
			for(j=1; j<=16; j++){
				if(j>=(cirval-5) && j<=cirval)
				$('#cir'+j).show('slow');
				else
				$('#cir'+j).hide('slow');	
			}
		}
	}
	else if($(window).width()<1280 && $(window).width()>=960) {	

		if(cirval>=4 && cirval<=16)
		{
			for(j=1; j<=16; j++){
				if(j>=(cirval-3) && j<=cirval)
				$('#cir'+j).show('slow');
				else
				$('#cir'+j).hide('slow');	
			}
		}
	}
	else if($(window).width()<960 && $(window).width()>=640) {	

		if(cirval>=3 && cirval<=16)
		{
			for(j=1; j<=16; j++){
				if(j>=(cirval-2) && j<=cirval)
				$('#cir'+j).show('slow');
				else
				$('#cir'+j).hide('slow');	
			}
		}
	}
	else if($(window).width()<640) {	

		if(cirval>=1 && cirval<=16)
		{
			for(j=1; j<=16; j++){
				if(j>=(cirval-0) && j<=cirval)
				$('#cir'+j).show('slow');
				else
				$('#cir'+j).hide('slow');	
			}
		}
	}
	
	$('.workflow_content').hide();		
	$('#flow'+cirval).show();

}


$(window).resize(function(){
	$('#current_cir').val(1);
	flowprevnext('prev');
});

</script>


<?
include "getquote.php";

}
include "template.php";
?>