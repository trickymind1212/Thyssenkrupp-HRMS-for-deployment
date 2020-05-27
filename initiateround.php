<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

</head>
<body>

<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="border: 5px solid white;z-index: 1000">

  <h3 class="w3-bar-item white"> <center><a href="/hrms/">Home</a>
  <i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
  </a></h3> <br><br>

  <a href="/hrms/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="/hrms/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="/hrms/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="/hrms/allocateround.php" class="w3-bar-item w3-button">On going rounds</a> <br>
  <a href="/hrms/history.php" class="w3-bar-item w3-button">See History  </a> <br>
  <a href="/hrms/allocateround2.php" class="w3-bar-item w3-button">Rescheduling</a> <br>
  <a href="/hrms/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="/hrms/offerletter.php" class="w3-bar-item w3-button">Offer Letter</a> <br>
  <a href="#" id="logoutuser" class="w3-bar-item w3-button">Logout</a> <br>

</div>

<div id="remin">
<nav> 
    <div class="nav-wrapper blue darken-1">
      <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i>
    </a>
    <a href="/hrms/" class="brand-logo center">thyssenkrupp</a>
    </div>
</nav>
<br><br>
<!-- nav and side menu ended -->
                  <button class="btn waves-effect green" style="float:right;margin-top: 18px;margin-right: 18px " id="rfresh">Refresh</button>

                  <br><br>

                  <div class="row">
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                            <table class="striped">
                                <thead>
                                  <tr>
                                      <th>PRF-POSITION-INSTANCE-ROUND</th>
                                      <th>Initiate Round</th>
                                  </tr>
                                </thead>
                                <tbody id="addtr">
                                  
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <center id="nodata">
                  <b style="color:red">No Data Available..!!</b>
                  </center>
                  <center>
                  <b><p id="pleasewait" style="color:red">Updating Information Please Wait...</p></b>

                  </center>
                  <u><b id="nomems"  style="color:red;margin-left:25%;font-size:20px;cursor:pointer;"> Application Blank Not Submitted By The Members </b></u>

                  <div class="row">
                    <div class="col s5 offset-m3" id=showmembersdiv>
                      <table class="stripped">
                      <thead>
                        <tr class="blue darken-1 white-text">
                          <br>
                          <th>Sr No.</th>
                          <th>Email ID</th>
                        </tr>
                      </thead>
                      
                      <tbody id="memberstable">
                      </tbody>
                      </table>
                    </div>
                  </div>


                  <div class="row" id="allocatingcandidate" >
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                          <p id='rid'><b></b></p>
                          <div class="row" id="allocation" >
                            <div class="col s12 m12" style="border: solid 5p">
                              <div class="card white">
                                <div class="card-content blue-text">
                                  <div class="row">
                                    <div class="input-field col s3 m3 " >
                                      <input id="iname" type="text" class="text">
                                      <label class="active" for="iname" id="iname" required>Interviewer Name</label>
                                    </div>           
                                    <div class="input-field col s3 m3 white-text" >
                                      <input id="imail" type="text" required>
                                      <label class="active" for="imail">Interviewer Mail ID</label>
                                    </div> 
                                    <div class="input-field col s3 m3 " >
                                          <input id="location" type="text" class="text" required>
                                          <label class="active" for="location" id="location">Interview Location</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="contactperson" type="text" class="text" required>
                                          <label class="active" for="contactperson" id="contactperson">Contact Person Name</label>
                                        </div>
                                  </div>       
                                    <div class="row">
                                        <div class="input-field col s3 m3 " >
                                          <input id="idate" type="text" required class="datepicker">
                                          <label  for="idate">Date</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="itime" type="text" class="timepicker" required>
                                          <label class="active" for="itime">Time</label>
                                        </div>
                                        <div class="input-field col s3 m3 " >
                                          <input id="idept" type="text" class="text" required>
                                          <label class="active" for="idept" id="idept">Interviewer Department</label>
                                        </div>                                    
                                        <div class="input-field col s3 m3 " >
                                          <input id="idesg" type="text" class="text" required>
                                          <label class="active" for="idesg" id="idesg">Interviewer Designation</label>
                                        </div>
                                       
                                        
                                    </div>          

                                
                                  <div class="row">
                                    <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" id='allocatesubmit'>Submit
                                    <i class="material-icons right">send</i>
                                    </button>
                                      
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <table class="striped">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Mail ID</th>
                                <th>Select</th>
                                <th>Time</th>
                                <th class="btn blue darken-1" name="submit" id="submit" disabled>Assign Interviewer</th>
                                <th class="btn red" style="margin-left: 25px;" id="abort" onclick="abort_round()"> Abort</th>
                                
                              </tr>
                            </thead>
                            <tbody id="adddetail">
                              
                                  <div id="temp">

                                  </div>
                              
                            </tbody>
                          </table>

                        </div>          
                      </div>
                    </div>
                  </div>
                  </div>         
                          
    <style>
    html{
    scroll-behaviour:smooth;

  }
    </style>
    <script src="public/js/common.js"></script>

