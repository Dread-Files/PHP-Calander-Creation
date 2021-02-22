<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>IT 207 Final Grade Determiner</title>
	<link rel="stylesheet" href="../Assignment 2/lab0.css" type="text/css"/>
    <link rel="stylesheet" href="Styles.css" type="text/css"/>
</head>
<body>
    <div id="container">
		<nav id="leftSide">
			<h3>Lab Assignments</h3>
			<a href="../Assignment 1/assignment1.php">Assignment 1</a></br>
			<a href="../Assignment 2/assignment2.php">Assignment 2</a></br>
			<a href="../Assignment 3/assignment3.php">Assignment 3</a></br>
			<a href="../Assignment 4/assignment4.php">Assignment 4</a></br>
            <a href="../Assignment 5/assignment5.php">Assignment 5</a></br>
			<h3>Lab Practica</h3>
			Practicum 1</br>
			Practicum 2
		</nav>
		<div id="rightSide">
			<header id="header">
				<div id="headerLeft">
					<b>Course: </b>IT 207, #004, Fall 2019<br/>
					<b>Instructor: </b>Hossein Kord<br/>
					<b>University: </b>George Mason University<br/>
				</div>
				<div id="headerRight">
					<b>Student: </b>Asad Ibrahim<br/>
					<b>Email: </b>aibrah2@msonlive.gmu.edu<br/>
					<?php
						echo "<b>Last Modified:</b></br>".date("F d Y H:i:s.", filemtime("assignment3.php"));
					?>
				</div>
            </header>
            <header class="title">
                <h1>Office Hours Setup</h1>
            </header>
            <div class="days">
                <p>Days</p><p>Monday</p><p>Teusday</p><p>Wednesday</p><p>Thursday</p><p>Friday</p>
            </div>
            <form action="calander.php" method="post">
                <div class="form">
                <?php
                    $day_of_week = array('mon', 'tue', 'wed', 'thu', 'fri');
                    echo '<div class="times">Times:</div>';
                    for ($i = 0; $i < count($day_of_week); $i++) {
                        echo '<div class="times">
                            <select name="'.$day_of_week[$i].'[]" multiple size="15">
                            <option>7:00am</option>
                            <option>7:30am</option>
                            <option>8:00am</option>
                            <option>8:30am</option>
                            <option>9:00am</option>
                            <option>9:30am</option>
                            <option>10:00am</option>
                            <option>10:30am</option>
                            <option>11:00am</option>
                            <option>11:30am</option>
                            <option>12:00am</option>
                            <option>12:30am</option>
                            <option>1:00pm</option>
                            <option>1:30pm</option>
                            <option>2:00pm</option>
                            <option>2:30pm</option>
                            <option>3:00pm</option>
                            <option>3:30pm</option>
                            <option>4:00pm</option>
                            <option>4:30pm</option>
                            <option>5:00pm</option>
                            <option>5:30pm</option>
                            <option>6:00pm</option>
                            <option>6:30pm</option>
                            <option>7:00pm</option>
                            <option>7:30pm</option>
                            <option>8:00pm</option>
                            <option>8:30pm</option>
                            <option>9:00pm</option>
                            <option>9:30pm</option>
                            <option>10:00pm</option>
                            <option>10:30pm</option>
                        </select>
                        </div>';
                    }
                ?>
                </div>
                <div class="button">
                    <input type="submit" name="submit"/>
                    <input type="reset" value="Clear" name="clear"/>
                </div>
            </form>
			<footer id="footer">
				<p>This web site is entirely original work and full academic 
					copyright is retained. This web site complieswith the Mason 
					<a href="http://oai.gmu.edu/mason-honor-code/">Honor Code 
					(http://oai.gmu.edu/mason-honor-code/).</a></p>
			</footer>
        </div>
    </div>
</body>
</html>