
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<div class="container-fluid">
  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
       <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
         <li data-target="#myCarousel" data-slide-to="5"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
     <div class="item active">
      
        <img src="<?php echo base_url();?>/assets/images/curd2.jpg" alt="Los Angeles" style="width:1600px; height:300px; ">
      </div>

      <div class="item">
        <img src="<?php echo base_url();?>/assets/images/ghee1.jpg" alt="Chicago" style="width:1600px; height:300px;">
        
      </div>
    
      <div class="item">
        <img src="<?php echo base_url();?>/assets/images/curd1.jpg" alt="New york" style="width:1600px; height:300px;">
      </div>
      <div class="item">
      
        <img src="<?php echo base_url();?>/assets/images/buttor2.jpg"" alt="New york" style="width:1600px; height:300px;">
      </div>
      <div class="item">
        <img src="<?php echo base_url();?>/assets/images/curd2.jpg" alt="New york" style="width:1600px; height:300px;">
      </div>
      <div class="item">
        <img src="<?php echo base_url();?>/assets/images/buttor1.jpg" alt="New york" style="width:1600px; height:300px;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
