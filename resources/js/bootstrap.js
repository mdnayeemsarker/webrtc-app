// resources/js/app.js

import axios from 'axios';
import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.axios = axios;

window.axios.defaults.baseURL = 'https://webrtc-app.test/api'; // Add base URL
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "550002fd1b151f89a1e7",
    cluster: "ap1",
    forceTLS: true,
});

window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        console.log("New Message:", e.message);
        // Append the new message to the chat window
    });
