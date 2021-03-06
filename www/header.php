<!DOCTYPE html>
<?php
	function GetRace($RaceId)
	{
		switch($RaceId)
		{
			case 0:
				return "Terran";
			case 1:
				return "Zerg";
			case 2:
				return "Protoss";
			case 3:
				return "Random";
			default:
				die("Unknown race" . $RaceId);
		}
	}

	function GetRaceId($Race)
	{
		if (strcasecmp($Race, "Terran") == 0)
		{
			return 0;
		}
		if (strcasecmp($Race, "Zerg") == 0)
		{
			return 1;
		}
		if (strcasecmp($Race, "Protoss") == 0)
		{
			return 2;
		}
		if (strcasecmp($Race, "Random") == 0)
		{
			return 3;
		}
		return -1;

	}
	require_once("dbconf.php");
	$link = new mysqli($host, $username, $password , $db_name);

	// Check connection
	if($link->connect_error){
		die("ERROR: Could not connect. " . mysqli_connect_error());
	}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Starcraft 2 AI Ladder</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="bootstrap.min.css" />
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style.css" />
        <script src="js/common.js" ></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
				<a href="./">
          <img class="Header-logo-img" src="sc2Ladder.gif" alt="Sc2Ladder"></a>

                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Ladder Seasons</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
						<?php
						$sql = "SELECT * FROM `seasonids`";
						$result = $link->query($sql);
						while($row = $result->fetch_assoc())
						{
							if($row['Current'] == '1')
							{
								echo "<li><a href=\"index.php?season=" . $row['id'] . "\">Current</a></li>";
							}
							else
							{
								echo "<li><a href=\"index.php?season=" . $row['id'] . "\">" . $row['SeasonName'] . "</a></li>";
							}
						}
						?>
                        </ul>
                    </li>
                    <li>
                        <a href="Authors.php">Bots and Authors</a>
                    </li>
                    <li>
                        <a href="Learning.php">Learning</a>
                    </li>
                    <li>
                        <a href="FAQ.php">FAQ</a>
                    </li>
                    <li>
                        <a href="Joinus.php">Join Us</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
						<h1> Starcraft 2 AI Ladder</h1>
                        </div>


                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#"></a></li>
								<?php
									if (!isset($_SESSION['username'])) {
								?>
                                <li><a href="main_login.php">Login</a></li>
                                <li><a href="signup.php">Sign Up</a></li>
								<?php
								}
								else
								{
									?>
                                <li><a href="Bots.php">Bots</a></li>
                                <li><a href="profile.php">Profile</a></li>
                                <li><a href="logout.php">Log Out</a></li>
								<?php
								}
								?>

                            </ul>
                        </div>
                    </div>
                </nav>
