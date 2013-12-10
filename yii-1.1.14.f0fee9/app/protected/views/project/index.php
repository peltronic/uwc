<?php
/* @var $this ProjectController */

//$this->breadcrumbs=array( 'Portfolio',);
$this->pageTitle=Yii::app()->name . ' | Project Portfolio';
?>
<h1>Portfolio</h1>

<div id="container-projects">
<div id="accordion">

  <!-- ==================================== -->
  <h3>One Day on Earth Archive Map</h3>
  <div class="OFFcrate-project">
    <p><a class="" href="http://archive.onedayonearth.org" target="_blank">One Day on Earth</a> is an annual project founded by a Santa Monica-based filmmaker. Starting on October 10, 2010 (10/10/10), thousands of volunteers worldwide shot footage documenting life for that day. The "archive" uses google maps to allow viewers to browse and watch the videos by location, keywords, and categories.</p>

  <ul>
    <li>Built archive site from ground-up, based on designer's mock-ups.</li>
    <li>AJAX-driven to provide a smooth UX.</li>
    <li>Hand-coded HTML and CSS to implement and match the graphic designer's specs.</li>
    <li>Integrated with Google Maps, Vimeo Hosting, and Ning Social Network APIs.</li>
    <li>Implemented keyword search feature.</li>
    <li>Added features such as video comments & ratings.</li>
    <li>Full I18N support.</li>
    <li>Developed & maintained a full “ecosystem” of supporting tools, such as an admin panel and a custom video uploader.</li>
    
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
        <li> Integration of <a href="http://www.openwebanalytics.com/" target="_blank">Open Web Analytics</a> library to measure statistics for hosted sites.
        </li>
        <li> A custom theme uploader, which allows users to design and publish their own themes.
        </li>
        <li> A page creation widget, which lets users save a page draft (pre-publishing), publish, and revert to a prior version of the page. Implementation involved creating the database schemas and REST-ful APIs to support basic CRUD operations (creation, viewing, updating, deleting), as well as the save and publish actions.
        </li>
        <li> Custom content import management using Elastic Search.
        </li>
        <li> Database schemas and APIs to manage sites, invoices, and user groups.
        </li>
    </ul>
  </div>

  <!-- ==================================== -->
  <h3>Robot Dough</h3>
  <div>
    <p>Robot Dough was a cutting-edge Web 2.0 stock investing site. I was hired after the original site was in place, and for the next year helped to build new features and optimize current ones in the Symfony MVC-based code. Some examples of features I worked on were a gamification-styled 'leaderboard' ranking users based on portfolio performance, a dashboard listing user “missions”, and an “equity browser” that allowed users to easily find a stock by interactively browsing a sector and industry hierarchy.</p>
  </div>

  <!-- ==================================== -->
  <h3>Graduation Nation</h3>
  <div>
    <p> <a class="" href="http://www.graduationnation.com" target="_blank">Graduation Nation</a> offers a video recording service which is used by many colleges nationwide to record graduation ceremonies. I inherited an existing codebase and database schema, and fixed several critical bugs that demanded immediate attention. In addition, I integrated a new DVD Fulfillment vendor without interrupting site activity. Finally, I executed a transfer of the entire site (code and database) to a new hosting server, with minimal site downtime.</p>
  </div>

  <!-- ==================================== -->
  <h3>NDMS Corp</h3>
  <div>
    <p> I contributed to a one-click payment system start-up. My work on this site was mostly front-end coding in Javascript and CSS.</p>
    <ul>
        <li>Customized client-side form validation to display "ok" or "error" icons with error messages in "pop-ups".
        </li>
        <li> Responsive layout using Twitter Bootstrap.
        </li>
        <li> Layout and style pages to match design mock-ups.
        </li>
    </ul>
  </div>


</div> <!-- accordion -->
</div> <!-- container-projects -->

