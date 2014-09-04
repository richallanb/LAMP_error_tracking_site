<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>REngine9 Demo</title>
    
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/team/bootstrap/css/style.min.css" rel="stylesheet">
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
  </head>
  <body>
    
    <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar_light.html"); ?>
    
    <div class="container container-padded">
      <div class="jumbotron">
        <h2>REngine9 Demo</h2>
        
                     
      <button type="button" onclick="zzz()" class="btn btn-danger">Trigger a non-exist function Error</button>  
      <button type="button" onclick="testStrict()" class="btn btn-danger">Trigger a strict Error</button>
        <button type="button" onclick="Error()" class="btn btn-danger">Error</button>  <br> <br>
         <button type="button" onclick="typeError()" class="btn btn-danger">TypeError</button>  <br> <br>
        <button type="button" onclick="range()" class="btn btn-danger">range</button>  <br> <br>
        <button type="button" onclick="reference()" class="btn btn-danger">Reference Error</button>  
      <button type="button" onclick="evaluateError()" class="btn btn-danger">eval Error</button>
        <button type="button" onclick="syntax()" class="btn btn-danger">Syntax Error</button>  <br>   
        
        
        <script type="text/javascript">
             function typeError()
          { 'use strict';
               var num = 234; num.substr(1,1);  
               var p1 = document.createElement('p');
          }
          
             function Error()
             { 'use strict';
               adddlert("Hallo");
             }
            
            function reference() {
               'use strict';
              foo;
            }
            
            function evaluateError () {
               'use strict';
              eval(3+ten);
            }
            
            function syntax() {
               'use strict';
              eval("3+5);
            }
                 
           function range(){
         throw new RangeError();
                
           }
          
            function testStrict(){
             "use strict";
              x = 3.14; // This causes an error. 
            }
   
              </script>
      
      </div>
      
      <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/footer.html"); ?>
      
    </div> 
    
    
    
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="/team/bootstrap/js/bootstrap.min.js"></script>   
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
window.onerror = function(msg, url, line, col, error) {
var extra = !col ? '' : "\ncolumn: " + col;
extra += !error ? '' : "\nerror: " + error;
var severity = 0;
if (error) {
switch (error.name) {
case 'EvalError':
case 'RangeError':
case 'TypeError':
severity = 1;
break;
case 'ReferenceError':
case 'SyntaxError':
default:
severity = 0;
break;
}
}
console.log('Error: ' + msg + "\nurl: " + url + "\nline: " + line + "\nseverity: " + severity + extra);
addError(msg, url,line, severity);
var suppressErrorAlert = true;
return suppressErrorAlert;
}
function addError(msg, url, line, severity) {
var formData = {'Aerr' : msg, 'Aline' : line, 'Asrc' : url, 'Asever' : severity, 'Ameth' : null, 
'Ausr' : null, 'Ausrid' : 'YI2VKiZ33YOxE','Aprj' : 'Y9IL6rw8whS2Y', 'ADD' : null};
$.ajax({
url: 'https://team.ninth.biz/team/php/logerror.php',
type: 'POST', 
data: formData,
dataType: 'html'
})
.done(function( msg ) { 
//Anything you might want to do after success
})
}
</script>