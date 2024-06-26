<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable

{
use  HasFactory;
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function taskes()
    {
        return $this->hasMany(Task::class);
    }
    public function status_task()
    {
        return $this->hasMany(status_task::class);
    }


}
