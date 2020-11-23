<?php 
  include_once("includes/class.database.php");
  include_once("includes/class.users.php");
  include_once("includes/class.safemysql.php");
    
  $loggedin = $override = false;
  $db = new db();
  $opts = [
    //'host'      => 'https://a2plcpnl0334.prod.iad2.secureserver.net',
    'host'      => 'localhost', 
    'user'      => 'cncmaster',
    'pass'      => '6fYY3zJrnqHkaML',
    'db'        => 'cncadmin',
    'charset'   => 'utf8mb4',
    'port'      => 3306,
    'socket'    => null,
  ];

  $safedb = new SafeMySQL($opts);
  $users = new users($safedb);
  $usersList = $users->getAllUsers();
  $roles = $db->roles; 
  $page = $_GET['page'] ?? 'dashboard';
  if ($page == 'login' || $page == 'register'):
    $override = true;
  endif;
  if (!$loggedin && !$override):
    die("You do not have access to this page");
  endif;
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Custom Dashboard">
    <meta name="author" content="Cynthia Sheek">
    <title>Rays Collectibles</title>
    <?php include_once("includes/page_header.php"); ?>
        
    <!-- Custom styles for this bootstrap template -->
    <link href="assets/css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <?php 
      //don't include nav for these pages
      if ($page == 'login'): 
        include_once("login.php"); 
        include_once("includes/page_footer.php");
        exit;
      elseif ($page == 'register'):
        include_once("register.php");
        include_once("includes/page_footer.php");
        exit;
      endif;

      include_once("nav.php");
    ?>

  <div class="container-fluid">
    <?php include_once("leftnav.php"); ?>

    <?php 
    //route according to page
      switch($page){
        case "portal": include("portal.php"); break;
        case "users" : include("users.php");  break;
        case "pull"  : include("pull_list.php");  break;
        default:       include("dashboard.php"); break;
      }
    ?>
  </div>

  <?php include_once("includes/page_footer.php"); ?>

</html>
