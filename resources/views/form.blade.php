<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التعليقات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            width: 100%;
            background-color: #334;
            overflow: hidden;
            color: white;
            font-family: 'Cairo', sans-serif;
        }
        .fb-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .fb-form h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .fb-form input,
        .fb-form textarea {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .rating {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .fa-star {
            font-size: 2.5em;
            cursor: pointer;
            margin: 0 7px;
            transition: color 0.3s ease, transform 0.3s ease;
            color: #ccc;
        }

        .fa-star.active-rating,
        .fa-star:hover,
        .fa-star:hover ~ .fa-star {
            color: yellow;
        }

        .fa-star.animate {
            animation: rating-highlight 0.5s ease forwards;
        }

        @keyframes rating-highlight {
            0% {
                transform: rotate(-10deg) scale(1.2);
                color: yellow;
            }

            100% {
                transform: rotate(0deg) scale(1);
            }
        }

        .thank-you {
            @if(!session('success'))
                display: none;
            @endif
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            padding: 30px;
            background-color: rgba(0, 128, 0, 0.8);
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .thank-you h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #fff;
        }

        .thank-you p {
            font-size: 1.2em;
            color: #f0f0f0;
        }

        @media (max-width: 576px) {
            .fb-form,
            .thank-you {
                padding: 20px;
            }

            .fa-star {
                font-size: 2em;
                margin: 0 5px;
            }

            .fb-form h2,
            .thank-you h2 {
                font-size: 1.5em;
            }

            .fb-form input,
            .fb-form textarea {
                font-size: 1em;
                padding: 10px;
            }

            .thank-you p {
                font-size: 1em;
            }
        }
    </style>
</head>

<body>

    @if(session('success'))
        <div class="thank-you">
            <h2>شكرًا لك!</h2>
            <p>{{ session('success') }}</p>
        </div>
    @else
        <div class="fb-form">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="feedback-form" class="form-group" action="{{ route('comments.store') }}" method="POST">
                @csrf
                <h2>أضف تعليقك</h2>
                <input class="form-control" name="user_name" placeholder="الاسم" type="text">
                <textarea class="form-control" name="comment" placeholder="اكتب تعليقك هنا" required></textarea>
                <div class="rating">
                    <i class="fa fa-star" data-rating="1"></i>
                    <i class="fa fa-star" data-rating="2"></i>
                    <i class="fa fa-star" data-rating="3"></i>
                    <i class="fa fa-star" data-rating="4"></i>
                    <i class="fa fa-star" data-rating="5"></i>
                </div>
                <input type="hidden" name="rating" id="rating-value" value="0">
                <input class="form-control btn btn-primary" type="submit" value="اضف التعليق">
            </form>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.fa-star');
            let rating = 0;

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    rating = index + 1;
                    updateStars();
                    star.classList.add('animate');
                    setTimeout(() => {
                        star.classList.remove('animate');
                    }, 500);
                    document.getElementById('rating-value').value = rating;
                });

                star.addEventListener('mouseover', () => {
                    highlightStars(index);
                });

                star.addEventListener('mouseout', () => {
                    highlightStars(rating - 1);
                });
            });

            function updateStars() {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.add('active-rating');
                    } else {
                        star.classList.remove('active-rating');
                    }
                });
            }

            function highlightStars(index) {
                stars.forEach((star, i) => {
                    if (i <= index) {
                        star.classList.add('active-rating');
                    } else {
                        star.classList.remove('active-rating');
                    }
                });
            }
        });
    </script>
</body>
</html>
