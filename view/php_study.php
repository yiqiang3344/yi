<div style="color:red">
<div style="color:red">
<script type="text/javascript">//static
    function print_page(){
        var html='test';
        document.write(html);
    }
    function ajaxfun(){
        // kajax('ajaxHero','ajaxSkillUpgrade',{hero_id:<?php echo $hero_id;?>,skill_id:skill},function(obj){
        //     if (obj.code == 1){
        //         State.back(1,{hero_id:<?php echo $hero_id;?>,msg:obj.msg});
        //     } else {
        //         showMsgDialog("提示",obj.msg);
        //     }
        // },this);
    }
</script>
<script type="text/javascript">
    // State.init(["hero","skillUpgradeDetail"],<?=json_encode(@$_GET["rtn"])?>);
    // State.set("hero_id",<?=$hero_id?>);
    // State.set("skill",<?=$skill?>);
    // var hero_id = <?= json_encode($hero_id) ?>;
    print_page();
</script>
</div>
<?php
    // sleep(3);
    // echo 'ok';
    // extract($_REQUEST);

    // $message = '';
    // if(isset($error)){
    //     foreach(is_array($error)?$error:array($error) as $values){
    //         $message .= $values;
    //     }
    // }else if (isset($success)){
    //     foreach(is_array($success)?$success:array($success) as $values){
    //         $message .= $values;
    //     }
    // }
    // echo $message;die;

//    $str = "1.testone (off) 2.testtwo (off) 3.testthree (off)";
//    $arr = array();
//    foreach(explode('.',$str) as $row){
//        ($s=strstr($row,'(',true)) && $arr[] = $s;
//    }
//    print_r($arr);



//    include_once './components/KExcelReader.php';
//    chmod('file/test.xls',0755);
//    $reader = KExcelReader::load('./file/test.xls');
//    list($header_list, $data)=$reader->getTable("Sheet1");
//    print_r($data);




//    echo intval('700+');die;
//
//    $val    = "0.000000001";
//    $add    = "0.000000001";
//    for ($i=0; $i < 100; $i++) {x
//        $val = bcadd($val, $add, 9);
//        echo $val.'<br>';
//    }
//    die;
//
//
//    $r_count = 16;
//    $member_count = 255;
//    $now_count = 128;
//    $rount_count=intval(ceil(log($member_count,2)))-intval(ceil(log($r_count,2)));
//    $n_rount=intval(ceil(log($member_count,2)))-intval(ceil(log($now_count,2)));
//
//
//    echo '总场数：'.$rount_count.'  当前场数：'.$n_rount;die;


//$str = "The quick brown fox jumped over the lazy dog.";
//$str = preg_replace('/\s/','-',$str);
//echo $str;die;
//    $ss = '<img src="32222222"> <img src="1\"">';
//    $ss = preg_replace('/(<img +)(src=\")([^\"][^>]*)(\">)/', '${1}${2}test${4}',$ss);
//    print_r($ss);die;
//    echo $ss;die;

//    date_default_timezone_set('Asia/shanghai');
//    echo strtotime('20130418 00:00:00');die;
//
//    eval('echo array(
//	KMenu(\'start_time\',\'max_member\',\'status_list\'),
//	array(".strtotime(\'20130301 00:00:00\').",\'256\',array(
//		KMenu(KKey(\'status\'),\'time\',\'member\'),
//		array(A::COMPETITION_STATUS_SIGN_UP,".strtotime(\'20130301 12:00:00\').",0),
//		array(A::COMPETITION_STATUS_SIGN_UP_END,".strtotime(\'20130302 13:00:00\').",0),
//		array(A::COMPETITION_STATUS_DIE_OUT,".strtotime(\'20130305 14:50:00\').",32),
//		array(A::COMPETITION_STATUS_BATTLE_16,".strtotime(\'20130318 8:00:00\').",16),
//		array(A::COMPETITION_STATUS_BATTLE_8,".strtotime(\'20130320 9:20:00\').",8),
//		array(A::COMPETITION_STATUS_BATTLE_4,".strtotime(\'20130321 10:40:00\').",4),
//		array(A::COMPETITION_STATUS_BATTLE_2,".strtotime(\'20130322 14:40:00\').",2),
//		array(A::COMPETITION_STATUS_BATTLE_1,".strtotime(\'20130322 14:50:00\').",1),
//            )
//        )
//    );');die;

