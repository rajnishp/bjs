<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index, follow">
        <title>Blue Team </title>
        <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/css.css" type="text/css">
        <!-- Essential styles -->
        <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/font-awesome.css" type="text/css"> 

        <!-- Blue Team styles -->
        <link id="theme_style" type="text/css" href="<?= $this-> baseUrl ?>static/css/style1.css" rel="stylesheet" media="screen">


        <!-- Favicon -->
        <link href="#" rel="icon" type="image/png">

        <!-- Assets -->
        <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/owl.css">
        <link rel="stylesheet" href="<?= $this-> baseUrl ?>static/css/owl_002.css">

        <!-- JS Library -->
        <script src="<?= $this-> baseUrl ?>static/js/jquery_002.js"></script>

    </head>
    <body>
        <div class="wrapper">
            <header class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container">
                    <div class="navbar-header">
                        <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="<?= $this -> baseUrl ?>" class="navbar-brand"><span class="logo"><i class="fa fa-recycle"></i> Blue Team</span></a>
                    </div>

                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="new-ads">
                                <i class="fa fa-whatsapp icon-blue"></i> or 
                                <i class="fa fa-phone icon-blue"></i>
                                <b>@ +91 - 8901414422 </b>
                            </li>
                            <!-- <li><a href="http://themes.gie-art.com/Blue Team/signup.html">Signup</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><strong class="caret"></strong>&nbsp;Pages</a>
                                <ul class="dropdown-menu">
                                    <li><a href="http://themes.gie-art.com/Blue Team/account_posts.html">My Ads</a></li>
                                    <li><a href="http://themes.gie-art.com/Blue Team/account_create_post.html">Create Ads</a></li>
                                    <li><a href="http://themes.gie-art.com/Blue Team/account_profile.html">My Profile</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i class="fa fa-user"></i> <strong class="caret"></strong>&nbsp;</a>
                                <div class="dropdown-menu dropdown-login" style="padding:15px;min-width:250px">
                                    <form>                       
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon addon-login"><i class="fa fa-user"></i></span>
                                                <input placeholder="Username or email" required="required" class="form-control input-login" type="text">                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon addon-login"><i class="addon fa fa-lock"></i></span>
                                                <input placeholder="Password" required="required" class="form-control input-login" type="password">                                            
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label class="string optional" for="user_remember_me">
                                                    <input id="user_remember_me" style="" type="checkbox">
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                        <input class="btn btn-custom btn-block" value="Sign In" type="submit">
                                        <a href="http://themes.gie-art.com/Blue Team/forgot_password.html" class="btn-block text-center">Forgot password?</a>
                                    </form>                                    
                                </div>
                            </li> -->

                        </ul>
                    </div>
                </div>
            </header>
            <section class="hero" style="padding-top: 0px; padding-bottom: 20px;">
                <div class="container text-center">
                    
                    <h2 class="hero-title">Hire Now</h2>
                   
                    <p class="hero-description hidden-xs">High skilled, Background verified, experienced and certified professional.</p>
                    <!-- <div class="row hero-search-box">
                        <form>
                            <div class="col-md-4 col-sm-4 search-input">
                                <input class="form-control input-lg search-first" placeholder="I'm feeling lucky..." type="text">
                            </div>
                            <div class="col-md-4 col-sm-4 search-input">
                                        <select class="form-control input-lg search-second">
                                            <option selected="selected">All Location</option>
                                            <option>New York</option>
                                            <option>Washington</option>
                                            <option>California</option>
                                        </select>
                            </div>
                            <div class="col-md-4 col-sm-4 search-input">
                                <button class="btn btn-custom btn-block btn-lg"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div> -->
                    <div class="row">
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-car shortcut-icon icon-blue"></i> -->
                                    <img class="service-request-image" src="<?= $this-> baseUrl ?>static/images/images.jpeg" >
                                    <h3>Maid</h3>
                                </a>
                                <!-- <span class="total-items">234,567</span> -->
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-motorcycle shortcut-icon icon-green"></i> -->
                                    <img class="service-request-image" src="<?= $this-> baseUrl ?>static/images/cook.jpeg">
                                    <h3>Cook</h3>
                                </a>
                                <!-- <span class="total-items">25,366</span> -->
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-home shortcut-icon icon-brown"></i> -->
                                    <img class="service-request-image" src="<?= $this-> baseUrl ?>static/images/electrician.jpeg">
                                    <h3>Electrician</h3>
                                </a>
                                <!-- <span class="total-items">252,546</span> -->
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-female shortcut-icon icon-violet"></i> -->
                                    <img class="service-request-image" src="<?= $this-> baseUrl ?>static/images/plumber.jpeg">
                                    <h3>Plumber</h3>
                                </a>
                               <!--  <span class="total-items">52,546</span> -->
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-mobile-phone shortcut-icon icon-dark-blue"></i> -->
                                    <img class="service-request-image" src="<?= $this-> baseUrl ?>static/images/babysitter.jpeg">
                                    <h3>Baby Sitter</h3>
                                </a>
                                <!-- <span class="total-items">215,546</span> -->
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-soccer-ball-o shortcut-icon icon-orange"></i> -->
                                    <img class="service-request-image" src="<?= $this-> baseUrl ?>static/images/securitygard.jpeg">
                                    <h3>Security Guard</h3>
                                </a>
                                <!-- <span class="total-items">415,546</span> -->
                            </div>  
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-gears shortcut-icon icon-light-blue"></i> -->
                                    <img  class="service-request-image" src="<?= $this-> baseUrl ?>static/images/driver.png">
                                    <h3>Driver</h3>
                                </a>
                                <!-- <span class="total-items">15,546</span> -->
                            </div>  
                        </div>
                        <div class="col-xs-4 col-sm-3">
                            <div class="shortcut">
                                <a href="#" data-target="#service_request" data-toggle="modal">
                                    <!-- <i class="fa fa-wrench shortcut-icon icon-light-green"></i> -->
                                    <img class="service-request-image" src="<?= $this-> baseUrl ?>static/images/gadener.jpeg">
                                    <h3>Gardner</h3>
                                </a>
                                <!-- <span class="total-items">152,546</span> -->
                            </div>  
                        </div>
                    </div>
                </div>
            </section>
            <!-- <section class="main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <div class="row">
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-car shortcut-icon icon-blue"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Car</h3></a>
                                        <span class="total-items">234,567</span>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-motorcycle shortcut-icon icon-green"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Motorcycle</h3></a>
                                        <span class="total-items">25,366</span>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-home shortcut-icon icon-brown"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Property</h3></a>
                                        <span class="total-items">252,546</span>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-female shortcut-icon icon-violet"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Fashion</h3></a>
                                        <span class="total-items">52,546</span>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-mobile-phone shortcut-icon icon-dark-blue"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Gadget</h3></a>
                                        <span class="total-items">215,546</span>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-soccer-ball-o shortcut-icon icon-orange"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Sport</h3></a>
                                        <span class="total-items">415,546</span>
                                    </div>  
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-gears shortcut-icon icon-light-blue"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Industry</h3></a>
                                        <span class="total-items">15,546</span>
                                    </div>  
                                </div>
                                <div class="col-xs-4 col-sm-3">
                                    <div class="shortcut">
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-wrench shortcut-icon icon-light-green"></i></a>
                                        <a href="http://themes.gie-art.com/Blue Team/category.html"><h3>Job</h3></a>
                                        <span class="total-items">152,546</span>
                                    </div>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-header">
                                        <h2>Featured</h2>
                                    </div>
                                    <div style="opacity: 1; display: block;" id="featured-products" class="owl-carousel owl-carousel-featured owl-theme">
                                        <div class="owl-wrapper-outer"><div style="width: 2500px; left: 0px; display: block; transition: all 1000ms ease 0s; transform: translate3d(0px, 0px, 0px);" class="owl-wrapper"><div style="width: 250px;" class="owl-item"><div class="item">
                                            <div class="item-ads-grid">
                                                <div class="item-badge-grid featured-ads">
                                                    <a href="#">Featured Ads</a>
                                                </div>
                                                <div class="item-img-grid">
                                                    <img alt="" src="Blue Team%20-%20General%20Listing%20Template_files/product-1.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="http://themes.gie-art.com/Blue Team/detail.html"><h4>Lenovo A326 Black 4GB RAM</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="http://themes.gie-art.com/Blue Team/category.html">Electronics</a> , <a href="http://themes.gie-art.com/Blue Team/category.html">Smartphone</a></li>
                                                        <li class="item-location"><a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="http://themes.gie-art.com/Blue Team/detail.html" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div></div><div style="width: 250px;" class="owl-item"><div class="item">
                                            <div class="item-ads-grid">
                                                <div class="item-badge-grid premium-ads">
                                                    <a href="#">Featured Ads</a>
                                                </div>
                                                <div class="item-img-grid">
                                                    <img alt="" src="Blue Team%20-%20General%20Listing%20Template_files/product-6.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="http://themes.gie-art.com/Blue Team/detail.html"><h4>Samsung Tab 3 V 116</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="http://themes.gie-art.com/Blue Team/category.html">Electronics</a> , <a href="http://themes.gie-art.com/Blue Team/category.html">Smartphone</a></li>
                                                        <li class="item-location"><a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="http://themes.gie-art.com/Blue Team/detail.html" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div style="width: 250px;" class="owl-item"><div class="item">
                                            <div class="item-ads-grid highlight-ads">
                                                <div class="item-img-grid">
                                                    <img alt="" src="Blue Team%20-%20General%20Listing%20Template_files/product-7.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="http://themes.gie-art.com/Blue Team/detail.html"><h4>Sony Experia Z2 LTE</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="http://themes.gie-art.com/Blue Team/category.html">Electronics</a> , <a href="http://themes.gie-art.com/Blue Team/category.html">Smartphone</a></li>
                                                        <li class="item-location"><a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="http://themes.gie-art.com/Blue Team/detail.html" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div style="width: 250px;" class="owl-item"><div class="item">
                                            <div class="item-ads-grid">
                                                <div class="item-badge-grid hot-ads">
                                                    <a href="#">Featured Ads</a>
                                                </div>
                                                <div class="item-img-grid">
                                                    <img alt="" src="Blue Team%20-%20General%20Listing%20Template_files/product-1.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="http://themes.gie-art.com/Blue Team/detail.html"><h4>Lenovo A326 Black 4GB RAM</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="http://themes.gie-art.com/Blue Team/category.html">Electronics</a> , <a href="http://themes.gie-art.com/Blue Team/category.html">Smartphone</a></li>
                                                        <li class="item-location"><a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="http://themes.gie-art.com/Blue Team/detail.html" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div style="width: 250px;" class="owl-item"><div class="item">
                                            <div class="item-ads-grid">
                                                <div class="item-badge-grid featured-ads">
                                                    <a href="#">Featured Ads</a>
                                                </div>
                                                <div class="item-img-grid">
                                                    <img alt="" src="Blue Team%20-%20General%20Listing%20Template_files/product-1.jpg" class="img-responsive img-center">
                                                </div>
                                                <div class="item-title">
                                                    <a href="http://themes.gie-art.com/Blue Team/detail.html"><h4>Lenovo A326 Black 4GB RAM</h4></a>
                                                </div>
                                                <div class="item-meta">
                                                    <ul>
                                                        <li class="item-date"><i class="fa fa-clock-o"></i> Today 10.35 am</li>
                                                        <li class="item-cat"><i class="fa fa-bars"></i> <a href="http://themes.gie-art.com/Blue Team/category.html">Electronics</a> , <a href="http://themes.gie-art.com/Blue Team/category.html">Smartphone</a></li>
                                                        <li class="item-location"><a href="http://themes.gie-art.com/Blue Team/category.html"><i class="fa fa-map-marker"></i> Manchester</a></li>
                                                        <li class="item-type"><i class="fa fa-bookmark"></i> New</li>
                                                    </ul>
                                                </div>
                                                <div class="product-footer">
                                                    <div class="item-price-grid pull-left">
                                                        <h3>$ 100</h3>
                                                        <span>Negotiable</span>
                                                    </div>
                                                    <div class="item-action-grid pull-right">
                                                        <ul>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="top" title="Save Favorite" class="btn btn-default btn-sm"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="http://themes.gie-art.com/Blue Team/detail.html" data-toggle="tooltip" data-placement="top" title="Show Details" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div></div></div>

                                        

                                        

                                        

                                        
                                    <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div></div></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="widget">
                                <div class="widget-header">
                                    <h3>Quick Signup</h3>
                                </div>
                                <div class="widget-body">
                                    <form>
                                        <div class="form-group">
                                            <input class="form-control input-lg" placeholder="Name" type="text">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control input-lg" placeholder="Email" type="text">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control input-lg" placeholder="Password" type="password">
                                        </div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label class="string optional" for="terms">
                                                    <input id="terms" style="" type="checkbox">
                                                    <a href="#">I Agree with Term and Conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-block btn-custom">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget">
                                <div class="widget-header">
                                    <h3>Trends</h3>
                                </div>
                                <div class="widget-body">
                                    <ul class="trends">
                                        <li><a href="#">Smartphone &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Watch &amp; Jewelry &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Clothes &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Shoes &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Music &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Furniture &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                        <li><a href="#">Photography &nbsp;<span class="item-numbers">(242)</span></a></li>
                                        <li><a href="#">Web Development &nbsp;<span class="item-numbers">(2,342)</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="banner-widget">
                                <img src="Blue Team%20-%20General%20Listing%20Template_files/600x275.png" alt="banner" class="img-responsive">
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <div class="counter">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="item-counter">
                                <span class="item-icon"><i class="fa fa-database"></i></span>
                                <div data-refresh-interval="100" data-speed="3000" data-to="7803" data-from="0" class="item-count">7803</div>
                                <span class="item-info">Items</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-counter">
                                <span class="item-icon"><i class="fa fa-user-plus"></i></span>
                                <div data-refresh-interval="50" data-speed="5000" data-to="427" data-from="0" class="item-count">427</div>
                                <span class="item-info">Sellers</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-counter">
                                <span class="item-icon"><i class="fa fa-map-marker"></i></span>
                                <div data-refresh-interval="80" data-speed="5000" data-to="639" data-from="0" class="item-count">639</div>
                                <span class="item-info">Locations</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="item-counter">
                                <span class="item-icon"><i class="fa fa-users"></i></span>
                                <div data-refresh-interval="80" data-speed="5000" data-to="1548" data-from="0" class="item-count">1548</div>
                                <span class="item-info">Members</span>
                            </div>
                        </div>
                    </div>
                </div> <!-- / .counter -->
    </div>
    <div class="footer">
        <div class="container">
        <ul class="pull-left footer-menu">
            <li>
                <a href="#"> Home </a>
                <a href="#"> About us </a>
                <a href="#"> Contact us </a>
            </li>
        </ul>
        <ul class="pull-right footer-menu">
            <li> © 2015 Blue Team </li>
        </ul>
        </div>
    </div>
