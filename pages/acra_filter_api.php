<?php

if (isset($_REQUEST['data'])) {
    $_SESSION['acra_filter'] = json_decode($_REQUEST['data']);
}

function getFilterValue($filter_name)
{
    if (!isset($_SESSION['acra_filter'])) {
        return '';
    }
    foreach ($_SESSION['acra_filter'] as $item) {
        if (strcmp($item->id, $filter_name) === 0) {
            $val = $item->value;
            if (strcmp($val, "all") === 0) {
                return '';
            }
            return $val;
        }
    }
    return '';
}

function getList($where, $what)
{
    if (strlen($where) > 0) {
        $where = 'WHERE ' . $where;
    }
    $t_acra_issue_table = plugin_table("issue");
    $query = "SELECT `$what` FROM $t_acra_issue_table $where GROUP BY  `$what`";
    $result = db_query_bound($query);
    $list = array();
    while (true) {
        $row = db_fetch_array($result);
        if ($row === false) {
            break;
        }
        $list[] = $row[$what];
    }
    return $list;
}

function outputList($list)
{
    if (count($list) > 1) {
        array_unshift($list, "all");
    }
    return $list;
}

function outputDefaultFilterData()
{
    $android_list = getList("", "android_version");
    $android_list = outputList($android_list);
    $brand_list = getList("", "phone_brand");
    $brand_list = outputList($brand_list);
    $model_list = getList("", "phone_model");
    $model_list = outputList($model_list);

    $android_data = array('id' => "android", 'selected' => 0, 'list' => $android_list);
    $brand_data = array('id' => "brand", 'selected' => 0, 'list' => $brand_list);
    $model_data = array('id' => "model", 'selected' => 0, 'list' => $model_list);

    $out = array($android_data, $brand_data, $model_data);
    echo json_encode($out);
}