<?php
	session_start();
	if (!(isset($_SESSION['uid']))) header("location: index.php");//user didnt preform login		
	include "inc_db.php";
?>

<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>main</title>
<style>
@media print {
  h1 {
    color: #000;
    background-color: #fff;
    border:2px #999999 dotted;
  }
  #show_page,#bot { display:none;  }
  #show_print { display:block; }
}
@media only screen and (max-width: 1000px) {
  body {
    background-color: #000066;
    color:#FFFFCC;
  }
  h1{ background-color:white; color:#000066; }
  .upanddown { background-color:white; color:#000066; }
  p { font-family: Calibri Light; }
  .tdm:hover{
	background-color:#66FF66;
}
.tdr:hover{
	background-color:#66FF66;
}
#getupdateDaily,#getupdateSpecial{
	color:black;
}

}
.dontShow{
	height: 25px;
	border:0;
}
input{
	border-radius:3px;
}
#getupdateDaily,#getupdateSpecial{
	background-color:white;
	box-shadow: 0px 0px 20px #666;
	font-size:26px;
	position:fixed;
	display:none;  
	height:270px;
	top:50%;
	margin-top:-125px;
	width:500px;
	left:50%;
	margin-left:-250px;
	border:thin cadetblue solid; 
	border-radius:5px; 
}

*{
	text-align:center;
}
#updatetable{
	display:none;
}
.tdr{
	cursor:pointer;
	text-align:center;
	font-size:15px;
	font-weight:bold;
	border-bottom:1px black solid;
	border-top:1px black solid;
	border-right:1px black solid;
	border-left:1px black solid;
	border-radius:4px;
	}
.tdr:hover{
	background-color:#00FF99;
}

.tdm{
	cursor:pointer;
	text-align:center;
	font-size:15px;
	font-weight:bold;
	}
.tdm:hover{
	background-color:#66FF66;
}

.tdm1{
	cursor:pointer;
	text-align:center;
	font-size:15px;
	font-weight:bold;
	background-color:darkgray;
	}
.tdm1:hover{
	background-color:#66FF66;
}




.tdMenu{
	cursor:pointer;
	text-align:center;
	font-size:20px;
	font-weight:bold;
	border:1px black solid;
	border-bottom:1px black solid;
	border-left:1px black solid;
	border-right:1px black solid;
	border-top:1px black solid;
	border-radius:3px;

}
.tdMenu:hover{
	background-color:#66FF66;
}
.upanddown{
	font-size:48px;
	color:#FFF;
	background-color:#33EEC9;
	text-align:center;border-radius:10px;
}

</style>

<script>
//convert one digit into 2 digit(for hour and minute)
function to2digits(ds)
{
	if (ds < 10) 
	return '0' + ds;
	else return ds;
}


function callajax(url,divid,callbackfun)
{
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById(divid).innerHTML = this.responseText;
     callbackfun();			// my call back function
    }
  };
  xhttp.open("GET", url, true);
  xhttp.send();
}

function loadinfo(element,url) 
{
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		document.getElementById(element).innerHTML = this.responseText;
		}
	};	
	xhttp.open("GET", url, true);
	xhttp.send();
}

function showUpdateTable()//show update menu only if the user is owner (type=0)
{
	var type="<?php echo $_SESSION['type'];?>";
	if ( type == 0)
	document.getElementById("updatetable").style.display="block";
}

//add the event to log
function setDone(eid)
{
	if(document.getElementById("e"+eid).style.backgroundColor == "green"){//check if the activity was already done
		alert("This activity was already done!");
		exit;
	}
	desc=prompt("any special notes?");
	var today = new Date();
	var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate()+" "+ to2digits(today.getHours())+":"+to2digits(today.getMinutes())+":"+to2digits(today.getSeconds());//get the time that the activity was done	
	callajax("setActivityDone.php?desc="+desc+"&date="+date+"&eid="+eid,"showResults",getDone);	// show again the updated info

}
//get a list from log with the activities that was already done
function getDone()
{
	callajax("getDoneActivities.php","showResults",activityLate);
}

//get a list of events that are late and not done yet
function activityLate()
{
	var today = new Date();
	var date = to2digits(today.getHours())+":"+to2digits(today.getMinutes())+":00";//get the time of now	
	callajax("getLateActivities.php?date="+date,"showLate",showDone);
}
//show in color the done events and the late events
function showDone()
{
	doneActivies = document.getElementById("showResults").innerHTML;//get the list of the activities that was done (from showResults)
	doneActivies = doneActivies.substring(0, doneActivies.length-1);	// remove last ; from the string
	donelist = doneActivies .split(";");	
	
	late=document.getElementById("showLate").innerHTML; // get the list of the activities that was done (from showlate)
	lateActivies = late.substring(0, late.length-1);	// remove last ; from the string
	latelist = lateActivies.split(";");	
	if(doneActivies!=""){
		for (i=0 ; i < donelist.length ; i++ ) { //color every event that was done in green
				document.getElementById(donelist[i]).style.backgroundColor = "green";
				document.getElementById(donelist[i]).style.cursor = "not-allowed";
			}
			}
	
	if(latelist!=""){
		for(i=0;i<latelist.length-1;i++) //color every event that is late in red
		{
				document.getElementById(latelist[i]).style.backgroundColor = "red";

		}
	}	
}

	
//get all special events that wasn't done yet
function setDoneS(sid)
{
	callajax("setDoneSpecial.php?sid="+sid,"specialdone",hideSpecial);
}

