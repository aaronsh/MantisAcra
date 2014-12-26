<?php
# MantisBT - a php based bugtracking system
# Copyright (C) 2002 - 2014  MantisBT Team - mantisbt-dev@lists.sourceforge.net
# MantisBT is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 2 of the License, or
# (at your option) any later version.
#
# MantisBT is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with MantisBT.  If not, see <http://www.gnu.org/licenses/>.

$t_plugin_path = config_get( 'plugin_path' );
require_once( $t_plugin_path . 'MantisAcra' . DIRECTORY_SEPARATOR . 'BugDataAcraExt.php' );


//echo $t_ids = gpc_get_string('data');
//echo $t_ids;
//echo json_encode($_REQUEST);
$ids = json_decode(gpc_get_string('data'));
$objs = array();

$img = plugin_file( 'acra_logo.png' );
$link = "index.php?acra_page=brief.php";//plugin_page("brief.php");
foreach($ids as $id){
    $id = trim($id);
    $acra_bug_ext = acra_get_bug_ext_by_issue_id($id);
    if( $acra_bug_ext !== false ){
        $objs[] = array("id"=>$id, "txt"=>'&nbsp;<a class="fancybox" href="#acra_'.$id.'" "><img border="0" width="18" height="16" src="'.$img.'" alt="Acra" title="Acra"></a>',
            "popup"=>'<div class="acra_popup" id="acra_'.$id.'" ><iframe class="acra_frame" src="'.$link."&id=$id&hash=$acra_bug_ext->report_fingerprint".'"  ></iframe></div>');
    }
    else{
        $objs[] = array("id"=>$id, "txt"=>"");
    }
}

echo json_encode($objs);