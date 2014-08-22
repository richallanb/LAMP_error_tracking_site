<?php 
  // REQUIRES echo to show

  // SITE MANAGEMENT, enabled for DEV+
  $admin_deploy = "";
  $admin_option = "";
  $admin_modify = "";
  $dev_modify = "";

  /* Generates user entries for user management table */
  // Privilege checking done in function. Will return empty string if privileges not correct
  function userEntry($username, $priv, $lastLogin, $created){
    global $level;
    $sPriv = titleByInt($priv);
    $body = "";
    $changePriv = "";
    if ($level == ADMIN) {
      $changePriv = '<li><a href="#">Change Privileges</a></li>';
    }
    if ($level > $priv || $level == ADMIN) {
      $body = <<< HTML
        <tr>
          <td>$username</td>
          <td>*********</td>
          <td>$sPriv</td>
          <td><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#userData"><span class="glyphicon glyphicon-chevron-down"></span>&nbsp;View</button></td>
          <td>$lastLogin</td>
          <td>$created</td>
          <td><div class="btn-group">
            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-down"></span>&nbsp;Modify </button>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Reset</a></li>
              $changePriv
              <li><a href="#">Contact</a></li>
              <li><a href="#">Ban</a></li>
              <li class="divider"></li>
              <li><a href="#">Delete</a></li>
            </ul>
          </div></td>
        </tr>
HTML;
    }
    return $body;
  }

  $userList = userEntry("teamAdmin", 3, "8/15/2014 12:00:39", "8/10/2014 12:10:22") . 
    userEntry("theFuzz", 2, "8/15/2014 12:00:39", "8/10/2014 12:10:22").
    userEntry("otherGuy", 1, "8/20/2014 12:01:39", "8/13/2014 12:10:22");

  if($level == ADMIN) {
    $admin_option = <<< HTML
      <option value="2">Developer</option>
      <option value="3">Admin</option>
HTML;
  }  
                  
  if($level >= DEV) {
    // JUMBOTRON
    $html = <<< HTML
      <div class="jumbotron" id="usrmgt">
        <h2 style="margin:20px 0px 3px 0px">User Management</h2>
          <span style="font-family:verdana">powered by <strong>REngine <span style="color:lightseagreen">9</span></strong></span>

          <div class="row placeholders" style="margin:20px 0 10px 0;">
            <div class="panel panel-default">
              <div class="panel-heading"  style="display:inline-block; width:100%" id="adduser-btn">
                <h3 class="panel-title" style="float:left;">Add User</h3>
                <span style="float:right;" class="glyphicon glyphicon-circle-arrow-down"></span>
              </div>
            <div class="panel-body" id="adduser-container">
              <form class="form-adduser" name="adduser" id="adduser" role="form" method="post" action="#">
                <div><input name="Suser" type="text" class="form-control" placeholder="Username" required autofocus style="margin:0"></div>
                <div><select name="Spriv" id="Spriv" class="form-control" required>
                  <option value="" disabled selected style="display:none;">Access</option>
                  <option value="0">User</option>
                  <option value="1">Designer</option>
                  $admin_option
                </select></div>
                <div><div class="input-group" style="margin-bottom: 5px;">
                  <div class="input-group-addon">@</div>
                  <input class="form-control" type="email" name="Semail" placeholder="Enter email" required>
                </div></div>
                <div><input name="Spassword" type="password" class="form-control" placeholder="Password" required style="margin:0"></div>     
                <div>
                  <input name="Srepassword" type="password" class="form-control" placeholder="Retype Password" required style="margin:0">               
                </div>    
                <div><button class="btn btn-default btn-block" name="Ssubmit" type="submit">Add User</button></div>
              </form>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Access</th>
                <th>Error Report</th>
                <th>Last Login Date</th>
                <th>Creation Date</th>
                <th></th>     
              </tr>
            </thead>
            <tbody>
              $userList
            </tbody>
          </table>
        </div>

          <ul class="pager">
            <li><a href="#">Previous</a></li>
            <li><a href="#">Next</a></li>
          </ul>
        </div>
HTML;
    echo $html;
    
    // MODAL
    $html = <<< HTML
      <div class="modal fade" id="userData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">Error Log</h4>
            </div>
            <div class="modal-body" style="display:block;">
              <div id="alluserGraph" style="width:100%;"></div>
              $errordetail
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
HTML;
    echo $html;
  }
?>