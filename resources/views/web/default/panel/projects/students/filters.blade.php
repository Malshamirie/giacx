<form action="" method="get" class="px-16">
    <div class="row mt-24">
        <!-- البحث العام -->
        <div class="col-12 col-lg-3">
            <div class="form-group">
                <span class="has-translation bg-transparent">
                    <i class="fas fa-search text-gray-border" style="width: 24px; height: 24px;"></i>
                </span>
                <label class="form-group-label">{{ trans('panel.search') }}</label>
                <input type="text" name="search" class="form-control" 
                       value="{{ request()->get('search') }}" 
                       placeholder="{{ trans('panel.search_by_name_email_phone') }}">
            </div>
        </div>

        <!-- فلتر النوع (مشارك/مرشح) -->
        <div class="col-12 col-lg-3">
            <div class="form-group">
                <span class="has-translation bg-transparent">
                    <i class="fas fa-user-tag text-gray-border" style="width: 24px; height: 24px;"></i>
                </span>
                <label class="form-group-label">{{ trans('panel.type') }}</label>
                <select name="type" class="form-control select2" data-minimum-results-for-search="Infinity">
                    <option value="">{{ trans('public.all') }}</option>
                    <option value="participant" {{ request()->get('type') == 'participant' ? 'selected' : '' }}>
                        {{ trans('panel.participant') }}
                    </option>
                    <option value="candidate" {{ request()->get('type') == 'candidate' ? 'selected' : '' }}>
                        {{ trans('panel.candidate') }}
                    </option>
                </select>
            </div>
        </div>

        <!-- فلتر الحالة (مفعل/غير مفعل) -->
        <div class="col-12 col-lg-3">
            <div class="form-group">
                <span class="has-translation bg-transparent">
                    <i class="fas fa-toggle-on text-gray-border" style="width: 24px; height: 24px;"></i>
                </span>
                <label class="form-group-label">{{ trans('panel.status') }}</label>
                <select name="status" class="form-control select2" data-minimum-results-for-search="Infinity">
                    <option value="">{{ trans('public.all') }}</option>
                    <option value="active" {{ request()->get('status') == 'active' ? 'selected' : '' }}>
                        {{ trans('public.active') }}
                    </option>
                    <option value="inactive" {{ request()->get('status') == 'inactive' ? 'selected' : '' }}>
                        {{ trans('public.inactive') }}
                    </option>
                </select>
            </div>
        </div>

        <!-- فلتر التاريخ من -->
        <div class="col-12 col-lg-3">
            <div class="form-group">
                <span class="has-translation bg-transparent">
                    <i class="fas fa-calendar-alt text-gray-border" style="width: 24px; height: 24px;"></i>
                </span>
                <label class="form-group-label">{{ trans('public.from') }}</label>
                <input type="date" name="from" class="form-control" 
                       value="{{ request()->get('from') }}"
                       placeholder="{{ trans('public.from_date') }}">
            </div>
        </div>

        <!-- فلتر التاريخ إلى -->
        <div class="col-12 col-lg-3">
            <div class="form-group">
                <span class="has-translation bg-transparent">
                    <i class="fas fa-calendar-alt text-gray-border" style="width: 24px; height: 24px;"></i>
                </span>
                <label class="form-group-label">{{ trans('public.to') }}</label>
                <input type="date" name="to" class="form-control" 
                       value="{{ request()->get('to') }}"
                       placeholder="{{ trans('public.to_date') }}">
            </div>
        </div>

        <!-- فلتر الترتيب -->
        <div class="col-12 col-lg-3">
            <div class="form-group">
                <span class="has-translation bg-transparent">
                    <i class="fas fa-sort text-gray-border" style="width: 24px; height: 24px;"></i>
                </span>
                <label class="form-group-label">{{ trans('panel.sort_by') }}</label>
                <select name="sort" class="form-control select2">
                    <option value="">{{ trans('public.default') }}</option>
                    <option value="name_asc" {{ request()->get('sort') == 'name_asc' ? 'selected' : '' }}>
                        {{ trans('panel.name_ascending') }}
                    </option>
                    <option value="name_desc" {{ request()->get('sort') == 'name_desc' ? 'selected' : '' }}>
                        {{ trans('panel.name_descending') }}
                    </option>
                    <option value="email_asc" {{ request()->get('sort') == 'email_asc' ? 'selected' : '' }}>
                        {{ trans('panel.email_ascending') }}
                    </option>
                    <option value="email_desc" {{ request()->get('sort') == 'email_desc' ? 'selected' : '' }}>
                        {{ trans('panel.email_descending') }}
                    </option>
                    <option value="created_asc" {{ request()->get('sort') == 'created_asc' ? 'selected' : '' }}>
                        {{ trans('panel.created_date_ascending') }}
                    </option>
                    <option value="created_desc" {{ request()->get('sort') == 'created_desc' ? 'selected' : '' }}>
                        {{ trans('panel.created_date_descending') }}
                    </option>
                </select>
            </div>
        </div>

        <!-- أزرار التحكم -->
        <div class="col-12 col-lg-3 d-flex align-items-end">
            <div class="form-group w-100">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    <i class="fas fa-filter"></i>
                    {{ trans('panel.apply_filters') }}
                </button>
            </div>
        </div>

        <!-- زر إعادة تعيين الفلاتر -->
        <div class="col-12 col-lg-3 d-flex align-items-end">
            <div class="form-group w-100">
                <a href="{{ route('panel.projects.students.index', $project->id) }}" 
                   class="btn btn-outline-secondary btn-lg btn-block">
                    <i class="fas fa-undo"></i>
                    {{ trans('panel.reset_filters') }}
                </a>
            </div>
        </div>
    </div>
</form>
