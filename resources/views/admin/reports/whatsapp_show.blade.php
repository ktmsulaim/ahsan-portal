@extends('layouts.base', ['title' => $title . ' - WhatsApp Report'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.reports.whatsapp') }}">WhatsApp Reports</a></li>
    <li class="breadcrumb-item active">{{ $title }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center flex-wrap">
                    <div class="card-header__title flex-grow-1 mr-2" style="min-width: 0;">
                        {{ $title }}
                    </div>
                    <div class="d-flex flex-shrink-0 flex-wrap align-items-center mt-2 mt-md-0">
                        <button type="button" class="btn btn-success mr-1" id="copyReportBtn">
                            Copy to clipboard
                        </button>
                        <a href="{{ route('admin.reports.whatsapp') }}" class="btn btn-outline-secondary">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <pre id="reportText" class="bg-light p-3 rounded mb-0" style="white-space: pre-wrap; max-height: 70vh; overflow-y: auto;">{{ e($text) }}</pre>
                    <textarea id="reportTextRaw" class="d-none" readonly>{{ e($text) }}</textarea>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        (function() {
            var btn = document.getElementById('copyReportBtn');
            var pre = document.getElementById('reportText');
            var raw = document.getElementById('reportTextRaw');
            if (!btn || !raw) return;
            btn.addEventListener('click', function() {
                var text = raw.value || raw.textContent;
                if (!text) return;
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text).then(function() {
                        btn.textContent = 'Copied!';
                        setTimeout(function() { btn.textContent = 'Copy to clipboard'; }, 2000);
                    }).catch(function() {
                        fallbackCopy(text);
                    });
                } else {
                    fallbackCopy(text);
                }
            });
            function fallbackCopy(str) {
                var ta = document.createElement('textarea');
                ta.value = str;
                ta.setAttribute('readonly', '');
                ta.style.position = 'absolute';
                ta.style.left = '-9999px';
                document.body.appendChild(ta);
                ta.select();
                try {
                    document.execCommand('copy');
                    btn.textContent = 'Copied!';
                    setTimeout(function() { btn.textContent = 'Copy to clipboard'; }, 2000);
                } catch (e) {}
                document.body.removeChild(ta);
            }
        })();
    </script>
@endsection
