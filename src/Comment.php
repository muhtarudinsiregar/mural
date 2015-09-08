<?php
namespace Laravolt\Mural;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

    use SoftDeletes;

    public function author()
    {
        return $this->belongsTo(config('auth.model'));
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function scopeNewest($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeBeforeId($query, $beforeId)
    {
        return $query->where('id', '<', $beforeId);
    }

    public function scopeRoom($query, $room)
    {
        if($room) {
            $query->whereRoom($room);
        } else {
            $query->whereNull('room');
        }

        return $query;
    }
}
