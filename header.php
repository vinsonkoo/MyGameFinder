<html lang="en">
<?php
$uri = $_SERVER['REQUEST_URI'];
$dir = __DIR__;
$dir = substr($dir, strpos($dir, '/deploys'));
$seconds = filemtime($_SERVER['SCRIPT_FILENAME']);
$timestamp = date(DateTime::RFC850, $seconds);
?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/game_finder_favicon.jpg">

    <title>Game Finder</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.0.3/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jquery  -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.js"></script>
    <!-- type ahead support  -->
    <script type="text/javascript" src="typeahead/typeahead.js"></script>
    <script type="text/javascript" src="typeahead/hogan-2.0.0.js"></script>


    <!-- reset styles per yui -->
    <!-- <link rel="stylesheet" type="text/css" href="//yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css"> -->
    <!-- include our css and datable css -->
    <style type="text/css" title="currentStyle">
      @import "css/gamefinder.css?cachebust=<?php echo $seconds?>";
      @import "css/jquery.datatables.css?cachebust=<?php echo $seconds?>";
      /* @import "//ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css"; */
      /*@import "//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/ui-darkness/jquery-ui.css";*/
    </style>

    <!-- the following is for a workaround for placeholders not showing in IE -->
    <!--[if IE]>
    <link rel="stylesheet" type="text/css" href="css/ie-gamefinder.css" />
    <![endif]-->

    <!-- the following script is for google analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-47217320-1', 'mygamefinder.com');
    ga('send', 'pageview');
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';

    </script>


  </head>
  <body>

    <div class="background_container"></div>

    <div class="container">

      <div class="row"> <!-- .header -->
        <div class="navbar navbar-default navbar-static-top header" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
              <img class="logo" src="images/gamefinderlogo_3.png"/>
              <i class="beta">(BETA)</i>
            </a>
          </div> <!-- .navbar-header -->
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact Us</a></li>
              <li><a href="http://www.mygamefinder.com/blog/" target="_blank">Blog/Updates</a></li>
              <li class="social_icon_list">
                <a href="https://www.facebook.com/mygamefinder" target="_blank">
                  <img class="social_icons" src="images/facebook.png">
                  <span class="social_media_text">Facebook
                </a>
              </li>
              <li class="social_icon_list">
                <a href="https://twitter.com/mygamefinder" target="_blank">
                  <img class="social_icons" src="images/twitter.png">
                  <span class="social_media_text">Twitter
                </a>
              </li>
              <li class="social_icon_list">
                <a href="https://plus.google.com/107452301313152435650" target="_blank">
                  <img class="social_icons" src="images/google+.png">
                  <span class="social_media_text">Google+
                </a>
              </li>
            </ul>
          </div> <!-- .navbar-collapse -->
<?php if (StringUtils::startsWith($uri,'/test') || StringUtils::contains($uri,'/src/main/webapp')) { ?>
          <div>
            <b style="color:yellow;margin-left:10px;">Test Build #: <?php echo $dir?></b><br/>
            <b style="color:yellow;margin-left:10px;">Deployed at: <?php echo $timestamp?></b>
          </div>
<?php } ?>
        </div>
      </div> <!-- .row -->

    </div> <!-- .container -->
