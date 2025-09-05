<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuizCategory;
use App\Models\Translation\QuizCategoryTranslation;
use Illuminate\Http\Request;

class QuizCategoryController extends Controller
{
    public function index()
    {
        removeContentLocale();

        $this->authorize('admin_quiz_categories_list');

        $categories = QuizCategory::where('parent_id', null)
            ->with([
                'subCategories'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => trans('admin/pages/quiz_categories.categories_list_page_title'),
            'categories' => $categories
        ];

        return view('admin.quiz_categories.lists', $data);
    }

    public function create()
    {
        $this->authorize('admin_quiz_categories_create');

        $data = [
            'pageTitle' => trans('admin/main.quiz_category_new_page_title'),
            'locale' => app()->getLocale(),
        ];

        return view('admin.quiz_categories.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('admin_quiz_categories_create');

        $this->validate($request, [
            'title' => 'required|min:3|max:128',
            'slug' => 'nullable|max:255|unique:quiz_categories,slug',
        ]);

        $data = $request->all();

        if (!empty($data['order'])) {
            $order = $data['order'];
        } else {
            $order = QuizCategory::whereNull('parent_id')->count() + 1;
        }

        $category = QuizCategory::create([
            'slug' => $data['slug'] ?? QuizCategory::makeSlug($data['title']),
            'icon' => !empty($data['icon']) ? $data['icon'] : null,
            'order' => $order,
            'status' => $data['status'] ?? 'active',
        ]);

        QuizCategoryTranslation::updateOrCreate([
            'quiz_category_id' => $category->id,
            'locale' => app()->getLocale(),
            
        ], [
            'title' => $data['title'],
        ]);

        $hasSubCategories = (!empty($request->get('has_sub')) and $request->get('has_sub') == 'on');
        $this->setSubCategory($category, $request->get('sub_categories'), $hasSubCategories, $data['locale']);

        cache()->forget(QuizCategory::$cacheKey);

        removeContentLocale();

        
        $data = [
            'pageTitle' => trans('admin/pages/quiz_categories.edit_page_title'),
            'category' => $category,
            'locale' => app()->getLocale(),
        ];
        return view('admin.quiz_categories.lists', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_quiz_categories_edit');

        $category = QuizCategory::findOrFail($id);
        $subCategories = QuizCategory::where('parent_id', $category->id)
            ->orderBy('order', 'asc')
            ->get();

        $locale = $request->get('locale', app()->getLocale());
        storeContentLocale($locale, $category->getTable(), $category->id);

        $data = [
            'pageTitle' => trans('admin/pages/quiz_categories.edit_page_title'),
            'category' => $category,
            'subCategories' => $subCategories,
            'locale' => $locale,
        ];

        return view('admin.quiz_categories.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_quiz_categories_edit');

        $category = QuizCategory::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|min:3|max:255',
            'slug' => 'nullable|max:255|unique:quiz_categories,slug,' . $category->id,
        ]);

        $data = $request->all();

        $category->update([
            'title' => $data['title'],
            'icon' => !empty($data['icon']) ? $data['icon'] : null,
            'slug' => $data['slug'] ?? QuizCategory::makeSlug($data['title']),
            'order' => $data['order'] ?? $category->order,
            'status' => $data['status'] ?? $category->status,
        ]);

        QuizCategoryTranslation::updateOrCreate([
            'quiz_category_id' => $category->id,
            'locale' => app()->getLocale(),
        ], [
            'title' => $data['title'],
        ]);

        $hasSubCategories = (!empty($request->get('has_sub')) and $request->get('has_sub') == 'on');
        $this->setSubCategory($category, $request->get('sub_categories'), $hasSubCategories, app()->getLocale());

        cache()->forget(QuizCategory::$cacheKey);

        removeContentLocale();

        return redirect(getAdminPanelUrl() . '/quiz-categories');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_quiz_categories_delete');

        $category = QuizCategory::where('id', $id)->first();
        $parent = !empty($category->parent_id) ? $category->parent_id : null;

        if (!empty($category)) {
            QuizCategory::where('parent_id', $category->id)
                ->delete();

            $category->delete();
        }

        cache()->forget(QuizCategory::$cacheKey);

        $toastData = [
            'title' => trans('public.request_success'),
            'msg' => !empty($parent) ? trans('update.sub_category_successfully_deleted') : trans('update.category_successfully_deleted'),
            'status' => 'success'
        ];

        return !empty($parent) ? back()->with(['toast' => $toastData]) : redirect(getAdminPanelUrl() . '/quiz-categories')->with(['toast' => $toastData]);
    }

    public function setSubCategory(QuizCategory $category, $subCategories, $hasSubCategories, $locale)
    {
        $order = 1;
        $oldIds = [];

        if ($hasSubCategories and !empty($subCategories) and count($subCategories)) {
            foreach ($subCategories as $key => $subCategory) {
                $check = QuizCategory::where('id', $key)->first();

                if (is_numeric($key)) {
                    $oldIds[] = $key;
                }

                if (!empty($subCategory['title'])) {
                    $checkSlug = 0;
                    if (!empty($subCategory['slug'])) {
                        $checkSlug = QuizCategory::query()->where('slug', $subCategory['slug'])->count();
                    }

                    $slug = (!empty($subCategory['slug']) and ($checkSlug == 0 or ($checkSlug == 1 and $check->slug == $subCategory['slug']))) ? $subCategory['slug'] : QuizCategory::makeSlug($subCategory['title']);

                    if (!empty($check)) {
                        $check->update([
                            'order' => $order,
                            'icon' => $subCategory['icon'] ?? null,
                            'slug' => $slug,
                            'status' => $subCategory['status'] ?? $check->status,
                        ]);

                        QuizCategoryTranslation::updateOrCreate([
                            'quiz_category_id' => $check->id,
                            'locale' => mb_strtolower($locale),
                        ], [
                            'title' => $subCategory['title'],
                        ]);
                    } else {
                        $new = QuizCategory::create([
                            'parent_id' => $category->id,
                            'slug' => $slug,
                            'icon' => $subCategory['icon'] ?? null,
                            'order' => $order,
                            'status' => $subCategory['status'] ?? 'active',
                        ]);

                        QuizCategoryTranslation::updateOrCreate([
                            'quiz_category_id' => $new->id,
                            'locale' => mb_strtolower($locale),
                        ], [
                            'title' => $subCategory['title'],
                        ]);

                        $oldIds[] = $new->id;
                    }

                    $order += 1;
                }
            }
        }

        QuizCategory::where('parent_id', $category->id)
            ->whereNotIn('id', $oldIds)
            ->delete();

        return true;
    }
}
