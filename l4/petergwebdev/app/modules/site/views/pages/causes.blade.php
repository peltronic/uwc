@extends('layouts.lsite')

@section('content')
<div class="container-causes">
	<h1 class="page-title">Our Partners</h1>
    {{--
	<ul id="causes">
        @foreach ($partners as $p)
		<li>
            <h3>{{$p->title}}</h3>
            {{link_to($p->link,$p->link)}}
		</li>
        @endforeach
	</ul>
    --}}
<div class="col-100">
				<link media="all" type="text/css" rel="stylesheet" href="https://www.writeevolution.com/style/static.css">

	<div class="headline-wrapper">
		<h1>Causes we trust:</h1>
		<h2>Find yours or suggest a favorite.</h2> 
        <p>We are trending toward Veterans causes, but there are many worthy of your help.</p>
	</div>
    <div class="form-wrapper">
		<form class="left-labels  ContactForms1 contactForm-skin01 contactForm-base" role="form"> 
			<div class="form-group required">
		 		<label for="message1" class="message1">Suggest a cause.</label>
		 		<div class="control-holder">
		 			<textarea id="message1" class="form-control" maxlength="500"></textarea>
		 		</div>
		 	</div>
			<div class="form-group"> 
		 		<button type="submit" class="btn btn-default">Send form</button>
		 	</div>
		</form>
    </div>
	<br clear="all">
	<p class="donations-bar">Total $$ Donated as of August 30, 2014 — $4,225.00</p>      
       	
	<div class="grid-wrapper">
    	<div class="logo5">
        	<a href="http://www.cancer.org/" target="_blank"><img class="scalable-oc" title="American Cancer Society" alt="WriteEvolution.com likes the American Cancer Society" src="images/logo/WE-cause-American-Cancer-Society-300.jpg"></a>
        <!-- end logo 1 --></div>
        <div class="logo5">
        	<a href="http://www.heart.org/HEARTORG/" target="_blank"><img class="scalable-oc" title="American Heart Association" alt="WriteEvolution.com likes the American Heart Association" src="images/logo/WE-cause-American-Heart-Assn-300.jpg"></a>
        <!-- end logo 2 --></div>
        <div class="logo5">
        	<a href="http://www.legion.org/riders" target="_blank"><img class="scalable-oc" title="American Legion Riders" alt="WriteEvolution.com likes the American Legion Riders" src="images/logo/WE-cause-American-Legion-Riders-300.jpg"></a>
        <!-- end logo 3 --></div>
        <div class="logo5">
        	<a href="http://www.americansforthearts.org/" target="_blank"><img class="scalable-oc" title="Americans for the Arts" alt="WriteEvolution.com likes Americans for the Arts" src="images/logo/WE-cause-Americans-for-the-Arts-300.jpg"></a>
        <!-- end logo 4 --></div>
        <div class="logo5">
        	<a href="http://www.nationalservice.gov/programs/americorps" target="_blank"><img class="scalable-oc" title="AMERICORPS" alt="WriteEvolution.com likes AMERICORPS" src="images/logo/WE-cause-Americorps-300.jpg"></a>
        <!-- end logo 5 --></div>
		<br clear="all">
    
	    <div class="logo5">
        	<img src="images/logo/WE-cause-AMVETS-300.jpg" title="AMVETS" alt="WriteEvolution.com likes AMVETS" target="_blank" class="scalable-oc">
        <!-- end logo 1 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-beans-cafe-300.jpg" title="bean's cafe" alt="WriteEvolution.com likes bean's cafe" target="_blank" class="scalable-oc">
        <!-- end logo 2 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-BGCA-300.jpg" title="Boys &amp; Girls Clubs of America" alt="WriteEvolution.com likes the Boys &amp; Girls Clubs of America" target="_blank" class="scalable-oc">
        <!-- end logo 3 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Boy-Scouts-of-America-300.jpg" title="Boy Scouts of America" alt="WriteEvolution.com likes the Boy Scouts of America" target="_blank" class="scalable-oc">
        <!-- end logo 4 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Combat-Vets-Assn-300.jpg" title="Combat Vets Association" alt="WriteEvolution.com likes the Combat Vets Association" target="_blank" class="scalable-oc">
        <!-- end logo 5 --></div>
	    <br clear="all">
	    
	    <div class="logo5">
        	<img src="images/logo/WE-cause-DAV-promises-300.jpg" title="Disabled American Veterans" alt="WriteEvolution.com likes the DAV" target="_blank" class="scalable-oc">
        <!-- end logo 1 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Feeding-America-300.jpg" title="Feeding America" alt="WriteEvolution.com likes Feeding America" target="_blank" class="scalable-oc">
        <!-- end logo 2 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Earth-Guardians-300.jpg" title="Earth Guardians" alt="WriteEvolution.com likes the Earth Guardians" target="_blank" class="scalable-oc">
        <!-- end logo 3 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-i-am-equal-300.jpg" title="i am equal" alt="WriteEvolution.com likes Americans for the Arts" target="_blank" class="scalable-oc">
        <!-- end logo 4 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-FisherHouse-300.jpg" title="Fisher House" alt="WriteEvolution.com likes Fisher House" target="_blank" class="scalable-oc">
        <!-- end logo 5 --></div>
	    <br clear="all">
	    
	    <div class="logo5">
        	<img src="images/logo/WE-cause-Literacy-Inc-300.jpg" title="Literacy, Inc." alt="WriteEvolution.com likes Literacy, Inc." target="_blank" class="scalable-oc">
        <!-- end logo 1 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Make-A-Wish-300.jpg" title="Make A Wish Foundation" alt="WriteEvolution.com likes the Make A Wish Foundation" target="_blank" class="scalable-oc">
        <!-- end logo 2 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-National-Guard-Assn-300.jpg" title="National Guard Association" alt="WriteEvolution.com likes the National Guard Association" target="_blank" class="scalable-oc">
        <!-- end logo 3 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Navy-Marine-Corps-Relief-300.jpg" title="Americans for the Arts" alt="WriteEvolution.com likes Americans for the Arts" target="_blank" class="scalable-oc">
        <!-- end logo 4 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-NCOA-300.jpg" title="AMERICORPS" alt="WriteEvolution.com likes AMERICORPS" target="_blank" class="scalable-oc">
        <!-- end logo 5 --></div>
	    <br clear="all">
	    
	    <div class="logo5">
        	<img src="images/logo/WE-cause-NRA-300.jpg" title="American Cancer Society" alt="WriteEvolution.com likes the American Cancer Society" target="_blank" class="scalable-oc">
        <!-- end logo 1 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-POW-MIA-300.jpg" title="American Cancer Society" alt="WriteEvolution.com likes the American Cancer Society" target="_blank" class="scalable-oc">
        <!-- end logo 2 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-St.Jude-Childrens-Hospital-300.jpg" title="American Legion Riders" alt="WriteEvolution.com likes the American Legion Riders" target="_blank" class="scalable-oc">
        <!-- end logo 3 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Streetside-Stories-300.jpg" title="Americans for the Arts" alt="WriteEvolution.com likes Americans for the Arts" target="_blank" class="scalable-oc">
        <!-- end logo 4 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Surf-Dog-300.jpg" title="AMERICORPS" alt="WriteEvolution.com likes AMERICORPS" target="_blank" class="scalable-oc">
        <!-- end logo 5 --></div>
	    <br clear="all">
	    
	    <div class="logo5">
        	<img src="images/logo/WE-cause-Toys-for-Tots-300.jpg" title="American Cancer Society" alt="WriteEvolution.com likes the American Cancer Society" target="_blank" class="scalable-oc">
        <!-- end logo 1 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-US-War-Dogs-Assn-300.jpg" title="American Cancer Society" alt="WriteEvolution.com likes the American Cancer Society" target="_blank" class="scalable-oc">
        <!-- end logo 2 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-USO-300.jpg" title="American Legion Riders" alt="WriteEvolution.com likes the American Legion Riders" target="_blank" class="scalable-oc">
        <!-- end logo 3 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Viet-Nam-Veterans-300.jpg" title="Americans for the Arts" alt="WriteEvolution.com likes Americans for the Arts" target="_blank" class="scalable-oc">
        <!-- end logo 4 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-Wounded-Warrior-Project-300.jpg" title="AMERICORPS" alt="WriteEvolution.com likes AMERICORPS" target="_blank" class="scalable-oc">
        <!-- end logo 5 --></div>
	    <br clear="all">
	    
	    <div class="logo5">
        	<img src="images/logo/WE-cause-blank-white.gif" title="xxxxxxx" alt="WriteEvolution.com likes the American Cancer Society" target="_blank" class="scalable-oc">
        <!-- end logo 1 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-blank-white.gif" title="xxxxxxx" alt="WriteEvolution.com likes the American Cancer Society" target="_blank" class="scalable-oc">
        <!-- end logo 2 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-blank-white.gif" title="xxxxxxx" alt="WriteEvolution.com likes the American Legion Riders" target="_blank" class="scalable-oc">
        <!-- end logo 3 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-blank-white.gif" title="xxxxxxx" alt="WriteEvolution.com likes Americans for the Arts" target="_blank" class="scalable-oc">
        <!-- end logo 4 --></div>
        <div class="logo5">
        	<img src="images/logo/WE-cause-blank-white.gif" title="xxxxxxx" alt="WriteEvolution.com likes AMERICORPS" target="_blank" class="scalable-oc">
        <!-- end logo 5 --></div>
		<br clear="all">
                        
                    
	</div>    
    
			</div>
</div>
@stop
