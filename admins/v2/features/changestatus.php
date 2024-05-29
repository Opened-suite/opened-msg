<?php
  $content = htmlspecialchars($_GET['content']);
  file_put_contents('test.txt', $content);
?>