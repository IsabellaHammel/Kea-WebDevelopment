<?php
// require require_once include include_once
// require -> must be there or stop the page
// require_once -> use it only 1 time
// include -> nice, it tries to use it
// include_once -> 1 time

$top_active = 'index';
$top_page_title = 'Welcome : : Welcome';
require_once(__DIR__.'/top.php');

?>

<main>
    <h1>Welcome</h1>
</main>

<?php
require_once(__DIR__.'/bottom.php');
?>