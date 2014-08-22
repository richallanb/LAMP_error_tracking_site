<?php
  //include('/home/action/workspace/protected/constants.php');
  include('../../protected/constants.php');

  /*define ("ADMIN", 3);
  define ("DEV", 2);
  define ("DEVDEV", 1);
  define ("USER", 0);
  define ("ANON", -1);*/

  // Progress in progress bar showing progress
  $hw1 = 100;
  $hw2 = 100;
  $hw3 = 0;
  $hw4 = 0;

  session_name ("b_y6fcPbVeYEmN^NNfW+A*myn8SsXxAuw9!3?LawN8Np^5tDdXe3EzVMFC9k=dwuHTuLeE5CG5@?-KfZLhzF+L+wqqGB*#6LQsFF=uATu_N9P@!JpzFegDE2ZQtndRrT");
  session_start();

  // Token generator
  $newToken = generateFormToken('signin');   
  function generateFormToken($form){
    // generate a token from an unique value
    $token = md5(uniqid(microtime(), true));  
    // Write the generated token to the session variable to check it against the hidden field when the form is sent
    $_SESSION[$form.'_token'] = $token; 
    return $token;
  }

  static $level = -1;
  if( isset($_SESSION["admin"]) && isset($_SESSION["logged"]) && $_SESSION["logged"] ){
    $level = $_SESSION["admin"];
  }

  function title(){
    global $level;
    switch ($level) {
      case ADMIN:
      return "Admin";
      case DEV:
      return "Developer";
      case DEVDEV:
      return "Designer";
      case USER:
      return "User";
      case ANON:
      return "Error";
    }
  }

  function titleByInt($val){
    switch ($val) {
      case ADMIN:
      return "Admin";
      case DEV:
      return "Developer";
      case DEVDEV:
      return "Designer";
      case USER:
      return "User";
      case ANON:
      return "Error";
    }
  }

  function title_span(){
    global $level;
    switch ($level) {
      case ADMIN:
      $body = ' <span class="admin-acct label label-default">Admin</span>';
      break;
      case DEV:
      $body= ' <span class="dev-acct label label-default">Developer</span>';
      break;
      case DEVDEV:
      $body = ' <span class="des-acct label label-default">Designer</span>';
      break;
      case USER:
      $body = ' <span class="user-acct label label-default">User</span>';
      break;
    }
    return $body;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Team Nine</title>

    <!-- Bootstrap core CSS -->
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/team/style.css" rel="stylesheet">

  </head>

  <body>    
    <?php // NAVBAR
      include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar.php"); 
    ?>
    
    <div class="container">
      
      <?php // LOGIN ALERT
        include("$_SERVER[DOCUMENT_ROOT]/jrrrs/alert.php");
      ?>
      
      <?php // ERROR DETAIL, used in dashboard and site management
        $errordetail = include("$_SERVER[DOCUMENT_ROOT]/jrrrs/errordetail.php"); 
      ?>
      
      <?php // Jumbotron, DASHBOARD, DEVDEV+
        include("$_SERVER[DOCUMENT_ROOT]/jrrrs/rengine9.php");
      ?>
      
      <?php // Jumbotron, SITE MANAGEMENT, DEV+
        include("$_SERVER[DOCUMENT_ROOT]/jrrrs/rengine9pro.php");
      ?>


      <div id="home" class="jumbotron">

        <!-- Marketing picture -->
        <div class="marketing"></div>
        <div>
          <h2>Meet the <b>NEW</b> generation of error tracking</h2>
          <p style="font-size:18px">Here at <i>Team Nine</i> we understand the need for speed, accuracy and precision. Our company started with a single goal in mind, providing the best possible solution to our clients. In July 2013, we at <i>Team Nine</i> brought you 39 <i>UCSD&copy;</i> awards winning <strong>REngine <span style="color:red">8</span></strong>. This year we are proud to present the next iteration of unchallenged <b>Performance + Efficiency</b>. Introducing the all new 2014 <i>Team Nine</i> <strong>REngine <span style="color:lightseagreen">9</span></strong>. The new generation of error tracking.</p>
          <div style="text-align:right">
            <span style="font-size:18px">Sign up now, </span> 
            <button type="button" class="btn btn-default btn-lg signin-btn" style="background-color:black; color:white">
              Experience <strong>REngine <span style="color:lightseagreen">9</span></strong>
            </button>
          </div>
        </div>

        <div class="row" style="margin-top: 10px">
          <div class="col-md-6"><h3><b>STATE OF THE ART</b> error handling</h3>
            <p style="font-size:18px">With our completely revamped proprietary <i>JRRRS UI&copy;</i>, we are redefining the future of error handling. Experience the future, experience endless choices, infinite customization. Live on <i>JRRRS UX&copy;</i>.</p>
          </div>
          <div class="col-md-6"><h3><b>UNPRECENDENTED</b> performance</h3>
            <p style="font-size:18px">Servers around the globe awake just for you. You matter. Our handcrafted AI built for maximum performance to give you unparallelled access wherever you are, whenever you want.</p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6"><h3>Go <strong>REngine <span style="color:lightseagreen">9 </span> PRO</strong></h3>
            <p style="font-size:18px">Managing a website solo can be taxing. Invite fellow developers and designers with the professional version of <strong>REngine <span style="color:lightseagreen">9</span></strong>. Unobstructed access, VVIP service. "You have control" -Rolando <i>CEO Team Nine Inc.</i></p>
            <div style="text-align:center">
              <button type="button" class="btn btn-default btn-lg" style="background-color:black; color:white">
                Get <strong>REngine <span style="color:lightseagreen">9 </span>PRO</strong>
              </button>
            </div>
          </div>
          <div class="col-md-6"><h3>Defining <b>OMNIPRESENCE</b></h3>
            <p style="font-size:18px">When we look for errors, we look everywhere, and we mean Every. Single. Where. Guaranteed by our industry defining professionals at <i>Team Nine</i>.</p>
          </div>
        </div>

      </div> <!-- END HOME -->

      <div id="team" class="jumbotron">
        <div id="curly" style="display:none;cursor:pointer;" onclick="$(this).hide();$('#team-container').show();"><img style="width:100%;height:auto;" src="/team/images/curly.gif" alt="Strike 3 Curly.."></div>
        <div id="team-container">
          <h2>Meet Team Nine</h2>
          <span style="text-align:left; margin:0">Click to know more.</span>
          <section class="members"> 
          <div class="members" id="div-jessica"><header class="members"><h3>Jessica</h3></header><article class="members"><img  src="/team/images/jessica.jpg" data-click=".jessica-data" class="img-circle members" alt="Jessica"></article></div>
          <div class="members" id="div-rick"><header class="members"><h3>Rick</h3></header><article class="members"><img  src="/team/images/rick.gif" data-click=".rick-data" class="img-circle members" alt="Rick"></article></div>
          <div class="members" id="div-rolando"><header class="members"><h3>Rolando</h3></header><article class="members"><img  src="/team/images/rolando.gif" data-click=".rolando-data" class="img-circle members" alt="Rolando"></article></div>
          <div class="members" id="div-rosheni"><header class="members"><h3>Rosheni</h3></header><article class="members"><img src="/team/images/rosha.jpg" data-click=".rosheni-data" class="img-circle members" alt="Rosheni"></article></div>
          <div class="members" id="div-steve"><header class="members"><h3>Steve</h3></header><article class="members"><img  src="/team/images/steve.jpg" data-click=".steve-data" class="img-circle members" alt="Steve"></article></div></section>

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

      <div id="docs" class="jumbotron">
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
            <li>Accounts created for each group member, “user” account was subsequently deleted.</li>
            <li>SSH Jailing for failing 10 login attempts (30 minute IP ban)</li></ol>

          <h4>Apache</h4>
          <ol>
            <li>Access denied on everything outside of our viewable documents.</li>
            <li>Hid verbose Apache headers</li>
            <li>Used pretty url’s to hide php extensions</li>
            <li>Using logging and Awstats to display on admin page</li>
            <li>Put authentication requirements on extremely sensitive php scripts (such as deploy, awstats, phpinfo). The login credentials are the same that are used for accessing the team page.</li>
            <!--li value="5" style="list-style:none"><ul><li>The best solution would be using SSL. We created an SSL cert and enabled the SSL Engine, but our site isn’t “third party verified,” in which case we had to drop the SSL cert.</li></ul></li-->
            <li>Using SSL with High Grade 128 AES Encrypted Key (*not third party trusted)</li>
          </ol>

          <h4>PHP</h4>
          <ol>
            <li>Hid PHP information in header</li>
            <li>Turned on error logging</li>
            <li>Session encryption using SHA512</li>
            <li>Session encryption randomness using /dev/urandom</li>
            <li>Using randomly generated session ID</li>
            <li>Using session tokens generated from Server tick count as validation during login attempts</li>
          </ol>

          <h4>Logging</h4>
          <ol>
            <li>Used AWStats for a log analysis report</li>
            <li>Access to report denied without proper login information</li>
            <li>Report run every nine minutes</li>
          </ol></div>
      </div>

      <div id="proj" class="jumbotron">
        <h2>Our Project Progress</h2>
        <div style="margin: 20px 20px 0 20px;width:100%;">
          <h4>Homework 1</h4>
          <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw1; ?>%">
              <?php echo $hw1; ?>% Complete 
            </div>
          </div>
          <h4>Homework 2</h4>
          <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw2; ?>%">
              <?php echo $hw2; ?>% Complete
            </div>
          </div>
          <h4>Homework 3</h4>
          <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw3; ?>%">
              <?php echo $hw3; ?>% Complete
            </div>
          </div>
          <h4>Homework 4</h4>
          <div class="progress">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $hw4; ?>%">
              <?php echo $hw4; ?>% Complete
            </div>
          </div>
        </div>
      </div>

      <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/footer.html"); ?>
    </div> <!-- /container -->

    <!-- Scripts -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/team/bootstrap/js/bootstrap.min.js"></script>
    <script src="//code.highcharts.com/highcharts.js"></script>
    <script src="//code.highcharts.com/modules/exporting.js"></script>
   
    <script>
      // Grab file from upload dialog
      $('#upload-screen').change(function(click) {
        var file = this.value;
      });
      
      $('#adduser-btn').click(function(){
        var span = $(this).find("span");
        if (span.hasClass("glyphicon-circle-arrow-up")) {
          span.addClass("glyphicon-circle-arrow-down");
          span.removeClass("glyphicon-circle-arrow-up");
          $("#adduser-container").slideUp(300);
        } else {
          span.addClass("glyphicon-circle-arrow-up");
          span.removeClass("glyphicon-circle-arrow-down");
          $("#adduser-container").slideDown(300);
        }
      });

      $(function () {
        $("[data-rel='tooltip']").tooltip();
      });

      $(function () {
        $("[data-toggle='popover']").popover();
      });

      $('html').click(function(){
        $('#curly').hide();$('#team-container').show(); });

      $('.ignoreme').click(function(event){
        event.stopPropagation(); });
      
      $('#ad-show-users').click(function() {
        $('.jumbotron').hide();
        $('#usrmgt').show();});     

      $('#show-errors').click(function () {
        $('#errors-toggle').slideToggle("fast", function () {

          $('#userGraph').highcharts({
            title: {
              text: 'Monthly Error Tracking',
              x: -20 //center
            },
            subtitle: {
              text: 'Month of August',
              x: -20
            },
            xAxis: {
              categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25',
                           '26','27','28','29','30','31']
            },
            yAxis: {
              title: {
                text: 'Error Occurences'
              },
              plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
              }]
            },

            legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
            },
            series: [{
              name: 'RP (Resistricted Page Attempts)',
              data: [0,0,0,0,0,0,0,0,0,0,0,0,1]
            }, {
              name: 'FL (Failed Login Attempts)',
              data: [0,0,1,0,0,0,0,0,0,0,0,5,0]
            }]
          });
        });

      });

      $('.dropdown-toggle').dropdown();
      /*
      $('.signin-btn').click(function(){
        $("$signin-menu").click('toggle'); // this works
      });
      */
      
      // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
  $('.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown("fast");
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN //
  $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp("fast");
  });
      
      $('#userData').on('shown.bs.modal', function() {

        $(function () {

          $('#alluserGraph').highcharts({
            title: {
              text: 'Monthly Error Tracking',
              x: -20 //center
            },
            subtitle: {
              text: 'Month of August',
              x: -20
            },
            xAxis: {
              categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25',
                           '26','27','28','29','30','31']
            },
            yAxis: {
              title: {
                text: 'Error Occurences'
              },
              plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
              }]
            },
            tooltip: {
              valueSuffix: '°C'
            },
            legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
            },
            series: [{
              name: 'RP (Resistricted Page Attempts)',
              data: [0,0,0,0,0,0,0,0,0,0,0,0,1]
            }, {
              name: 'FL (Failed Login Attempts)',
              data: [0,0,1,0,0,0,0,0,0,0,0,5,0]
            }]
          });
        });
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



      Highcharts.createElement('link', {
        href: 'http://fonts.googleapis.com/css?family=Unica+One',
        rel: 'stylesheet',
        type: 'text/css'
      }, null, document.getElementsByTagName('head')[0]);

    </script>



  </body>
</html>

