<?php

// tables include
require_once("includes/Config.tbl.inc.php");
// configuration
require_once("config/config.php");

// database connection
require_once("classes/dB.php");
require_once("classes/DatabaseConnection.php");
require_once("classes/FileUpload.php");
require_once("classes/Table.php");

require_once("classes/User.php");
require_once("classes/School.php");
require_once("classes/Student.php");
require_once("classes/Teacher.php");
require_once("classes/Grade.php");
require_once("classes/Subject.php");
require_once("classes/Transportation.php");
require_once("classes/Events.php");
require_once("classes/EventSession.php");
require_once("classes/EventComments.php");
require_once("classes/EventPhotos.php");
require_once("classes/EventPhotoComments.php");
require_once("classes/NewsletterSub.php");
require_once("classes/EventRegistration.php");
require_once("classes/Circular.php");
require_once("classes/Contact.php");
require_once("classes/Blog.php");

require_once('phpMailer/class.phpmailer.php');

// load basic support methods
require_once("includes/functions.php");
require_once("includes/Session.php");


$GLOBALS['PageTitle'] = array('belief.php'=>array('Title'=>"Our Belief & Values", 
												  'SubTitle'=>"this is what  <br /> we are all about"),
							  'yt_methodology.php'=>array('Title'=>"Methodology", 
							  							  'SubTitle'=>"waldorf education strives <br /> to transform education into an art"),
							'press.php'=>array('Title'=>"In the Press", 
							  							  'SubTitle'=>"our engagements with  <br />the community"),
								'videos.php'=>array('Title'=>"Videos", 
							  							  'SubTitle'=>"experience our world <br/> become children again"),						  							  
							  'curriculum.php'=>array('Title'=>"Curriculum", 
							  					      'SubTitle'=>"our curriculum is enlivened <br /> in the hands of our teachers",
													  'SubMenu'=>array(array('Id'=>"onclick='show_curriculam(&quot;CD&quot;)'", 'MenuItem'=>"Cognitive Development"), array('Id'=>"onclick='show_curriculam(&quot;AD&quot;)'", 'MenuItem'=>"Artistic Development"), array('Id'=>"onclick='show_curriculam(&quot;HD&quot;)'", 'MenuItem'=>"Handwork"), array('Id'=>"onclick='show_curriculam(&quot;PD&quot;)'", 'MenuItem'=>"Physical Development"), array('Id'=>"onclick='show_curriculam(&quot;AS&quot;)'", 'MenuItem'=>"Assessments"))
													  ),
							  'yt_practices.php'=>array('Title'=>"YT Practices", 
							  						    'SubTitle'=>"the practices that let our children <br />experience the magic of childhood"),
														
							 /* 'funstop.php'=>array('Title'=>"Events", 
							  					   'SubTitle'=>"YT always celebrates the magic of childhood <br /> by organizing fun filled events throughout the year",
												   'SubMenu'=>array(array('Id'=>"onclick='show_stop(&quot;events&quot;)'", 'Class'=>"funstop_events", 'MenuItem'=>"Upcoming Events", 'URL'=>"href='".getSeoUrl(array('pn'=>'funstop.php','Type'=>'events'))."'"), array('Id'=>"onclick='show_stop(&quot;gallery&quot;)'", 'Class'=>"funstop_gallery", 'MenuItem'=>"Gallery", 'URL'=>"href='".getSeoUrl(array('pn'=>'funstop.php','Type'=>'gallery'))."'"))
												   ),*/
												   
								'funstop.php'=>array('Title'=>"Gallery", 
							  					   'SubTitle'=>"here and there, <br /> some of our memories"),				   
												   
							  'contact.php'=>array('Title'=>"Contact Us", 
							  					   'SubTitle'=>"we would love to <br/>hear from you  ")	,
												   
							  'faq.php'=>array('Title'=>"Frequently Asked Questions (FAQ)", 
							  					   'SubTitle'=>"To know more<br/>Yellow Train School")	,
							
							
							  'joinus.php'=>array('Title'=>"Join Us", 
							  					   'SubTitle'=>"Be a part of <br/>the YT Family")	,

												   
							  'free_human_being.php'=>array('Title'=>"The Free Human Being", 
							  					   			'SubTitle'=>"Freedom, to us, means the choice and the capability<br/>to be oneself at the core, at the deepest level.", ) );
							 
							 

$GLOBALS['FooterArr'] = array('yt_grade_school.php'=>array('Title'=>"What to Explore Next ?", 'Items'=>array(array('URL'=>"href='".getSeoUrl(array('pn'=>'yt_methodology.php'))."'", 'ItemName'=>"Methodology"), array('URL'=>"href='".getSeoUrl(array('pn'=>'yt_practices.php'))."'", 'ItemName'=>"YT Practices"), array('URL'=>"href='".getSeoUrl(array('pn'=>'curriculum.php'))."'", 'ItemName'=>"Curriculum")) ));							 

 

ob_start();
session_start();
ini_set('display_errors',0);
?>