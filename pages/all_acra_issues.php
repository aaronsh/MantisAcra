<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    
    <head>
        <link rel="stylesheet" type="text/css" href="http://emoney.6171host.com/mantis/css/default.css"
        />
        <script type="text/javascript">
            < !--
            if (document.layers) {
                document.write("<style>td{padding:0px;}<\/style>")
            }
            // -->
            
        </script>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta http-equiv="Pragma-directive" content="no-cache" />
        <meta http-equiv="Cache-Directive" content="no-cache" />
        <meta http-equiv="Expires" content="Wed, 31 Dec 2014 01:44:36 GMT" />
        <meta name="robots" content="noindex,follow" />
        <link rel="shortcut icon" href="/mantis/images/favicon.ico" type="image/x-icon"
        />
        <link rel="search" type="application/opensearchdescription+xml" title="MantisBT: Text Search"
        href="http://emoney.6171host.com/mantis/browser_search_plugin.php?type=text"
        />
        <link rel="search" type="application/opensearchdescription+xml" title="MantisBT: Issue Id"
        href="http://emoney.6171host.com/mantis/browser_search_plugin.php?type=id"
        />
        <title>
            View Issues - MantisBT
        </title>
        <script type="text/javascript" src="/mantis/javascript/min/common.js">
        </script>
        <script type="text/javascript">
            var loading_lang = "Loading...";
        </script>
        <script type="text/javascript" src="/mantis/javascript/min/ajax.js">
        </script>
        <meta http-equiv="Refresh" content="1800;URL=http://emoney.6171host.com/mantis/view_all_bug_page.php?page_number=1"
        />
        <script type="text/javascript" src="/mantis/plugin_file.php?file=jQuery/jquery-min.js">
        </script>
        <script type="text/javascript">
            jQuery.noConflict();
        </script>
    </head>
    
    <body>
        <div align="left">
            <a href="my_view_page.php">
                <img border="0" alt="MantisBT" src="/mantis/images/mantis_logo.png" />
            </a>
        </div>
        <table class="hide">
            <tr>
                <td class="login-info-left">
                    Logged in as:
                    <span class="italic">
                        administrator
                    </span>
                    <span class="small">
                        (administrator)
                    </span>
                </td>
                <td class="login-info-middle">
                    <span class="italic">
                        2014-12-31 01:44 UTC
                    </span>
                </td>
                <td class="login-info-right">
                    <a href="http://emoney.6171host.com/mantis/issues_rss.php?username=administrator&amp;key=66a830306aa55b819f293ffa4fff2dae&amp;project_id=1">
                        <img src="/mantis/images/rss.png" alt="RSS" style="border-style: none; margin: 5px; vertical-align: middle;"
                        />
                    </a>
                </td>
            </tr>
        </table>
        <table class="width100" cellspacing="0">
            <tr>
                <td class="menu">
                    <a href="/mantis/my_view_page.php">
                        My View
                    </a>
                    |
                    <a href="/mantis/view_all_bug_page.php">
                        View Issues
                    </a>
                    |
                    <a href="/mantis/bug_report_page.php">
                        Report Issue
                    </a>
                    |
                    <a href="/mantis/changelog_page.php">
                        Change Log
                    </a>
                    |
                    <a href="/mantis/roadmap_page.php">
                        Roadmap
                    </a>
                    |
                    <a href="/mantis/summary_page.php">
                        Summary
                    </a>
                    |
                    <a href="/mantis/manage_overview_page.php">
                        Manage
                    </a>
                    |
                    <a href="/mantis/account_page.php">
                        My Account
                    </a>
                    |
                    <a href="/mantis/logout_page.php">
                        Logout
                    </a>
                </td>
                <td class="menu right nowrap">
                    <form method="post" action="/mantis/jump_to_bug.php">
                        <input type="text" name="bug_id" size="10" class="small" value="Issue #"
                        onfocus="if (this.value == 'Issue #') this.value = ''" onblur="if (this.value == '') this.value = 'Issue #'"
                        />
                        &#160;
                        <input type="submit" class="button-small" value="Jump" />
                        &#160;
                    </form>
                </td>
            </tr>
        </table>
        <div align="right">
            <small>
                Recently Visited:
                <a href="/mantis/view.php?id=200" title="[new] Acra report crash on T-smart T-smart D28X">
                    <span class="bug_id">
                        0000200
                    </span>
                </a>
                ,
                <a href="/mantis/view.php?id=176" title="[new] Acra report crash on T-smart T-smart D28X">
                    <span class="bug_id">
                        0000176
                    </span>
                </a>
            </small>
        </div>
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
                                Reporter:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=user_monitor[]"
                            id="user_monitor_filter">
                                Monitored By:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=handler_id[]"
                            id="handler_id_filter">
                                Assigned To:
                            </a>
                        </td>
                        <td colspan="2" class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_category[]"
                            id="show_category_filter">
                                Category:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_severity[]"
                            id="show_severity_filter">
                                Severity:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_resolution[]"
                            id="show_resolution_filter">
                                Resolution:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_profile[]"
                            id="show_profile_filter">
                                Profile:
                            </a>
                        </td>
                    </tr>
                    <tr class="row-1">
                        <td class="small-caption" valign="top" id="reporter_id_filter_target">
                            <input type="hidden" name="reporter_id[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="user_monitor_filter_target">
                            <input type="hidden" name="user_monitor[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="handler_id_filter_target">
                            <input type="hidden" name="handler_id[]" value="0" />
                            any
                        </td>
                        <td colspan="2" class="small-caption" valign="top" id="show_category_filter_target">
                            <input type="hidden" name="show_category[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="show_severity_filter_target">
                            <input type="hidden" name="show_severity[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="show_resolution_filter_target">
                            <input type="hidden" name="show_resolution[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="show_profile_filter_target">
                            <input type="hidden" name="show_profile[]" value="0" />
                            any
                        </td>
                    </tr>
                    <tr class="row-category2">
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_status[]"
                            id="show_status_filter">
                                Status:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=hide_status[]"
                            id="hide_status_filter">
                                Hide Status:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                        </td>
                        <td colspan="2" class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_version[]"
                            id="show_version_filter">
                                Product Version:
                            </a>
                        </td>
                        <td colspan="1" class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=fixed_in_version[]"
                            id="show_fixed_in_version_filter">
                                Fixed in Version:
                            </a>
                        </td>
                        <td colspan="1" class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=target_version[]"
                            id="show_target_version_filter">
                                Target Version:
                            </a>
                        </td>
                        <td colspan="1" class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_priority[]"
                            id="show_priority_filter">
                                Priority:
                            </a>
                        </td>
                    </tr>
                    <tr class="row-1">
                        <td class="small-caption" valign="top" id="show_status_filter_target">
                            <input type="hidden" name="show_status[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="hide_status_filter_target">
                            <input type="hidden" name="hide_status[]" value="-2" />
                            none
                        </td>
                        <td class="small-caption" valign="top">
                        </td>
                        <td colspan="2" class="small-caption" valign="top" id="show_version_filter_target">
                            <input type="hidden" name="show_version[]" value="0" />
                            any
                        </td>
                        <td colspan="1" class="small-caption" valign="top" id="show_fixed_in_version_filter_target">
                            <input type="hidden" name="fixed_in_version[]" value="0" />
                            any
                        </td>
                        <td colspan="1" class="small-caption" valign="top" id="show_target_version_filter_target">
                            <input type="hidden" name="target_version[]" value="0" />
                            any
                        </td>
                        <td colspan="1" class="small-caption" valign="top" id="show_priority_filter_target">
                            <input type="hidden" name="show_priority[]" value="0" />
                            any
                        </td>
                    </tr>
                    <tr class="row-category2">
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=per_page"
                            id="per_page_filter">
                                Show:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=view_state"
                            id="view_state_filter">
                                View Status:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=sticky_issues"
                            id="sticky_issues_filter">
                                Show Sticky Issues:
                            </a>
                        </td>
                        <td class="small-caption" valign="top" colspan="2">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=highlight_changed"
                            id="highlight_changed_filter">
                                Changed(hrs):
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=do_filter_by_date"
                            id="do_filter_by_date_filter">
                                Use Date Filters:
                            </a>
                        </td>
                        <td class="small-caption" valign="top" colspan="2">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=relationship_type"
                            id="relationship_type_filter">
                                Relationships:
                            </a>
                        </td>
                    </tr>
                    <tr class="row-1">
                        <td class="small-caption" valign="top" id="per_page_filter_target">
                            50
                            <input type="hidden" name="per_page" value="50" />
                        </td>
                        <td class="small-caption" valign="top" id="view_state_filter_target">
                            any
                            <input type="hidden" name="view_state" value="0" />
                        </td>
                        <td class="small-caption" valign="top" id="sticky_issues_filter_target">
                            No
                            <input type="hidden" name="sticky_issues" value="off" />
                        </td>
                        <td class="small-caption" valign="top" colspan="2" id="highlight_changed_filter_target">
                            6
                            <input type="hidden" name="highlight_changed" value="6" />
                        </td>
                        <td class="small-caption" valign="top" id="do_filter_by_date_filter_target">
                            <script type="text/javascript" language="JavaScript">
                                < !--
                                function SwitchDateFields() {
                                    // All fields need to be enabled to go back to the script
                                    document.filters_open.start_month.disabled = !document.filters_open.do_filter_by_date.checked;
                                    document.filters_open.start_day.disabled = !document.filters_open.do_filter_by_date.checked;
                                    document.filters_open.start_year.disabled = !document.filters_open.do_filter_by_date.checked;
                                    document.filters_open.end_month.disabled = !document.filters_open.do_filter_by_date.checked;
                                    document.filters_open.end_day.disabled = !document.filters_open.do_filter_by_date.checked;
                                    document.filters_open.end_year.disabled = !document.filters_open.do_filter_by_date.checked;

                                    return true;
                                }
                                // -->
                                
                            </script>
                            No
                        </td>
                        <td class="small-caption" valign="top" colspan="2" id="relationship_type_filter_target">
                            <input type="hidden" name="relationship_type" value="-1" />
                            <input type="hidden" name="relationship_bug" value="0" />
                            any
                        </td>
                    </tr>
                    <tr class="row-category2">
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=platform"
                            id="platform_filter">
                                Platform:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=os" id="os_filter">
                                OS:
                            </a>
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=os_build"
                            id="os_build_filter">
                                OS Version:
                            </a>
                        </td>
                        <td class="small-caption" valign="top" colspan="5">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=tag_string"
                            id="tag_string_filter">
                                Tags:
                            </a>
                        </td>
                    </tr>
                    <tr class="row-1">
                        <td class="small-caption" valign="top" id="platform_filter_target">
                            <input type="hidden" name="platform[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="os_filter_target">
                            <input type="hidden" name="os[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="os_build_filter_target">
                            <input type="hidden" name="os_build[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top" id="tag_string_filter_target" colspan="5">
                            <input type="hidden" name="tag_string" value="" />
                        </td>
                    </tr>
                    <tr class="row-1">
                        <td class="small-caption category2" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=note_user_id"
                            id="note_user_id_filter">
                                Note By:
                            </a>
                        </td>
                        <td class="small-caption" valign="top" id="note_user_id_filter_target">
                            <input type="hidden" name="note_user_id[]" value="0" />
                            any
                        </td>
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=show_sort"
                            id="show_sort_filter">
                                Sort by:
                            </a>
                        </td>
                        <td class="small-caption" valign="top" id="show_sort_filter_target">
                            Updated Descending
                            <input type="hidden" name="sort_0" value="last_updated" />
                            <input type="hidden" name="dir_0" value="DESC" />
                        </td>
                        <td class="small-caption" valign="top" colspan="6">
                            &#160;
                        </td>
                    </tr>
                    <tr class="row-1">
                        <td class="small-caption" valign="top">
                            <a href="view_filters_page.php?for_screen=1&amp;target_field=match_type"
                            id="match_type_filter">
                                Match Type:
                            </a>
                        </td>
                        <td class="small-caption" valign="top" id="match_type_filter_target">
                            All Conditions
                            <input type="hidden" name="match_type" value="0" />
                        </td>
                        <td colspan="6">
                            &#160;
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="" onclick="ToggleDiv( 'filter' ); return false;">
                                <img border="0" src="images/minus.png" alt="-" />
                            </a>
                            &#160;Search&#160;
                            <input type="text" size="16" name="search" value="" />
                            <input type="submit" name="filter" class="button-small" value="Apply Filter"
                            />
                        </td>
            </form>
            <td class="center" colspan="2">
                <!-- use this label for padding -->
                <span class="bracket-link">
                    [&#160;
                    <a href="view_all_set.php?type=6&amp;view_type=advanced">
                        Advanced Filters
                    </a>
                    &#160;]
                </span>
                <span class="bracket-link">
                    [&#160;
                    <a href="permalink_page.php?url=http%3A%2F%2Femoney.6171host.com%2Fmantis%2Fsearch.php%3Fproject_id%3D1%26sticky_issues%3Doff%26sortby%3Dlast_updated%26dir%3DDESC%26hide_status_id%3D-2%26match_type%3D0"
                    target="_blank">
                        Create Permalink
                    </a>
                    &#160;]
                </span>
            </td>
            <td class="right" colspan="4">
                <form method="get" name="reset_query" action="view_all_set.php">
                    <input type="hidden" name="type" value="3" />
                    <input type="hidden" name="source_query_id" value="-1" />
                    <input type="submit" name="reset_query_button" class="button-small" value="Reset Filter"
                    />
                </form>
                <form method="post" name="save_query" action="query_store_page.php">
                    <input type="submit" name="save_query_button" class="button-small" value="Save Current Filter"
                    />
                </form>
            </td>
            </tr>
            </table>
        </div>
        <div id="filter_closed" class="hidden">
            <br />
            <form method="post" name="filters_closed" id="filters_form_closed" action="view_all_set.php?f=3">
                <input type="hidden" name="type" value="1" />
                <input type="hidden" name="page_number" value="1" />
                <input type="hidden" name="view_type" value="simple" />
                <table class="width100" cellspacing="1">
                    <tr>
                        <td colspan="2">
                            <a href="" onclick="ToggleDiv( 'filter' ); return false;">
                                <img border="0" src="images/plus.png" alt="+" />
                            </a>
                            &#160;Search&#160;
                            <input type="text" size="16" name="search" value="" />
                            <input type="submit" name="filter" class="button-small" value="Apply Filter"
                            />
                        </td>
            </form>
            <td class="center" colspan="2">
                <!-- use this label for padding -->
                <span class="bracket-link">
                    [&#160;
                    <a href="view_all_set.php?type=6&amp;view_type=advanced">
                        Advanced Filters
                    </a>
                    &#160;]
                </span>
                <span class="bracket-link">
                    [&#160;
                    <a href="permalink_page.php?url=http%3A%2F%2Femoney.6171host.com%2Fmantis%2Fsearch.php%3Fproject_id%3D1%26sticky_issues%3Doff%26sortby%3Dlast_updated%26dir%3DDESC%26hide_status_id%3D-2%26match_type%3D0"
                    target="_blank">
                        Create Permalink
                    </a>
                    &#160;]
                </span>
            </td>
            <td class="right" colspan="4">
                <form method="get" name="reset_query" action="view_all_set.php">
                    <input type="hidden" name="type" value="3" />
                    <input type="hidden" name="source_query_id" value="-1" />
                    <input type="submit" name="reset_query_button" class="button-small" value="Reset Filter"
                    />
                </form>
                <form method="post" name="save_query" action="query_store_page.php">
                    <input type="submit" name="save_query_button" class="button-small" value="Save Current Filter"
                    />
                </form>
            </td>
            </tr>
            </table>
        </div>
        <script type="text/javascript" language="JavaScript">
            < !--
            var string_loading = 'Loading...';
            // -->
            
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
                            Viewing Issues (1 - 50 / 96)
                        </span>
                        <span class="floatleft small">
                            &#160;
                            <span class="bracket-link">
                                [&#160;
                                <a href="print_all_bug_page.php">
                                    Print Reports
                                </a>
                                &#160;]
                            </span>
                            &#160;
                            <span class="bracket-link">
                                [&#160;
                                <a href="csv_export.php">
                                    CSV Export
                                </a>
                                &#160;]
                            </span>
                            &#160;
                            <span class="bracket-link">
                                [&#160;
                                <a href="excel_xml_export.php">
                                    Excel Export
                                </a>
                                &#160;]
                            </span>
                            <span class="bracket-link">
                                [&#160;
                                <a href="/mantis/plugin.php?page=XmlImportExport/export">
                                    XML Export
                                </a>
                                &#160;]
                            </span>
                            <span class="bracket-link">
                                [&#160;
                                <a href="/mantis/plugin.php?page=MantisGraph/bug_graph_page.php">
                                    Graph
                                </a>
                                &#160;]
                            </span>
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
                        &#160;
                    </td>
                    <td>
                        <a href="view_all_set.php?sort=priority&amp;dir=DESC&amp;type=2">
                            P
                        </a>
                    </td>
                    <td>
                        <a href="view_all_set.php?sort=id&amp;dir=DESC&amp;type=2">
                            ID
                        </a>
                    </td>
                    <td>
                        #
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/attachment.png" alt="Attachment count"
                        title="Attachment count" />
                    </td>
                    <td>
                        <a href="view_all_set.php?sort=category_id&amp;dir=DESC&amp;type=2">
                            Category
                        </a>
                    </td>
                    <td>
                        <a href="view_all_set.php?sort=severity&amp;dir=DESC&amp;type=2">
                            Severity
                        </a>
                    </td>
                    <td>
                        <a href="view_all_set.php?sort=status&amp;amp;dir=DESC&amp;type=2">
                            Status
                        </a>
                    </td>
                    <td>
                        <a href="view_all_set.php?sort=last_updated&amp;dir=ASC&amp;type=2">
                            Updated
                        </a>
                        <img src="http://emoney.6171host.com/mantis/images/down.gif" alt="" />
                    </td>
                    <td>
                        <a href="view_all_set.php?sort=summary&amp;dir=DESC&amp;type=2">
                            Summary
                        </a>
                    </td>
                </tr>
                <tr class="spacer">
                    <td colspan="11">
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="201" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=201">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=201">
                            <span class="bug_id">
                                0000201
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="200" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=200">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=200">
                            <span class="bug_id">
                                0000200
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="199" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=199">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=199">
                            <span class="bug_id">
                                0000199
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="198" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=198">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=198">
                            <span class="bug_id">
                                0000198
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="197" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=197">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=197">
                            <span class="bug_id">
                                0000197
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="196" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=196">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=196">
                            <span class="bug_id">
                                0000196
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="195" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=195">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=195">
                            <span class="bug_id">
                                0000195
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="194" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=194">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=194">
                            <span class="bug_id">
                                0000194
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-30
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="193" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=193">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=193">
                            <span class="bug_id">
                                0000193
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-26
                    </td>
                    <td class="left">
                        Acra report crash on generic Samsung Galaxy S3 - 4.2.2 - API 17 - 720x1280
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="192" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=192">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=192">
                            <span class="bug_id">
                                0000192
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-26
                    </td>
                    <td class="left">
                        Acra report crash on generic Samsung Galaxy S3 - 4.2.2 - API 17 - 720x1280
                    </td>
                </tr>
                <tr bgcolor="#c2dfff" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="191" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=191">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_normal.gif"
                        alt="" title="normal" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=191">
                            <span class="bug_id">
                                0000191
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        minor
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            assigned
                        </span>
                        (
                        <a href="http://emoney.6171host.com/mantis/view_user_page.php?id=1">
                            administrator
                        </a>
                        )
                    </td>
                    <td class="center">
                        2014-12-26
                    </td>
                    <td class="left">
                        hjhhhb
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="190" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=190">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=190">
                            <span class="bug_id">
                                0000190
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="189" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=189">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=189">
                            <span class="bug_id">
                                0000189
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="188" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=188">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=188">
                            <span class="bug_id">
                                0000188
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="187" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=187">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=187">
                            <span class="bug_id">
                                0000187
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="185" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=185">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=185">
                            <span class="bug_id">
                                0000185
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="186" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=186">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=186">
                            <span class="bug_id">
                                0000186
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="184" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=184">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=184">
                            <span class="bug_id">
                                0000184
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="183" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=183">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=183">
                            <span class="bug_id">
                                0000183
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="182" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=182">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=182">
                            <span class="bug_id">
                                0000182
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="181" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=181">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=181">
                            <span class="bug_id">
                                0000181
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="180" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=180">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=180">
                            <span class="bug_id">
                                0000180
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="179" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=179">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=179">
                            <span class="bug_id">
                                0000179
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="178" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=178">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=178">
                            <span class="bug_id">
                                0000178
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="177" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=177">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=177">
                            <span class="bug_id">
                                0000177
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-25
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="176" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=176">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=176">
                            <span class="bug_id">
                                0000176
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="174" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=174">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=174">
                            <span class="bug_id">
                                0000174
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="175" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=175">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=175">
                            <span class="bug_id">
                                0000175
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="173" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=173">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=173">
                            <span class="bug_id">
                                0000173
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="170" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=170">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=170">
                            <span class="bug_id">
                                0000170
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="171" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=171">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=171">
                            <span class="bug_id">
                                0000171
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="172" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=172">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=172">
                            <span class="bug_id">
                                0000172
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="165" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=165">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=165">
                            <span class="bug_id">
                                0000165
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="166" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=166">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=166">
                            <span class="bug_id">
                                0000166
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="167" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=167">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=167">
                            <span class="bug_id">
                                0000167
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="168" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=168">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=168">
                            <span class="bug_id">
                                0000168
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="169" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=169">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=169">
                            <span class="bug_id">
                                0000169
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="159" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=159">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=159">
                            <span class="bug_id">
                                0000159
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="open">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="158" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=158">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=158">
                            <span class="bug_id">
                                0000158
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="160" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=160">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=160">
                            <span class="bug_id">
                                0000160
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="161" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=161">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=161">
                            <span class="bug_id">
                                0000161
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="162" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=162">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=162">
                            <span class="bug_id">
                                0000162
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="163" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=163">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=163">
                            <span class="bug_id">
                                0000163
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="164" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=164">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=164">
                            <span class="bug_id">
                                0000164
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="151" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=151">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=151">
                            <span class="bug_id">
                                0000151
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="152" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=152">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=152">
                            <span class="bug_id">
                                0000152
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="153" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=153">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=153">
                            <span class="bug_id">
                                0000153
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="154" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=154">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=154">
                            <span class="bug_id">
                                0000154
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="155" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=155">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=155">
                            <span class="bug_id">
                                0000155
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr bgcolor="#fcbdbd" border="1" valign="top">
                    <td>
                        <input type="checkbox" name="bug_arr[]" value="156" />
                    </td>
                    <td>
                        <a href="bug_update_page.php?bug_id=156">
                            <img border="0" width="16" height="16" src="http://emoney.6171host.com/mantis/images/update.png"
                            alt="Edit" title="Edit" />
                        </a>
                    </td>
                    <td>
                        <img src="http://emoney.6171host.com/mantis/images/priority_1.gif" alt=""
                        title="high" />
                    </td>
                    <td>
                        <a href="/mantis/view.php?id=156">
                            <span class="bug_id">
                                0000156
                            </span>
                        </a>
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        &#160;
                    </td>
                    <td class="center">
                        acra report
                    </td>
                    <td class="center">
                        <span class="bold">
                            crash
                        </span>
                    </td>
                    <td class="center">
                        <span class="issue-status" title="duplicate">
                            new
                        </span>
                    </td>
                    <td class="center">
                        2014-12-24
                    </td>
                    <td class="left">
                        Acra report crash on T-smart T-smart D28X
                    </td>
                </tr>
                <tr>
                    <td class="left" colspan="11">
                        <span class="floatleft">
                            <input type="checkbox" name="all_bugs" value="all" onclick="checkall('bug_action', this.form.all_bugs.checked)"
                            />
                            <span class="small">
                                Select All
                            </span>
                            <select name="action">
                                <option value="MOVE">
                                    Move
                                </option>
                                <option value="COPY">
                                    Copy
                                </option>
                                <option value="ASSIGN">
                                    Assign
                                </option>
                                <option value="CLOSE">
                                    Close
                                </option>
                                <option value="DELETE">
                                    Delete
                                </option>
                                <option value="RESOLVE">
                                    Resolve
                                </option>
                                <option value="SET_STICKY">
                                    Set/Unset Sticky
                                </option>
                                <option value="UP_PRIOR">
                                    Update Priority
                                </option>
                                <option value="EXT_UPDATE_SEVERITY">
                                    Update Severity
                                </option>
                                <option value="UP_STATUS">
                                    Update Status
                                </option>
                                <option value="UP_CATEGORY">
                                    Update Category
                                </option>
                                <option value="VIEW_STATUS">
                                    Update View Status
                                </option>
                                <option value="EXT_ADD_NOTE">
                                    Add Note
                                </option>
                                <option value="EXT_ATTACH_TAGS">
                                    Attach Tags
                                </option>
                                <option value="UP_FIXED_IN_VERSION">
                                    Update Fixed in Version
                                </option>
                                <option value="UP_TARGET_VERSION">
                                    Update Target Version
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
        <br />
        <table class="width100" cellspacing="1">
            <tr>
                <td class="small-caption" width="14%" bgcolor="#fcbdbd">
                    new
                </td>
                <td class="small-caption" width="14%" bgcolor="#e3b7eb">
                    feedback
                </td>
                <td class="small-caption" width="14%" bgcolor="#ffcd85">
                    acknowledged
                </td>
                <td class="small-caption" width="14%" bgcolor="#fff494">
                    confirmed
                </td>
                <td class="small-caption" width="14%" bgcolor="#c2dfff">
                    assigned
                </td>
                <td class="small-caption" width="14%" bgcolor="#d2f5b0">
                    resolved
                </td>
                <td class="small-caption" width="14%" bgcolor="#c9ccc4">
                    closed
                </td>
            </tr>
        </table>
        <br />
        <hr size="1" />
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr valign="top">
                <td>
                    <address>
                        Copyright &copy; 2000 - 2014 MantisBT Team
                    </address>
                    <address>
                        <a href="mailto:webmaster@example.com">
                            webmaster@example.com
                        </a>
                    </address>
                </td>
                <td>
                    <div align="right">
                        <a href="http://www.mantisbt.org" title="Free Web Based Bug Tracker">
                            <img src="/mantis/images/mantis_logo.png" width="145" height="50" alt="Powered by Mantis Bugtracker"
                            border="0" />
                        </a>
                    </div>
                </td>
            </tr>
        </table>
        <script type="text/javascript" src="/mantis/plugin_file.php?file=MantisAcra/fancyBox/fancybox.js">
        </script>
        <link rel="stylesheet" type="text/css" href="/mantis/plugin_file.php?file=MantisAcra/fancyBox/fancybox.css"
        media="screen" />
        <style type="text/css">
            .acra_popup{ width:800px; height:400px; display: none; padding: 0px; }
            .acra_frame{ width:100%; height:100%; }
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
                success: function(data) {
                    try {
                        data = JSON.parse(data);

                        for (var i = 0; i < data.length; i++) {
                            if (data[i].id == ids[i]) {
                                jQuery(bugs[i].parentElement.parentElement).append(data[i].txt);
                                jQuery('#acra_dialog').append(data[i].popup);
                            }
                            jQuery('.fancybox').fancybox();
                        }
                    } catch(ex) {
                        console.log(ex);
                    }
                    console.log(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        </script>
        <div id="acra_dialog" style="display:none;">
        </div>
    </body>
</html>