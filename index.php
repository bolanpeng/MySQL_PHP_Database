<?php
	include("connect.php");
	include("add.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>WoW Database</title>
</head>
<body>

<br /><br />
<a href='index.php' style='text-decoration:none'>Add to Database</a>
&nbsp;&nbsp;&nbsp;
<a href='second.php' style='text-decoration:none'>Look up fun facts</a>
<br /><br />

<form method='post'>
	<fieldset>
		<legend>Server</legend>
			<p>Add a new server:</p>
			<label for='sRegion'>Region</label>
			<input type='text' name='sRegion'>
			<label for='sName'>Server Name</label>
			<input type='text' name='sName'>
			<input type='submit' name='addServer'>
	</fieldset>
	<br />

	<fieldset>
		<legend>Guild</legend>
			<p>Add a new guild:</p>
			<label for='gName'>Guild Name</label>
			<input type='text' name='gName'>
			<label for='gRanking'>Ranking</label>
			<input type='number' name='gRanking'>
			<label for='gPoints'>Achievement Points</label>
			<input type='number' name='gPoints'>
			<input type='submit' name='addGuild'>
	</fieldset>
	<br />

	<fieldset>
		<legend>Character</legend>
			<p>Add a new character:</p>
			<label for='cName'>Character Name</label>
			<input type='text' name='cName'>
			<label for='cRace'>Race</label>
			<input type='text' name='cRace'>
			<label for='cClass'>Class</label>
			<input type='text' name='cClass'>
			<label for='cLevel'>Level</label>
			<input type='number' name='cLevel'>
			<br /><br />
			<label for='cGuild'>Guild</label>
			<select name='cGuild'>
				<?php
					$stmt = $link->prepare("SELECT name FROM `guild` ORDER BY name ASC");
					$stmt->execute();
					$stmt->bind_result($name);
					while ($stmt->fetch()) {
						echo '<option value="'.$name.'">'.$name.'</option>\n';
					}
					$stmt->close();
				?>
			</select>
			<label for='csRegion'>Server Region</label>
			<select name='csRegion'>
				<?php
					$stmt = $link->prepare("SELECT DISTINCT(region) AS region FROM `server` ORDER BY region ASC");
					$stmt->execute();
					$stmt->bind_result($region);
					while ($stmt->fetch()) {
						echo '<option value="'.$region.'">'.$region.'</option>\n';
					}
					$stmt->close();
				?>
			</select>
			<label for='csName'>Server Name</label>
			<select name='csName'>
				<?php
					$stmt = $link->prepare("SELECT name FROM `server` ORDER BY name ASC");
					$stmt->execute();
					$stmt->bind_result($name);
					while ($stmt->fetch()) {
						echo '<option value="'.$name.'">'.$name.'</option>\n';
					}
					$stmt->close();
				?>
			</select>
			<input type='submit' name='addChar'>
	</fieldset>
	<br />

	<fieldset>
		<legend>Skill</legend>
			<p>Add a new skill:</p>
			<label for='skill'>Skill Name</label>
			<input type='text' name='skill'>
			<input type='submit' name='addSkill'>
	</fieldset>
	<br />

	<fieldset>
		<legend>Battle Pet</legend>
			<p>Add a new battle pet:</p>
			<label for='petName'>Pet Name</label>
			<input type='text' name='petName'>
			<label for='species'>Species</label>
			<select name='species'>
				<option value=''></option>
				<option value='Aquatic'>Aquatic</option>
				<option value='Beast'>Beast</option>
				<option value='Critter'>Critter</option>
				<option value='Dragonkin'>Dragonkin</option>
				<option value='Elemental'>Elemental</option>
				<option value='Flying'>Flying</option>
				<option value='Humanoid'>Humanoid</option>
				<option value='Magic'>Magic</option>
				<option value='Mechanical'>Mechanical</option>
				<option value='Undead'>Undead</option>
			</select>
			<label for='specAbility'>Special Ability</label>
			<input type='text' name='specAbility'>
			<input type='submit' name='addPet'>
	</fieldset>
	<br />
	
	<fieldset>
		<legend>Learn Skill</legend>
		<p>Choose a character to learn a skill:</p>
		<label for='lName'>Character</label>
		<select name='lName'>
			<?php
				$stmt = $link->prepare("SELECT username FROM `character` ORDER BY username ASC");
				$stmt->execute();
				$stmt->bind_result($name);
				while ($stmt->fetch()) {
					echo '<option value="'.$name.'">'.$name.'</option>\n';
				}
				$stmt->close();
			?>
		</select>
		<label for='lSkill'>Skill</label>
		<select name='lSkill'>
			<?php
				$stmt = $link->prepare("SELECT name FROM `skill` ORDER BY name ASC");
				$stmt->execute();
				$stmt->bind_result($skill);
				while ($stmt->fetch()) {
					echo '<option value="'.$skill.'">'.$skill.'</option>\n';
				}
				$stmt->close();
			?>
		</select>
		<input type='submit' name='addLearn'>
	</fieldset>
	<br />
	
	<fieldset>
		<legend>Own Pet</legend>
		<p>Choose a character to add a new pet to their collection:</p>
		<label for='oName'>Character</label>
		<select name='oName'>	
			<?php
				$stmt = $link->prepare("SELECT username FROM `character` ORDER BY username ASC");
				$stmt->execute();
				$stmt->bind_result($cname);
				while ($stmt->fetch()) {
					echo '<option value="'.$cname.'">'.$cname.'</option>\n';
				}
				$stmt->close();
			?>
		</select>
		<label for='oPet'>Pet</label>
		<select name='oPet'>
			<?php
				$stmt = $link->prepare("SELECT name FROM `battle_pet` ORDER BY name ASC");
				$stmt->execute();
				$stmt->bind_result($pname);
				while ($stmt->fetch()) {
					echo '<option value="'.$pname.'">'.$pname.'</option>\n';
				}
				$stmt->close();
			?>
		</select>
		<input type='submit' name='addOwn'>
	</fieldset>
	<br />
</form>


</body>
</html>
