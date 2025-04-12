<footer class="footer text-right">
  <p class="block">Copyright &copy; 2025-26 Quick Slot. All Rights Reserved.</p>
</footer>
</div>
</div>
<div class="chat-windows"></div>
<script src="{{ asset('admin_assets/libs/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('admin_assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<script src="{{ asset('dist/js/app.min.js')}}"></script>
<!-- Theme settings -->
@if(Route::current()->getName()=='admin.task.schedule')
<script>
$(function() {
    "use strict";
    $("#main-wrapper").AdminSettings({
        Theme: false,
        Layout: 'vertical',
        LogoBg: 'skin4',
        NavbarBg: 'skin6',
        SidebarType: 'mini-sidebar',
        SidebarColor: 'skin4',
        SidebarPosition: true,
        HeaderPosition: true,
        BoxedLayout: false,
    });
});
</script>
@else
<script src="{{ asset('dist/js/app.init.js')}}"></script>
@endif
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('admin_assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<!--Menu sidebar -->
<script src="{{ asset('dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('dist/js/custom.min.js')}}"></script>
<!--This page JavaScript -->
<script src="{{ asset('admin_assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{ asset('dist/js/pages/datatable/datatable-advanced.init.js')}}"></script>
<script src="{{ asset('admin_assets/libs/moment/min/moment.min.js')}}"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="{{ asset('admin_assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    // Date Picker
    jQuery('.mydatepicker, #datepicker, .input-group.date').datepicker({
		format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
		format: 'yyyy-mm-dd',
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
	</script>
<script src="{{ asset('admin_assets/libs/daterangepicker/daterangepicker.js') }}"></script>
<script>
    /*******************************************/
    // Basic Date Range Picker
    /*******************************************/
    $('.daterange').daterangepicker({
		autoApply: true,
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
	</script>
<script src="{{ asset('admin_assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin_assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/forms/select2/select2.init.js') }}"></script>
<script src="{{ asset('admin_assets/custom.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
        @if(Session::has('flash_success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('flash_success') }}");
        @endif

        @if(Session::has('flash_error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('flash_error') }}");
        @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif

        @if(Session::has('flash_warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('flash_warning') }}");
        @endif
      </script>
</body></html>