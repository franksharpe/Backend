<?php
// Get the URL and selected ID from the AJAX request
$url = isset($_GET['url']) ? $_GET['url'] : '';
$selectedId = isset($_GET['selectedId']) ? $_GET['selectedId'] : '';

// Redirect to the specified URL with the selected ID
header("Location: $url?selectedId=$selectedId");
exit();
?>
