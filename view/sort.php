<?php
$count  = 100;
$r_count= 16 ;

$n=intval(ceil(log($count,2)));
$max=pow(2,$n);
$n_count=pow(2,$n)/$r_count;

$ar=array();//按战力从大到小排序
for($i=0;$i<$count;$i++){
	$ar[]=$i+1;
}

#========================================================
$ar1=array();
for($i=0;$i<$r_count;$i++){
	$ar1[]=array(array_shift($ar));
}

for($i=0;$i<$r_count;$i++){
	$zero_count=floor(($max-$count)/$r_count)+ ($i< ($max-$count)%$r_count?1:0);
	for($ii=0;$ii< $n_count-1-$zero_count;$ii++){
		$ar1[$i][]=array_pop($ar);
	}
}

for($i=0;$i<$r_count;$i++){
	$old_ar=$ar1[$i];
	shuffle($old_ar);
	$new_ar=array();
	for($ii=$n_count;$ii-- >0;){
		$new_ar[]=false;
	}
	for($ii=0;$ii<count($old_ar);$ii++){
		if($ii<$n_count/2){
			$new_ar[intval($ii*2)]=$old_ar[$ii];
		}else{
			$new_ar[intval(($ii-$n_count/2)*2+1)]=$old_ar[$ii];
		}
	}
	$ar1[$i]=$new_ar;
}

shuffle($ar1);
$result=array();
foreach($ar1 as $row){
	$result=array_merge($result,$row);
}
#========================================================
echo count($result);
print_r($result);
echo(json_encode($result));

//淘汰赛1局定胜负



