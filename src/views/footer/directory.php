<?php
	$url = "https://blueteam.in/sp_api/cities";
    $cities = $services = json_decode(httpGet($url), true)['cities'];
    $data = "<ul class='list-inline' style='margin:5px;'>";
    foreach ($services as $key => $value) {
        $data .="<li style='min-width: 180px;padding:2px;margin:2px;'><a href='http://blueteam.in/directory/index.php?city=".$value['id']."' style='ext-decoration: none;background-color: #0ab9ec;color: #fff;padding:2px;'>".$value['name']."</a></li>";
    }
    $data = $data."</ul>";
    echo $data;
?>