<?php
require("acra_filter_api.php");
$t_plugin_path = config_get( 'plugin_path' );
if( isset($_GET['acra_id']) ){
    require_once( $t_plugin_path . 'MantisAcra' . DIRECTORY_SEPARATOR . 'BugDataAcraExt.php' );
    $_GET['acra_hash'] = acra_get_fingerprint_by_bug_id($_GET['acra_id']);
}

function getFilterQueryString(){
    $where = "";
    $android = getFilterValue("android");
    if( strlen($android) > 0 ){
        $where = '`android_version`="'.mysql_real_escape_string($android).'" ';
    }

    $brand = getFilterValue("brand");
    if( strlen($brand) > 0 ){
        if( strlen($where) > 0 ){
            $where = $where.' AND '.'`phone_brand`="'.mysql_real_escape_string($brand).'" ';
        }
        else{
            $where = $where.'`phone_brand`="'.mysql_real_escape_string($brand).'" ';
        }
    }


    $model = getFilterValue("model");
    if( strlen($model) > 0 ){
        if( strlen($where) > 0 ){
            $where = $where.' AND '.'`phone_model`="'.mysql_real_escape_string($model).'" ';
        }
        else{
            $where = '`phone_model`="'.mysql_real_escape_string($model).'" ';
        }
    }

    if( strlen($where) > 0 ){
        $where = " AND ".$where;
    }
    return $where;
}

function getAcraIssueCount(){
    $acra_id = $_GET['acra_hash'];
    $t_acra_issue_table = plugin_table("issue");
    $where = getFilterQueryString();
    $query = "SELECT count(*) FROM $t_acra_issue_table WHERE `report_fingerprint`='".$acra_id."'".$where;
    $result = db_query_bound($query);
    $result = db_fetch_array($result);
    return (int)$result['count(*)'];
}

function buildPageQueryString($page_num, $total_count){
    $start = ($page_num -1)*50;
    $size = $total_count - $start;
    if( $size > 50 ){
        $size = 50;
    }
    return ' LIMIT '.$start.','.$size;
}

function buildOrderString(){
    if( isset($_GET['key']) ){
        $key = $_GET['key'];
    }
    else{
        $key = 'id';
    }
    if( isset($_GET['dir']) ) {
        $direction = $_GET['dir'];
    }
    else{
        $direction = "DESC";
    }
    $order = "ORDER BY `$key` $direction";
    return $order;
}

function getAcraIssueList()
{
    $t_acra_issue_table = plugin_table("issue");

    $query = "SELECT * FROM $t_acra_issue_table WHERE `custom_data` REGEXP 'url'  ORDER BY `id` DESC";
    $result = db_query_bound($query);
    $list = array();
    while (true) {
        $row = db_fetch_array($result);
        if ($row === false) {
            break;
        }
        $list[] = $row;
    }
    return $list;
}

function get_url_base(){
    $request_url = $_SERVER['REQUEST_URI'];
    $parts = explode("?", $request_url);
    $request_url = $parts[0].'?acra_page=test.php&acra_hash='.$_GET['acra_hash'];
    return $request_url;
}

function html_page_indicator($page_num, $total_count){

}

$acra_tbl_title_url = "";

function html_tble_title( $word, $key){
    $order = "DESC";
    $cur_key = 'id';
    if( isset($_GET['key']) ) {
        $cur_key = $_GET['key'];
    }

    $cur_order = "DESC";
    if( isset($_GET['dir']) ) {
        $cur_order = $_GET['dir'];
    }


    if( strcmp($key, $cur_key) == 0){
        if( strcmp($cur_order, "DESC") == 0 ){
                    $order = "ASC";
        }
        else{
            $order = "DESC";
        }
    }


    $url = "index.php?acra_page=test.php&acra_hash=".$_GET['acra_hash'].'&p=1&key='.$key.'&dir='.$order;
    echo '<a href="';
    echo $url;
    echo '">';
    echo $word;
    echo "</a>";
    if( isset($_GET['key']) && strcmp($_GET['key'], $key) == 0 ) {
        if( strcmp("DESC", $order) ) {
            echo '<img src="images/down.gif" alt="">';
        }
        else{
            echo '<img src="images/up.gif" alt="">';
        }
    }
}

//set filter
if( !isset($_REQUEST['p']) && !isset($_REQUEST['filter']) ){
    $_SESSION['acra_filter'] = null;
}
if( isset($_REQUEST['filter']) ){
    $_SESSION['acra_filter'] = json_decode($_REQUEST['filter']);
}
if( isset($_SESSION['acra_filter']) ){
    set_acra_filter($_SESSION['acra_filter']);
}
else{
    set_acra_filter(null);
}

