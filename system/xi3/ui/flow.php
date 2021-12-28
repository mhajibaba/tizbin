
<pre lang="xml" >
<?php

$file = $_GET['file'];
$flowpage = file_get_contents($file);
echo $flowpage;
?>
</pre>
