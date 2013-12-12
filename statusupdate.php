<?php

header('Content-Type: text/plain');

print file_get_contents(__DIR__ . '/statusupdate.txt');
