$(function() {
$( "#tabs" ).tabs();
});
function validateAndSubmit(){
	if(validateAll()){
		//submit only if all validation rules are passed
		if(window.confirm("Proceed? are u sure ?")){
			uncheckMark();
			submitDetails();
			startCycle();
		}
	}else{
		//do nothing
	}
}

function validateAndCheckJobStatus(){
	if(validateJobid()){
		//jobid has been validated, ok to query server
		checkJobStatus();
	}else{
		//do nothing
	}
}

//the cycle that keeps on going when submitting a query
var feed=0;
var cycle=false; //initially false
cyc=document.getElementById('submitFeedback');
function cycleFeedback(){
	if(cycle){
		cyc.innerHTML=String(feed);
		feed=(feed+1)%8;
		window.setTimeout('cycleFeedback()',200);
	}else{
		cyc.innerHTML="";
	}
	
}

function stopCycle(){
	cycle=false;
}
function startCycle(){
	cycle=true;
}
function checkMark(){
	document.getElementById('cm').innerHTML=String(8); //check mark given
}
function uncheckMark(){
	document.getElementById('cm').innerHTML=""; //check mark given
}
