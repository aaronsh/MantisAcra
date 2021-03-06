<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-31
 * Time: 下午1:30
 */

class BugDataAcraExt {
    public $id;
    public $project_id = null;
    public $issue_id = 0;
    public $report_id = 0;
    public $report_fingerprint;
    public $file_path;
    public $phone_model;
    public $phone_build;
    public $phone_brand;
    public $product_name;
    public $total_mem_size;
    public $available_mem_size;
    public $custom_data;
    public $initial_configuration;
    public $crash_configuration;
    public $display;
    public $user_comment;
    public $dumpsys_meminfo;
    public $dropbox;
    public $eventslog;
    public $radiolog;
    public $is_silent;
    public $device_id;
    public $installation_id;
    public $user_email;
    public $device_features;
    public $environment;
    public $settings_system;
    public $settings_secure;
    public $shared_preferences;
    public $android_version;
    public $app_version;
    public $crash_date;
    public $report_date;
    public $install_date;

    public function create(){
        $t_issue_ext_table = plugin_table("issue");
        # Insert the rest of the data
        $query = "INSERT INTO $t_issue_ext_table
					    ( project_id ,              issue_id,       report_id,   report_fingerprint,
                        file_path,               phone_model,    phone_build, phone_brand,
                        product_name,            total_mem_size, available_mem_size, custom_data,
                        initial_configuration,   crash_configuration, display, user_comment,
                        dumpsys_meminfo,         dropbox,        eventslog,    radiolog,
                        is_silent,               device_id,      installation_id,  user_email,
                        device_features,         environment,    settings_system, settings_secure,
                        shared_preferences,      android_version,app_version,     crash_date,
                        report_date,             install_date
					    )
					  VALUES
					    ( " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . db_param() . ',' . db_param() . ',' . db_param() . ',' . db_param() . ",
					      " . 'now()' . ',' . db_param() . ')';

        $t_display_errors = config_get_global('display_errors');
        $t_on_error_handler = $t_display_errors[E_USER_ERROR];
        $t_display_errors[E_USER_ERROR] = "none";
        config_set_global('display_errors', $t_display_errors);
        $t_result = db_query_bound( $query, Array( $this->project_id, $this->issue_id, $this->report_id, $this->report_fingerprint,
            $this->file_path, $this->phone_model, $this->phone_build, $this->phone_brand,
            $this->product_name, $this->total_mem_size, $this->available_mem_size, $this->custom_data,
            $this->initial_configuration, $this->crash_configuration, $this->display, $this->user_comment,
            $this->dumpsys_meminfo, $this->dropbox, $this->eventslog, $this->radiolog,
            $this->is_silent, $this->device_id, $this->installation_id, $this->user_email,
            $this->device_features, $this->environment, $this->settings_system, $this->settings_secure,
            $this->shared_preferences, $this->android_version, $this->app_version, $this->crash_date.
            $this->report_date, $this->install_date) );
        $t_display_errors[E_USER_ERROR] = $t_on_error_handler;
        config_set_global('display_errors', $t_display_errors);
        if( $t_result === false ){
            return false;
        }
        $this->id = db_insert_id( $t_issue_ext_table );
        return true;
    }
}

function acra_get_bug_ext_by_issue_id($p_issue){
    $t_acra_issue_table = plugin_table("issue");
    $query = "SELECT * FROM $t_acra_issue_table WHERE issue_id = '".$p_issue."' ORDER BY `id` ASC LIMIT 0,1";
    $result = db_query_bound( $query );
    $result = db_fetch_array($result);
    if( $result === false){
        return false;
    }
    $t_AcraBugExt = new BugDataAcraExt;
    $t_AcraBugExt->id = $result['id'];
    $t_AcraBugExt->project_id = $result['project_id'];
    $t_AcraBugExt->issue_id = $result['issue_id'];
    $t_AcraBugExt->report_id = $result['report_id'];
    $t_AcraBugExt->report_fingerprint = $result['report_fingerprint'];
    $t_AcraBugExt->file_path = $result['file_path'];
    $t_AcraBugExt->phone_model = $result['phone_model'];
    $t_AcraBugExt->phone_build = $result['phone_build'];
    $t_AcraBugExt->phone_brand = $result['phone_brand'];
    $t_AcraBugExt->product_name = $result['product_name'];
    $t_AcraBugExt->total_mem_size = $result['total_mem_size'];
    $t_AcraBugExt->available_mem_size = $result['available_mem_size'];
    $t_AcraBugExt->custom_data = $result['custom_data'];
    $t_AcraBugExt->initial_configuration = $result['initial_configuration'];
    $t_AcraBugExt->crash_configuration = $result['crash_configuration'];
    $t_AcraBugExt->display = $result['display'];
    $t_AcraBugExt->user_comment = $result['user_comment'];
    $t_AcraBugExt->dumpsys_meminfo = $result['dumpsys_meminfo'];
    $t_AcraBugExt->dropbox = $result['dropbox'];
    $t_AcraBugExt->eventslog = $result['eventslog'];
    $t_AcraBugExt->radiolog = $result['radiolog'];
    $t_AcraBugExt->is_silent = $result['is_silent'];
    $t_AcraBugExt->device_id = $result['device_id'];
    $t_AcraBugExt->installation_id = $result['installation_id'];
    $t_AcraBugExt->user_email = $result['user_email'];
    $t_AcraBugExt->device_features = $result['device_features'];
    $t_AcraBugExt->environment = $result['environment'];
    $t_AcraBugExt->settings_system = $result['settings_system'];
    $t_AcraBugExt->settings_secure = $result['settings_secure'];
    $t_AcraBugExt->shared_preferences = $result['shared_preferences'];

    return $t_AcraBugExt;
}

/*
 *  It returns the bug id by fingerprint
 *  Returns:
 *      > "0"  The associated bug exits and return value is the bug id of the associated bug
 *      "0"  No associated bug being found and no associated bug is being proceed. The caller should save the bug immediately
 *      "-1"  The associated bug is being proceed. The caller should wait and get the bug id later
 */
function acra_get_bug_id_by_fingerprint($p_fingerprint, $p_app_version){
    $t_acra_issue_table = plugin_table("issue");
    $p_app_version = mysql_real_escape_string($p_app_version);
    //get the associated bug id if it exist
    $query = "SELECT `issue_id`  FROM $t_acra_issue_table WHERE report_fingerprint = '$p_fingerprint'
        AND app_version = '$p_app_version' AND `issue_id` > 0 LIMIT 0, 1";
    $result = db_query_bound( $query );
    if( $result === false ){
        return false;
    }
    $row = db_fetch_array($result);
    if( $row !== false ){
        return $row['issue_id'];
    }

    //check how many url requests are waiting for the proceed of saving bug
    $query = "SELECT count(*)  FROM $t_acra_issue_table WHERE report_fingerprint = '$p_fingerprint'
        AND app_version = '$p_app_version' AND `issue_id` = 0 LIMIT 0, 2";
    $result = db_query_bound( $query );
    $row = db_fetch_array($result);
    if( $row === false ){
        return "-1";
    }
    $count = $row['count(*)'];
    if( $count == '1' ){
        return "0";
    }
    else{
        return "-1";
    }
}


function acra_get_first_issue_id_by_fingerprint($p_fingerprint, $p_bug_id){
    $t_acra_issue_table = plugin_table("issue");
    //get the associated bug id if it exist
    $query = "SELECT `id`  FROM $t_acra_issue_table WHERE `report_fingerprint` = '$p_fingerprint'
        AND `issue_id`=$p_bug_id ORDER BY `id` ASC LIMIT 0, 1";
    $result = db_query_bound( $query );
    if( $result === false ){
        return false;
    }
    $row = db_fetch_array($result);
    if( $row !== false ){
        return $row['id'];
    }
    return '0';
}


function acra_delete_bug_ext_by_bug_id($p_bug_id){
    $t_acra_issue_table = plugin_table("issue");
    $query = "DELETE FROM $t_acra_issue_table WHERE issue_id = '".$p_bug_id."'";
    $result = db_query_bound( $query );
    if( $result === false){
        return false;
    }
    $result = db_result($result);

    return $result;
}

function acra_delete_bug_ext_by_id($p_id){
    $t_acra_issue_table = plugin_table("issue");
    $query = "DELETE FROM $t_acra_issue_table WHERE `id` = '".$p_id."'";
    $result = db_query_bound( $query );
    if( $result === false){
        return false;
    }
    $result = db_result($result);

    return $result;
}


function acra_get_bug_ext_by_id($p_id){
    $t_acra_issue_table = plugin_table("issue");
    $query = "SELECT * FROM $t_acra_issue_table WHERE id = '".$p_id."' LIMIT 0,1";
    $result = db_query_bound( $query );
    if( $result === false){
        return false;
    }
    $result = db_fetch_array($result);
    $t_AcraBugExt = new BugDataAcraExt;
    $t_AcraBugExt->id = $result['id'];
    $t_AcraBugExt->project_id = $result['project_id'];
    $t_AcraBugExt->issue_id = $result['issue_id'];
    $t_AcraBugExt->report_id = $result['report_id'];
    $t_AcraBugExt->report_fingerprint = $result['report_fingerprint'];
    $t_AcraBugExt->file_path = $result['file_path'];
    $t_AcraBugExt->phone_model = $result['phone_model'];
    $t_AcraBugExt->phone_build = $result['phone_build'];
    $t_AcraBugExt->phone_brand = $result['phone_brand'];
    $t_AcraBugExt->product_name = $result['product_name'];
    $t_AcraBugExt->total_mem_size = $result['total_mem_size'];
    $t_AcraBugExt->available_mem_size = $result['available_mem_size'];
    $t_AcraBugExt->custom_data = $result['custom_data'];
    $t_AcraBugExt->initial_configuration = $result['initial_configuration'];
    $t_AcraBugExt->crash_configuration = $result['crash_configuration'];
    $t_AcraBugExt->display = $result['display'];
    $t_AcraBugExt->user_comment = $result['user_comment'];
    $t_AcraBugExt->dumpsys_meminfo = $result['dumpsys_meminfo'];
    $t_AcraBugExt->dropbox = $result['dropbox'];
    $t_AcraBugExt->eventslog = $result['eventslog'];
    $t_AcraBugExt->radiolog = $result['radiolog'];
    $t_AcraBugExt->is_silent = $result['is_silent'];
    $t_AcraBugExt->device_id = $result['device_id'];
    $t_AcraBugExt->installation_id = $result['installation_id'];
    $t_AcraBugExt->user_email = $result['user_email'];
    $t_AcraBugExt->device_features = $result['device_features'];
    $t_AcraBugExt->environment = $result['environment'];
    $t_AcraBugExt->settings_system = $result['settings_system'];
    $t_AcraBugExt->settings_secure = $result['settings_secure'];
    $t_AcraBugExt->shared_preferences = $result['shared_preferences'];

    return $t_AcraBugExt;
}

function acra_get_fingerprint_by_bug_id($p_id){
    $t_acra_issue_table = plugin_table("issue");
    $query = "SELECT `report_fingerprint` FROM $t_acra_issue_table WHERE `issue_id` = '".$p_id."' LIMIT 0, 1";
    $result = db_query_bound( $query );
    if( $result === false){
        return false;
    }
    $result = db_fetch_array($result);
    return $result['report_fingerprint'];
}


function acra_get_issue_id_by_report_id($p_report_id){
    $t_acra_issue_table = plugin_table("issue");
    $p_report_id = mysql_real_escape_string($p_report_id);
    $query = "SELECT `id` FROM $t_acra_issue_table WHERE `report_id` = '".$p_report_id."' LIMIT 0, 1";
    $result = db_query_bound( $query );
    if( $result === false){
        return false;
    }
    $row = db_fetch_array($result);
    if( $row === false ){
        return false;
    }
    return $row['id'];
}

function acra_update_bug_id_by_fingerprint($p_fingerprint, $p_bug_id){
    $t_acra_issue_table = plugin_table("issue");
    $query = "UPDATE `$t_acra_issue_table` SET `issue_id` = '$p_bug_id' WHERE `report_fingerprint` = '$p_fingerprint' AND `issue_id` = 0 ; ";
    db_query_bound( $query );
}