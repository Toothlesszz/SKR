<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable; // dùng để hỗ trợ Auth
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{   
    use Notifiable;
protected $primaryKey = 'id_admin';
    protected $table = 'admin';

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password'];
}
