<?php

require('acra_filter_api.php');

if (isset($_REQUEST['data'])) {
    set_acra_filter( json_decode($_REQUEST['data']) );
}

if( isset($_REQUEST['sender']) ){
    $android_list = array('');
    $brand_list = array('');
    $model_list = array('');

    $condition = '';
    $android = getFilterValue("android");
    $brand = getFilterValue("brand");
    $model = getFilterValue("model");

    switch($_REQUEST['sender']){
        case 'android':
            if( strlen($android) === 0 ){
                //user select all, the filter does not change
                if( strlen($brand) == 0 ){
                    $android_list = getList("", "android_version");
                    $android_list = outputList($android_list);
                    $brand_list = getList("", "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList("", "phone_model");
                    $model_list = outputList($model_list);
                }
                else{
                    $sql = "`phone_brand`='".mysql_real_escape_string($brand)."'";
                    $android_list = getList($sql, "android_version");
                    $android_list = outputList($android_list);
                    $brand_list = getList("", "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList($sql, "phone_model");
                    $model_list = outputList($model_list);
                }
            }
            else{
                if( strlen($brand) == 0 ){
                    $sql = "`android_version`='".mysql_real_escape_string($android)."'";
                    $android_list = getList("", "android_version");
                    $android_list = outputList($android_list);
                    $brand_list = getList($sql, "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList($sql, "phone_model");
                    $model_list = outputList($model_list);
                }
                else{
                    $sql = "`phone_brand`='".mysql_real_escape_string($brand)."'";
                    $android_list = getList($sql, "android_version");
                    $android_list = outputList($android_list);
                    $brand_list = getList("", "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList($sql, "phone_model");
                    $model_list = outputList($model_list);
                }
            }
            break;
        case 'brand':
            if( strlen($brand) > 0 ){
                $sql = "`phone_brand`='".mysql_real_escape_string($brand)."'";
                $android_list = getList("", "android_version");
                $android_list = outputList($android_list);
                $brand_list = getList("", "phone_brand");
                $brand_list = outputList($brand_list);
                $model_list = getList($sql, "phone_model");
                $model_list = outputList($model_list);
            }
            else{
                if( strlen($android) > 0 ){
                    $android_list = getList("", "android_version");
                    $android_list = outputList($android_list);
                    $sql = "`android_version`='".mysql_real_escape_string($android)."'";
                    $brand_list = getList($sql, "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList($sql, "phone_model");
                    $model_list = outputList($model_list);
                }
                else{
                    $android_list = getList("", "android_version");
                    $android_list = outputList($android_list);
                    $brand_list = getList("", "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList("", "phone_model");
                    $model_list = outputList($model_list);
                }
            }
            break;
        case 'model':
            if( strlen($model) > 0 ){
                $sql = "`phone_model`='".mysql_real_escape_string($model)."'";
                $brand_list = getList($sql, "phone_brand");

                $android_list = getList($sql, "android_version");
                $android_list = outputList($android_list);

                $sql = "`phone_brand` IN (";
                $divider = '';
                foreach($brand_list as $item){
                    $sql = $sql.$divider."'".mysql_real_escape_string($item)."'";
                    $divider = ',';
                }
                $sql = $sql.")";

                $model_list = getList($sql, "phone_model");
                $model_list = outputList($model_list);

                $brand_list = outputList($brand_list);
            }
            else{
                if( strlen($brand) > 0 ){
                    $sql = "`phone_brand`='".mysql_real_escape_string($brand)."'";
                    $android_list = getList("", "android_version");
                    $android_list = outputList($android_list);
                    $brand_list = getList("", "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList($sql, "phone_model");
                    $model_list = outputList($model_list);
                }
                else if( strlen($android) > 0 ){
                    $android_list = getList("", "android_version");
                    $android_list = outputList($android_list);
                    $sql = "`android_version`='".mysql_real_escape_string($android)."'";
                    $brand_list = getList($sql, "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList($sql, "phone_model");
                    $model_list = outputList($model_list);
                }
                else{
                    $android_list = getList("", "android_version");
                    $android_list = outputList($android_list);
                    $brand_list = getList("", "phone_brand");
                    $brand_list = outputList($brand_list);
                    $model_list = getList("", "phone_model");
                    $model_list = outputList($model_list);
                }
            }
            break;
        default:
            $android_list = getList("", "android_version");
            $android_list = outputList($android_list);
            $brand_list = getList("", "phone_brand");
            $brand_list = outputList($brand_list);
            $model_list = getList("", "phone_model");
            $model_list = outputList($model_list);
            $android = "";
            $brand = "";
            $model = "";
            break;
    }


    $android_data = array('id'=>"android", 'selected'=>getSelectedIndex($android, $android_list), 'list'=>$android_list);
    $brand_data = array('id'=>"brand", 'selected'=>getSelectedIndex($brand, $brand_list), 'list'=>$brand_list);
    $model_data = array('id'=>"model", 'selected'=>getSelectedIndex($model, $model_list), 'list'=>$model_list);

    $out = array($android_data, $brand_data, $model_data);
    echo json_encode($out);
}
