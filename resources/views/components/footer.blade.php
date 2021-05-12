

    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('assets/vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('assets/vendor/dom-factory.js') }}"></script>

    <!-- MDK -->
    <script src="{{ asset('assets/vendor/material-design-kit.js') }}"></script>
    
    <script src="{{ asset('assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
    
    <script src="{{ asset('assets/vendor/fileinput/fileinput.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/fileinput/theme.min.js') }}"></script>
    
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- App -->
    <script src="{{ asset('assets/js/toggle-check-all.js') }}"></script>
    <script src="{{ asset('assets/js/check-selected-row.js') }}"></script>
    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-mini.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        $(function(){
            $('.flatpickr').flatpickr({
                dateFormat: 'd-m-Y'
            })

            // Input checkbox value
            
            $('input[type="checkbox"]').change(function(e) {
                if($(this).is(':checked')) {
                    $(this).val(true);
                } else {
                    $(this).val(false);
                }
            })

            $('.fileinput').fileinput({
                showUpload: false,
                theme: 'fas',
                maxFileSize: $(this).data('max-file-size') || 512,
                allowedFileTypes: ['image'],
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
            })

            $('.fileinput-any').fileinput({
                showUpload: false,
                theme: 'fas',
                maxFileSize: $(this).data('max-file-size') || 512,
            })

            function showModal(trigger, modal) {
                $(trigger).click(function(e){
                    e.preventDefault();

                    $(modal).appendTo('body').modal('show');
                })
            }

            showModal('#deleteModalTrigger', '#delete-modal')
            showModal('#importMembersModalTrigger', '#modal-import')
            showModal('#bulkEditTrigger', '#modal-bulkedit')
        })
    </script>

    {!! Toastr::message() !!}

    @yield('js')
</body>

</html>
