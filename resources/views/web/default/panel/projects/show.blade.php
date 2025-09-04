@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('styles_top')
    <style>
        .project-overview-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        .project-overview-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            border: none;
            padding: 20px;
        }
        
        .project-overview-card .card-body {
            padding: 25px;
        }
        
        .stats-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        
        .stats-card:hover {
            transform: translateY(-2px);
        }
        
        .stats-card .card-body {
            padding: 20px;
            text-align: center;
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .nav-pills .nav-link {
            border-radius: 25px;
            margin-right: 10px;
            margin-bottom: 10px;
            padding: 10px 20px;
            border: none;
            font-weight: 500;
        }
        
        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .nav-pills .nav-link:not(.active) {
            background: #f8f9fa;
            color: #6c757d;
        }
        
        .action-buttons .btn {
            border-radius: 25px;
            padding: 10px 20px;
            margin-left: 10px;
        }
        
        .table-custom th {
            background: #f8f9fa;
            border: none;
            padding: 15px;
            font-weight: 600;
            color: #495057;
        }
        
        .table-custom td {
            padding: 15px;
            border: none;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }
        
        .status-badge {
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-completed {
            background: #cce5ff;
            color: #004085;
        }
        
        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }
        
        .course-item {
            background: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            border-left: 4px solid #667eea;
        }
        
        .course-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }
        
        .progress-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: conic-gradient(#667eea 0deg, #667eea 87deg, #e9ecef 87deg, #e9ecef 360deg);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .progress-circle::before {
            content: '';
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 50%;
        }
        
        .progress-text {
            position: absolute;
            font-size: 0.8rem;
            font-weight: bold;
            color: #667eea;
        }
        
        /* Organizational Chart Styles */
        .org-chart-container {
            position: relative;
            overflow: hidden;
        }
        
        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
            padding: 20px;
        }
        
        .org-level {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 60px;
            position: relative;
        }
        
        .ceo-level {
            margin-bottom: 40px;
        }
        
        .ceo-level::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: #ddd;
        }
        
        .department-level {
            position: relative;
        }
        
        .department-level::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            height: 2px;
            background: #ddd;
        }
        
        .org-node {
            position: relative;
        }
        
        .org-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 15px;
            min-width: 200px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .org-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .ceo-card {
            border-color: #4CAF50;
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
        }
        
        .assistant-card {
            border-color: #FF9800;
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
            color: white;
        }
        
        .hr-card {
            border-color: #FFC107;
            background: linear-gradient(135deg, #FFC107 0%, #FFA000 100%);
            color: white;
        }
        
        .it-card {
            border-color: #2196F3;
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
        }
        
        .sales-card {
            border-color: #FF5722;
            background: linear-gradient(135deg, #FF5722 0%, #E64A19 100%);
            color: white;
        }
        
        .org-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
        }
        
        .org-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.3);
        }
        
        .org-avatar-sm {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.3);
        }
        
        .org-info {
            flex: 1;
        }
        
        .org-name {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.2;
        }
        
        .org-name-sm {
            margin: 0;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.2;
        }
        
        .org-title {
            font-size: 12px;
            opacity: 0.9;
            display: block;
            margin-top: 2px;
        }
        
        .org-badge {
            background: rgba(255,255,255,0.2);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .org-badge-sm {
            background: rgba(255,255,255,0.2);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }
        
        .org-actions {
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: background 0.3s ease;
        }
        
        .org-actions:hover {
            background: rgba(255,255,255,0.1);
        }
        
        .org-card-footer {
            text-align: center;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        
        .collapse-btn {
            cursor: pointer;
            padding: 5px;
            border-radius: 50%;
            transition: background 0.3s ease;
        }
        
        .collapse-btn:hover {
            background: rgba(255,255,255,0.1);
        }
        
        .org-sub-members {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        
        .org-sub-member {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }
        
        .org-sub-info {
            flex: 1;
        }
        
        .chart-controls {
            display: flex;
            gap: 5px;
        }
        
        .chart-controls .btn {
            width: 35px;
            height: 35px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Connection Lines */
        .assistant-node::before {
            content: '';
            position: absolute;
            top: 50%;
            right: 100%;
            width: 30px;
            height: 2px;
            background: #ddd;
            transform: translateY(-50%);
        }
        
        .department-node::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 50%;
            width: 2px;
            height: 20px;
            background: #ddd;
            transform: translateX(-50%);
        }
    </style>
@endpush

@section('content')
<section>
    <h2 class="section-title mb-20">{{ $project->name }}</h2>
</section>

<section>
    <!-- Project Overview Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-chart-line mr-2"></i>{{ trans('panel.project_report') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.improvement_rate_report') }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.project_card') }}
                        </a>
                    </div>
                    <button class="btn btn-primary btn-block">{{ trans('panel.export') }}</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header" style="background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);">
                    <h5 class="mb-0"><i class="fas fa-tools mr-2"></i>{{ trans('panel.project_tools') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="/panel/projects/{{ $project->id }}/edit" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.edit_project') }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.supervision_team') }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <a href="#" class="text-decoration-none d-flex align-items-center">
                            <i class="fas fa-arrow-left mr-2 text-primary"></i>
                            {{ trans('panel.add_note') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header" style="background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);">
                    <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i>{{ trans('panel.project_info') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ trans('panel.contract_number') }}:</strong>
                        <span class="text-primary">#{{ $project->id }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.status') }}:</strong>
                        <span class="status-badge status-{{ $project->status }}">
                            {{ trans('panel.status_' . $project->status) }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.landing_page_link') }}:</strong>
                        <a href="#" class="text-primary">{{ $project->slug }}</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card project-overview-card">
                <div class="card-header" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);">
                    <h5 class="mb-0"><i class="fas fa-database mr-2"></i>{{ trans('panel.project_data') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ trans('panel.project_type') }}:</strong>
                        <span class="text-primary">{{ trans('panel.field_' . $project->field) }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.start_date') }}:</strong>
                        <span class="text-primary">{{ date('d/m/Y', strtotime($project->start_date)) }}</span>
                    </div>
                    <div class="mb-3">
                        <strong>{{ trans('panel.end_date') }}:</strong>
                        <span class="text-primary">{{ date('d/m/Y', strtotime($project->end_date)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-primary">50%</div>
                    <div class="stats-label">{{ trans('panel.general_improvement_rate') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-success">100</div>
                    <div class="stats-label">{{ trans('panel.pre_test_score') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-info">24/30</div>
                    <div class="stats-label">{{ trans('panel.certificate_request_pass_rate') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-warning">34/50</div>
                    <div class="stats-label">{{ trans('panel.post_test_score') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-danger">{{ $project->getStudentsCountAttribute() }}</div>
                    <div class="stats-label">{{ trans('panel.total_participants') }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-number text-purple">{{ $project->getWebinarsCountAttribute() }}</div>
                    <div class="stats-label">{{ trans('panel.total_courses') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation and Actions -->
    <div class="row mb-4">
        <div class="col-md-8">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#project-logbook" data-toggle="tab">
                        <i class="fas fa-book mr-2"></i>{{ trans('panel.webinars') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#candidates" data-toggle="tab">
                        <i class="fas fa-users mr-2"></i>{{ trans('panel.candidates') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#organizational-chart" data-toggle="tab">
                        <i class="fas fa-sitemap mr-2"></i>{{ trans('panel.organizational_chart') }}
                    </a>
                </li>
            </ul>
        </div>
        
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Project Logbook Tab -->
        @include('web.default.panel.projects.show_includes.courses')

        <!-- Candidates Tab -->
        @include('web.default.panel.projects.show_includes.candidates')

        <!-- Organizational Chart Tab -->
        @include('web.default.panel.projects.show_includes.chart')
    </div>
</section>
@endsection

@push('scripts_bottom')
<script>
$(document).ready(function() {
    // Tab functionality
    $('.nav-pills a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    // Organizational Chart Controls
    let currentZoom = 1;
    const zoomStep = 0.1;
    const minZoom = 0.5;
    const maxZoom = 2;
    
    $('#zoomIn').on('click', function() {
        if (currentZoom < maxZoom) {
            currentZoom += zoomStep;
            updateChartZoom();
        }
    });
    
    $('#zoomOut').on('click', function() {
        if (currentZoom > minZoom) {
            currentZoom -= zoomStep;
            updateChartZoom();
        }
    });
    
    $('#fitChart').on('click', function() {
        currentZoom = 1;
        updateChartZoom();
        centerChart();
    });
    
    $('#expandChart').on('click', function() {
        $('.org-chart-container').toggleClass('fullscreen');
    });
    
    $('#resetChart').on('click', function() {
        currentZoom = 1;
        updateChartZoom();
        centerChart();
        $('.org-chart-container').removeClass('fullscreen');
    });
    
    function updateChartZoom() {
        $('#orgChart').css('transform', `scale(${currentZoom})`);
    }
    
    function centerChart() {
        const container = $('.org-chart-container');
        const chart = $('#orgChart');
        const containerWidth = container.width();
        const containerHeight = container.height();
        const chartWidth = chart.width() * currentZoom;
        const chartHeight = chart.height() * currentZoom;
        
        const left = (containerWidth - chartWidth) / 2;
        const top = (containerHeight - chartHeight) / 2;
        
        chart.css({
            'transform-origin': 'center center',
            'position': 'absolute',
            'left': left + 'px',
            'top': top + 'px'
        });
    }
    
    // Collapse/Expand functionality
    $('.collapse-btn').on('click', function() {
        const card = $(this).closest('.org-card');
        const level = card.closest('.org-level');
        
        if (level.hasClass('collapsed')) {
            level.removeClass('collapsed');
            $(this).removeClass('fa-plus').addClass('fa-minus');
        } else {
            level.addClass('collapsed');
            $(this).removeClass('fa-minus').addClass('fa-plus');
        }
    });
    
    // Card hover effects
    $('.org-card').on('mouseenter', function() {
        $(this).addClass('hovered');
    }).on('mouseleave', function() {
        $(this).removeClass('hovered');
    });
    
    // Actions menu
    $('.org-actions').on('click', function(e) {
        e.stopPropagation();
        // Here you can add dropdown menu functionality
        console.log('Actions clicked for:', $(this).closest('.org-card').find('.org-name').text());
    });
});
</script>
@include('web.default.panel.projects.candidates.js')
@endpush 