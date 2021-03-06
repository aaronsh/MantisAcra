<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-7-30
 * Time: 上午11:30
 */
require_once(config_get('class_path') . 'MantisPlugin.class.php');

require('BugDataAcraExt.php');
require("VersionAcraExt.php");

class MantisAcraPlugin extends MantisPlugin
{

    /**
     *  A method that populates the plugin information and minimum requirements.
     */
    function register()
    {
        $this->name = plugin_lang_get('title');
        $this->description = plugin_lang_get('description');
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
    function hooks()
    {
        $hooks = array(
            'EVENT_CORE_READY' => "on_core_ready",
            'EVENT_MANAGE_PROJECT_UPDATE_FORM' => "show_project_acra_option",
            'EVENT_MANAGE_PROJECT_CREATE_FORM' => 'show_project_acra_option',
            'EVENT_MANAGE_PROJECT_UPDATE' => 'post_project_update',
            'EVENT_MANAGE_PROJECT_CREATE' => 'post_project_update',
            'EVENT_LAYOUT_BODY_END' => "attach_javascript",
            'EVENT_UPDATE_BUG' => 'update_bug',
            'EVENT_BUG_DELETED' => "delete_bug",
            'EVENT_DISPLAY_BUG_ID' => 'show_bug_id',
            'EVENT_MANAGE_VERSION_UPDATE_FORM' => 'show_version_acra_option',
            'EVENT_MANAGE_VERSION_UPDATE' => 'update_version_acra_option'
        );
        return $hooks;
    }


    function schema()
    {
        $schema = array();
        $schema[] = array("CreateTableSQL", array(plugin_table("project"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  project_id 		 I  NOTNULL DEFAULT '0',
  package_name      C(128) NOTNULL DEFAULT \" '' \",
  packages      X
", Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));

        $schema[] = array("CreateTableSQL", array(plugin_table("version"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  version_id 		 I  NOTNULL DEFAULT '0',
  map_file      C(128) NOTNULL DEFAULT \" '' \"
", Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));

        /*
                $schema[] = array("CreateTableSQL", array(plugin_table("report"), "
          id 		 I  NOTNULL PRIMARY AUTO,
          total 		 I  NOTNULL DEFAULT '0',
          resolved 		 I  NOTNULL DEFAULT '0',
          date   T
        ",Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));
        */

        $schema[] = array("CreateTableSQL", array(plugin_table("issue"), "
  id 		 I  NOTNULL PRIMARY AUTO,
  project_id 	  I  NOTNULL DEFAULT '0',
  issue_id      I NOTNULL DEFAULT '0',
  report_id     C(36) NOTNULL DEFAULT \" '' \",
  report_fingerprint    C(32) NOTNULL DEFAULT \" '' \",
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
", Array('mysql' => 'ENGINE=MyISAM DEFAULT CHARSET=utf8', 'pgsql' => 'WITHOUT OIDS')));

        return $schema;
    }

    function install()
    {
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

    function on_core_ready()
    {
/*
        if( isset($_GET['sam']) ){
            //update all summaries
            $t_bug_text_table = db_get_table('mantis_bug_text_table');
            $t_bug_table = db_get_table( 'mantis_bug_table' );

            $query = "SELECT `id`, `bug_text_id`,`project_id` FROM `$t_bug_table`";

            $result = db_query_bound( $query, Array() );
            $bug_count = db_num_rows( $result );

            $t_bug_id       = 0;

            for ($i=0;$i<$bug_count;$i++) {
                $row = db_fetch_array( $result );
                $t_bug_id = $row['id'];
                $t_bug_text_id = $row['bug_text_id'];
                $t_prj_id = $row['project_id'];
                $query_get_desc = "SELECT `description` FROM `$t_bug_text_table` where `id` = $t_bug_text_id";
                $desc_result = db_query_bound($query_get_desc);
                $t_description = db_fetch_array($desc_result);
                if( $t_description !== false ){
                    $t_description = get_bug_summary_by_version('', $t_description['description'], $t_prj_id );
                    db_query_bound("UPDATE `$t_bug_table` SET `summary`=".db_param() ." WHERE `id` =".db_param() , array($t_description, $t_bug_id));
                }
            }
        }
*/
/*
        if (strcmp('manage_proj_ver_delete.php', $this->get_page_name()) === 0) {

        }
*/
        if (isset($_SESSION["acra_ext"]) && $_SESSION["acra_ext"] && isset($_GET['acra_page'])) {
            $t_php_file = "pages/" . $_GET['acra_page'];
            require($t_php_file);
            exit;
        }

        if (isset($_GET['acra']) && $_GET['acra'] == 'true') {
            $pkg = gpc_get_string('PACKAGE_NAME');

            $t_acra_prj_table = plugin_table("project");
            $query = "SELECT * FROM $t_acra_prj_table WHERE package_name = '" . $pkg . "' LIMIT 0, 1";
            $result = db_query_bound($query);
            $result = db_fetch_array($result);
            if ($result === false) {
                return;
            }
            $prj_id = $result['project_id'];
            $packages = $result['packages'];

            $this->save_acra_issue($prj_id, $packages);
            exit;
        }
    }

    function show_project_acra_option($p_param1, $p_param2)
    {

        if (isset($p_param2)) {
            $t_acra_prj_table = plugin_table("project");

            $query = "SELECT * FROM $t_acra_prj_table WHERE project_id = $p_param2 LIMIT 0, 1";
            $result = db_query_bound($query);
            $result = db_fetch_array($result);

            $t_package_name = "";
            $t_packages = "";
            if ($result !== false && is_array($result)) {
                $t_package_name = $result['package_name'];
                $t_packages = $result['packages'];
            }
        }
        ?>
        <tr <?php echo helper_alternate_class() ?>>
            <td class="category">
                Acra Option
            </td>
            <td>
                <span><input type="checkbox" name="acra_project"  onclick="toggleAcraOption(this)" <?php if (strlen($t_package_name) > 0) {
                        echo 'checked="checked"';
                    } ?> >Is Acra Project</span>&nbsp;
                <div id="acra_option">
                    <div>
                        <div style="float:left; width:180px;"> Package of application: </div>
                        <input type="text" name="acra_package" size="60" maxlength="128" value="<?php echo $t_package_name; ?>">
                    </div>
                    <div style="padding-top:10px;">
                        <div style="float:left; width:180px;">Packages in application:</div>
                        <textarea name="packages" cols="62" rows="6"><?php echo $t_packages;?></textarea>
                    </div>
                </div>
                <script type="text/javascript">
                    function toggleAcraOption(checkBox){
                        var e = document.getElementById('acra_option');
                        if( checkBox.checked){
                            e.style.display='block';
                        }
                        else{
                            e.style.display='none';
                        }
                    }
                </script>
            </td>
        </tr>
    <?php
    }

    function show_version_acra_option($p_event, $p_ver_id)
    {
        if (isset($p_ver_id)) {
            $t_ver_data = version_get($p_ver_id);

            $t_acra_prj_table = plugin_table("project");
            $query = "SELECT * FROM $t_acra_prj_table WHERE project_id = " . $t_ver_data->project_id . " LIMIT 0,1";
            $result = db_query_bound($query);
            $result = db_fetch_array($result);
            $t_package_name = "";
            if ($result !== false && is_array($result)) {
                $t_package_name = $result['package_name'];
            }
            if (strlen($t_package_name) === 0) {
                return;
            }
        }
        ?>
        <tr class="row-1">
            <td class="category">Mapping file</td>
            <td>
                <input type="file" name="map_file"/>
            </td>
        </tr>
    <?php
    }

    function update_version_acra_option($p_event, $p_arr)
    {
        if (isset($p_arr)) {
            if ($_FILES['map_file']['error'] > 0) {
                trigger_error(ERROR_PLUGIN_GENERIC, E_USER_ERROR);
            }
            $t_ver_data = version_get($p_arr);
            $t_acra_prj_table = plugin_table("project");
            $query = "SELECT * FROM $t_acra_prj_table WHERE project_id = " . $t_ver_data->project_id . " LIMIT 0,1";
            $result = db_query_bound($query);
            $result = db_fetch_array($result);
            $t_package_name = "";
            if ($result !== false && is_array($result)) {
                $t_package_name = $result['package_name'];
            }
            if (strlen($t_package_name) === 0) {
                trigger_error(ERROR_PLUGIN_GENERIC, E_USER_ERROR);
            }

            $t_map_name = array('upload', 'acra', $t_package_name, date("Y"));
            $file_name = str_ireplace('manage_proj_ver_update.php', '', $_SERVER['SCRIPT_FILENAME']);
            $file_name = $file_name . implode(DIRECTORY_SEPARATOR, $t_map_name);
            create_map_file_folder($file_name);
            $t_ver_name = preg_replace("^[ ?/\\\\]{1}^is", "_", $t_ver_data->version) . '.map';
            $file_name = $file_name . DIRECTORY_SEPARATOR . $t_ver_name;

            handle_mapping_file($_FILES['map_file']['tmp_name'], $file_name);

            $t_acra_ver_table = plugin_table("version");
            $query = "SELECT * FROM $t_acra_ver_table WHERE `version_id` = " . $p_arr . " LIMIT 0,1";
            $result = db_query_bound($query);
            $rows = $result->RowCount();
            $map = mysql_real_escape_string($file_name);
            if ($rows === 0) {
                $query = "INSERT INTO $t_acra_ver_table (`id`, `version_id`, `map_file`) VALUES (NULL, '$p_arr', '$map'); ";
            } else {
                $query = "UPDATE $t_acra_ver_table SET `map_file` = '$map' WHERE `version_id` = $p_arr; ";
            }
            db_query_bound($query);
            //update the title of bugs
            update_bug_summary_by_version($t_ver_data->version, $file_name);
        }
    }

    function post_project_update($p_param1, $p_param2)
    {
        $t_acra_prj = gpc_get_bool('acra_project');
        $t_package = mysql_real_escape_string(gpc_get_string('acra_package'));
        $t_packages = mysql_real_escape_string(gpc_get_string('packages'));

        $t_acra_prj_table = plugin_table("project");
        if ($t_acra_prj) {
            if (strlen($t_package) > 0) {
                $query = "SELECT * FROM $t_acra_prj_table WHERE project_id = " . $p_param2 . " LIMIT 0,2";
                $result = db_query_bound($query);
                if (db_num_rows($result) > 0) {
                    $t_query = "UPDATE $t_acra_prj_table SET `package_name` = '$t_package', `packages`='$t_packages' WHERE `project_id` = $p_param2;";

                } else {
                    $t_query = "INSERT INTO $t_acra_prj_table ( package_name, project_id, packages) VALUES ('$t_package', $p_param2, $t_packages )";
                }
            } else {
                return;
            }
        } else {
            $t_query = "DELETE FROM $t_acra_prj_table WHERE `project_id` = $p_param2";
        }
        db_query_bound($t_query);
    }

    function attach_javascript()
    {
        if (isset($_GET['acra_page'])) {
            switch ($_GET['acra_page']) {
                case 'test.php':
                    //require("pages/test.php");
                    $this->show_acra_view_issue_plugin();
                    return;
            }
        }
        if ($this->show_acra_befrief_btn()) {
            $_SESSION["acra_ext"] = true;
            $this->show_acra_brief_buttons_plugin();
            return;
        }
        if ($this->show_acra_detail_btn()) {
            $_SESSION["acra_ext"] = true;
            $this->show_acra_detail_buttons_plugin();
            return;
        }
        if ($this->show_acra_update_version_mapping_option()) {
            $this->enable_acra_update_version_mapping_option();
        }
        ?>
    <?php
    }

    function show_acra_brief_buttons_plugin()
    {
        ?>
        <script type="text/javascript" src="<?php echo plugin_file("fancyBox/fancybox.js"); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("fancyBox/fancybox.css"); ?>"
              media="screen"/>
        <style type="text/css">
            .acra_popup {
                width: 800px;
                height: 400px;
                display: none;
                padding: 0px;
            }

            .acra_frame {
                width: 100%;
                height: 100%;
            }
        </style>

        <script>
            var bugs = jQuery('table tbody td a .bug_id');
            var ids = [];
            for (var i = 0; i < bugs.length; i++) {
                ids.push(bugs[i].innerText);
            }
            console.log(ids);
            jQuery.ajax({
                type: "post",
                url: "index.php?acra_page=check.php",
                dataType: "text",
                data: 'data=' + JSON.stringify(ids),
                success: function (data) {
                    try {
                        data = JSON.parse(data);

                        for (var i = 0; i < data.length; i++) {
                            if (data[i].id == ids[i]) {
                                jQuery(bugs[i].parentElement.parentElement).append(data[i].txt);
                                jQuery('#acra_dialog').append(data[i].popup);
                            }
                            jQuery('.fancybox').fancybox();
                        }
                    } catch (ex) {
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

    function show_acra_detail_btn()
    {
        $page = $this->get_page_name();
        if (strcmp($page, "view.php") === 0 && isset($_GET['id'])) {
            return true;
        }
        return false;
    }

    function show_acra_detail_buttons_plugin()
    {
        require("ProjectAcraExt.php");
        $id = gpc_get_string("id", '');
        $t_bug = bug_get($id);
        $packages = get_project_package_list($t_bug->project_id);
        $t_bug_text = bug_get_text_field($id, 'description');
        $t_restore_file = get_restore_file_by_version_name($t_bug->version);
        $restore_map = get_restore_map($t_restore_file);
        $t_bug_text = restore_stacktrace_by_map($t_bug_text, $restore_map);
        $t_bug_text = str_replace("\r", "", $t_bug_text);
        $bugnotes = bugnote_get_all_bugnotes($id);
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("chico.css"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("acra_view_bug.css"); ?>" />
        <script type="text/javascript" src="<?php echo plugin_file("acra_view_bug.js"); ?>"></script>
        <script type="text/javascript" src="<?php echo plugin_file("fancyBox/fancybox.js"); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("fancyBox/fancybox.css"); ?>"
              media="screen"/>
        <style type="text/css">
            .acra_popup {
                width: 800px;
                height: 400px;
                display: none;
                padding: 0px;
            }

            .acra_frame {
                width: 100%;
                height: 100%;
            }
        </style>
        <div id="acra_dialog" style="display:none">
            <?php
            foreach ($bugnotes as $note) {
                if( strlen($note->note_attr) > 0 ) {
                    echo '<div class="acra_popup" id="acra_';
                    echo sprintf("%06d", $note->note_attr);
                    echo '" style="display: none;">';
                    echo '<iframe class="acra_frame" src="index.php?acra_page=detail.php&acra_id=';
                    echo sprintf("%06d", $note->note_attr);
                    echo '"></iframe></div>';
                    echo "\r\n";
                }
            }
            ?>
        </div>
        <script>
            //update stack trace
            var packages = <?php echo json_encode(array_keys($packages));?>;
            var list = jQuery(".category");
            for (var i = 0; i < list.length; i++) {
                var e = list[i];
                var txt = e.innerText;
                if ("Description" == txt) {
                    e = e.nextSibling;
                    e.innerHTML = acra_buildStacktraceDiv(<?php echo json_encode($t_bug_text);?>, packages);
                    break;
                }
            }

            //update notes
            var noteRow, noteCells, noteTextCell, restoredNoteHtml, acraDetailLink;
            <?php
             foreach ($bugnotes as $note) {
                $t_bug_text = restore_stacktrace_by_map($note->note, $restore_map);
                $t_bug_text =json_encode( $t_bug_text);
            ?>
noteRow = document.getElementById('c<?php echo $note->id; ?>');
                noteCells = noteRow.getElementsByClassName("bugnote-note-public");
                noteTextCell = noteCells[0];
                noteTextCell.innerHTML = acra_buildStacktraceDiv(<?php echo $t_bug_text;?>, packages);

                <?php
                if( strlen($note->note_attr) ) {
                ?>
        acraDetailLink = document.createElement("div");
                acraDetailLink.innerHTML = '<a class="fancybox" href="#acra_<?php echo sprintf("%06d", $note->note_attr);?>" class="button-small">Acra Detail</a>';
                noteRow.firstElementChild.lastElementChild.appendChild(acraDetailLink);
                <?php
                }
                ?>

            <?php
             }
            ?>

            var cells = jQuery("td");
            var reg = new RegExp(/^\s*ID\s*$/);
            var idCell = null;
            for (var i = 0; i < cells.length; i++) {
                var str = cells[i].innerText;
                if (reg.test(str)) {
                    idCell = cells[i];
                    break;
                }
            }
            if (idCell != null) {
                var shorts = idCell.parentElement.previousElementSibling.firstElementChild;
                jQuery(shorts).append('<span class="bracket-link">[&nbsp;<a href="index.php?acra_page=test.php&acra_id=<?php echo gpc_get_string("id");?>">View ACRA more info</a>&nbsp;]</span>');
            }

            jQuery('.fancybox').fancybox();
        </script>
    <?php
    }

    function show_acra_update_version_mapping_option()
    {
        $page = $this->get_page_name();
        if (strcmp($page, "manage_proj_ver_edit_page.php") === 0) {
            return true;
        }
        return false;
    }

    function enable_acra_update_version_mapping_option()
    {
        ?>
        <script>
            var forms = document.getElementsByTagName('form');
            for (var i = 0; i < forms.length; i++) {
                var formNode = forms[i];
                if (formNode.action.indexOf('manage_proj_ver_update.php') > 0) {
                    formNode.enctype = "multipart/form-data"
                    break;
                }
            }
        </script>
    <?php
    }


    function save_acra_issue($p_project_id, $packages)
    {
        $begin_ts = microtime(true);
        set_time_limit(0);
        $pid = "pid:".getmypid()."-".substr(md5(microtime()),8,16)." ";

        error_log($pid."save_acra_issue enter");
        $t_app_version = gpc_get_string('APP_VERSION_NAME', '');
        $t_project_id = $p_project_id;
        $t_fingerprint = $this->build_acra_issue_fingerprint(gpc_get_string('STACK_TRACE'), $packages, $pid);

        $t_bug_id = acra_get_bug_id_by_fingerprint($t_fingerprint, $t_app_version);
        if( $t_bug_id != false && $t_bug_id != '0' && $t_bug_id != '-1' ){
            //the bug id is valid
            if( bug_is_closed($t_bug_id) ){
                error_log($pid."the bug ".$t_bug_id." is closed");
                error_log($pid."save_acra_issue quit2 ".(microtime(true)-$begin_ts).'ms');
                return;
            }
        }

        //save acra issue extionsion
        $acra_ext = new BugDataAcraExt;
        $acra_ext->project_id = $t_project_id;
        $acra_ext->issue_id = 0;
        $acra_ext->report_id = gpc_get_string('REPORT_ID', '');
        $acra_ext->report_fingerprint = $t_fingerprint;
        $acra_ext->file_path = gpc_get_string('FILE_PATH', '');
        $acra_ext->phone_model = gpc_get_string('PHONE_MODEL', '');
        $acra_ext->phone_build = gpc_get_string('BUILD', '');
        $acra_ext->phone_brand = gpc_get_string('BRAND', '');
        $acra_ext->product_name = gpc_get_string('PRODUCT', '');
        $acra_ext->total_mem_size = gpc_get_string('TOTAL_MEM_SIZE', '');
        $acra_ext->available_mem_size = gpc_get_string('AVAILABLE_MEM_SIZE', '');
        $acra_ext->custom_data = gpc_get_string('CUSTOM_DATA', '');
        $acra_ext->initial_configuration = gpc_get_string('INITIAL_CONFIGURATION', '');
        $acra_ext->crash_configuration = gpc_get_string('CRASH_CONFIGURATION', '');
        $acra_ext->display = gpc_get_string('DISPLAY', '');
        $acra_ext->user_comment = gpc_get_string('USER_COMMENT', '');
        $acra_ext->dumpsys_meminfo = gpc_get_string('DUMPSYS_MEMINFO', '');
        $acra_ext->dropbox = gpc_get_string('DROPBOX', ''); //NOT EXITS, need check with acra, later
        $acra_ext->eventslog = gpc_get_string('EVENTSLOG', ''); //NOT EXITS, need check with acra, later
        $acra_ext->radiolog = gpc_get_string('RADIOLOG', ''); //NOT EXITS, need check with acra, later
        $acra_ext->is_silent = gpc_get_string('IS_SILENT', '');
        $acra_ext->device_id = gpc_get_string('INSTALLATION_ID', '');//NOT EXITS, need check with acra, later
        $acra_ext->installation_id = gpc_get_string('INSTALLATION_ID', '');
        $acra_ext->user_email = gpc_get_string('USER_EMAIL', '');
        $acra_ext->device_features = gpc_get_string('DEVICE_FEATURES', '');
        $acra_ext->environment = gpc_get_string('ENVIRONMENT', '');
        $acra_ext->settings_system = gpc_get_string('SETTINGS_SYSTEM', '');
        $acra_ext->settings_secure = gpc_get_string('SETTINGS_SECURE', '');
        $acra_ext->shared_preferences = gpc_get_string('SHARED_PREFERENCES', '');
        $acra_ext->android_version = gpc_get_string('ANDROID_VERSION', '');
        $acra_ext->app_version = $t_app_version;
        $acra_ext->crash_date = $this->covertTimeString(gpc_get_string('USER_CRASH_DATE', ''));
        $acra_ext->install_date = $this->covertTimeString(gpc_get_string('USER_APP_START_DATE', ''));
        $t_result = $acra_ext->create();
        if( $t_result === false ){
            error_log($pid."dumplicated report id");
            return;
        }

        error_log($pid."save fingerprint ".$acra_ext->report_fingerprint." to acra issue:".$acra_ext->id);
        $t_duplicated_bug_id = '0';
        $tries = 0;
        while ($tries < 30) {
            sleep(1); //wait one second
            $t_duplicated_bug_id = acra_get_bug_id_by_fingerprint($t_fingerprint, $t_app_version);
            $tries = $tries + 1;
            if ($t_duplicated_bug_id == "-1") {
                $id = acra_get_first_issue_id_by_fingerprint($t_fingerprint, 0);
                if ($id == $acra_ext->id) {
                    $t_duplicated_bug_id = '0';
                    break;
                }
                continue;
            }
            if ($t_duplicated_bug_id == '0') {
                break;
            }
            break;
        }
        if (tries >= 30) {
            $t_duplicated_bug_id = '0';
        }

        $t_user_id = $this->get_user_id();
        if ($t_duplicated_bug_id == '0') {
            //new crash report, save a bug record
            $t_duplicated_bug_id = $this->save_bug($t_project_id, $t_user_id);
            error_log($pid."create bug ".$t_duplicated_bug_id.' for acra issue:'.$acra_ext->id.' fp:'.$t_fingerprint);
            //create version if possible
            $t_version_id = version_get_id($t_app_version, $t_project_id);
            if ($t_version_id === false) {
                version_add($t_project_id, $t_app_version, VERSION_RELEASED);
                event_signal('EVENT_MANAGE_VERSION_CREATE', array($t_version_id));
            }
        }
        else{
            error_log($pid."exists bug ".$t_duplicated_bug_id);
            if( !bug_is_closed($t_duplicated_bug_id) ) { //the bug is open
                $t_notes = bugnote_get_all_bugnotes($t_duplicated_bug_id);
                if( count($t_notes) < 20 ) { //we only accepts 20 crash records as notes for the reason of the speed of viewing bug detail page.
                    error_log($pid."acra issue is:".$acra_ext->id);
                    $note_id = bugnote_add($t_duplicated_bug_id, gpc_get_string('STACK_TRACE'), '0:00', false, BUGNOTE, $acra_ext->id, $t_user_id, false, false );
                    error_log($pid."add note ".$note_id." to bug".$t_duplicated_bug_id);
                }
                else{
                    bug_update_date($t_duplicated_bug_id);
                    error_log($pid."update bug".$t_duplicated_bug_id." time, not add note");
                }
            }
            else{ //the bug is closed, do not accept crash report any more
                acra_delete_bug_ext_by_id($acra_ext->id);
                error_log($pid."delete the acra issue because the bug".$t_duplicated_bug_id." is closed");
                error_log($pid."save_acra_issue quit1 ".(microtime(true)-$begin_ts).'ms');
                return;
            }
            /*
            if( !($t_bug->status == RESOLVED || $t_bug->status == CLOSED
                || $t_bug->resolution == FIXED || $t_bug->resolution == DUPLICATE || $t_bug->resolution == NOT_FIXABLE) ){
                //refresh bug update time
                bug_update_date($t_duplicated_bug_id);
            }
            */
        }
        error_log($pid."update bug id of acra issues which fingerprint is ".$t_fingerprint);
        acra_update_bug_id_by_fingerprint($t_fingerprint, $t_duplicated_bug_id);
        error_log($pid."save_acra_issue quit0 ".(microtime(true)-$begin_ts).'ms');
    }

    function save_bug($p_project_id, $p_user_id)
    {
        require('ProfileAcraExt.php');

        $t_project_id = $p_project_id;

        global $g_cache_current_user_id;
        $g_cache_current_user_id = $p_user_id;

        $t_bug_data = new BugData;
        $t_bug_data->project_id = $t_project_id;
        $t_bug_data->reporter_id = $p_user_id;
        $t_bug_data->build = gpc_get_string('APP_VERSION_CODE', '');
        $t_bug_data->platform = "Android";
        $t_bug_data->os = gpc_get_string('ANDROID_VERSION', '');//gpc_get_string( 'os', '' );
        $t_os_build = gpc_get_string('BUILD', '');
        if (preg_match('/DISPLAY\s*=\s*(.*)/', $t_os_build, $t_match)) {
            var_dump($t_match);
            $t_os_build = $t_match[1];
        } else {
            $t_os_build = gpc_get_string('ANDROID_VERSION', '');
        }
        $t_bug_data->os_build = $t_os_build;//gpc_get_string( 'os_build', '' );
        $t_bug_data->version = gpc_get_string('APP_VERSION_NAME', '');
        $t_bug_data->profile_id = profile_create_unique(ALL_USERS, $t_bug_data->platform, $t_bug_data->os, $t_bug_data->os_build, "");
        $t_bug_data->handler_id = gpc_get_int('handler_id', 0);
        $t_bug_data->view_state = gpc_get_int('view_state', config_get('default_bug_view_status', 'VS_PRIVATE', 'acra_reporter'));
        $t_bug_data->category_id = $this->get_category_id($p_project_id);//gpc_get_int( 'category_id', 0 );
        $t_bug_data->reproducibility = 10;//gpc_get_int( 'reproducibility', config_get( 'default_bug_reproducibility' ) );
        $t_bug_data->severity = CRASH;//gpc_get_int( 'severity', config_get( 'default_bug_severity' ) );
        $t_bug_data->priority = HIGH;//gpc_get_int( 'priority', config_get( 'default_bug_priority' ) );
        $t_bug_data->projection = gpc_get_int('projection', config_get('default_bug_projection'));
        $t_bug_data->eta = gpc_get_int('eta', config_get('default_bug_eta'));
        $t_bug_data->resolution = OPEN;//gpc_get_string('resolution', config_get( 'default_bug_resolution' ) );
        $t_bug_data->status = NEW_;//gpc_get_string( 'status', config_get( 'bug_submit_status' ) );
        $t_bug_data->description = gpc_get_string('STACK_TRACE');//gpc_get_string( 'description' );
        $t_bug_data->summary = get_bug_summary_by_version(gpc_get_string('APP_VERSION_NAME', ''), $t_bug_data->description, $t_project_id);
        $t_bug_data->steps_to_reproduce = gpc_get_string('LOGCAT', "");
        $t_bug_data->additional_information = gpc_get_string('CRASH_CONFIGURATION', "");
        $t_bug_data->due_date = gpc_get_string('USER_CRASH_DATE', '');
        if (is_blank($t_bug_data->due_date)) {
            $t_bug_data->due_date = date_get_null();
        }


        $f_files = gpc_get_file('ufile', null);
        /** @todo (thraxisp) Note that this always returns a structure */
        $f_report_stay = gpc_get_bool('report_stay', false);
        $f_copy_notes_from_parent = gpc_get_bool('copy_notes_from_parent', false);


        helper_call_custom_function('issue_create_validate', array($t_bug_data));

        # Validate the custom fields before adding the bug.
        $t_related_custom_field_ids = custom_field_get_linked_ids($t_bug_data->project_id);
        foreach ($t_related_custom_field_ids as $t_id) {
            $t_def = custom_field_get_definition($t_id);

            # Produce an error if the field is required but wasn't posted
            if (!gpc_isset_custom_field($t_id, $t_def['type']) &&
                ($t_def['require_report'])
            ) {
                error_parameters(lang_get_defaulted(custom_field_get_field($t_id, 'name')));
                trigger_error(ERROR_EMPTY_FIELD, ERROR);
            }

            if (!custom_field_validate($t_id, gpc_get_custom_field("custom_field_$t_id", $t_def['type'], NULL))) {
                error_parameters(lang_get_defaulted(custom_field_get_field($t_id, 'name')));
                trigger_error(ERROR_CUSTOM_FIELD_INVALID_VALUE, ERROR);
            }
        }

        # Allow plugins to pre-process bug data
        $t_bug_data = event_signal('EVENT_REPORT_BUG_DATA', $t_bug_data);

        # Ensure that resolved bugs have a handler
        if ($t_bug_data->handler_id == NO_USER && $t_bug_data->status >= config_get('bug_resolved_status_threshold')) {
            $t_bug_data->handler_id = $this->get_user_id();
        }

        # Create the bug
        $t_bug_id = $t_bug_data->create();

        # Mark the added issue as visited so that it appears on the last visited list.
        last_visited_issue($t_bug_id);

        # Handle the file upload
        if ($f_files != null) {
            $t_files = helper_array_transpose($f_files);
            if ($t_files != null) {
                foreach ($t_files as $t_file) {
                    if (!empty($t_file['name'])) {
                        file_add($t_bug_id, $t_file, 'bug');
                    }
                }
            }
        }

        # Handle custom field submission
        foreach ($t_related_custom_field_ids as $t_id) {
            # Do not set custom field value if user has no write access
            if (!custom_field_has_write_access($t_id, $t_bug_id)) {
                continue;
            }

            $t_def = custom_field_get_definition($t_id);
            if (!custom_field_set_value($t_id, $t_bug_id, gpc_get_custom_field("custom_field_$t_id", $t_def['type'], $t_def['default_value']), false)) {
                error_parameters(lang_get_defaulted(custom_field_get_field($t_id, 'name')));
                trigger_error(ERROR_CUSTOM_FIELD_INVALID_VALUE, ERROR);
            }
        }

        $f_master_bug_id = gpc_get_int('m_id', 0);
        $f_rel_type = gpc_get_int('rel_type', -1);

        if ($f_master_bug_id > 0) {
            # it's a child generation... let's create the relationship and add some lines in the history

            # update master bug last updated
            bug_update_date($f_master_bug_id);

            # Add log line to record the cloning action
            history_log_event_special($t_bug_id, BUG_CREATED_FROM, '', $f_master_bug_id);
            history_log_event_special($f_master_bug_id, BUG_CLONED_TO, '', $t_bug_id);

            if ($f_rel_type >= 0) {
                # Add the relationship
                relationship_add($t_bug_id, $f_master_bug_id, $f_rel_type);

                # Add log line to the history (both issues)
                history_log_event_special($f_master_bug_id, BUG_ADD_RELATIONSHIP, relationship_get_complementary_type($f_rel_type), $t_bug_id);
                history_log_event_special($t_bug_id, BUG_ADD_RELATIONSHIP, $f_rel_type, $f_master_bug_id);

                # update relationship target bug last updated
                bug_update_date($t_bug_id);

                # Send the email notification
                email_relationship_added($f_master_bug_id, $t_bug_id, relationship_get_complementary_type($f_rel_type));
            }

            # copy notes from parent
            if ($f_copy_notes_from_parent) {

                $t_parent_bugnotes = bugnote_get_all_bugnotes($f_master_bug_id);

                foreach ($t_parent_bugnotes as $t_parent_bugnote) {

                    $t_private = $t_parent_bugnote->view_state == VS_PRIVATE;

                    bugnote_add($t_bug_id, $t_parent_bugnote->note, $t_parent_bugnote->time_tracking,
                        $t_private, $t_parent_bugnote->note_type, $t_parent_bugnote->note_attr,
                        $t_parent_bugnote->reporter_id, /* send_email */
                        FALSE, /* log history */
                        FALSE);
                }
            }

        }

        helper_call_custom_function('issue_create_notify', array($t_bug_id));

        # Allow plugins to post-process bug data with the new bug ID
        event_signal('EVENT_REPORT_BUG', array($t_bug_data, $t_bug_id));

        email_new_bug($t_bug_id);

        // log status and resolution changes if they differ from the default
        if ($t_bug_data->status != config_get('bug_submit_status'))
            history_log_event($t_bug_id, 'status', config_get('bug_submit_status'));

        if ($t_bug_data->resolution != config_get('default_bug_resolution'))
            history_log_event($t_bug_id, 'resolution', config_get('default_bug_resolution'));

        return $t_bug_id;
    }

    function covertTimeString($s)
    {
        $result = "";
        $parts = explode('T', $s);
        $result = $parts[0] . ' ';
        $parts = explode('.', $parts[1]);
        $result = $result . $parts[0];
        return $result;
    }

    function build_acra_issue_fingerprint($stack_trace, $packages, $pid)
    {
        $decoded = get_stack_map($stack_trace);
        $exception = $decoded->exception;
        $exception = preg_replace('/:?\s+.*$/i', '', $exception);
        $lines = array();
        $lines[] = $exception;

        require("ProjectAcraExt.php");
        $app_packages = handle_project_package_list($packages);

        foreach($decoded->stack as $entry){
            $method = $entry->method;
            foreach($app_packages as $pack=> $len){
                if( strncmp($method, $pack, $len) === 0 ){
                    $lines[] = $entry->method.$entry->suffix;
                    break;
                }
            }
        }

        if( count($lines) === 1 ){
            //$lines[] = date("Y-m-d h:i:s");
            foreach($decoded->stack as $entry){
                 $lines[] = $entry->method;//.$entry->suffix;
            }
        }
        $contents = implode("\n", $lines);
        error_log($pid."stack trace:".$stack_trace);
        error_log($pid."fingerprint_text:".$contents);
        return md5($contents);
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

    function get_user_id()
    {
        $t_user_id = user_get_id_by_name('acra_reporter');
        if ($t_user_id === false) {
            user_create("acra_reporter", date("YzHis", time()), $p_email = 'acra@mantis.com');
        }
        $t_user_id = user_get_id_by_name('acra_reporter');
        return $t_user_id;
    }

    function get_category_id($p_project_id)
    {
        $t_cat_name = 'acra report';
        $t_cat_id = category_get_id_by_name($t_cat_name, $p_project_id, false);
        if ($t_cat_id === false) {
            category_add($p_project_id, $t_cat_name);
            $t_cat_id = category_get_id_by_name($t_cat_name, $p_project_id);
        }
        return $t_cat_id;
    }

    function delete_bug($p_event, $p_bug_id)
    {
        acra_delete_bug_ext_by_bug_id($p_bug_id);
    }

    function update_bug($p_event, $p_bug_data, $p_bug_id)
    {
        $t_bug_data = bug_get($p_bug_id);
    }

    function show_bug_id($p_event, $p_string, $p_bug_id)
    {
        if ($this->show_acra_befrief_btn()) {
            return '<span class="bug_id">' . $p_string . '</span>';
        }
        return $p_string;
    }

    function show_acra_befrief_btn()
    {
        $page = $this->get_page_name();
        if (strcmp($page, "view_all_bug_page.php") === 0) {
            return true;
        }
        if (strcmp($page, "my_view_page.php") === 0) {
            return true;
        }
        return false;
    }

    function show_acra_view_issue_plugin()
    {
        ?>
        <script type="text/javascript" src="<?php echo plugin_file("fancyBox/fancybox.js"); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo plugin_file("fancyBox/fancybox.css"); ?>"
              media="screen"/>
        <style type="text/css">
            .acra_popup {
                width: 1200px;
                height: 400px;
                display: none;
                padding: 0px;
            }

            .acra_frame {
                width: 100%;
                height: 100%;
            }

            .fancybox {
                font-weight: normal;
            }
        </style>

        <script>
            jQuery('.fancybox').fancybox();
        </script>
    <?php
    }

    function get_page_name()
    {
        if (preg_match("/\\/([^\\/]+\\.php)\\??/", $_SERVER['SCRIPT_FILENAME'], $matches) === 1) {
            return $matches[1];
        }
        return '';
    }
}