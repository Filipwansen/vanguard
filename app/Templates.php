<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vanguard\User;

class Templates extends Model
{
    use HasFactory;

    protected $table = 'templates';

    protected $fillable = ['user_id', 'template_name', 'description'];

    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
