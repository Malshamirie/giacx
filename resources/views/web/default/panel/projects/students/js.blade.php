
<script src="/assets/default/vendors/select2/select2.min.js"></script>
<script>
$(document).ready(function() {
    // تفعيل Select2
    $('.select2').select2({
        placeholder: '{{ trans("panel.search_and_select_students") }}',
        allowClear: true,
        width: '100%'
    });

    // إرسال النموذج عبر AJAX
    $('#addstudentsForm').on('submit', function(e) {
        e.preventDefault();
        
        let $form = $(this);
        let $submitBtn = $('#savestudentsBtn');
        let $spinner = $submitBtn.find('.spinner-border');
        let formData = $form.serialize();
        
        // إظهار حالة التحميل
        $submitBtn.prop('disabled', true);
        $spinner.removeClass('d-none');
        
        // إزالة رسائل الخطأ السابقة
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('.invalid-feedback').text('');
        
        $.ajax({
            url: '{{ route("panel.projects.students.store", $project->id) }}',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.code === 200) {
                    // إظهار رسالة النجاح
                    Swal.fire({
                        icon: 'success',
                        title: '{{ trans("panel.success") }}',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    
                    // إغلاق المودل وتحديث الصفحة
                    $('#addStudentsModal ').modal('hide');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON;
                if (errors && errors.errors) {
                    // عرض أخطاء التحقق
                    Object.keys(errors.errors).forEach(function(key) {
                        let error = errors.errors[key];
                        let element = $form.find('[name="' + key + '"]');
                        element.addClass('is-invalid');
                        element.parent().find('.invalid-feedback').text(error[0]);
                    });
                } else {
                    // رسالة خطأ عامة
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("panel.error") }}',
                        text: '{{ trans("panel.something_went_wrong") }}'
                    });
                }
            },
            complete: function() {
                // إعادة تفعيل الزر
                $submitBtn.prop('disabled', false);
                $spinner.addClass('d-none');
            }
        });
    });
});

// وظائف العمليات الجماعية
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.student-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.student-checkbox:checked');
    const bulkActionsBar = document.getElementById('bulkActionsBar');
    const selectedCount = document.getElementById('selectedCount');
    const selectAll = document.getElementById('selectAll');
    
    if (checkboxes.length > 0) {
        bulkActionsBar.style.display = 'block';
        selectedCount.textContent = checkboxes.length + ' {{ trans("panel.selected") }}';
    } else {
        bulkActionsBar.style.display = 'none';
    }
    
    // تحديث حالة "تحديد الكل"
    const allCheckboxes = document.querySelectorAll('.student-checkbox');
    selectAll.checked = checkboxes.length === allCheckboxes.length;
    selectAll.indeterminate = checkboxes.length > 0 && checkboxes.length < allCheckboxes.length;
}

function clearSelection() {
    const checkboxes = document.querySelectorAll('.student-checkbox');
    const selectAll = document.getElementById('selectAll');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = false;
    });
    selectAll.checked = false;
    selectAll.indeterminate = false;
    
    updateBulkActions();
}

function getSelectedStudentIds() {
    const checkboxes = document.querySelectorAll('.student-checkbox:checked');
    return Array.from(checkboxes).map(checkbox => checkbox.value);
}

// العمليات الجماعية
function bulkConvertType(newType) {
    const selectedIds = getSelectedStudentIds();
    
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: '{{ trans("panel.no_selection") }}',
            text: '{{ trans("panel.please_select_students") }}'
        });
        return;
    }
    
    const confirmMessage = newType === 'candidate' 
        ? '{{ trans("panel.confirm_bulk_convert_to_candidate") }}'
        : '{{ trans("panel.confirm_bulk_convert_to_participant") }}';
    
    Swal.fire({
        title: confirmMessage,
        text: '{{ trans("panel.this_action_will_affect") }} ' + selectedIds.length + ' {{ trans("panel.students") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.projects.students.bulk-convert-type", $project->id) }}',
                type: 'POST',
                data: {
                    student_ids: selectedIds,
                    type: newType,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.code === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans("panel.success") }}',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("panel.error") }}',
                        text: '{{ trans("panel.something_went_wrong") }}'
                    });
                }
            });
        }
    });
}

function bulkUpdateStatus(newStatus) {
    const selectedIds = getSelectedStudentIds();
    
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: '{{ trans("panel.no_selection") }}',
            text: '{{ trans("panel.please_select_students") }}'
        });
        return;
    }
    
    const confirmMessage = newStatus === 'active' 
        ? '{{ trans("panel.confirm_bulk_activate") }}'
        : '{{ trans("panel.confirm_bulk_deactivate") }}';
    
    Swal.fire({
        title: confirmMessage,
        text: '{{ trans("panel.this_action_will_affect") }} ' + selectedIds.length + ' {{ trans("panel.students") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.projects.students.bulk-update-status", $project->id) }}',
                type: 'POST',
                data: {
                    student_ids: selectedIds,
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.code === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans("panel.success") }}',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("panel.error") }}',
                        text: '{{ trans("panel.something_went_wrong") }}'
                    });
                }
            });
        }
    });
}

function bulkDelete() {
    const selectedIds = getSelectedStudentIds();
    
    if (selectedIds.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: '{{ trans("panel.no_selection") }}',
            text: '{{ trans("panel.please_select_students") }}'
        });
        return;
    }
    
    Swal.fire({
        title: '{{ trans("panel.confirm_bulk_delete") }}',
        text: '{{ trans("panel.this_action_will_affect") }} ' + selectedIds.length + ' {{ trans("panel.students") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}',
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.projects.students.destroy-multiple", $project->id) }}',
                type: 'POST',
                data: {
                    student_ids: selectedIds,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.code === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans("panel.success") }}',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("panel.error") }}',
                        text: '{{ trans("panel.something_went_wrong") }}'
                    });
                }
            });
        }
    });
}

// الوظائف الفردية (الموجودة مسبقاً)
function convertType(studentId, newType) {
    const confirmMessage = newType === 'candidate' 
        ? '{{ trans("panel.confirm_convert_to_candidate") }}'
        : '{{ trans("panel.confirm_convert_to_participant") }}';
    
    Swal.fire({
        title: confirmMessage,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
        fetch(`/panel/projects/students/${studentId}/convert-type`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                type: newType
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '{{ trans("panel.error") }}',
                    text: data.message || '{{ trans("panel.error_occurred") }}'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: '{{ trans("panel.error") }}',
                text: '{{ trans("panel.error_occurred") }}'
            });
        });
        }
    });
    }

// تحديث حالة الطالب
function updatestudentstatus(studentId, newStatus) {
    Swal.fire({
        title: '{{ trans("panel.confirm_action") }}',
        text: '{{ trans("panel.are_you_sure_update_status") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.projects.students.update", ["project_id" => $project->id, "student_id" => ":student_id"]) }}'.replace(':student_id', studentId),
                type: 'PUT',
                data: {
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.code === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans("panel.success") }}',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("panel.error") }}',
                        text: '{{ trans("panel.something_went_wrong") }}'
                    });
                }
            });
        }
    });
}

// حذف طالب
function deletestudent(studentId) {
    Swal.fire({
        title: '{{ trans("panel.confirm_action") }}',
        text: '{{ trans("panel.are_you_sure_delete_student") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}',
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.projects.students.destroy", ["project_id" => $project->id, "student_id" => ":student_id"]) }}'.replace(':student_id', studentId),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.code === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: '{{ trans("panel.success") }}',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: '{{ trans("panel.error") }}',
                        text: '{{ trans("panel.something_went_wrong") }}'
                    });
                }
            });
        }
    });
}
</script>