//show only special events that are not done yet
function hideSpecial()
{
	special=document.getElementById("specialdone").innerHTML; // get the list of the activities that was done (from showlate)
	special= special.substring(0, special.length-1);	// remove last ; from the string
	speciallist= special.split(";");	
	if(speciallist!=""){
		for (i=0 ; i < speciallist.length ; i++ ) { //color every event that was done in green
				document.getElementById(speciallist[i]).style.display="none";
			}
	}

}

//4 function to update,save and delete a special event. use is file "update_special_event"
function updateSpecial(sid,date,time,desc)
{
	document.getElementById("updateButton_s").value = "Update";
	document.getElementById("deleteButton_s").style.display="block";
	document.getElementById("getupdateSpecial").style.display = "block"; //open new window
	new_time=time.substring(0, time.length-3);//take only hour and minute
	//alert(date);
	document.getElementById("date_update").value=date;
	document.getElementById("time_update_s").value=new_time;
	document.getElementById("desc_update_s").value=desc;
	document.getElementById("sid").value=sid;

}

function cancel_s()
{
		document.getElementById("getupdateSpecial").style.display = "none";
		document.getElementById("time_update_s").value='';
		document.getElementById("desc_update_s").value='';
		document.getElementById("date_update").value='';
}

//update event or save new event according to "updateButton_s" value
function update_s(){

		var new_time=document.getElementById("time_update_s").value;	
		new_desc=document.getElementById("desc_update_s").value;
		new_date=document.getElementById("date_update").value+" "+new_time+":00";
		//alert(new_date);
		var sid=document.getElementById("sid").value;
		//alert(eid);
		//clean all id's values:
		document.getElementById("time_update_s").value='';
		document.getElementById("desc_update_s").value='';
		document.getElementById("date_update").value="";
		
		document.getElementById("getupdateSpecial").style.display = "none";//close window
		if(document.getElementById("updateButton_s").value=="Update")
		{//if the button value is update, so do update
			loadinfo("showdata","setSpecialUpdate.php?new_date="+new_date+"&new_desc="+new_desc+"&sid="+sid);
		}
		else//the value is save so enter new event to table e_event
		{
			loadinfo("showdata","add_special_event.php?new_desc="+new_desc+"&new_date="+new_date);
		}
}
//delete chosen event
function delete_event_s(){
	var desc=document.getElementById("desc_update_s").value;
	if(confirm("Are you sure you want to delete '"+desc+"'?"))
	{
	var sid=document.getElementById("sid").value;
	loadinfo("showdata","delete_special_event.php?sid="+sid);
	document.getElementById("getupdateSpecial").style.display="none";

	}
}

//change the button so it will fit to add event
function AddNewEvent_s()
{
	document.getElementById("updateButton_s").value="Save";
	document.getElementById("deleteButton_s").style.display="none";
	document.getElementById("getupdateSpecial").style.display="block";
}


//5 function to update,save and delete a dailey event. use is file "update_daily_event"
function updateEvent(e_id,etime,e_desc){
	document.getElementById("updateButton").value = "Update";
	document.getElementById("deleteButton").style.display="block";

	document.getElementById("getupdateDaily").style.display = "block"; //open new window
	var new_time=to2digits(etime)+":00";
	document.getElementById("time_update").value=new_time;
	document.getElementById("desc_update").value=e_desc;
	document.getElementById("eid").value=e_id;

}
//close the input window when press on cancel
function cancel()
{
		document.getElementById("getupdateDaily").style.display = "none";
		document.getElementById("time_update").value='';
		document.getElementById("desc_update").value='';
}

//update event or save new event according to "updateButton" value
function update(){

		var new_time=document.getElementById("time_update").value;
		new_time=new_time.substring(0, new_time.length-3);//sace only hour
	//	alert(new_time);
		new_desc=document.getElementById("desc_update").value;
		var eid=document.getElementById("eid").value;
		//alert(eid);
		//clean all id's values:
		document.getElementById("time_update").value='';
		document.getElementById("desc_update").value='';

		document.getElementById("getupdateDaily").style.display = "none";//close window
		if(document.getElementById("updateButton").value=="Update")
		{//if the button value is update, so do update
			loadinfo("showdata","setEventUpdate.php?new_time="+new_time+"&new_desc="+new_desc+"&eid="+eid);
		}
		else//the value is save so enter new event to table e_event
		{
			loadinfo("showdata","add_daily_event.php?new_time="+new_time+"&new_desc="+new_desc);
		}
}
//delete chosen event
function delete_event(){
	var desc=document.getElementById("desc_update").value;
	if(confirm("Are you sure you want to delete '"+desc+"'?")){
	var eid=document.getElementById("eid").value;
	loadinfo("showdata","delete_daily_event.php?eid="+eid);
	document.getElementById("getupdateDaily").style.display="none";

	}
}
//change the button so it will fit to add event
function AddNewEvent()
{
	document.getElementById("updateButton").value="Save";
	document.getElementById("deleteButton").style.display="none";
	document.getElementById("getupdateDaily").style.display="block";
}

