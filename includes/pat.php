<?php
/**
 * Raspbian PAT WiFi Configuration Portal
 *
 * Enables use of simple web interface rather than SSH to control PAT on the Raspberry Pi.
 * Add modules to install i.e ARDOP, ARIM etc
 * 
 * @author     Kai Gunter Brandt <kai.gunter.brandt@gmail.com>
 * @license    
 * @version    0.0.1
 * @link       https://github.com/LA3QMA/PATPiBox
 * @see        http://
 */

include_once('includes/config.php');
include_once('includes/pat_config.php');
include_once('includes/ardop_config.php');
include_once('includes/functions.php' );
include_once('includes/dashboard.php' );

$output = $return = 0;
$page = $_GET['page'];
session_start();

if (empty($_SESSION['csrf_token'])) {
    if (function_exists('mcrypt_create_iv')) {
        $_SESSION['csrf_token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
$csrf_token = $_SESSION['csrf_token'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Raspbian PAT Configuration Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="<?php echo $theme_url; ?>" title="main" rel="stylesheet">

    <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">PAT Wifi Portal v0.0.1</a>
        </div>
        <!-- /.navbar-header -->

        <!-- Navigation -->
        <div class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
              <li>
                <a href="index.php?page=pat_info"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
              </li>
              <li>
                <a href="index.php?page=pat_conf"><i class="fa fa-wrench fa-fw"></i> Configure PAT</a>
              </li>
              <?php if ( PAT_ARDOP_ENABLED ) : ?>
              <li>
                <a href="index.php?page=ardop_conf"><i class="fa fa-dot-circle-o fa-fw"></i> Configure ARDOP</a>
              </li>
              <?php endif; ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.navbar-default -->
      </nav>

      <div id="page-wrapper">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">
              <img class="logo" src="img/PAT-logo.png" width="45" height="45">PAT
            </h1>
          </div>
        </div><!-- /.row -->

        <?php 
        // handle page actions
        switch( $page ) {
          case "pat_info":
            DisplayDashboardPAT();
            break;
          case "pat_conf":
            DisplayPATConfig();
            break;
          case "ardop_conf":
            ARDOPConfig();
            break;
          default:
            DisplayDashboardPAT();
        }
        ?>
      </div><!-- /#page-wrapper --> 
    </div><!-- /#wrapper -->

    <!-- RaspAP JavaScript -->
    <script src="dist/js/functions.js"></script>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!--script src="vendor/raphael/raphael-min.js"></script-->
    <!--script src="vendor/morrisjs/morris.min.js"></script-->
    <!--script src="js/morris-data.js"></script-->

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Custom RaspAP JS -->
    <script src="js/custom.js"></script>
  </body>
</html>
