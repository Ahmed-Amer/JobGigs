<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'logo', 'company', 'location', 'website', 'email', 'description', 'tags'];

    //function added to make filters work
    public function scopeFilter($query, array $filters)
    {
        //tags
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        //form search
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%')
                ->orWhere('company', 'like', '%' . request('search') . '%');
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
