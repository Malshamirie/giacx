<link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.min.css">
<script src="/assets/vendors/nprogress/nprogress.min.js"></script>
<script>
    NProgress.configure({
        showSpinner: true, // Hide spinner
        easing: 'ease',     // Animation style
        speed: 500          // Animation speed
    });

    document.addEventListener("DOMContentLoaded", function () {
        NProgress.start(); // Start progress bar
    });

    window.addEventListener('load', () => {
        NProgress.done();
    });
</script>
<?php /**PATH D:\Abu-Nabil\giacx\resources\views/admin/includes/preloading.blade.php ENDPATH**/ ?>