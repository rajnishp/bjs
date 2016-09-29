<?php 
  $db_handle = mysqli_connect("localhost","root","redhat@11111p","bluenethack");

//Check connection
  if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  if (isset($_POST['Send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $testamonial = $_POST['testamonial'];
    $target_dir = "/var/www/html/blueteam/prod/bjs/src/static/images/testimonials/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    /*// Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }*/
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
      echo '<script type="text/javascript">alert("Sorry, your file is too large.");</script>';
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo '<script type="text/javascript">alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
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
      if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "/var/www/html/blueteam/prod/bjs/src/static/images/testimonials/".$newfilename)){
        $sql = mysqli_query ($db_handle, "INSERT INTO teastamonials (name, email, testamonial,image) VALUES ('$name','$email','$testamonial','$newfilename');");
        echo '<script type="text/javascript">alert("Thank you for your valuable Feedback");</script>';
        header("refresh:1; home");   
      }
      else {
        echo '<script type="text/javascript">alert("Sorry, your photo was not uploaded.\n Please try again");</script>';
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
    <meta property="og:image" content='<?= $this-> baseUrl ?>static/images/logo.png' />
    <meta property="og:url" content="<?= $this-> baseUrl ?>" />
    <meta property="og:image:type" content="image/jpeg" />

    <meta property="og:description" content="Hire high skilled, Background verified, experienced and certified professional services like maid, cook, electrician, plumber, baby sitter, gardener and more at affordable price." />

    <!-- for Twitter -->          
    <!-- <meta name="twitter:card" content="n/a" /> -->
    <meta name="twitter:site" content="@hireblueteam">
    <meta name="twitter:creator" content="@hireblueteam">
    <meta name="twitter:url" content="<?= $this-> baseUrl ?>" />
    <meta name="twitter:title" content="BlueTeam | Awesome Hiring Services, Hire maid, cook, baby sitter, electrician, plumber, security guard, driver, gardener at Affordable price." />
    <meta name="twitter:description" content="Hire high skilled, Background verified, experienced and certified professional services like maid, cook, electrician, plumber, baby sitter, gardener and more at affordable price." />
    <meta name="twitter:image" content="<?= $this-> baseUrl ?>static/images/logo.png" />
    <!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/fonts.css">
    <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/bootstrap.min.css">
       <!--  <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/font-awesome.min.css">
   --> 
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

   <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/animate.css">
   <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/revslider2.css">
   <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/style.css">
   <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/responsive.css">

   <!-- Favicons -->
   <link rel="apple-touch-icon" sizes="57x57" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-57x57.png">
   <link rel="apple-touch-icon" sizes="60x60" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-60x60.png">
   <link rel="apple-touch-icon" sizes="72x72" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-72x72.png">
   <link rel="apple-touch-icon" sizes="76x76" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-76x76.png">
   <link rel="apple-touch-icon" sizes="114x114" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-114x114.png">
   <link rel="apple-touch-icon" sizes="120x120" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-120x120.png">
   <link rel="apple-touch-icon" sizes="144x144" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-144x144.png">
   <link rel="apple-touch-icon" sizes="152x152" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-152x152.png">
   <link rel="apple-touch-icon" sizes="180x180" href="<?= $this-> baseUrl ?>static/images/fevicon/apple-icon-180x180.png">
   <link rel="icon" type="image/png" sizes="192x192"  href="<?= $this-> baseUrl ?>static/images/fevicon/android-icon-192x192.png">
   <link rel="icon" type="image/png" sizes="32x32" href="<?= $this-> baseUrl ?>static/images/fevicon/favicon-32x32.png">
   <link rel="icon" type="image/png" sizes="96x96" href="<?= $this-> baseUrl ?>static/images/fevicon/favicon-96x96.png">
   <link rel="icon" type="image/png" sizes="16x16" href="<?= $this-> baseUrl ?>static/images/fevicon/favicon-16x16.png">
   <link rel="manifest" href="<?= $this-> baseUrl ?>static/images/fevicon/manifest.json">
   <meta name="msapplication-TileColor" content="#ffffff">
   <meta name="msapplication-TileImage" content="<?= $this-> baseUrl ?>static/images/fevicon/ms-icon-144x144.png">
   <meta name="theme-color" content="#ffffff">

   <!--- jQuery -->
   <script src="<?= $this-> baseUrl ?>static/js/jquery.min.js"></script>

   <!-- Queryloader -->
   <script src="<?= $this-> baseUrl ?>static/js/queryloader2.min.js"></script>
<?php /*
   <!-- Modernizr -->
   <script src="<?= $this-> baseUrl ?>static/js/modernizr.js"></script>
*/?>

</head>
<body data-spy="scroll" data-target="#main-menu">
    <div class="geass-loader-overlay left"></div><!-- End .geass-loader-overlay left -->
    <div class="geass-loader-overlay right"></div><!-- End .geass-loader-overlay right -->
    <div id="wrapper">
    <?php include_once 'views/navbar/navbar.php'; ?>
    <section id="contactus" class="section">
      <div class="container">
                 <div class="row">
                    <div class="col-md-8 col-sm-10 col-md-push-2 col-sm-push-1">
                        <h2 class="h3 text-center lg-margin">Give your valuable feedback</h2>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                Your Name *
                                <input type="text"  name="name" required class="form-control input-lg">
                            </div><!-- End .form-group -->

                            <div class="form-group">
                                Your Email *
                                <input type="email"  name="email" required class="form-control input-lg">
                            </div><!-- End .form-group -->
                            
                            <div class="form-group">
                                Your Feedback *
                                <textarea name="testamonial" class="form-control input-lg" cols="30" rows="7"></textarea>
                            </div><!-- End .form-group -->
                            <div class="form-group">
                                Upload your photo *
                                <input type="file" name="fileToUpload" id="fileToUpload" required class="form-control input-lg">
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

</div>
</div>

<?php include_once 'views/footer/footer.php'; ?>        


</body>
</html>
