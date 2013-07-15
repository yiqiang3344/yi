<!DOCTYPE html>
<html>
    <head>
        <title>旋转</title>
        <script type="text/javascript" src="./js/jquery.min.js"></script>
    </head>
    <body>
        <div style="text-align: center;"><img id="dial" style="-webkit-transition-property:-webkit-transform;-webkit-transform:rotate(0deg);width:200px;height:200px;" src="img/dial.png"/></div>
        <div style="margin-top:50px;text-align: center;"><input id="do" type="button" value="转" /></div>
        <div id="val" style="margin-top:50px;text-align: center;"></div>
        <script type="text/javascript">
            function run(index,callback){
                var round = (1+Math.ceil(2*Math.random()))*360;
                var start_deg = 390 - 60*(index-1);
                var rand_deg = Math.ceil(60*Math.random());
                var real_deg = round+start_deg-rand_deg;
                var t = Math.abs(real_deg/360);
                var dom = $('#dial');
                dom.css({
                    '-webkit-transition-duration':'0.00001ms',
                    '-webkit-transform':'rotate(0.1deg)'
                }).unbind('webkitTransitionEnd').bind('webkitTransitionEnd',function(){
                    dom.css({
                        '-webkit-transition-duration':t+'s',
                        '-webkit-transition-timing-function':'ease-out',
                        '-webkit-transform':'rotate('+real_deg+'deg)'
                    }).unbind('webkitTransitionEnd').bind('webkitTransitionEnd',function(){
                        callback();
                    });
                });
            }
            $('#do').click(function(){
                var index = Math.ceil(6*Math.random());
                $('#val').text(index);
                run(index,function(){});
            });
        </script>
    </body>
</html>