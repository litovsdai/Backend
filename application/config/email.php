<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$config['protocol'] 	= 'smtp';
$config['smtp_user'] 	= 'info@casualweb.org';
$config['smtp_host'] 	= 'mail.casualweb.org';
$config['smtp_port'] 	= "2525";
$config['smtp_pass']	= 'Lito1984_web';
$config['smtp_timeout'] = '7';
$config['useragent'] 	= 'Casual Web';    
$config['wordwrap'] 	= TRUE;
$config['charset']   	= 'utf-8';
$config['newline']    	= "\r\n";
$config['mailtype'] 	= 'html'; // or html
$config['validation'] 	= TRUE; // bool whether to validate email or not

/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'litovsdai@gmail.com';
$config['smtp_pass'] = 'Lito1984_google';
$config['smtp_timeout'] = '7';
$config['charset']    = 'utf-8';
$config['newline']    = "\r\n";
$config['mailtype'] = 'html'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not
*/