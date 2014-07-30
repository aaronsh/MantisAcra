<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-30
 * Time: 上午11:30
 */
require_once( config_get( 'class_path' ) . 'MantisPlugin.class.php' );

class MantisAcraPlugin extends MantisPlugin {

    /**
     *  A method that populates the plugin information and minimum requirements.
     */
    function register( ) {
        $this->name = plugin_lang_get( 'title' );
        $this->description = plugin_lang_get( 'description' );
        $this->page = '';

        $this->version = '1.0';
        $this->requires = array(
            'MantisCore' => '1.2.0',
            'jQuery' => '1.8.2',
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
            'EVENT_MENU_MANAGE' => 'import_issues_menu',
            'EVENT_MENU_FILTER' => 'export_issues_menu',
            'EVENT_CORE_READY' => "on_core_ready",
            'EVENT_MANAGE_PROJECT_UPDATE_FORM' => "show_project_acra_option",
            'EVENT_MANAGE_PROJECT_CREATE_FORM' => 'show_project_acra_option',
            'EVENT_MANAGE_PROJECT_UPDATE' => 'post_project_update',
            'EVENT_MANAGE_PROJECT_CREATE' => 'post_project_update',
            'EVENT_LAYOUT_BODY_END' => "attach_javascript"
        );
        return $hooks;
    }

    function import_issues_menu( ) {
        return array( '<a href="' . plugin_page( 'title' ) . '">' . plugin_lang_get( 'title' ) . '</a>', );
    }

    function export_issues_menu( ) {
        return array( '<a href="' . plugin_page( 'title' ) . '">' . plugin_lang_get( 'title' ) . '</a>', );
    }

