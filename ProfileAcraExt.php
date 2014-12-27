<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-31
 * Time: 下午1:30
 */

require_once( 'profile_api.php' );

function profile_exists( $p_platform, $p_os, $p_os_build ) {
    $t_user_profile_table = db_get_table( 'mantis_user_profile_table' );

    $query_where = 'platform = ' . db_param() . ' and os = ' . db_param() . ' and os_build = ' . db_param();

    $query = "SELECT *
				  FROM $t_user_profile_table
				  WHERE $query_where
				  ORDER BY platform, os, os_build";
    $result = db_query_bound( $query,  Array( $p_platform, $p_os, $p_os_build ) );

    $result = db_fetch_array($result);
    if( $result === false){
        return false;
    }
    return $result['id'];
}

function profile_create_unique( $p_user_id, $p_platform, $p_os, $p_os_build, $p_description ) {
    $t_profile_id = profile_exists($p_platform, $p_os, $p_os_build);
    if( $t_profile_id === false ){
        $t_profile_id = profile_create($p_user_id, $p_platform, $p_os, $p_os_build, $p_description);
    }
    return $t_profile_id;
}
