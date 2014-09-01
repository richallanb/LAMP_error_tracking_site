<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Team Nine</title>

    <!-- Bootstrap core CSS -->
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/team/style.css" rel="stylesheet">

    <style>
    </style>
    
  </head>

  <body>
   
    
    <div class="container">
      
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">

        <div class="navbar-header">
          <span class="navbar-brand">Team Nine</span>
        </div>

        <div class="collapse navbar-collapse">       
          <ul id="the-navbar" class="nav navbar-nav navbar-left">
            <li id="oneli" class="active" ><a id="onea" href="#one" role="tab" data-toggle="tab">One</a></li>
            <li id="twoli"><a id="twoa" href="#two" role="tab" data-toggle="tab">Two</a></li>
            <li id="threeli" ><a id="threea" href="#three" role="tab" data-toggle="tab">Three</a></li>
          </ul>
        </div>
      </div>
    </nav>
        
     <div class="tab-content">               
      <div id="one" class="tab-pane jumbotron">
        <h1>ONE</h1>
      </div>
      
      <div id="two" class="tab-pane jumbotron">
        <h1>ONE</h1>
        <h1>TWO</h1>
      </div>
      
      <div id="three" class="tab-pane jumbotron">
        <h1>ONE</h1>
        <h1>TWO</h1>
        <h1>THREE</h1>
      </div>
      
      </div>

    </div> <!-- /container -->

    <!-- Scripts -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/team/bootstrap/js/bootstrap.min.js"></script>
    <script src="//code.highcharts.com/highcharts.js"></script>
    <script src="//code.highcharts.com/modules/exporting.js"></script>
    <script src="/team/js/scripts.js"></script>
    <script>  
      
      $(function() {        
          /*
          var hash = window.location.hash;
          var url = document.URL;
 
          if(hash == "#one-tab"){
            $('.jumbotron').hide();$('#one-tab').show();
          }
          else if(hash == "#two-tab"){
            $('.jumbotron').hide();$('#two-tab').show();
          }
          else if(hash == "#three-tab"){
            $('.jumbotron').hide();$('#three-tab').show();
          }
          else {
            $('.jumbotron').hide();$('#one-tab').show();
          }
          */
      });
      
      
      
    $(document).ready(function () {

      // cache the id
      var navbox = $('#the-navbar');

      // activate tab on click
      navbox.on('click', 'a', function (e) {
        var $this = $(this);
        // prevent the Default behavior
        //e.preventDefault();
        // send the hash to the address bar
        window.location.hash = $this.attr('href');
        // activate the clicked tab
                
        //$('.jumbotron').hide();
        //$('#one-tab').show();
        
        //$('.jumbotron').hide();
        //$(this.id).show();
        
        //$this.tab('show');
      });

      // will show tab based on hash
      function refreshHash() {
        navbox.find('a[href="'+window.location.hash+'"]').tab('show');
      }

      // show tab if hash changes in address bar
      $(window).bind('hashchange', refreshHash);

      // read has from address bar and show it
      if(window.location.hash) {
        // show tab on load
        refreshHash();
      }
    
    });
      
    </script>



  </body>
</html>