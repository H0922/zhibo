<?php
$data=scandir('./bq/');
unset($data[0]);
unset($data[1]);

echo json_encode($data,JSON_UNESCAPED_UNICODE);

?>