<?php
include_once './listtest.php';
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Schedule a Mentor Meeting</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="include/jqtime/include/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css" type="text/css">
    <link rel="stylesheet" href="include/jqtime/jquery.ui.timepicker.css" type="text/css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <script type="text/javascript" src="include/jqtime/include/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="include/jqtime/include/ui-1.10.0/jquery.ui.core.min.js"></script>
    <script type="text/javascript" src="include/jqtime/include/ui-1.10.0/jquery.ui.widget.min.js"></script>
    <script type="text/javascript" src="include/jqtime/include/ui-1.10.0/jquery.ui.tabs.min.js"></script>
    <script type="text/javascript" src="include/jqtime/include/ui-1.10.0/jquery.ui.position.min.js"></script>

    <script type="text/javascript" src="include/jqtime/jquery.ui.timepicker.js"></script>

	<?php
	$stime = $_POST['timepicker'];
    $client = getClient();
    $service = new Google_Service_Calendar($client);
    $calendarId = 'primary';
    $optParms = array('maxResults' => 1,
        'orderBy' => 'startTime',
        'singleEvents' => TRUE,
        'timeMin' => )

	?>
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Add your site or application content here -->
<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="post">
    <fieldset>
        <legend>Appointment Time:</legend>
        Date(mm/dd/yyyy):<br> <input type="text" name="date"><br>
        Start Time:<br><label>
            <input type="text" name="start" id="timepicker" readonly="readonly">
        </label><br>
        <input type="submit" value="Submit" name="subBtn" >
    </fieldset>


	<?php
	echo strtotime($date);
	?>

</form>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function (b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function () {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = 'https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>