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
			Practicum 2</br>
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
						echo "<b>Last Modified:</b></br>".date("F d Y H:i:s e", filemtime("calander.php"));
					?>
				</div>
            </header>
            <?php 
                $mon = array(); $tue = array(); $wed = array(); $thu = array(); $fri = array();
                if (!empty($_POST['mon'])) {
                    foreach ($_POST['mon'] as $value) array_push($mon, $value);
                    setcookie('mon', json_encode($mon), time() + 86400);
                }

                if (!empty($_POST['tue'])) {
                    foreach ($_POST['tue'] as $value) array_push($tue, $value);
                    setcookie('tue', json_encode($tue), time() + 86400);
                }

                if (!empty($_POST['wed'])) {
                    foreach ($_POST['wed'] as $value) array_push($wed, $value);
                    setcookie('wed', json_encode($wed), time() + 86400);
                }

                if (!empty($_POST['thu'])) {
                    foreach ($_POST['thu'] as $value) array_push($thu, $value);
                    setcookie('thu', json_encode($thu), time() + 86400);
                }

                if (!empty($_POST['fri'])) {
                    foreach ($_POST['fri'] as $value)  array_push($fri, $value);
                    setcookie('fri', json_encode($fri), time() + 86400);
                }

                $myFile = fopen("appointments.txt", "a+") or die ("Unable to open file!");
                if (!empty($_POST['name']) && !empty($_POST['time'])) {
                    fwrite($myFile, $_POST['time']." ".$_POST['name']."\n");
                    // if (!empty($_POST['monDate'])) {
                    //     fwrite($myFile, $_POST['time']." ".$_POST['name']." ".$_POST['monDate']."\n");
                    // }
                    // elseif (!empty($_POST['tueDate'])) {
                    //     fwrite($myFile, $_POST['time']." ".$_POST['name']." ".$_POST['tueDate']."\n");
                    // }
                    // elseif (!empty($_POST['wedDate'])) {
                    //     fwrite($myFile, $_POST['time']." ".$_POST['name']." ".$_POST['wedDate']."\n");
                    // }
                    // elseif (!empty($_POST['thuDate'])) {
                    //     fwrite($myFile, $_POST['time']." ".$_POST['name']." ".$_POST['thuDate']."\n");
                    // }
                    // elseif (!empty($_POST['friDate'])) {
                    //     fwrite($myFile, $_POST['time']." ".$_POST['name']." ".$_POST['friDate']."\n");
                    // }
                    // $name = $_POST['name'];
                    // $time = $_POST['time'];
                    // $day_num = $_POST['day_num'];
                    // echo $time.'--'.$name.'--'.$day_num;
                }
            ?>
            <form action="calander.php" method="post">
            <div class="student-input">
                <h1>Office Hours Signup Form</h1>
                Student Name: <input type="text" name="name"/>
                Student Email: <input type="text" name="email"/>
                <input type="submit" name="submit"/>
                <input type="reset" value="Clear" name="clear"/>
            </div>
            <header class="title">
                <?php
                    $month = date("m", time());
                    $year = date("Y", time());
                    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
                    $startingDay = date('N',strtotime($year.'-'.$month.'-01'));
                    if ($startingDay == 7) {
                        $startingDay = 0;
                    }
                    echo "<h2>",date("F Y", time()),"</h2>";
                ?>
            </header>
            <div class="days">
                <p>Sunday</p><p>Monday</p><p>Teusday</p><p>Wednesday</p><p>Thursday</p><p>Friday</p><p>Saturday</p>
            </div>
            <?php 
                function find_weeksInMonth($month, $year, $days_in_month, $startingDay) {
                    $weeks = ($days_in_month%7==0?0:1) + intval($days_in_month/7);
                    $endingDay = date('N',strtotime($year.'-'.$month.'-'.$days_in_month));
                    if($endingDay < $startingDay){
                        $weeks++;
                    }
                    return $weeks;
                }
                
                $weeksInMonth = find_weeksInMonth($month, $year, $days_in_month, $startingDay);

                $date = 1;
                $counter = 0;
                $file = file('appointments.txt');
                $readLine = array();
                for ($i = 0; $i <= $weeksInMonth; $i++) {
                    echo '<div class="row">';
                    for ($j = 0; $j < 7; $j++) {
                        if ($date == 1 && $j != $startingDay) {
                            echo '<div class="date"></div>';
                            continue;
                        }
                        elseif ($date <= $days_in_month) {
                            echo '<div class="date">'.$date.'<br/>';
                            if ($j == 1) {
                                $mon = json_decode($_COOKIE['mon']);
                                foreach ($mon as $value) {
                                    for ($k = 0; $k < count($file); $k++) {
                                        $readLine = explode(' ', $file[$k]);
                                        if($readLine[0].' '.$readLine[1] === $value.' '.strval($date)) {
                                            break;
                                        }
                                        else {
                                            $readLine = array();
                                        }
                                    }
                                    if (count($readLine) > 0 && $readLine[0].' '.$readLine[1] === $value.' '.strval($date) /*&& $_POST['friDate'] == $date*/) {
                                        echo '<p>'.$value.' -- '.$readLine[2].'</p>';
                                    }
                                    else {
                                        echo '<input type="radio" name="time" value="'.$value.' '.strval($date).'"/> '.$value.'<br/>';
                                        //echo '<input type="hidden" name="monDate" value="'.$date.'"/>';
                                    }
                                }
                            }
                            elseif ($j == 2) {
                                $tue = json_decode($_COOKIE['tue']);
                                foreach ($tue as $value) {
                                    for ($k = 0; $k < count($file); $k++) {
                                        $readLine = explode(' ', $file[$k]);
                                        if($readLine[0].' '.$readLine[1] === $value.' '.strval($date)) {
                                            break;
                                        }
                                        else {
                                            $readLine = array();
                                        }
                                    }
                                    if (count($readLine) > 0 && $readLine[0].' '.$readLine[1] === $value.' '.strval($date) /*&& $_POST['friDate'] == $date*/) {
                                        echo '<p>'.$value.' -- '.$readLine[2].'</p>';
                                    }
                                    else {
                                        echo '<input type="radio" name="time" value="'.$value.' '.strval($date).'"/> '.$value.'<br/>';
                                        //echo '<input type="hidden" name="tueDate" value="'.$date.'"/>';
                                    }
                                }
                            }
                            elseif ($j == 3) {
                                $wed = json_decode($_COOKIE['wed']);
                                foreach ($wed as $value) {
                                    for ($k = 0; $k < count($file); $k++) {
                                        $readLine = explode(' ', $file[$k]);
                                        if($readLine[0].' '.$readLine[1] === $value.' '.strval($date)) {
                                            break;
                                        }
                                        else {
                                            $readLine = array();
                                        }
                                    }
                                    if (count($readLine) > 0 && $readLine[0].' '.$readLine[1] === $value.' '.strval($date) /*&& $_POST['friDate'] == $date*/) {
                                        echo '<p>'.$value.' -- '.$readLine[2].'</p>';
                                    }
                                    else {
                                        echo '<input type="radio" name="time" value="'.$value.' '.strval($date).'"/> '.$value.'<br/>';
                                        //echo '<input type="hidden" name="wedDate" value="'.$date.'"/>';
                                    }
                                }
                            }
                            elseif ($j == 4) {
                                $thu = json_decode($_COOKIE['thu']);
                                foreach ($thu as $value) {
                                    for ($k = 0; $k < count($file); $k++) {
                                        $readLine = explode(' ', $file[$k]);
                                        if($readLine[0].' '.$readLine[1] === $value.' '.strval($date)) {
                                            break;
                                        }
                                        else {
                                            $readLine = array();
                                        }
                                    }
                                    if (count($readLine) > 0 && $readLine[0].' '.$readLine[1] === $value.' '.strval($date) /*&& $_POST['friDate'] == $date*/) {
                                        echo '<p>'.$value.' -- '.$readLine[2].'</p>';
                                    }
                                    else {
                                        echo '<input type="radio" name="time" value="'.$value.' '.strval($date).'"/> '.$value.'<br/>';
                                        //echo '<input type="hidden" name="thuDate" value="'.$date.'"/>';
                                    }
                                }
                            }
                            elseif ($j == 5) {
                                $fri = json_decode($_COOKIE['fri']);
                                foreach ($fri as $value) {
                                    for ($k = 0; $k < count($file); $k++) {
                                        $readLine = explode(' ', $file[$k]);
                                        if($readLine[0].' '.$readLine[1] === $value.' '.strval($date)) {
                                            break;
                                        }
                                        else {
                                            $readLine = array();
                                        }
                                    }
                                    if (count($readLine) > 0 && $readLine[0].' '.$readLine[1] === $value.' '.strval($date) /*&& $_POST['friDate'] == $date*/) {
                                        echo '<p>'.$value.' -- '.$readLine[2].'</p>';
                                    }
                                    else {
                                        echo '<input type="radio" name="time" value="'.$value.' '.strval($date).'"/> '.$value.'<br/>';
                                        //echo '<input type="hidden" name="friDate" value="'.$date.'"/>';
                                    }
                                }
                            }
                            else {
                                echo '';
                            }
                            $date++;
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                }
            ?>
            </form>
            <footer id="footer">
				<p>This web site is entirely original work and full academic 
					copyright is retained. This web site complieswith the Mason 
					<a href="http://oai.gmu.edu/mason-honor-code/">Honor Code</a>.</p>
			</footer>
        </div>
    </div>
</body>
</html>