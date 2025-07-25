document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const chatForm = document.getElementById('chatForm');
    const searchForm = document.getElementById('searchForm');
    const messageInput = document.getElementById('messageInput');
    const messagesContainer = document.getElementById('messagesContainer');

    // Handle login
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(loginForm);
            fetch('src/controllers/authController.php?action=login', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'chat.html';
                } else {
                    alert(data.message);
                }
            });
        });
    }

    // Handle registration
    if (registerForm) {
        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(registerForm);
            fetch('src/controllers/authController.php?action=register', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Registration successful! Please log in.');
                    window.location.href = 'login.html';
                } else {
                    alert(data.message);
                }
            });
        });
    }

    // Handle chat message sending
    if (chatForm) {
        chatForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const message = messageInput.value;
            if (message.trim() === '') return;

            fetch('src/controllers/chatController.php?action=sendMessage', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ message })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageInput.value = '';
                    loadMessages(); // Reload messages after sending
                } else {
                    alert(data.message);
                }
            });
        });
    }

    // Load messages
    function loadMessages() {
        fetch('src/controllers/chatController.php?action=getMessages')
        .then(response => response.json())
        .then(data => {
            messagesContainer.innerHTML = '';
            data.messages.forEach(msg => {
                const msgElement = document.createElement('div');
                msgElement.textContent = msg.content;
                messagesContainer.appendChild(msgElement);
            });
        });
    }

    // Search users
    if (searchForm) {
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const searchQuery = document.getElementById('searchQuery').value;
            fetch(`src/controllers/userController.php?action=search&query=${searchQuery}`)
            .then(response => response.json())
            .then(data => {
                // Handle displaying search results
                console.log(data);
            });
        });
    }
});