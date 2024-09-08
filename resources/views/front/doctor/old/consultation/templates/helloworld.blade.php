<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>OpenTok Hello World</title>
    <script src="//static.opentok.com/webrtc/v2.2/js/TB.min.js"></script>
    <script>
        var apiKey = '<?php echo $apiKey; ?>';
        var sessionId = '<?php echo $sessionId; ?>';
        var token = '<?php echo $token; ?>';
    </script>
    <script src="<?php echo url('/'); ?>/js/helloworld.js"></script>
</head>
<body>
    <h2>Hello, World!</h2>

    <div id="publisher"></div>

    <div id="subscribers"></div>
</body>
</html>
