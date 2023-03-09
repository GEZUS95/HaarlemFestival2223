<?php
include_once __DIR__ . '/../header.php';

echo '<h1>' . $page->getTitle() . '</h1>';
print_r($_SESSION);
echo '<br>';
echo '<br>';
echo $page->getBody();

include_once __DIR__ . '/../footer.php';
