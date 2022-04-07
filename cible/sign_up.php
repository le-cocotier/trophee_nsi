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

	if($birth_date <= $date_13) {
		$bdd = new SQLite3('../database/users.db', SQLITE3_OPEN_READWRITE);


		// Je reagarde si l'user exixte déjà
	    $response = $bdd->query("SELECT * FROM users");

	    while ($line = $response->fetchArray()) {
	        if ($line["name"] == $_POST['name']) {
	            print_r(json_encode("{'error': 'username'}"));
	            exit();
	        }
	        elseif ($line["email"] == $_POST['email']){
	            print_r(json_encode("{'error': 'email'}"));
	            exit();
	        }
	    }
	    // Si le nom d'utilisateur et l'email n'est pas utilisé on peut créer le compte

	    $append = $bdd->prepare("INSERT INTO users(name, password, email, birth_date) VALUES(:name, :password, :email, :birth_date)");

	    $append->bindValue(':name', $_POST['name']);
	    $append->bindValue(':password', $_POST['password']);
	    $append->bindValue(':email', $_POST['email']);
	    $append->bindValue(':birth_date', $_POST['birth_date']);

	    $append->execute();

	}
	else {
		print_r(json_encode("{'error': 'date'}"));
	}
}
 ?>
