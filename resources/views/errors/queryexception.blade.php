<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>لغو عملیات</title>
    <style>
        @font-face {
            font-family: iransans;
            src: url(/fonts/iransans.woff2) format("woff2");
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            /* Light red background */
            text-align: center;
            padding: 50px;
            color: #000;
            font-family: "iransans";
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #990000;
            /* Red text */
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }
    </style>
</head>

<body>
    <h1>لغو عملیات</h1>
    <p>این مورد در بخش دیگری از سایت استفاده شده و نمیتوان آن را ویرایش یا حذف کرد</p>
    <div style="display: flex; justify-content: center">
        <a href="{{ request()->headers->get('referer') }}"
            style="text-decoration: none;background-color: #28a745; color: white; font-family: iransans, sans-serif; border: none; padding: 10px 20px; border-radius: 5px;">
            بازگشت
        </a>
    </div>
</body>

</html>