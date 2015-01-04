<?php
/**
 * Created by PhpStorm.
 * User: vbox-win7
 * Date: 2014/12/30
 * Time: 22:07
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <link rel="stylesheet" type="text/css" href="http://localhost/mantis/css/default.css" />
    <script type="text/javascript"><!--
        if(document.layers) {document.write("<style>td{padding:0px;}<\/style>")}
        // --></script>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Cache-Control" content="no-cache" />
    <meta http-equiv="Pragma-directive" content="no-cache" />
    <meta http-equiv="Cache-Directive" content="no-cache" />
    <meta http-equiv="Expires" content="Tue, 30 Dec 2014 14:05:52 GMT" />
    <meta name="robots" content="noindex,follow" />
    <link rel="shortcut icon" href="/mantis/images/favicon.ico" type="image/x-icon" />
    <link rel="search" type="application/opensearchdescription+xml" title="MantisBT: Text Search" href="http://localhost/mantis/browser_search_plugin.php?type=text" />	<link rel="search" type="application/opensearchdescription+xml" title="MantisBT: Issue Id" href="http://localhost/mantis/browser_search_plugin.php?type=id" />	<title>View Issues - MantisBT</title>
    <script type="text/javascript" src="/mantis/javascript/min/common.js"></script>
    <script type="text/javascript">var loading_lang = "Loading...";</script><script type="text/javascript" src="/mantis/javascript/min/ajax.js"></script>
    <meta http-equiv="Refresh" content="1800;URL=http://localhost/mantis/view_all_bug_page.php?page_number=1" />
    <script type="text/javascript" src="/mantis/plugin_file.php?file=jQuery/jquery-min.js"></script><script type="text/javascript">jQuery.noConflict();</script></head>
<body>
<div align="left"><a href="my_view_page.php"><img border="0" alt="MantisBT" src="/mantis/images/mantis_logo.png" /></a></div><table class="hide"><tr><td class="login-info-left">Logged in as: <span class="italic">administrator</span> <span class="small">(administrator)</span></td><td class="login-info-middle"><span class="italic">2014-12-30 15:05 CET</span></td><td class="login-info-right"><a href="http://localhost/mantis/issues_rss.php?username=administrator&amp;key=1f338efa26677d21cbf1111d8f55fd8e&amp;project_id=2"><img src="/mantis/images/rss.png" alt="RSS" style="border-style: none; margin: 5px; vertical-align: middle;" /></a></td></tr></table><table class="width100" cellspacing="0"><tr><td class="menu"><a href="/mantis/my_view_page.php">My View</a> | <a href="/mantis/view_all_bug_page.php">View Issues</a> | <a href="/mantis/bug_report_page.php">Report Issue</a> | <a href="/mantis/changelog_page.php">Change Log</a> | <a href="/mantis/roadmap_page.php">Roadmap</a> | <a href="/mantis/summary_page.php">Summary</a> | <a href="/mantis/manage_overview_page.php">Manage</a> | <a href="/mantis/account_page.php">My Account</a> | <a href="/mantis/logout_page.php">Logout</a></td><td class="menu right nowrap"><form method="post" action="/mantis/jump_to_bug.php"><input type="text" name="bug_id" size="10" class="small" value="Issue #" onfocus="if (this.value == 'Issue #') this.value = ''" onblur="if (this.value == '') this.value = 'Issue #'" />&#160;<input type="submit" class="button-small" value="Jump" />&#160;</form></td></tr></table><div align="right"><small>Recently Visited: <a href="/mantis/view.php?id=17" title="[new] Acra report crash  at cn.emoney.frag.FragStockChoose.initNormalChooser(FragStockChoose.java:207)"><span class="bug_id">0000017</span></a>, <a href="/mantis/view.php?id=14" title="[new] Acra report crash on T-smart T-smart D28X"><span class="bug_id">0000014</span></a>, <a href="/mantis/view.php?id=13" title="[new] Acra report crash on T-smart T-smart D28X"><span class="bug_id">0000013</span></a></small></div><div id="filter_open">
<br />
<form method="post" name="filters_open" id="filters_form_open" action="view_all_set.php?f=3">
    <input type="hidden" name="type" value="1" />
    <input type="hidden" name="page_number" value="1" />
    <input type="hidden" name="view_type" value="simple" />
    <table class="width100" cellspacing="1">


        <tr class="row-category2">
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=reporter_id[]" id="reporter_id_filter">Reporter:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=user_monitor[]" id="user_monitor_filter">Monitored By:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=handler_id[]" id="handler_id_filter">Assigned To:</a>
            </td>
            <td colspan="2" class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_category[]" id="show_category_filter">Category:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_severity[]" id="show_severity_filter">Severity:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_resolution[]" id="show_resolution_filter">Resolution:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_profile[]" id="show_profile_filter">Profile:</a>
            </td>
        </tr>

        <tr class="row-1">
            <td class="small-caption" valign="top" id="reporter_id_filter_target">
                <input type="hidden" name="reporter_id[]" value="0" />any			</td>
            <td class="small-caption" valign="top" id="user_monitor_filter_target">
                <input type="hidden" name="user_monitor[]" value="0" />any			</td>
            <td class="small-caption" valign="top" id="handler_id_filter_target">
                <input type="hidden" name="handler_id[]" value="0" />any			</td>
            <td colspan="2" class="small-caption" valign="top" id="show_category_filter_target">
                <input type="hidden" name="show_category[]" value="0" />any			</td>
            <td class="small-caption" valign="top" id="show_severity_filter_target">
                <input type="hidden" name="show_severity[]" value="0" />any			</td>
            <td class="small-caption" valign="top" id="show_resolution_filter_target">
                <input type="hidden" name="show_resolution[]" value="0" />
                any			</td>
            <td class="small-caption" valign="top" id="show_profile_filter_target">
                <input type="hidden" name="show_profile[]" value="0" />
                any			</td>
        </tr>

        <tr class="row-category2">
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_status[]" id="show_status_filter">Status:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=hide_status[]" id="hide_status_filter">Hide Status:</a>
            </td>
            <td class="small-caption" valign="top">
            </td>
            <td colspan="2" class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_version[]" id="show_version_filter">Product Version:</a>
            </td>
            <td colspan="1" class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=fixed_in_version[]" id="show_fixed_in_version_filter">Fixed in Version:</a>
            </td>
            <td colspan="1" class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=target_version[]" id="show_target_version_filter">Target Version:</a>
            </td>
            <td colspan="1" class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_priority[]" id="show_priority_filter">Priority:</a>
            </td>
        </tr>

        <tr class="row-1">
            <td class="small-caption" valign="top" id="show_status_filter_target">
                <input type="hidden" name="show_status[]" value="0" />any			</td>
            <td class="small-caption" valign="top" id="hide_status_filter_target">
                <input type="hidden" name="hide_status[]" value="-2" />none			</td>
            <td class="small-caption" valign="top"></td>
            <td colspan="2" class="small-caption" valign="top" id="show_version_filter_target">
                <input type="hidden" name="show_version[]" value="0" />any			</td>
            <td colspan="1" class="small-caption" valign="top" id="show_fixed_in_version_filter_target">
                <input type="hidden" name="fixed_in_version[]" value="0" />any			</td>
            <td colspan="1" class="small-caption" valign="top" id="show_target_version_filter_target">
                <input type="hidden" name="target_version[]" value="0" />any				</td>
            <td colspan="1" class="small-caption" valign="top" id="show_priority_filter_target">
                <input type="hidden" name="show_priority[]" value="0" />any	    	</td>

        </tr>

        <tr class="row-category2">
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=per_page" id="per_page_filter">Show:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=view_state" id="view_state_filter">View Status:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=sticky_issues" id="sticky_issues_filter">Show Sticky Issues:</a>
            </td>
            <td class="small-caption" valign="top" colspan="2">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=highlight_changed" id="highlight_changed_filter">Changed(hrs):</a>
            </td>
            <td class="small-caption" valign="top" >
                <a href="view_filters_page.php?for_screen=1&amp;target_field=do_filter_by_date" id="do_filter_by_date_filter">Use Date Filters:</a>
            </td>
            <td class="small-caption" valign="top" colspan="2">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=relationship_type" id="relationship_type_filter">Relationships:</a>
            </td>
        </tr>
        <tr class="row-1">
            <td class="small-caption" valign="top" id="per_page_filter_target">
                50<input type="hidden" name="per_page" value="50" />			</td>
            <td class="small-caption" valign="top" id="view_state_filter_target">
                any<input type="hidden" name="view_state" value="0" />			</td>
            <td class="small-caption" valign="top" id="sticky_issues_filter_target">
                No				<input type="hidden" name="sticky_issues" value="off" />
            </td>
            <td class="small-caption" valign="top" colspan="2" id="highlight_changed_filter_target">
                6<input type="hidden" name="highlight_changed" value="6" />			</td>
            <td class="small-caption" valign="top"  id="do_filter_by_date_filter_target">
                <script type="text/javascript" language="JavaScript">
                    <!--
                    function SwitchDateFields() {
                        // All fields need to be enabled to go back to the script
                        document.filters_open.start_month.disabled = ! document.filters_open.do_filter_by_date.checked;
                        document.filters_open.start_day.disabled = ! document.filters_open.do_filter_by_date.checked;
                        document.filters_open.start_year.disabled = ! document.filters_open.do_filter_by_date.checked;
                        document.filters_open.end_month.disabled = ! document.filters_open.do_filter_by_date.checked;
                        document.filters_open.end_day.disabled = ! document.filters_open.do_filter_by_date.checked;
                        document.filters_open.end_year.disabled = ! document.filters_open.do_filter_by_date.checked;

                        return true;
                    }
                    // -->
                </script>
                No			</td>

            <td class="small-caption" valign="top" colspan="2" id="relationship_type_filter_target">
                <input type="hidden" name="relationship_type" value="-1" /><input type="hidden" name="relationship_bug" value="0" />any			</td>
        </tr>
        <tr class="row-category2">
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=platform" id="platform_filter">Platform:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=os" id="os_filter">OS:</a>
            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=os_build" id="os_build_filter">OS Version:</a>
            </td>
            <td class="small-caption" valign="top" colspan="5">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=tag_string" id="tag_string_filter">Tags:</a>
            </td>
        </tr>
        <tr class="row-1">
            <td class="small-caption" valign="top" id="platform_filter_target">
                <input type="hidden" name="platform[]" value="0" />
                any			</td>
            <td class="small-caption" valign="top" id="os_filter_target">
                <input type="hidden" name="os[]" value="0" />
                any			</td>
            <td class="small-caption" valign="top" id="os_build_filter_target">
                <input type="hidden" name="os_build[]" value="0" />
                any			</td>

            <td class="small-caption" valign="top" id="tag_string_filter_target" colspan="5">
                <input type="hidden" name="tag_string" value="" />			</td>
        </tr>
        <tr class="row-1">
            <td class="small-caption category2" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=note_user_id" id="note_user_id_filter">Note By:</a>
            </td>
            <td class="small-caption" valign="top" id="note_user_id_filter_target">
                <input type="hidden" name="note_user_id[]" value="0" />any            </td>
            <td class="small-caption" valign="top">
                <a href="view_filters_page.php?for_screen=1&amp;target_field=show_sort" id="show_sort_filter">Sort by:</a>
            </td>
            <td class="small-caption" valign="top" id="show_sort_filter_target">
                Updated Descending<input type="hidden" name="sort_0" value="last_updated" /><input type="hidden" name="dir_0" value="DESC" />			</td>
            <td class="small-caption" valign="top" colspan="6">&#160;</td>		</tr>
        <tr class="row-1">
            <td class="small-caption" valign="top"><a href="view_filters_page.php?for_screen=1&amp;target_field=match_type" id="match_type_filter">Match Type:</a></td>
            <td class="small-caption" valign="top" id="match_type_filter_target">
                All Conditions			<input type="hidden" name="match_type" value="0"/>
            </td>
            <td colspan="6">&#160;</td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="" onclick="ToggleDiv( 'filter' ); return false;"
                    ><img border="0" src="images/minus.png" alt="-" /></a>&#160;Search&#160;<input type="text" size="16" name="search" value="" />
                <input type="submit" name="filter" class="button-small" value="Apply Filter" />
            </td>
</form>
<td class="center" colspan="2"> <!-- use this label for padding -->
    <span class="bracket-link">[&#160;<a href="view_all_set.php?type=6&amp;view_type=advanced">Advanced Filters</a>&#160;]</span> <span class="bracket-link">[&#160;<a href="permalink_page.php?url=http%3A%2F%2Flocalhost%2Fmantis%2Fsearch.php%3Fproject_id%3D2%26sticky_issues%3Doff%26sortby%3Dlast_updated%26dir%3DDESC%26hide_status_id%3D-2%26match_type%3D0" target="_blank">Create Permalink</a>&#160;]</span> 			</td>
<td class="right" colspan="4">
    <form method="get" name="reset_query" action="view_all_set.php">
        <input type="hidden" name="type" value="3" />
        <input type="hidden" name="source_query_id" value="-1" />
        <input type="submit" name="reset_query_button" class="button-small" value="Reset Filter" />
    </form>
    <form method="post" name="save_query" action="query_store_page.php">
        <input type="submit" name="save_query_button" class="button-small" value="Save Current Filter" />
    </form>
</td>
</tr>
</table>
</div><div id="filter_closed" class="hidden">
    <br />
    <form method="post" name="filters_closed" id="filters_form_closed" action="view_all_set.php?f=3">
        <input type="hidden" name="type" value="1" />
        <input type="hidden" name="page_number" value="1" />
        <input type="hidden" name="view_type" value="simple" />
        <table class="width100" cellspacing="1">

            <tr>
                <td colspan="2">
                    <a href="" onclick="ToggleDiv( 'filter' ); return false;"
                        ><img border="0" src="images/plus.png" alt="+" /></a>&#160;Search&#160;<input type="text" size="16" name="search" value="" />
                    <input type="submit" name="filter" class="button-small" value="Apply Filter" />
                </td>
    </form>
    <td class="center" colspan="2"> <!-- use this label for padding -->
        <span class="bracket-link">[&#160;<a href="view_all_set.php?type=6&amp;view_type=advanced">Advanced Filters</a>&#160;]</span> <span class="bracket-link">[&#160;<a href="permalink_page.php?url=http%3A%2F%2Flocalhost%2Fmantis%2Fsearch.php%3Fproject_id%3D2%26sticky_issues%3Doff%26sortby%3Dlast_updated%26dir%3DDESC%26hide_status_id%3D-2%26match_type%3D0" target="_blank">Create Permalink</a>&#160;]</span> 			</td>
    <td class="right" colspan="4">
        <form method="get" name="reset_query" action="view_all_set.php">
            <input type="hidden" name="type" value="3" />
            <input type="hidden" name="source_query_id" value="-1" />
            <input type="submit" name="reset_query_button" class="button-small" value="Reset Filter" />
        </form>
        <form method="post" name="save_query" action="query_store_page.php">
            <input type="submit" name="save_query_button" class="button-small" value="Save Current Filter" />
        </form>
    </td>
    </tr>
    </table>
</div>		<script type="text/javascript" language="JavaScript">
    <!--
    var string_loading = 'Loading...';
    // -->
</script>
<script type="text/javascript" src="/mantis/javascript/min/xmlhttprequest.js"></script>
<script type="text/javascript" src="/mantis/javascript/min/addLoadEvent.js"></script>
<script type="text/javascript" src="/mantis/javascript/min/dynamic_filters.js"></script>
<br />
<form name="bug_action" method="get" action="bug_actiongroup_page.php">
    <table id="buglist" class="width100" cellspacing="1">
        <tr>
            <td class="form-title" colspan="11">
		<span class="floatleft">
		Viewing Issues (1 - 5 / 5) </span>

                <span class="floatleft small"> &#160;<span class="bracket-link">[&#160;<a href="print_all_bug_page.php">Print Reports</a>&#160;]</span> &#160;<span class="bracket-link">[&#160;<a href="csv_export.php">CSV Export</a>&#160;]</span> &#160;<span class="bracket-link">[&#160;<a href="excel_xml_export.php">Excel Export</a>&#160;]</span> <span class="bracket-link">[&#160;<a href="/mantis/plugin.php?page=XmlImportExport/export">XML Export</a>&#160;]</span> <span class="bracket-link">[&#160;<a href="/mantis/plugin.php?page=MantisGraph/bug_graph_page.php">Graph</a>&#160;]</span>  </span>

                <span class="floatright small"> </span>
            </td>
        </tr>
        <tr class="row-category">
            <td> &#160; </td><td> &#160; </td><td><a href="view_all_set.php?sort=priority&amp;dir=DESC&amp;type=2">P</a></td><td><a href="view_all_set.php?sort=id&amp;dir=DESC&amp;type=2">ID</a></td><td> # </td>	<td><img src="http://localhost/mantis/images/attachment.png" alt="Attachment count" title="Attachment count" /></td>
            <td><a href="view_all_set.php?sort=category_id&amp;dir=DESC&amp;type=2">Category</a></td><td><a href="view_all_set.php?sort=severity&amp;dir=DESC&amp;type=2">Severity</a></td><td><a href="view_all_set.php?sort=status&amp;dir=DESC&amp;type=2">Status</a></td><td><a href="view_all_set.php?sort=last_updated&amp;dir=ASC&amp;type=2">Updated</a><img src="http://localhost/mantis/images/down.gif" alt="" /></td><td><a href="view_all_set.php?sort=summary&amp;dir=DESC&amp;type=2">Summary</a></td></tr>

        <tr class="spacer">
            <td colspan="11"></td>
        </tr>
        <tr bgcolor="#fcbdbd" border="1" valign="top"><td><input type="checkbox" name="bug_arr[]" value="17" /></td><td><a href="bug_update_page.php?bug_id=17"><img border="0" width="16" height="16" src="http://localhost/mantis/images/update.png" alt="Edit" title="Edit" /></a></td><td><img src="http://localhost/mantis/images/priority_1.gif" alt="" title="high" /></td><td><a href="/mantis/view.php?id=17"><span class="bug_id">0000017</span></a></td><td class="center">&#160;</td><td class="center"> &#160; </td>
            <td class="center">acra report</td><td class="center"><span class="bold">crash</span></td><td class="center"><span class="issue-status" title="open">new</span></td><td class="center"><span class="bold">2014-12-30</span></td><td class="left">Acra report crash  at cn.emoney.frag.FragStockChoose.initNormalChooser(FragStockChoose.java:207)</td></tr><tr bgcolor="#fcbdbd" border="1" valign="top"><td><input type="checkbox" name="bug_arr[]" value="16" /></td><td><a href="bug_update_page.php?bug_id=16"><img border="0" width="16" height="16" src="http://localhost/mantis/images/update.png" alt="Edit" title="Edit" /></a></td><td><img src="http://localhost/mantis/images/priority_1.gif" alt="" title="high" /></td><td><a href="/mantis/view.php?id=16"><span class="bug_id">0000016</span></a></td><td class="center">&#160;</td><td class="center"> &#160; </td>
            <td class="center">acra report</td><td class="center"><span class="bold">crash</span></td><td class="center"><span class="issue-status" title="open">new</span></td><td class="center"><span class="bold">2014-12-30</span></td><td class="left">Acra report crash  </td></tr><tr bgcolor="#fcbdbd" border="1" valign="top"><td><input type="checkbox" name="bug_arr[]" value="15" /></td><td><a href="bug_update_page.php?bug_id=15"><img border="0" width="16" height="16" src="http://localhost/mantis/images/update.png" alt="Edit" title="Edit" /></a></td><td><img src="http://localhost/mantis/images/priority_1.gif" alt="" title="high" /></td><td><a href="/mantis/view.php?id=15"><span class="bug_id">0000015</span></a></td><td class="center">&#160;</td><td class="center"> &#160; </td>
            <td class="center">acra report</td><td class="center"><span class="bold">crash</span></td><td class="center"><span class="issue-status" title="open">new</span></td><td class="center"><span class="bold">2014-12-30</span></td><td class="left">Acra report crash  </td></tr><tr bgcolor="#fcbdbd" border="1" valign="top"><td><input type="checkbox" name="bug_arr[]" value="14" /></td><td><a href="bug_update_page.php?bug_id=14"><img border="0" width="16" height="16" src="http://localhost/mantis/images/update.png" alt="Edit" title="Edit" /></a></td><td><img src="http://localhost/mantis/images/priority_1.gif" alt="" title="high" /></td><td><a href="/mantis/view.php?id=14"><span class="bug_id">0000014</span></a></td><td class="center">&#160;</td><td class="center"> &#160; </td>
            <td class="center">acra report</td><td class="center"><span class="bold">crash</span></td><td class="center"><span class="issue-status" title="open">new</span></td><td class="center"><span class="bold">2014-12-30</span></td><td class="left">Acra report crash on T-smart T-smart D28X</td></tr><tr bgcolor="#fcbdbd" border="1" valign="top"><td><input type="checkbox" name="bug_arr[]" value="13" /></td><td><a href="bug_update_page.php?bug_id=13"><img border="0" width="16" height="16" src="http://localhost/mantis/images/update.png" alt="Edit" title="Edit" /></a></td><td><img src="http://localhost/mantis/images/priority_1.gif" alt="" title="high" /></td><td><a href="/mantis/view.php?id=13"><span class="bug_id">0000013</span></a></td><td class="center">&#160;</td><td class="center"> &#160; </td>
            <td class="center">acra report</td><td class="center"><span class="bold">crash</span></td><td class="center"><span class="issue-status" title="open">new</span></td><td class="center"><span class="bold">2014-12-30</span></td><td class="left">Acra report crash on T-smart T-smart D28X</td></tr>	<tr>
            <td class="left" colspan="11">
			<span class="floatleft">
<input type="checkbox" name="all_bugs" value="all" onclick="checkall('bug_action', this.form.all_bugs.checked)" /><span class="small">Select All</span>			<select name="action">
                    <option value="MOVE">Move</option><option value="COPY">Copy</option><option value="ASSIGN">Assign</option><option value="CLOSE">Close</option><option value="DELETE">Delete</option><option value="RESOLVE">Resolve</option><option value="SET_STICKY">Set/Unset Sticky</option><option value="UP_PRIOR">Update Priority</option><option value="EXT_UPDATE_SEVERITY">Update Severity</option><option value="UP_STATUS">Update Status</option><option value="UP_CATEGORY">Update Category</option><option value="VIEW_STATUS">Update View Status</option><option value="EXT_ADD_NOTE">Add Note</option><option value="EXT_ATTACH_TAGS">Attach Tags</option><option value="UP_FIXED_IN_VERSION">Update Fixed in Version</option><option value="UP_TARGET_VERSION">Update Target Version</option>			</select>
			<input type="submit" class="button" value="OK" />
			</span>
			<span class="floatright small">
							</span>
            </td>
        </tr>
    </table>
</form>

<br /><table class="width100" cellspacing="1"><tr><td class="small-caption" width="14%" bgcolor="#fcbdbd">new</td><td class="small-caption" width="14%" bgcolor="#e3b7eb">feedback</td><td class="small-caption" width="14%" bgcolor="#ffcd85">acknowledged</td><td class="small-caption" width="14%" bgcolor="#fff494">confirmed</td><td class="small-caption" width="14%" bgcolor="#c2dfff">assigned</td><td class="small-caption" width="14%" bgcolor="#d2f5b0">resolved</td><td class="small-caption" width="14%" bgcolor="#c9ccc4">closed</td></tr></table>	<br />
<hr size="1" />
<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr valign="top"><td>	<address>Copyright &copy; 2000 - 2014 MantisBT Team</address>
            <address><a href="mailto:webmaster@example.com">webmaster@example.com</a></address>
        </td><td>
            <div align="right"><a href="http://www.mantisbt.org" title="Free Web Based Bug Tracker"><img src="/mantis/images/mantis_logo.png" width="145" height="50" alt="Powered by Mantis Bugtracker" border="0" /></a></div>
        </td></tr></table>
<script type="text/javascript" src="/mantis/plugin_file.php?file=MantisAcra/fancyBox/fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="/mantis/plugin_file.php?file=MantisAcra/fancyBox/fancybox.css" media="screen" />
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
</body>
</html>
