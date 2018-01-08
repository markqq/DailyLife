<?php
include 'conn.php';
$numberEachTime = 10;
if(isset($_GET["page"])){
  $page = intval($_GET["page"]);
}else{
  $page = 1;
}
$sql = mysql_query("select * from dailylife");
$datarow = mysql_num_rows($sql);
$showed = ($page - 1) * $numberEachTime;
$data = array();
while($rows = mysql_fetch_array($sql)){
  $data[] = $rows;
  $data[$rows['id']] = $rows;
  $lastUpdate = $data[$rows['id']]["statusDate"];
}
$index = 0;
if($showed + $numberEachTime < $datarow){
  $outputNum = $numberEachTime;
}else{
  $outputNum = $datarow;
}
$outputHTML = "";
function monthTrans($month){
    switch($month){
        case '01':
          $re = "Jan.";
          break;
        case '02':
          $re = "Feb";
          break;
        case '03':
          $re = "Apr.";
          break;
        case '04':
          $re = "Mar.";
          break;
        case '05':
          $re = "May";
          break;
        case '06':
          $re = "Jun.";
          break;
        case '07':
          $re = "Jul.";
          break;
        case '08':
          $re = "Agu.";
          break;
        case '09':
          $re = "Spe.";
          break;
        case '10':
          $re = "Agu";
          break;
        case '11':
          $re = "Nov.";
          break;
        case '12':
          $re = "Dec.";
          break;
    }
    return $re;
}
$temp = 0;
for($i=$showed;$i<$showed+$outputNum;$i++){
  if(!isset($data[$i])){
    continue;
  }
  $timeStr = $data[$i]["statusDate"];
  $timeStr = explode(" ", $timeStr);
  $timeStr = $timeStr[0];
  $timeStr = explode("-", $timeStr);
  $timeYear = $timeStr[0];
  $timeMonth = monthTrans($timeStr[1]);
  $timeDay = $timeStr[2];
  
  $outputHTML = $outputHTML . '<div class="statusItem" data-id="'.$data[$i]["id"].'"><div class="statusItemTitle"><span class="big">'.$timeMonth.' '.$timeDay.'</span><span class="small">'.$timeYear.'</span></div><div class="statusItemContent">'.$data[$i]["statusContent"].'</div></div>';
  $temp=1;
}
if($temp==0){
  $outputHTML = '<a style="padding:15px 0;">Sorry, this page does not exist.</a><script>$(document).ready(function(){$("#nextPageBtn").hide();});</script>';
}
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Daily Life</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
    <link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="//apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>
    body,html{
    	padding:0;
    	margin:0;
    	font-family: 'Raleway', Arial, sans-serif;
      font-weight:200;
    }
    .wrapBox{
    	max-width: 768px;
    	margin:0 auto;
    }
    #header{
    	padding:50px 0 20px 0;
    	box-shadow: 0 0 1px rgba(0,0,0,0.15);
    }
    .logo{
    	font-size:24px;
    	font-weight:300;
    	color: #5f5e5e;
    }
    .sectionItem{
      padding:10px 0;
    }
    .guider{
      padding:30px 0;
      color: #b3b3b1;
    }
    .guider i{
      margin-right: 10px;
    }
    .statusItemTitle{
      border-left: 7px solid #fbad18;
      padding-left: 40px;
      font-weight:200;
      color: #666;
    }
    .statusItemTitle .big{
      font-size: 30px;
    }
    .statusItemTitle .small{
      font-size: 15px;
      padding-left:15px;
      color:#8e8e8e;
    }
    .statusItem{
      margin:20px 0;
      -webkit-filter: grayscale(100%);
      -moz-filter: grayscale(100%);
      -ms-filter: grayscale(100%);
      -o-filter: grayscale(100%);
      filter: grayscale(100%);
      filter: gray;
      -webkit-transition: opacity 0.15s ease-out;
      -moz-transition: opacity 0.15s ease-out;
      transition: opacity 0.15s ease-out;
    }
    .statusItem:hover{
      -webkit-filter: grayscale(0);
      -moz-filter: grayscale(0);
      -ms-filter: grayscale(0);
      -o-filter: grayscale(0);
      filter: grayscale(0);
      filter: initial;
    }
    .statusItemContent{
      color: #666;
      font-weight:200;
      padding:20px 47px;
      font-size: 15px;
      line-height: 30px;
    }
    .statusItemContent img{
      max-width: 100%;
      margin:10px 0;
    }
    .statusItemContent p{
      margin:0;
    }
    .defaultButton{
      padding:10px 13px;
      background-color: #dcdcdc;
      border:solid 0px #dcdcdc;
      font-family: 'Raleway', Arial, sans-serif;
      font-size: 15px;
      font-weight: 200;
      text-align: center;
      cursor: pointer;
    }
    .defaultButton:hover{
      background-color: #cecece;
    }
    .defaultButton:active{
      background-color: #a5a5a5;
    }
    #nextPageBtn,#prevPageBtn{margin:20px 0;}
	</style>
  <script>
    var nowPage = <?php echo $page;?>;
    $(document).ready(function(){
      if(nowPage==1){
        $("#prevPageBtn").hide();
      }
      $("#nextPageBtn").click(function(){
        var nextPage = nowPage+1;
        window.location.href = "?page="+nextPage;
      });
      $("#prevPageBtn").click(function(){
        var prevPage = nowPage-1;
        window.location.href = "?page="+prevPage;
      });
    });
  </script>
  </head>
  <body>
  	<header id="header">
      <div class="wrapBox">
  		  <a class="logo">Daily Life</a>
      </div>
  	</header>
  	<section id="mainDisplay" class="wrapBox">
      <div class="guider">
        <div class="sectionItem" id="nowTime"><i class="fa fa-clock-o"></i> Today is <?php echo date('y-m-d',time());?></div>
  		  <div class="sectionItem" id="nowTime"><i class="fa fa-bullhorn"></i> Last Update: <?php echo $lastUpdate;?></div>
  		  <div class="sectionItem" id="nowTime"><i class="fa fa-calendar"></i> Show Calendar</div>
      </div>
      <div class="statusTimeline" id="statusTimeline"><?php echo $outputHTML;?></div>
      <div class="defaultButton" id="prevPageBtn">Prev Page</div>
      <div class="defaultButton" id="nextPageBtn">Next Page</div>
  	</section>
  </body>
</html>