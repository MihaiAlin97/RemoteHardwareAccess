
<?php


$conn=new mysqli("localhost","root","","Remotedebugging");



if(!$conn){

	die("Connection failed: ".mysqli_connect_error());

}


$sql1 = "SELECT hardware_id,hardware_name,used,port from hardwaresets;";
$result=mysqli_query($conn, $sql1);

$hardware_names=array();
$hwids=array();
$usage=array();
$ports=array();
   while($row= mysqli_fetch_assoc($result)){
    array_push($hwids,$row['hardware_id']);
    array_push($hardware_names,$row['hardware_name']);
    array_push($usage,$row['used']);
	array_push($ports, $row['port']);
   }


//get hwset names from db

$sql2 = "SELECT device_id,device_name,usb_port,hardware_id,device_type from devices;";
$result=mysqli_query($conn, $sql2);
$devices=array();

   while($row=mysqli_fetch_assoc($result)){
$devices[]=$row;
   }

//extract devices for the set


$currentset=explode('|',$_SERVER['QUERY_STRING']);

$sql = "SELECT device_name,device_type,usb_port,hardware_id
FROM devices where  hardware_id IN (SELECT hardware_id
FROM hardwaresets
where hardware_id='".$currentset[0]."')
";
$result=mysqli_query($conn,$sql);

$dev_names=array();
$dev_types=array();
$usb_ports=array();
$hardware_ids=array();
   while($row= mysqli_fetch_assoc($result)){
   array_push($dev_names,$row['device_name']);
   array_push($dev_types,$row['device_type']);
   array_push($usb_ports,$row['usb_port']);
   array_push($hardware_ids,$row['hardware_id']);

}


//'UsbService64.exe share-usb-port id:id:id:id --tcp=IPclient:PortHardcoded



mysqli_close($conn);
//part above is used for main.php





//JavaScript functions for all pages
$functions="<script>
function CreateHWSETS(x){//creates required number of sets
var i=0;
while(i<x){
var elmnt = document.getElementsByClassName('col-lg-4')[0];
var cln = elmnt.cloneNode(true);
document.getElementsByClassName('row')[1].appendChild(cln);

i=i+1;}
}



function DisplayHWSETS(setnumber,setname){//add name to each set

document.getElementsByClassName('card-title')[setnumber].innerHTML=setname;


}


function AppendDevices(setnumber,name)//add devices to corresponding sets in main.php
{
	var device = document.createElement('DIV');  
	   device.innerHTML=name;
       device.className='card-footer';
document.getElementsByClassName('card mb-4 product-card overlay-hover')[setnumber].appendChild(device);


}



  function ShowHSNAME(i,hardid,used,port){//pass the name of the clicked set on main.php to url of HardwareSet.php
  

    document.getElementsByClassName('btn btn-primary btn-block text-uppercase font-weight-bold mb-3 btn-lg')[i].addEventListener('click',function(){//when clicking on a set,go to set page



            if(document.getElementsByTagName('p')[i].className=='greenled'){
          window.location.href = 'HardwareSet.php?'+hardid+'&'+document.getElementsByClassName('header-slogan d-none d-lg-block')[0].innerHTML+'&port='+port;}
            else{
              
              x=(document.getElementsByClassName('header-slogan d-none d-lg-block')[0].innerHTML).split('u');
              y=(document.getElementsByClassName('usr')[i].innerHTML).split('u');
            
                  if(x[1]==y[1]){window.location.href ='HardwareSet.php?'+hardid+'&'+document.getElementsByClassName('header-slogan d-none d-lg-block')[0].innerHTML+'&port='+port;}
               else {alert('Device is already used');window.location.href = 'main.php';}

            }
            });
 

}


function Admin(){


document.getElementById('admin').addEventListener('click',function(){//when clicking on a set,go to set page

window.location.href = 'admin.php';

   });

document.getElementById('calendar').addEventListener('click',function(){//when clicking on a set,go to set page

var pass=(document.getElementsByClassName('header-slogan d-none d-lg-block')[0].innerHTML).split('u');
window.location.href = 'FullCalendar/index.php?q='+'u'+pass[1];

   });

}








  function GoToDownloadPage(setname){//from HardwareSet
 
    window.addEventListener('load',function(){
       
      
       window.location.href = 'ShareDevices.php?'+setname;
      

      });
  
}
function ShowSetPage(setposition,setname,settype,setport){//for displaying info about the devices in HardwareSet page
 
    var position = document.createElement('th');  
    position.innerHTML=setposition;
    var devicename = document.createElement('td');  
    devicename.innerHTML=setname;
    var type = document.createElement('td');  
    type.innerHTML=settype;
    var port = document.createElement('td');  
    port.innerHTML=setport;
     
    var row = document.createElement('tr');

    row.appendChild(position);
    row.appendChild(devicename);
    row.appendChild(type);
    row.appendChild(port);


    document.body.getElementsByTagName('tbody')[0].appendChild(row);

    

  
}




function RedirectToEND_SESSIONfromHWSET(hardid){//function for when the 'end session' button is clicked
document.getElementsByClassName('btn btn-primary float-md-right')[0].addEventListener('click',function(){//when clicking on a set,go to set page

          
          window.location.href = 'END_SESSION.php?'+hardid;});


}


function ShowUsage(position){//for set leds and used by paragraphs
var i=0;

xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {


              var resp=this.responseText.split('|');
                document.getElementsByTagName('p')[position].className=resp[0];

                 
                if(resp[0]=='redled'){

                  document.getElementsByClassName('usr')[position].innerHTML=resp[1];
                document.getElementsByClassName('tst')[position].innerHTML='In Use / ';
                document.getElementsByClassName('tst')[position].className='tst text-danger';

              }


                if(resp[0]=='greenled'){
                  document.getElementsByClassName('usr')[position].innerHTML=resp[1];
                document.getElementsByClassName('tst')[position].innerHTML='Available';
                document.getElementsByClassName('tst ')[position].className='tst text-success';
              }

            }
};



        xmlhttp.open('GET','getusage.php?q='+position,true);
        xmlhttp.send();



}


function Source(position,com){//for set leds and used by paragraphs


xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            
            if(this.responseText=='Upper limit')alert('maximum 14 V are allowed');
            else if(this.responseText=='Lower limit')alert('minimum 7V are allowed');
            else document.getElementsByClassName('header-slogan d-none d-lg-block')[0].innerHTML=this.responseText;

            }
};



        xmlhttp.open('GET','Source.php?q='+position+'&p='+com,true);
        xmlhttp.send();



}




function SourceButtonListener(position,com){

 document.getElementsByClassName('btn btn-lg btn-primary')[position].addEventListener('click',function(){
                  Source(position,com);


            });


}

function SourceButtons(com){
var i=0;

while(i<4){
SourceButtonListener(i,com);
i=i+1;

}
}




</script>";




?>