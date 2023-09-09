<!DOCTYPE html>
<html>
<head>
	<title>Guessing Game</title>
    <link rel="stylesheet" href="css\bootstrap.min.css">
    <script src="js\bootstrap.bundle.js"></script>
</head>
<body class="p-3 mb-2 bg-primary text-white">
	<div id="main" style="border:1px solid white;background-color:white; height:510px; width:30%; margin-left:35%; margin-top:5%; border-radius:10px;s">
    <h1 style="background-color:midnightblue; color:white; margin-top:10px; border-radius:5px;">Number Guessing Game</h1>
	<?php
		session_start();

		// Initialize session variables
		if (!isset($_SESSION['number'])) {
			$_SESSION['number'] = rand(1, 100);
			$_SESSION['guesses'] = 0;
			$_SESSION['score'] = 100;
			$_SESSION['timer'] = 10;
		}

		// Handle form submission
		if (isset($_POST['submit'])) {
			$guess = $_POST['guess'];
			$_SESSION['guesses']++;

			if ($guess == $_SESSION['number']) {
				echo "<p style=color:green;font-weight:600;>Congratulations!, " . $_SESSION['playername'] . "You guessed the number in " . $_SESSION['guesses'] . " guesses with a score of " . $_SESSION['score'] . ".</p>";
				session_destroy();
			} elseif ($guess < $_SESSION['number']) {
				echo '<div class="alert alert-info" role="alert">Your Guess is too low...</div>';
				$_SESSION['score'] -= 5;
			} else {
				echo '<div class="alert alert-danger" role="alert">Your Guess is too high...</div>';
				$_SESSION['score'] -= 5;
			}
		}

		// Display form and timer
		if (!isset($_POST['submit']) || $guess != $_SESSION['number']) {
			echo "<p style=margin-left:25%;font-weight:700;color:blue;>Guess a number between 1-100.</p>";
			echo "<p style=margin-left:30%;margin-top:30px;color:midnightblue;font-weight:800;>Score: " . $_SESSION['score'] . "</p>";
			echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
			echo "<input type='text' name='guess' placeholder='000'style=margin-left:30%;margin-top:10px;height:80px;width;20%;font-weight:700;border:solid black;>";
            echo "<br>";
			echo "<input type='submit' name='submit' value='Guess'style=margin-top:20px;margin-left:45%;height:30px;width:20%;font-weight:500;background-color:blue;color:white;border-radius:10px;border:>";
			echo "</form>";

			if ($_SESSION['timer'] > 0) {
				echo "<p style=margin-left:45%;margin-top:20%;color:black;font-weight:800;color:blue;>Guess Left: " . $_SESSION['timer'] . "</p>";
				$_SESSION['timer']--;
			} else {
				echo "<p style=font-weight:1000;color:red;margin-left:45%;margin-top:20%;>Time's up!</p>";
				session_destroy();
			}
		}
	?>
    </div>
</body>
</html>