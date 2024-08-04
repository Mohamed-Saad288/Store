<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Str;

class ModelPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function before($user ,$ability)
    {
        if($user->super_admin)
        {
            return true;
        }
    }

    //this function to not use any function in any polices class only create empty policies class
    //any policies class should extend from model policy
    public function __call(string $name, array $arguments)
    {
        $class_name= str_replace('policy','',class_basename($this));
        $class_name= Str::plural(strtolower($class_name));
        if($name =='viewAny')
        {
            $name='view';
        }
        $ability=$class_name.'.'.Str::kebab($name);
        $user=$arguments[0];

        if(isset($arguments[1]))
        {
            $model=$arguments[1];
            if($model->store_id!==$user->store_id)
            {
                return false;
            }
        }
        return $user->hasAbility($ability);
    }
}