    function schema()
    {
        $schema = array();
        $schema[] = array("CreateTableSQL", array(plugin_table("project"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  project_id 		 I  NOTNULL DEFAULT '0',
  package_name      C(128) NOTNULL DEFAULT \" '' \"
",Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));



        $schema[] = array("CreateTableSQL", array(plugin_table("issue"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  issue_id      C(32) NOTNULL DEFAULT \"\",
  app_ver_code  C(32) NOTNULL DEFAULT \" '' \",
  project_id 		 I  NOTNULL DEFAULT '0',
  report_id     X NOTNULL DEFAULT \" '' \",
  app_ver_code  C(32) NOTNULL DEFAULT \" '' \",
  file_path     X NOTNULL DEFAULT \" '' \",
  phone_model   X NOTNULL DEFAULT \" '' \",
  phone_build   X NOTNULL DEFAULT \" '' \",
  phone_brand   X NOTNULL DEFAULT \" '' \",
  product_name  X NOTNULL DEFAULT \" '' \",
  total_mem_size    I,
  available_mem_size I,
  custom_data   X NOTNULL DEFAULT \" '' \",
  stack_trace   X NOTNULL DEFAULT \" '' \",
  initial_configuration X NOTNULL DEFAULT \" '' \",
  crash_configuration   X NOTNULL DEFAULT \" '' \",
  display       X NOTNULL DEFAULT \" '' \",
  user_comment  X NOTNULL DEFAULT \" '' \",
  dumpsys_meminfo       X NOTNULL DEFAULT \" '' \",
  dropbox       X NOTNULL DEFAULT \" '' \",
  logcat        X NOTNULL DEFAULT \" '' \",
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
  reports       I NOTNULL DEFAULT '0'
",Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));

        return $schema;
    }

    function install() {
        $result = true;
        return $result;
    }

    function on_core_ready(){
        error_log("on_core_ready:".json_encode($_REQUEST));
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
        error_log("show_project_acra_option ".json_encode(db_fetch_array($result)));
        //$num_files = db_num_rows( $result );
         }
?>
<tr <?php echo helper_alternate_class() ?>>
<td class="category" >
    Acra Option
</td>
<td>
<?php echo json_encode($p_param1).";".json_encode($p_param2); ?>
    <input type="checkbox" name="acra_project" checked="checked">
    <input type="text" name="acra_package" size="60" maxlength="128" value="com.benemind.voa">
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
            $t_query = "DELETE FROM $t_acra_prj_table WHERE `project_id` = $p_param2";
        }
        db_query_bound($t_query);

    }

    function attach_javascript(){
?>
        <script>
            alert("hello");
        </script>
<?php
    }


    function save_acra_issue($p_project_id){
        $t_project_id = $p_project_id;



        if( !access_has_project_level( config_get('report_bug_threshold' ) ) ){
            echo "access_has_project_level ret";
            return;
        }

        $t_bug_data = new BugData;
        $t_bug_data->project_id             = $t_project_id;
        $t_bug_data->reporter_id            = auth_get_current_user_id();
        $t_bug_data->build                  = gpc_get_string( 'build', '' );
        $t_bug_data->platform               = gpc_get_string( 'platform', '' );
        $t_bug_data->os                     = gpc_get_string( 'os', '' );
        $t_bug_data->os_build               = gpc_get_string( 'os_build', '' );
        $t_bug_data->version                = gpc_get_string( 'product_version', '' );
        $t_bug_data->profile_id             = gpc_get_int( 'profile_id', 0 );
        $t_bug_data->handler_id             = gpc_get_int( 'handler_id', 0 );
        $t_bug_data->view_state             = gpc_get_int( 'view_state', config_get( 'default_bug_view_status' ) );
        $t_bug_data->category_id            = gpc_get_int( 'category_id', 0 );
        $t_bug_data->reproducibility        = gpc_get_int( 'reproducibility', config_get( 'default_bug_reproducibility' ) );
        $t_bug_data->severity               = gpc_get_int( 'severity', config_get( 'default_bug_severity' ) );
        $t_bug_data->priority               = gpc_get_int( 'priority', config_get( 'default_bug_priority' ) );
        $t_bug_data->projection             = gpc_get_int( 'projection', config_get( 'default_bug_projection' ) );
        $t_bug_data->eta                    = gpc_get_int( 'eta', config_get( 'default_bug_eta' ) );
        $t_bug_data->resolution             = gpc_get_string('resolution', config_get( 'default_bug_resolution' ) );
        $t_bug_data->status                 = gpc_get_string( 'status', config_get( 'bug_submit_status' ) );
        $t_bug_data->summary                = trim( gpc_get_string( 'summary' ) );
        $t_bug_data->description            = gpc_get_string( 'description' );
        $t_bug_data->steps_to_reproduce     = gpc_get_string( 'steps_to_reproduce', config_get( 'default_bug_steps_to_reproduce' ) );
        $t_bug_data->additional_information = gpc_get_string( 'additional_info', config_get ( 'default_bug_additional_info' ) );
        $t_bug_data->due_date               = gpc_get_string( 'due_date', '');
        if ( is_blank ( $t_bug_data->due_date ) ) {
            $t_bug_data->due_date = date_get_null();
        }

        $f_files                            = gpc_get_file( 'ufile', null ); /** @todo (thraxisp) Note that this always returns a structure */
        $f_report_stay                      = gpc_get_bool( 'report_stay', false );
        $f_copy_notes_from_parent           = gpc_get_bool( 'copy_notes_from_parent', false);

        if ( access_has_project_level( config_get( 'roadmap_update_threshold' ), $t_bug_data->project_id ) ) {
            $t_bug_data->target_version = gpc_get_string( 'target_version', '' );
        }

        # if a profile was selected then let's use that information
        if ( 0 != $t_bug_data->profile_id ) {
            if ( profile_is_global( $t_bug_data->profile_id ) ) {
                $row = user_get_profile_row( ALL_USERS, $t_bug_data->profile_id );
            } else {
                $row = user_get_profile_row( $t_bug_data->reporter_id, $t_bug_data->profile_id );
            }

            if ( is_blank( $t_bug_data->platform ) ) {
                $t_bug_data->platform = $row['platform'];
            }
            if ( is_blank( $t_bug_data->os ) ) {
                $t_bug_data->os = $row['os'];
            }
            if ( is_blank( $t_bug_data->os_build ) ) {
                $t_bug_data->os_build = $row['os_build'];
            }
        }
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
            $t_bug_data->handler_id = auth_get_current_user_id();
        }

        # Create the bug
        $t_bug_id = $t_bug_data->create();

        # Mark the added issue as visited so that it appears on the last visited list.
        last_visited_issue( $t_bug_id );

        # Handle the file upload
        $t_files = helper_array_transpose( $f_files );
        foreach( $t_files as $t_file ) {
            if( !empty( $t_file['name'] ) ) {
                file_add( $t_bug_id, $t_file, 'bug' );
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
    }

    function build_acra_issue_id($stack_trace, $package)
{
    $lines = explode("\n", $stack_trace);
    //$idx = array_find('Caused by:', $lines);
    //$v = $lines[$idx];
    if (array_find(": ", $lines) === false && array_find($package, $lines) === false) {
        $value = $lines[0];
    } else {
        $value = "";
        foreach ($lines as $id => $line) {
            if (strpos($line, ": ") !== false || strpos($line, $package) !== false || strpos
                ($line, "Error") !== false || strpos($line, "Exception") !== false) {
                $value .= $line . "<br />";
            }
        }
    }
    echo $value;
    return md5($value);
}

}