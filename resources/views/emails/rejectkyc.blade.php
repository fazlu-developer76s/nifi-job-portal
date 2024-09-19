<!DOCTYPE html>
<html>
<head>
    <title>KYC Rejected</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #007bff;
            font-size: 24px;
            margin: 0;
        }
        .content {
            font-size: 16px;
            color: #333333;
        }
        .content p {
            margin: 0 0 10px;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>KYC Rejected</h1>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            <p>We regret to inform you that your KYC (Know Your Customer) application has been rejected.</p>
            <p>Reason for rejection: <strong>{{ $reason }}</strong></p>
            <p>If you believe this is a mistake or if you have any further questions, please contact our support team.</p>
            <p>Thank you for your understanding.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Nera Soft. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
