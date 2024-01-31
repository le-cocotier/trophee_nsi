<?php
if (isset($_POST['name']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['birth_date'])) {

	// date aujourd'hui
	$date = new DateTime();
	// date - 13 ans
	$date->sub(new DateInterval('P13Y'));
	$date_13 = $date->format('Ymd');

	// si $_POST['date_naissance'] est au format jj-mm-yyyy, par exemple = 25-12-2001 on le converti au format dateTime avec DateTime::createFromFormat
	$date_naissance = date_create($_POST['birth_date']);
	$birth_date = date_format($date_naissance, 'Ymd');

	$error=array("error"=>[]);

	if($birth_date > $date_13) {
		array_push($error["error"], "date");
		// print_r(json_encode("{'error': 'date'}"));

	}
	$bdd = new SQLite3($_SERVER["DOCUMENT_ROOT"].'/trophee_nsi/database/main.db', SQLITE3_OPEN_READWRITE);


	// Je reagarde si l'user exixte déjà
	$response = $bdd->query("SELECT * FROM users");

	while ($line = $response->fetchArray()) {
		if ($line["name"] == $_POST['name']) {
			array_push($error["error"], "username");
			// print_r(json_encode("{'error': 'username'}"));
		}
		if ($line["email"] == $_POST['email']){
			array_push($error["error"], "email");
			// print_r(json_encode("{'error': 'email'}"));
		}
	}
	if (count($error['error']) == 0){
		$append = $bdd->prepare("INSERT INTO users(name, password, email, birth_date, subscribers, subscriptions, pp, type, public) VALUES(:name, :password, :email, :birth_date, 0, 0, :pp, :type, 'false')");

		$append->bindValue(':pp', file_get_contents($_SERVER["DOCUMENT_ROOT"]."/trophee_nsi/img/blank-profile.png"));
		$append->bindValue(':type', 'image/png');
		$append->bindValue(':name', $_POST['name']);
		$append->bindValue(':password', sha1($_POST['password']));
		$append->bindValue(':email', $_POST['email']);
		$append->bindValue(':birth_date', $_POST['birth_date']);

		$append->execute();

		$response = $bdd->query('SELECT id from users where name="'.$_POST["name"].'"');
		session_start();
		$_SESSION['user_ID'] = ($response->fetchArray())["id"];
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['password'] = sha1($_POST['password']);
	}

	else{
		print_r(json_encode($error));
	}
	// Si le nom d'utilisateur et l'email n'est pas utilisé on peut créer le compte
}
 ?>