</div>



<div class="modal fade modal-styled" id="service_request">
    <div class="modal-dialog">
      <div class="modal-content">

        <!--Modal header-->
        <div class="modal-header" >
          <button data-dismiss="modal" class="close" type="button">
          <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Contact Details</h4>
        </div>

        <!--Modal body-->
        <div class="modal-body">

            <div class="account-wrapper">

                
                <form onSubmit="return (validateServiceRequest());">
                    <div class="form-group">
                        <input class="form-control input-lg" placeholder="Name" name="name" id="name" type="text">
                    </div>
                    <div class="form-group">
                        <input class="form-control input-lg" placeholder="Contact Number" id="mobile" type="text">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control input-lg" placeholder="Full Address" id="address" type="textarea"></textarea>
                    </div>
                    <!-- <div class="form-group">
                        <div class="checkbox">
                            <label class="string optional" for="terms">
                                <input id="terms" style="" type="checkbox">
                                <a href="#">I Agree with Term and Conditions</a>
                            </label>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-custom">Submit Request</button>
                    </div>
                </form>
                    
            </div> <!-- /.account-wrapper -->
          
        </div>

        <!--Modal footer-->
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        </div>
      </div>
    </div>
  </div>
<!-- Essentials -->
<script src="<?= $this-> baseUrl ?>static/js/bootstrap.js"></script>
<script src="<?= $this-> baseUrl ?>static/js/owl.js"></script>
<script src="<?= $this-> baseUrl ?>static/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        // ===========Featured Owl Carousel============
        if ($(".owl-carousel-featured").length > 0) {
            $(".owl-carousel-featured").owlCarousel({
                items: 3,
                lazyLoad: true,
                pagination: true,
                autoPlay: 5000,
                stopOnHover: true
            });
        }

        // ==================Counter====================
        $('.item-count').countTo({
            formatter: function (value, options) {
                return value.toFixed(options.decimals);
            },
            onUpdate: function (value) {
                console.debug(this);
            },
            onComplete: function (value) {
                console.debug(this);
            }
        });
    });
