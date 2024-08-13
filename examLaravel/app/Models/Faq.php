<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FaqCategory;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'category'];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(FaqCategory::class);
    }
    
}
