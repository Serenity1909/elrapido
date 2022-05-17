<?php
header('content-type: application/xhtml+xml;charset=utf-8');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <title>El rapîdo</title>
        <link rel="stylesheet" href="./css/mainStyle.css" />
        <link rel="stylesheet" href="./css/indexStyle.css" />
        <link rel="stylesheet" href="./css/header.css" />
        <link rel="stylesheet" href="./css/footer.css" />
    </head>
    
    <body>

        <header>
            <!-- slider in header -->
            <div class="slider">
                <div class="slides">
                    <div class="slide"><img src="img/header1.jpg" class="imgSlide"/></div>
                    <div class="slide"><img src="img/header2.jpg" class="imgSlide"/></div>
                    <div class="slide"><img src="img/header3.jpg" class="imgSlide"/></div>
                    <div class="slide"><img src="img/header4.jpg" class="imgSlide"/></div>
                    <div class="slide"><img src="img/header5.jpg" class="imgSlide"/></div>
                    <div class="slide"><img src="img/header6.jpg" class="imgSlide"/></div>
                </div>
            </div>

            <h1><?php echo $title; ?></h1>

            <!-- Navigation bar -->
            <nav class="header">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Contact.php">Contact / Support</a></li>
                    <li><a href="Help.php">Help</a></li>
                </ul>
            </nav>
        </header>