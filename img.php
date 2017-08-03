<?php
/**
 * <img src=img.php>
 * <img src=img.php?folder=images/>
**/

$folder = $_GET['folder'] ? $_GET['folder'] : '/img/'; // 存放图片文件的位置
$path = $_SERVER['DOCUMENT_ROOT']."/".$folder;
$files = array();
if ($handle = opendir("$path")) {
  while (false !== ($file = readdir($handle))) {
    if ($file != "." && $file != "..") {
      if (substr($file, -3) == 'gif' || substr($file, -3) == 'jpg' || substr($file, -3) == 'png') {
        $files[count($files)] = $file;
      }
    }
  }
}
closedir($handle);

$random = rand(0, count($files) - 1);

if (substr($files[$random], -3) == 'gif') {
  header("Content-type: image/gif");
} elseif (substr($files[$random], -3) == 'jpg') {
  header("Content-type: image/jpeg");
} elseif (substr($files[$random], -3) == 'png') {
  header("Content-type: image/png");
}
readfile("$path/$files[$random]");
