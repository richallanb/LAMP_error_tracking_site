<?php
$hw1 = 95;
$hw2 = 0;
$hw3 = 0;
$hw4 = 0;
  session_start();
  if (!$_SESSION['logged']){
    header("Location: ./");
 } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
 
    <title>Team Nine Team Team Page</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
#team, #docs, #proj, #admin{
display:none;
}
  #team{
    min-height:462px;
  }
article.members > img{
  width:175px;
  height:auto;
  cursor:pointer;
  transition: all .4s ease;
}
article.members > img:hover{
  box-shadow: 1px 2px 20px rgba(0,0,0,0.5);
  height:auto;
}
  .face-selected{
    box-shadow: 1px 2px 20px rgba(0,0,0,0.5);
  }
header.members{
  text-align:center;
}
div.members{
  max-width:175px;
  min-width:175px;
  margin:12px;
  display: inline-block;
  vertical-align:top;
}
section.members{
  width:100%;
  margin:auto;
  
}
  footer.members{
    margin-top:8px;
    text-align:center;
  }
  .data{
    display:none;
  }
  .jumbotron{
    border-radius:0px !important;
  }
  .mainj{
    z-index:90;
    
    position: relative;
  }
  ul.nav > li {
    cursor:pointer; 
    position: relative;
  }
  


  .active{
    z-index:70;
    box-shadow: 0 0px 20px rgba(0,0,0,0.3);
    background-color:#eee !important;
    
  }
 
</style>
  
  </head>

  <body>
<script>
  
    </script>
    <div class="container">

      <div class="masthead" style="margin-top:20px;">
        
        <!-- Rolando's Lab-->
        <h3 class="text-muted" style="display:table-cell;width:100%;">Team Nine</h3>
        <h6 style="display:table-cell;min-width:300px;text-align:right;">Welcome,
          <a href="./php/logout.php">
            <?php echo ($_SESSION["user"]); ?>
          </a>
        </h6>
        <!--h6 style="text-align:right"><a>Not one of us? Sign up. Sign up right now.</a></h6-->
        
         
        
        <ul class="nav nav-justified">
          <li class="active"><a onclick="$('.jumbotron').hide();$('#landing').show();
            $('.nav > li').removeClass('active');
            $(this).parent().addClass('active');">Home</a></li>
          <li><a onclick="$('.jumbotron').hide();$('#proj').show();$('.nav > li').removeClass('active');
            $(this).parent().addClass('active');">Projects</a></li>
          <li><a onclick="$('.jumbotron').hide();$('#docs').show();$('.nav > li').removeClass('active');
            $(this).parent().addClass('active');">Documentation</a></li>
          <li><a onclick="$('.jumbotron').hide();$('#team').show();$('.nav > li').removeClass('active');
            $(this).parent().addClass('active');">About</a></li>
          <?php if (isset($_SESSION["admin"])) {
            echo ('<li><a onclick="$(\'.jumbotron\').hide();$(\'#admin\').show();$(\'.nav > li\').removeClass(\'active\');$(this).parent().addClass(\'active\');">Admin Tools</a></li>');
         } ?>
        </ul>
      </div>

      <!-- Jumbotron -->
      <div id="landing" class="jumbotron mainj">
        <h1 onclick="$('#rosheni').modal('show')">We're Team Nine!</h1>
        <p class="lead">We just love what we do, 999999 lines of code managed this week. Making sweet digital dreams come true.</p>
        <p><a class="btn btn-lg btn-success" onclick="$('.jumbotron').hide();$('#team').fadeIn(500);" href="#" role="button">Meet the team!</a></p>
      </div>

      <div id="admin" class="jumbotron mainj">
        <h2>Administrative Tools</h2>
        <a href="/team/php/deploy">Deploy Git Updates to Server</a><br>
        <a href="#">Manage Users</a>
      </div>
