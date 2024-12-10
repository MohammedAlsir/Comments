<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>التعليقات</title>
    
    <!-- ربط Google Fonts - Cairo -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- ربط Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- ربط Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        html,
        body {
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

        .fb-form input::placeholder,
        .fb-form textarea::placeholder {
            color: #aaa;
            font-size: 1em;
        }

        .fb-form textarea {
            height: 120px;
            resize: none;
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

            20% {
                transform: rotate(10deg) scale(0.8);
            }

            50% {
                transform: rotate(-5deg) scale(1.1);
            }

            80% {
                transform: rotate(5deg) scale(0.9);
            }

            100% {
                transform: rotate(0deg) scale(1);
            }
        }

        /* رسالة الشكر */
        .thank-you {
            display: none;
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

        /* استجابة على حجم الشاشة */
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
   
    <div class="fb-form">
        <form id="feedback-form" class="form-group">
            <h2>أضف تعليقك</h2>
            <input class="form-control" placeholder="الاسم" type="text" required>
            <textarea class="form-control" id="fb-comment" name="comment" placeholder="اكتب تعليقك هنا" required></textarea>
            <div class="rating">
                <i class="fa fa-star" data-rating="1"></i>
                <i class="fa fa-star" data-rating="2"></i>
                <i class="fa fa-star" data-rating="3"></i>
                <i class="fa fa-star" data-rating="4"></i>
                <i class="fa fa-star" data-rating="5"></i>
            </div>
            <input class="form-control btn btn-primary" type="submit" value="اضف التعليق">
        </form>
    </div>

    <div class="thank-you">
        <h2>شكرًا لك!</h2>
        <p>لقد تم استلام تعليقك بنجاح. نحن نقدر وقتك وملاحظاتك.</p>
    </div>

    <!-- ربط jQuery و Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
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

            // التعامل مع إرسال النموذج
            const form = document.getElementById('feedback-form');
            const thankYouMessage = document.querySelector('.thank-you');

            form.addEventListener('submit', function (e) {
                e.preventDefault(); // منع إعادة تحميل الصفحة
                // هنا يمكنك إضافة كود لإرسال البيانات إلى الخادم إذا لزم الأمر

                // إخفاء النموذج وعرض رسالة الشكر
                document.querySelector('.fb-form').style.display = 'none';
                thankYouMessage.style.display = 'block';
            });
        });
    </script>
</body>

</html>
