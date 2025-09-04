
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
    $('#addCandidatesForm').on('submit', function(e) {
        e.preventDefault();
        
        let $form = $(this);
        let $submitBtn = $('#saveCandidatesBtn');
        let $spinner = $submitBtn.find('.spinner-border');
        let formData = $form.serialize();
        
        // إظهار حالة التحميل
        $submitBtn.prop('disabled', true);
        $spinner.removeClass('d-none');
        
        // إزالة رسائل الخطأ السابقة
        $form.find('.is-invalid').removeClass('is-invalid');
        $form.find('.invalid-feedback').text('');
        
        $.ajax({
            url: '{{ route("panel.projects.candidates.store", $project->id) }}',
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
                    $('#addCandidatesModal').modal('hide');
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

// تحديث حالة المرشح
function updateCandidateStatus(candidateId, newStatus) {
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
                url: '{{ route("panel.projects.candidates.update", ["project_id" => $project->id, "candidate_id" => ":candidate_id"]) }}'.replace(':candidate_id', candidateId),
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

// حذف مرشح
function deleteCandidate(candidateId) {
    Swal.fire({
        title: '{{ trans("panel.confirm_action") }}',
        text: '{{ trans("panel.are_you_sure_delete_candidate") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: '{{ trans("public.yes") }}',
        cancelButtonText: '{{ trans("public.cancel") }}',
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("panel.projects.candidates.destroy", ["project_id" => $project->id, "candidate_id" => ":candidate_id"]) }}'.replace(':candidate_id', candidateId),
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
