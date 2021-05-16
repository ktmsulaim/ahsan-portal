<!DOCTYPE html>
<html lang="ml">

<head>
    <title>{{ $donor }} - Ahsan | Darul Hasanath Islamic College</title>
    <meta charset="utf-8">
    <style>
        body {
            background: url('/assets/images/letterpad_muvasath.jpg');
            background-image-resize: 6;
            background-position: left top;
        }
        .ref {
            padding-left: 55px;
            font-size: 18px;
            font-style: italic;
        }

        .date {
            text-align: right;
            margin-top: -30px;
            padding-right: 50px;
            font-size: 18px;
        }

    </style>
</head>

<body>
    <div class="ref-date">
        <div class="ref" style="float: left;">{{ $ref }}</div>
        <div class="date" style="float: right">{{ $date }}</div>
    </div>
    <div style="margin-top: 100px" class="content">
        <p>ബഹുമാനപ്പെട്ട &nbsp; &nbsp;<span style="color: red; margin-left: 5px">{{ $donor ? $donor : $sponsor->name }}</span> &nbsp; &nbsp;അവർകൾക്ക്,</p>

        <p>ക്ഷേമവും സൗഖ്യവും നേരുന്നു....</p>


        <p>കണ്ണാടിപ്പറമ്പ് ദാറുൽ ഹസനാത്ത് വിദ്യാഭ്യാസ സംരംഭങ്ങളോട് താങ്കൾ സഹകരിച്ചതിന് ഹൃദ്യമായ നന്ദി.</p>

        <p>കോവിഡ് മഹാമാരിയുടെ പ്രതിസന്ധി ഘട്ടത്തിലും ഹസനാത്തിനൊരു കൈതാങ്ങാവാൻ താങ്കൾ കാണിച്ച സന്നദ്ധത അല്ലാഹു
            സ്വീകരിക്കട്ടെ. താങ്കൾ നൽകിയ <span style="font-weight: bold">{{ $amount ? $amount : $sponsor->amount }}</span> സംഭാവന റമളാനിന്റെ പുണ്യം കരസ്ഥമാവാൻ നിദാനമാവട്ടെ....
            ഈ നന്മ കാരണമായി സർവശക്തൻ കുടുംബത്തിലും മറ്റു വ്യവഹാരങ്ങളിലും അനുഗ്രഹം ചൊരിയട്ടെ... ആമീൻ</p>

        <p>തിരിച്ചുതരാൻ ഞങ്ങളുടെ കൈയിൽ മുടങ്ങാത്ത പ്രാർത്ഥന മാത്രമേയുള്ളൂ.
            സ്ഥാപനത്തിലെ നൂറു കണക്കിന് വിദ്യാർത്ഥികളും ഉസ്താദുമാരും നിങ്ങൾക്കു വേണ്ടി ദുആ ചെയ്തു കൊണ്ടിരിക്കും. ഇൻ ഷാ
            അല്ലാഹ്.</p>

        <p>ഇതിന്റെ സന്ദേശം പരിചിതരായ സുമനസ്സുകൾക്ക് കൈമാറണമെന്ന് വിനയ പുരസരം അഭ്യർത്ഥിക്കുന്നു</p>
    </div>
</body>

</html>
