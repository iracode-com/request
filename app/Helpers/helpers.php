<?php

function generateTrackingCode()
{
    return time() . '-' . Str::random(10);
}

function pascal_case_to_spaces($string)
{
    return preg_replace('/(?<!^)([A-Z])/', ' \1', $string);
}

function get_users_list()
{
    $users = \App\Models\User::all();
    $users_array = [];
    foreach ($users as $user) {
        $users_array[$user->id] = $user->name;
    }
    return $users_array;
}

function current_user_has_role($roleName){
    // return auth()->user()->hasRole($roleName);
    return auth()->user()->role == $roleName;
}