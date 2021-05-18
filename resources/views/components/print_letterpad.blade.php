<div class="card">
    <div class="card-header">
        <div class="card-header__title">Letterpad</div>
    </div>
    <div class="card-body">
        <p>Let the donor know our happiness. Send it today</p>
        <form target="_blank" action="{{ route('user.sponsors.letterpad.print', $sponsor->id) }}" method="get">
            <div class="form-group">
                <select class="form-control" name="lang" id="lang" required>
                    <option value="ml">Malayalam</option>
                    <option value="ar" disabled>Arabic</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name_in_lang">Name in <span class="selectedLang"></span></label>
                <input type="text" name="name_in_lang" id="name_in_lang" class="form-control" value="{{ $sponsor->name . ' ' . $sponsor->place }}" placeholder="Name in selected language">
            </div>
            <div class="form-group">
                @php
                    $amount = $sponsor->amount;
                    $amount .= " രൂപ";
                    if($amount >= 1000) {
                        $singular = "കുട്ടി";
                        $plural = "കുട്ടികൾ";
                        
                        $student = floor($sponsor->amount / 1000);

                        $amount .= " (".$student." ". ($student > 1 ? $plural : $singular) .")";
                    }
                @endphp
                <label for="amount_in_lang">Amount in <span class="selectedLang"></span></label>
                <input type="text" name="amount_in_lang" id="amount_in_lang" class="form-control" value="{{ $amount }}" placeholder="Amount in selected language">
            </div>

            <button class="btn btn-success">Print</button>
        </form>
    </div>
</div>

@section('js')
    <script>
        $(function(){
            function dispalyLanguage() {
                const lang = $('#lang').val()
                let language = null;
                
                if(lang == 'ml') {
                    language = 'Malayalam';
                } else if(lang == 'ar') {
                    language = 'Arabic';
                }

                $('.selectedLang').text(language);
            }
            $('#lang').change(dispalyLanguage)

            dispalyLanguage()
        })
    </script>
@endsection