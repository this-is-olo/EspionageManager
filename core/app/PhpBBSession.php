<?php

global $configx;

define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : $configx->get('forum.relative_path');
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);
// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

$user->public_data['is_logged'] = ($user->data['user_id'] == ANONYMOUS) ? false:true;
$user->public_data['username'] = $user->data['username_clean']

?>