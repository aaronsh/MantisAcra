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
        $summary = get_crash_summary($stacktrace);
        $line = $summary[0];
        if (preg_match('/([^( ]+).*/', $line, $matches) === 1) {
            $line = $matches[1];
        }
        if (array_key_exists($line, $restore_map)) {
            $line = $restore_map[$line];
        }
        if (strlen($summary[1]) > 0) {
            $line = 'Acra report ' . $summary[1] . ' at ' . $line;
        } else {
            $line = 'Acra report crash ' . $line;
        }
        $line = mysql_real_escape_string($line);
        $query = "UPDATE `$db_table` SET `summary` = '$line' WHERE `id` = $bug_id; ";
        error_log($query);
        db_query_bound($query);
    }
}

function get_bug_summary_by_version($t_version, $stacktrace)
{
    $restore_file = get_restore_file_by_version_name($t_version);
    $restore_map = get_restore_map($restore_file);

    $summary = get_crash_summary($stacktrace);
    $line = $summary[0];
    if (preg_match('/([^( ]+).*/', $line, $matches) === 1) {
        $line = $matches[1];
    }
    if (array_key_exists($line, $restore_map)) {
        $line = $restore_map[$line];
    }
    if (strlen($summary[1]) > 0) {
        $line = 'Acra report ' . $summary[1] . ' at ' . $line;
    } else {
        $line = 'Acra report crash ' . $line;
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
        if (strpos($line, " ") === 0) {
            //member line
            if (strpos($line, "(") !== false) {
                //method map line
                $parts = explode("->", $line);
                $first = explode(" ", trim($parts[0]));
                $mapped_method = $clzMapped . '.' . trim($parts[1]);
                $return_type = str_replace("void", '', $first[0]);

                $orgin_method = $clzOrig . '.' . $first[count($first) - 1] . $return_type;
                if (array_key_exists($mapped_method, $map)) {
                    $line = $map[$mapped_method];
                    $map[$mapped_method] = $line . '; ' . $orgin_method;
                } else {
                    $map[$mapped_method] = $orgin_method;
                }
            }
        } else {
            //class line
            $parts = explode("->", $line);
            $line = $parts[1];
            $clzMapped = str_replace(":", '', $line);
            $clzMapped = trim($clzMapped);
            $clzOrig = trim($parts[0]);
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
    $stacks = get_stack_map($stacktrace);
    $restore_map = get_restore_map($map_file);
    $map = array();
    foreach ($stacks[0] as $line) {
        if (preg_match('/([^( ]+).*/', $line, $matches) === 1) {
            $line = $matches[1];
        }
        if (array_key_exists($line, $restore_map)) {
            $map[$line] = $restore_map[$line];
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
    $empty_stack = true;
    $exception = '';
    foreach (array_reverse($stacktrace) AS $line) {
        if (preg_match('/\s+at\s+(\S+)/', $line, $matches) === 1) {
            $stack[] = $matches[1];
            $empty_stack = false;
        } else if (!$empty_stack) {
            $exception = trim($line);
            break;
        }
    }
    return array($stack, $exception);
}

function get_restore_map($restore_file)
{
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

function get_crash_summary($stack_trace)
{
    $info = get_stack_map($stack_trace);
    $map = $info[0];
    return array($map[count($map) - 1], $info[1]);
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