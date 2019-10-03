<?php

require "libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=it-31',
        'root', '' ); //for both mysql or mariaDB

session_start();