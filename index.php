<?php
include 'conn.php';
$numberEachTime = 10;
if(isset($_GET["page"])){
  $page = intval($_GET["page"]);
}else{
  $page = 1;
}
if(isset($_GET["id"])){
  $statusID = intval($_GET["id"]);
  $sql = mysql_query("select * from dailylife where id=".$statusID);
}else{
  $sql = mysql_query("select * from dailylife order by id desc");
}
$pageURL = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
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
$count = 0;
while($rows = mysql_fetch_array($sql)){
  $count++;
  if($count>($page-1)*$numberEachTime && $count<$numberEachTime*$page+1){
    $timeStr = $rows[0];
    $timeStr = explode(" ", $timeStr);
    $timeStr = $timeStr[0];
    $timeStr = explode("-", $timeStr);
    $timeYear = $timeStr[0];
    $timeMonth = monthTrans($timeStr[1]);
    $timeDay = $timeStr[2];
    $likeNum = $rows[4];
    if($likeNum==""){
      $likeNum = "0";
    }
    $outputHTML = $outputHTML.'<div class="statusItem" data-id="'.$rows[3].'"><div class="statusItemTitle"><span class="big">'.$timeMonth.' '.$timeDay.'</span><span class="small">'.$timeYear.'</span></div><div class="statusItemContent">'.$rows[1].'</div><div class="statusToolBar"><input type="url" value="'.$pageURL.'?id='.$rows[3].'" class="statusURL" id="statusLink-'.$rows[3].'"> <i class="fa fa-link getStatusLinkBtn" title="Status Link" data-status-id="'.$rows[3].'"></i> <a class="likeStatusNum" id="likeStatusNum_'.$rows[3].'">'.$likeNum.'</a> <i class="fa fa-thumbs-o-up likeStatusBtn" title="Like it" data-status-id="'.$rows[3].'"></i></div></div>';
  }
  $lastUpdate = $rows[0];
}
if($outputHTML==""){
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
      padding: 0 10px;
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
    .statusToolBar{
      padding:10px 0;
      text-align: right;
    }
    .statusToolBar i{
      opacity: .5;
      cursor: pointer;
    }
    .statusToolBar i:hover{
      opacity: .94;
    }
    .likeStatusNum{padding-left:15px;}
    .statusURL{margin-right:10px;display:none;}
    #nextPageBtn,#prevPageBtn{margin:20px 0;}
    #prevPageBtn{float: left;}
    #nextPageBtn{float: right;}
    footer{padding:15px 0;color:#8c8c8c;font-size:14px;font-weight:200;text-align: center;}
    a{text-decoration: none;color:initial;}
    @media only screen and (min-width:442px){
      .statusItem{
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
    }
	</style>
  <script>
    $(document).ready(function(){
      $("#nextPageBtn").click(function(){
        var nextPage = nowPage+1;
        window.location.href = "?page="+nextPage;
      });
      $("#prevPageBtn").click(function(){
        var prevPage = nowPage-1;
        window.location.href = "?page="+prevPage;
      });
      $(".getStatusLinkBtn").click(function(){
        var id = $(this).attr("data-status-id");
        $("#statusLink-"+id).show();
        $("#statusLink-"+id).select();
      });
      $(".likeStatusBtn").click(function(){
        var id = $(this).attr("data-status-id");
        likeStatus(id);
      });
    });
    function likeStatus(id){
      $.getJSON("likeStatus.php?id="+id,function(data){
        if(data.err==1){
          alert("You have already liked this status.");
        }else if(data.err==0){
          var likeNum = parseInt($("#likeStatusNum_"+id).html());
          likeNum++;
          $("#likeStatusNum_"+id).html(likeNum);
          alert("Thank you.")
        }
      });
    }
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
      <?php
      if($page>1){
        echo '<div class="defaultButton" id="prevPageBtn">Prev Page</div>';
      }
      $toatlPageNum = ceil($count/$numberEachTime);
      if($page+1<$toatlPageNum){
        echo '<div class="defaultButton" id="nextPageBtn">Next Page</div>';
      }
      ?>
      <div style="clear:both"></div>
  	</section>
    <footer>
      ©tan90° Powered by <a href="//blog.tan90.co/DailyLife">DailyLife</a>
    </footer>
  </body>
</html>