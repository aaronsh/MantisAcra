<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-8-4
 * Time: 下午6:12
 */

$t_plugin_path = config_get( 'plugin_path' );
require_once( $t_plugin_path . 'MantisAcra' . DIRECTORY_SEPARATOR . 'BugDataAcraExt.php' );
header('X-Frame-Options:SAMEORIGIN');
?>

<html lang="en" xml:lang="en">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="txt/html; charset=utf-8" />

    <style type="text/css">

    </style>

    <link rel="stylesheet" href="<?php echo plugin_file('chico.css');?>">
    <style>
        /**
         * Carousel demo
         */
        .myCarousel .ch-carousel-item {
            width: 200px;
            height: 200px;
        }

        .myCarousel img {
            max-width: 100%;
            max-height: 100%;
        }

        /* Icons demo */
        .showroomIcons {
            overflow: hidden;
        }

        .showroomIcons li{
            float:left;
            width: 33%;
            line-height: 2em;
        }

        .ch-loading-small {
            display: block;
            margin:0 auto;
        }

        body {
            margin-top: 10px;
        }

        .ml-header {
            background-color: #fff;
            border-bottom: 1px solid #D9D9D9;
            height: 50px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 99;
        }

        .ml-header h1 {
            text-align: center;
            line-height: 1.6em;
            cursor: pointer;
        }

    </style>
</head>

<body>
<?php
$id = gpc_get_string("acra_id");
$acra_bug_ext = acra_get_bug_ext_by_id($id);
$t_bug = bug_get($acra_bug_ext->issue_id);
?>

<div class="ch-box-lite ch-box-error">
    <h2>Bug ID:<?php echo $id; ?></h2>
</div>
    <table class="ch-datagrid" summary="">
        <thead>
        <tr>
            <th scope="col">Platform</th>
            <th scope="col">VersionName</th>
            <th scope="col">PhoneBrand</th>
            <th scope="col">PhoneName</th>
            <th scope="col">PhoneModel</th>
            <th scope="col">device id</th>
            <th scope="col">Installation ID</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $t_bug->os.' '.$t_bug->platform;?></td>
            <td><?php echo $t_bug->version;?></td>
            <td><?php echo $acra_bug_ext->phone_brand; ?></td>
            <td><?php echo $acra_bug_ext->product_name; ?></td>
            <td><?php echo $acra_bug_ext->phone_model; ?></td>
            <td><?php echo $acra_bug_ext->device_id; ?></td>
            <td><?php echo $acra_bug_ext->installation_id; ?></td>
        </tr>
        </tbody>
    </table>

