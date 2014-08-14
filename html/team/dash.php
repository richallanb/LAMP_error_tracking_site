<?php
$hw1 = 100;
$hw2 = 0;
$hw3 = 0;
$hw4 = 0;
session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
session_start();

  if (!$_SESSION['logged']){ 
    header("Location: ./");
 } 
$cgnum = rand(0,5);
$cgray = array(
array('You Farted During "Boyhood" - mw4m',
'There we were, just enjoying a nice quiet Saturday night at the movies. A slow mover, Linklater\'s "Boyhood." Some popcorn. A few sodas. Nothing really happens in the film, we found. For about 90 minutes or so we stare listlessly at the screen. It\'s a thinking man\'s film, I say. Beautifully shot. It\'s about life, and death and relationships and things of that nature. Just then, at a brief, carefully-timed cinematic pause in dialogue, an enormous fart from somewhere in the back pierces an otherwise silent movie theatre. It had the impact of a baseball bat hitting a leather couch, or George Foreman working the heavy bag. Whack. Loud, deep and masculine.The seat cushion heroically absorbed most of the blow, but not enough that each and every person in the movie theatre instantly burst into nervous laughter. The laughter continued for what felt like a good 5 minutes, until tears streamed down our faces. Even well after the blast, we quietly chuckled to ourselves with a \'remember the time that guy farted in the movie theatre\' gleam in our eyes. And just like that, with a soft chuckle and a deep breath, we were back into the film. Things happened, people drove around Texas, relationships came and went, there was crying, there was hope. It was as if we had all forgotten about the fart that had brought us together that night. As the sun began to set on screen, the teenage boy, no longer a boy, transitions into an adult, before our very eyes, and looks, intently, lustfully into a young girls eyes, as if to lean in for a kiss, and braaaaaaap. Another fart from the back row, like two giant hands clapping together, and the screen goes dark, roll credits. We decided, after laughing our way out of the theatre, and all the way home, that this was the best movie that we had ever seen. I imagine the lone fartist sauntering off into the sunset. His work here done. 
If only I could say thank you, kind sir. You are truly a master of your craft.'),

array('The men of Craigslist',
'Thank you to all the men of CL. You have made getting over a ten year relationship breakup so easy. Every time I needed a casual encounter, you were there- and not just there but really willing to do whatever it took to get in my pants. It\'s incredible the amount of hot, intelligent, educated and successful men on here. And what\'s best about you is that you\'re willing to tell me you\'re cheating on your wife, you have a small dick or you have PTSD all within a few minutes of talking with you. Thanks for always complimenting my pictures and asking for more- you really know how to make a woman feel wanted. Thanks for giving me the distraction I needed, the dick I craved and the confidence to start dating again. I love you all and wish you the best.'),

array('Seen u eating cat food - w4m',
'Seen you eating catfood out of can. You was using a fork. Looks like yous gots some manners. I like that.'),

array('FREE Sexy Romantic Fire Wood!!!!!!!!!',
'<div class="random-text">I have lots of free scrap wood available. This is mostly wood that breaks off of wooden pallets. This would be great for bonfires and camp fires. Guaranteed to get you laid. This sexy wood will set the romantic atmosphere that your woman has desired for years. Rekindle the flame of love. Also would be great to take the wood and make new pallets and sell them. We are located off of Fulton Industrial Boulevard near Six Flags.

Thanks,
Casey</div><div class="random"><img src="random/rand3.jpg" class="img-rounded" alt="seriously?"></div>'),
  
  array('Skilsaw','<div class="random-text">Wife says its gotta go. 7 1/4 blade. Runs great. The good: Pretty much stops at nothing when cutting. The bad: safety guard malfunctions randomly. Probably easy repair.</div>
  <div class="random"><img src="random/rand4.jpg" class="img-rounded" alt="seriously?"></div>'),
  
  array('Girl that <3 toast',
'I\'m looking for that special someone who will share my passion for toast, all kinds of toast -- white toast, whole-wheat toast, rye toast, toasted bagels (and when I\'m feeling wild and crazy, a Pop Tart.) To me, toast is the ultimate turn-on. There is nothing like a man who smells like toast! I picture us sitting on a couch in front of my sixty toasters, getting nice and toasty, sipping brandy from glasses with croutons floating in them, talking endlessly about the splendors of toast. Perhaps one day you will ask me to spread butter and jam on your body. Or cream cheese -- I\'m not particular. Are you that special man?')
);

?>

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
.random{
  display:table-cell;
  min-width:200px;
  max-width:400px;
  
  
}
  .random > img{
    width:100%;
    max-width:400px;
    
    height:auto;
  }

.random-text{
  display:table-cell;
  vertical-align:top;
  min-width:350px;
  width:100%;
}
article.members > img{
  max-width:175px;
  height:auto;
  cursor:pointer;
 
  transition: all .4s ease;
}
  div.members{
    
    transition: all .4s ease;
  }
  div.members:hover{
    opacity: 1;
  }
article.members > img:hover{
  box-shadow: 1px 2px 20px rgba(0,0,0,0.5);
  height:auto;
}
  img.face-selected{
    box-shadow: 1px 2px 20px rgba(0,0,0,0.5);
    
  }
  div.face-unselected{
    opacity:0.5;
  }
  div.face-selected{
    opacity:1;
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
  text-align:center;
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
    min-width:715px;
    
  }
  .mainj{
    z-index:70;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
    position: relative;
  }
  ul.nav > li  a {
    cursor:pointer; 
    position: relative;
    z-index:40;
    background-color:transparent;
  }
  
ul.nav{
  background-color:transparent;
  margin-top:20px;
}
li a.active{
  box-shadow: 0 0px 20px rgba(0,0,0,0.3);
  z-index:50;
  background-color: #eee !important;
}
li a{
  transition: all .4s ease;
  
}
li:hover{
  position: relative;
  z-index:10;
  background-color: #eee !important;
}
div.members{
  position:relative;
}

 
</style>
  
  </head>

  <body>
    <div class="container">

      <div class="masthead" style="margin-top:20px;">
        
        <!-- Rolando's Lab-->
        <h3 class="text-muted" style="display:table-cell;width:100%;">Team Nine</h3>
        <h6 style="display:table-cell;min-width:300px;text-align:right;">Welcome,
          <a href="./php/logout.php" data-rel="tooltip" data-placement="bottom" title="Logout">
            <?php echo ($_SESSION["user"]); ?>
          </a>
        </h6>
        <!--h6 style="text-align:right"><a>Not one of us? Sign up. Sign up right now.</a></h6-->
        
         
        
        <ul class="nav nav-justified">
          <li><a class="active" onclick="$('.jumbotron').hide();$('#landing').show();
            $('.nav > li > a').removeClass('active');
            $(this).addClass('active');">Home</a></li>
          <li><a onclick="$('.jumbotron').hide();$('#proj').show();$('.nav > li > a').removeClass('active');
            $(this).addClass('active');">Projects</a></li>
          <li><a onclick="$('.jumbotron').hide();$('#docs').show();$('.nav > li > a').removeClass('active');
            $(this).addClass('active');">Documentation</a></li>
          <li><a onclick="$('.jumbotron').hide();$('#team').show();$('.nav > li > a').removeClass('active');
            $(this).addClass('active');">About Us</a></li>
          <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"]) {
            echo ('<li><a onclick="$(\'.jumbotron\').hide();$(\'#admin\').show();$(\'.nav > li > a\').removeClass(\'active\');$(this).addClass(\'active\');">Admin Tools</a></li>');
         } ?>
        </ul>
        
      </div>
      <?php if (isset($_SESSION["admin"]) && $_SESSION["admin"]) {
print ('<div id="admin" class="jumbotron mainj">
        <h2>Administrative Tools</h2>
        <a href="/team/php/deploy" data-rel="tooltip" title="This is going to pull any pushed changes from git">Deploy Git Updates to Server</a><br>
        <a href="/team/php/phpinfo">PHP Info</a><br>
        <a href="/awstats/awstats.pl" data-rel="tooltip" title="Our apache usage logs">Log Report</a><br>
        <a href="#" data-rel="tooltip" title="Doesn\'t do anything yet. Try later">Manage Users</a>
      </div>');
         } ?>
      <!-- Jumbotron -->
      <div id="landing" class="jumbotron mainj">
        <h1>We're Team Nine!</h1><br>
        
        <div class="well well-lg"><!--style="padding:10px;border-radius:10px;margin-left:40px;margin-right:40px;min-width:575px;"-->
        
        <p class="lead"><?php echo ($cgray[$cgnum][0]); ?></p>
          <div style="display:block;margin-left:40px;margin-right:40px;min-width:575px;"><?php echo ($cgray[$cgnum][1]); ?></div></div>
        <!--<p>We just love what we do, 999999 lines of code managed this week. Making sweet digital dreams come true.<a class="btn btn-lg btn-success" onclick="$('.jumbotron').hide();$('#team').fadeIn(500);" href="#" role="button">Meet the team!</a></p>-->
      </div>

      
<div id="team" class="jumbotron mainj">
  <div id="curly" style="display:none;cursor:pointer;" onclick="$(this).hide();$('#team-container').show();"><img style="width:100%;height:auto;" src="images/curly.gif" alt="Strike 3 Curly.."></div>
  <div id="team-container">
  <h2>About Our Group!</h2><section class="members">
  
  <div class="members" id="div-jessica"><header class="members"><h3>Jessica</h3></header><article class="members"><img  src="images/jessica.jpg" data-click=".jessica-data" class="img-circle members" alt="Jessica"></article></div>
  
  <div class="members" id="div-rick"><header class="members"><h3>Rick</h3></header><article class="members"><img  src="images/rick.gif" data-click=".rick-data" class="img-circle members" alt="Rick"></article></div>
  
  <div class="members" id="div-rolando"><header class="members"><h3>Rolando</h3></header><article class="members"><img  src="images/rolando.gif" data-click=".rolando-data" class="img-circle members" alt="Rolando"></article></div>
  
  <div class="members" id="div-rosheni"><header class="members"><h3>Rosheni</h3></header><article class="members"><img src="images/rosha.jpg" data-click=".rosheni-data" class="img-circle members" alt="Rosheni"></article></div>
  
  <div class="members" id="div-steve"><header class="members"><h3>Steve</h3></header><article class="members"><img  src="images/steve.jpg" data-click=".steve-data" class="img-circle members" alt="Steve"></article></div></section>
        
       <div class="row data jessica-data" >
        <div class="col-lg-4">
          <h4><b>Biography</b></h4>
          <p class="text-danger"></p>
          Miss Jessica grew up in the swamps of Louisiana, where she was much admired for the wide webbing of her feet. She suffered a gunshot injury during hunting seasons to her left wing, and was thus prevented from partaking in her species annual migratory flight. She spent that winter in hiding, passing the time writing this memoir. 
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          "Meep." - Anonymous
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
          <h4><b>Favorite Quotes</b></h4>
          1. <a class="ignoreme" style="cursor:pointer;" onclick="$('#team-container').hide();$('#curly').toggle(300);">"Strike 3 Curly"</a>
          <br><br>2. "Security through obscurity only works if you're absolutely certain everyone is as dumb as you"<br><em>- Me</em>
          
          
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
          Chief Executive Officer at Team Nine Inc. that's why he's in the middle.
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
          Once upon a time, in a far far away land, where buildings were made out of glass, streets out of iced pineapple, cars out of strawberries, the sky out of cotton candy, and air out of oxygen and the fragrance of melon, Rosha was born. She grew up to love macarons, coding, fruits, sports cars, giving pep talks, UCSD, extreme-sports, and tall buildings. She then became a CEO of her own company which produced software for people to learn how to create the most amazing websites using fruits, Olympic althete in swimming, running, skiing by eating fruits, architect of the most awesome buildings in which the worlds' best web site software was developed from fruits, and then created a school that taught how to create the greatest websites, (the school was made of fruit, too). She really loved fruits, watermelon, strawberries, lalalaberries, cutiepatootieoranges, etc. She hopes you enjoyed her biography which is a little biography because she still has more amazing things to do, and more fruits to discover. 
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          "There are little pieces of dreams that we dream looking at the stars and then suddenly all those dreams become an even bigger dream and then the collection of all these big dreams becomes a gigantic dream, and then like the big bang, all of the pieces of this huge dream disperse into the world like oxygen and hydrogen, and suddenly, you see little pieces of your dreams in your world, in your life. And that is reality. The big bang is your hard work. And if you're going to be a dreamer, be the best one. That is all." - Anonymous
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
          Steve was an actor, action choreographer, comedian, director, producer, martial artist, screenwriter, entrepreneur, singer, and stunt performer. In his movies, he was known for his acrobatic fighting style, comic timing, use of improvised weapons, and innovative stunts. He was one of the few actors to have performed all of his film stunts. And now he goes to UCSD.
        </div>
        <div class="col-lg-4">
          <h4><b>Favorite Quote</b></h4>
          "Everybody can be a superman, but nobody can be Steve Dai." - Steve Dai
       </div>
        <div class="col-lg-4">
          <h4><b>Contact</b></h4>
          <a href="mailto:l1dai@ucsd.edu">l1dai@ucsd.edu</a>
        </div>
      </div>
  
      </div></div>
      
      <div id="docs" class="jumbotron mainj">
        <h2>Documentation</h2>
        <p class="lead">Homework 1: Compression Summary</p>
        <b>Web Page Compressed:</b> Yes<br>
        <b>Compression Type:</b> gzip<br>
        <b>Size, Markup (bytes):</b> 2,312<br>
        <b>Size, Compressed (bytes):</b> 971<br>
        <b>Compression:</b> 58.0%<br>
        <div class="well well-lg" style="margin-top:40px;">
        <h3>Security Precautions:</h3>

          <h4>MySQL</h4>
<ol>
  <li>Root renamed to something else. Password applied.</li>
  <li>Connections only allowed from localhost for root.</li>
  <li>Created single user account that only has control over a single database.</li>
<li value="3" style="list-style:none"><ul><li>Has remote access allowed, but only during development & testing. This will be changed to localhost only after the project is complete. MySQL will then be permanently binded to localhost allowing no outside connections.</li></ul></li>
  <li>Turned off file control from MySQL.</li></ol>

          <h4>Database Security</h4>
<ol>
  <li>We are using prepared statements (fighting SQL Injection)</li>
  <li value="1" style="list-style:none"><ul><li>There’s currently no new entry generation from our site, but we will be sanitizing of all user input to avoid XSS (or cross site scripting).</li></ul></li>
  <li>All password entries are stored as Blowfish encrypted hashes. The password is never physically passed outside of the php session. We rely entirely on hashes and the comparison of the user’s entered password.</li>
  <li>Our user entries have admin rights associated with them (currently the only accounts available are admins)</li>
  <li>The MySQL connection credentials are stored outside document root and are defined  in PHP - no physical exposure of MySQL credentials.</li>
  <li>MySQL connections are treated as objects, and the code for it is outside document root. So the MySQL connection routines are not accessible by users.</li>
  <li>The encryption is also done outside of document root so the salt used is not exposed.</li>
  <li>Connections closed immediately after use.</li></ol>


<h4>SSH</h4>
<ol>
<li>Root is not allowed remote login & password was changed.</li>
  <li>Accounts created for each group member, “user” account was subsequently deleted.</li></ol>

          <h4>Apache</h4>
<ol>
<li>Access denied on everything outside of our viewable documents.</li>
  <li>Hid verbose Apache headers</li>
  <li>Used pretty url’s to hide php extensions</li>
  <li>Using logging and Awstats to display on admin page</li>
  <li>Put authentication requirements on extremely sensitive php scripts (such as deploy, awstats, phpinfo). The login credentials are the same that are used for accessing the team page.</li>
  <li value="5" style="list-style:none"><ul><li>The best solution would be using SSL. We created an SSL cert and enabled the SSL Engine, but our site isn’t “third party verified,” in which case we had to drop the SSL cert.</li></ul></li>
</ol>
          
          <h4>PHP</h4>
<ol>
  <li>Hid PHP information in header</li>
  <li>Turned on error logging</li>
          </ol>
          
          <h4>Logging</h4>
<ol>
  <li>Used AWStats for a log analysis report</li>
  <li>Access to report denied without proper login information</li>
  <li>Report run every nine minutes</li>
          </ol></div>
    
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

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
    <script>$('html').click(function(){
              $('#curly').hide();$('#team-container').show();
          });
      $('.ignoreme').click(function(event){
    event.stopPropagation();
});
  
  $("img.members")
    .click(function(){
    $('img.members').removeClass('face-selected');
    var otherguys = $('img.members').not($(this)).closest('div.members');
    otherguys.removeClass('face-selected');
      otherguys.addClass('face-unselected');
    /*otherguys.mouseover(function(){
      $(this).fadeTo("fast" , 1);
    })
      .mouseleave(function(){
      if (!$(this).find("img.members").hasClass("face-selected"))
        $(this).fadeTo("fast" , 0.5);
    });*/
    //alert($(this).offset().left);
   // otherguys.animate({ "left": "=" + $(this).position().left + "px"}, "slow" );
   // otherguys.css("left", $(this).offset().left + "px")
   // otherguys.css("z-index","70");
    //otherguys.find("h3").css("visibility", "hidden");
    
    $(this).addClass('face-selected');
    $(this).closest('div.members').addClass('face-selected');
    var dField = $(this).attr("data-click");
    $('.data').not($(dField)).hide();
    
    $(dField).show();
  });
      
      $(function () {
        $("[data-rel='tooltip']").tooltip();
    });
      </script>
  </body>
</html>

