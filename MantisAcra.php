<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-30
 * Time: 上午11:30
 */
require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

require('BugDataAcraExt.php');

class MantisAcraPlugin extends MantisPlugin {

    /**
     *  A method that populates the plugin information and minimum requirements.
     */
    function register( ) {
        $this->name = plugin_lang_get( 'title' );
        $this->description = plugin_lang_get( 'description' );
        $this->page = '';
        $this->version = '2.0';
        $this->requires = array(
            'MantisCore' => '1.2.0',
            'jQuery' => '1.8.2'
        );

        $this->author = 'Sam';
        $this->contact = 'rib.liu@qq.com';
        $this->url = 'http://www.mantisbt.org';
    }

    /**
     * Default plugin configuration.
     */
    function hooks( ) {
        $hooks = array(
            'EVENT_CORE_READY' => "on_core_ready",
            'EVENT_MANAGE_PROJECT_UPDATE_FORM' => "show_project_acra_option",
            'EVENT_MANAGE_PROJECT_CREATE_FORM' => 'show_project_acra_option',
            'EVENT_MANAGE_PROJECT_UPDATE' => 'post_project_update',
            'EVENT_MANAGE_PROJECT_CREATE' => 'post_project_update',
            'EVENT_LAYOUT_BODY_END' => "attach_javascript",
            'EVENT_UPDATE_BUG' => 'update_bug',
            'EVENT_BUG_DELETED' => "delete_bug",
            'EVENT_DISPLAY_BUG_ID' => 'show_bug_id'
        );
        return $hooks;
    }



