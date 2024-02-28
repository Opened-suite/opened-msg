<?php
session_destroy();
unset($_SESSION['prenom']);
unset($_SESSION['token']);
unset($_SESSION['email']);
unset($_SESSION['ip']);
header("location: ../");