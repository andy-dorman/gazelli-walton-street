<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);
require 'lib/db.php';

$query = "SELECT * FROM customers ORDER BY RAND() LIMIT 0,13;";
  
//$result = $mysqli->query($query);
$result = mysql_query($query);


function getInitals($name) {
  $initials = "";
  $expName = explode(" ", $name);
  if (count($expName) > 1) {
    $initals .= substr($expName[0], 0, 1);
    $initals .= substr($expName[(count($expName) - 1)], 0, 1);
  } else {
    $initials .= substr($expName[0], 0, 2);
  }

  return $initials;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">

<title>Gazelli Keys</title>

<!-- Bootstrap core CSS -->
<link href="stylesheets/style.css" rel="stylesheet">
<link href="stylesheets/jquery.fancybox.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Favicons -->
<link rel="apple-touch-icon-precomposed" href="/apple-touch-icon-precomposed.png">
<link rel="icon" href="/favicon.ico">

  </head>
  <body>
    <div class="container">
    <div>
      <a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>

      <!-- Docs master nav -->
      <header class="navbar navbar-static-top text-center bottom-hr" id="top" role="banner">
        <div class="navbar-header">
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="../" class="navbar-brand">Walton Street</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav">
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
          </ul>
        </nav>
        <div>
          <h2 class="separator">Dream</h2>
          <h2 class="separator">Live</h2>
          <h2 class="separator">Learn</h2>
        </div>
        <h3>Unlock the potential within</h3>
      </header>
      </div>

      <div>
        <!-- Page content of course! -->
        <main class="bottom-hr text-center" id="content" role="main">
            <p class="lead">
              Introducing  a new approach to luxury and well-being
            </p>
            <p>
              Full details will be revealed in March 2015, but for now we ask you this: if you could achieve one thing, what would it be? Determine your goal, lock it safely with us, and you’ll have already taken the first step towards making it happen.
            </p>
        </main>

        <div class="bottom-hr">
          <h3 class="text-center"><a href="#" id="lock-in-link">LOCK IN YOUR GOAL & HANG YOUR KEY</a></h3>
        </div>
      </div>


      <div class="key-panel-row bottom-hr">
        <div class="key-panel col-sm-3 lock-in">
            <p class="text-uppercase text-center">
            Lock in your goal
            </p>
            <div>
              <p class="text-uppercase text-center">
              Lock in your goal
              </p>
            </div>
        </div>

        <?php
        $count = 1;
        if($result) {
          while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            if ($count%4 == 0) {
            ?>
            </div>
            <div class="key-panel-row bottom-hr">
            <?php
            }
            ?>
            <div class="key-panel col-sm-3 goal">
              <h4><?php echo getInitals($row['name']);?></h4>
              <div>
                <h4 class="text-uppercase text-center">My goal is to</h4>
                <p class="text-center"><?php echo $row['goal']; ?></p>
              </div>
            </div>
            <?php
            $count++;
          }
          mysql_free_result($result);

        }
        $modCount = 4 - $count%4;
        $count = $modCount + 4;
        for($i = $count; $i > 0; $i--) {
          if ($i%4 == 0) {
          ?>
          </div>
          <div class="key-panel-row bottom-hr">
          <?php
          }
          ?>
          <div class="key-panel col-sm-3">
          </div>
          <?php
        }
        ?>
      </div>
      <div class="social-icons bottom-hr">
        <ul class="list-inline text-center">
            <li>share on</li>
            <li class="social-icon twitter"><a href="www.twitter.com"></a></li>
            <li class="social-icon facebook"><a href="www.facebook.com"></a></li>
            <li class="social-icon email"><a href="www.email.com"></a></li>
            <li>@walton street</li>
          </ul>
      </div>

      <!-- Footer
      ================================================== -->
      <footer class="bs-docs-footer row" role="contentinfo">
        <div class="text-center">
          <a href="#top" id="goto-top">Go to top</a>
        </div>
        <div>
          <ul class="list-inline pull-left">
            <li class="text-uppercase">Floral artwork:</li>
            <li><a href="http://www.elliecashmandesign.com" class="text-uppercase">Ellie Cashman</a></li>
          </ul>
          <ul class="list-inline pull-right">
            <li class="separator"><a href="tsandcs.html" class="fancybox fancybox.ajax text-uppercase">Terms & Conditions</a>
          </ul>
        </div>
      </footer>
    </div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="javascripts/walton-street.min.js"></script>



<script>
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=1;
    js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>



  </body>
</html>
