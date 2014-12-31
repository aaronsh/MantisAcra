<?php
require("acra_filter_api.php");

function getAcraIssueList()
{
    $t_acra_issue_table = plugin_table("issue");
    $query = "SELECT * FROM $t_acra_issue_table ";
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

$acra_issues = getAcraIssueList();

html_page_top1( lang_get( 'view_bugs_link' ) );

html_page_top2();
?>
    <div id="filter_open">
        <br />
        <form method="post" name="filters_open" id="filters_form_open" action="view_all_set.php?f=3">
            <input type="hidden" name="type" value="1" />
            <input type="hidden" name="page_number" value="1" />
            <input type="hidden" name="view_type" value="simple" />
            <table class="width100" cellspacing="1">
                <tr class="row-category2">
                    <td class="small-caption" valign="top">
                        <a href="view_filters_page.php?for_screen=1&amp;target_field=reporter_id[]"
                           id="reporter_id_filter">
                            Android:
                        </a>
                    </td>
                    <td class="small-caption" valign="top">
                        <a href="view_filters_page.php?for_screen=1&amp;target_field=user_monitor[]"
                           id="user_monitor_filter">
                            Brand:
                        </a>
                    </td>
                    <td class="small-caption" valign="top">
                        <a href="view_filters_page.php?for_screen=1&amp;target_field=handler_id[]"
                           id="handler_id_filter">
                            Model:
                        </a>
                    </td>
                    <td colspan="2" class="small-caption" valign="top">
                    </td>
                    <td class="small-caption" valign="top">
                    </td>
                    <td class="small-caption" valign="top">
                    </td>
                    <td class="small-caption" valign="top">
                    </td>
                </tr>
                <tr class="row-1">
                    <td class="small-caption" valign="top" id="reporter_id_filter_target">
                        <select id="android" name="andriod" onchange="onFilterChanged(this)">
                        </select>
                    </td>
                    <td class="small-caption" valign="top" id="user_monitor_filter_target">
                        <select id="brand" name="brand" onchange="onFilterChanged(this)">
                        </select>
                    </td>
                    <td class="small-caption" valign="top" id="handler_id_filter_target">
                        <select id="model" name="model" onchange="onFilterChanged(this)">
                        </select>
                    </td>
                    <td colspan="2" class="small-caption" valign="top" id="show_category_filter_target">

                    </td>
                    <td class="small-caption" valign="top" id="show_severity_filter_target">

                    </td>
                    <td class="small-caption" valign="top" id="show_resolution_filter_target">

                    </td>
                    <td class="small-caption" valign="top" id="show_profile_filter_target">

                    </td>
                </tr>
                <tr>
                    <td colspan="1">
                        <input type="submit" name="filter" class="button-small" value="Apply Filter"/>
                    </td>
        </form>
        <td colspan="3">
            <button type="button" onclick = "resetFilter();">Reset Filter</button>
        </td>
        <td class="right" colspan="4">

        </td>
        </tr>
        </table>
    </div>

    <script type="text/javascript" language="JavaScript">
        var filter_default_values = <?php outputDefaultFilterData(); ?>;
        function init_filters(filter_data){
            for(var i=0; i<filter_data.length; i++ ){
                var id = filter_data[i].id
                var select = document.getElementById(id);
                select.options.length=0;
                for(var index=0; index<filter_data[i].list.length; index++){
                    select.options.add(new Option(filter_data[i].list[index],filter_data[i].list[index]));
                }
                select.selectedIndex = filter_data[i].selected;
            }
        }
        init_filters(filter_default_values);

        function onFilterChanged(select){
            var filters = [{'id':'android', 'value':''}, {'id':'brand', 'value':''}, {'id':'model', 'value':''}];
            for(var i=0; i<filters.length; i++){
                var e = document.getElementById(filters[i].id);
                filters[i].value = e.value;
            }

            jQuery.ajax({
                type: "post",
                url: "index.php?acra_page=filter.php",
                dataType: "text",
                data:'data='+JSON.stringify(filters)+'&sender='+select.id,
                success: function (data) {
                    try{
                        data = JSON.parse(data);
                        init_filters(data);
                        console.log(data);
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

        function resetFilter(){
            jQuery.ajax({
                type: "post",
                url: "index.php?acra_page=filter.php",
                dataType: "text",
                data:"sender=reset",
                success: function (data) {
                    try{
                        data = JSON.parse(data);
                        init_filters(data);
                        console.log(data);
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
    <script type="text/javascript" src="/mantis/javascript/min/xmlhttprequest.js">
    </script>
    <script type="text/javascript" src="/mantis/javascript/min/addLoadEvent.js">
    </script>
    <script type="text/javascript" src="/mantis/javascript/min/dynamic_filters.js">
    </script>
    <br />

    <form name="bug_action" method="get" action="bug_actiongroup_page.php">
    <table id="buglist" class="width100" cellspacing="1">
    <tr>
        <td class="form-title" colspan="11">
                        <span class="floatleft">
                            Viewing ACRA Issues (1 - 50 / 96)
                        </span>
                        <span class="floatleft small">
                            &#160;
                        </span>
                        <span class="floatright small">
                            [ First&#160;Prev&#160;1&#160;
                            <a href="view_all_bug_page.php?filter=36&page_number=2">
                                2
                            </a>
                            &#160;
                            <a href="view_all_bug_page.php?filter=36&amp;page_number=2">
                                Next
                            </a>
                            &#160;
                            <a href="view_all_bug_page.php?filter=36&amp;page_number=2">
                                Last
                            </a>
                            ]
                        </span>
        </td>
    </tr>
    <tr class="row-category">
        <td>
            &#160;
        </td>
        <td>
            <a href="view_all_set.php?sort=priority&amp;dir=DESC&amp;type=2">
                ID
            </a>
        </td>
        <td>
            <a href="view_all_set.php?sort=priority&amp;dir=DESC&amp;type=2">
                Brand
            </a>
        </td>
        <td>
            <a href="view_all_set.php?sort=id&amp;dir=DESC&amp;type=2">
                Android
            </a>
        </td>
        <td>
            <a href="view_all_set.php?sort=id&amp;dir=DESC&amp;type=2">
                Model
            </a>
        </td>
        <td>
            <a href="view_all_set.php?sort=id&amp;dir=DESC&amp;type=2">
                Crash Date
            </a>
        </td>
        <td>Report Id</td>
        <td>Installation Id</td>
        <td>Start Date</td>
        <td>Product</td>
        <td>Memory</td>
    </tr>
    <tr class="spacer">
        <td colspan="11">
        </td>
    </tr>
    <?php foreach( $acra_issues as $issue){?>
    <tr bgcolor="#fcbdbd" border="1" valign="top">
        <td>
            <input type="checkbox" name="bug_arr[]" value="201" />
        </td>
        <td>
            <a href="bug_update_page.php?bug_id=201">
                <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                     alt="Edit" title="Edit" />
            </a>
            <?php echo $issue['id']; ?>
        </td>
        <td><?php echo $issue['phone_brand']; ?></td>
        <td><?php echo $issue['android_version']; ?></td>
        <td class="center"><?php echo $issue['phone_model']; ?></td>
        <td class="center"><?php echo 'crash date'; ?></td>
        <td class="center"><?php echo $issue['report_id']; ?></td>
        <td class="center"><?php echo $issue['installation_id']; ?></td>
        <td class="center"><?php echo 'startDate'; ?></td>
        <td class="center"><?php echo $issue['product_name']; ?></td>
        <td class="left"><?php echo $issue['available_mem_size'].'/'.$issue['total_mem_size']; ?></td>
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
                        <span class="floatright small">
                            [ First&#160;Prev&#160;1&#160;
                            <a href="view_all_bug_page.php?filter=36&page_number=2">
                                2
                            </a>
                            &#160;
                            <a href="view_all_bug_page.php?filter=36&amp;page_number=2">
                                Next
                            </a>
                            &#160;
                            <a href="view_all_bug_page.php?filter=36&amp;page_number=2">
                                Last
                            </a>
                            ]
                        </span>
        </td>
    </tr>
    </table>
    </form>
<?php

html_page_bottom();
?>