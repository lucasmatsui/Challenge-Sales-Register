<?php
session_start();

require 'setlocale.php';
require 'config.php';
require 'vendor/autoload.php';

$core = new Core\Core();
$core->run();
