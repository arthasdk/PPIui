//submitting details through ajax jquery

var ts="";

function submitDetails(){
name=document.getElementById('name').value;
mail=document.getElementById('email').value;
seq1=document.getElementById('seq1').value;
seq2=document.getElementById('seq2').value;
spec=document.getElementById('species');
species="";
for(i=0;i<spec.length;i++){
	if(spec.options[i].selected){
		species=spec.options[i].value;
		}
	}
$.ajax({
	type: "POST",
	url: "starter.php",
	data:{name: name, email: mail, seq1: seq1, seq2: seq2, species: species}
	}
).done(
	function(x){
		if(x=="MM"){ window.alert("Email missing"); }
		else if(x=="NM"){ window.alert("Name missing"); }
		else if(x=="S1M" || x=="S2M"){ window.alert("Sequence missing"); }
		else if(x.substr(0,2)=="EX"){
		ts=x.substr(2);
		document.getElementById('job').value=ts;
		window.alert("Analysing...");
		}
		else{
			window.alert(x);
		}
		
	}
);
}

function checkJobStatus(){
j=document.getElementById('job').value;
if(j.length>0){
$.ajax({
type: "GET",
url: "tools/getStatus.php?job="+j
}).done(
function(x){
if(x=="JE"){window.alert("Invalid Job#");}
else if(x=="FE"){window.alert("Error while fetching records");}
else{
pc=parseInt(x);
$( "#progressbar" ).progressbar({
value: pc
});
if(pc==100){
document.getElementById("res").innerHTML="<a href='tools/getResult.php?job="+document.getElementById('job').value+"'>Result</a>";
window.alert("Job Done!!!");
}else{
window.setTimeout('checkJobStatus()',500);

}
}
}
);
}
}
