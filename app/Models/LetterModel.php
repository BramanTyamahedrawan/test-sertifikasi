<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryModel;

class LetterModel extends Model
{
    use HasFactory;

    protected $table = 'letter';
    protected $primaryKey = 'id';
    protected $fillable = [
        'letter_number',
        'category_id',
        'name',
        'file'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id');
    }
}
