<?php // download.php
//work using a downloader
 $req=$_GET['file'];
 $file="";
 if($req=="hs"){//homo sapiens
 $file = '../db/hetro_samepdb_ophsapi20100614.txt';
 }
 else if($req="ye"){//yeast
 $file = '../db/hetro_samepdb_opscere20100614.txt';
 }
 else if($req="ec"){//E.coli
 $file = '../db/hetro_samepdb_opecoli20100614.txt';
 }else{
 	exit();
 }
 if(empty($req)){
 	exit();
 }
 if (file_exists($file)) {
     // send headers that indicate file download
     header('Content-Description: File Transfer');
     header('Content-Type: text/plain');
     header('Content-Disposition: attachment; filename='.basename($file));
     header('Content-Transfer-Encoding: binary');
     header('Content-Length: '.filesize($file));
     ob_clean();
     flush();
     readfile($file);
     exit;
 }
