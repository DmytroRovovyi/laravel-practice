<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    /**
     * Get the attributes that should for user.
     *
     * @return array<string, string>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
