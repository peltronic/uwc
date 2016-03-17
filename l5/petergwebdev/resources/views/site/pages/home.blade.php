@extends('layouts.site')

@section('content')
<section class="row">
    <article class="small-12 columns">
<div id="content">
	<div id="subcontainer-home">

<h1>Welcome!</h1>

<img id="pic-peter" src="/images/peter_expert_web_developer.jpg" style="max-width: 220px" align="right" alt="Peter's Expert Web Developer Profile Picture">

{!! $contents['home-page-1'] !!}

<h1>Skills</h1>
<ul>
<li>Web&nbsp;programming:&nbsp;PHP,&nbsp;MySQL,&nbsp;AJAX/JSON,&nbsp;HTML,&nbsp;CSS,&nbsp;Javascript/JQuery,&nbsp;REST,&nbsp;OAuth, Web&nbsp;2.0&nbsp;APIs&nbsp;(Facebook,&nbsp;Twitter,&nbsp;etc)</li>
<li>CMS/Frameworks:&nbsp;Yii,&nbsp;Laravel, Symfony,&nbsp;CodeIgniter,&nbsp;Zend&nbsp;Framework, Wordpress.</li>
<li>Other&nbsp;programming&nbsp;languages:&nbsp;C&nbsp;(expert),&nbsp;C++&nbsp;(advanced).</li>
<li>Web&nbsp;Analytics&nbsp;Tools:&nbsp;<a href="https://mixpanel.com/">Mixpanel</a>,&nbsp;Google&nbsp;Analytics.</li>
<li>Cloud&nbsp;Hosting:&nbsp;Amazon&nbsp;Web&nbsp;Services&nbsp;(AWS)&nbsp;EC2&nbsp;&amp; Load&nbsp;Balancing, Rackspace Cloud</li>
<li>Version&nbsp;Control:&nbsp;github,&nbsp;mercurial,&nbsp;cvs</li>
<li>Solid&nbsp;understanding&nbsp;of&nbsp;data&nbsp;structures,&nbsp;design&nbsp;patterns,&nbsp;computer&nbsp;and&nbsp;web&nbsp;architecture.</li>
<li>Rapid&nbsp;prototype&nbsp;development&nbsp;using&nbsp;"Lean&nbsp;Startup"&nbsp;methodology &amp; SCRUM.</li>
<li>Highly&nbsp;proficient&nbsp;with&nbsp;Linux,&nbsp;MySQL,&nbsp;and&nbsp;Apache&nbsp;administration&nbsp;(including&nbsp;shell&nbsp;scripting&nbsp;&amp;&nbsp;Linux command&nbsp;line,&nbsp;vi).</li>
<li>Excellent&nbsp;debug/troubleshooting&nbsp;skills;&nbsp;expertise&nbsp;in&nbsp;Zend&nbsp;Debugger,&nbsp;Firebug,&nbsp;gdb,&nbsp;Visual&nbsp;Studio.</li>
</ul>

<p>
My hourly rate is $75 (1099). On request, I can provide references from past clients as well as my <a href="https://www.linkedin.com/in/petergorgone">LinkedIn</a>.
</p>

<p>
Please contact me by email or phone if you need help with a project. I typically work form home but I'm open to on-site work as well. I am based in Las Vegas but have strong ties to Los Angeles and can do on-site work anywhere in Southern California.
</p>

<div id="contact-email">
    <script type="text/javascript"> var name = "peter"; var domain = "@peltronic.com"; var txtstr = name + domain; document.write('Email: '+txtstr+''); </script>Email: peter@peltronic.com
</div>
<div id="contact-phone">
    <script type="text/javascript"> var name = "(424) "; var domain1 = "241" ; var domain2 = "9327"; var txtstr = name + domain1 + '-' + domain2; document.write('Phone: '+txtstr+''); </script>Phone: (424) 241-9327
</div>

</div> <!-- subcontainer-home -->
</div>
    </article>
</section>
@stop
