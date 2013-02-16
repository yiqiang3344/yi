<?php
    $test = '  ';
    var_dump(empty($test));die;
    echo mt_rand(0,13)/10;die;
    echo floor(40/10)*10-9;die;
    echo (floor(23/10)-1)*10-9;die;
    echo mt_rand();die;
    $a = array(1,2,3,array(2,3,4));
    echo '1.'.var_export($a,true);die;

    echo getcwd();die;

    $list = array(
        array(
            'pos'=>3,
            'v'=>1,
            ),
        array(
            'pos'=>2,
            'v'=>2,
            ),
        array(
            'pos'=>1,
            'v'=>3,
            )
    );
    usort($list, function($a,$b){
            if($a['pos']==$b['pos']){
                return 0;
            }
            return $a['pos']>$b['pos']?1:-1;
        });
    print_r($list);
    die;

    echo array_rand(array('a','c'));die;
    echo 'p'.(1);
    die;
    array_multisort(array(), SORT_ASC, array());
    die;
    $arr = array('a','b','c');
    print_r(explode(',', ''));die;

    echo 329+360+332+332+570+349+396+369+404+361+401+397+360+438+382.2+332+475+420+437;die;
     // date_default_timezone_set('Asia/ShangHai');
     // echo date('Ymd','1348070400');die;
    // echo strtotime(date('Ym01'));die;
    $uid = 12341234;
    $user_id = 1;
    $type = 1;
    $ref_code = 12341234;
    $uuids = '111111,111112';
    $list = json_encode(array(array('uuid'=>'111113','type'=>1,'int_a'=>0,'int_b'=>0,'int_c'=>0,'int_d'=>0,'int_e'=>0,'int_f'=>0,'str_a'=>'','str_b'=>'','str_c'=>'','str_d'=>'','json_a'=>'','record_time'=>1328093214)));
    $name = 'test';
    $score = 140;
    $item = 1;
    $item_count = 1;
    $uuid = 111116;

    $data = array(
//        'uid'=>$uid,
//        'uuids'=>$uuids,
//        'list'=>$list,
//        'item'=>$item,
//        'item_count'=>$item_count,
//        'score'=>$score,
//        'name'=>$name,
        'user_id'=>$user_id,
//        'type'=>3,
//        'page'=>1,
//        'page_size'=>15,
//        'require_all'=>1
//        'uuid'=>$uuid,
    );
    $sets = array();
    foreach($data as $k=>$v){
        $sets[] = "$k=$v";
    }
    $md5 = md5(implode('&', $sets).'&secret=1234');
?>
<script type="text/javascript" src="js/jquery-1.5.js"></script>
<script type="text/javascript">
    $.post(
        'http://yjq.com/game/dev/htdocs/index.php/main/GetBaseData',
        {
//            uid:<?=json_encode($uid)?>,
//            uuids:<?=json_encode($uuids)?>,
//            list:<?=json_encode($list)?>,
//            item:<?=json_encode($item)?>,
//            item_count:<?=json_encode($item_count)?>,
//            score:<?=json_encode($score)?>,
//            name:<?=json_encode($name)?>,
            user_id:<?=json_encode($user_id)?>,
//            type:<?=json_encode(3)?>,
//            page:<?=json_encode(1)?>,
//            page_size:<?=json_encode(15)?>,
//            require_all:<?=json_encode(1)?>,
//            uuid:<?=json_encode($uuid)?>,
            md5:<?=json_encode($md5)?>
        },
        function(obj){
            alert(obj);
        },'json')
</script>