<div id="team" class="jumbotron mainj">
  <div id="curly" style="display:none;cursor:pointer;" onclick="$(this).hide();$('#team-container').show();"><img style="width:100%;height:auto;" src="images/curly.gif" alt="Strike 3 Curly.."></div>
  <div id="team-container">
  <h2>About Our Group!</h2><section class="members">
  
  <div class="members"><header class="members"><h3>Jessica</h3></header><article class="members"><img  src="images/jill.jpg" onclick="$('img.members').removeClass('face-selected');$(this).addClass('face-selected');
    $('.data').hide();$('.jessica-data').fadeIn(300);" class="img-circle members" alt="Jessica"></article></div>
  
  <div class="members"><header class="members"><h3>Rick</h3></header><article class="members"><img  src="images/jack.jpg" onclick="$('img.members').removeClass('face-selected');$(this).addClass('face-selected');$('.data').hide();$('.rick-data').fadeIn(300);" class="img-circle members" alt="Rick"></article></div>
  
  <div class="members"><header class="members"><h3>Rolando</h3></header><article class="members"><img  src="images/jack.jpg" onclick="$('img.members').removeClass('face-selected');$(this).addClass('face-selected');$('.data').hide();$('.rolando-data').fadeIn(300);" class="img-circle members" alt="Rolando"></article></div>
  
  <div class="members"><header class="members"><h3>Rosheni</h3></header><article class="members"><img src="images/jill.jpg" onclick="$('img.members').removeClass('face-selected');$(this).addClass('face-selected');$('.data').hide();$('.rosheni-data').fadeIn(300);" class="img-circle members" alt="Rosheni"></article></div>
  
  <div class="members"><header class="members"><h3>Steve</h3></header><article class="members"><img  src="images/jack.jpg" onclick="$('img.members').removeClass('face-selected');$(this).addClass('face-selected');$('.data').hide();$('.steve-data').fadeIn(300);" class="img-circle members" alt="Steve"></article></div></section>
        
       <div class="row data jessica-data" >
        <div class="col-lg-4">
          <h4><b>Biography</b></h4>
          <p class="text-danger"></p>
          Jessica was born in a hospital. Then she went to UCSD. It was good.
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          "Intuitive design is how we give the user new superpowers." - Anonymous
       </div>
        <div class="col-lg-4">
          <h4><b>Contact</b></h4>
          <a href="mailto:jtv009@ucsd.edu">jtv009@ucsd.edu</a>
        </div>
      </div>     
  
  <div class="row data rick-data">
        <div class="col-lg-4">
          <h4><b>Biography</b></h4>
          <p class="text-danger"></p>
          At the beginning of the Second World War, Richard joined the Royal Canadian Artillery. He was commissioned a lieutenant in the 13th Field Artillery Regiment of the 3rd Canadian Infantry Division. Richard went to England in 1940 for training. His first combat was the invasion of Normandy at Juno Beach on D-Day. Shooting two snipers, Richard led his men to higher ground through a field of anti-tank mines, where they took defensive positions for the night. Crossing between command posts at 11:30 that night, Richard was hit by six rounds fired from a Bren gun by a nervous Canadian sentry: four in his leg, one in the chest, and one through his right middle finger. The bullet to his chest was stopped by a silver cigarette case given to him by his brother. His right middle finger had to be amputated, something he would conceal during his career as an actor.
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          <a class="ignoreme" style="cursor:pointer;" onclick="$('#team-container').hide();$('#curly').toggle(300);">"Strike 3 Curly"</a>
          
          
       </div>
        <div class="col-lg-4">
          <h4><b>Contact</b></h4>
          <a href="mailto:richard.allan.b@gmail.com">richard.allan.b@gmail.com</a>
        </div>
      </div>
  
    <div class="row data rolando-data">
        <div class="col-lg-4">
          <h4><b>Biography</b></h4>
          <p class="text-danger"></p>
          Rolando was born in a hospital. Then he went to UCSD. It was good.
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          "If that makes any sense to you, you have a big problem." - C. Durance
       </div>
        <div class="col-lg-4">
          <h4><b>Contact</b></h4>
          <a href="mailto:rcheungw@ucsd.ed">rcheungw@ucsd.edu</a>
        </div>
      </div>
  
      <div class="row data rosheni-data">
        <div class="col-lg-4">
          <h4><b>Biography</b></h4>
          <p class="text-danger"></p>
          Rosheni was born in a hospital. Then she went to UCSD. It has been pretty good.
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          "Don't wait for the perfect moment, take the moment and make it perfect." - Anonymous
       </div>
        <div class="col-lg-4">
          <h4><b>Contact</b></h4>
          <a href="mailto:rsmalik">rsmalik@ucsd.edu</a>
        </div>
      </div>
  
        <div class="row data steve-data">
        <div class="col-lg-4">
          <h4><b>Biography</b></h4>
          <p class="text-danger"></p>
          Steve was born in a hospital. Then he went to UCSD. It was good.
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          "Computer science is no more about computers than astronomy is about telescopes." -Edsger Dijkstra
       </div>
        <div class="col-lg-4">
          <h4><b>Contact</b></h4>
          <a href="mailto:l1dai@ucsd.edu">l1dai@ucsd.edu</a>
        </div>
      </div>
  
      </div></div>
      
      <div id="docs" class="jumbotron mainj">
        <h2>Documentation</h2>
        <p class="lead">There is none. You were foolish to think otherwise.</p>
    
  </div>


      <div id="proj" class="jumbotron mainj">
        <h2>Our Project Progress</h2>
        <div style="margin: 20px 20px 0 20px;width:100%;">
          <h4>Homwork 1</h4>
          <div class="progress">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw1; ?>%">
    <?php echo $hw1; ?>% Complete 
  </div>
</div>
          <h4>Homwork 2</h4>
<div class="progress">
  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw2; ?>%">
    <?php echo $hw2; ?>% Complete
  </div>
</div>
          <h4>Homwork 3</h4>
<div class="progress">
  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw3; ?>%">
    <?php echo $hw3; ?>% Complete
  </div>
</div>
          <h4>Homwork 4</h4>
<div class="progress">
  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw4; ?>%">
    <?php echo $hw4; ?>% Complete
  </div>
</div>
        </div>
    
      </div>

      <!-- Example row of columns -->
 <!--     <div class="row">
        <div class="col-lg-4">
          <h2>Safari bug warning!</h2>
          <p class="text-danger">As of v7.0.1, Safari exhibits a bug in which resizing your browser horizontally causes rendering errors in the justified nav that are cleared upon refreshing.</p>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-lg-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
          <p><a class="btn btn-primary" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>-->
      <!-- Site footer -->
      <div class="footer">
        <p>&copy; Team Nine 2014</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<!-- Rosheni Modal -->
<!--  <div id="rosheni" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Rosheni</h4>
      </div>
      <div class="modal-body">
        <p>Rosheni was born in a hospital. Then she went to UCSD. It has been pretty good.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>-->

 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
    <script>$('html').click(function(){
              $('#curly').hide();$('#team-container').show();
          });
      $('.ignoreme').click(function(event){
    event.stopPropagation();
});
    </script>
  </body>
</html>

