<!-- Header / Menu Section -->
            <header id="header" class="transparent">
                <nav class="navbar navbar-default navbar-transparent" role="navigation">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
<!--                             <a class="navbar-brand navbar-brand-img" href="<?= $this-> baseUrl ?>">
                                <img src="<?= $this-> baseUrl ?>static/images/logo.png" class="img-responsive logo-white" alt="BlueTeam">
                                <img src="<?= $this-> baseUrl ?>static/images/logo.png" class="img-responsive logo-fixed" alt="BlueTeam">
                                <span class="logo">
                                    Blue Team
                                </span>
                            </a> -->

                            <a href="<?= $this -> baseUrl ?>home" class="navbar-brand" style="padding-top: 0px;"><span class="logo" style="color: #ff2e8a06;">
                            <img src="<?= $this -> baseUrl ?>static/images/logo.png" style="height: 68px; width: 68px;"></span></a>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse navbar-right" id="main-menu">
                            <ul class="nav navbar-nav">
                                <?php /*<li ><a href="<?= $this-> baseUrl ?>#home">Home</a></li> */ ?>
                                <li ><a href="<?= $this-> baseUrl ?>terms&Conditions">Terms&Conditions</a></li>
                                <li ><a href="<?= $this-> baseUrl ?>blueteamVerified">BlueTeam Verification</a></li>
                                <li ><a href="<?= $this-> baseUrl ?>home#services">Services</a></li>
                                <li ><a href="<?= $this-> baseUrl ?>home#aboutus">About</a></li>
                                <li ><a href="<?= $this-> baseUrl ?>home#contactus">Contact</a></li>
                                <li class="active"><a href="" style="color: #fff">
                                        <i class="fa fa-phone" style="color: #fff"></i> or <i class="fa fa-whatsapp" style="color: #fff">
                                            <?= $this-> blueteamContactNumber ?></i> </a></li>
                                <li ><a href="//goo.gl/EGxeu3" target="_blank">
                                        <span class="fa fa-android"></span></a></li>
                                <li ><a href="//goo.gl/Ko19Gq" target="_blank"><span class="fa fa-apple"></span></a></li>
                                <li ><a href="//goo.gl/Ko19Gq" target="_blank"><span class="fa fa-windows"></span></a></li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>
