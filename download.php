<?php
require_once 'php/Connect.php';
require_once 'php/Core.php';

/*
	Note: 
	$_GET['file'] will use the get function in order to be able to use a link to download the file.
	$savename is what the file name will be when the user downloads the program. You can fetch it from an sql database. This is for safety reasons as removing the file type (ie. .exe or .php files) is a practice for file uploads
	The most important part of this php file is the header parts. The header parts fool the browser into thinking that it is openning a certain type of file. This php script then reads the file that is in the server then gives a file download/save prompt to the user.
*/


function download_file() {
	//Check for download request:
	if(isset($_GET['file'])) {
		//Make sure there is a file before doing anything
		if(is_file($file)) {
			//Find Mime Type
			//$finfo = new finfo(FILEINFO_MIME);
			//Below required for IE:
			if(ini_get('zlib.output_compression')) {
			ini_set('zlib.output_compression', 'Off');
			}
			//if there is something in output buffer, clean it
			if(ob_get_length()) ob_clean();
			//Set Headers (parts you should play around):
			header('Pragma: public');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT');
			//header('Content-Type: application/force-download');
			header('Content-Type: image/jpeg');
			//header('Content-Type: application/octet-stream');
			//header('Content-Disposition: inline; filename="' . basename($_GET['file']) . '"');
			//header('Content-Transfer-Encoding: binary');
			header('Content-Description: File Transfer');
			header('Content-Length: ' . filesize($file));
			header("Content-Disposition: attachment; filename=\"$savename\"");
			header('Connection: close');
			readfile($file);
			exit();
			finfo_close($finfo);
		} else {
		$this->show_notification('File not found!', 'error');
		}
	}
}

?>