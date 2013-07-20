<?php
function yDie($m=''){
	if(YDEBUG){
		throw new Exception($m);
	}else{
		die($m);
	}
}