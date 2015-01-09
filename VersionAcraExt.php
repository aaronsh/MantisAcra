<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-31
 * Time: 下午1:30
 */

function create_map_file_folder($Folder)
{
    if (!is_readable($Folder)) {
        create_map_file_folder(dirname($Folder));
        if (!is_file($Folder)) {
            mkdir($Folder, 0777);
        }
    }
}

function update_bug_summary_by_version($t_version, $map_file)
{
    $db_table = db_get_table('mantis_bug_table');
    $query = "SELECT `id`, `summary` FROM $db_table WHERE `version` = '" . mysql_real_escape_string($t_version) . "'";
    $result = db_query_bound($query);
    $rows = array();
    while (true) {
        $row = db_fetch_array($result);
        if ($row == false) {
            break;
        }
        $rows[] = $row;
    }

    $restore_map = get_restore_map($map_file);
    foreach ($rows as $row) {
        $bug_id = $row['id'];
        $stacktrace = bug_get_text_field($bug_id, 'description');

        $info = get_stack_map($stacktrace);
        $exception = $info->exception;
        $method = "";
        $suffix = "";
        $size = count($info->stack);
        if( $size > 0 ){
            $method = $info->stack[0]->method;
            $suffix = $info->stack[0]->suffix;
        }

        if (array_key_exists($method, $restore_map)) {
            $method = $restore_map[$method];
        }
        if (strlen($exception) > 0) {
            $line = 'Acra report ' . $exception . ' at ' . $method.$suffix;
        } else {
            $line = 'Acra report crash ' . $method.$suffix;
        }

        $line = mysql_real_escape_string($line);
        $query = "UPDATE `$db_table` SET `summary` = '$line' WHERE `id` = $bug_id; ";
        db_query_bound($query);
    }
}

function get_bug_summary_by_version($t_version, $stacktrace)
{
    $restore_file = get_restore_file_by_version_name($t_version);
    $restore_map = get_restore_map($restore_file);

    $info = get_stack_map($stacktrace);
    $exception = $info->exception;
    $method = "";
    $suffix = "";
    $size = count($info->stack);
    if( $size > 0 ){
        $method = $info->stack[0]->method;
        $suffix = $info->stack[0]->suffix;
    }

    if (array_key_exists($method, $restore_map)) {
        $method = $restore_map[$method];
    }
    if (strlen($exception) > 0) {
        $line = 'Acra report ' . $exception . ' at ' . $method.$suffix;
    } else {
        $line = 'Acra report crash ' . $method.$suffix;
    }

    return $line;
}

function handle_mapping_file($map_file, $restore_file)
{
    $content = file_get_contents($map_file);

    $arr = explode("\n", $content);
    $map = array();
    $clzMapped = '';
    $clzOrig = '';
    foreach ($arr as $line) {
        $parts = explode("->", $line);
        if( count($parts) === 2 ) {
            //valid line
            if (strpos($parts[0], " ") === 0) {
                //class member, may method or field
                if (preg_match("/([^: ]+)\\s+([^( ]+)(\\(\\S*\))/", $parts[0], $matches) === 1) {
                    $mapped_method = $clzMapped.'.'.trim($parts[1]);
                    $origin_method = $clzOrig . '.' . $matches[2] . trim($matches[3]) . $matches[1];
                    if (array_key_exists($mapped_method, $map)) {
                        $line = $map[$mapped_method];
                        $map[$mapped_method] = $line . '; ' . $origin_method;
                    } else {
                        $map[$mapped_method] = $origin_method;
                    }
                }
            } else {
                //class name
                $clzMapped = str_replace(":", '', $parts[1]);
                $clzMapped = trim($clzMapped);
                $clzOrig = trim($parts[0]);
            }
        }
    }


    $lines = array();
    foreach ($map as $key => $value) {
        $lines[] = $key . '->' . $value;
    }

    file_put_contents($restore_file, join("\r\n", $lines));
}

function restore_stacktrace($stacktrace, $map_file)
{
    $stack_info = get_stack_map($stacktrace);
    $stack = $stack_info->stack;
    $restore_map = get_restore_map($map_file);
    $map = array();
    foreach ($stack as $info) {
        if (array_key_exists($info->method, $restore_map)) {
            $map[$info->method] = $restore_map[$info->method];
        }
    }

    foreach ($map as $key => $value) {
        $stacktrace = str_replace($key, $value, $stacktrace);
    }
    return $stacktrace;
}

function get_stack_map($stacktrace)
{
    if (is_string($stacktrace)) {
        $stacktrace = explode("\n", $stacktrace);
    }
    $stack = array();
    $exception = '';
    foreach ($stacktrace as $line) {
        if (preg_match('/\s+at\s+([^(]+)(\S*)/', $line, $matches) === 1) {
            $entry = new StdClass;
            $entry->method = $matches[1];
            $entry->suffix = $matches[2];
            $stack[] = $entry;
        }
        else{
            if( preg_match('/\S+Exception.*/', $line, $matches) === 1 ){
                $exception = trim($line);
                $stack = array();
            }
        }
    }
    $decoded = new StdClass;
    $decoded->exception = $exception;
    $decoded->stack = $stack;
    return $decoded;
}

function get_restore_map($restore_file)
{
    if(!file_exists($restore_file))
    {
    	return array();
    }
    $map_content = file_get_contents($restore_file);
    $lines = explode("\n", $map_content);
    $map = array();
    foreach ($lines as $line) {
        $parts = explode("->", $line);
        if (count($parts) === 2) {
            $map[$parts[0]] = $parts[1];
        }
    }
    return $map;
}


function get_restore_file_by_version_name($version){
    $ver_id = version_get_id($version);
    if( $ver_id === false ){
        return false;
    }

    $t_acra_ver_table = plugin_table("version");
    $query = "SELECT * FROM $t_acra_ver_table WHERE `version_id` = ".$ver_id;
    $result = db_query_bound( $query );
    $row = db_fetch_array($result);
    if($row === false ){
        return false;
    }
    return $row['map_file'];
}

?>