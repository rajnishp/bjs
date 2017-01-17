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
   <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70488081-1', 'auto');
  ga('send', 'pageview');

</script>
   <script>
       window.fbAsyncInit = function() {
           FB.init({
               appId      : '235401549997398',
               xfbml      : true,
               status : true, // check login status
               cookie : true, // enable cookies to allow the server to access the session

               version    : 'v2.8'
           });

           FB.getLoginStatus(function(response) {
               console.log("inside login");
               var data = {title:document.title,url:window.location.href,user_id:"0"}
               console.log("Login status response ",response);
               if (response.status === 'connected') {

                   //alert ("Page Title"+document.title+", page url"+window.location.href +", Your UID is " + response.authResponse.userID);
                   data.user_id = response.authResponse.userID;
                   console.log("fb id: ",response.authResponse.userID);
               }

               console.log(data);
               var xhr = new XMLHttpRequest();
               xhr.open( "POST","http://api.ragnar.shatkonlabs.com/access", true);
               xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

               // send the collected data as JSON
               xhr.send(JSON.stringify(data));

               xhr.onloadend = function () {
                   // done
               }
           });

           FB.api('/me', { locale: 'en_US', fields: 'name, email' },
               function(response) {
                   console.log("me api response",response);
               }

           );


       };

       (function(d, s, id){
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js";
           fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));




   </script>
</body>
</html>