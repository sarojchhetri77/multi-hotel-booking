<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Payment Successful</title>
    <style>
        /* Custom Styles */
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .success-container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .checkmark {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #28a745;
            margin: 0 auto 20px;
            position: relative;
            animation: bounce 1s ease-in-out;
        }

        .checkmark::after {
            content: '';
            position: absolute;
            left: 30px;
            top: 50px;
            width: 25px;
            height: 50px;
            border: solid white;
            border-width: 0 5px 5px 0;
            transform: rotate(45deg);
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        .btn-home {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .btn-home:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <!-- Animated Checkmark -->
        <div class="checkmark"></div>

        <!-- Success Message -->
        <h1 class="mb-3">Booking Successful!</h1>
        <p class="mb-4">Your booking has been confirmed. Thank you for choosing us!</p>

        <!-- Button to Return Home -->
        <a href="{{url('/')}}" class="btn btn-home">Return to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>