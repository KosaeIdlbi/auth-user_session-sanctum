<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{ $user->name }} مرحبًا،

    لقد تلقّينا طلبًا لإعادة تعيين كلمة المرور الخاصة بحسابك على منصة SyrX.

    للمتابعة، يرجى الضغط على الرابط أدناه لإعادة تعيين كلمة المرور:

    <button> <a href={{ route('user.password.getToken', ['token' => $token]) }}>تعديل كلمة المرور</a> </button>

    يرجى ملاحظة أن هذا الرابط صالح لفترة زمنية محدودة فقط، وذلك حفاظًا على أمان حسابك.

    في حال لم تقم بطلب إعادة تعيين كلمة المرور، يمكنك تجاهل هذه الرسالة بأمان، ولن يتم إجراء أي تغيير على حسابك.

    لأي استفسار أو مساعدة، فريق SyrX جاهز لدعمك.

    مع فائق الاحترام،
    فريق SyrX
    من آثار الماضي إلى آفاق الغد، رحلة بكل خطوة.

    من الدقائق {{ config('password.expire_time') }} تنتهي صلاحية الرابط بعد
</body>

</html>