//    echo date('Y-m-d h:i:s');die;

//    echo "return array(
//	KMenu('start_time','max_member','status_list'),
//	array(".strtotime('20130301 00:00:00').",'256',array(
//		KMenu(KKey('status'),'time','member'),
//		array(A::COMPETITION_STATUS_SIGN_UP,".strtotime('20130301 12:00:00').",0),
//		array(A::COMPETITION_STATUS_SIGN_UP_END,".strtotime('20130302 13:00:00').",0),
//		array(A::COMPETITION_STATUS_DIE_OUT,".strtotime('20130305 14:50:00').",32),
//		array(A::COMPETITION_STATUS_BATTLE_16,".strtotime('20130318 8:00:00').",16),
//		array(A::COMPETITION_STATUS_BATTLE_8,".strtotime('20130320 9:20:00').",8),
//		array(A::COMPETITION_STATUS_BATTLE_4,".strtotime('20130321 10:40:00').",4),
//		array(A::COMPETITION_STATUS_BATTLE_2,".strtotime('20130322 14:40:00').",2),
//		array(A::COMPETITION_STATUS_BATTLE_1,".strtotime('20130322 14:50:00').",1),
//	)),";die;
//		array(A::COMPETITION_STATUS_BATTLE_16,".strtotime('20130310 17:00:00').",16),
//		array(A::COMPETITION_STATUS_BATTLE_8,".strtotime('20130313 17:20:00').",8),
//		array(A::COMPETITION_STATUS_BATTLE_4,".strtotime('20130315 17:30:00').",4),
//		array(A::COMPETITION_STATUS_BATTLE_2,".strtotime('20130317 19:40:00').",2),
//		array(A::COMPETITION_STATUS_BATTLE_1,".strtotime('20130319 17:50:00').",1),

