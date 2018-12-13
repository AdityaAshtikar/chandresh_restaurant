
<!-- banner -->
<div class="" id="home">
    <!-- header -->
    <header>
        <div class="container">

            <!-- navigation -->
            <nav class="navbar navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>				  
                    <div class="w3-logo">
                        <h1><a href="index.php">Restaurant Review</a></h1>
                    </div>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">  
                        <?php if (isset($_SESSION['adminLogin'])) { ?>
                            <li><a href="admin_feedback.php">Feedback</a></li>
                            <li><a href="admin_user.php">User</a></li>
                            <li><a href="admin_restaurant.php">Restaurant</a></li>
                            <li><a href="admin_restaurant_list.php">Restaurant List</a></li>
                            <li><a href="logout.php">Logout</a></li>

                        <?php } else { ?>
                            <li><a class="active" href="index.php">Restaurant</a></li>
                          <!--  <li><a href="about.php">About</a></li> -->
                            <li><a href="contact.php">Contact</a></li>
                            <?php if (isset($_SESSION['userLogin'])) { ?>
                                <li><a href="user_panel.php">Profile</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            <?php } else { ?>  

                                <li><a href="registration.php">Registration</a></li>
                                <li><a href="login.php">Login</a></li>

                            <?php } ?>  
                        <?php } ?>


                        <!-- <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages<span class="caret"></span></a>
                          <ul class="dropdown-menu">
                                <li><a href="codes.php">Short Codes</a></li>
                                <li><a href="icons.php">Icons</a></li>
                          </ul>
            </li> -->
                    </ul>
                    <!-- <div class="subscribe">
                           <form>
                                   <input type="search" class="sub-email" name="Search" required="">
                                   <input type="submit"  value="">
                           </form>
                   </div> -->
                </div><!-- /.navbar-collapse -->

            </nav>
            <div class="clearfix"></div>
            <!-- //navigation -->
        </div>
    </header>
    <!-- //header -->
</div>
<!-- //banner -->