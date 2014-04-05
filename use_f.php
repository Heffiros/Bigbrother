<?php
function existing($s_name)
{
	$i = 0;
	$array = array("add_student","del_student","update_student","show_student","add_comments");
	while (isset($array[$i]))
	{
		if ($array[$i] == $s_name)
			return (true);
		$i++;
	}
	return (false);
}

function help()
{
	echo "Bonjour le module vous propose les commandes suivantes :\n
	- add_student : permet d'ajouter un etudiant\n
	- del_student : supprime un etudiant\n
	- update_student : mettre a jour les infos d'un etudiant\n
	- add_comment : rajoute les commentaires\n
	- exit : sort du module\n";
}

function quit()
{
	echo "Merci d'avoir utilise notre module\n";
	exit();
}

function check_input($string)
{
	$i = 0;
	$array = array("nom", "promo", "mail", "telephone");
	while (isset($array[$i]))
	{
		if ($array[$i] == $string)
			return (true);
		$i++;
	}
	return (false);
}