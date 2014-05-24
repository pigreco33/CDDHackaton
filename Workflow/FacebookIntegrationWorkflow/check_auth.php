<?php
session_start();
if (!isset($_SESSION['user']))
{
	include('./login.php');
	die();
}