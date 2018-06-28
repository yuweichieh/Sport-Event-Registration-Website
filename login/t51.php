<?php

// 載入 src 目錄內的 autoload.php
include('/src/autoload.php');

$siteKey = '6LfF_GAUAAAAAFfYGBfsinBjf1pdiKkY_TBZLQwq';
$secret = '6LfF_GAUAAAAAIotJgLfa60983blVIOeMYXCVoP8';

$lang = 'zh-TW';

// 初始化變數為空值
$resp = '';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>reCAPTCHA Example t51.php</title>

     <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>" async defer></script>

</head>
<body>

     <form action="?" method="post">

         <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
         <br>
		 <input type="submit" value="提交">

     </form>

</body>
</html>