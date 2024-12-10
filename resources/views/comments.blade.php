<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض التعليقات</title>
    <!-- خطوط -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            width: 100%;
            background-color: #334;
            color: white;
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .comments-title {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 40px;
            font-weight: 700;
        }

        .comment-card {
            background-color: rgba(0,0,0,0.7);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .comment-user {
            font-size: 1.3em;
            font-weight: 700;
            color: #fff;
        }

        .comment-rating .fa-star {
            color: yellow;
            margin: 0 3px;
        }

        .comment-text {
            font-size: 1.1em;
            line-height: 1.6em;
            color: #f0f0f0;
            white-space: pre-wrap; /* لعرض النصوص كما أدخلت */
        }

        .no-comments {
            text-align: center;
            font-size: 1.5em;
            color: #ddd;
            margin-top: 50px;
        }

        .back-btn {
            text-align: center;
            margin-top: 30px;
        }

        .back-btn a {
            color: #fff;
            font-size: 1.1em;
            text-decoration: none;
            background-color: #0066cc;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-btn a:hover {
            background-color: #004999;
        }

        @media (max-width: 576px) {
            .comment-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .comment-user {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="comments-title">التعليقات</h1>

        @if(session('success'))
            <div class="alert alert-success text-center" style="background-color:rgba(0,128,0,0.8); color:#fff; border:none; box-shadow:0 0 10px rgba(0,0,0,0.5);">
                {{ session('success') }}
            </div>
        @endif

        @if($comments->count() > 0)
            @foreach($comments as $comment)
                <div class="comment-card">
                    <div class="comment-header">
                        <div class="comment-user">
                            {{ $comment->user_name ?? 'مستخدم مجهول' }}
                        </div>
                        <div class="comment-rating">
                            @for($i=1; $i<=$comment->rating; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            @for($i=$comment->rating+1; $i<=5; $i++)
                                <i class="fa fa-star" style="color:#555;"></i>
                            @endfor
                        </div>
                    </div>
                    <div class="comment-text">
                        {{ $comment->comment }}
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-comments">لا توجد تعليقات بعد.</div>
        @endif

       
    </div>

</body>
</html>
