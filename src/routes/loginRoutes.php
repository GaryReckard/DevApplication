<?php

$app->post('/login/',function() use ($app,$db) {
	$app->response->headers->set('Content-Type','application/json');
	$username = $app->request()->post('username');
	$password = $app->request()->post('password');
	$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
	
	$prod = $db->getInstance()->consultar($sql, array($username,sha1($password)) );
	$result = $prod->results();
	if ( !empty($result) ){
		$app->setCookie('logged_in',TRUE,'1 days');
		$app->setCookie('username',$result[0]->name, '1 days');
		echo json_encode(array('logged_in' => TRUE));
	}else{
		echo json_encode(array('logged_in' => FALSE));
	}
});

$app->get('/login/debug/', function() use ($app,$db) {
	$app->response->headers->set('Content-Type','application/json');
	var_dump($_COOKIE);
});

$app->get('/logout/',function() use ($app,$rootPath){
	$app->deleteCookie('logged_in');
	$app->deleteCookie('username');
	$app->response->redirect($rootPath . 'web/index.php');
});