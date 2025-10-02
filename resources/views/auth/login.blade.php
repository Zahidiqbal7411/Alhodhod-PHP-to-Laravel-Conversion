<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Islamic Dreams Interpretation - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c5fa8;
            --secondary-color: #f8b400;
            --accent-color: #4e9f3d;
            --dark-color: #1a2a3a;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://img.freepik.com/premium-photo/picture-mosque-with-sky-background-with-words-mosque-top_987686-24008.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            animation: backgroundPan 60s linear infinite;
        }

        @keyframes backgroundPan {
            0% {
                background-position: 0% 0%;
            }

            25% {
                background-position: 20% 10%;
            }

            50% {
                background-position: 0% 20%;
            }

            75% {
                background-position: -20% 10%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(26, 42, 58, 0.85);
            z-index: 0;
        }

        .login-container {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 400px;
            max-width: 90%;
            animation: fadeIn 0.8s ease-in-out;
        }

        .login-header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-color));
            color: white;
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }

        .login-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 28px;
        }

        .login-header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .login-header::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 100%;
            height: 40px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="%23ffffff" opacity=".25"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" fill="%23ffffff" opacity=".5"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="%23ffffff"/></svg>') no-repeat;
            background-size: cover;
            z-index: 1;
        }

        .login-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            border: 1px solid #e0e0e0;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(44, 95, 168, 0.25);
        }

        .btn-login {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border: none;
            color: white;
            padding: 12px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(44, 95, 168, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 95, 168, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .social-login {
            text-align: center;
            margin: 20px 0;
        }

        .social-login p {
            color: #666;
            font-size: 14px;
            position: relative;
        }

        .social-login p::before,
        .social-login p::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: #e0e0e0;
        }

        .social-login p::before {
            left: 0;
        }

        .social-login p::after {
            right: 0;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s;
        }

        .social-icon:hover {
            transform: translateY(-3px);
        }

        .facebook {
            background: #3b5998;
        }

        .twitter {
            background: #1da1f2;
        }

        .google {
            background: #db4437;
        }

        .login-footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #eee;
        }

        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .floating-islamic-icon {
            position: absolute;
            opacity: 0.1;
            z-index: 0;
        }

        .icon-1 {
            top: 10%;
            left: 10%;
            font-size: 80px;
            color: var(--secondary-color);
        }

        .icon-2 {
            bottom: 15%;
            right: 10%;
            font-size: 60px;
            color: var(--accent-color);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-container {
                width: 90%;
            }

            .login-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
    <!-- Floating Islamic decorative elements -->
    <i class="floating-islamic-icon icon-1 fas fa-mosque"></i>
    <i class="floating-islamic-icon icon-2 fas fa-star-and-crescent"></i>

    <div class="login-container">
        <div class="login-header">
            <h2>Alhodhod</h2>
            <p>Because your dreams are meaningful!</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif


        <div class="login-body">
            <form  method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" required
                        placeholder="Email Address">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" required
                        placeholder="Password">
                </div>
                <button type="submit" class="btn btn-login">LOGIN</button>

                <div class="social-login">
                    <p>Or login with</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon google"><i class="fab fa-google"></i></a>
                    </div>
                </div>
            </form>
        </div>

       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>

</html>