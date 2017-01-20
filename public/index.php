<?php
session_cache_limiter(false);
session_start();

require __DIR__ . '/../vendor/autoload.php';

use Slim\Slim;
use Slim\Views\Twig;
//use Slim\Views\TwigExtension;

/* Define some path shortcuts */
define("ROOT_DIR", dirname(__DIR__));
define("SOURCE_DIR", ROOT_DIR."/src");
define("PUBLIC_DIR", ROOT_DIR."/public");

\Slim\Slim::registerAutoloader();


//Database Info
require_once ROOT_DIR . "/db.php";


// $app = new Slim([
// 	"debug" => true
// ]);
$app = new Slim([
    "debug" => true,
    "view" => new Twig(),
    "templates.path" => SOURCE_DIR."/views",
    "routes.case_sensitive" => false,
    
    "cookies.encrypt" => true,
    "cookies.secret_key" => "gary_has_no_secrets",
    "cookies.cipher" => MCRYPT_RIJNDAEL_256,
    "cookies.cipher_mode" => MCRYPT_MODE_CBC
]);




/* Routes */

$logged_in = $app->getCookie('logged_in');

if($logged_in == true){

	//homepage route, show assessment questions
	$app->get('/', function () use ($app){

		$assessment_id = 1; //Only one for now
		$questions = array();

		//get questions for assessment
		$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_SCHEMA);

		if (!$link) {
			//throw slim exception?
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		/* create a prepared statement */
		$stmt = $link->prepare("
			SELECT 
				`id`, 
				`order`, 
				`question`
			FROM 
				questions 
			WHERE 
				assessment_id = ?
			ORDER BY
				`order` ASC
		");

		/* bind parameters for markers */
		$stmt->bind_param("s", $assessment_id);

		/* execute query */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $order, $question);

		/* fetch value */
		while ($stmt->fetch()) {
			$questions[$id] = array('order' => $order, 'question' => $question);
		}

		/* close statement */
		$stmt->close();

		/* close mysqli connection */
		mysqli_close($link);



		$app->render('pages/home/index.php', array(
			'logged_in' => true,
			'questions' => $questions,
			'assessment_id' => $assessment_id
		));

	});

	//process assessment
	$app->post('/submit-assessment', function () use ($app){

		//logged in user id
		$user_id = $app->getCookie('user_id');

		//check their submission
		$answers = $_POST['answer'];

		//assessment ID
		$assessment_id = $_POST['assessment_id']; //Only one for now

		$num_questions = count($answers);
		var_dump($_POST);
		echo "Number of Questions: ".$num_questions;

		
		//save to the database
		$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_SCHEMA);

		if (!$link) {
			//throw slim exception?
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		$link->query("START TRANSACTION");

		foreach($answers as $id => $answer){

			$sql = "
				REPLACE INTO 
					`answers` (`user_id`,`question_id`,`answer`)
				VALUES
					(?,?,?)
			";
			echo $sql;

			// create a prepared statement
			$stmt = $link->prepare($sql);

			// bind parameters for markers
			$stmt->bind_param("iis", $user_id, $id, $answer);

			// execute query
			$stmt->execute();

			// close statement
			$stmt->close();

		}

		$link->query("COMMIT");

		// close mysqli connection
		mysqli_close($link);

		$app->flash('success', 'Your assessment answers have been saved.');

		$app->response->redirect('/results/'.$assessment_id);

		
	});


	//show the assessment results
	$app->get('/results/:id', function ($assessment_id) use ($app){

		if(empty($assessment_id) || $assessment_id <= 0){
			$app->response->redirect('/');
		}

		//logged in user id
		$user_id = $app->getCookie('user_id');

		$results = array();

		//get answers for assessment
		$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_SCHEMA);

		if (!$link) {
			//throw slim exception?
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		/* create a prepared statement */
		$stmt = $link->prepare("
			SELECT 
				q.style,
				count(*) as yesses
			FROM 
				answers a LEFT JOIN
				questions q ON (a.question_id = q.id) 
			WHERE 
				a.answer = 'YES' AND 
				q.assessment_id = ?
			GROUP BY q.style
		");

		/* bind parameters for markers */
		$stmt->bind_param("s", $assessment_id);

		/* execute query */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($style, $yesses);

		/* fetch value */
		while ($stmt->fetch()) {
			$results[$style] = $yesses;
		}

		/* close statement */
		$stmt->close();

		/* close mysqli connection */
		mysqli_close($link);



		$app->render('pages/home/results.php', array(
			'logged_in' => true,
			'results' => $results
		));

	});

}
//if not logged in
else{

	//show login form
	$app->get('/', function () use ($app){
		$app->render('pages/home/login.php', array());
	});

	//process login
	$app->post('/login', function () use ($app){

		//check their login stuff
		$username = $app->request()->post('username');
		$password = $app->request()->post('password');

		$link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_SCHEMA);

		if (!$link) {
			//throw slim exception?
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}

		/* create a prepared statement */
		$stmt = $link->prepare("
			SELECT 
				id, password
			FROM 
				users 
			WHERE 
				username = ?
			LIMIT
				1
		");

		/* bind parameters for markers */
		$stmt->bind_param("s", $username);

		/* execute query */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($id, $fetched_password);

		/* fetch value */
		$stmt->fetch();

		/* close statement */
		$stmt->close();

		/* close mysqli connection */
		mysqli_close($link);

		if ( password_verify($password, $fetched_password) ){
			$app->setCookie('logged_in',TRUE,'1 days');
			$app->setCookie('username',$username, '1 days');
			$app->setCookie('user_id',$id, '1 days');
			$app->flash('success', 'Welcome, '.$username.'. You are now logged in.');
		}else{
			$app->flash('danger', 'Incorrect Username or Password. Please try again.');
		}

		$app->response->redirect('/');
	});
}

// Logout, remove session cookies
$app->get('/logout',function() use ($app){
	$app->flash('info', 'Goodbye, '.$app->getCookie('username').'. You are now logged out.');
	$app->deleteCookie('logged_in');
	$app->deleteCookie('username');
	$app->deleteCookie('user_id');
	$app->response->redirect('/');
});

/* END Routes */


$app->run();
