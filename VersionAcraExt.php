<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-31
 * Time: 下午1:30
 */

function create_map_file_folder($Folder){
    if(!is_readable($Folder)) {
        create_map_file_folder(dirname($Folder));
        if (!is_file($Folder)) {
            mkdir($Folder, 0777);
        }
    }
}

function update_bug_summary_by_version($t_version, $map_file){
    $db_table =  db_get_table( 'mantis_bug_table' );
    $query = "SELECT `id`, `summary` FROM $db_table WHERE `version` = '".mysql_real_escape_string($t_version)."'";
    $result = db_query_bound( $query );
    $rows = array();
    while(true){
        $row = db_fetch_array($result);
        if( $row == false ){
            break;
        }
        $rows[] = $row;
    }

    $map_content = file_get_contents($map_file);
    $map = explode("\n", $map_content);
    foreach($rows as $row){
        $bug_id = $row['id'];
        $stacktrace = bug_get_text_field($bug_id, 'description');
        error_log($stacktrace);
        $stacktrace = get_crash_position($stacktrace);
        //$stacktrace = restore_stacktrace($stacktrace, $map);
        $stacktrace = '"Acra report crash '.$stacktrace;
        $stacktrace = mysql_real_escape_string($stacktrace);
        $query = "UPDATE `$db_table` SET `summary` = '$stacktrace' WHERE `id` = $bug_id; ";
        db_query_bound( $query );
    }
}

function handle_mapping_file($map_file, $restore_file){
    $content = file_get_contents($map_file);

    $arr = explode("\n", $content);
    $map = array();

    $clzMapped = '';
    $clzOrig = '';
    $size = count($arr);
    for($i=0; $size; $i++){
        $line = $arr[$i];
        if( strpos($line, " ") === 0 ){
            //member line
            if( strpos($line, "(") !== false ){
                //method map line
                $parts = explode("->", $line);
                $first = explode(" ", trim($parts[0]));
                $mapped_method = $clzMapped.'.'.trim($parts[1]);
                $return_type = str_replace("void", '',$first[0]);

                $orgin_method = $clzOrig.'.'.$first[count($first)-1].$return_type;
                if( array_key_exists($mapped_method, $map) ){
                    $line = $map[$mapped_method];
                    $map[$mapped_method] = $line.'; '.$orgin_method;
                }
                else{
                    $map[$mapped_method] = $orgin_method;
                }
            }
        }
        else{
            //class line
            $parts = explode("->", $line);
            $line = $parts[1];
            $clzMapped = str_replace(":", '', $line);
            $clzMapped = trim($clzMapped);
            $clzOrig = trim($parts[0]);
        }
    }

    $lines = array();
    foreach($map as $key=>$value){
        $lines[] = $key.'->'.$value;
    }

    file_put_contents($restore_file, join("\r\n", $lines));
}

function restore_stacktrace($stacktrace, $map_file){
    $trace_lines = explode("\n", $stacktrace);
    $methods = array();
    foreach($trace_lines as $line){
        if( strpos($line, "at ") !== false ){
            $line = str_replace('at', '', $line);
            $line = trim($line);
            $parts = explode("(", $line);
            $methods[] = $parts[0];
        }
    }
    $restore_map = array();
    $empty_array = array();
    if( is_file($map_file) ) {
        $map_content = file_get_contents($map_file);
        $map = explode("\n", $map_content);
    }
    else{
        $map = $map_file;
    }
    foreach($map as $line){
        $parts = explode("->", $line);
        $size = count($methods);
        for($i=0; $i<$size; $i++){
            $method = $methods[$i];
            if( strcmp($method, $parts[0]) === 0 ){
                $restore_map[$method] = $parts[1];
                array_splice($methods,$i,1,$empty_array);
                break;
            }
        }
    }

    foreach($restore_map as $key=>$value){
        $stacktrace = str_replace($key, $value, $stacktrace);
    }
    return $stacktrace;
}

function get_crash_position($stack_trace)
{
    $lines = explode("\n", $stack_trace);
    $t_prev_line = "";
    for($i=count($lines)-1; $i>=0; $i--){
        $line = trim($lines[$i]);
        if( strlen($line)>0 && strpos($line, "at ") !== 0 ){
            return $t_prev_line;
        }
        $t_prev_line = $line;
    }

    return $t_prev_line;
}
?>