<script>
$("#nomems").hide()
var id_round = "0";
var selectedmail = []
var selectedmailID = []
var selecteddate = []
var timearray=[]
var allmail = []
$(document).ready(function(){

  $("#nomems").hide()
  $("#showmembersdiv").hide()

  
  $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();
  $("#rfresh").click(function(){
    window.setTimeout(function(){location.reload()},1000)
  })
  $("#nodata").hide()
  $("#pleasewait").hide();
  $.ajax(
    {
      url:'http://localhost/hrms/api/baserounds.php',
      type:'POST',
      success:function(para){
      if(para != "no data")
      {
       $("#nodata").hide()
       var arr =  JSON.parse(para)
       console.log(arr)
       
        for(let i =0;i<arr.length;i++)
        {
          var appended=arr[i].prf+"-"+arr[i].pos+"-"+arr[i].iid+"-"+arr[i].rid
          var appended2=arr[i].prf+"/"+arr[i].pos+"/"+arr[i].iid+"/"+arr[i].rid+"/"+arr[i].dept+"/"+arr[i].poszone;
          console.log(appended2)
          var s1='<tr id="'+appended+'row">'
          var s2='<td>'
          var s3='<p class="btn waves-effect blue darken-1" >'+appended+'</p></td><td>'
          var s4='<button class="waves-effect green  btn"  id="'+appended2+'" onclick="createnextround(this.id)">Initiate Round</button></td></tr>'
          var str=s1+s2+s3+s4
           $('#addtr').append(str)
        }
      }
      
      else
      {
        console.log("No Data Found")
        $("#nodata").fadeIn(400)
      }
      }
    });



  
  
  $('#allocation').hide();
  $('#allocatingcandidate').hide();

  //final assignment for interviwer,date and time  
  $('#submit').click(function(){
    
    var iid=window.iid;
    if(selectedmail.length <= 0)
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
      for(let i=0;i<selectedmail.length;i++)
    {
     console.log(window.iid)
     
    }

    $('#allocation').show(600);
    }
    

  })

  $('#allocatesubmit').click(function(){

      

      var imail = $('#imail').val();
      var iname = $('#iname').val();
      var idate = $('#idate').val();
      var itime = $('#itime').val();
      var idept = $('#idept').val();
      var idesg = $('#idesg').val();
      var iloc = $('#location').val();
      var iperson = $('#contactperson').val();
      var posdept = window.dept
      var poszone = window.zone
      var candidatetime
    
      if(imail != "" && iname != "" && idate != "" && itime != "" && idept != "" && idesg != "" && iperson != "" && iloc != "")
      {
        $('#allocation').hide(600);
        $("#pleasewait").fadeIn(600);
        for(let i=0;i<selectedmailID.length;i++)
        {
          var b = selectedmailID[i]
          b = b+'date'
          console.log(b)
          selecteddate.push($(b).val()) 
          console.log("Email:",selectedmail[i]) 
          console.log("Time:",selecteddate[i])
        }
      $.ajax({
        url:'http://localhost/hrms/api/interviewer.php',
        type:'POST',
        data:{
          //dept needed to be submitted
          'emails':selectedmail,
          'dates':selecteddate,
          'intv':imail,
          'date':idate,
          'time':itime,
          'prf':iid,
          'iname':iname,
          "idesg":idesg,
          "idept":idept,
          "iloc":iloc,
          "iperson":iperson,
          "dept":posdept,
          "poszone":poszone
          //"dept":"sales"

        },
        success:function(para){
          
          console.log("This is the para after interbiew = ",para)
          for(let i=0;i<selectedmail.length;i++)
            {
             var ml = selectedmail[i];
             var id = allmail.indexOf(ml) 
             var str='#check'+id+'row';
             
              $(str).remove();
              //document.location.reload();
              $("#pleasewait").hide();
              // window.setTimeout(function(){location.reload()},1000)

            }
            selectedmail = []
            selecteddate = []
            selectedmailID=[]
        }
      })
      }
      else
      {
        alert("Please Fill All Data")
      }
      
      
      
    })


})
//end of document.ready(function)   

