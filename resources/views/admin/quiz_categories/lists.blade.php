@extends('admin.layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ trans('admin/main.quiz_categories') }}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl() }}">{{trans('admin/main.dashboard')}}</a>
            </div>
            <div class="breadcrumb-item">{{ trans('admin/main.quiz_categories') }}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card">
                    
                    <div class="card-header justify-content-between">
                        
                        <div>
                           <h5 class="font-14 mb-0">{{ $pageTitle }}</h5>
                           <p class="font-12 mt-4 mb-0 text-gray-500">{{ trans('admin/main.manage_quiz_categories') }}</p>
                       </div>
                       
                       <div class="d-flex align-items-center gap-12">

                           @can('admin_quiz_categories_create')
                               <a href="{{ getAdminPanelUrl() }}/quiz-categories/create" class="btn btn-primary">
                                   <x-iconsax-lin-add class="icons text-white" width="18px" height="18px"/>
                                   <span class="ml-4 font-12">{{ trans('admin/main.new_quiz_category') }}</span>
                               </a>
                           @endcan

                       </div>
                       
                  </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table font-14">
                                <tr>
                                    <th class="text-left">{{ trans('admin/main.title') }}</th>
                                    <th class="text-center">{{ trans('admin/main.icon') }}</th>
                                    <th class="text-center">{{ trans('admin/main.order') }}</th>
                                    <th class="text-center">{{ trans('admin/main.status') }}</th>
                                    <th>{{ trans('admin/main.actions') }}</th>
                                </tr>

                                @foreach($categories as $category)
                                    <tr>
                                        <td>
                                            <span>{{ $category->title }}</span>
                                            @if($category->subCategories->count() > 0)
                                                <small class="d-block text-left text-gray-500">{{ $category->subCategories->count() }} {{ trans('admin/main.sub_categories') }}</small>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($category->icon)
                                                <i class="{{ $category->icon }}"></i>
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </td>

                                        <td class="text-center">{{ $category->order ?? '-' }}</td>

                                        <td class="text-center">
                                            @if($category->status === 'active')
                                            <span class="badge-status text-success bg-success-30">{{ trans('admin/main.active') }}</span>
                                            @else
                                            <span class="badge-status text-danger bg-danger-30">{{ trans('admin/main.inactive') }}</span>
                                            @endif
                                        </td>

                                        <td>
                                        <div class="btn-group dropdown table-actions position-relative">
                                                <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown">
                                                    <x-iconsax-lin-more class="icons text-gray-500" width="20px" height="20px"/>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-right">
                                                    @can('admin_quiz_categories_edit')
                                                        <a href="{{ getAdminPanelUrl() }}/quiz-categories/{{ $category->id }}/edit" class="dropdown-item d-flex align-items-center mb-3 py-3 px-0 gap-4">
                                                        <x-iconsax-lin-edit-2 class="icons text-gray-500 mr-2" width="18px" height="18px"/>
                                                            <span class="text-gray-500 font-14">{{ trans('admin/main.edit') }}</span>
                                                        </a>
                                                    @endcan

                                                    @can('admin_quiz_categories_delete')
                                                        @include('admin.includes.delete_button',[
                                                       'url' => getAdminPanelUrl().'/quiz-categories/'.$category->id.'/delete',
                                                       'btnClass' => 'dropdown-item text-danger mb-0 py-3 px-0 font-14',
                                                       'btnText' => trans("admin/main.delete"),
                                                       'btnIcon' => 'trash',
                                                       'iconType' => 'lin',
                                                       'iconClass' => 'text-danger mr-2',
                                                    ])
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    @foreach($category->subCategories as $subCategory)
                                        <tr>
                                            <td style="padding-left: 30px;">
                                                <span>{{ $subCategory->title }}</span>
                                            </td>
                                            <td class="text-center">
                                                @if($subCategory->icon)
                                                    <i class="{{ $subCategory->icon }}"></i>
                                                @else
                                                    <span class="text-gray-500">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $subCategory->order ?? '-' }}</td>
                                            <td class="text-center">
                                                @if($subCategory->status === 'active')
                                                <span class="badge-status text-success bg-success-30">{{ trans('admin/main.active') }}</span>
                                                @else
                                                <span class="badge-status text-danger bg-danger-30">{{ trans('admin/main.inactive') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                            <div class="btn-group dropdown table-actions position-relative">
                                                    <button type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown">
                                                        <x-iconsax-lin-more class="icons text-gray-500" width="20px" height="20px"/>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @can('admin_quiz_categories_edit')
                                                            <a href="{{ getAdminPanelUrl() }}/quiz-categories/{{ $subCategory->id }}/edit" class="dropdown-item d-flex align-items-center mb-3 py-3 px-0 gap-4">
                                                            <x-iconsax-lin-edit-2 class="icons text-gray-500 mr-2" width="18px" height="18px"/>
                                                                <span class="text-gray-500 font-14">{{ trans('admin/main.edit') }}</span>
                                                            </a>
                                                        @endcan

                                                        @can('admin_quiz_categories_delete')
                                                            @include('admin.includes.delete_button',[
                                                           'url' => getAdminPanelUrl().'/quiz-categories/'.$subCategory->id.'/delete',
                                                           'btnClass' => 'dropdown-item text-danger mb-0 py-3 px-0 font-14',
                                                           'btnText' => trans("admin/main.delete"),
                                                           'btnIcon' => 'trash',
                                                           'iconType' => 'lin',
                                                           'iconClass' => 'text-danger mr-2',
                                                        ])
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach

                            </table>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


