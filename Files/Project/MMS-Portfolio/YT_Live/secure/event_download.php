<?
$file='uploads/event_files/'.$_REQUEST['fileid'];
header('Content-Disposition: attachment; filename="'.$_REQUEST['filename'].'"');
header('Content-Length: ' . filesize($file));
@readfile($file);
?>