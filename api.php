<?php

include __dir__ . '/script/model.php';

print json_encode($servers, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

?>
