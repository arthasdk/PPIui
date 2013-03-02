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
     			header('Content-Disposition: attachment; filename='.$jobid.'-'.basename($statf));
     			header('Content-Transfer-Encoding: binary');
     			header('Content-Length: '.filesize($statf));
     			//ob_clean();
				readfile($statf);
     			flush();
     			
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
