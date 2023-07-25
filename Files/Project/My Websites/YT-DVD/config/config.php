<?

session_start();
define("BA_DBHOST", "localhost");
define("BA_DBUSER", "yelloa3s_yellowt");
define("BA_DBPASSWORD", "GU=^%;gnu~;)");
define("BA_DBNAME", "yelloa3s_yellowtrain");  

    //Constants
define ('BASE_URL', 'http://www.yellowtrainschool.com/');
define ('BASE_ADMIN_URL', 'http://www.yellowtrainschool.com/admin');
define("SUBDIR", "/") ;


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
$max_file_size = $confval *100* 1024 * 1024; 
	
define("MAX_FILE_SIZE", $max_file_size);
define("MAX_FILE_SIZE_IN_MB", $confval . " MB");
define("SITE_TMP_DIR", SITE_DOCUMENT_ROOT.'uploads/tmp/');
define("HREF_TMP_DIR", SITE_HTTP.'uploads/tmp/');

define("SCHOOL_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/school_photos/');
define("SCHOOL_FILE_HREF",  SITE_HTTP.'uploads/school_photos/');
define("SCHOOL_FILE_REL",  'uploads/school_photos/');

define("TEACHER_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/teacher_photos/');
define("TEACHER_FILE_HREF",  SITE_HTTP.'uploads/teacher_photos/');
define("TEACHER_FILE_REL",  'uploads/teacher_photos/');

define("DRIVER_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/driver_photos/');
define("DRIVER_FILE_HREF",  SITE_HTTP.'uploads/driver_photos/');
define("DRIVER_FILE_REL",  'uploads/driver_photos/');

define("EVENT_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/event_files/');
define("EVENT_FILE_HREF",  SITE_HTTP.'uploads/event_files/');
define("EVENT_FILE_REL",  'uploads/event_files/');

define("EVENT_GALLERY_PATH",  SITE_DOCUMENT_ROOT.'uploads/event_gallery/');
define("EVENT_GALLERY_HREF",  SITE_HTTP.'uploads/event_gallery/');
define("EVENT_GALLERY_REL",  'uploads/event_gallery/');

define("STUDENT_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/student/student_photo/');
define("STUDENT_FILE_HREF",  SITE_HTTP.'uploads/student/student_photo/');
define("STUDENT_FILE_REL",  'uploads/student/student_photo/');

define("FAMILY_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/student/family_photo/');
define("FAMILY_FILE_HREF",  SITE_HTTP.'uploads/student/family_photo/');
define("FAMILY_FILE_REL",  'uploads/student/family_photo/');

define("DOCUMENT_FILE_PATH",  SITE_DOCUMENT_ROOT.'uploads/student/document/');
define("DOCUMENT_FILE_HREF",  SITE_HTTP.'uploads/student/document/');
define("DOCUMENT_FILE_REL",  'uploads/student/document/');

define("NEWSLETTER_PATH",  SITE_DOCUMENT_ROOT.'uploads/newsletter_files/');
define("NEWSLETTER_HREF",  SITE_HTTP.'uploads/newsletter_files/');
define("NEWSLETTER_REL",  'uploads/newsletter_files/');

define("CIRCULAR_PATH",  SITE_DOCUMENT_ROOT.'uploads/circular_files/');
define("CIRCULAR_HREF",  SITE_HTTP.'uploads/circular_files/');
define("CIRCULAR_REL",  'uploads/circular_files/');

define("BLOG_PATH",  SITE_DOCUMENT_ROOT.'uploads/blogs/');
define("BLOG_HREF",  SITE_HTTP.'uploads/blogs/');
define("BLOG_REL",  'uploads/blogs/');

define("ARTICLE_PATH",  SITE_DOCUMENT_ROOT.'uploads/blogs_article/');
define("ARTICLE_HREF",  SITE_HTTP.'uploads/blogs_article/');
define("ARTICLE_REL",  'uploads/blogs_article/');

$GLOBALS['AccessType'] = array('All'=>"All Access", 'A'=>"Add", 'V'=>"View", 'U'=>"Update", 'D'=>"Delete");
$GLOBALS['SessionType'] = array('F'=>"Free", 'P'=>"Paid");
$GLOBALS['Section'] = array('A'=>"A", 'B'=>"B", 'C'=>"C", 'D'=>"D", 'E'=>"E");
$GLOBALS['CircularMailType'] = array('NS'=>"Newsletter Contacts", 'S'=>"Parent", 'T'=>"Teacher", 'TEST'=>"Test Mail");

define("SITE_EMAIL",  'communications@yellowtrainschool.com');
define("TO_EMAIL",  'kavitharjn@gmail.com');
define("FROM_EMAIL",  'communications@yellowtrainschool.com');
define("TO_MOBILE",  '9943032500');
define("FROM_NAME",  'YT Communications Team');

date_default_timezone_set('Asia/Calcutta'); 

//ini_set('display_errors',1);

?>