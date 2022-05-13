<?php
$ywgs_n = "46.378927";
$xwgs_n = "33.536427";
mb_internal_encoding("UTF-8");
$ywgs = mb_substr($ywgs_n,0,8);
$xwgs = mb_substr($xwgs_n,0,8);
echo $ywgs . "<br>";
echo $xwgs;