<?php

// Note: $installation variable is set during installation inside install_engine.php file.

// redirect user to installation page if script is not installed
if ( ! file_exists( dirname(__FILE__) . '/ASConfig.php' ) && ! isset($installation) )
    header("Location: install/install.php");

include_once 'ASConfig.php';
include_once 'ASSession.php';
include_once 'ASValidator.php';
include_once 'ASLang.php';
include_once 'ASRole.php';
include_once 'ASDatabase.php';
include_once 'ASEmail.php';
include_once 'ASLogin.php';
include_once 'ASRegister.php';
include_once 'ASUser.php';
include_once 'ASComment.php';
include_once 'ASHelperFunctions.php';

$db = ASDatabase::getInstance();

ASSession::startSession();

$login    = new ASLogin();
$register = new ASRegister();
$mailer   = new ASEmail();

if ( isset ( $_GET['lang'] ) )
	ASLang::setLanguage($_GET['lang']);

