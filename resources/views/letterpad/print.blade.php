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

        .ref-date {
            width: 100%;
        }

        .ref {
            /* padding-left: 55px; */
            font-size: 20px;
            font-style: italic;
            line-height: 20px;
            padding-top: 5px;
        }

        .date {
            font-size: 23px;
            padding-right: 140px;
            line-height: 23px;
            text-align: right;
        }

        .date.ar {
            font-size: 20px;
            padding-right: 130px;
            line-height: 20px;
            padding-top: 0px;
        }

        .date.en {
            font-size: 20px;
            padding-right: 130px;
            line-height: 20px;
            padding-top: -3px;
        }
    </style>
</head>

<body>
    {{-- <div class="ref-date">
        <div class="ref" style="float: left;">Ref: {{ $ref }}</div>
        <div class="date" style="float: right">{{ $date }}</div>
    </div> --}}
    <table class="ref-date">
        <tr>
            <td class="ref"></td>
            <td class="date {{$lang}}">{{ $date }}</td>
        </tr>
    </table>
    <div class="content">
        @if ($lang === 'ml')
            <div style="font-size: 18px;">
                <p>അസ്സലാമു അലൈകും</p>
                <p>ബഹുമാനപ്പെട്ട &nbsp; &nbsp;<span
                        style="font-weight: bold; margin-left: 5px">{{ $donor ? $donor : $sponsor->name }}</span> &nbsp;
                    &nbsp;അവർകൾക്ക്,</p>

                <p>ക്ഷേമവും സൗഖ്യവും നേരുന്നു....</p>


                <p>കണ്ണാടിപ്പറമ്പ് ദാറുൽ ഹസനാത്ത് വിദ്യാഭ്യാസ സംരംഭങ്ങളോട് താങ്കൾ സഹകരിച്ചതിന് ഹൃദ്യമായ നന്ദി.</p>

                <p>പുണ്യങ്ങള്‍ പെയ്‌തിറങ്ങുന്ന വിശുദ്ധ റമളാനില്‍ ദാറുല്‍ ഹസനാത്തിനായി താങ്കള്‍ നല്‍കിയ ഈ മഹത്തായ സംഭാവന
                    സന്തോഷപൂര്‍വ്വം സ്വീകരിക്കുന്നു. താങ്കൾ നൽകിയ <span
                        style="font-weight: bold">{{ $amount ? $amount : $sponsor->amount }}</span> നാഥന്‍
                    സ്വീകരിക്കട്ടെ....
                    ഈ നന്മ കാരണമായി സർവശക്തൻ കുടുംബത്തിലും മറ്റു വ്യവഹാരങ്ങളിലും അനുഗ്രഹം ചൊരിയട്ടെ... ആമീൻ</p>

                <p>തിരിച്ചുതരാൻ ഞങ്ങളുടെ കൈയിൽ മുടങ്ങാത്ത പ്രാർത്ഥന മാത്രമേയുള്ളൂ.
                    സ്ഥാപനത്തിലെ നൂറു കണക്കിന് വിദ്യാർത്ഥികളും ഉസ്താദുമാരും നിങ്ങൾക്കു വേണ്ടി ദുആ ചെയ്തു കൊണ്ടിരിക്കും.
                    ഇൻ
                    ഷാ
                    അല്ലാഹ്.</p>

                <p>ഇതിന്റെ സന്ദേശം പരിചിതരായ സുമനസ്സുകൾക്ക് കൈമാറണമെന്ന് വിനയ പുരസരം അഭ്യർത്ഥിക്കുന്നു</p>
            </div>
        @elseif($lang === 'ar')
            <div lang="ar" dir="rtl">
                <p style="text-align: center">الحمد لله رب العالمين والصلاة والسلام على سيد المرسلين وعلى آله وصحبه
                    أجمعين وبعد!</p>
                <p style="text-align: center; font-size: 16px;">السلام عليكم ورحمة الله وبركاته</p>
                <p style="font-size: 20px;">إلى حضرة الشيخ <strong>{{ $donor ? $donor : $sponsor->name }}</strong> حفظكم الله ورعاكم!</p>
                <p style="text-align: justify">بداية: لا يسعنا إلا أن نقدم إلى شخصيتكم الكريمة جزيل الشكر والتقدير لما لمسنا منكم من مساعدات قيمة
                    لمجمع دار الحسنات الإسلامي بكيرالا الهندية مبلغها <span
                        style="font-weight: bold">{{ $amount ? $amount : $sponsor->amount }}</span> نتعهد إليك أننا سوف
                    نبذلها لتعليم طلاب كلية دار الحسنات الإسلامية وكلية تحفيظ القرآن الكريم.</p>
                <p style="text-align: justify">ثانيا: ندعو الله العلي القدير أن يجعل ما تنفقونه فى ميزان حسناتكم ويبارك لكم فى أموالكم وأولادكم،
                    ونرجو الله العلي القدير أن يوفقنا وإياكم لاستمرار خدمة دينه الحنيف مع تمنياتنا لكم ولعائلتكم الكريمة
                    موفور الصحة والعافية ويجمع بيننا وبينكم فى جناته النعيم، إنه سميع كريم مجيب.
                </p>
                <p>ختاما، تفضلوا بقبول وافر الاحترام و التقدير</p>
            </div>
        @elseif($lang === "en")
            <div style="font-size: 20px; line-height: 20px;">
                <p>
                    <b>Assalamu Alaikum</b><br>
                </p>
                <p>
                    <b>{{ $donor ? $donor : $sponsor->name }}</b>
                </p>
                <p>Greetings, dear brother!</p>
                
                <p style="text-align: justify; line-height: 25px;">We're truly grateful  to convey our heartfelt appreciation for your generous support of Darul Hasanath Islamic College through your involvement in the Muvasath project.</p>
                <p>Your donation of <strong>{{ $amount ? $amount : $sponsor->amount }}</strong> has been received with immense gratitude.</p>
                <p style="text-align: justify; line-height: 25px;">Facilitating access to education for those in need to understand the profound teachings of Islam is indeed among the noblest of deeds. We respectfully encourage you to share this message with your friends and family.</p>
                <p>May the Almighty reward us for our good deeds and fulfill our noble intentions!</p>
            </div>
        @endif
    </div>
</body>

</html>
