<?php
	include("connect.php");
	
	if (isset($_POST['addServer']) ){
		$region = $_POST['sRegion'];
		$name = $_POST['sName'];
		
		$query = "SELECT region, name FROM `server` WHERE region = '$region' AND name = '$name'";
		$result = mysqli_query($link, $query);
		$results = mysqli_num_rows($result);
		
		if ($results) {
			echo "The server <span style='font-weight:bold'>".$region." ".$name."</span> already exist. Do you want to try another name?";
		}
		else {
			$query = "INSERT INTO `server` (region, name) VALUES ('$region', '$name')";
			mysqli_query($link, $query);
			echo "Congratulations! You added a new server: <span style='font-weight:bold'>".$region." ".$name."</span>";
		}
	}
	
	else if (isset($_POST['addGuild']) ){
		$name = $_POST['gName'];
		$rank = $_POST['gRanking'];
		$points = $_POST['gPoints'];
		
		$query = "SELECT name FROM `guild` WHERE name = '$name'";
		$result = mysqli_query($link, $query);
		$results = mysqli_num_rows($result);
		
		if ($results) {
			echo "The guild name <span style='font-weight:bold'>".$name."</span> already exist. Do you want to try another name?";
		}
		else {
			$query = "SELECT ranking FROM `guild` WHERE ranking = '$rank'";
			$result = mysqli_query($link, $query);
			$results = mysqli_num_rows($result);
			
			if ($results) { 
				echo "The ranking <span style='font-weight:bold'>".$rank."</span> already exist. Do you want to try again?";
			}
			else {
				$query = "INSERT INTO `guild` (name, ranking, ach_points) VALUES ('$name', '$rank', '$points')";
				mysqli_query($link, $query);
				echo "Congratulations! You added a new guild: <span style='font-weight:bold'>".$name."</span>";
			}
		}
	}
	
	else if (isset($_POST['addChar']) ){
		$username = $_POST['cName'];
		$race = $_POST['cRace'];
		$class = $_POST['cClass'];
		$level = $_POST['cLevel'];
		$guild = $_POST['cGuild'];
		$region = $_POST['csRegion'];
		$servername = $_POST['csName'];

		$query = "SELECT username FROM `character` WHERE username = '$username'";
		$result = mysqli_query($link, $query);
		$results = mysqli_num_rows($result);
		
		if ($results) {
			echo "The username <span style='font-weight:bold'>".$username."</span> already exist. Do you want to try another name?";
		}
		else {			
			$query = "SELECT * FROM `server` WHERE region='$region' AND name='$servername'";
			$result = mysqli_query($link, $query);
			$results = mysqli_num_rows($result);
			
			if(!$results) {
				echo "The server <span style='font-weight:bold'>".$servername."</span> does not exist in <span style='font-weight:bold'>".$region."</span> region.";
			}
			else {
				$stmt = $link->prepare("INSERT INTO `character` VALUES (?,?,?,?,?,?,?)");
				$stmt->bind_param("sssisss", $username, $race, $class, $level, $guild, $region, $servername);
				$stmt->execute();
				echo "Congratulations! You added a new character: <span style='font-weight:bold'>".$username."</span>";
				$stmt->close();
			}
		}
	}
	
	else if (isset($_POST['addSkill']) ){
		$skill = $_POST['skill'];
		
		$query = "SELECT name FROM `skill` WHERE name = '$skill'";
		$result = mysqli_query($link, $query);
		$results = mysqli_num_rows($result);
		
		if ($results) {
			echo "The skill name <span style='font-weight:bold'>".$skill."</span> already exist. Do you want to try another name?";
		}
		else {
			$query = "INSERT INTO `skill` (name) VALUES ('$skill')";
			mysqli_query($link, $query);
			echo "Congratulations! You added a new skill: <span style='font-weight:bold'>".$skill."</span>";
		}
	}
	
	else if (isset($_POST['addPet']) ){
		$name = $_POST['petName'];
		$species = $_POST['species'];
		$ability = $_POST['specAbility'];
		
		$query = "SELECT name FROM `battle_pet` WHERE name = '$name'";
		$result = mysqli_query($link, $query);
		$results = mysqli_num_rows($result);
		
		if ($results) {
			echo "The pet name <span style='font-weight:bold'>".$name."</span> already exist. Do you want to try another name?";
		} 
		else {
			$stmt = $link->prepare("INSERT INTO `battle_pet` VALUES (?,?,?)");
			$stmt->bind_param("sss", $name, $species, $ability);
			$stmt->execute();
			echo "Congratulations! You added a new pet: <span style='font-weight:bold'>".$name."</span>";
			$stmt->close();
		}
	}
	
	else if (isset($_POST['addLearn']) ) {
		$char = $_POST['lName'];
		$skill = $_POST['lSkill'];
		
		$query = "SELECT char_name, skill_name FROM `learns` WHERE char_name = '$char' AND skill_name = '$skill'";
		$result = mysqli_query($link, $query);
		$results = mysqli_num_rows($result);
		
		if ($results) {
			echo "Oops! <span style='font-weight:bold'>".$char."</span> already knows <span style='font-weight:bold'>".$skill."</span>. Please try something else.";
		}
		else {
			$stmt = $link->prepare("INSERT INTO `learns` VALUES (?,?)");
			$stmt->bind_param("ss", $char, $skill);
			$stmt->execute();
			echo "Congratulations!  <span style='font-weight:bold'>".$char."</span> learned <span style='font-weight:bold'>".$skill."</span>.";
			$stmt->close();
		}
	}
		
	else if (isset($_POST['addOwn']) ) {
		$char = $_POST['oName'];
		$pet = $_POST['oPet'];
		
		$query = "SELECT char_name, pet_name FROM `has` WHERE char_name = '$char' AND pet_name = '$pet'";
		$result = mysqli_query($link, $query);
		$results = mysqli_num_rows($result);
		
		if ($results) {
			echo "Oops! <span style='font-weight:bold'>".$char."</span> already has <span style='font-weight:bold'>".$pet."</span>. Please try something else.";
		}
		else {
			$stmt = $link->prepare("INSERT INTO `has` (char_name, pet_name) VALUES (?,?)");
			$stmt->bind_param("ss", $char, $pet);
			$stmt->execute();
			echo "Congratulations!  <span style='font-weight:bold'>".$char."</span> has added <span style='font-weight:bold'>".$pet."</span> to their collection.";
			$stmt->close();
		}
	}
?>
