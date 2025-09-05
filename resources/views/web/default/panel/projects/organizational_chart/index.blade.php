@extends('web.default.panel.layouts.panel_layout')

@section('pageTitle', trans('panel.organizational_chart'))

@section('content')
    <!-- Page Header -->
    <section>
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="section-title mx-0">
                            <h2 class="section-title font-24 text-dark-blue font-weight-bold">
                                <i data-feather="users" width="24" height="24" class="mr-1"></i>
                                {{ trans('panel.organizational_chart') }} - {{ $project->name }}
                            </h2>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-primary mr-2" id="addManagerBtn">
                            <i data-feather="user-plus" width="18" height="18" class="mr-1"></i>
                            {{ trans('panel.add_manager') }}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="exportChartBtn">
                            <i data-feather="download" width="18" height="18" class="mr-1"></i>
                            {{ trans('panel.export_chart') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chart Controls -->
    <div class="panel-section-card py-20 px-25 mt-20">
        <div class="d-flex justify-content-between align-items-center">
            <div class="chart-info">
                <span class="badge badge-primary mr-2" id="managersCount">0 {{ trans('panel.managers') }}</span>
                <span class="badge badge-success mr-2" id="connectionsCount">0 {{ trans('panel.connections') }}</span>
            </div>
            <div class="chart-controls">
                <div class="btn-group" role="group">
                    <button class="btn btn-outline-secondary btn-sm" id="expandChart"
                        title="{{ trans('panel.expand_chart') }}">
                        <i data-feather="maximize-2" width="16" height="16"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="fitChart" title="{{ trans('panel.fit_chart') }}">
                        <i data-feather="minimize-2" width="16" height="16"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="zoomIn" title="{{ trans('panel.zoom_in') }}">
                        <i data-feather="plus" width="16" height="16"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="zoomOut" title="{{ trans('panel.zoom_out') }}">
                        <i data-feather="minus" width="16" height="16"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="resetChart"
                        title="{{ trans('panel.reset_chart') }}">
                        <i data-feather="rotate-ccw" width="16" height="16"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Chart Container -->
    <div class="panel-section-card py-20 px-25 mt-20">
        <div class="org-chart-container" id="orgChartContainer">
            <div class="org-chart" id="orgChart">
                <!-- Chart will be dynamically loaded here -->
            </div>
            <div class="chart-loading" id="chartLoading">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">{{ trans('panel.loading') }}...</span>
                </div>
                <p class="mt-2">{{ trans('panel.loading_chart') }}...</p>
            </div>
        </div>
    </div>

    <!-- Add Manager Modal -->
    <div class="modal fade" id="addManagerModal" tabindex="-1" role="dialog" aria-labelledby="addManagerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addManagerModalLabel">
                        <i data-feather="user-plus" width="20" height="20" class="mr-2"></i>
                        {{ trans('panel.add_manager') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addManagerForm">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="input-label">
                                        <i data-feather="user" width="16" height="16" class="mr-1"></i>
                                        {{ trans('panel.select_manager') }}
                                    </label>
                                    <select class="form-control" id="manager_id" name="manager_id" required>
                                        <option value="">{{ trans('panel.select_manager') }}</option>
                                    </select>
                                    <div class="form-text">{{ trans('panel.select_manager_help') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="input-label">
                                        <i data-feather="briefcase" width="16" height="16" class="mr-1"></i>
                                        {{ trans('panel.role_type') }}
                                    </label>
                                    <select class="form-control" id="role_type" name="role_type" required>
                                        <option value="">{{ trans('panel.select_role') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="input-label">
                                <i data-feather="users" width="16" height="16" class="mr-1"></i>
                                {{ trans('panel.reports_to') }}
                            </label>
                            <select class="form-control" id="parent_id" name="parent_id">
                                <option value="">{{ trans('panel.no_parent') }}</option>
                            </select>
                            <div class="form-text">{{ trans('panel.reports_to_help') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="input-label">
                                        <i data-feather="map-pin" width="16" height="16" class="mr-1"></i>
                                        {{ trans('panel.position_x') }}
                                    </label>
                                    <input type="number" class="form-control" id="position_x" name="position_x"
                                        value="0" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="input-label">
                                        <i data-feather="map-pin" width="16" height="16" class="mr-1"></i>
                                        {{ trans('panel.position_y') }}
                                    </label>
                                    <input type="number" class="form-control" id="position_y" name="position_y"
                                        value="0" min="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i data-feather="x" width="16" height="16" class="mr-1"></i>
                            {{ trans('public.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="plus" width="16" height="16" class="mr-1"></i>
                            {{ trans('panel.add') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Manager Actions Modal -->
    <div class="modal fade" id="managerActionsModal" tabindex="-1" role="dialog"
        aria-labelledby="managerActionsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="managerActionsModalLabel">
                        <i data-feather="settings" width="20" height="20" class="mr-2"></i>
                        {{ trans('panel.manager_actions') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group list-group-flush">
                        <button type="button" class="list-group-item list-group-item-action" id="addSubordinateBtn">
                            <i data-feather="user-plus" width="16" height="16" class="mr-2 text-primary"></i>
                            {{ trans('panel.add_subordinate') }}
                        </button>
                        <button type="button" class="list-group-item list-group-item-action" id="connectManagerBtn">
                            <i data-feather="link" width="16" height="16" class="mr-2 text-info"></i>
                            {{ trans('panel.connect_manager') }}
                        </button>
                        <button type="button" class="list-group-item list-group-item-action" id="editRoleBtn">
                            <i data-feather="edit" width="16" height="16" class="mr-2 text-warning"></i>
                            {{ trans('panel.edit_role') }}
                        </button>
                        <button type="button" class="list-group-item list-group-item-action" id="moveManagerBtn">
                            <i data-feather="move" width="16" height="16" class="mr-2 text-secondary"></i>
                            {{ trans('panel.move_manager') }}
                        </button>
                        <button type="button" class="list-group-item list-group-item-action text-danger"
                            id="deleteManagerBtn">
                            <i data-feather="trash-2" width="16" height="16" class="mr-2"></i>
                            {{ trans('panel.remove_manager') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Connect Managers Modal -->
    <div class="modal fade" id="connectManagersModal" tabindex="-1" role="dialog"
        aria-labelledby="connectManagersModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="connectManagersModalLabel">
                        <i data-feather="link" width="20" height="20" class="mr-2"></i>
                        {{ trans('panel.connect_managers') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="connectManagersForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="input-label">
                                <i data-feather="user" width="16" height="16" class="mr-1"></i>
                                {{ trans('panel.connect_to') }}
                            </label>
                            <select class="form-control" id="to_manager_id" name="to_manager_id" required>
                                <option value="">{{ trans('panel.select_manager') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="input-label">
                                <i data-feather="link" width="16" height="16" class="mr-1"></i>
                                {{ trans('panel.connection_type') }}
                            </label>
                            <select class="form-control" id="connection_type" name="connection_type" required>
                                <option value="">{{ trans('panel.select_connection_type') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i data-feather="x" width="16" height="16" class="mr-1"></i>
                            {{ trans('public.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="link" width="16" height="16" class="mr-1"></i>
                            {{ trans('panel.connect') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-labelledby="editRoleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">
                        <i data-feather="edit" width="20" height="20" class="mr-2"></i>
                        {{ trans('panel.edit_role') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editRoleForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="input-label">
                                <i data-feather="briefcase" width="16" height="16" class="mr-1"></i>
                                {{ trans('panel.role_type') }}
                            </label>
                            <select class="form-control" id="edit_role_type" name="role_type" required>
                                <option value="">{{ trans('panel.select_role') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i data-feather="x" width="16" height="16" class="mr-1"></i>
                            {{ trans('public.cancel') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i data-feather="save" width="16" height="16" class="mr-1"></i>
                            {{ trans('panel.update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <style>
        /* Chart Container Styles */
        .org-chart-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            min-height: 600px;
            padding: 20px;
            border-radius: 10px;
            position: relative;
            overflow: auto;
        }

        .org-chart-container.fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background: white;
            padding: 20px;
        }

        .chart-loading {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 10;
        }

        /* Chart Styles */
        .org-chart {
            position: relative;
            min-height: 500px;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .org-node {
            position: absolute;
            text-align: center;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .org-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            min-width: 220px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
        }

        .org-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border-color: #007bff;
        }

        .org-card.ceo-card {
            border-color: #dc3545;
            background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);
        }

        .org-card.hr-card {
            border-color: #28a745;
            background: linear-gradient(135deg, #f0fff4 0%, #ffffff 100%);
        }

        .org-card.it-card {
            border-color: #17a2b8;
            background: linear-gradient(135deg, #f0f9ff 0%, #ffffff 100%);
        }

        .org-card.sales-card {
            border-color: #ffc107;
            background: linear-gradient(135deg, #fffbf0 0%, #ffffff 100%);
        }

        .org-card.assistant-card {
            border-color: #6c757d;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }

        .org-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin: 0 auto 15px;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .org-name {
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
            font-size: 1.1rem;
        }

        .org-title {
            font-size: 0.9rem;
            color: #6c757d;
            display: block;
            margin-bottom: 15px;
            padding: 5px 10px;
            background: #5a8fc30a;
            border-radius: 20px;
        }

        /*
        .org-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 20;
        } */

        /* Dropdown Styles */
        .table-actions {
            position: relative;
        }

        .table-actions .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
            display: none;
            min-width: 200px;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .175);
        }

        .table-actions .dropdown-menu.show {
            display: block;
        }

        .table-actions .dropdown-toggle::after {
            display: none;
        }



        .webinar-actions {
            display: block;
            padding: 8px 16px;
            color: #333;
            text-decoration: none;
            transition: all 0.2s;
        }

        .webinar-actions:hover {
            background: #f8f9fa;
            color: #333;
            text-decoration: none;
        }

        .webinar-actions.text-danger:hover {
            background: #f8d7da;
            color: #721c24;
        }

        /* Connection Lines */
        .connection-line {
            position: absolute;
            background: #007bff;
            z-index: 1;
        }

        .connection-line.horizontal {
            height: 2px;
        }

        .connection-line.vertical {
            width: 2px;
        }

        .connection-line::before {
            content: '';
            position: absolute;
            bottom: -4px;
            left: -3px;
            width: 8px;
            height: 8px;
            background: #007bff;
            border-radius: 50%;
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            let chartData = null;
            let availableManagers = [];
            let roleTypes = {};
            let connectionTypes = {};
            let currentZoom = 1;
            let selectedManagerId = null;
            let selectedChartId = null;

            // Initialize
            initializeChart();

            // Event Handlers
            $('#addManagerBtn').on('click', function() {
                loadAvailableManagers();
                loadExistingManagers();
                loadRoleTypes();
                $('#addManagerModal').modal('show');
            });

            $('#addManagerForm').on('submit', function(e) {
                e.preventDefault();
                addManager();
            });

            $('#addSubordinateBtn').on('click', function() {
                $('#managerActionsModal').modal('hide');
                loadAvailableManagers();
                loadExistingManagers();
                loadRoleTypes();
                $('#parent_id').val(selectedChartId);
                $('#addManagerModal').modal('show');
            });

            $('#connectManagerBtn').on('click', function() {
                $('#managerActionsModal').modal('hide');
                loadConnectionManagers();
                loadConnectionTypes();
                $('#connectManagersModal').modal('show');
            });

            $('#connectManagersForm').on('submit', function(e) {
                e.preventDefault();
                connectManagers();
            });

            $('#editRoleBtn').on('click', function() {
                $('#managerActionsModal').modal('hide');
                loadRoleTypes();
                // Get current role type from the selected manager
                const currentRoleType = $(`.manager-node[data-manager-id="${selectedManagerId}"]`).find(
                    '.org-title').data('role-type');
                $('#edit_role_type').val(currentRoleType);
                $('#editRoleModal').modal('show');
            });

            $('#editRoleForm').on('submit', function(e) {
                e.preventDefault();
                editRole();
            });

            // Chart Controls
            $('#expandChart').on('click', function() {
                $('.org-chart-container').toggleClass('fullscreen');
                setTimeout(centerChart, 100);
            });

            $('#resetChart').on('click', function() {
                currentZoom = 1;
                updateChartZoom();
                centerChart();
                $('.org-chart-container').removeClass('fullscreen');
            });

            $('#zoomIn').on('click', function() {
                currentZoom = Math.min(currentZoom + 0.1, 2);
                updateChartZoom();
            });

            $('#zoomOut').on('click', function() {
                currentZoom = Math.max(currentZoom - 0.1, 0.5);
                updateChartZoom();
            });

            $('#fitChart').on('click', function() {
                fitChartToContainer();
            });

            // Custom dropdown toggle for manager actions
            $(document).on('click', '.dropdown-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const $dropdown = $(this).next('.dropdown-menu');
                const $allDropdowns = $('.dropdown-menu');

                // Close all other dropdowns
                $allDropdowns.removeClass('show');

                // Toggle current dropdown
                $dropdown.toggleClass('show');

                // Store selected manager data
                selectedManagerId = $(this).closest('.manager-node').data('manager-id');
                selectedChartId = $(this).closest('.manager-node').data('chart-id');
            });

            // Handle dropdown menu clicks
            $(document).on('click', '.manager-dropdown-item', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const action = $(this).data('action');

                // Close dropdown
                $('.dropdown-menu').removeClass('show');

                switch (action) {
                    case 'add-subordinate':
                        loadAvailableManagers();
                        loadExistingManagers();
                        loadRoleTypes();
                        $('#parent_id').val(selectedChartId);
                        $('#addManagerModal').modal('show');
                        break;
                    case 'connect':
                        loadConnectionManagers();
                        loadConnectionTypes();
                        $('#connectManagersModal').modal('show');
                        break;
                    case 'edit-role':
                        loadRoleTypes();
                        const currentRoleType = $(`.manager-node[data-manager-id="${selectedManagerId}"]`)
                            .find('.org-title').data('role-type');
                        $('#edit_role_type').val(currentRoleType);
                        $('#editRoleModal').modal('show');
                        break;
                    case 'delete':
                        Swal.fire({
                            title: '{{ trans('panel.confirm_action') }}',
                            text: '{{ trans('panel.confirm_remove_manager') }}',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: '{{ trans('public.yes') }}',
                            cancelButtonText: '{{ trans('public.cancel') }}',
                            confirmButtonColor: '#d33'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                removeManager(selectedChartId);
                            }
                        });
                        break;
                }
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.table-actions').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });

            // Remove manager
            $('#deleteManagerBtn').on('click', function() {
                $('#managerActionsModal').modal('hide');

                Swal.fire({
                    title: '{{ trans('panel.confirm_action') }}',
                    text: '{{ trans('panel.confirm_remove_manager') }}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '{{ trans('public.yes') }}',
                    cancelButtonText: '{{ trans('public.cancel') }}',
                    confirmButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        removeManager(selectedChartId);
                    }
                });
            });

            // Functions
            function initializeChart() {
                loadChartData();
            }

            function loadChartData() {
                showLoading();

                // Use the data passed from the controller
                chartData = @json($chartData);
                availableManagers = @json($availableManagers);
                roleTypes = {
                    'general_manager': '{{ trans('panel.general_manager') }}',
                    'department_manager': '{{ trans('panel.department_manager') }}',
                    'executive_manager': '{{ trans('panel.executive_manager') }}',
                    'section_supervisor': '{{ trans('panel.section_supervisor') }}',
                    'department_supervisor': '{{ trans('panel.department_supervisor') }}'
                };
                connectionTypes = {
                    'collaboration': '{{ trans('panel.collaboration') }}',
                    'reporting': '{{ trans('panel.reporting') }}',
                    'coordination': '{{ trans('panel.coordination') }}'
                };

                renderChart();
                updateStats();
                hideLoading();
            }

            function renderChart() {
                const container = $('#orgChart');
                container.empty();

                if (!chartData || !chartData.charts || chartData.charts.length === 0) {
                    container.html(`
                <div class="text-center py-5">
                    <i data-feather="users" width="64" height="64" class="text-muted mb-4"></i>
                    <h4 class="text-muted mb-3">{{ trans('panel.no_managers_added') }}</h4>
                    <p class="text-muted mb-4">{{ trans('panel.click_add_manager_to_start') }}</p>
                    <button class="btn btn-primary" id="addFirstManagerBtn">
                        <i data-feather="plus" width="16" height="16" class="mr-2"></i>
                        {{ trans('panel.add_first_manager') }}
                    </button>
                </div>
            `);

                    $('#addFirstManagerBtn').on('click', function() {
                        $('#addManagerBtn').click();
                    });

                    return;
                }

                // Render managers with proper positioning
                chartData.charts.forEach(function(chart, index) {
                    const managerHtml = createManagerNode(chart, index);
                    container.append(managerHtml);

                    // Add animation delay
                    setTimeout(() => {
                        managerHtml.addClass('fade-in');
                    }, index * 100);
                });

                // Render connections
                if (chartData.connections && chartData.connections.length > 0) {
                    renderConnections();
                }
            }

            function createManagerNode(chart, index) {
                const roleClass = getRoleClass(chart.role_type);
                const manager = chart.manager;

                // Calculate position with spacing - use index for positioning if no position set
                const x = chart.position_x || (index * 300 + 50);
                const y = chart.position_y || 50;

                return $(`
            <div class="org-node manager-node" data-chart-id="${chart.id}" data-manager-id="${chart.manager_id}" style="left: ${x}px; top: ${y}px;">
                <div class="org-card ${roleClass}">
                    
                    <h6 class="org-name">${manager.full_name}</h6>
                    <img src="/assets/admin/img/avatar/avatar-1.png" alt="${manager.full_name}" class="org-avatar">
                    <span class="org-title badge badge-success" data-role-type="${chart.role_type}">${roleTypes[chart.role_type] || chart.role_type}</span>

                    <div class="org-actions">
                        <div class="dropdown table-actions">
                            <button type="button" class="btn-transparent dropdown-toggle btn btn-sm btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-vertical" width="16" height="16"></i>
                                {{ trans('panel.actions') }}
                            </button>
                            <div class="dropdown-menu">
                                <a href="#" class="webinar-actions d-block mt-10 manager-dropdown-item" data-action="add-subordinate" data-chart-id="${chart.id}" data-manager-id="${chart.manager_id}">
                                    <i data-feather="user-plus" width="16" height="16" class="mr-2"></i>
                                    {{ trans('panel.add_subordinate') }}
                                </a>
                                <a href="#" class="webinar-actions d-block mt-10 manager-dropdown-item" data-action="connect" data-chart-id="${chart.id}" data-manager-id="${chart.manager_id}">
                                    <i data-feather="link" width="16" height="16" class="mr-2"></i>
                                    {{ trans('panel.connect_manager') }}
                                </a>
                                <a href="#" class="webinar-actions d-block mt-10 manager-dropdown-item" data-action="edit-role" data-chart-id="${chart.id}" data-manager-id="${chart.manager_id}">
                                    <i data-feather="edit" width="16" height="16" class="mr-2"></i>
                                    {{ trans('panel.edit_role') }}
                                </a>
                                <a href="#" class="webinar-actions d-block mt-10 manager-dropdown-item" data-action="move" data-chart-id="${chart.id}" data-manager-id="${chart.manager_id}">
                                    <i data-feather="move" width="16" height="16" class="mr-2"></i>
                                    {{ trans('panel.move_managre') }}
                                </a>
                                <a href="#" class="webinar-actions d-block mt-10 text-danger manager-dropdown-item" data-action="delete" data-chart-id="${chart.id}" data-manager-id="${chart.manager_id}">
                                    <i data-feather="trash-2" width="16" height="16" class="mr-2"></i>
                                    {{ trans('panel.remove_manager') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
            }

            function getRoleClass(roleType) {
                const classes = {
                    'general_manager': 'ceo-card',
                    'department_manager': 'hr-card',
                    'executive_manager': 'it-card',
                    'section_supervisor': 'sales-card',
                    'department_supervisor': 'assistant-card'
                };
                return classes[roleType] || 'hr-card';
            }

            function renderConnections() {
                // Implementation for rendering connections between managers
                // This would use SVG or canvas to draw lines between connected nodes
            }

            function loadAvailableManagers() {
                const select = $('#manager_id');
                select.empty().append('<option value="">{{ trans('panel.select_manager') }}</option>');

                availableManagers.forEach(function(manager) {
                    select.append(
                        `<option value="${manager.id}">${manager.full_name} (${manager.email})</option>`
                        );
                });
            }

            function loadExistingManagers() {
                const select = $('#parent_id');
                select.empty().append('<option value="">{{ trans('panel.no_parent') }}</option>');

                if (chartData && chartData.charts) {
                    chartData.charts.forEach(function(chart) {
                        select.append(`<option value="${chart.id}">${chart.manager.full_name}</option>`);
                    });
                }
            }

            function loadRoleTypes() {
                const select = $('#role_type');
                const editSelect = $('#edit_role_type');

                [select, editSelect].forEach(function(sel) {
                    sel.empty().append('<option value="">{{ trans('panel.select_role') }}</option>');

                    Object.keys(roleTypes).forEach(function(key) {
                        sel.append(`<option value="${key}">${roleTypes[key]}</option>`);
                    });
                });
            }

            function loadConnectionManagers() {
                const select = $('#to_manager_id');
                select.empty().append('<option value="">{{ trans('panel.select_manager') }}</option>');

                if (chartData && chartData.charts) {
                    chartData.charts.forEach(function(chart) {
                        if (chart.manager_id != selectedManagerId) {
                            select.append(
                                `<option value="${chart.manager_id}">${chart.manager.full_name}</option>`
                                );
                        }
                    });
                }
            }

            function loadConnectionTypes() {
                const select = $('#connection_type');
                select.empty().append('<option value="">{{ trans('panel.select_connection_type') }}</option>');

                Object.keys(connectionTypes).forEach(function(key) {
                    select.append(`<option value="${key}">${connectionTypes[key]}</option>`);
                });
            }

            function addManager() {
                const formData = {
                    manager_id: $('#manager_id').val(),
                    parent_id: $('#parent_id').val() || null,
                    role_type: $('#role_type').val(),
                    position_x: $('#position_x').val() || 0,
                    position_y: $('#position_y').val() || 0,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: `/panel/projects/{{ $project->id }}/organizational-chart`,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#addManagerModal').modal('hide');
                            showSuccess(response.message);
                            // Reload the page to get updated data
                            location.reload();
                        } else {
                            showError(response.message);
                        }
                    },
                    error: function() {
                        showError('{{ trans('panel.something_went_wrong') }}');
                    }
                });
            }

            function connectManagers() {
                const formData = {
                    from_manager_id: selectedManagerId,
                    to_manager_id: $('#to_manager_id').val(),
                    connection_type: $('#connection_type').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: `/panel/projects/{{ $project->id }}/organizational-chart/connect`,
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#connectManagersModal').modal('hide');
                            showSuccess(response.message);
                            location.reload();
                        } else {
                            showError(response.message);
                        }
                    },
                    error: function() {
                        showError('{{ trans('panel.something_went_wrong') }}');
                    }
                });
            }

            function editRole() {
                const formData = {
                    role_type: $('#edit_role_type').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                };

                $.ajax({
                    url: `/panel/projects/{{ $project->id }}/organizational-chart/${selectedChartId}`,
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#editRoleModal').modal('hide');
                            showSuccess(response.message);
                            location.reload();
                        } else {
                            showError(response.message);
                        }
                    },
                    error: function() {
                        showError('{{ trans('panel.something_went_wrong') }}');
                    }
                });
            }

            function removeManager(chartId) {
                $.ajax({
                    url: `/panel/projects/{{ $project->id }}/organizational-chart/${chartId}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message);
                            location.reload();
                        }
                    },
                    error: function() {
                        showError('{{ trans('panel.something_went_wrong') }}');
                    }
                });
            }

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

                const left = Math.max(0, (containerWidth - chartWidth) / 2);
                const top = Math.max(0, (containerHeight - chartHeight) / 2);

                chart.css({
                    'left': left + 'px',
                    'top': top + 'px'
                });
            }

            function fitChartToContainer() {
                const container = $('.org-chart-container');
                const chart = $('#orgChart');
                const containerWidth = container.width();
                const containerHeight = container.height();
                const chartWidth = chart.width();
                const chartHeight = chart.height();

                const scaleX = containerWidth / chartWidth;
                const scaleY = containerHeight / chartHeight;
                currentZoom = Math.min(scaleX, scaleY, 1);

                updateChartZoom();
                centerChart();
            }

            function updateStats() {
                const managersCount = chartData && chartData.charts ? chartData.charts.length : 0;
                const connectionsCount = chartData && chartData.connections ? chartData.connections.length : 0;

                $('#managersCount').text(`${managersCount} {{ trans('panel.managers') }}`);
                $('#connectionsCount').text(`${connectionsCount} {{ trans('panel.connections') }}`);
            }

            function showLoading() {
                $('#chartLoading').show();
            }

            function hideLoading() {
                $('#chartLoading').hide();
            }

            function showSuccess(message) {
                Swal.fire({
                    icon: 'success',
                    title: '{{ trans('panel.success') }}',
                    text: message,
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            function showError(message) {
                Swal.fire({
                    icon: 'error',
                    title: '{{ trans('panel.error') }}',
                    text: message
                });
            }
        });
    </script>
@endpush
