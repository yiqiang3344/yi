<!DOCTYPE html>
<html>
    <head>
        <title>拖动</title>
        <script type="text/javascript" src="./js/jquery.min.js"></script>
    </head>
    <body>
        <video src="./video/video1.avi" poster="./img/1.jpg" controls>您的浏览器不支持此格式</video>
        <audio src="./audio/audio1.mp3" controls>您的浏览器不支持此格式</audio>
        <p>输入框里的默认文字</p>
        <input type="text" placeholder="test" />
        <p>带有可选菜单的输入框</p>
        <input type="text" list="datalist"/>
        <datalist id="datalist">
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="31">31</option>
        </datalist>
        <p>颜色选择器</p>
        <input type="color" id="colorinput"/><span id="colorinputvalue"></span>
        <p>日期选择器</p>
        <input type="date" id="dateinput"/><span id="dateinputvalue"></span>
        <p>时间选择器</p>
        <input type="time" id="timeinput"/><span id="timeinputvalue"></span>
        <form action="#">
            <p>email</p>
            <input type="email" id="email"/>
        </form>
        <p>数字</p>
        <input type="number" id="number"/>
        <p>范围</p>
        <input type="range" id="range" max="10" min="0" step="1"/><span id="rangeinputvalue"></span>
        <form>
            <p>带校验的输入框（必须填写）</p>
            <input type="text" id="valid1" required/>
            <p>带校验的输入框（2位数字限制）</p>
            <input type="text" required pattern="\d{2}"/>
            <p>带校验的输入框（数字大小限制）</p>
            <input type="number" required max="10" min="6"/>
            <input type="submit" value="无校验提交" onclick="check();" formnovalidate/>
            <input type="submit" value="有校验提交" onclick="check();"/>
        </form>

        <script type="text/javascript">
            $('#colorinput').change(function(){
                $('#colorinputvalue').text($(this).val());
            });
            $('#dateinput').change(function(){
                $('#dateinputvalue').text($(this).val());
            });
            $('#timeinput').change(function(){
                $('#timeinputvalue').text($(this).val());
            });
            $('#email').change(function(){
                $('#email').parent('form').toggle('submit');
            });
            $('#range').change(function(){
                $('#rangeinputvalue').text($(this).val());
            });
            var check = function(){
                if(!document.getElementById('valid1').checkValidity()){
                    document.getElementById('valid1').setCustomValidity('自定义的必须填的提示信息！');
                }
            }
        </script>
    </body>
</html>