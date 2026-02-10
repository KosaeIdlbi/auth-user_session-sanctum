<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    {{ $user->name }} مرحبًا،

    شكرًا لانضمامك إلى منصة SyrX.

    لإكمال تفعيل حسابك، يرجى استخدام رمز التحقق التالي:

    <u>{{ $token }}</u>

    يرجى إدخال هذا الرمز في صفحة التحقق خلال الفترة المحددة.
    في حال انتهاء صلاحية الرمز، يمكنك طلب رمز جديد مباشرة من النظام.

    إذا لم تقم بإنشاء حساب على SyrX، يرجى تجاهل هذه الرسالة.

    نحن سعداء بانضمامك إلينا، ونتطلع لتقديم تجربة موثوقة وآمنة لك.

    مع خالص التقدير،
    فريق SyrX
    SyrX: من آثار الماضي إلى آفاق الغد، رحلة بكل خطوة.


    من الدقائق {{ config('verification.expire_time') }} تنتهي صلاحية الرمز بعد
</body>

</html>
