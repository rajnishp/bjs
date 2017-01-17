<?php
	$url = "https://blueteam.in/sp_api/cities";
    $cities = $services = json_decode(httpGet($url), true)['cities'];
    $data = "<div class='container'>
    			<div class='row'>
                <div class='col-md-12'>
                <ul class='list-inline' style='margin:5px;'>";
    foreach ($services as $key => $value) {
        $data .="<li style='min-width: 180px;padding:5px;margin:2px;'><a href='http://blueteam.in/directory/index.php?city=".$value['id']."' style='text-decoration: none;color: #fff;padding:2px;'>".$value['name']."</a></li>";
    }
    $data = $data."</ul>    	
                    <center>  <p>All rights reserved &copy; <a href='http://shatkonlabs.com' class='yellow-color' title='Shatkon Labs' target='_blank'>Shatkon Labs&trade;</a></p>
                    <span class='footer-date highlight red'>2014</span></center>
                </div>
            </div>
        </div>";
    echo $data;
?>