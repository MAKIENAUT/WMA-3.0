<?php

session_name('admin_session');
session_start([
   'cookie_lifetime' => 1800,
   // Set session timeout to 30 minutes
]);

?>