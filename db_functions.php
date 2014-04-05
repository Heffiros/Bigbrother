<?php

function add_student($s_name, $db)
{
	if ($db->student->$s_name->count() == 0)
	{
		echo "Nom ?\n";
		$nom = readline("-> ");
		echo "Promo\n";
		$promo = readline("-> ");
		echo "email\n";
		$email = readline("-> ");
		echo "télephone\n";
		$telephone = readline("-> ");
		$student = array("nom" => $nom,
			"promo" => $promo,
			"email" => $email,
			"telephone" => $telephone);
		$db->student->$s_name->insert($student);
		echo "Student ajouté\n";
	}
	else
		echo "Ce login est deja utilisé\n";
}

function del_student($s_name, $db)
{
	echo "Etes-vous sur ?\n";
	$answer = readline("oui/non ?");

	if ($db->student->$s_name->count() == 1)
	{
		if ($answer == "oui") {
			$db->student->$s_name->remove();
			$db->student->$s_name->commentaire->remove();
		}
		else if ($answer == "non")
			echo "Supression annulée\n";
		else
		{
			echo "Mauvaises réponses\n";
			del_student($s_name, $db);
		}
		return;
	}
	else
		echo "Ce login n'est pas dans la base\n";
}

function show_student($s_name, $db)
{
	if ($student = $db->student->$s_name->count() == 1)
	{
		$student = $db->student->$s_name->find();
		foreach($student as $value){
			echo "Nom : ".$value["nom"]."\n";
			echo "Promotion : ".$value["promo"]."\n";
			echo "Email : ".$value["email"]."\n";
			echo "Télelphone : ".$value["telephone"]."\n";
		}
		show_com($s_name, $db);
	}
	else
	{
		echo "Ce login n'est pas dans la base\n";
	}
}
function show_com($s_name, $db)
{
	echo "\nCommentaire :\n";
	if ($db->student->$s_name->count() == 1)
	{
		$student = $db->student->$s_name->commentaire->find();
		foreach($student as $value){
			echo "-------------------------------------------\n";
			echo "Titre : ".$value["titre"]."\n";
			echo "Date : ".$value["date"]."\n";
			echo "Commentaire : ".$value["commentaire"]."\n";
			echo "-------------------------------------------\n";
		}

	}
	else
		echo "Ce login n'est pas dans la base\n";
}

function update_student($s_name, $db)
{
	echo "Que voulez vous modifier ?\n";
	$input = readline("->");
	if (check_input($input) == true)
	{
		echo "Nouveaux  ".$input."?\n";
		$new = readline("->");
		$lol = $db->student->$s_name->find();
		foreach($lol as $value){
			$past = $value[$input];
		}
		$new_c =  array('$set' => array($input => $new));
		$db->student->$s_name->update(array($input => $past), $new_c);
		echo "Modification effectué\n";
	}	
	else
		echo "Cette clé n'est pas dans la base\n";
}

function add_comments($s_name, $db)
{
	echo "Titre du commentaire ? \n";
	$titre = readline("->  ");
	echo "Commentaire ? \n";
	$com = "";
	while (($str = readline("text -> ")) !== false)
	{
		$com = $com."\n".$str;
		if (substr($com, 0,2) != "\n\"")
			break;
		if (substr($com, -1) == '"')
			break;
	}
	echo "Date ?\n";
	$date = readline("-> ");
	$commentaire = array("titre" => $titre,
		"date" => $date,
		"commentaire" => $com,
		);
	$db->student->$s_name->commentaire->insert($commentaire);
	echo "Commentaire ajouté\n";

}

