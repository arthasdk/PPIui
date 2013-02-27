//validate.js: validation script

function validateMail(x){
	mailpatrn="[a-z0-9]*[@]{1}[a-z0-9]*[\\.]{1}[a-z]{3}|[a-z0-9]*[@]{1}[a-z0-9]*[\\.]{1}[a-z]{2}[\\.]{1}[a-z]{2}";
	regex=new RegExp(mailpatrn);
	return regex.test(x);
}

function validate(x,y){
	//x is the string to be evaluated, y the string to be eval'd by
	regex=new RegExp(y);
	return regex.test(x);
}

function validateAll(){
	mail=document.getElementById('email').value;
	if(!validateMail(mail)){
		window.alert("Invalid mail");
		return false;
	}
	name=document.getElementById('name').value;
	if(!validate(name,"[a-zA-Z]*[\\s]{1}[a-zA-Z]*|[a-zA-Z]*[\\s]{1}[a-zA-Z]*[\\s]{1}[a-zA-Z]*")){
		window.alert("Invalid name. Provide full name");
		return false;
	}
	seq1=document.getElementById('seq1').value;
	seq2=document.getElementById('seq2').value;
	if(seq1.length==0 || seq2.length==0){
		window.alert("Null Protein sequence disallowed");
		return false;
	}
	
	return true;
}

function validateJobid(){
	id=document.getElementById('job').value;
	if(!validate(id,"[0-9]{10}")){
		//only allow 10-digit job id, nothing else
		return false;
	}
	return true;
}
