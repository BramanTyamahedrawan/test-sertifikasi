<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
    ];

    public function letter()
    {
        return $this->hasMany(LetterModel::class, 'category_id', 'id');
    }
}
