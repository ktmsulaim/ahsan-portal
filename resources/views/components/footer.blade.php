

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

    @yield('scripts')

    <script>
        $(function(){
            $('.flatpickr').flatpickr({
                dateFormat: 'd-m-Y'
            })

            // Input checkbox value
            
            $('input[type="checkbox"]').change(function(e) {
                let target = $(this).data('target');
                target = $(target);

                let value = 0;

                if($(this).is(':checked')) {
                    $(this).val(true);
                    value = 1;
                } else {
                    $(this).val(false);
                    value = 0;
                }

                if(target.length) {
                    target.val(value);
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

            function setStateAndDistrictOptions() {
                if(!$('#state').length) return;

                let states = [];
                $.getJSON("{{ asset('states.json') }}", function(data) {
                    states = data;
                    
                    $.each(data, function(key, value){
                        const option = $('<option/>').val(value.name).text(value.name).appendTo('#state');
                        
                        if(!$('#state options:selected').length) {
                            if(value.name === 'Kerala') {
                                option.prop('selected', true);
                                $('#state').trigger('change');
                            }
                        }
                        
                    });
                    
                    const oldValue = $('#state').data('state');
                    if(oldValue) {
                        $('#state').val(oldValue);
                        $('#state').trigger('change');
                    }

                });

                $('#state').on('change', function(e){
                    const selected = e.target.value;
                    const stateObject = states.find((state) => state.name === selected);

                    if(!stateObject) return;

                    $('#district option').remove().append('<option value="">--Select--</option>');
                    
                    $.each(stateObject.districts, function(key, value){
                        $('<option/>').val(value.name).text(value.name).appendTo('#district');
                    });
                    
                    const oldValue = $('#district').data('district');

                    if(oldValue) {
                        $('#district').val(oldValue);
                    }

                    $('#district').attr('disabled', false);
                    
                });
            }

            showModal('#deleteModalTrigger', '#delete-modal');
            showModal('#importMembersModalTrigger', '#modal-import');
            showModal('#bulkEditTrigger', '#modal-bulkedit');
            showModal('#addSponsorTrigger', '#add-sponsor-modal');
            
            setStateAndDistrictOptions();
        })
    </script>

    {!! Toastr::message() !!}

    @include('components.pwa-install-prompt')

    @yield('js')
</body>

</html>
