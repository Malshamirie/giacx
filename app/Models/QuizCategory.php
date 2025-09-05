<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class QuizCategory extends Model implements TranslatableContract
{
    use Translatable;
    use Sluggable;

    protected $table = 'quiz_categories';
    protected $guarded = ['id'];

    static $cacheKey = 'quiz_categories';

    public $translatedAttributes = ['title'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function makeSlug($title)
    {
        return SlugService::createSlug(self::class, 'slug', $title);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\QuizCategory', 'parent_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany($this, 'parent_id', 'id')->orderBy('order', 'asc');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Models\Quiz', 'category_id', 'id');
    }

    public function getUrl()
    {
        $url = '/quiz-categories/';

        if (!empty($this->category)) {
            $url .= $this->category->slug . '/';
        }

        $url .= $this->slug;

        return $url;
    }

    static function getCategories()
    {
        $categories = cache()->remember(self::$cacheKey, 24 * 60 * 60, function () {
            return self::where('parent_id', null)
                ->where('status', 'active')
                ->with([
                    'subCategories' => function ($query) {
                        $query->where('status', 'active')->orderBy('order', 'asc');
                    },
                ])
                ->orderBy('order', 'asc')
                ->get();
        });

        return $categories;
    }

    public function getCategoryQuizzes()
    {
        $quizzes = collect([]);
        $subCategories = $this->subCategories;

        foreach ($subCategories as $category) {
            $quizzes = $quizzes->merge($category->quizzes);
        }

        return $quizzes;
    }
}