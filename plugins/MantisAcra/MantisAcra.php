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
            'EVENT_MANAGE_PROJECT_CREATE' => 'post_project_update'
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

        return $schema;
    }

    function install() {
        $result = true;
        return $result;
    }

    function on_core_ready(){
        error_log("on_core_ready:".json_encode($_REQUEST));
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
}