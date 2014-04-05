<?php	
require 'db_functions.php';
require 'use_f.php';

$co = new Mongo();
$db = $co->student;
echo "Bienvenue sur le module de gestion d'étudiant une commande help est integrée\n";
input($db);

function input($db)
{
	while ($input = readline("->"))
	{
		readline_add_history($input);
		$tab = explode(" ", $input);
		if ($tab[0] == "exit" || $tab[0] == "quit")
			quit();
		else if ($tab[0] == "help" || $tab[0] == "h")
			help();
		else
		{
			if (existing($tab[0]) == true && isset($tab[1]) == true) 
				call_user_func($tab[0], $tab[1], $db);
			else
				echo "Mauvaises entre [commande + login]\n";
		}

	}
}

