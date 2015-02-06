function acra_toggleRestoredDiv(block){
    var nodeList = block.getElementsByTagName('i');
    var showBlock = true;
    var nodeIcon = nodeList[0];
    if( nodeIcon.getAttribute('class') == 'ch-icon-zoom-out' ){
        showBlock = false;
    }

    nodeList = block.getElementsByTagName('span');
    var nodeToggleText = nodeList[0];
    if( showBlock ){
        nodeIcon.setAttribute("class", 'ch-icon-zoom-out');
        nodeToggleText.innerText = "Hide restored messages"
    }
    else{
        nodeIcon.setAttribute("class", 'ch-icon-zoom-in');
        nodeToggleText.innerText = "Show restored messages"
    }
    block.getElementsByTagName('span')
    var restoreList = block.parentElement.getElementsByClassName('ch-box-lite');
    for(var i=0; i<restoreList.length; i++){
        var restoreNode = restoreList[i];
        if( showBlock ) {
            restoreNode.style.display = 'block';
        }
        else{
            restoreNode.style.display = 'none';
        }
    }
}

function acra_handleParams(params){
    var paramList = params.split(",");
    var refined = "";
    for(var i=0; i<paramList.length; i++){
        if( refined.length > 0 ){
            refined = refined + '<span style="color:red;">, </span>';
        }
        var param = paramList[i];
        var nameParts = param.split(".");
        refined = refined + nameParts[nameParts.length -1];
    }
    return refined;
}

function acra_highlight_by_package(line, packages){
    var matches = line.match(/\s+at\s+([^(]+)(\(.+\))?/);
    if( matches == null ){
        return line;
    }
    var method = matches[1];
    for(var i=0; i<packages.length; i++){
        var len = packages[i].length;
        if( len >= method ){
            continue;
        }
        var pkg = method.substring(0, len);
        if( pkg == packages[i]){
            method = "<b>" + method + "</b>";
            break;
        }
    }
    if( matches[2] != undefined ){
        method = method + matches[2];
    }

    return "<span>at "+method+"<span>";
}

function acra_buildStacktraceDiv(stacktrace, packages){
    var html = "<div style=\"padding:10px;\">";
    html = html + '<div class="ch-box-icon ch-box-warn" onclick="acra_toggleRestoredDiv(this); "> <i class="ch-icon-zoom-in"></i><span>Show restore message</span></div>';
    var lines = stacktrace.split("\n");
    for(var i=0; i<lines.length; i++){
        var restore = "";
        var line = lines[i];
        if( line.indexOf('{') >= 0 ){
            var matches = line.match(/([^{]+){([^\}]+)}(.*)/);
            if( matches != null){
                line = matches[1] + matches[3];
                restore = matches[2];
            }
        }
        line = acra_highlight_by_package(line, packages);
        line = line.replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;");
        html = html + line;
        html = html + "<br>";
        if( restore.length > 0 ){
            html = html + "<div class=\"ch-box-lite\" style=\"margin-left: 35px; display: none;\">";
            var restore_lines = restore.split(";");
            for(var j=0; j<restore_lines.length; j++){
                var restore_line = restore_lines[j];
                var restore_parts = restore_line.match(/([^(]+)\(([^)]*)\)(.*)/);
                var fullName = restore_parts[1];
                var partsOfName = fullName.split('.');
                var shortName = partsOfName[partsOfName.length -1];
                fullName = fullName.replace(shortName, "<b>"+shortName+"</b>");;
                var method = acra_handleParams(restore_parts[3]) + " " + fullName + "<b>(</b>" +acra_handleParams(restore_parts[2]) + "<b>)</b>";
                html = html + method;
                html = html + "<br>";
            }
            html = html + "</div>";
        }
    }
    html = html + "</div>"
    return html;
}

