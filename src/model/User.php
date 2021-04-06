<?php

namespace website\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'pseudo', 'email', 'password'];
    public $timestamps = false;
}
