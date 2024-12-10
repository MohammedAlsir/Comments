<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>إدارة الخلفيات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html,
        body {
            background-color: #334;
            color: #fff;
            font-family: 'Cairo', sans-serif;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 50px 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
        }

        /* تنسيق الفورم بشكل عصري */
        form.form-group {
            width: 50%;
            margin: auto;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
            margin-bottom: 40px;
            transition: all 0.3s ease;
        }

        form.form-group:hover {
            background: rgba(0, 0, 0, 0.7);
        }

        .form-control {
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #fff;
            border-radius: 5px;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .btn-primary {
            background-color: #0066cc;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #004999;
        }

        .alert {
            width: 50%;
            margin: auto;
            text-align: center;
            background: rgba(0, 128, 0, 0.8);
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .back-btn {
            text-align: center;
            margin-top: 30px;
        }

        .back-btn a {
            color: #fff;
            font-size: 1.1em;
            text-decoration: none;
            background-color: #444;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-btn a:hover {
            background-color: #222;
        }

        .images-list {
            margin-top: 50px;
        }

        /* تنسيق الكارد */
        .card {
            background: rgba(0, 0, 0, 0.7);
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
        }

        /* تحديد ارتفاع ثابت للصورة لجعل الكروت متناسقة */
        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        /* تنسيق محتوى الكارد لإبقاء الزر بالأسفل */
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            /* إبقاء الزر بأسفل الكارد */
            padding: 15px;
        }

        .btn-danger {
            background-color: #cc0000;
            border: none;
            border-radius: 5px;
        }

        .btn-danger:hover {
            background-color: #990000;
        }

        /* تأثيرات بسيطة عند تمرير الفأرة على الكارد */
        .card:hover {
            background: rgba(0, 0, 0, 0.9);
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        @media(max-width: 576px) {
            .card-img-top {
                height: 150px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>إدارة الخلفيات</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="background: rgba(128,0,0,0.8);">
                    <ul style="list-style:none;padding:0;margin:0;">
                        @foreach ($errors->all() as $error)
                            <li style="color:#fff;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-5"></div>
        <!-- نموذج إضافة صورة جديدة -->
        <form action="{{ route('backgrounds.store') }}" method="POST" class="form-group" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" class="form-control" accept="image/*" required
                placeholder="اختر صورة الخلفية">
            <button type="submit" class="btn btn-primary btn-block">حفظ الخلفية</button>
        </form>

        <!-- قائمة الصور المضافة -->
        <div class="images-list">
            <h2 class="text-center" style="margin-bottom:30px;">الصور المضافة</h2>

            @if ($backgrounds->count() > 0)
                <div class="row">
                    @foreach ($backgrounds as $bg)
                        <div class="col-sm-6 col-md-3 mb-4">
                            <div class="card h-100">
                                <img src="{{ asset($bg->image_url) }}" class="card-img-top" alt="Background Image">
                                <div class="card-body text-center">
                                    <form action="{{ route('backgrounds.destroy', $bg->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">حذف</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">لا توجد صور مضافة بعد.</p>
            @endif
        </div>

        <div class="back-btn">
            <a href="{{ route('comments.index') }}">العودة لعرض التعليقات</a>
        </div>
    </div>
</body>

</html>
