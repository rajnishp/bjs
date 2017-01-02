<?php

function httpGet($url){
    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    $output=curl_exec($ch);

    curl_close($ch);
    return $output;
}
if(isset($_GET['city']) && isset($_GET['area'])){
    $url = "https://blueteam.in/sp_api/services?type=geo&area_id=".$_GET['area'];
    $services = json_decode(httpGet($url), true)['services'];
    $data = "<ul class='list-inline'>";
    foreach ($services as $key => $value) {
        $data .="<li><a href='http://blueteam.in/service/index.php?load=".$value['service']."-".$value['service_id']."&l=".$value['lat'].",".$value['lng']."' class='btn btn-primary'>".$value['service']."</a></li>";
    }
    $data = $data."</ul>";
}
elseif(isset($_GET['city']) && !(isset($_GET['area']))){
    $url = "https://blueteam.in/sp_api/cities/".$_GET['city']."/areas";
    $areas = $services = json_decode(httpGet($url), true)['areas'];
    $data = "<ul class='list-inline'>";
    foreach ($services as $key => $value) {
        $data .="<li><a href='index.php?city=".$_GET['city']."&area=".$value['id']."' class='btn btn-primary'>".$value['name']."</a></li>";
    }
    $data = $data."</ul>";
}
else {
    $url = "https://blueteam.in/sp_api/cities";
    $cities = $services = json_decode(httpGet($url), true)['cities'];
    $data = "<ul class='list-inline'>";
    foreach ($services as $key => $value) {
        $data .="<li><a href='index.php?city=".$value['id']."' class='btn btn-primary'>".$value['name']."</a></li>";
    }
    $data = $data."</ul>";
}
?>
<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">

    <title>BlueTeam | Awesome Hiring Services, Hire maid, cook, baby sitter, electrician, plumber, security guard, driver, gardener at Affordable price.</title>

    <!-- for Google -->
    <meta name="description" content="Hire high skilled, Background verified, experienced and certified professional services like maid, cook, electrician, plumber, baby sitter, gardener and more at affordable price." />
    <meta name="keywords" content="Awesome hiring services, Hire, hire cook, hire maid, hire electrician, hire plumber, gurgaon, hire cook in gurgaon, blueteam, hire security guard" />
    <meta name="author" content="BlueTeam" />
    <meta name="copyright" content="true" />
    <meta name="application-name" content="website" />

    <!-- for Facebook -->
    <meta property="og:title" content="BlueTeam | Awesome Hiring Services, Hire maid, cook, baby sitter, electrician, plumber, security guard, driver, gardener at Affordable price." />
    <meta name="og:author" content="BlueTeam" />
    <meta property="og:type" content="website"/>

    <meta name="p:domain_verify" content=""/>
    <meta property="og:image:type" content="image/jpeg" />

    <meta property="og:description" content="Hire high skilled, Background verified, experienced and certified professional services like maid, cook, electrician, plumber, baby sitter, gardener and more at affordable price." />

    <!-- for Twitter -->
    <!-- <meta name="twitter:card" content="n/a" /> -->
    <meta name="twitter:site" content="@hireblueteam">
    <meta name="twitter:creator" content="@hireblueteam">
    <meta name="twitter:title" content="BlueTeam | Awesome Hiring Services, Hire maid, cook, baby sitter, electrician, plumber, security guard, driver, gardener at Affordable price." />
    <meta name="twitter:description" content="Hire high skilled, Background verified, experienced and certified professional services like maid, cook, electrician, plumber, baby sitter, gardener and more at affordable price." />
    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        .list-inline{padding-left:0;margin:15px;list-style:none}.list-inline>li{display:inline-block;min-width: 250px;padding:5px;margin:10px;}a{text-decoration: none;background-color: #4080ff;color: #fff;padding:5px;     }
    </style>
</head>
<body>
   <?php echo $data ;?> 
</body>
</html>