<?php

	include("connect.php");
	
	if (isset($_POST['server'])) {
		$stmt = $link->prepare("SELECT s.region, s.name FROM `guild` g 
				INNER JOIN `character` c ON c.guild_name=g.name
				INNER JOIN `server` s ON s.name=c.server_name
				GROUP BY g.name
				ORDER BY g.ranking ASC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($region, $name);
		echo "<table>\n<tr>\n<td>\nServer with the highest ranking guild:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$region." ".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}

	else if (isset($_POST['oneguild'])) {
		$stmt = $link->prepare("SELECT c.username FROM `guild` g
				INNER JOIN `character` c ON c.guild_name=g.name
				WHERE g.ranking=1");
		$stmt->execute();
		$stmt->bind_result($name);
		echo "<table>\n<tr>\n<td>\nName of the players from world's number one guild:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['notmax'])) {
		$stmt = $link->prepare("SELECT g.name FROM `guild` g
				INNER JOIN `character` c ON c.guild_name=g.name
				WHERE c.level < 100
				ORDER BY g.name ASC");
		$stmt->execute();
		$stmt->bind_result($name);
		echo "<table>\n<tr>\n<td>\nName of guilds with players under level 100:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['poprace'])) {
		$stmt = $link->prepare("SELECT c.race, COUNT(c.race) AS num
				FROM  `character` c
				GROUP BY c.race
				ORDER BY num DESC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($race, $num);
		echo "<table>\n<tr>\n<td>\nMost popular race:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$race."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['notpoprace'])) {
		$stmt = $link->prepare("SELECT c.race, COUNT(c.race) AS num
				FROM  `character` c
				GROUP BY c.race
				ORDER BY num ASC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($race, $num);
		echo "<table>\n<tr>\n<td>\nLeast popular race:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$race."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['popclass'])) {
		$stmt = $link->prepare("SELECT c.class, COUNT(c.class) AS num
				FROM  `character` c
				GROUP BY c.class
				ORDER BY num DESC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($class, $num);
		echo "<table>\n<tr>\n<td>\nMost popular class:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$class."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['notpopclass'])) {
		$stmt = $link->prepare("SELECT c.class, COUNT(c.class) AS num
				FROM  `character` c
				GROUP BY c.class
				ORDER BY num ASC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($class, $num);
		echo "<table>\n<tr>\n<td>\nLeast popular class:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$class."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['pet'])) {
		$stmt = $link->prepare("SELECT bp.name, COUNT(has.pet_name) AS num FROM `battle_pet` bp 
				LEFT JOIN `has` ON has.pet_name=bp.name
				GROUP BY bp.name");
		$stmt->execute();
		$stmt->bind_result($pet, $num);
		echo "<table>\n<tr>\n<td>\nBattle pets owned by players:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$pet." ".$num."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['poppet'])) {
		$stmt = $link->prepare("SELECT bp.name, COUNT(has.pet_name) AS num FROM `battle_pet` bp 
				LEFT JOIN `has` ON has.pet_name=bp.name
				GROUP BY bp.name 
				ORDER BY num DESC");
		$stmt->execute();
		$stmt->bind_result($pet, $num);
		echo "<table>\n<tr>\n<td>\nBattle pets' popularity list (most popular on top):</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$pet."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['nopoppet'])) {
		$stmt = $link->prepare("SELECT bp.name, COUNT(has.pet_name) AS num FROM `battle_pet` bp 
				LEFT JOIN `has` ON has.pet_name=bp.name
				GROUP BY bp.name
				ORDER BY num ASC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($pet, $num);
		echo "<table>\n<tr>\n<td>\nThe least popular pet:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$pet."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['nopet'])) {
		$stmt = $link->prepare("SELECT c.username FROM `character` c 
				WHERE c.username NOT IN
				(SELECT has.char_name FROM `battle_pet` bp
				INNER JOIN `has` ON has.pet_name=bp.name)
				ORDER BY c.username ASC");
		$stmt->execute();
		$stmt->bind_result($name);
		echo "<table>\n<tr>\n<td>\nThe name of players that don't have any pets:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['popskill'])) {
		$stmt = $link->prepare("SELECT skill.name, COUNT(learns.skill_name) as num FROM `skill`
				INNER JOIN `learns` ON learns.skill_name=skill.name
				GROUP BY skill.name
				ORDER BY num DESC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($name, $num);
		echo "<table>\n<tr>\n<td>\nThe most popular skill:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['notpopskill'])) {
		$stmt = $link->prepare("SELECT skill.name, COUNT(learns.skill_name) as num FROM `skill`
				INNER JOIN `learns` ON learns.skill_name=skill.name
				GROUP BY skill.name
				ORDER BY num ASC
				LIMIT 1");
		$stmt->execute();
		$stmt->bind_result($name, $num);
		echo "<table>\n<tr>\n<td>\nThe least popular skill:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['allskill'])) {
		$stmt = $link->prepare("SELECT c.username, COUNT(learns.skill_name) as num FROM `skill`
				INNER JOIN `learns` ON learns.skill_name=skill.name
				INNER JOIN `character` c ON c.username=learns.char_name
				GROUP BY c.username
				HAVING num = (SELECT COUNT(skill.name) as num FROM `skill`)");
		$stmt->execute();
		$stmt->bind_result($name, $num);
		echo "<table>\n<tr>\n<td>\nName of players that learned all the skills:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
	
	else if (isset($_POST['noskill'])) {
		$stmt = $link->prepare("SELECT c.username, COUNT(learns.skill_name) as num FROM `skill`
				INNER JOIN `learns` ON learns.skill_name=skill.name
				INNER JOIN `character` c ON c.username=learns.char_name
				GROUP BY c.username
				HAVING num=0");
		$stmt->execute();
		$stmt->bind_result($name, $num);
		echo "<table>\n<tr>\n<td>\nName of players that didn't learn any skills:</td>\n</tr>\n";
		while ($stmt->fetch()) {
			echo "<tr>\n<td>\n".$name."</td>\n</tr>\n";
		}
		echo "</table>";
		$stmt->close();
	}
?>
