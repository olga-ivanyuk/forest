<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333333;
            line-height: 1.6;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .header {
            color: #e74c3c;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            color: #555555;
        }
        .comment {
            font-size: 14px;
            color: #333333;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            margin-top: 15px;
        }
        .footer {
            font-size: 14px;
            color: #888888;
            text-align: center;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">Привіт, {{ $profile->name }}!</div>

    <div class="message">
        Ми хочемо повідомити, що під вашим постом залишили новий коментар.
    </div>
    <div class="comment">
        <strong>Коментар:</strong>
        <p>{{ $comment->content }}</p>
    </div>

    <p>Ви можете переглянути пост за цим посиланням:</p>
    <a href="{{ $postUrl }}" style="display: inline-block; padding: 10px 15px; background-color: #3498db; color: #fff; text-decoration: none; border-radius: 5px;">Переглянути пост</a>

    <div class="footer">
        Це автоматичне повідомлення, не відповідайте на нього.
    </div>
</div>
</body>
</html>
