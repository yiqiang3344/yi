<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>test3.html</title>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/my.js"></script>
    </head>
    <body>
        <!-- <div><input type="text" id="content" placeholder="输入要检测的文字"/></div>
        <div><button id="check">检测</button></div>
        <div id="info" class="cl1 cl2"></div> -->
        <!-- <div id="info" class="cl1 cl2"></div> -->
        <!-- <select multiple="multiple">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
        </select> -->
        <!-- <div id="info" class="cl1 cl2">test
        </div>
        <div><button id="check">检测</button></div> -->

        <!-- <<div id="info"></div> -->

        <script type="text/javascript">
            // $("#info").html("<script>alert(1);<\/script>");
            // var Name = Class.extend({
            //     init: function(name) {
            //         this.name = 'Yi' + name;
            //     }
            // });
            // var NamePrinter = Name.extend({
            //     showName: function() {
            //         alert(this.name);
            //     },
            //     init:function(name){
            //         this._super(name);
            //         this.name += name;
            //     }
            // });

            // var yjq = new NamePrinter('qiang');
            // yjq.showName();


            function Name(firstName){
                this.init = function( name){
                    this.name = name;
                }
                // this.init(firstName);
            }

            function NamePrinter(name){
                this.showName = function(){
                    alert(this.name);
                }
                var super_init = this.init;
                this.init = function(name){
                    super_init.call(this,name);
                    this.name += name;
                }
                this.init(name);
            }
            NamePrinter.prototype = new Name('Yi');

            // NamePrinter.init = function(name){
            //     this.name = name;
            // }
            var yjq = new NamePrinter('qiang');

            yjq.showName();




            // var animals = [
            //   {species: 'Lion', name: 'King'},
            //   {species: 'Whale', name: 'Fail'}
            // ];
             
            // for (var i = 0; i < animals.length; i++) {
            //   (function (i) {
            //     this.print = function () {
            //       console.log('#' + i  + ' ' + this.species + ': ' + this.name);
            //     }
            //     this.print();
            //   }).call(animals[i], i);
            // }

            // $('#info').delegate('p','click',{t:'test'},function(e){
            //     console.log(e.data);
            //     $(this).text('test');
            // });
            // $('#check').click(function(){
            //     $(this).unwrap();
                // $('#info').append('<p style="background-color:yellow;height:50px;width:100px;"></p>');
                // $.ajax({
                //     xhr:function(){
                //         var xmlhttp;
                //         if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                //             xmlhttp=new XMLHttpRequest();
                //         }else{// code for IE6, IE5
                //             xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                //         }
                //         xmlhttp.onreadystatechange = function(){
                //             console.log(xmlhttp.readyState);
                //         }
                //         return xmlhttp;
                //     },
                //     beforeSend: function (xhr) {
                //     },
                //     url:'php_study.php',
                //     type:'post',
                //     success:function(res,statusTxt,xhr){
                //         console.log(xhr);
                //         $('#info').html(res+',status:'+statusTxt);
                //     }
                // });
                // $('#info').load('test.txt',{},function(res,statusTxt,xhr){
                //     if(statusTxt=='success'){
                //         alert('ok.');
                //     }else if(statusTxt=='error'){
                //         alert('error:'+xhr.status+':'+xhr.statusText);
                //     }
                // });
                // $('#info').removeClass();
                // $('#info').removeClass('cl2 cl3');
                // $('#info').toggleClass('cl2 cl3');
                // $('#info').removeClass(function(i,origClass){
                //     console.log(origClass);
                //     // if(origClass=='cl1'){
                //         return 'cl1';
                //     // }
                // });
                // $('#info').toggleClass(function(i,origClass){
                //     console.log(origClass);
                //     // if(origClass=='cl1'){
                //         return 'cl1';
                //     // }
                // });
            // });
            // var list = [];
            // list.test = 1;
            // console.log(list.test);
            // console.log(list.length);


//            function isChn(str){
//                return /^[\u4E00-\u9FA5]+$/.test(str);
//            }
//            $('#check').click(function(){
//                var v = $('#content').val();
//                console.log(v);
//                console.log(isChn(v));
//                if(isChn(v)){
//                    $('#info').html('yes');
//                }else{
//                    $('#info').html('no');
//                }
//            });

            //        var num = 10;
            //        for(var i=3,l=num.toString().length;i>l;i--){
            //            num = '0'+num;
            //        }
            //        console.log(num);

            //        var time = 1363536000;
            //        var Mdate = new Date(parseInt(time) * 1000);
            //        var month = Mdate.getMonth()-(-1);
            //        var date = Mdate.getDate();
            //        var hour = Mdate.getHours()<10?'0'+Mdate.getHours():Mdate.getHours();
            //        var minutes = Mdate.getMinutes()<10?'0'+Mdate.getMinutes():Mdate.getMinutes();
            //
            //        alert( month+'-'+date+' '+hour+':'+minutes);
            //
            //        String.prototype.yjq_1 = function (count) {
            //          return count < 1 ?
            //            '' : new Array(count + 1).join(this);
            //        }

            //        $(function(){
            //            var arr = new Array();
            //            var arr1 = arr;
            //            arr[0] = 2;
            //            alert(arr1[0]);
            //
            //            var obj = $('.fade_list div');
            //            obj.hide();
            //            $('#fadeIn').click(function(){
            //                MyfadeIn(obj);
            //            });
            //        });
            //
            //        function MyfadeIn(obj){
            //            for(var i=0;i<obj.length;i++){
            //                (function(){
            //                    var index = i;
            //                    setTimeout(function(){
            //                        obj.eq(index).fadeIn(1000);
            //                    },index*1000);
            //                })();
            //            }
            //        }
        </script>
    </body>
</html>