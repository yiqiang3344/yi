<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=GB18030">
        <title>Spiral</title>
        <script type="text/javascript" src="js/jquery-1.5.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            var Spiral;
            var yjq;
            (function(){
                yjq = function(name,turns,duration,frame,count,decrease_time){
                    $('style.enable_remove').remove();
                    $('[id^=test]').css({'position':'absolute','width':10,'height':10,'top':300,'left':300,'background':'black'});
                    Spiral(name+'1',600,300,300,300,turns,duration,frame);
                    Spiral(name+'2',300,0,300,300,turns,duration,frame);
                    Spiral(name+'3',0,300,300,300,turns,duration,frame);
                    Spiral(name+'4',300,600,300,300,turns,duration,frame);
                    $('#'+name+'1').css({"-webkit-animation":name+"1 "+duration+"ms linear "+count});
                    $('#'+name+'2').css({"-webkit-animation":name+"2 "+duration+"ms linear "+count});
                    $('#'+name+'3').css({"-webkit-animation":name+"3 "+duration+"ms linear "+count});
                    $('#'+name+'4').css({"-webkit-animation":name+"4 "+duration+"ms linear "+count});
                    var arg = arguments;
                    $("#"+name+"4").one('webkitAnimationEnd',function(){
                        if(duration<=0){
                            return;
                        }
                        arg.callee(name,turns,duration-=decrease_time,frame,count,decrease_time);
                    });
                }
                Spiral = function(name,w1,h1,w2,h2,N,T,frame){
                    var interval = T/frame;//每帧间隔
                    var n;//圈数
                    var i = 0;
                    var k;//初始象限
                    var R = Math.sqrt(Math.pow(w2-w1,2)+Math.pow(h2-h1,2),2);//半径
                    var style="@-webkit-keyframes "+name+"{";
                    var styleDom=$("<style class='enable_remove'></style>");
                    if(w1>w2 && h1<=h2){
                        k = 1;
                    }else if(w1<=w2 && h1<h2){
                        k = 2;
                    }else if(w1<w2 && h1>=h2){
                        k = 3;
                    }else {
                        k = 4;
                    }
                    for(var t=0;t<T;t+=interval){
                        var t1 = t%(T/N);
                        n = Math.floor(t/(T/N));
                        x = h2-R*(1-t1/T-n/N)*Math.cos(2*Math.PI*t1*N/T+Math.pow(-1,k)*Math.atan(Math.abs(w2-w1)/Math.abs(h2-h1))+(k>2?1:0)*(k%2?-1:1)*Math.PI);
                        y = w2-R*(1-t1/T-n/N)*Math.sin(2*Math.PI*t1*N/T+Math.pow(-1,k)*Math.atan(Math.abs(w2-w1)/Math.abs(h2-h1))+(k>2?1:0)*(k%2?-1:1)*Math.PI);
                        style+=(i++)*100/frame+'%{top:'+x+'px;left:'+y+'px;} ';
                    }
                    style+='100%{top:'+w2+'px;left:'+h2+'px;}}';
                    styleDom.html(style);
                    $("head").append(styleDom);
                };
            })();
            $(function(){
                var name = 'test';
                var turns = 1/4;//旋转圈数
                var duration = 2000;//子动画耗时
                var decrease_time = 500;//每次子动画耗时减少量
                var frame = 1000;//子动画帧数
                var count = 1;//子动画执行次数
                yjq(name,turns,duration,frame,count,decrease_time);
            });
        </script>
        <div id="test1"></div>
        <div id="test2"></div>
        <div id="test3"></div>
        <div id="test4"></div>
    </body>
</html>