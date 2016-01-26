<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Cam-Website';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->Html->meta('icon') ?>
    <!-- Website Title & Description for Search Engine purposes -->
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <meta name="description" content="A players utility for the Camarilla.ca">
        
    <!-- Mobile viewport optimized -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Bootstrap CSS -->
    <?= $this->Html->css(['bootstrap','bootstrap.min', 'bootstrap-glyphicons', 'bootstrap-theme', 'autocomplete', 'styles', 'responsive']); ?>


    <?= $this->Html->script('jquery-1.8.2.min'); ?>
    <?= $this->Html->script('jquery.autocomplete.min'); ?>

    <!-- Include Modernizr in the head, before any other Javascript -->
    <?= $this->Html->script('modernizr-2.6.2.min'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <div class="container" id="main">

        <!-- Nav Bar -->
        <?= $this->element('navigation_bar', ['cakeDescription'=>$cakeDescription]) ?>

        <!-- Content -->
        <div class="container">
            <div class="starter-template">
                <?= $this->Flash->render() ?>

                <?= $this->fetch('content') ?>
            </div>
        </div><!-- /.container -->

        <div class="carousel slide" id="myCarousel">

        </div><!-- end myCarousel -->


        <div class="row" id="bigCallout">

        </div><!-- end bigCallout -->


        <div class="row" id="featuresHeading">

        </div><!-- end featuresHeading -->


        <div class="row" id="features">

        </div><!-- end features -->


        <div class="row" id="moreInfo">

        </div><!-- end moreInfo -->


        <div class="row" id="moreCourses">

        </div><!-- end moreCourses -->

    </div> <!-- end containter -->

    <footer>

    </footer>

   
    

    <!-- All Javascript at the bottom of the page for faster page loading -->
    <?= $this->Html->script('ie10-viewport-bug-workaround'); ?>

    <!-- First try for the online version of jQuery-->
    <script src="http://code.jquery.com/jquery.js"></script>

    
    <!-- If no online access, fallback to our hardcoded version of jQuery -->
    <script>window.jQuery || document.write('<script src="/js/jquery-1.8.2.min.js"><\/script>')</script>
    
    <!-- Bootstrap JS -->
     <?= $this->Html->script('bootstrap.min'); ?>
    
    <!-- Custom JS -->
    <script src="script.js"></script>


</body>
</html>