var ctr=0
function selection(x)
{
  $('#submit').attr('disabled',false)
 
  var b = '#'+x
  var y ='#'+x+'mail'  
 
  if($(b).prop("checked") == true)
  {
    selectedmail.push($(y).text())
    selectedmailID.push(b)
    console.log('mail:'+selectedmail)
    console.log('ID:'+selectedmailID)
  }
  else
  {                                               
    for( var i = 0; i < selectedmail.length; i++)
    { 
      if ( selectedmail[i] === $(y).text()) 
      {
        selectedmail.splice(i, 1); 
        selectedmailID.splice(i, 1)
        i--;
      }
    }
    console.log(selectedmail)
    console.log(selectedmailID)
  }
}




var id_round

function createnextround(id)
{
  // $('.timepicker').timepicker();
  window.iid=id;
  console.log(iid)
  id = id.split("/")
  id_round = id[0]+"-"+id[1]+"-"+id[2]

  //dept zone added to database
  window.dept = id[4]
  window.zone = id[5]
  // console.log(zone)
  console.log(id_round)
  $('#allocatingcandidate').fadeIn(600);

  var p1='<b>ID:'+id_round+'<b>'
  $('#rid').replaceWith(p1);
  $.ajax({
    url:'http://localhost/hrms/api/baseroundmembers.php',
    type:'POST',
    data:{
          "id":id_round
         },
    success:function(para)
    {
      para = JSON.parse(para)
      var arr1=[]
      var toggle = 0      
      $("#nomems").click(function()
      {
        $("#memberstable").empty()
        if(toggle == 0)
        {
          toggle = 1
          $("#showmembersdiv").fadeIn(1200);
            for(let i=0;i<para[1];i++)
            {
              j = parseInt(i)
              j += 1
              var membersdata='<tr><td>'+j+'</td><td>'+para[2][i]+'</td</tr>'
              $("#memberstable").append(membersdata)
            }
        }
        else
        {
          toggle = 0
          $("#showmembersdiv").fadeOut(100);

        }    
      })
       console.log("this are base round mems  = ",para[1])
       if(para[0] == null)
       {
         $("#submit").hide()
         $("#abort").hide()
         $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")

         $("#nomems").show()
       }
      else if(para[1] != 0)
      {
        $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
        $("#nomems").show()


      $('#adddetail').text("")
      var arr = para[0]
      // $('.timepicker').timepicker();
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row"><td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td><td><p id="check'+i+'mail">'+arr[i][1]+'</p></td><td><label>'
        var s2='<input type="checkbox" class="filled-in" id="check'+i+'"onclick="selection(this.id)"/>'
        var s3='<span class="blue-text darken-1" ></span></label></td>'
        var s4='<td><input type="text" id="check'+i+'date" class="timepicker"></td></tr>'
        var str=s1+s2+s3+s4
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
      }
      
    }
    else
    {
      $("#nomems").hide()
 
 
      $('#adddetail').text("")
      var arr = para[0]
  
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row"><td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td><td><p id="check'+i+'mail">'+arr[i][1]+'</p></td><td><label>'
        var s2='<input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)"/>'
        var s3='<span class="blue-text darken-1" ></span></label></td>'
        var s4='<td><input id="check'+i+'date" class="timepicker" ></td></tr>'
        var str=s1+s2+s3+s4
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
      }
    }
    }
  })
  $(document).scrollTop($(document).height())   ;

}

function terminateround(id)
{
  var confrm = confirm("Are You sure ? ");
  if(confrm)
  {
    id_round = id
    var str = "#"+id_round+"row";
    $.ajax({
    // url:'http://localhost/thyssenhrms/demo.txt',
    type:'POST',
    data:{'roundid':id_round},
    success:function(para)
    {
      $(str).remove();
    }
  })
}

}
$('#logoutuser').click(function(){

$.ajax({
url:"http://localhost/hrms/api/logout.php",
type:"POST",
success:function(para){

if(para=="success")
{
$("#row").hide()
$("#logout").show()
document.location.replace("http://localhost/hrms/index.php")
}
else
{
$("#notlogout").show()
document.location.replace("/hrms/")
}
} 

})

});




function abort_round()
{
  var confr = confirm("Are You Sure ?");
  if(confr)
  {
 
    $.ajax({
  url:"http://localhost/hrms/api/abortround.php",
type:"POST",
data: {
  "digit13" :  id_round

},
success:function(para){
console.log(para)
if(para=="success")
{
  document.location.reload();
  }
else
{
  console.log("something went wrong")
}
} 

})
 
  }
}

</script>
</body>

</html>

<?php
            }
            else
            {
                header("refresh:0;url=notfound.html");
            }
        }
        else
        {
            header("refresh:0;url=notfound.html");
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }  
?>