</script>

<script type="text/javascript">
    
    function genericEmptyFieldValidator(fields){
        returnBool = true;
        $.each(fields, function( index, value ) {
          console.log(value);
          if($('#'+value).val() == "" || $('#'+value).val() == null){
            $('#'+value).keypress(function() {
                genericEmptyFieldValidator([value]);
            });

            $('#'+value).css("border-color", "red");
            
            returnBool = false;
          }else{
            $('#'+value).css("border-color", "blue");
          }
        });

        return returnBool;
    }

    function postServiceRequest(fields) {
        var dataString = "";

        dataString = "name=" + $('#'+fields[0]).val() + "&mobile=" + $('#'+fields[1]).val() + "&address=" + $('#'+fields[2]).val() ;

        alert(dataString); //return false;

        $.ajax({
            type: "POST",
            url: "<?= $this-> baseUrl ?>" + "home/serviceRequest",
            data: dataString,
            cache: false,
            success: function(result){
                console.log("inside success");
                alert(result);
            },
            error: function(result){
              console.log("inside error");
              alert(result);
            }
        });
        return false;
    }

    function validateServiceRequest(){
        
        fields = ["name", "mobile", "address"];

        if (genericEmptyFieldValidator(fields)) {

            var phoneVal = $('#mobile').val();
                  
            var stripped = phoneVal.replace(/[\(\)\.\-\ ]/g, '');    
            if (isNaN(parseInt(stripped))) {
                //error("Contact No", "The mobile number contains illegal characters");
                $('#mobile').css("border", "1px solid OrangeRed");
                return false;
            }
            else if (phoneVal.length < 6) {
                //error("Contact No", "Make sure you included valid contact number");
                $('#mobile').css("border", "1px solid OrangeRed");
                return false;
            }
   
            postServiceRequest(fields);
        
        }
        return false;

    }

</script>

 </body></html>