<?php

if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

class plugin_points_exz_me
{
    function plugin_points_exz_me()
    {
    }
}

class plugin_points_exz_me_home extends plugin_points_exz_me
{
    function space_profile_baseinfo_bottom()
    {
        global $_G;
        $uid = $_G['uid'];
        $points = DB::query("select * from  " . DB::table("points_member") . " where `uid` =" . $uid);
        $points_a = mysql_fetch_array($points);
        //todo a better gui
        require_once libfile('function/cache');
        updatecache('points');
        //todo remove updatecache

        loadcache('points');

        return '<h1>test 233</h1><iframe src="http://exz.me"></iframe>';
    }
}