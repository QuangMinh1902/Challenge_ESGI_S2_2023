<!-- LOADER -->
<div id="preloader">
    <img class="preloader" src="images/loader.gif" alt="">
</div><!-- end loader -->

<div id="wrapper">
    <div class="collapse top-search" id="collapseExample">
        <div class="card card-block">
            <div class="newsletter-widget text-center">
                <form class="form-inline">
                    <input type="text" class="form-control" placeholder="What you are looking for?">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
            </div><!-- end newsletter -->
        </div>
    </div><!-- end top-search -->

    <div class="topbar-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 hidden-xs-down">
                    <div class="topsocial">
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Youtube"><i class="fa fa-youtube"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Flickr"><i class="fa fa-flickr"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a>
                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i class="fa fa-google-plus"></i></a>
                    </div><!-- end social -->
                </div><!-- end col -->

                <div class="col-lg-4 hidden-md-down">
                    <div class="topmenu text-center">
                        <ul class="list-inline">
                            <li class="list-inline-item"><a href="blog-category-01.html"><i class="fa fa-star"></i> Trends</a></li>
                            <li class="list-inline-item"><a href="blog-category-02.html"><i class="fa fa-bolt"></i> Hot Topics</a></li>
                            <li class="list-inline-item"><a href="page-contact.html"><i class="fa fa-user-circle-o"></i> Write for us</a></li>
                        </ul><!-- end ul -->
                    </div><!-- end topmenu -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="topsearch text-right">
                        <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-search"></i> Search</a>
                    </div><!-- end search -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end header-logo -->
    </div><!-- end topbar -->

    <div class="header-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <a href="index.html"><img src="images/logo.png" alt=""></a>
                    </div><!-- end logo -->
                </div>
            </div><!-- end row -->
        </div><!-- end header-logo -->
    </div><!-- end header -->

    <?php include "header.view.php"; ?>

    <?php include "slide.view.php"; ?>

    <?php include "main.view.php"; ?>

    <?php include "footer.view.php"; ?>

    <div class="dmtop">Scroll to Top</div>
    
</div><!-- end wrapper -->

<?php include "script.view.php"; ?>