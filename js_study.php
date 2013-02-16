<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>test3.html</title>
        <script type="text/javascript" src="js/jquery-1.5.js"></script>
        <style>
        </style>
    </head>
    <body>
    <script type="text/javascript">
        String.prototype.yjq_1 = function (count) {
          return count < 1 ?
            '' : new Array(count + 1).join(this);
        }

        $(function(){
            var arr = new Array();
            var arr1 = arr;
            arr[0] = 2;
            alert(arr1[0]);

            var obj = $('.fade_list div');
            obj.hide();
            $('#fadeIn').click(function(){
                MyfadeIn(obj);
            });
        });

        function MyfadeIn(obj){
            for(var i=0;i<obj.length;i++){
                (function(){
                    var index = i;
                    setTimeout(function(){
                        obj.eq(index).fadeIn(1000);
                    },index*1000);
                })();
            }
        }
    </script>
        <div  class="fade_list" style="font-size:30px;">
            <div>test1</div>
            <div>test2</div>
            <div>test3</div>
            <div>test4</div>
        </div>
        <div id="info"></div>
        <input type="button" value="show" id="fadeIn"/>
    </body>
</html>