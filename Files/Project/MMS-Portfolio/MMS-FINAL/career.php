<?
function main(){
?>

<? include "page_header.php"; ?>


<div class="content_outer">
    <div class="content career_parag">
    
    <div class="page_title">JOIN US... CAREERS</div>
	
	<div class="career_subcnt" >
		<p>Are you interested in joining an exciting, fast-paced and highly-respected creative digital agency? We &#768;re always on the lookout
		 for inspired geeks and gurus to join our team and help us grow.</p> 
		 
		<p>Send your CV and a bit about yourself to: <strong>careers@mms.com</strong></p>
	</div>
	
	<div class="career_content" id="career_space">
		<div class="career_subhead">Do you have what it takes?</div>
		
		<p>Creative digital agency marketing is fast-paced. It is often thought-provoking, sometimes demanding and always exciting. If you &#768;re the
		 kind of person who thrives on new challenges, who is always keeping up to date with the latest technology, who has a genuine passion for
		 online marketing and has the motivation to build a career at a respected agency... we want to hear from you!</p>
		<p>Everything we do is about communication... whether we &#768;re talking to our clients or moulding their brand messages for their customers. 
		So aside from having best-in-class digital skills and proficiency, you must also be an honest, open, ethical communicator with great interpersonal skills.</p>
	</div>
	
	<div class="career_content">
		<div class="career_subhead">Do we have what it takes?</div>
		<p>As a digital agency we focus on offering our clients the very best in creative design, web development and online marketing.
		 If your skills are in the creative, technical or marketing arena then we &#768;re sure you &#768;ll find the outlet you &#768;ve always wanted to 
		 show your stuff off to the industry... not to mention all the support you could possibly need to grow as a digital specialist.</p>
		<p>Our salary packages are competitive, the environment is friendly and relaxed, the work is challenging and our clients give us bigger 
		budgets for evermore exciting projects all the time. Join us today, help us shape the future of this agency and make an indelible mark on the industry.</p>
	</div>

	</div>
</div>

<div class="content_outer" style="background-color:#f1f1f1;">
    <div class="content">
		<div class="page_title">CURRENT VACANCIES</div>
		
		<div align="center" class="current_vac">
			<p>We currently have the following vacancies</p>
			<div>PHP DEVELOPER <br/> <a href="<?=getSeoUrl(array('pn'=>'career_form.php','Type'=>'PHPDEV'))?>" target="_blank"><img src="images/applay_now.jpg" alt="Apply now"/></a></div> 
			<div>JUNIOR PHP DEVELOPER<br/> <a href="<?=getSeoUrl(array('pn'=>'career_form.php','Type'=>'JPHPDEV'))?>" target="_blank"> <img src="images/applay_now.jpg" alt="Apply now"/></a></div>
		</div>
		
	</div>
</div>

<?
}
include "template.php";
?>