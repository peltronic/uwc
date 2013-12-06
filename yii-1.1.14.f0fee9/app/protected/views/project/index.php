<?php
/* @var $this ProjectController */

//$this->breadcrumbs=array( 'Portfolio',);
$this->pageTitle=Yii::app()->name . ' | Project Portfolio';
?>
<h1>Portfolio/Projects</h1>

<div id="container-projects">
<div id="accordion">

  <!-- ==================================== -->
  <h3>One Day on Earth</h3>
  <div class="OFFcrate-project">
    <p><a class="" href="http://archive.onedayonearth.org" target="_blank">One Day on Earth</a> is an annual project founded by a Santa Monica-based filmmaker. On October 10, 2010 (10/10/10), thousands of volunteers worldwide shot documenting life on that one day. The "archive" uses google maps to allow viewers to browse and watch the videos by location, keywords, categories, and so forth.</p>
    <p>I developed the archive site from scratch based on designer's mock-ups. The site uses the Codeigniter MVC framework, and is hightly AJAX-driven in order to provide a smoother user experience. I also hand-coded the HTML and CSS to implement and match the graphic designer's specs. The LAMP-based backend is integrated with Google Maps, Vimeo Hosting API, and Ning Social Network API integration. Features include search, video comments & ratings, I18N support. I also developed or maintained a full “ecosystem” of supporting tools, such as an admin panel and a custom video uploader.
    </p>
    <img src="/images/odoe.png" style="max-width: 580px;max-height: 500px;" alt="One Day on Earth Screenshot">
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
        <li> A page creation widget, which lets users save a page draft (pre-publishing), publish, and revert to a prior version of the page. Implemenation involved creating the database schemas and REST-ful APIs to support basic CRUD oeprations (creation, viewing, updating, deleting), as well as the save and publish actions.
        </li>
        <li> Custom content import management using Elastic Search.
        </li>
        <li> Database schemas and APIs to manage sites, invoices, and user groups.
        </li>
    </ul>
  </div>

  <!-- ==================================== -->
  <h3>PaidYet</h3>
  <div>
    <p> <a class="" href="http://www.paidyet.com" target="_blank">PaidYet</a> is a one-click payment system start-up. My work on this site was mostly front-end coding in Javascript and CSS.</p>
    <ul>
        <li>Customized client-side form validation to display "ok" or "error" icons with error messages in "pop-ups".
        </li>
        <li> Responsive layout using Twitter Bootstrap.
        </li>
        <li> Layout and style pages to match design mock-ups.
        </li>
    </ul>
  </div>

  <!-- ==================================== -->
  <h3>Robot Dough</h3>
  <div>
    <p>Robot Dough was a cutting-edge Web 2.0 stock investing site. I was hired after the orginal site was in place, and for the next year helped to build new features and optimize current ones in the Symfony MVC-based code. Some examples of features I worked on were a gamifcation-styled 'leaderboard' ranking users based on portfolio performance, a dashboard listing user “missions”, and an “equity browser” that allowed users to easily find a stock by interactively browsing a sector and industry hierarchy.</p>
  </div>

</div> <!-- accordion -->
</div> <!-- container-projects -->