if( !isset($_GET['p']) ){
    $acra_issue_count = getAcraIssueCount();
    $_SESSION['$acra_issue_count'] = $acra_issue_count;
    $acra_issue_page = 1;
}
else{
    $acra_issue_count = $_SESSION['$acra_issue_count'];
    $acra_issue_page = $_GET['p'];
}

$acra_issues = getAcraIssueList($acra_issue_page, $acra_issue_count);

html_page_top1( lang_get( 'view_bugs_link' ) );

html_page_top2();
?>



<?php
html_javascript_link( 'xmlhttprequest.js');
html_javascript_link( 'addLoadEvent.js');
html_javascript_link( 'dynamic_filters.js');
?>
    <br />

    <form name="bug_action" method="get" action="bug_actiongroup_page.php">
    <table id="buglist" class="width100" cellspacing="1">
    <tr>
        <td class="form-title" colspan="11">
                        <span class="floatleft">
<?php

    echo 'Viewing Http Issues';
?>
                        </span>
                        <span class="floatleft small">
                            &#160;
                        </span>
                        <?php html_page_indicator($acra_issue_page, $acra_issue_count); ?>
        </td>
    </tr>
    <tr class="row-category">
        <td>
            &#160;
        </td>
        <td>ID</td>
        <td>Phone</td>
        <td>Model</td>
        <td>Crash Date</td>
        <td>Summary</td>
    </tr>
    <tr class="spacer">
        <td colspan="11">
        </td>
    </tr>
    <?php $img = plugin_file( 'acra_logo.png' );?>
    <?php foreach( $acra_issues as $issue){?>
    <tr bgcolor="#fcbdbd" border="1" valign="top">
        <td>
            <input type="checkbox" name="bug_arr[]" value="201" />
        </td>
        <td><?php echo $issue['id']; ?>&nbsp;<a class="fancybox" href="#acra_<?php echo sprintf("%06d", $issue['id']);?>" "><img border="0" width="18" height="16" src="<?php echo $img;?>" alt="Acra" title="Acra"></a></td>
        <td><?php echo $issue['phone_brand'].'/'.$issue['phone_model']; ?></td>
        <td><?php echo $issue['android_version']; ?></td>
        <td class="center"><?php echo $issue['crash_date']; ?></td>
        <td >
            <?php
            $t_cust_data = $issue['custom_data'];
            $t_cust_line = explode("\n", $t_cust_data);
            $t_bug = bug_get($issue['issue_id']);
            echo '<div onclick="toggleMore(this)">';
            echo $t_bug->summary;
            echo '<br>';
            echo $t_cust_line[0];
            echo '</div>';
            echo '<div style="display: none;">';
            echo '<div style="word-break: break-all;">';
            echo str_replace("\n", "<br>", $t_cust_data);
            echo '</div>';
            echo '<div>';
            echo str_replace("\n", "<br>",htmlentities($t_bug->description));
            echo '</div>';
            echo '</div>';
            ?>
        </td>
    </tr>
    <?php } ?>


    <tr>
        <td class="left" colspan="11">
                        <span class="floatleft">
                            <input type="checkbox" name="all_bugs" value="all" onclick="checkall('bug_action', this.form.all_bugs.checked)"
                                />
                            <span class="small">
                                Select All
                            </span>
                            <select name="action">
                                <option value="DELETE">
                                    Delete
                                </option>
                            </select>
                            <input type="submit" class="button" value="OK" />
                        </span>
                        <?php html_page_indicator($acra_issue_page, $acra_issue_count); ?>
        </td>
    </tr>
    </table>
    </form>
    <div id="acra_dialog" style="display:none;">
<?php foreach( $acra_issues as $issue){?>
        <div class="acra_popup" id="acra_<?php echo sprintf("%06d", $issue['id']);?>" style="display: none;">
            <iframe class="acra_frame" src="index.php?acra_page=detail.php&acra_id=<?php echo $issue['id']; ?>">
            </iframe>
        </div>
<?php } ?>
    </div>
<script>
    function toggleMore(summary){
        detail = summary.nextElementSibling;
        if( detail.style.display == 'none' ){
            detail.style.display = 'block';
        }
        else{
            detail.style.display = 'none';
        }
    }
</script>
<?php

html_page_bottom();
?>