<?
$dev_server = TRUE;
define("LOCAL",true);
session_start();

if($dev_server)
{
	//Dev Database credentials
	define("BA_DBHOST", "localhost");
	define("BA_DBUSER", "root");
	define("BA_DBPASSWORD", "mysql");
	define("BA_DBNAME", "Test");
	
	//Constants
	define("BASE_URL", "http://192.168.1.126/training/new_folder/");
	define("BASE_ADMIN_URL", "http://192.168.1.126/training/new_folder/admin/");
	define("EMAIL_TEMPLATE_DIR", "/home/user/public_html/sp/email_templates/");
	define("ERROR_EMAIL_ADDRESSES", "kavitharjn@gmail.com");
	define("SUBDIR", "training/new_folder");
}

define("REMOTE_ADDR", $_SERVER["REMOTE_ADDR"]);

/*
$dev_server = TRUE;
define("LOCAL", true);
session_start();

if ($dev_server) {

	// Dev Database credentials
	define("BA_DBHOST", "localhost");
	define("BA_DBUSER", "root");
	define("BA_DBPASSWORD", "mysql");
	define("BA_DBNAME", "stemi2014");
	
	//Constants
	define ('BASE_URL', 'http://192.168.1.126/stemi2014/');
	define ('BASE_ADMIN_URL', 'http://192.168.1.126/stemi2014/admin/');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
	define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "stemi2014/");

} else {

	define("BA_DBHOST", "Localhost");
	define("BA_DBUSER", "isvirtwo_isvir14");
	define("BA_DBPASSWORD", "IpE3.x5!tk-!");
	define("BA_DBNAME", "isvirtwo_isvir2014");  

    //Constants
	define ('BASE_URL', 'http://www.stemiindia2014.com/');
	define ('BASE_ADMIN_URL', 'http://www.stemiindia2014.com/admin');
	define ('EMAIL_TEMPLATE_DIR', '/home/user/public_html/sp/email_templates/');
	define ('ERROR_EMAIL_ADDRESSES', 'kavitharjn@gmail.com');
	define("SUBDIR", "/") ;

} // End if dev server 

define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"]."/");
define("SITE_DOCUMENT_ROOT", DOCUMENT_ROOT . SUBDIR );
define("HTTP_HOST", $_SERVER["HTTP_HOST"]);
define("REMOTE_ADDR", $_SERVER["REMOTE_ADDR"]);
define("SERVER_ADDR", $_SERVER["SERVER_ADDR"]);
define("SERVER_NAME", $_SERVER["SERVER_NAME"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);
define("SCRIPT_NAME", $_SERVER["SCRIPT_NAME"]);
define("PHP_SELF", $_SERVER["PHP_SELF"]);
define("PATH_ROOT", dirname(PHP_SELF)=='/'?'':dirname(PHP_SELF));
define("FILE_NAME", basename(PHP_SELF));
define("SITE_HTTP", BASE_URL);
define("SITE_HTTPS", BASE_URL);
define("NEWS_IMAGES", BASE_URL.'newsletter/images/');

$confval = ini_get("upload_max_filesize");
$confval = substr($confval,0,strlen($confval)-1);
$max_file_size = $confval * 1024 * 1024; 
	
define("MAX_FILE_SIZE", $max_file_size);
define("MAX_FILE_SIZE_IN_MB", $confval . " MB");
define("SITE_TMP_DIR", SITE_DOCUMENT_ROOT.'uploads/tmp/');
define("HREF_TMP_DIR", SITE_HTTP.'uploads/tmp/');

define("FACULTY_PATH",  SITE_DOCUMENT_ROOT.'uploads/faculty/');
define("FACULTY_HREF",  SITE_HTTP.'uploads/faculty/');
define("FACULTY_REL",  'uploads/faculty/');

define("FACULTYFLAG_PATH",  SITE_DOCUMENT_ROOT.'uploads/flags/');
define("FACULTYFLAG_HREF",  SITE_HTTP.'uploads/flags/');
define("FACULTYFLAG_REL",  'uploads/flags/');

define("ABSTRACT_PATH",  SITE_DOCUMENT_ROOT.'uploads/abstractfile/');
define("ABSTRACT_HREF",  SITE_HTTP.'uploads/abstractfile/');
define("ABSTRACT_REL",  'uploads/abstractfile/');

define("SPONSOR_PATH",  SITE_DOCUMENT_ROOT.'uploads/sponsors/');
define("SPONSOR_HREF",  SITE_HTTP.'uploads/sponsors/');
define("SPONSOR_REL",  'uploads/sponsors/');

define("NEWSLETTER_PATH",  SITE_DOCUMENT_ROOT.'uploads/newsletterfile/');
define("NEWSLETTER_HREF",  SITE_HTTP.'uploads/newsletterfile/');
define("NEWSLETTER_REL",  'uploads/newsletterfile/');

$GLOBALS['PPTARR'] = array('CM'=>'Red.ppt','CV'=>'Grey.ppt','EP'=>'Green.ppt','OL'=>'Blue.ppt');

$GLOBALS['ZONES'] = array('NorthZone'=>array('Jammu & Kashmir','Himachal Pradesh','Punjab','Uttarakhand(Formerly Uttaranchal)','Haryana','Delhi'),'WestZone'=>array('Rajasthan','Gujarat','Goa','Maharashtra'),'SouthZone'=>array('Andhra Pradesh','Karnataka','Kerala','Tamil Nadu'),'NorthCentralZone'=>array('Madhya Pradesh','Chattisgarh','Uttar Pradesh','Bihar','Jharkhand'),'NorthEastZone'=>array('Assam','Sikkim','Nagaland','Meghalaya','Manipur','Mizoram','Tripura','Arunachal Pradesh','West Bengal','Orissa'));

$GLOBALS['RegistrationFee'] = array('CA'=>5000,'ST'=>8000,'PG'=>5000,'IP'=>5000);

$GLOBALS['SteeringCommitteeInvitees'] = array('Dr. Petr Kala'=>'kalapetr7@gmail.com','Dr. Jagat Narula'=>'jagat.narula@mountsinai.org','Dr. Venu Menon'=>'menonv@ccf.org','Dr. Umesh Khot'=>'khotu@ccf.org');

$GLOBALS['SteeringCommitteeInviteesDesc'] = array('Dr. Petr Kala'=>'Chairman - Stent of Life','Dr. Jagat Narula'=>'','Dr. Venu Menon'=>'','Dr. Umesh Khot'=>'');


$GLOBALS['SteeringCommitteeParticipants'] = array('Dr. Thomas Alexander'=>'tomalex41@gmail.com','Dr. Mullasari Ajit S'=>'sulu_ajit57@yahoo.co.in','Dr. Zuzana Kaifoszova'=>'kaifosz@gmail.com','Dr. Narasimhan C' => 'calambur@hotmail.com', 'Dr. Prafulla G Kerkar'=>'prafullakerkar@rediffmail.com','Dr. Rajesh Rajani'=>'rrajani20@gmail.com','Dr. Bahuleyan C'=>'bahuleyan2001@yahoo.co.uk','Dr. Ranganath Nayak'=>'rangaradha@yahoo.com','Dr. Atul Mathur'=>'atul_mathur@hotmail.com','Dr. Iyengar S'=>'ssiyengar1945@gmail.com','The President - Cardiological Society of India'=>'Dr. K. Venugopal','The President, Association of Physicians of India'=>'Dr. Shashank R Joshi','GVK EMRI'=>'Dr. G V Ramana Rao- Executive Partner &. Head','Mr. Bhavesh'=>'bhavesh.kotak@astrazeneca.com','Mr. Pramod'=>'mv.pramod@av.abbott.com','Mr. Shiv Bhattacharya'=>'shivnath.bhattacharya@medtronic.com');


$GLOBALS['SteeringCommitteeParticipants1'] = array('Dr. Thomas Alexander','Dr. Mullasari Ajit S','Dr. Zuzana Kaifoszova','Dr. Narasimhan C', 'Dr. Prafulla G Kerkar','Dr. Rajesh Rajani','Dr. Bahuleyan C','Dr. Ranganath Nayak','Dr. Atul Mathur','Dr. Iyengar S','The President - Cardiological Society of India <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Dr. K. Venugopal','The President, Association of Physicians of India <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Dr. Shashank R Joshi','GVK EMRI <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Dr. G V Ramana Rao- Executive Partner &. Head','AstraZeneca - Mr. Bhavesh','Abbott Vascular - Mr. Pramod','Medtronic - Mr. Shiv Bhattacharya');

$GLOBALS['WorkshopTopics'] = array('ws1'=>array('A'=>'STEMI set up & Hardware','B'=>'ECG diagnosis of STEMI'),'ws2'=>array('A'=>'Devices in the cath Lab','B'=>'Medications in the CCU'),'ws3'=>array('A'=>'Strategies in Primary PCI','B'=>'Arrhythmia management in STEMI'),'ws4'=>array('A'=>'Cine review & teaching cases','B'=>'Medical management in STEMI patients'));


$GLOBALS['SPONSORS'] = array('Mr. Asad Khan'=>'asadk15@hotmail.com','Mr. Prasad Shetty'=>'prasad.shetty@av.abbott.com','Mr. Dinesh Nair'=>'dinesh.nair@sanofi.com','Mr. Dhaval Sampat'=>'d.sampat@biosensorsindia.com','Mr. Anuj K'=>'anuj.khushalani@gmail.com','Mr. Rahul Singh'=>'rahulsingh88@cipla.com','Mr. Sanjivan Reddy'=>'asanjivareddy@drreddys.in','Mr. Dilip'=>'honkamble_harshala_dilip@lilly.com','Mr. Mahesh Yarabatti'=>'mahesh.ry@emcure.co.in','Mr. Lalia'=>'ajaymaurya83@yahoo.com','Mr. Manjeeet'=>'manjeet.jha@glenmarkpharma.com','Mr. Sagunyeram'=>'sagunyeram@lupinpharma.com','Mr. Bipin Raul'=>'bipin.raul@medtronic.com','Mr. Mohsin Shaikh'=>'mohsin.shaikh@medtronic.com','Mr. Manish Singh'=>'manishsin1984@gmail.com','Mr. James Fernandes'=>'James.fernandes@in.netgrs.com','Mr. Vijendra'=>'vijendra1505@gmail.com','Ms. Deepika'=>'Deepika.Mundra@zhl.in','Mr. Kishore Jamgade'=>'kishore_jamgade@terumo.co.jp','Mr. Satish Mansukhani'=>'satish@unichemlabs.com','Mr. Sunil Gore'=>'sunilvijaygore@gmail.com');
*/
?>