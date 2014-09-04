<!DOCTYPE html>
<html lang="en">
  <head>
    
    <title>REngine9 Demo</title>
    
    <link href="/team/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/team/style.css" rel="stylesheet">
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    
  </head>
  <body>
    
    <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/navbar_light.html"); ?>
    
    <div class="container container-padded">
      <div class="jumbotron">
        <h2>REngine9 Demo</h2>
        
        <button type="button" onclick="rolling();" class="btn btn-danger">Trigger a JS Error</button>
        
      </div>
      
      <?php include("$_SERVER[DOCUMENT_ROOT]/jrrrs/footer.html"); ?>
      
    </div> 
    
    
    
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="/team/bootstrap/js/bootstrap.min.js"></script>
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
'Ausr' : null, 'Ausrid' : 'Kg8ORCqb.O9rQ','Aprj' : 'TzY0y7rO0aOuY', 'ADD' : null};
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