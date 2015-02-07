<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}

function select($table, $where)
{
    $sql = 'select * from ' . DB::table($table) . ' where ' . $where;
    return mysql_fetch_array(DB::query($sql));
}

function update($table, $where, $data)
{
    $sql = 'update ' . $table . ' set ' . $data . ' where ' . $where;
    error_log($sql);
    return mysql_fetch_array(DB::query($sql));

}