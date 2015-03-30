<?php
/* @var $this ProjectController */

//$this->breadcrumbs=array( 'Portfolio',);
$this->pageTitle=Yii::app()->name . ' | Project Portfolio';
?>
<h1>Portfolio</h1>

<div id="container-projects">
<div id="accordion">

  <!-- ==================================== -->
  <h3>Axiom Images</h3>
  <div class="OFFcrate-project">
    <p><a class="" href="http://www.axiomimages.com" target="_blank">Axiom Images</a> is a growing e-commerce site specializing in aerial video footage.</p>

  <ul>
    <li>Re-built CRUD-based admin backend from scratch using Laravel Framework. Most panels have the same CRUD operations, which use common libraries. Panels that have special features can be derived from the common libraries and customized as needed.</li>
    <li>AJAX-driven to provide a smooth UX.</li>
    <li>Built custom keyword-based search engine with autocomplete.</li>
    <li>Implemented advanced product search filter with corresponding UI. Optimized algorithm with database caching and other techniques to drastically cut query &amp; processing latencies, and improve responsiveness.</li>
  </ul>

  </div>

  <!-- ==================================== -->
  <h3>One Day on Earth Archive Map</h3>
  <div class="OFFcrate-project">
    <p><a class="" href="http://archive.onedayonearth.org" target="_blank">One Day on Earth</a> is an annual project founded by a Santa Monica-based filmmaker. Starting on October 10, 2010 (10/10/10), thousands of volunteers worldwide shot footage documenting life for that day. The "archive" uses google maps to allow viewers to browse and watch the videos by location, keywords, and categories.</p>

  <ul>
    <li>Built Google Maps-based archive site from ground-up, based on designer's mock-ups.</li>
    <li>AJAX-driven to provide a smooth UX.</li>
    <li>Hand-coded HTML and CSS to implement and match the graphic designer's specs.</li>
    <li>Integrated Vimeo Hosting and Ning Social Network APIs.</li>
    <li>Implemented keyword search feature.</li>
    <li>Added features such as video comments &amp; ratings.</li>
    <li>Full I18N support.</li>
    <li>Developed &amp; maintained a full "ecosystem" of supporting tools, such as an admin panel and a custom video uploader.</li>
    
  </ul>

    <img src="/images/odoe.png" style="max-width: 580px;max-height: 500px;" alt="One Day on Earth Archive Screenshot">
  </div>

  <!-- ==================================== -->
  <h3>One Day on Earth Video Uploader</h3>
  <div class="OFFcrate-project">

    <p>The One Day on Earth project required a custom upload app to allow users to upload their videos to Vimeo, while entering details about the video that would show on the archive map.</p>

    <ul>
        <li>Implemented user Vimeo account sign-up or login through custom upload app.</li>
        <li>Integrated <a href="http://www.plupload.com/" alt="Plupload">Plupload</a> Javascript plugin to perform actual upload task from user's browser.</li>
        <li>Developed back-end cron script to manage uploads from app server to Vimeo server.</li>
        <li>PHP backend code to manage user data associated with each video. User data and Vimeo Identification for the video was tracked on the app server's database, but actual video hosting was provided by Vimeo.</li>
        <li>Deployed to multiple load-balanced Amazon Web Services (AWS) servers. (EC2, RDS, S3)</li>
        <li> Implemented robust error-handling and "graceful degradation" features to handle possible user errors.</li>
    </ul>
    
    <img src="/images/odoe-uploader-step5.png" style="max-width: 580px;max-height: 500px;" alt="One Day on Earth Uploader Screenshot">
  </div>

  <!-- ==================================== -->
  <h3>Moboom</h3>
  <div>
    <p> <a class="" href="http://www.moboom.com" target="_blank">Moboom</a> is a sophisticated platform for building mobile websites. I was brought on in mid-2012 to help with development of the backend, which uses PHP and the Yii MVC framework. Enhancements and features I implemented include: </p>
    <ul>
        <li> Integrated <a href="http://www.openwebanalytics.com/" target="_blank">Open Web Analytics</a> library to measure statistics for hosted sites.
        </li>
        <li> Developed a custom theme uploader, letting users design and publish their own themes.
        </li>
        <li> Implemented creation widget, allowing users to save a page draft (pre-publishing), publish, and revert to a prior version of the page. Work involved creating the database schemas and REST-ful APIs to support basic CRUD operations (creation, viewing, updating, deleting), as well as the save and publish actions.
        </li>
        <li> Implemented custom content import management using Elastic Search.
        </li>
        <li> Designed &amp; implemented database schemas and APIs to manage sites, invoices, and user groups.
        </li>
    </ul>
  </div>

  <!-- ==================================== -->
  <h3>Robot Dough</h3>
  <div>
    <p>Robot Dough was a cutting-edge Web 2.0 stock investing site coded in the Symfony MVC framework. I was hired after the original site was in place, and for the next year helped to build new features and optimize existing ones.</p>
    <ul>
        <li>Implemented leader-board to track user portfolio performance.</li>
        <li>Designed &amp; coded dashboard with user "missions", and "equity browser" that lets users easily find a stock by navigating sector and industry hierarchy interactively.</li>
    </ul>
  </div>

  <!-- ==================================== -->
  <h3>Graduation Nation</h3>
  <div>
    <p> <a class="" href="http://www.graduationnation.com" target="_blank">Graduation Nation</a> offers a video recording service which is used by many colleges nationwide to record graduation ceremonies.</p>
    <ul>
        <li>Added fixes and improvements to existing codebase &amp; database schema inherited from past developers, fixed several critical bugs that demanded immediate attention. </li>
        <li>Integrated a new DVD Fulfillment vendor without interrupting site activity. </li>
        <li>Transferred site (code and database) to a new hosting server, with minimal downtime.</li>
    </ul>
  </div>

  <!-- ==================================== -->
  <h3>Paid Yet</h3>
  <div>
    <p> I contributed to a one-click payment system start-up. My work on this site was mostly front-end coding in Javascript and CSS.</p>
    <ul>
        <li>Customized client-side form validation to display status and error messages with icons.</li>
        <li>Implemented responsive layout using Twitter Bootstrap.</li>
        <li>Hand-coded css layout and stylesheets to match design mock-ups.</li>
    </ul>
  </div>


</div> <!-- accordion -->
</div> <!-- container-projects -->

