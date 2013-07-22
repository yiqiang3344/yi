<script type="text/javascript">
	function print(){
		var html = '';
		$.each(info,function(k,v){
			html += '<div>';
			$.each(v,function(k1,v1){
				html += k1+':'+v1+',';
			});
			html += '</div>';
		});
		document.write(html);
	}
</script>
<script type="text/javascript">
	var info = <?=json_encode($info)?>;
	print();
</script>
