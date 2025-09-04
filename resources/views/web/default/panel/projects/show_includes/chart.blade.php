<div class="tab-pane fade" id="organizational-chart">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0">{{ trans('panel.organizational_chart') }}</h5>
                <div class="chart-controls">
                    <button class="btn btn-sm btn-outline-secondary" id="expandChart" title="{{ trans('panel.expand_chart') }}">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="fitChart" title="{{ trans('panel.fit_chart') }}">
                        <i class="fas fa-compress-arrows-alt"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="zoomIn" title="{{ trans('panel.zoom_in') }}">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="zoomOut" title="{{ trans('panel.zoom_out') }}">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="resetChart" title="{{ trans('panel.reset_chart') }}">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="org-chart-container" style="background: linear-gradient(135deg, #e3f2fd 0%, #ffffff 100%); min-height: 600px; padding: 20px; border-radius: 15px;">
                <div class="org-chart" id="orgChart">
                    <!-- CEO Level -->
                    <div class="org-level ceo-level">
                        <div class="org-node ceo-node">
                            <div class="org-card ceo-card">
                                <div class="org-card-header">
                                    <img src="https://via.placeholder.com/60x60/4CAF50/ffffff?text=NP" alt="CEO" class="org-avatar">
                                    <div class="org-info">
                                        <h6 class="org-name">{{ $project->projectManager->full_name ?? 'Nicky Phillips' }}</h6>
                                        <span class="org-title">{{ trans('panel.ceo') }}</span>
                                    </div>
                                    <div class="org-badge">2</div>
                                    <div class="org-actions">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </div>
                                </div>
                                <div class="org-card-footer">
                                    <i class="fas fa-minus collapse-btn"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Personal Assistant -->
                        <div class="org-node assistant-node">
                            <div class="org-card assistant-card">
                                <div class="org-card-header">
                                    <img src="https://via.placeholder.com/60x60/FF9800/ffffff?text=LM" alt="Assistant" class="org-avatar">
                                    <div class="org-info">
                                        <h6 class="org-name">{{ trans('panel.personal_assistant') }}</h6>
                                        <span class="org-title">{{ trans('panel.assistant') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Department Level -->
                    <div class="org-level department-level">
                        <!-- HR Department -->
                        <div class="org-node department-node">
                            <div class="org-card hr-card">
                                <div class="org-card-header">
                                    <img src="https://via.placeholder.com/60x60/FFC107/ffffff?text=JH" alt="HR Manager" class="org-avatar">
                                    <div class="org-info">
                                        <h6 class="org-name">{{ trans('panel.hr_manager') }}</h6>
                                        <span class="org-title">{{ trans('panel.hr_department') }}</span>
                                    </div>
                                    <div class="org-badge">2</div>
                                    <div class="org-actions">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- IT Department -->
                        <div class="org-node department-node">
                            <div class="org-card it-card">
                                <div class="org-card-header">
                                    <div class="org-info">
                                        <h6 class="org-name">{{ trans('panel.it_department') }}</h6>
                                    </div>
                                </div>
                                <div class="org-sub-members">
                                    <div class="org-sub-member">
                                        <img src="https://via.placeholder.com/50x50/2196F3/ffffff?text=CR" alt="Core Lead" class="org-avatar-sm">
                                        <div class="org-sub-info">
                                            <h6 class="org-name-sm">{{ trans('panel.core_team_lead') }}</h6>
                                            <div class="org-badge-sm">3</div>
                                        </div>
                                    </div>
                                    <div class="org-sub-member">
                                        <img src="https://via.placeholder.com/50x50/9C27B0/ffffff?text=LF" alt="UI Lead" class="org-avatar-sm">
                                        <div class="org-sub-info">
                                            <h6 class="org-name-sm">{{ trans('panel.ui_team_lead') }}</h6>
                                            <div class="org-badge-sm">3</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sales Department -->
                        <div class="org-node department-node">
                            <div class="org-card sales-card">
                                <div class="org-card-header">
                                    <img src="https://via.placeholder.com/60x60/FF5722/ffffff?text=TC" alt="Sales Manager" class="org-avatar">
                                    <div class="org-info">
                                        <h6 class="org-name">{{ trans('panel.sales_manager') }}</h6>
                                        <span class="org-title">{{ trans('panel.sales_department') }}</span>
                                    </div>
                                    <div class="org-badge">2</div>
                                    <div class="org-actions">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>