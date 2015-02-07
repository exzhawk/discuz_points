<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once libfile('function/cache');
updatecache('points');
//todo remove updatecache
loadcache('points');
global $_G;
$uid = $_G['uid'];
$t = microtime(true) * 1000;
$user_points = mysql_fetch_array(DB::query('SELECT * FROM ' . DB::table('points_member') . ' WHERE `uid` =' . $uid));
$user_sign = mysql_fetch_array(DB::query('SELECT days FROM ' . DB::table('dsu_paulsign') . ' WHERE `uid` =' . $uid));
$to_add = floor(($user_sign['days'] - $user_points['usedsign']) / 28);
if ($to_add != 0) {
    DB::query('UPDATE ' . DB::table('points_member') . ' SET `charpointfree`=`charpointfree`+' . $to_add . ' WHERE `uid`=' . $uid);
    DB::query('UPDATE ' . DB::table('points_member') . ' SET `usedsign`=`usedsign`+' . $to_add * 28 . ' WHERE `uid`=' . $uid);
    $user_points['charpointfree']+=$to_add;
}


$char_points_div = '';
$char_points_arr = array();
$char_points_cache = $_G['cache']['points']['points_name_char'];
//print_r($char_points_cache);
foreach ($char_points_cache as $points_id => $points_item) {
//    print_r($points_item);
    if ($points_item['charpointparent'] == 0) {
        $char_points_arr[$points_id] = '';
    } else {
        $curli = '<li><span class="charpoint_name" id="charpoint' . $points_item['charpointid'] . '_name">' . $points_item['charpointname'] . '</span>
        <span class="charpoint_value" id="charpoint' . $points_item['charpointid'] . '_value">' . $user_points['charpoint' . $points_item['charpointid']] . '</span>
        <input type="button"  value="+1" onclick="add(this)" class="charpoint_btn" id="charpoint' . $points_item['charpointid'] . '_btn"></li>';
//     print_r($curli);
//        $char_points_arr[$points_item['charpointparent']] .= 'a';
        $char_points_arr[$points_item['charpointparent']] .= $curli;
//        print_r($char_points_arr);
    }
}
//        print_r($char_points_arr);

foreach ($char_points_arr as $points_id => $points_cont) {
    $curul = '<ul><strong><span>' . $char_points_cache[$points_id]['charpointname'] . '</span><span>' . $user_points['charpoint' . $points_id] . '</span></strong>' . $points_cont . '</ul>';
    $char_points_div .= $curul;
}
//todo complete inte one
include template('points_exz_me:points');