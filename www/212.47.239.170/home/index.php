<?php
if(isset($_GET["table"])) {
    header("location: discussion/index.php?table=" . $_GET["table"]);
}
else {
    header("location: contacts/");
}