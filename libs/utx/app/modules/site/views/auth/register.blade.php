@extends('layouts.site')
@section('content')

<div class="row">
<section class="small-12 columns view-register">

    <article class="crate-register">
        <h2>Create Account</h4>
        {{ Form::open(array('route'=>'site.doregister', 'method'=>'POST', 'class'=>'form-custom form-register')) }}
        <div class="row">
            <div class="small-12 columns">
                @include('site::partials._registerFormFieldset',[])
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
                {{ Form::submit('Sign Up', array('class'=>'button small radius tag-register-btn'))}}
            </div>
            {{ Form::close() }}
        </div>
    </article>

</section>
</div>

@stop
