<!DOCTYPE html>
<html>
<head>
    <title>CREATE YOUR ACCOUNT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(200deg, #ffffffff 0%, #000000ff 90%);
            color: #ffffffff;
            font-family: "Segoe UI", Arial, sans-serif;
            height: 140vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between left;
        }

        .register-container {
            max-width: 500px;
            margin: auto;
            margin-bottom: auto;
            text-align: left;
            padding: 20px 20px;
        }

        h2 {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        input.form-control {
            background-color: #1b1b1b;
            border: 1px solid #555;
            color: #fff;
        }

        input.form-control:focus {
            background-color: #2a2a2a;
            border-color: #66c0f4;
            color: #fff;
            box-shadow: 0 0 5px #66c0f4;
        }

        button {
            background-color: #414141ff;
            border: none;
            color: #fff;
            width: 100%;
            padding: 10px;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #9ea0a1ff;
            color: #000000
        }

        /* Footer styling */
        footer {
            background: transparent;
            color: #999;
            font-size: 14px;
            padding: 40px 0 20px;
        }

        .footer-container {
            max-width: 1000px;
            margin: auto;
            gap: 40px;
        }

        .footer-logo img {
            width: 50px;
            margin-right: 10px;
        }

        .footer-logo span {
            font-weight: bold;
            color: #ccc;
            font-size: 18px;
        }

        .footer-logo span2 {
            font-weight: bold;
            color: #ccc;
            font-size: 14px;
            margin-bottom: 10px;
            margin-left: 2px;
        }

        .footer-links {
            display: flex;
            gap: 60px;
        }

        .footer-column a {
            display: block;
            color: #aaa;
            text-decoration: none;
            margin-bottom: 4px;
        }

        .footer-column a:hover {
            color: #fff;
            text-decoration: underline;
        }
            
    </style>
</head>
<body>

    <div class="register-container">
        <h2>Create Your Account</h2>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf
            <div class="mb-3">
                <label>Username</label>
                <input type="username" name="username" class="form-control" required>
                @error('username') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
    <div class="footer-container d-flex align-items-center justify-content-center flex-wrap">
        <div class="footer-logo d-flex align-items-center me-4 mb-3 mb-md-0">
            <img src="{{ asset('img/Meat.png') }}" alt="Meats Logo">
            <span>MAETS</span>
            <span2>©</span2>
        </div>

        <div class="footer-links d-flex flex-wrap justify-content-center">
            <div class="footer-column me-5">
                <a href="#">About Us</a>
                <a href="#">Jobs</a>
                <a href="#">Steamworks</a>
                <a href="#">Maets Distribution</a>
                <a href="#">Support</a>
            </div>
            <div class="footer-column">
                <a href="#">Privacy Policy</a>
                <a href="#">Legal</a>
                <a href="#">Subscriber Agreement</a>
                <a href="#">Refunds</a>
                <a href="#">Cookies</a>
            </div>
        </div>
    </div>
    </footer>


</body>
</html>
