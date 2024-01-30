<head>
	<script src="https://cdn.jsdelivr.net/npm/javascript-obfuscator@4.1.0/dist/index.browser.min.js"></script>
</head>

<?php
session_start();
session_destroy();

header("Location: index.php");
exit();


?>