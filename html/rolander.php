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
   
    
    <div class="container">
      
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">

        <div class="navbar-header">
          <span class="navbar-brand">Team Nine</span>
        </div>
          
        <div class="collapse navbar-collapse">       
          <ul id="the-navbar" class="nav navbar-nav navbar-left">
            <li><a href="#one" data-toggle="tab">One</a></li>
            <li><a href="#two" data-toggle="tab">Two</a></li>
            <li><a href="#three" data-toggle="tab">Three</a></li>
          </ul>
        </div>
      </div>
    </nav>
        
     <div class="tab-content">               
      <div id="one" class="tab-pane active jumbotron">
        <h1>ONE</h1>
      </div>
      
      <div id="two" class="tab-pane jumbotron">
        <h2>TWO</h2>
      </div>
      
      <div id="three" class="tab-pane jumbotron">
        <h2>THREE</h2>
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
      
    $(document).ready(function () {

      // cache the id
      var navbox = $('#the-navbar');

      // activate tab on click
      navbox.on('click', 'a', function (e) {
        var $this = $(this);
        // prevent the Default behavior
        e.preventDefault();
        // send the hash to the address bar
        window.location.hash = $this.attr('href');
        // activate the clicked tab

        $this.tab('show');
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