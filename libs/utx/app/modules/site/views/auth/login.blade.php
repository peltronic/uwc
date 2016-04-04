@extends('layouts.site')
@section('content')

<div class="row">
<section class="medium-12 columns view-login">
    <article class="crate-login">
@if(\Session::has('message'))
    <div class="alert-box success">
        <h4>{{ \Session::get('message') }}</h4>
    </div>
@endif
        <h2>Login Here</h2>
        {{ Form::open(array('route'=>'site.dologin', 'method'=>'POST', 'class'=>'form-custom form-login')) }}
        <div class="row">
            <div class="small-12 medium-4 large-4 columns">
                @include('site::partials._loginFormFieldset',[])
            </div>
        </div>
        <div class="row">
            <div class="small-6 medium-6 large-6 columns">
                {{ Form::submit('Login', array('class'=>'button small radius tag-login-btn'))}}
            </div>
            <div class="small-6 medium-6 large-6 columns">
                <ul>
                    <li>{{ link_to_route('site.showregister','New User?',[],['class'=>'tag-clickme_to_register']) }}</li>
                    <li>{{ link_to_route('site.password.getForgot','Forgot Password?',[],['class'=>'tag-clickme_to_reset_password']) }}</li>
                </ul>
            </div>
            {{ Form::close() }}
        </div>
        <div class="row">
            <?php //dd($errors); ?>
            <ul class="errors">
            @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
            </ul>
        </div>
    </article>
</section>
</div>

@stop
