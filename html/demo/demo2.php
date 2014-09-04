<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>REngine9 Demo</title>
    
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/team/bootstrap/css/style.min.css" rel="stylesheet">
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
    <script type="text/javascript">
             
             function infinite()
             {
               for (var i=100; i < 100; i++) {
                 var b = i;
               }
             }
            
            function reference() {
              foo;
            }
            
            function evaluateError () {
              eval(3+ten);
            }
            
            function syntax() {
              eval("3+5);
            }
                 
           function range(){
            //RangeError
            var a = new Array(1);
            function recurse(a){
            a[0] = new Array(1);
            recurse(a[0]);
            } 
              recurse(a); 
           }
          
            function testStrict(){
             "use strict";
              x = 3.14; // This causes an error. 
            }
   
        </script>
    
  </head>
  <body>
    
    <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar_light.html"); ?>
    
    <div class="container container-padded">
      <div class="jumbotron">
        <h2>REngine9 Demo</h2>
        
      <button type="button" onclick="zzz();" class="btn btn-danger">Trigger a non-exist function Error</button>  
      <button type="button" onclick="testStrict();" class="btn btn-danger">Trigger a strict Error</button>
        <button type="button" onclick="infinite();" class="btn btn-danger">Infinite</button>  <br> <br>
        <button type="button" onclick="range();" class="btn btn-danger">range</button>  <br> <br>
        <button type="button" onclick="reference();" class="btn btn-danger">Reference Error</button>  
      <button type="button" onclick="evaluateError();" class="btn btn-danger">eval Error</button>
        <button type="button" onclick="syntax();" class="btn btn-danger">Syntax Error</button>  <br> <br>
        <button type="button" onclick="aaalert("hi");" class="btn btn-danger">Actual Syntax Error</button>
        <button type="button" onclick="function=hi" class="btn btn-danger">Strict</button> 
             
      </div>
      
      <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/footer.html"); ?>
      
    </div>

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
'Ausr' : null, 'Ausrid' : 'VCDcE4JZTzfgc','Aprj' : 'jcQDw6fdG/7UY', 'ADD' : null};
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
    
  </body>
</html>