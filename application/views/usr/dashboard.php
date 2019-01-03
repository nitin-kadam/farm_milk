<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>milk</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style5.css">
    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Bootstrap Sidebar</h3>
                </div>

                <ul class="list-unstyled components">
                    <p>Dummy Heading</p>
                    <li>
                        <a href="#">User Profile</a>
                       <!--  <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul> -->
                    </li>
                    <li>
                        <a href="#">order</a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">Plan</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="#">1 Week</a></li>
                            <li><a href="#">3 Month</a></li>
                            <li><a href="#">6 Month</a></li>
                            <li><a href="#">1 Year</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Product</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>User_controller/pay_bill">Pay Bills</a>
                    </li>
                    <li>
                        <a href="#">help</a>
                    </li>
                </ul>

                
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="navbar-btn">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>

                        <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1"><
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">Page</a></li>
                                <li><a href="#">Page</a></li>
                                <li><a href="#">Page</a></li>
                                <li><a href="#">Page</a></li>
                            </ul>
                        </div> -->
                    </div>
                </nav>
<!-- ---------------------------------------------------------- -->
<!-- main containt -->
     <div class="row" style=' color:black;  background-color:gray;'>
        <div class="col" style="margin-top: 10px;"><div class="panel"  style='text-align:center; height:50px; width:80px; font-size: 20px;'>Sun</div></div>
        <div class="col"style="margin-top: 10px;"><div class="panel"  style='text-align:center; height:50px; width:80px; font-size: 20px;'>Mon</div></div>
        <div class="col"style="margin-top: 10px;"><div class="panel" style='text-align:center; height:50px; width:80px; font-size: 20px;'>Tue</div></div>
        <div class="col" style="margin-top: 10px;"><div class="panel" style='text-align:center; height:50px; width:80px; font-size: 20px;'>Wed</div></div>
        <div class="col" style="margin-top: 10px;"><div class="panel" style='text-align:center; height:50px; width:80px; font-size: 20px;'>Thu</div></div>
        <div class="col" style="margin-top: 10px;"><div class="panel" style='text-align:center; height:50px; width:80px; font-size: 20px;'>Fri</div></div>
        <div class="col" style="margin-top: 10px;"><div class="panel" style='text-align:center; height:50px; width:80px; font-size: 20px;'>Sat</div></div>

     </div>           
<?php 
 $week=7;
 $day=1;
 $endDay=31;
for($i=1; $i<=5; $i++) { 
    
echo "<div class='row'>";
   

    for ($k=$day; $k <=$week; $k++) {
    echo "<div class='col' style=' color:black; background-color:gray;'>";
    echo "<div class='panel' style='text-align:center; height:50px; width:80px; font-size: 20px;' >";
     if ($k==$endDay) {
        echo "";
        $endDay=$k+1;
     }
     else{
        echo $k;
      } 

    echo "</div>";
   
    echo "</div>";
     }
    $week=$k+6;//7
    $day=$k ;//8




echo "</div>";
 // echo $week."<br>".$day;

}?>



<!-- ---------------------------------------------------------- -->
<!--/ main containt -->












                <div class="line"></div>

                <h2>Lorem Ipsum Dolor</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <div class="line"></div>

                <h2>Lorem Ipsum Dolor</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <div class="line"></div>

                <h3>Lorem Ipsum Dolor</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>





        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $(this).toggleClass('active');
                 });
             });
         </script>
    </body>
</html>
