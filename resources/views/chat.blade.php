<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Real-Time Chat</title>
    {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @vite('resources/js/app.js')
</head>

<body>
    <h1>Real-Time Chat</h1>

    <div id="chat-container" style="border: 1px solid #ccc; padding: 10px; height: 80vh; overflow-y: auto;">
    </div>

    <br>

    <form id="message-form">
        <input type="text" id="message-input" placeholder="Type your message..." required>
        <button type="submit">Send</button>
    </form>

    {{-- <script>
        const token = @json($token);
        document.addEventListener("DOMContentLoaded", () => {
            const chatContainer = document.getElementById('chat-container');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');

            async function fetchMessages() {
                try {
                    const response = await axios.get('/messages/1', {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });
                    response.data.messages.forEach((message) => {
                        const messageElement = document.createElement('p');
                        messageElement.textContent = `${message.user.name}: ${message.message}`;
                        chatContainer.appendChild(messageElement);
                    });

                    chatContainer.scrollTop = chatContainer.scrollHeight;
                } catch (error) {
                    console.error('Error fetching messages:', error.response || error.message);
                }
            }
            fetchMessages();

            window.Echo.channel('chat')
                .listen('MessageSent', (e) => {
                    console.log("New message received:", e);
                    const messageElement = document.createElement('p');
                    messageElement.textContent = `${e.user.name}: ${e.message}`;
                    chatContainer.appendChild(messageElement);
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });
            messageForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const message = messageInput.value.trim();
                if (!message) return;

                try {
                    await axios.post('/messages/send', {
                        message: message,
                        conversation_id: 1
                    }, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });

                    messageInput.value = '';
                } catch (error) {
                    console.error('Error sending message:', error.response || error.message);
                }
            });
        });
    </script> --}}
    {{-- <script>
        const token = @json($token);
        document.addEventListener("DOMContentLoaded", () => {
            const chatContainer = document.getElementById('chat-container');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');

            // Function to fetch previous messages when the page loads
            async function fetchMessages() {
                try {
                    const response = await axios.get('/messages/1', {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });

                    // Check if there are any messages returned
                    if (response.data.messages && response.data.messages.length > 0) {
                        // Append previous messages to the chat container
                        response.data.messages.forEach((message) => {
                            const messageElement = document.createElement('p');
                            messageElement.textContent = `${message.user.name}: ${message.message}`;
                            chatContainer.appendChild(messageElement);
                        });
                    } else {
                        console.log("No previous messages found.");
                    }

                    // Scroll to the bottom after adding all previous messages
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                } catch (error) {
                    console.error('Error fetching messages:', error.response || error.message);
                }
            }

            // Call the function to fetch previous messages
            fetchMessages();

            // Listen for real-time messages through Pusher and Echo
            window.Echo.channel('chat')
                .listen('MessageSent', (e) => {
                    console.log("New message received:", e);

                    // Create a new message element and append it to the chat container
                    const messageElement = document.createElement('p');
                    messageElement.textContent = `${e.user.name}: ${e.message}`;
                    chatContainer.appendChild(messageElement);

                    // Scroll to the bottom to show the latest message
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });

            // Send a new message when the form is submitted
            messageForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const message = messageInput.value.trim();
                if (!message) return;

                try {
                    // Send the new message to the backend
                    const response = await axios.post('/messages/send', {
                        message: message,
                        conversation_id: 1
                    }, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });

                    // Log the response to ensure the message was sent
                    console.log('Message sent:', response.data);

                    // Clear the input field after sending the message
                    messageInput.value = '';
                } catch (error) {
                    console.error('Error sending message:', error.response || error.message);
                }
            });
        });
    </script> --}}

    {{-- <script>
        const token = @json($token); // You should pass the token from your Blade template
        document.addEventListener("DOMContentLoaded", () => {
            const chatContainer = document.getElementById('chat-container');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');

            // Function to fetch previous messages
            async function fetchMessages() {
                try {
                    const response = await axios.get('/messages/1', {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });

                    // Append previous messages to the chat container
                    if (response.data.messages && response.data.messages.length > 0) {
                        response.data.messages.forEach((message) => {
                            const messageElement = document.createElement('p');
                            messageElement.textContent = `${message.user.name}: ${message.message}`;
                            chatContainer.appendChild(messageElement);
                        });
                    }

                    // Scroll to the bottom after loading previous messages
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                } catch (error) {
                    console.error('Error fetching messages:', error.response || error.message);
                }
            }

            fetchMessages(); // Initial fetch of messages

            // Listen for real-time messages from the Pusher channel
            window.Echo.channel('chat')
                .listen('MessageSent', (e) => {
                    console.log("New message received:", e);

                    // Create a new message element and append it to the chat container
                    const messageElement = document.createElement('p');
                    messageElement.textContent = `${e.user.name}: ${e.message}`;
                    chatContainer.appendChild(messageElement);

                    // Scroll to the bottom when a new message is received
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });

            // Submit new message
            messageForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const message = messageInput.value.trim();
                if (!message) return;

                try {
                    const response = await axios.post('/messages/send', {
                        message: message,
                        conversation_id: 1
                    }, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });

                    // Clear the message input after submission
                    messageInput.value = '';
                } catch (error) {
                    console.error('Error sending message:', error.response || error.message);
                }
            });
        });
    </script> --}}
    <script>
        const token = @json($token);
        document.addEventListener("DOMContentLoaded", () => {
            const chatContainer = document.getElementById('chat-container');
            const messageForm = document.getElementById('message-form');
            const messageInput = document.getElementById('message-input');
            async function fetchMessages() {
                try {
                    const response = await axios.get('/messages/1', {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });
                    if (response.data.messages) {
                        response.data.messages.forEach((message) => {
                            const messageElement = document.createElement('p');
                            messageElement.textContent = `${message.user.name}: ${message.message}`;
                            chatContainer.appendChild(messageElement);
                        });
                    }
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                } catch (error) {
                    console.error('Error fetching messages:', error.response || error.message);
                }
            }

            fetchMessages();
            window.Echo.channel('chat')
                .listen('MessageSent', (e) => {
                    console.log("New message received:", e);
                    const messageElement = document.createElement('p');
                    messageElement.textContent = `${e.user.name}: ${e.message}`;
                    chatContainer.appendChild(messageElement);
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                });
            messageForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const message = messageInput.value.trim();
                if (!message) return;

                try {
                    await axios.post('/messages/send', {
                        message: message,
                        conversation_id: 1
                    }, {
                        headers: {
                            Authorization: `Bearer ${token}`
                        }
                    });
                    messageInput.value = '';
                } catch (error) {
                    console.error('Error sending message:', error.response || error.message);
                }
            });
        });
    </script>

</body>

</html>
