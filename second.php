<?php
	include("lookup.php");
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
<br />

<form method='post'>
	<p>Select the server with the highest ranking guild.
	<input type='submit' name='server' value='Look up'></p>
	
	<p>List the name of the players that belong to the number one guild.
	<input type='submit' name='oneguild' value='Look up'></p>
	
	<p>List all the guilds that have players that are not max level (level < 100).
	<input type='submit' name='notmax' value='Look up'></p>
	
	<p>Find the most popular race.
	<input type='submit' name='poprace' value='Look up'></p>
	
	<p>Find the least popular race.
	<input type='submit' name='notpoprace' value='Look up'></p>
	
	<p>Find the most popular class.
	<input type='submit' name='popclass' value='Look up'></p>
	
	<p>Find the least popular class.
	<input type='submit' name='notpopclass' value='Look up'></p>
	
	<p>How many of each battle pet is owned by players. 
	<input type='submit' name='pet' value='Look up'></p>
	
	<p>Rank battle pets according to their popularity, in descending order.
	<input type='submit' name='poppet' value='Look up'></p>
	
	<p>Find the least popular pet.
	<input type='submit' name='nopoppet' value='Look up'></p>
	
	<p>List the name of players that don't have any battle pets.
	<input type='submit' name='nopet' value='Look up'></p>
	
	<p>Find the most popular skill.
	<input type='submit' name='popskill' value='Look up'></p>
	
	<p>Find the least popular skill.
	<input type='submit' name='notpopskill' value='Look up'></p>
	
	<p>Find the name of the players that learned all the skills.
	<input type='submit' name='allskill' value='Look up'></p>
	
	<p>Find the name of the players that didn't learn any skills.
	<input type='submit' name='noskill' value='Look up'></p>
	
</form>
</body>
</html>
