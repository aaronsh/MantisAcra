<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-31
 * Time: 下午1:30
 */

function get_project_package_list($p_package_id){
    $t_acra_prj_table = plugin_table("project");
    $query = "SELECT * FROM $t_acra_prj_table WHERE `project_id` = $p_package_id LIMIT 0, 1";
    $result = db_query_bound($query);
    $result = db_fetch_array($result);
    if ($result === false) {
        return;
    }
    $packages = $result['packages'];
    return handle_project_package_list($packages);
}

function handle_project_package_list($p_packages){
    $packages = explode("\n", $p_packages);
    $app_packages = array();
    foreach($packages as $pack){
        $pack = trim($pack).".";
        $pack = preg_replace("/(\\.+)/", ".", $pack);
        if( strlen($pack) > 1 ) {
            $app_packages[$pack] = strlen($pack);
        }
    }
    return $app_packages;
}

?>