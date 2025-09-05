


@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $pageTitle }}</h3>
                    </div>
                    <form action="{{ isset($category) ? getAdminPanelUrl() . '/quiz-categories/' . $category->id . '/update' : getAdminPanelUrl() . '/quiz-categories/store' }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('admin/main.title') }}</label>
                                        <input type="text" name="title" class="form-control" value="{{ isset($category) ? $category->title : old('title') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('admin/main.slug') }}</label>
                                        <input type="text" name="slug" class="form-control" value="{{ isset($category) ? $category->slug : old('slug') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('admin/main.icon') }}</label>
                                        <input type="text" name="icon" class="form-control" value="{{ isset($category) ? $category->icon : old('icon') }}" placeholder="fas fa-icon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('admin/main.order') }}</label>
                                        <input type="number" name="order" class="form-control" value="{{ isset($category) ? $category->order : old('order') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ trans('admin/main.status') }}</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ (isset($category) && $category->status == 'active') ? 'selected' : '' }}>{{ trans('admin/main.active') }}</option>
                                            <option value="inactive" {{ (isset($category) && $category->status == 'inactive') ? 'selected' : '' }}>{{ trans('admin/main.inactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('admin/main.save') }}</button>
                            <a href="{{ getAdminPanelUrl() }}/quiz-categories" class="btn btn-secondary">{{ trans('admin/main.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection