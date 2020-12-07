<?php
session_start();

unset($_SESSION["user_id"]);
unset($_SESSION["firstname"]);
unset($_SESSION["lastname"]);

header("Location: login.html");
