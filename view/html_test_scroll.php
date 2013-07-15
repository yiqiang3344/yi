<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style>
#demo ul {
	text-align: left;
	margin-left:2px;
	font-size:12px;
}
#demo li a {
	background: #F7F7F7;
	display: block;
}
#demo {
	overflow: hidden;
	width: 250px;
	height: 270px;
	background: #FFF;
	float: left;
	display: inline;
}
#demo1 li {
	list-style:inside;
}
</style>
</head>
<body>

<div id="demo">
  <div id="demo1">
    <ul>
      <li><a href="news.html">参加大冬会闭幕式观众需要注意安全事项的通告</a></li>
      <li><a href="news/news1.html">关于大冬会男女冰球三、四名和决赛入场公告</a></li>
      <li><a href="news.html">21日举行的高山滑雪滑降比赛日期有变</a></li>
      <li><a href="news/news1.html">跳台滑雪男子个人K125比赛时间有变更</a></li>
      <li><a href="news.html">参加大冬会开幕式活动观众需注意问题通告</a></li>
      <li><a href="news/news1.html">参加大冬会开幕式观众需要注意安全事项的通告</a></li>
      <li><a href="news.html">大冬会媒体记者报名 第二批审核通过名单</a></li>
      <li><a href="news.html">参加大冬会闭幕式观众需要注意安全事项的通告</a></li>
      <li><a href="news/news1.html">关于大冬会男女冰球三、四名和决赛入场公告</a></li>
      <li><a href="news.html">21日举行的高山滑雪滑降比赛日期有变</a></li>
      <li><a href="news/news1.html">跳台滑雪男子个人K125比赛时间有变更</a></li>
      <li><a href="news.html">参加大冬会开幕式活动观众需注意问题通告</a></li>
      <li><a href="news/news1.html">参加大冬会开幕式观众需要注意安全事项的通告</a></li>
      <li><a href="news.html">大冬会媒体记者报名 第二批审核通过名单</a></li>
      <li><a href="news.html">参加大冬会闭幕式观众需要注意安全事项的通告</a></li>
      <li><a href="news/news1.html">关于大冬会男女冰球三、四名和决赛入场公告</a></li>
      <li><a href="news.html">21日举行的高山滑雪滑降比赛日期有变</a></li>
      <li><a href="news/news1.html">跳台滑雪男子个人K125比赛时间有变更</a></li>
      <li><a href="news.html">参加大冬会开幕式活动观众需注意问题通告</a></li>
      <li><a href="news/news1.html">参加大冬会开幕式观众需要注意安全事项的通告</a></li>
      <li><a href="news.html">+++大冬会媒体记者报名 第二批审核通过名单</a></li>
    </ul>
  </div>
  <div id="demo2"></div>
  <script type="text/javascript">
      var speeds=30;
      var FGDemo=document.getElementById('demo');
      var FGDemo1=document.getElementById('demo1');
      function Marquee1(){
          if(FGDemo1.offsetHeight-FGDemo.offsetHeight-FGDemo.scrollTop<=0){
              FGDemo.scrollTop-=FGDemo1.offsetHeight;
          }else{
              FGDemo.scrollTop++;
          }
      }
      var MyMar1=setInterval(Marquee1,speeds);
      FGDemo.onmouseover=function() {
          clearInterval(MyMar1);
      }
      FGDemo.onmouseout=function() {
          MyMar1=setInterval(Marquee1,speeds)
      }
  </script>
</div>
</body>
</html>