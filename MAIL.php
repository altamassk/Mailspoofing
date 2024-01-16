<?php
if (isset($_POST["send"])) {
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $from = $_POST["from"];
    $name = $_POST["name"];

    if (!(filter_var($to, FILTER_VALIDATE_EMAIL) && filter_var($from, FILTER_VALIDATE_EMAIL))) {
        echo "Email address inputs invalid";
        die();
    }

    $header = "From: " . $name . " <" . $from . ">\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $retval = mail($to, $subject, $message, $header);

    if ($retval) {
        echo "Email sent.";
    } else {
        echo "Email did not send. Error: " . $retval;
    }
} else {
    echo '
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mail-Spoof (Altamas)</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="abc.css">
        <title>title</title>
        <style>
            html {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                font-family: sans-serif;
                background: linear-gradient(#8350ae, #c3cdd9);
            }

            .login-box {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 400px;
                padding: 40px;
                transform: translate(-50%, -50%);
                background: radial-gradient(#000000 rgba(188, 181, 44, 0.748));
                box-sizing: border-box;
                box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
                border-radius: 10px;
            }

            .login-box h2 {
                padding: 0;
                color: #fff;
                text-align: center;
            }

            .login-box .user-box {
                position: relative;
            }

            .login-box .user-box input {
                width: 100%;
                padding: 10px 0;
                font-size: 16px;
                color: #5c5c5c;
                margin-bottom: 30px;
                border: none;
                border-bottom: 1px solid #fff;
                outline: none;
                background: transparent;
            }

            .login-box .user-box label {
                position: absolute;
                top: 0;
                left: 0;
                padding: 0px 0;
                font-size: 16px;
                color: #fff;
                pointer-events: none;
                transition: .5s;
            }

            .login-box .user-box input:focus ~ label,
            .login-box .user-box input:valid ~ label {
                top: -20px;
                left: 0;
                color: #0bea30;
                font-size: 12px;
            }

            .login-box form a {
                position: relative;
                display: inline-block;
                padding: 10px 20px;
                color: #0bea30;
                font-size: 16px;
                text-decoration: none;
                text-transform: uppercase;
                overflow: hidden;
                transition: .5s;
                margin-top: 40px;
                letter-spacing: 4px;
            }

            .login-box a:hover {
                background: #8350ae;
                color: #8b2d2d;
                border-radius: 5px;
                box-shadow: 0 0 5px #8350ae, 0 0 25px #8350ae, 0 0 50px #8350ae, 0 0 100px #8350ae;
            }

            .login-box a span {
                position: absolute;
                display: block;
            }

            .login-box a span:nth-child(1) {
                top: 0;
                left: -100%;
                width: 100%;
                height: 2px;
                background: linear-gradient(90deg, transparent, #8350ae);
                animation: btn-anim1 1s linear infinite;
            }

            /* Rest of the CSS styling for the animation */

            @keyframes btn-anim4 {
                0% {
                    bottom: -100%;
                }
                50%,100% {
                    bottom: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h2>Spoof</h2>
            <form action="/send.php" method="post" id="emailform">
                <div class="user-box">
                    <label for="to">To:</label><br>
                    <input type="text" id="to" name="to" required><br><br>
                </div>
                <div class="user-box">
                    <label for="from">From:</label><br>
                    <input type="text" id="from" name="from" required><br><br>
                </div>
                <div class="user-box">
                    <label for="name">Name:</label><br>
                    <input type="text" id="name" name="name" required><br><br>
                </div>
                <div class="user-box">
                    <label for="subject">Subject:</label><br>
                    <input type="text" id="subject" name="subject" required><br><br>
                </div>
                <div class="user-box">
                    <label for="message">Message [HTML is supported]:</label><br>
                    <textarea rows="6" cols="40" name="message" form="emailform" required></textarea><br><br>
                </div>
                <input type="hidden" id="send" name="send" value="true">
                <input type="submit" value="Send" />
            </form>
        </div>
    </body>
    </html>';
}
?>
