<?php
  
  // From mysql.php, for querying user
  define ("MYSELF", 0);
  define ("USER", 0); // NEEDED FOR LEGACY CODE!!!
  define ("ADMIN", 3); // NEEDED FOR LEGACY CODE!!!
  // For validation
  $pw_reg = "/.{8,}/";
  $user_reg = "/^[a-zA-Z](([a-zA-Z0-9]+)|_([a-zA-Z0-9]+)){5,21}$/";
  $name_reg = "/[\w ]+/";
  $site_path = 'https://team.ninth.biz';
  define ('PASS_REGEX', $pw_reg);
  define ('USER_REGEX', $user_reg);
  define ('NAME_REGEX', $name_reg);
  define ('SITE_PATH', $site_path);
?>