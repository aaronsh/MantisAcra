<?php
/**
 * Created by PhpStorm.
 * User: wb-liuyuguang
 * Date: 14-8-1
 * Time: 下午4:01
 */

$t_plugin_path = config_get( 'plugin_path' );
require_once( $t_plugin_path . 'MantisAcra' . DIRECTORY_SEPARATOR . 'BugDataAcraExt.php' );
require_once( $t_plugin_path . 'MantisAcra' . DIRECTORY_SEPARATOR . 'VersionAcraExt.php' );
require_once( $t_plugin_path . 'MantisAcra' . DIRECTORY_SEPARATOR . 'ProjectAcraExt.php' );
header('X-Frame-Options:SAMEORIGIN');
?>

<html lang="en" xml:lang="en">
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="txt/html; charset=utf-8" />

    <style type="text/css">

    </style>
    <script src="<?php echo plugin_file('jquery.js');?>"></script>
    <script src="/mantis/plugin_file.php?file=MantisAcra/jquery.js"></script>
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
    $id = gpc_get_string("id");
    $hash = gpc_get_string("hash");
    $acra_bug_ext = acra_get_bug_ext_by_issue_id($id);
    if( $acra_bug_ext->report_fingerprint != $hash ){
        echo '</body></html>';
    }
    $t_bug = bug_get($id);
?>

<div class="ch-box-lite ch-box-error">
    <h2>Bug ID:<?php echo $id; ?></h2>
</div>
<div class="ch-box-lite">
    <h2>Basic Info</h2>
    <div class="ch-box-info">
        <h4>Project:
<?php
    $t_project = project_get_row($t_bug->project_id);
    echo $t_project['name'];
?>
        </h4>
        <div style="padding-left: 10px;">
<?php echo $t_project['description']; ?>
        </div>
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
</div>

<div class="ch-box-container">
    <h2 id="tabs">More</h2>

    <div class="YOUR_SELECTOR_Tabs ch-tabs">
        <ul class="ch-tabs-triggers">
            <li><a href="#tab1-a" class="ch-tab">StackTrace</a></li>
            <li><a href="#tab2-a" class="ch-tab">Logcat</a></li>
            <li><a href="#tab3-a" class="ch-tab">Crash Configuration</a></li>
            <li><a href="#tab4-a" class="ch-tab">Phone Build</a></li>
        </ul>
        <div class="ch-box-lite">
            <div id="tab1-a">
                <?php
                $t_bug_text = bug_get_text_field($id, 'description');
                $t_restore_file = get_restore_file_by_version_name($t_bug->version);
                $t_bug_text = restore_stacktrace_by_file($t_bug_text, $t_restore_file);
                $t_bug_text = htmlentities($t_bug_text);
                $packages = get_project_package_list($t_bug->project_id);
                foreach($packages as $pack=>$len){
                    $reg = str_replace(".", "\\.", $pack);
                    $reg = "/^(\\s+at\\s+)".$reg."(.*)$/m";
                    $t_bug_text = preg_replace($reg, "$1<b>$pack$2</b>", $t_bug_text);
                }
                $t_bug_text = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $t_bug_text);
                echo str_replace("\n", "<br>\n", $t_bug_text);
                ?>
            </div>

            <div id="tab2-a" class="ch-hide">
                <?php
                $t_bug_logcat = bug_get_text_field($id, 'steps_to_reproduce');
                $t_bug_logcat = htmlentities($t_bug_logcat);
                echo str_replace("\n", "<br>\n", $t_bug_logcat);
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
        </div>
    </div>
</div>
<script src="<?php echo plugin_file('chico.js');?>"></script>
<script>
    // Tabs
    var tabs = $(".YOUR_SELECTOR_Tabs").tabs();
</script>
</body>
</html>