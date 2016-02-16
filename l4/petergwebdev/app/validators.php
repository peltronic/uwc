<?php

// also commas
Validator::extend('alpha_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\s,]+$/u', $value);
});

Validator::extend('alpha_dash_space', function($attribute, $value)
{
    return preg_match('/^[\pL\pM\pN_\-\s]+$/u', $value);
});

Validator::extend('number_dash_space', function($attribute, $value)
{
    return preg_match('/^[\pN_\-\s]+$/u', $value);
});

Validator::extend('phone_number', function($attribute, $value)
{
    return preg_match("/^([0-9\s\-\+\(\)]*)$/", $value);
});

Validator::extend('street_address', function($attribute, $value)
{
    return preg_match('/^[\pP\pL\pM\pN_\-\s]+$/u', $value);
});
