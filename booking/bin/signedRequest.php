<?php
$sharedSecret = "kGb6DS6W7DF8YNzzS5p2z3b8mPjuvprr";
$post = file_get_contents('php://input');
$out=hash_hmac("sha256", $post, $sharedSecret);

header('Content-Type: application/json');
echo '{"signature":"'.$out.'"}';
?>