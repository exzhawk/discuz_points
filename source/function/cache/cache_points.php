<?php
/**
 * Created by PhpStorm.
 * User: Epix
 * Date: 2015/1/10
 * Time: 21:47
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function build_cache_points() {
//    $data = array();
//    $data['a'] = 'Hello World';
//    $data['a'] = 'Hello Discuz!';
    $sql = 'select * from ' . DB::table('points_name_char') . ' where charpointparent <> 100';
    $points_name_char = DB::query($sql);
    $points_name_char_table = array();
    while ($row = mysql_fetch_array($points_name_char)) {
        $points_name_char_table[$row['charpointid']] = array('charpointid' => $row['charpointid'],'charpointparent' => $row['charpointparent'], 'charpointname' => $row['charpointname']);
    }
    $data = array();
    //todo complete inte one
    $data['points_name_char'] = $points_name_char_table;
    save_syscache('points', $data);
}