//    echo '开始 '.strtotime('20130301 00:00:00');
//    echo '<br/>';
//    echo '报名 '.strtotime('20130301 12:00:00');
//    echo '<br/>';
//    echo '报名截止 '.strtotime('20130305 13:00:00');
//    echo '<br/>';
//    echo '淘汰赛 '.strtotime('20130308 14:50:00');
//    echo '<br/>';
//    echo '16 '.strtotime('20130310 17:00:00');
//    echo '<br/>';
//    echo '8 '.strtotime('20130313 17:20:00');
//    echo '<br/>';
//    echo '4 '.strtotime('20130315 17:30:00');
//    echo '<br/>';
//    echo '2 '.strtotime('20130319 19:40:00');
//    echo '<br/>';
//    echo '1 '.strtotime('20130320 19:50:00');
//    echo '<br/>';die;
//[1,
//    [["48", 4, "\u5996\u513f"], false],
//    [[7, "\u62c9\u59c6\u59c6", 22, 791, 791, 50, 1], false, false, false, [1, "\u5996\u513f", 23, 904, 904, 50, 1], false, false, [8, "\u4e9a\u4f2f", 19, 1005, 1005, 50, 1], false, false, false, false, false, [73001, "\u8349\u7cbe", 3, 6800, 6800, 50, 1], false, false, false, false],
//    [[[11, 0, [[13, 238, 25, [[23]]]], 25, [[11]]], [10, 4, [[13, 175, 25, []]], 25, []], [273, 13, [[4, 0, 0, [[21]]]], -100, []], [10, 7, [[13, 257, 25, []]], 25, []]], [[11, 0, [[13, 243, 25, [[23]]]], 25, [[11]]], [10, 4, [[13, 145, 25, []]], 25, []], [10, 13, [[4, 5, 25, []]], 25, []], [10, 7, [[13, 209, 25, []]], 25, []]], [[107, 0, [[13, 122, 0, [[23], [2]]]], -100, [[11]]], [101, 4, [[13, 96, 0, [[2]]]], -125, []], [273, 13, [[4, 0, 0, [[21]]]], -125, [[2], [12, 3]]], [108, 7, [[13, 98, 0, [[2]]]], -100, [[3]]]], [[11, 0, [[13, 300, 25, [[2], [23]]]], 25, [[11]]], [10, 4, [[13, 149, 25, [[2]]]], 25, []], [10, 13, [[4, 5, 25, []]], 25, [[2], [12, 2]]], [10, 7, [[13, 216, 25, [[2]]]], 25, [[3]]]], [[11, 0, [[13, 299, 25, [[2], [23]]]], 25, [[11]]], [10, 4, [[13, 182, 25, [[2]]]], 25, []], [273, 13, [[4, 0, 0, [[21]]]], -150, [[2], [12, 1]]], [10, 7, [[13, 354, 25, [[2], [23]]]], 25, [[3], [11]]]], [[2, [[7, []], [13, []]]], [11, 0, [[13, 307, 25, [[23]]]], 25, [[11]]], [10, 4, [[13, 216, 25, [[23]]]], 25, [[11]]], [10, 13, [[4, 5, 25, []]], 25, []], [10, 7, [[13, 186, 25, []]], 25, []]], [[11, 0, [[13, 317, 25, [[23]]]], 25, [[11]]], [101, 4, [[13, 81, 0, []]], -125, []], [273, 13, [[4, 193, 0, []]], -150, []], [10, 7, [[13, 263, 25, []]], 25, []]], [[107, 0, [[13, 155, 0, [[23], [2]]]], -100, [[11]]], [10, 4, [[13, 173, 25, [[2]]]], 25, []], [10, 13, [[4, 4, 25, []]], 25, [[2], [12, 3]]], [108, 7, [[13, 0, 0, [[2], [21]]]], -100, [[3]]]], [[11, 0, [[13, 308, 25, [[2], [23]]]], 25, [[11]]], [10, 4, [[13, 259, 25, [[2], [23]]]], 25, [[11]]], [273, 13, [[4, 0, 0, [[21]]]], -125, [[2], [12, 2]]], [10, 7, [[13, 431, 25, [[2], [23]]]], 25, [[3], [11]]]], [[11, 0, [[13, 212, 25, [[2], [23]]]], 25, [[11]]], [10, 4, [[13, 310, 25, [[2], [23]]]], 25, [[11]]], [10, 13, [[4, 5, 25, []]], 25, [[2], [12, 1]]], [10, 7, [[13, 440, 25, [[2], [23]]]], 25, [[3], [11]]]], [[2, [[7, []], [13, []]]], [11, 0, [[13, 47, 25, [[23]]]], 25, [[11]]]]],
//    [1, 1]
//];
//
//[1,
//    [["48",4,"\u5996\u513f"],false],[[7,"\u62c9\u59c6\u59c6",22,791,791,50,1],false,false,false,[1,"\u5996\u513f",23,904,904,50,1],false,false,[8,"\u4e9a\u4f2f",19,1005,1005,50,1],false,false,false,false,[54001,"\u6076\u9b54\u8759\u8760",20,398,398,50,1],[17001,"\u9ab7\u9ac5",20,597,597,50,1],[54001,"\u6076\u9b54\u8759\u8760",20,398,398,50,1],false,false,false],
//    [[[11,0,[[12,107,25,[]]],25,[]],[10,12,[[0,138,25,[]]],25,[]],[10,4,[[13,162,25,[[23]]]],25,[[11]]],[10,13,[[4,62,25,[]]],25,[]],[10,14,[[4,130,25,[]]],25,[]],[10,7,[[13,135,25,[]]],25,[]]],[[107,0,[[12,117,0,[[2]]]],-100,[]],[254,12,[[0,32,0,[[24,0]]]],-100,[[2],[12,3]]],[101,4,[[13,90,0,[]]],-125,[]],[217,13,[[4,66,0,[[23]]]],-125,[[11]]],[10,14,[[4,115,25,[]]],25,[]],[10,7,[[13,160,25,[]]],25,[]]],[[11,0,[[12,135,25,[[2]]]],25,[]],[10,12,[[0,133,25,[]]],25,[[2],[12,2]]],[10,4,[[13,50,25,[]]],25,[]],[254,14,[[4,74,0,[[23],[24,33]]]],-100,[[11]]],[108,7,[[12,34,0,[[2]]]],-100,[[3]]]],[[11,0,[[14,138,25,[]]],25,[]],[10,4,[[14,111,25,[]]],25,[]],[10,14,[[4,108,25,[]]],25,[]],[10,7,[[14,149,25,[]]],25,[[3]]]]],
//    [1,6]
//];

