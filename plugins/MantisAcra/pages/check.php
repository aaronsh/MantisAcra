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

auth_reauthenticate( );

//echo $t_ids = gpc_get_string('data');
//echo $t_ids;
//echo json_encode($_REQUEST);
$ids = json_decode(gpc_get_string('data'));
$objs = array();

$img = plugin_file( 'acra.jpg' );
$link = plugin_page("shortcut");
foreach($ids as $id){
    $t_is_acra_report = acra_check_by_bug_id($id);
    if( $t_is_acra_report ){
        $objs[] = array("id"=>$id, "txt"=>'&nbsp;<a id="acra_shortcut" link="plugin.php?page='.$link.'&id='.$id.'" onclick="openAcraBox(this);"><img border="0" width="16" height="16" src="'.$img.'" alt="Acra" title="Acra"></a>');
    }
    else{
        $objs[] = array("id"=>$id, "txt"=>"");
    }
}

echo json_encode($objs);