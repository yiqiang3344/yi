<!DOCTYPE html>
<html>
	<head>
		<title>拖动</title>
		<script type="text/javascript" src="./js/jquery.min.js"></script>
	</head>
	<body>
		<div id="drag" draggable="true">test1</div>
		<div id="drag1" draggable="true">test2</div>
		<div id="drag2" draggable="true">test3</div>
		<div id="favorite" style="height:100px;width:300px;background-color:#ddd;">收藏夹</div>
		<div id="gb" style="height:100px;width:100px;background-color:#aaa;">回收站</div>
		<script type="text/javascript">
			$('div[draggable=true]').each(function(){
				var obj = this;
				this.ondragstart = function(evt){
					evt.dataTransfer.setData("text/plain","<item>"+obj.id);
				}
			});

			document.getElementById('favorite').ondrop = function(evt){
				var text = evt.dataTransfer.getData("text/plain");
				if(text.indexOf("<item>")==0){
					var id = text.replace('<item>','');
					var newEle = document.createElement("div");
					newEle.id = new Date().getUTCMilliseconds();
					newEle.innerHTML = document.getElementById(id).innerHTML;
					newEle.draggable = 'true';
					newEle.ondragstart = function(evt){
						evt.dataTransfer.setData('text/plain','<remove>'+newEle.id);
					}
					this.appendChild(newEle);
				}
			}

			document.getElementById('gb').ondrop = function(evt){
				var text = evt.dataTransfer.getData("text/plain");
				var id = false;
				if(text.indexOf("<item>")==0){
					id = text.replace('<item>','');
				} 
				if(text.indexOf("<remove>")==0){
					id = text.replace('<remove>','');
				}
				if(id){
					$('#'+id).remove();
				}
			}

			document.ondragover = function(evt){
				return false;
			}

			document.ondrop = function(evt){
				return false;
			}
		</script>
	</body>
</html>