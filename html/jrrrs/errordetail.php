<?php
  // RETURNS html

  // ERROR DETAIL, used on dashboard + site management

  // $date: MM/DD/YYYY HH:MM:SS
  // $class: info, warning, error, danger
  // Formats single row on table
  function row($class, $occurences, $date, $error, $comment){
    $v1 = "";
    $v2 = "";
    $v3 = "";
    $v4 = "";
    switch ($class) {
      case "info":
        $v1 = "selected";
        break;
      case "warning":
        $v2 = "selected";
        break;
      case "error":
        $v3 = "selected";
        break;
      default:
        $v4 = "selected";
    }
    
    $body = <<< HTML
      <tr class=$class>
        <td><span class="label label-$class">$occurences</span></td>
        <td>$date</td>
        <td>$error</td>
        <td>
          <select class="form-control">
            <option $v1>Info</option>
            <option $v2>Warning</option>
            <option $v3>Error</option>
            <option $v4>Severe</option>
          </select>
        </td>
        <td><input type="text" class="form-control" value="$comment"></td>
      </tr>
HTML;
    return $body;
  }

  // Put data here
  $list = row("warning", "1", "8/3/2014 10:20:39", "Failed login attempt", "Serious comment") .
          row("danger", "3", "8/12/2014 11:22:50", "Failed login attempt", "Possible hacking attempt") .
          row("warning", "1", "8/13/2014 10:20:39", "Failed login attempt", "I'm in") ;

  /* MAIN */

  $body = <<< HTML

    <div class="table-responsive">
      <table class="table table-striped" >
        <thead>
          <tr>
            <th>Occurences</th>
            <th>Date</th>
            <th>Error</th>
            <th>Level</th>
            <th>Comment</th>
          </tr>
        </thead>
        <tbody>
          $list
        </tbody>
      </table>
    </div>
HTML;
  return $body;
?>