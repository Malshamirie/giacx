<?php

namespace App\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class QuizCategoryTranslation extends Model
{
    protected $table = 'quiz_category_translations';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
}