//show the tabels(spaciel+daily)
function show()
{
callajax('user_admin_view.php','showdata',getDone);
}

function showDaily()
{
callajax('ShowDalyEvent','showdata',getDone);
}

function showSPEDaily()
{
callajax('ShowSPEDalyEvent','showdata',getDone);
}


</script>
</head>

<body>
<h1 class="upanddown">תעודת זהות 123456</h1>

<table style="width: 80%; height:60vh;" cellpadding="5" cellspacing="5" align="center" >
	<tr style="width:60vh">
		<td id="table" style="margin-top:0px; width: 170px" valign="top" align="center" style="width: 247px">
		
		<table id="updatetable" style="background-color:#7AEFF5" align="center" >
			<tr>
			<td class="tdMenu" onclick=loadinfo("showdata","eupdate.php")>
				Update daily activities</td>
			</tr>
			<tr>
				<td class="dontShow" style="height: 24px"></td>
			</tr>
			<tr>
				<td class="tdMenu" onclick=loadinfo("showdata","update_special_event.php")>
				Update special activities</td>
			</tr>
			<tr>
				<td class="dontShow" style="height: 24px"></td>
			</tr>
			<tr>
				<td class="tdMenu" onclick=loadinfo("showdata","addUpdateUser.php")> 
				Add/Update family member</td>
			</tr>
			<tr>
				<td class="dontShow" style="height: 24px"></td>
			</tr>
			<tr>
				<td class="tdMenu" onclick=loadinfo("showdata","reports.php")> 
				Reports</td>
			</tr>
			<tr>
				<td class="dontShow" style="height: 24px"></td>
			</tr>

			<tr>
			<td class="tdMenu"onclick="location.href = 'main.php'"> 
				Back to main page </td>
			</tr>
			
			<tr>
			<td class="tdMenu" onclick=showDaily()> 
				Show only Events </td>
			</tr>
			
			<tr>
			<td class="tdMenu" onclick=showSPEDaily()> 
				Show only SPE Events </td>
			</tr>
			
		</table>
		</td>
		<td id="showdata" name="showdata" valign="top" align="center" style="border-style: solid; border-width: 1px; width: 833px;">
</td>
</tr>
</table>

<div id="showResults" hidden="hidden">dont show this</div>
<div id="showLate" hidden="hidden" >dont show this</div>
<div id="specialdone" hidden="hidden">dont show this</div>
<!--table for updating and saving daily events-->
<div id="getupdateDaily">
	<table style="width:100%;" align="center" cellpadding="5" cellspacing="5">
		<tr>
			<td style="border:none">Time:</td>
			<td style="border:none"><input name="Text1" id="time_update" type="time"></td>
		</tr>
		<tr>
			<td style="border:none">Description:</td>
			<td style="border:none"><input name="Text1" id="desc_update" type="text" placeholder="Description"></td>
		</tr>
		<tr style="text-align:center">
			<td style="border:none" colspan="2"><input name="btc" type="button" value="Cancel" onclick="cancel()">
			&nbsp;&nbsp; <input name="btu" id="updateButton" type="button" value="Update" onclick="update()">
			<input name="btd" type="button" id="deleteButton" value="Delete" onclick="delete_event()">
			</td>
		</tr>
	</table>
	<input id="eid" type="hidden">
</div>

<!--table for updating and saving special events-->
<div id="getupdateSpecial">
	<table style="width:100%;" align="center" cellpadding="5" cellspacing="5">
		<tr>
			<td style="border:none">Date:</td>
			<td style="border:none"><input name="Text1" id="date_update" type="date"></td>
		</tr>
				<tr>
			<td style="border:none">Time:</td>
			<td style="border:none"><input name="Text1" id="time_update_s" type="time"></td>
		</tr>

		<tr>
			<td style="border:none">Description:</td>
			<td style="border:none"><input name="Text1" id="desc_update_s" type="text" placeholder="Description"></td>
		</tr>
		<tr style="text-align:center">
			<td style="border:none" colspan="2"><input name="btc" type="button" value="Cancel" onclick="cancel_s()">
			&nbsp;&nbsp; <input name="btu" id="updateButton_s" type="button" value="Update" onclick="update_s()"><input name="btd" type="button" id="deleteButton_s" value="Delete" onclick="delete_event_s()">
			</td>
		</tr>
	</table>
	<input id="sid" type="hidden">
</div>


<script>
//showUpdateTable();
showUpdateTable();
show();
//getDone();
</script>
<h1 class="upanddown"><?php echo $_SESSION['dname']; ?>'s day</h1>
</body>

</html>
