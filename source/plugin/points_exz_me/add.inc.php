<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

include("sql.func.php");
loadcache('points');
global $_G;
$uid = $_G['uid'];

$char_points_cache = $_G['cache']['points']['points_name_char'];
$id = $_GET['pointid'];
$type = substr($id, 0, 9);
$parentid = 'charpoint' . $char_points_cache[substr($id, 9, 2)][$type . 'parent'];
$freeid = $type . "free";
if (DB::query("update " . DB::table("points_member") . " set `" . $freeid . "`=`" . $freeid . "`-1 where `uid`=" . $uid) <> 1) {
    return;
}
DB::query("update " . DB::table("points_member") . " set `" . $id . "`=`" . $id . "`+1 where `uid`=" . $uid);
DB::query("update " . DB::table("points_member") . " set `" . $parentid . "`=`" . $parentid . "`+1 where `uid`=" . $uid);
//    update(DB::table("points_member"),"`uid`=" . $uid,$id . "`=`" . $id . "`-1");


