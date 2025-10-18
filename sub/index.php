<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ClassLink</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            margin-top: 50px;
            font-family: "Courier New", Courier, monospace;
            font-size: 24px;
            letter-spacing: 1px;
            white-space: pre;
        }

        .container {
            margin-top: 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        a.button {
            background-color: #444;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border: 2px solid #666;
            border-radius: 8px;
            transition: background-color 0.3s, border-color 0.3s;
            cursor: pointer;
        }

        a.button:hover {
            background-color: #666;
            border-color: #888;
        }

        #cursor {
            display: inline-block;
            opacity: 1;
        }

        @keyframes blink {
            0%, 100% { opacity: 0; }
            50% { opacity: 1; }
        }
    </style>
</head>
<body>
    <h1><span id="typed-text"></span><span id="cursor">█</span></h1>

    <div class="container">
        <?php
        $dirs = array_filter(glob('*'), 'is_dir');

        if (empty($dirs)) {
            echo "<h3>[-- SECTOR EMPTY --]</h3>";
        } else {
            foreach ($dirs as $dir) {
                echo '<a class="button" data-href="' . htmlspecialchars($dir) . '">' . htmlspecialchars($dir) . '</a>';
            }
        }
        ?>
    </div>

    <script>
        const message = "hi";
        const textSpan = document.getElementById("typed-text");
        const cursor = document.getElementById("cursor");
        let i = 0;

        function type() {
            if (i < message.length) {
                textSpan.textContent += message.charAt(i);
                i++;
                setTimeout(type, 75);
            } else {
                cursor.style.animation = "blink 0.5s step-end infinite";
                setTimeout(() => {
                    cursor.style.display = "none";
                }, 2000);
            }
        }

        window.addEventListener("load", type);

        const buttons = document.querySelectorAll(".button");
        buttons.forEach(btn => {
            btn.addEventListener("click", (e) => {
                e.preventDefault();

                const destination = btn.getAttribute("data-href");
                let dotState = 0;
                let dotInterval;
                let duration = Math.random() * 2 + 2;

                cursor.style.display = "none";
                textSpan.textContent = "transferring";

                dotInterval = setInterval(() => {
                    dotState = (dotState + 1) % 4;
                    textSpan.textContent = "transferring" + ".".repeat(dotState);
                }, 200);

                setTimeout(() => {
                    clearInterval(dotInterval);
                    window.location.href = destination;
                }, duration * 100);
            });
        });
    </script>
</body>
</html>
