<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;
use App\User;

class Shopping extends Model
{
    protected $table = 'shopping';

    protected $fillable = ['user_id','name','quantity','price'];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i:s',
        'updated_at' => 'datetime:d/m/Y H:i:s'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
