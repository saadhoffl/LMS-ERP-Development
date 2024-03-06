<?php
include 'src/back-end/libs/load.php';

// If user not loggedin this should be redirect to login page. 
// and This is redirect to user clicked uri automatically after loging. in thi case redirect to this 
// same file called page_found.php.

// Session::ensureLogin();

Session::renderPage();