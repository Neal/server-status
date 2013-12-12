<?php

include __dir__ . '/script/model.php';

header('Content-Type: application/json');

print json_encode($servers, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

?>
