<?php
			include "simple_html_dom.php";
			include "base.php";
			include "functions.php";
			$rss_in = "";
			$category = "";
			$site_title = "";
			deleteFeedHistory($link,$category,$site_title);
			$rss = simplexml_load_file($rss_in);
			insertMainBase($rss, $site_title, $date_today, $link, $category);
			?>