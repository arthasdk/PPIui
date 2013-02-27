<?php
$jobid=$_GET['job'];
if(empty($jobid)){
	echo "JE"; //job id error
	exit();
}else{
	$dp="../files/".$jobid;
	if(is_dir($dp)){
		//valid jpb id, directory exists
		$statf=$dp."/"."output_final.txt";
		if(is_file($statf)){
			header('Content-Description: File Transfer');
     			header('Content-Type: text/plain');
     			header('Content-Disposition: attachment; filename='.basename($dp));
     			header('Content-Transfer-Encoding: binary');
     			header('Content-Length: '.filesize($dp));
     			ob_clean();
     			flush();
     			readfile($dp);
		}else{
			//echo "FE"; //file error, does not exist
			exit();
		}
	}else{
		//echo "JE"; //invalid job id
		exit();
	}
}
exit(); //redundant
?>
