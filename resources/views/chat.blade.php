<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel + ChatGPT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #007bff, #6610f2);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .chat-container {
            background-color: #ffffff;
            color: #000;
            border-radius: 20px;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
            width: 450px;
            padding: 25px 30px;
        }

        h2 {
            text-align: center;
            color: #343a40;
            font-weight: 600;
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 120px;
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 10px;
            resize: none;
            outline: none;
            transition: 0.3s;
        }

        textarea:focus {
            border-color: #6610f2;
            box-shadow: 0 0 8px rgba(102, 16, 242, 0.3);
        }

        button {
            width: 100%;
            border-radius: 10px;
        }

        #response {
            margin-top: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            color: #212529;
            min-height: 60px;
            white-space: pre-wrap;
        }

        .loader {
            display: none;
            text-align: center;
            margin-top: 15px;
        }

        .loader span {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin: 0 3px;
            background-color: #6610f2;
            border-radius: 50%;
            animation: bounce 1.3s infinite;
        }

        .loader span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .loader span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
            }

            40% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <h2>Laravel + ChatGPT 🤖</h2>

        <textarea id="prompt" placeholder="Type your question here..."></textarea>
        <button class="btn btn-primary mt-3" onclick="sendMessage()">Send</button>

        <div class="loader" id="loader">
            <span></span><span></span><span></span>
        </div>

        <div id="response" class="mt-3"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        async function sendMessage() {
            const prompt = document.getElementById('prompt').value.trim();
            const responseBox = document.getElementById('response');
            const loader = document.getElementById('loader');

            if (!prompt) {
                responseBox.innerHTML = "<span class='text-danger'>Please enter a question.</span>";
                return;
            }

            responseBox.innerHTML = "";
            loader.style.display = "block";

            try {
                const res = await fetch('/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        prompt
                    })
                });

                const text = await res.text(); // read raw text first
                let data;
                try {
                    data = JSON.parse(text); // try parse JSON
                } catch (e) {
                    // Not JSON — show raw response for debugging
                    throw new Error(`Non-JSON response (status ${res.status}): ${text}`);
                }

                if (!res.ok) {
                    // server returned 4xx/5xx with JSON body
                    const msg = data.message || JSON.stringify(data);
                    throw new Error(`Request failed (status ${res.status}): ${msg}`);
                }

                // Success
                responseBox.innerText = data.response ?? JSON.stringify(data);

            } catch (error) {
                console.error('Chat error:', error);
                responseBox.innerHTML = `<span class="text-danger">Something went wrong! ${error.message}</span>`;
            } finally {
                loader.style.display = "none";
            }
        }
    </script>

</body>

</html>