<div class="ch-box-container">
    <h2 id="tabs">Tabs</h2>

    <div class="YOUR_SELECTOR_Tabs ch-tabs">
        <ul class="ch-tabs-triggers">
            <li><a href="#tab1-a" class="ch-tab">Display</a></li>
            <li><a href="#tab2-a" class="ch-tab">Initial Configuration</a></li>
            <li><a href="#tab3-a" class="ch-tab">Crash Configuration</a></li>
            <li><a href="#tab4-a" class="ch-tab">Phone Build</a></li>
            <li><a href="#tab5-a" class="ch-tab">Features</a></li>
            <li><a href="#tab6-a" class="ch-tab">Settings System</a></li>
            <li><a href="#tab7-a" class="ch-tab">Settings Secure </a></li>
            <li><a href="#tab8-a" class="ch-tab">DumpSys&MemInfo</a></li>
            <li><a href="#tab9-a" class="ch-tab">Environment</a></li>
            <li><a href="#tab10-a" class="ch-tab">Shared Preferences</a></li>
            <li><a href="#tab11-a" class="ch-tab">Miscs </a></li>
        </ul>
        <div class="ch-box-lite">
            <div id="tab1-a">
                <?php
                $t_display = $acra_bug_ext->display;
                $t_display = htmlentities($t_display);
                echo str_replace("\n", "<br>\n", $t_display);
                ?>
            </div>

            <div id="tab2-a" class="ch-hide">
                <?php
                $t_init_conf = $acra_bug_ext->initial_configuration;
                $t_init_conf = htmlentities($t_init_conf);
                echo str_replace("\n", "<br>\n", $t_init_conf);
                ?>
            </div>

            <div id="tab3-a" class="ch-hide">
                <?php
                $t_bug_crash_conf = bug_get_text_field($id, 'additional_information');
                $t_bug_crash_conf = htmlentities($t_bug_crash_conf);
                echo str_replace("\n", "<br>\n", $t_bug_crash_conf);
                ?>
            </div>

            <div id="tab4-a" class="ch-hide">
                <?php
                $t_bug_phone_build = $acra_bug_ext->phone_build;
                $t_bug_phone_build = htmlentities($t_bug_phone_build);
                echo str_replace("\n", "<br>\n", $t_bug_phone_build);
                ?>
            </div>

            <div id="tab5-a" class="ch-hide">
                <?php
                $t_dev_features = $acra_bug_ext->device_features;
                $t_dev_features = htmlentities($t_dev_features);
                echo str_replace("\n", "<br>\n", $t_dev_features);
                ?>
            </div>

            <div id="tab6-a" class="ch-hide">
                <?php
                $t_settings_sys = $acra_bug_ext->settings_system;
                $t_settings_sys = htmlentities($t_settings_sys);
                echo str_replace("\n", "<br>\n", $t_settings_sys);
                ?>
            </div>
            <div id="tab7-a" class="ch-hide">
                <?php
                $t_settings_sec = $acra_bug_ext->settings_secure;
                $t_settings_sec = htmlentities($t_settings_sec);
                echo str_replace("\n", "<br>\n", $t_settings_sec);
                ?>
            </div>
            <div id="tab8-a" class="ch-hide">
                <?php
                $t_dumpsys = $acra_bug_ext->dumpsys_meminfo;
                $t_dumpsys = htmlentities($t_dumpsys);
                echo str_replace("\n", "<br>\n", $t_dumpsys);
                ?>
            </div>
            <div id="tab9-a" class="ch-hide">
                <?php
                $t_environment = $acra_bug_ext->environment;
                $t_environment = htmlentities($t_environment);
                echo str_replace("\n", "<br>\n", $t_environment);
                ?>
            </div>
            <div id="tab10-a" class="ch-hide">
                <?php
                $t_shared_pref = $acra_bug_ext->shared_preferences;
                $t_shared_pref = htmlentities($t_shared_pref);
                echo str_replace("\n", "<br>\n", $t_shared_pref);
                ?>
            </div>
            <div id="tab11-a" class="ch-hide">
                <div class="ch-box-warn">
                    <h4>Memory Size(available/total)</h4>
                    <p style="padding-left: 20px;"><?php echo "$acra_bug_ext->available_mem_size / $acra_bug_ext->total_mem_size"; ?></p>
                </div>
                <div class="ch-box-info">
                    <h4>File Path</h4>
                    <p style="padding-left: 20px;"><?php echo $acra_bug_ext->file_path; ?></p>
                </div>
                <?php
                    if( isset($acra_bug_ext->eventslog) && strlen($acra_bug_ext->eventslog)>0 ){
                ?>
                        <div class="ch-box-warn">
                            <h4>Events Log</h4>
                            <p style="padding-left: 20px;"><?php
                                $t_evetnslog = $acra_bug_ext->eventslog;
                                $t_evetnslog = htmlentities($t_evetnslog);
                                echo str_replace("\n", "<br>\n", $t_evetnslog);
                                ?>
                            </p>
                        </div>
                <?php
                    }
                    if( isset($acra_bug_ext->radiolog) && strlen($acra_bug_ext->radiolog)>0 ){
                ?>
                        <div class="ch-box-help">
                            <h4>Radio Log</h4>
                            <p style="padding-left: 20px;"><?php
                                $t_radiolog = $acra_bug_ext->radiolog;
                                $t_radiolog = htmlentities($t_radiolog);
                                echo str_replace("\n", "<br>\n", $t_radiolog);
                                ?>
                            </p>
                        </div>
                <?php
                    }
                    if( isset($acra_bug_ext->is_silent) && strlen($acra_bug_ext->is_silent)>0 ){
                ?>
                    <div class="ch-box-help">
                        <h4>Is Silent</h4>
                        <p style="padding-left: 20px;"><?php
                            $t_silent = $acra_bug_ext->is_silent;
                            $t_silent = htmlentities($t_silent);
                            echo str_replace("\n", "<br>\n", $t_silent);
                            ?>
                        </p>
                    </div>
                <?php
                    }
                    if( isset($acra_bug_ext->dropbox) && strlen($acra_bug_ext->dropbox)>0 ){
                ?>
                    <div class="ch-box-help">
                        <h4>Dropbox</h4>
                        <p style="padding-left: 20px;"><?php
                            $t_dropbox = $acra_bug_ext->dropbox;
                            $t_dropbox = htmlentities($t_dropbox);
                            echo str_replace("\n", "<br>\n", $t_dropbox);
                            ?>
                        </p>
                    </div>
                <?php
                    }
                    if( isset($acra_bug_ext->custom_data) && strlen($acra_bug_ext->custom_data)>0 ){
                ?>
                    <div class="ch-box-help">
                        <h4>Custom data</h4>
                        <p style="padding-left: 20px;"><?php
                            $t_custdata = $acra_bug_ext->custom_data;
                            $t_custdata = htmlentities($t_custdata);
                            echo str_replace("\n", "<br>\n", $t_custdata);
                            ?>
                        </p>
                    </div>
                <?php
                    }
                    if( isset($acra_bug_ext->user_email) && strlen($acra_bug_ext->user_email)>0 && "N/A" !== $acra_bug_ext->user_email ){
                ?>
                    <div class="ch-box-help">
                        <h4>User Email</h4>
                        <p style="padding-left: 20px;"><?php
                            $t_email = $acra_bug_ext->user_email;
                            $t_email = htmlentities($t_email);
                            echo str_replace("\n", "<br>\n", $t_email);
                            ?>
                        </p>
                    </div>
                <?php
                    }
                    if( isset($acra_bug_ext->user_comment) && strlen($acra_bug_ext->user_comment)>0 ){
                ?>
                    <div class="ch-box-help">
                        <h4>User comment</h4>
                        <p style="padding-left: 20px;"><?php
                            $t_comment = $acra_bug_ext->user_comment;
                            $t_comment = htmlentities($t_comment);
                            echo str_replace("\n", "<br>\n", $t_comment);
                            ?>
                        </p>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo plugin_file('jquery.js');?>"></script>
<script src="<?php echo plugin_file('chico.js');?>"></script>
<script>
    // Tabs
    var tabs = $(".YOUR_SELECTOR_Tabs").tabs();
</script>
</body>
</html>