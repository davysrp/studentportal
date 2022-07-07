<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "type",
        "name",
        "slug",
        "code",
        "is_required"];

    public function attributeSets()
    {
        return $this->belongsToMany(AttributeSet::class, 'attribute_set_attribute');
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $model->slug = Str::slug($model->name);
        });
        static::updating(function($model)
        {
            $model->slug = Str::slug($model->name);
        });

        static::deleting(function ($model)
        {
//            $model->attachments()->delete();
        });
    }
}
