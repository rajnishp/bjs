<?php

	$db_handle = mysqli_connect("localhost","root","redhat111111","bluenethack");

//Check connection
	if (mysqli_connect_errno()) {
	  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	if (isset($_POST['Send'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$testamonial = $_POST['testamonial'];
		$target_dir = "/var/www/html/shatkonLabs/bjs/src/static/images/testimonials/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 5000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} 
		else {	
			$temp = explode(".", $_FILES["fileToUpload"]["name"]);
			$newfilename = $name. '.' .$temp[1];
			if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "/var/www/html/shatkonLabs/bjs/src/static/images/testimonials/".$newfilename)){
				$sql = mysqli_query ($db_handle, "INSERT INTO teastamonials (name, email, testamonial) VALUES ('$name','$email','$testamonial');");		
			}
			else {
				echo "Sorry, your photo was not uploaded.<br/> Please try again";
			}
		}
	}
		
?>
<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9"> <![endif]-->
<!--[if !IE]><!--><html lang="en"> <!--<![endif]-->
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
    <meta property="og:image" content='static/images/logo.png' />
    <meta property="og:url" content="" />
    <meta property="og:image:type" content="image/jpeg" />

    <meta property="og:description" content="Hire high skilled, Background verified, experienced and certified professional services like maid, cook, electrician, plumber, baby sitter, gardener and more at affordable price." />

    <!-- for Twitter -->          
    <!-- <meta name="twitter:card" content="n/a" /> -->
    <meta name="twitter:site" content="@hireblueteam">
    <meta name="twitter:creator" content="@hireblueteam">
    <meta name="twitter:url" content="" />
    <meta name="twitter:title" content="BlueTeam | Awesome Hiring Services, Hire maid, cook, baby sitter, electrician, plumber, security guard, driver, gardener at Affordable price." />
    <meta name="twitter:description" content="Hire high skilled, Background verified, experienced and certified professional services like maid, cook, electrician, plumber, baby sitter, gardener and more at affordable price." />
    <meta name="twitter:image" content="static/images/logo.png" />
    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="static/css/fonts.css">
    <link rel="stylesheet" href="static/css/bootstrap.min.css">
       <!--  <link rel="stylesheet" href="static/css/font-awesome.min.css">
   --> 
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

   <link rel="stylesheet" href="static/css/animate.css">
   <link rel="stylesheet" href="static/css/revslider2.css">
   <link rel="stylesheet" href="static/css/style.css">
   <link rel="stylesheet" href="static/css/responsive.css">

   <!-- Favicons -->
   <link rel="apple-touch-icon" sizes="57x57" href="static/images/fevicon/apple-icon-57x57.png">
   <link rel="apple-touch-icon" sizes="60x60" href="static/images/fevicon/apple-icon-60x60.png">
   <link rel="apple-touch-icon" sizes="72x72" href="static/images/fevicon/apple-icon-72x72.png">
   <link rel="apple-touch-icon" sizes="76x76" href="static/images/fevicon/apple-icon-76x76.png">
   <link rel="apple-touch-icon" sizes="114x114" href="static/images/fevicon/apple-icon-114x114.png">
   <link rel="apple-touch-icon" sizes="120x120" href="static/images/fevicon/apple-icon-120x120.png">
   <link rel="apple-touch-icon" sizes="144x144" href="static/images/fevicon/apple-icon-144x144.png">
   <link rel="apple-touch-icon" sizes="152x152" href="static/images/fevicon/apple-icon-152x152.png">
   <link rel="apple-touch-icon" sizes="180x180" href="static/images/fevicon/apple-icon-180x180.png">
   <link rel="icon" type="image/png" sizes="192x192"  href="static/images/fevicon/android-icon-192x192.png">
   <link rel="icon" type="image/png" sizes="32x32" href="static/images/fevicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="96x96" href="static/images/fevicon/favicon-96x96.png">
   <link rel="icon" type="image/png" sizes="16x16" href="static/images/fevicon/favicon-16x16.png">
   <link rel="manifest" href="static/images/fevicon/manifest.json">
   <meta name="msapplication-TileColor" content="#ffffff">
   <meta name="msapplication-TileImage" content="static/images/fevicon/ms-icon-144x144.png">
   <meta name="theme-color" content="#ffffff">

   <!--- jQuery -->
   <script src="static/js/jquery.min.js"></script>

   <!-- Queryloader -->
   <script src="static/js/queryloader2.min.js"></script>
<?php /*
   <!-- Modernizr -->
   <script src="static/js/modernizr.js"></script>
*/?>

</head>
<body data-spy="scroll" data-target="#main-menu">
    <div class="geass-loader-overlay left"></div><!-- End .geass-loader-overlay left -->
    <div class="geass-loader-overlay right"></div><!-- End .geass-loader-overlay right -->
    <div id="wrapper">


        <?php //include_once 'views/navbar/navbar.php'; ?>
<section id="contactus" class="section">
        <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-10 col-md-push-2 col-sm-push-1">
                            <h2 class="h3 text-center lg-margin">Give your valuable feedback</h2>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text"  name="name" required class="form-control input-lg">
                                    <span class="animated-label">Your Name *</span>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <input type="email"  name="email" required class="form-control input-lg">
                                    <span class="animated-label">Your Email *</span>
                                </div><!-- End .form-group -->
                                
                                <div class="form-group">
                                    <textarea name="testamonial" class="form-control input-lg" cols="30" rows="7"></textarea>
                                    <span class="animated-label textarea-label">Your Feedback *</span>
                                </div><!-- End .form-group -->
                                <div class="form-group">
									<input type="file" name="fileToUpload" id="fileToUpload" required class="form-control input-lg">
									<span class="animated-label">Upload your photo *</span>
                                </div>
                                <div class="form-group text-center">
                                    <input type="submit" class="btn btn-lightblue btn-lg" name="Send" value="Send">
                                </div><!-- End .form-group -->
                            </form>
                        </div><!-- End .col-md-8 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </section>

            <footer id="footer" class="parallax" data-stellar-background-ratio="0.15">
                <div class="overlaybg overlay-pattern1"></div><!-- End .section-overlay -->
                <div class="section-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="#home" class="footer-logo" title="BlueTeam | Hire now"><img src="static/images/logo.png" width="210" alt="BlueTeam"></a>
                            </div><!-- End .col-md-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->

                    <div class="fb-like" data-href="https://www.facebook.com/blueteam.in" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>

                    <div class="footer-social-icons transparent">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="social-icons-container">
                                        <li><a href="https://www.facebook.com/blueteam.in" class="facebook add-tooltip" data-placement="top" data-toggle="tooltip" target="_blank" title="Follow us on Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/hireblueteam" class="twitter add-tooltip" data-placement="top" data-toggle="tooltip" target="_blank" title="Follow us on Twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="googleplus add-tooltip" data-placement="top" data-toggle="tooltip" target="_blank" title="Follow us on Google +"><i class="fa fa-google-plus"></i></a></li>
                                        <!-- <li><a href="index14.html#" class="dribbble add-tooltip" data-placement="top" data-toggle="tooltip" title="Find us at Dribbble"><i class="fa fa-dribbble"></i></a></li>
                                        <li><a href="index14.html#" class="tumblr add-tooltip" data-placement="top" data-toggle="tooltip" title="Find us at Tumblr"><i class="fa fa-tumblr"></i></a></li>
                                        <li><a href="index14.html#" class="flickr add-tooltip" data-placement="top" data-toggle="tooltip" title="Find us at Flickr"><i class="fa fa-flickr"></i></a></li> -->
                                    </ul>
                                </div><!-- End .col-md-12 -->
                            </div><!-- End .row -->
                        </div><!-- End .container -->
                    </div><!-- End .footer-social-icons -->

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <p>All rights reserved &copy; <a href="http://shatkonlabs.com" class="yellow-color" title="Shatkon Labs" target="_blank">Shatkon Labs&trade;</a></p>
                                <span class="footer-date highlight red">2014</span>
                            </div><!-- End .col-md-12 -->
                        </div><!-- End .row -->
                    </div><!-- End .container -->
                </div><!-- End .section-content -->
            </footer>
            
        </div><!-- End #wrapper -->


<a href="#" data-target="#modal_get_in_touch_success" data-toggle="modal" title="Thanks for your interest"></a>

<div class="modal fade modal-styled" id="modal_get_in_touch_success">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-body" id="modal_result_show">
            <span>
                <div  style='margin-top: 10px; color: rgb(46, 19, 19); margin-bottom: 10px; padding-top: 10px; padding-bottom: 10px'>
                    <p> <h4 align='center'> <b>Thank you <span id="get_in_touch_contact_name" style="color: #1ba7de"></span></b><br /> <br />
                        Our team will contact you in next 24 hours.<br>
                    </h4>
                    <h6  align='center'>Your message has been recieved to us.<br/><br/>
                        <i class="fa fa-whatsapp"></i> or
                        <i class="fa fa-phone"></i>
                        <b style="font-size: 18px; color: #1ba7de">   blueteamContactNumber ?> </b>
                    </h6>
                </p>        
            </div>
        </span>
    </div>

    <!--Modal footer-->
    <div class="modal-footer">
      <button data-dismiss="modal" class="btn btn-default" type="button"  id="close_modal">Close</button>
  </div>
</div>
</div>
</div>

<?php //include_once 'views/footer/footer.php'; ?>        


</body>
</html>

