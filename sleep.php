<html>
<head>
  <title>Sleep</title>
  <?php
    $seconds = 10;
    if (array_key_exists('seconds', $_GET))
      $seconds = $_GET['seconds'];
  ?>
</head>
<body>
  <h1>Sleep</h1>
  <p>This page will output some html, then sleep for <?php echo($seconds); ?> seconds, then output the rest of the html. <?php echo($seconds); ?> is determined by the seconds url parameter. (e.g. <?php echo($_SERVER['PHP_SELF'] . '?seconds=' . $seconds); ?>)</p>

  <div id="countdown"></div>
  <script>
    var seconds = <?php echo($seconds); ?>;
    var elem = document.getElementById('countdown');
    (function countdown() {
      elem.innerText = seconds--;
      if (seconds >= 0)
        setTimeout(countdown, 1000);
    })();
  </script>

  <?php
    @apache_setenv('no-gzip', 1);
    @ini_set('zlib.output_compression', 0);
    @ini_set('implicit_flush', 1);
    for ($i = 0; $i < ob_get_level(); $i++) { ob_end_flush(); }
    ob_implicit_flush(1);

    echo("\n" . str_repeat(' ',1024) . "\n");

    flush();
    sleep($seconds);
  ?>

  <script>
    elem.remove();
  </script>

  <p>...and we're done.</p>
</body>
</html>
