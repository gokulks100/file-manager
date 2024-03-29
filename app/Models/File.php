<?php

namespace App\Models;

use App\Traits\HasCreatorAndUpdator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use HasFactory , NodeTrait ,SoftDeletes , HasCreatorAndUpdator;

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function parent():BelongsTo
    {
        return $this->belongsTo(File::class,'parent_id');
    }

    public function isOwnedBy($userId)
    {
        return $this->created_by == $userId;
    }

    public function  owner(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                return $attributes['created_by'] == Auth::id() ? 'me' : $this->user->name;
            }
        );
    }

    public function isRoot()
    {
        return $this->parent === null;
    }
    // public function isRoot()
    // {
    //     return $this->parent_id === null;
    // }

    protected static function boot()
    {
        parent::boot();
        static::creating(function($model){
            if(!$model->parent)
            {
                return;
            }

            $model->path = (!$model->parent->isRoot() ? $model->parent->path . '/' : '') . \Str::slug($model->name);
        });

    }

}