//    echo mt_rand(-10, 10);die;
//
//    $num = 222;
//    $count = 0;
//    for(;$num!=0;){
//        $num=$num>>1;
//        echo ($num).'<br/>';
//        $count++;
//    }
//    echo pow(2,$count-1);
//    die;
//    $test = '  ';
//    var_dump(empty($test));die;
//    echo mt_rand(0,13)/10;die;
//    echo floor(40/10)*10-9;die;
//    echo (floor(23/10)-1)*10-9;die;
//    echo mt_rand();die;
//    $a = array(1,2,3,array(2,3,4));
//    echo '1.'.var_export($a,true);die;
//
//    echo getcwd();die;
//
//    $list = array(
//        array(
//            'pos'=>3,
//            'v'=>1,
//            ),
//        array(
//            'pos'=>2,
//            'v'=>2,
//            ),
//        array(
//            'pos'=>1,
//            'v'=>3,
//            )
//    );
//    usort($list, function($a,$b){
//            if($a['pos']==$b['pos']){
//                return 0;
//            }
//            return $a['pos']>$b['pos']?1:-1;
//        });
//    print_r($list);
//    die;
//
//    echo array_rand(array('a','c'));die;
//    echo 'p'.(1);
//    die;
//    array_multisort(array(), SORT_ASC, array());
//    die;
//    $arr = array('a','b','c');
//    print_r(explode(',', ''));die;
//
//    echo 329+360+332+332+570+349+396+369+404+361+401+397+360+438+382.2+332+475+420+437;die;
     // date_default_timezone_set('Asia/ShangHai');
     // echo date('Ymd','1348070400');die;
    // echo strtotime(date('Ym01'));die;
//    $uid = 12341234;
//    $user_id = 1;
//    $type = 1;
//    $ref_code = 12341234;
//    $uuids = '111111,111112';
//    $list = json_encode(array(array('uuid'=>'111113','type'=>1,'int_a'=>0,'int_b'=>0,'int_c'=>0,'int_d'=>0,'int_e'=>0,'int_f'=>0,'str_a'=>'','str_b'=>'','str_c'=>'','str_d'=>'','json_a'=>'','record_time'=>1328093214)));
//    $name = 'test';
//    $score = 140;
//    $item = 1;
//    $item_count = 1;
//    $uuid = 111116;
//
//    $data = array(
//        'uid'=>$uid,
//        'uuids'=>$uuids,
//        'list'=>$list,
//        'item'=>$item,
//        'item_count'=>$item_count,
//        'score'=>$score,
//        'name'=>$name,
//        'user_id'=>$user_id,
//        'type'=>3,
//        'page'=>1,
//        'page_size'=>15,
//        'require_all'=>1
//        'uuid'=>$uuid,
//    );
//    $sets = array();
//    foreach($data as $k=>$v){
//        $sets[] = "$k=$v";
//    }
//    $md5 = md5(implode('&', $sets).'&secret=1234');
