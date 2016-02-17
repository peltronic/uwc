<header id="mast_header" class="row">

    <article class="small-12 columns">
        <section class="row">
		    <article class="tag-headline small-12 medium-9 columns">
                <h1>Peter Gorgone: Expert Web Developer</h1>
		        <p>Rapid, Professional Full-Stack Development for Small Business and Startups</p>
            </article>
		    <article class="tag-contact small-12 medium-3 columns">
                <div id="contact-email">
                    <script type="text/javascript"> var name = "peter"; var domain = "@peltronic.com"; var txtstr = name + domain; document.write('Email: '+txtstr+''); </script>
                </div>
                <div id="contact-phone">
                    <script type="text/javascript"> var name = "(424) "; var domain1 = "241" ; var domain2 = "9327"; var txtstr = name + domain1 + '-' + domain2; document.write('Phone: '+txtstr+''); </script>
                </div>
            </article>
        </section>
    </article>

    <article class="superblock-nav small-12 columns">
        <nav>
            <ul>
                <li>{{link_to_route('site.pages.show','Home','home')}}</li>
                <li>{{link_to_route('site.pages.show','Portfolio','portfolio')}}</li>
                <li>{{link_to_route('site.pages.show','Contact','contact')}}</li>
                <li>{{link_to('/blog','Blog')}}</li>
            </ul>
        </nav>
    </article>

</header>
