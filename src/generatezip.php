<?php
session_start();
require 'external/zipstream/zipstream.php';
$token = $_SESSION['request_vars']['oauth_token'];
$token_secret = $_SESSION['request_vars']['oauth_token_secret'];
$data = "---\n:token: $token\n:token_secret: $token_secret";
$zip = new ZipStream('twitter-git-hook.zip', array(
    'comment' => 'Autogenerated zip file.'));
$zip->add_file('twitter-conf.yaml', $data);
$zip->add_file_from_path('post-commit', 'hook/post-commit-python');
$zip->add_file_from_path('README', 'hook/README');
$zip->add_file_from_path('LICENSE', 'hook/LICENSE');
$zip->finish();
?>