    function schema()
    {
        $schema = array();
        $schema[] = array("CreateTableSQL", array(plugin_table("project"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  project_id 		 I  NOTNULL DEFAULT '0',
  package_name      C(128) NOTNULL DEFAULT \" '' \"
",Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));

        $schema[] = array("CreateTableSQL", array(plugin_table("version"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  version_id 		 I  NOTNULL DEFAULT '0',
  map_file      C(128) NOTNULL DEFAULT \" '' \"
",Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));

        $schema[] = array("CreateTableSQL", array(plugin_table("issue"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  project_id 	  I  NOTNULL DEFAULT '0',
  issue_id      I NOTNULL DEFAULT '0',
  report_id     C(36) NOTNULL DEFAULT \" '' \",
  report_fingerprint    X NOTNULL DEFAULT \" '' \",
  file_path     X NOTNULL DEFAULT \" '' \",
  android_version     C(16) NOTNULL DEFAULT \" '' \",
  app_version     C(16) NOTNULL DEFAULT \" '' \",
  phone_model   X NOTNULL DEFAULT \" '' \",
  phone_build   X NOTNULL DEFAULT \" '' \",
  phone_brand   X NOTNULL DEFAULT \" '' \",
  product_name  X NOTNULL DEFAULT \" '' \",
  total_mem_size    I,
  available_mem_size I,
  custom_data   X NOTNULL DEFAULT \" '' \",
  initial_configuration X NOTNULL DEFAULT \" '' \",
  crash_configuration   X NOTNULL DEFAULT \" '' \",
  display       X NOTNULL DEFAULT \" '' \",
  user_comment  X NOTNULL DEFAULT \" '' \",
  dumpsys_meminfo       X NOTNULL DEFAULT \" '' \",
  dropbox       X NOTNULL DEFAULT \" '' \",
  eventslog     X NOTNULL DEFAULT \" '' \",
  radiolog      X NOTNULL DEFAULT \" '' \",
  is_silent     X NOTNULL DEFAULT \" '' \",
  device_id     C(36) NOTNULL DEFAULT \" '' \",
  installation_id   C(36) NOTNULL DEFAULT \" '' \",
  user_email        X NOTNULL DEFAULT \" '' \",
  device_features   X NOTNULL DEFAULT \" '' \",
  environment       X NOTNULL DEFAULT \" '' \",
  settings_system   X NOTNULL DEFAULT \" '' \",
  settings_secure   X NOTNULL DEFAULT \" '' \",
  shared_preferences    X NOTNULL DEFAULT \" '' \",
  crash_date    T,
  report_date    T,
  install_date   T
",Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));

        return $schema;
    }

    function install() {
        $result = true;
        return $result;
    }

    function decrypt($str, $key)
    {
        $str = mcrypt_decrypt(MCRYPT_DES, $key, $str, MCRYPT_MODE_ECB);
        $block = mcrypt_get_block_size('des', 'ecb');
        $pad = ord($str[($len = strlen($str)) - 1]);
        return substr($str, 0, strlen($str) - $pad);

    }
    function on_core_ready(){
        if( isset($_GET['acra_page']) ){
            $t_php_file = "pages/".$_GET['acra_page'];
            require($t_php_file);
            exit;
        }
        if( isset($_SESSION["acra_ext"]) && $_SESSION["acra_ext"] && isset($_GET['acra_page']) ){

            switch($_GET['acra_page']){
                case 'check.php':
                    require("pages/check.php");
                    break;
                case 'brief.php':
                    require("pages/brief.php");
                    break;
                case 'detail.php':
                    require("pages/detail.php");
                    break;
            }
            exit;
        }
        if( isset($_POST['data']) ){
            $data = $_POST['data'];
            $ts = substr($data, 0, 16);
            $data = substr($data, 16);
            $data = trim($data);
            $key = md5($ts);
            $key = substr($key, 0, 8);

            $des = hex2bin($data);

            $cipher = MCRYPT_DES; //密码类型
            $modes = MCRYPT_MODE_ECB; //密码模式
            $iv = mcrypt_create_iv(mcrypt_get_iv_size($cipher, $modes), MCRYPT_RAND);//初始化向量
            $str_decrypt = mcrypt_decrypt($cipher, $key, $des, $modes, $iv); //解密函数
            $str_decrypt = trim($str_decrypt);
            //echo $str_decrypt;

            $data = json_decode($str_decrypt, true);
            //var_dump($data);
            if ($data != null) {
                $_GET['acra'] = true;
                $keys = array_keys($data);
                foreach( $keys as $key ) {
                    $_GET[$key] = $data[$key];
                }
            }
            //var_dump($_GET);
        }
        if( isset($_GET['acra']) && $_GET['acra'] == 'true' ){
            $pkg = gpc_get_string('PACKAGE_NAME');

            $t_acra_prj_table = plugin_table("project");
            $query = "SELECT * FROM $t_acra_prj_table WHERE package_name = '".$pkg."'";
            $result = db_query_bound( $query );
            $result = db_fetch_array($result);
            if( $result === false){
                return;
            }
            $prj_id = $result['project_id'];

            $this->save_acra_issue($prj_id);
            exit;
        }
    }

    function show_project_acra_option($p_param1, $p_param2){

        if( isset($p_param2) ){
            $t_acra_prj_table = plugin_table("project");

            $query = "SELECT * FROM $t_acra_prj_table WHERE project_id = ".$p_param2 ;
            $result = db_query_bound( $query );
            $result = db_fetch_array($result);

            $t_package_name = "";
            if( $result !== false && is_array($result) ){
                $t_package_name = $result['package_name'];
            }
        }
        ?>
        <tr <?php echo helper_alternate_class() ?>>
            <td class="category" >
                Acra Option
            </td>
            <td>
                <span><input type="checkbox" name="acra_project" <?php if( strlen($t_package_name) > 0 ){ echo 'checked="checked"'; } ?> >Is Acra Project</span>&nbsp;
                <span style="padding-left: 30px;">Package:<input type="text" name="acra_package" size="60" maxlength="128" value="<?php echo $t_package_name; ?>"></span>
            </td>
        </tr>
    <?php
    }

    function post_project_update($p_param1, $p_param2){
        error_log("post_project_update ".$p_param2);
        $t_acra_prj 	= gpc_get_bool( 'acra_project' );
        $t_package 		= gpc_get_string( 'acra_package' );

        $t_acra_prj_table = plugin_table("project");
        if( $t_acra_prj ){
            if(strlen($t_package) > 0 ){
                $query = "SELECT * FROM $t_acra_prj_table WHERE project_id = ".$p_param2 ;
                $result = db_query_bound( $query );
                if( db_num_rows( $result ) > 0 ){
                    $t_query = "UPDATE $t_acra_prj_table SET `package_name` = '$t_package' WHERE `project_id` = $p_param2;";

                }
                else{
                    $t_query = "INSERT INTO $t_acra_prj_table ( package_name, project_id) VALUES ('$t_package', $p_param2 )";
                }
            }
            else{
                return;
            }
        }
        else{
            $t_query = "DELETE FROM $t_acra_prj_table WHERE `project_id` = $p_param2";
        }
        db_query_bound($t_query);
    }

    function attach_javascript(){
        $_SESSION["acra_ext"] = true;
        if( isset($_GET['acra_page']) ){
            switch($_GET['acra_page']){
                case 'test.php':
                    //require("pages/test.php");
                    $this->show_acra_view_issue_plugin();
                    return;
            }
        }
        if( $this->show_acra_befrief_btn() ){
            $this->show_acra_brief_buttons_plugin();
            return;
        }
        if( $this->show_acra_detail_buttons_plugin() ){
            return;
        }
        ?>
    <?php
    }

    function show_acra_brief_buttons_plugin(){
        ?>
        <script type="text/javascript" src="<?php echo plugin_file("fancyBox/fancybox.js"); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("fancyBox/fancybox.css"); ?>" media="screen" />
        <style type="text/css">
            .acra_popup{
                width:800px;
                height:400px;
                display: none;
                padding: 0px;
            }
            .acra_frame{
                width:100%;
                height:100%;
            }
        </style>

        <script>
            var bugs = jQuery('table tbody td a .bug_id');
            var ids = [];
            for(var i=0; i<bugs.length; i++ ){
                ids.push(bugs[i].innerText);
            }
            console.log(ids);
            jQuery.ajax({
                type: "post",
                url: "index.php?acra_page=check.php",
                dataType: "text",
                data:'data='+JSON.stringify(ids),
                success: function (data) {
                    try{
                        data = JSON.parse(data);

                        for(var i=0; i<data.length; i++){
                            if( data[i].id == ids[i] ){
                                jQuery( bugs[i].parentElement.parentElement ).append(data[i].txt);
                                jQuery('#acra_dialog').append(data[i].popup);
                            }
                            jQuery('.fancybox').fancybox();
                        }
                    } catch( ex ){
                        console.log(ex);
                    }
                    console.log(data);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        </script>
        <div id="acra_dialog" style="display:none;">

        </div>
    <?php
    }

    function show_acra_detail_buttons_plugin(){
        ?>
        <script type="text/javascript" src="<?php echo plugin_file("fancyBox/fancybox.js"); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("fancyBox/fancybox.css"); ?>" media="screen" />
        <style type="text/css">
            .acra_popup{
                width:1200px;
                height:400px;
                display: none;
                padding: 0px;
            }
            .acra_frame{
                width:100%;
                height:100%;
            }
            .fancybox{
                font-weight: normal;
            }
        </style>

        <script>
            var cells = jQuery("td");
            var reg = new RegExp(/^\s*ID\s*$/);
            var idCell = null;
            for(var i=0; i<cells.length; i++){
                var str = cells[i].innerText;
                if( reg.test(str) ){
                    idCell = cells[i];
                    break;
                }
            }
            if( idCell != null ){
                var shorts = idCell.parentElement.previousElementSibling.firstElementChild;
                var id = idCell.parentElement.nextElementSibling.firstElementChild.innerText
                var ids=[];
                ids.push(id);
                jQuery.ajax({
                    type: "post",
                    url: "index.php?acra_page=check.php",
                    dataType: "text",
                    data:'data='+JSON.stringify(ids),
                    success: function (data) {
                        try{
                            data = JSON.parse(data);

                            for(var i=0; i<data.length; i++){
                                if( data[i].id == ids[i] ){
                                    var matches = data[i].txt.match(/<a[^>]+/);
                                    if( matches != null ){
                                        jQuery(shorts).append('<span class="bracket-link">[&nbsp;'+matches[0]+'>View ACRA more info</a>&nbsp;]</span>');
                                        var frm = data[i].popup;
                                        frm = frm.replace('brief.php', 'detail.php');
                                        jQuery('#acra_dialog').append(frm);
                                    }
                                }
                                jQuery('.fancybox').fancybox();
                            }
                        } catch( ex ){
                            console.log(ex);
                        }
                        console.log(data);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        </script>
        <div id="acra_dialog" style="display:none;">

        </div>
    <?php
    }

    function save_acra_issue($p_project_id){
        require( 'ProfileAcraExt.php' );
        $t_user_id = $this->get_user_id();
        $t_project_id = $p_project_id;
        $t_project_name = project_get_name($p_project_id);
        $t_fingerprint = $this->build_acra_issue_id(gpc_get_string( 'STACK_TRACE' ), gpc_get_string('PACKAGE_NAME'));
        $t_app_version = gpc_get_string( 'APP_VERSION_NAME', '' );
        $t_duplicated_bug_id = acra_get_bug_id_by_fingerprint($t_fingerprint, $t_app_version);
        if( $t_duplicated_bug_id === false ){
            //new crash report, save a bug record
            $t_duplicated_bug_id = $this->save_bug($t_project_id, $t_user_id);
            //create version if possible
            $t_version_id = version_get_id($t_app_version, $t_project_id);
            if( $t_version_id === false ){
                version_add($t_project_id, $t_app_version, VERSION_RELEASED);
                event_signal( 'EVENT_MANAGE_VERSION_CREATE', array( $t_version_id ) );
            }
        }

        //save acra issue extionsion
        $acra_ext = new BugDataAcraExt;
        $acra_ext->project_id = $t_project_id;
        $acra_ext->issue_id = $t_duplicated_bug_id;
        $acra_ext->report_id = gpc_get_string( 'REPORT_ID', '' );
        $acra_ext->report_fingerprint = $t_fingerprint;
        $acra_ext->file_path = gpc_get_string( 'FILE_PATH', '' );
        $acra_ext->phone_model = gpc_get_string( 'PHONE_MODEL', '' );
        $acra_ext->phone_build = gpc_get_string( 'BUILD', '' );
        $acra_ext->phone_brand = gpc_get_string( 'BRAND', '' );
        $acra_ext->product_name = gpc_get_string( 'PRODUCT', '' );
        $acra_ext->total_mem_size = gpc_get_string( 'TOTAL_MEM_SIZE', '' );
        $acra_ext->available_mem_size = gpc_get_string( 'AVAILABLE_MEM_SIZE', '' );
        $acra_ext->custom_data = gpc_get_string( 'CUSTOM_DATA', '' );
        $acra_ext->initial_configuration = gpc_get_string( 'INITIAL_CONFIGURATION', '' );
        $acra_ext->crash_configuration = gpc_get_string( 'CRASH_CONFIGURATION', '' );
        $acra_ext->display = gpc_get_string( 'DISPLAY', '' );
        $acra_ext->user_comment = gpc_get_string( 'USER_COMMENT', '' );
        $acra_ext->dumpsys_meminfo = gpc_get_string( 'DUMPSYS_MEMINFO', '' );
        $acra_ext->dropbox = gpc_get_string( 'DROPBOX', '' ); //NOT EXITS, need check with acra, later
        $acra_ext->eventslog = gpc_get_string( 'EVENTSLOG', '' ); //NOT EXITS, need check with acra, later
        $acra_ext->radiolog = gpc_get_string( 'RADIOLOG', '' ); //NOT EXITS, need check with acra, later
        $acra_ext->is_silent = gpc_get_string( 'IS_SILENT', '' );
        $acra_ext->device_id = gpc_get_string( 'INSTALLATION_ID', '' );//NOT EXITS, need check with acra, later
        $acra_ext->installation_id = gpc_get_string( 'INSTALLATION_ID', '' );
        $acra_ext->user_email = gpc_get_string( 'USER_EMAIL', '' );
        $acra_ext->device_features = gpc_get_string( 'DEVICE_FEATURES', '' );
        $acra_ext->environment = gpc_get_string( 'ENVIRONMENT', '' );
        $acra_ext->settings_system = gpc_get_string( 'SETTINGS_SYSTEM', '' );
        $acra_ext->settings_secure = gpc_get_string( 'SETTINGS_SECURE', '' );
        $acra_ext->shared_preferences = gpc_get_string( 'SHARED_PREFERENCES', '' );
        $acra_ext->android_version = gpc_get_string( 'ANDROID_VERSION', '' );
        $acra_ext->app_version = $t_app_version;
        $acra_ext->crash_date = $this->covertTimeString(gpc_get_string('USER_CRASH_DATE', ''));
        $acra_ext->install_date = $this->covertTimeString(gpc_get_string('USER_APP_START_DATE', ''));
        $acra_ext->create();

    }

    function save_bug($p_project_id, $p_user_id){

        $t_project_id = $p_project_id;
        $t_project_name = project_get_name($p_project_id);

        global $g_cache_current_user_id;
        $g_cache_current_user_id = $p_user_id;

        $t_bug_data = new BugData;
        $t_bug_data->project_id             = $t_project_id;
        $t_bug_data->reporter_id            = $p_user_id;
        $t_bug_data->build                  = gpc_get_string( 'APP_VERSION_CODE', '' );
        $t_bug_data->platform               = "Android";
        $t_bug_data->os                     =  gpc_get_string( 'ANDROID_VERSION', '' );//gpc_get_string( 'os', '' );
        $t_os_build = gpc_get_string( 'BUILD', '' );
        if(  preg_match ( '/DISPLAY\s*=\s*(.*)/', $t_os_build, $t_match) ){
            var_dump($t_match);
            $t_os_build = $t_match[1];
        }
        else{
            $t_os_build = gpc_get_string( 'ANDROID_VERSION', '' );
        }
        $t_bug_data->os_build               = $t_os_build;//gpc_get_string( 'os_build', '' );
        $t_bug_data->version                = gpc_get_string( 'APP_VERSION_NAME', '' );
        $t_bug_data->profile_id             = profile_create_unique( ALL_USERS, $t_bug_data->platform, $t_bug_data->os, $t_bug_data->os_build, "" );
        $t_bug_data->handler_id             = gpc_get_int( 'handler_id', 0 );
        $t_bug_data->view_state             = gpc_get_int( 'view_state', config_get( 'default_bug_view_status', 'VS_PRIVATE', 'acra_reporter' ) );
        $t_bug_data->category_id            = $this->get_category_id($p_project_id);//gpc_get_int( 'category_id', 0 );
        $t_bug_data->reproducibility        = 10;//gpc_get_int( 'reproducibility', config_get( 'default_bug_reproducibility' ) );
        $t_bug_data->severity               = CRASH;//gpc_get_int( 'severity', config_get( 'default_bug_severity' ) );
        $t_bug_data->priority               = HIGH;//gpc_get_int( 'priority', config_get( 'default_bug_priority' ) );
        $t_bug_data->projection             = gpc_get_int( 'projection', config_get( 'default_bug_projection' ) );
        $t_bug_data->eta                    = gpc_get_int( 'eta', config_get( 'default_bug_eta' ) );
        $t_bug_data->resolution             = OPEN;//gpc_get_string('resolution', config_get( 'default_bug_resolution' ) );
        $t_bug_data->status                 = NEW_;//gpc_get_string( 'status', config_get( 'bug_submit_status' ) );
        $t_bug_data->description            = gpc_get_string( 'STACK_TRACE' );//gpc_get_string( 'description' );
        $t_bug_data->summary                = "Acra report crash  ".$this->get_crash_position($t_bug_data->description);
        $t_bug_data->steps_to_reproduce     = gpc_get_string( 'LOGCAT', "" );
        $t_bug_data->additional_information = gpc_get_string( 'CRASH_CONFIGURATION', "" );
        $t_bug_data->due_date               = gpc_get_string( 'USER_CRASH_DATE', '');
        if ( is_blank ( $t_bug_data->due_date ) ) {
            $t_bug_data->due_date = date_get_null();
        }


        $f_files                            = gpc_get_file( 'ufile', null ); /** @todo (thraxisp) Note that this always returns a structure */
        $f_report_stay                      = gpc_get_bool( 'report_stay', false );
        $f_copy_notes_from_parent           = gpc_get_bool( 'copy_notes_from_parent', false);


        helper_call_custom_function( 'issue_create_validate', array( $t_bug_data ) );

        # Validate the custom fields before adding the bug.
        $t_related_custom_field_ids = custom_field_get_linked_ids( $t_bug_data->project_id );
        foreach( $t_related_custom_field_ids as $t_id ) {
            $t_def = custom_field_get_definition( $t_id );

            # Produce an error if the field is required but wasn't posted
            if ( !gpc_isset_custom_field( $t_id, $t_def['type'] ) &&
                ( $t_def['require_report'] ) ) {
                error_parameters( lang_get_defaulted( custom_field_get_field( $t_id, 'name' ) ) );
                trigger_error( ERROR_EMPTY_FIELD, ERROR );
            }

            if ( !custom_field_validate( $t_id, gpc_get_custom_field( "custom_field_$t_id", $t_def['type'], NULL ) ) ) {
                error_parameters( lang_get_defaulted( custom_field_get_field( $t_id, 'name' ) ) );
                trigger_error( ERROR_CUSTOM_FIELD_INVALID_VALUE, ERROR );
            }
        }

        # Allow plugins to pre-process bug data
        $t_bug_data = event_signal( 'EVENT_REPORT_BUG_DATA', $t_bug_data );

        # Ensure that resolved bugs have a handler
        if ( $t_bug_data->handler_id == NO_USER && $t_bug_data->status >= config_get( 'bug_resolved_status_threshold' ) ) {
            $t_bug_data->handler_id = $this->get_user_id();
        }

        # Create the bug
        $t_bug_id = $t_bug_data->create();

        # Mark the added issue as visited so that it appears on the last visited list.
        last_visited_issue( $t_bug_id );

        # Handle the file upload
        if( $f_files != null ) {
            $t_files = helper_array_transpose($f_files);
            if( $t_files != null ) {
                foreach ($t_files as $t_file) {
                    if (!empty($t_file['name'])) {
                        file_add($t_bug_id, $t_file, 'bug');
                    }
                }
            }
        }

        # Handle custom field submission
        foreach( $t_related_custom_field_ids as $t_id ) {
            # Do not set custom field value if user has no write access
            if( !custom_field_has_write_access( $t_id, $t_bug_id ) ) {
                continue;
            }

            $t_def = custom_field_get_definition( $t_id );
            if( !custom_field_set_value( $t_id, $t_bug_id, gpc_get_custom_field( "custom_field_$t_id", $t_def['type'], $t_def['default_value'] ), false ) ) {
                error_parameters( lang_get_defaulted( custom_field_get_field( $t_id, 'name' ) ) );
                trigger_error( ERROR_CUSTOM_FIELD_INVALID_VALUE, ERROR );
            }
        }

        $f_master_bug_id = gpc_get_int( 'm_id', 0 );
        $f_rel_type = gpc_get_int( 'rel_type', -1 );

        if ( $f_master_bug_id > 0 ) {
            # it's a child generation... let's create the relationship and add some lines in the history

            # update master bug last updated
            bug_update_date( $f_master_bug_id );

            # Add log line to record the cloning action
            history_log_event_special( $t_bug_id, BUG_CREATED_FROM, '', $f_master_bug_id );
            history_log_event_special( $f_master_bug_id, BUG_CLONED_TO, '', $t_bug_id );

            if ( $f_rel_type >= 0 ) {
                # Add the relationship
                relationship_add( $t_bug_id, $f_master_bug_id, $f_rel_type );

                # Add log line to the history (both issues)
                history_log_event_special( $f_master_bug_id, BUG_ADD_RELATIONSHIP, relationship_get_complementary_type( $f_rel_type ), $t_bug_id );
                history_log_event_special( $t_bug_id, BUG_ADD_RELATIONSHIP, $f_rel_type, $f_master_bug_id );

                # update relationship target bug last updated
                bug_update_date( $t_bug_id );

                # Send the email notification
                email_relationship_added( $f_master_bug_id, $t_bug_id, relationship_get_complementary_type( $f_rel_type ) );
            }

            # copy notes from parent
            if ( $f_copy_notes_from_parent ) {

                $t_parent_bugnotes = bugnote_get_all_bugnotes( $f_master_bug_id );

                foreach ( $t_parent_bugnotes as $t_parent_bugnote ) {

                    $t_private = $t_parent_bugnote->view_state == VS_PRIVATE;

                    bugnote_add( $t_bug_id, $t_parent_bugnote->note, $t_parent_bugnote->time_tracking,
                        $t_private, $t_parent_bugnote->note_type, $t_parent_bugnote->note_attr,
                        $t_parent_bugnote->reporter_id, /* send_email */ FALSE , /* log history */ FALSE);
                }
            }

        }

        helper_call_custom_function( 'issue_create_notify', array( $t_bug_id ) );

        # Allow plugins to post-process bug data with the new bug ID
        event_signal( 'EVENT_REPORT_BUG', array( $t_bug_data, $t_bug_id ) );

        email_new_bug( $t_bug_id );

        // log status and resolution changes if they differ from the default
        if ( $t_bug_data->status != config_get('bug_submit_status') )
            history_log_event($t_bug_id, 'status', config_get('bug_submit_status') );

        if ( $t_bug_data->resolution != config_get('default_bug_resolution') )
            history_log_event($t_bug_id, 'resolution', config_get('default_bug_resolution') );

        return $t_bug_id;
    }

    function covertTimeString($s){
        $result = "";
        $parts = explode('T', $s);
        $result = $parts[0].' ';
        $parts = explode('.', $parts[1]);
        $result = $result.$parts[0];
        return $result;
    }

    function build_acra_issue_id($stack_trace, $package)
    {
/*
        $lines = explode("\n", $stack_trace);
        $value = "";
        foreach ($lines as $id => $line) {
            if (strpos($line, $package) !== false) {
                $value = $value . $line;
            }
        }
*/
        return md5($stack_trace);
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

    function array_find($needle, $haystack)
    {
        foreach ($haystack as $k => $v) {
            if (strstr($v, $needle) !== false) {
                return $k;
            }
        }
        return false;
    }

    function get_user_id(){
        $t_user_id = user_get_id_by_name('acra_reporter');
        if( $t_user_id === false ){
            user_create( "acra_reporter", date("YzHis", time()), $p_email = 'acra@mantis.com');
        }
        $t_user_id = user_get_id_by_name('acra_reporter');
        return $t_user_id;
    }

    function get_category_id($p_project_id){
        $t_cat_name = 'acra report';
        $t_cat_id = category_get_id_by_name($t_cat_name, $p_project_id, false);
        if( $t_cat_id === false ){
            category_add($p_project_id, $t_cat_name);
            $t_cat_id = category_get_id_by_name($t_cat_name, $p_project_id);
        }
        return $t_cat_id;
    }

    function delete_bug($p_event, $p_bug_id){
        acra_delete_bug_ext_by_bug_id($p_bug_id);
    }

    function update_bug($p_event, $p_bug_data, $p_bug_id){
        var_dump($p_event);
        var_dump($p_bug_data);
        var_dump($p_bug_id);
        error_log(json_encode($p_event));
        error_log(json_encode($p_bug_data));
        error_log(json_encode($p_bug_id));
        $t_bug_data = bug_get($p_bug_id);
        error_log("old bug status:".$t_bug_data->status);
        error_log("old bug resolution:".$t_bug_data->resolution);

        error_log("new bug status:".$p_bug_data->status);
        error_log("new bug resolution:".$p_bug_data->resolution);
    }

    function show_bug_id($p_event, $p_string, $p_bug_id){
        if( $this->show_acra_befrief_btn() ){
            return '<span class="bug_id">'.$p_string.'</span>';
        }
        return $p_string;
    }

    function show_acra_befrief_btn(){
        if( strpos($_SERVER['REQUEST_URI'], "view_all_bug_page.php") !== false ){
            return true;
        }
        if( strpos($_SERVER['REQUEST_URI'], "my_view_page.php") !== false ){
            return true;
        }
        return false;
    }

    function show_acra_detail_btn(){
        if( strpos($_SERVER['REQUEST_URI'], "view.php") !== false ){
            return true;
        }
        return false;
    }
    
    function show_acra_view_issue_plugin(){
        ?>
        <script type="text/javascript" src="<?php echo plugin_file("fancyBox/fancybox.js"); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("fancyBox/fancybox.css"); ?>" media="screen" />
        <style type="text/css">
            .acra_popup{
                width:1200px;
                height:400px;
                display: none;
                padding: 0px;
            }
            .acra_frame{
                width:100%;
                height:100%;
            }
            .fancybox{
                font-weight: normal;
            }
        </style>

        <script>
            jQuery('.fancybox').fancybox();
        </script>
    <?php
    }
}