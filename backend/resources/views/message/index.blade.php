<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.0/font/bootstrap-icons.min.css" rel="stylesheet">
<x-app-layout>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(179.7deg, rgb(248, 126, 126) -0.5%, rgb(251, 206, 143) 35.3%, rgb(184, 252, 233) 67.2%, rgb(118, 162, 229) 92.3%);
            border-radius: 9999px;
        }
    </style>
    </head>

    <body class="h-screen overflow-hidden flex items-center justify-center bg-gray-100">
        <div class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden">
            <div class="flex-1 flex flex-col">
                <main class="flex-grow flex flex-row min-h-0">
                    <!-- Contacts and chat list section -->
                    <section
                        class="flex flex-col flex-none overflow-auto w-24 hover:w-64 group lg:max-w-sm md:w-2/5 transition-all duration-300 ease-in-out sticky top-0 z-50">
                        <!-- Search box for messenger -->
                        <div class="search-box p-4 flex-none sticky top-0 z-10 bg-gray-800 border border-gray-900">
                            <form id="searchForm" onsubmit="return false;">
                                <div class="relative">
                                    <label>
                                        <!-- Input field for search with styling -->
                                        <input id="searchInput" oninput="searchContacts()"
                                            class="rounded-full py-2 pr-5 pl-10 w-full border-2 border-white-900 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                                            type="text" placeholder="Search Messenger" />
                                        <span class="absolute top-1 left-0 mt-2 ml-3 inline-block">
                                            <i class="bi bi-search text-gray-400"></i>
                                        </span>
                                    </label>
                                </div>
                            </form>
                        </div>
                        <!-- List of contacts with recent messages -->
                        <div class="contacts p-2 flex-1 overflow-y-scroll custom-scrollbar">
                            <!-- Contacts will be dynamically populated here -->
                            <div id="contactList" class="space-y-2 mb-3">
                                @foreach ($usersPermission as $usersPermission)
                                    <!-- Example contact item -->
                                    <div id="Example_User" onclick="selectContact('Example User')"
                                        class="contact-item flex justify-between items-center p-3 bg-gray-800 rounded-lg cursor-pointer">
                                        <div class="w-16 h-16 relative flex flex-shrink-0">
                                            <!-- Contact's profile image -->
                                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                                src="https://randomuser.me/api/portraits/women/33.jpg"
                                                alt="Example User" />
                                        </div>
                                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                                            <div class="flex items-center justify-between mb-2">
                                                <p class="text-left">{{ $usersPermission->name }}</p>
                                                <p class="message-time text-sm text-gray-600">1h</p>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <div class="min-w-0">
                                                    <p class="truncate recent-message">Sent you a messages</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <!-- Chat section with the active conversation -->
                    <section class="flex flex-col flex-auto border-l border-gray-800">
                        <!-- Display message or chat content -->
                        <div id="chatContainer" class="flex flex-col flex-auto overflow-y-auto">
                            <div class="flex items-center justify-center h-full">
                                <p
                                    class="text-white/30 bg-gray-500 bg-opacity-75 backdrop-blur-lg rounded-full pr-2 pl-2 select-none">
                                    Please select a contact to start chatting</p>
                            </div>
                        </div>
                    </section>
                </main>
            </div>
        </div>
        <!-- Modal for message actions -->
        <div id="messageActionModal"
            class="absolute bg-gray-800 rounded-lg p-2 hidden z-50 bg-opacity-95 backdrop-blur-lg"
            style="top: 50%; right: 20px; transform: translate(-90%, -7%); width: auto; width: 170px;">
            <div class="action-item hover:bg-gray-700 rounded w-full cursor-pointer text-white transition duration-300 ease-in-out px-4 py-2"
                onclick="copyMessage()">
                <i class="bi bi-clipboard text-blue-500 mr-2"></i> Copy
            </div>
            <div class="action-item hover:bg-gray-700 rounded w-full cursor-pointer text-white transition duration-300 ease-in-out px-4 py-2"
                onclick="editMessage()">
                <i class="bi bi-pencil-square text-green-500 mr-2"></i> Edit
            </div>
            <div class="action-item hover:bg-gray-700 rounded w-full cursor-pointer text-white transition duration-300 ease-in-out px-4 py-2"
                onclick="promptDeleteMessage()">
                <i class="bi bi-trash text-red-500 mr-2"></i> Delete
            </div>
        </div>
        <!-- Modal for delete confirmation -->
        <div id="deleteConfirmModal"
            class="z-50 fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
            <div
                class="bg-gray-800 rounded-lg p-6 w-100 ml-80 bg-opacity-95 backdrop-blur-lg flex flex-row justify-end">
                <div>
                    <p class="text-white mb-2 text-xl">Delete message!</p>
                    <p class="text-white mb-6 text-s">Are you sure you want to delete this message from chat?</p>
                    <div class="flex flex-row justify-end">
                        <p onclick="closeDeleteConfirmModal()"
                            class="border border-blue-600 text-blue-600 py-2 px-4 rounded-lg cursor-pointer mr-2 transition-transform transform hover:scale-90 hover:shadow-lg duration-300 ease-in-out select-none">
                            Cancel</p>
                        <p onclick="deleteMessage()"
                            class="text-white bg-blue-600 py-2 px-4 rounded-lg cursor-pointer transition-transform transform hover:scale-90 hover:shadow-lg duration-300 ease-in-out select-none">
                            Delete</p>
                    </div>
                </div>
            </div>
        </div>



        <script>
            let selectedMessageElement = null;
            let editMode = false;
            let currentContactId = null;

            function selectContact(contactName) {
                currentContactId = contactName.replace(/ /g, '_');
                const chatContainer = document.getElementById('chatContainer');
                chatContainer.innerHTML = `
                 <!-- Chat header -->
                    <div class="chat-header px-6 py-5 flex flex-row flex-none justify-between items-center shadow sticky top-0 z-10 bg-gray-800">
                        <!-- Back button -->
                        <div class="flex items-center">
                            <button type="button" class="rounded-full hover:bg-gray-900 focus:outline-none hover:text-gray-900 focus:ring-offset-2 focus:ring-gray-400 p-2 cursor-pointer mr-9 text-lg" onclick="backToContacts()">
                                <i class="bi bi-arrow-left text-gray-500"></i>
                            </button>

                            <!-- Profile picture and name -->
                            <div class="flex items-center">
                                <div class="w-12 h-12 mr-2 relative flex-shrink-0">
                                    <img class="shadow-md rounded-full w-full h-full object-cover" src="https://randomuser.me/api/portraits/women/33.jpg" alt="${contactName}" />
                                </div>
                                <div class="text-sm">
                                    <p class="font-bold">{${contactName}}</p>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <p class="whitespace-no-wrap message-time">Active 1h ago</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Exclamation icon -->
                        <div class="flex">
                            <a href="#">
                                <i class="bi bi-exclamation-circle-fill text-blue-600 hover:text-blue-500 text-xl"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Chat body -->
                    <div id="chatBody" class="chat-body p-4 flex-1 overflow-y-scroll custom-scrollbar">
                        <div class="flex flex-row justify-start">
                            <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
                                <img class="shadow-md rounded-full w-full h-full object-cover" src="https://randomuser.me/api/portraits/women/33.jpg" alt="${contactName}" />
                            </div>
                            <div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
                                <div class="flex items-center group">
                                    <p class="px-6 py-3 rounded-lg bg-gray-800 max-w-xs lg:max-w-md text-gray-200 break-words">
                                        Hey! How are you?!!!
                                        <span class="block text-xs text-gray-500 mt-1">12:40 PM</span>
                                    </p>
                                    <button type="button" class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center" onclick="showMessageActions(this)">
                                        <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Chat footer -->
                    <div class="chat-footer flex-none sticky bottom-0 z-10 bg-gray-800 shadow-lg z-50">
                        <div id="editMessageContainer" class="hidden p-4 bg-gray-800 text-sm text-gray-300 flex justify-between items-center">
                            <span id="editMessageText"></span>
                            <button type="button" class="text-lg rounded-full hover:bg-gray-900 focus:outline-none hover:text-gray-900 focus:ring-offset-2 focus:ring-gray-400 p-2 cursor-pointer" onclick="cancelEdit()">
                                <i class="bi bi-x-lg text-gray-500"></i>
                            </button>
                        </div>

                        <form id="messageForm" onsubmit="sendMessage(event)" class="flex flex-row items-center p-4">
                            <button type="button" class="mt-2 flex flex-shrink-0 focus:outline-none mx-2 text-blue-600 hover:text-blue-700 w-6 h-6" onclick="document.getElementById('imageInput').click();">
                                <i class="bi bi-image"></i>
                            </button>
                            <input type="file" id="imageInput" class="hidden" accept="image/*" onchange="sendImageFromFile(event)">
                            <div class="relative flex-grow flex items-center">
                                <label class="w-full relative">
                                    <input id="messageInput" class="rounded-full py-2 pl-4 pr-10 w-full border border-gray-700 bg-gray-800 focus:outline-none focus:border-blue-600 text-gray-200 transition duration-300 ease-in" type="text" placeholder="Aa" autocomplete="off"/>
                                    <button type="submit" class="absolute right-0 top-1/2 transform -translate-y-2 flex flex-shrink-0 focus:outline-none text-blue-600 hover:text-blue-700 w-6 h-6 mr-2">
                                        <i class="bi bi-send"></i>
                                    </button>
                                </label>
                            </div>
                        </form>

                        <div id="fullScreenPreview" class="fixed inset-0 bg-black bg-opacity-80 flex justify-center items-center hidden">
                            <div class="relative">
                                <img id="fullScreenImage" src="" alt="Image Preview" class="max-w-auto max-h-auto object-contain rounded-lg">
                            </div>
                        </div>
                        <button class="fixed top-4 right-4 text-white hover:text-gray-400" onclick="closeImagePreview()">
                            <i class="bi bi-x-lg"></i>
                        </button>
 
                    </div>`;
            }

            function sendMessage(event) {
                event.preventDefault();
                const messageInput = document.getElementById('messageInput');
                const chatBody = document.getElementById('chatBody');
                const messageText = messageInput.value.trim();

                if (messageText) {
                    const currentTime = new Date().toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    if (editMode && selectedMessageElement) {
                        selectedMessageElement.querySelector('.message-text').innerText = messageText;
                        updateContactRecentMessage(messageText, currentTime);
                        editMode = false;
                        document.getElementById('editMessageContainer').classList.add('hidden');
                        selectedMessageElement = null;
                    } else {
                        const messageTemplate = `
                            <div class="flex flex-row justify-end">
                                <div class="messages text-sm text-white grid grid-flow-row gap-2">
                                    <div class="flex items-center flex-row-reverse group">
                                        <p class="px-6 py-3 rounded-lg mt-1 bg-blue-700 lg:max-w-md break-words">
                                            <span class="message-text">${messageText}</span>
                                            <span class="block text-xs text-gray-300 mt-1 text-right select-none">${currentTime}</span>
                                        </p>
                                        <button type="button" class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center" onclick="showMessageActions(this)">
                                            <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>`;
                        chatBody.insertAdjacentHTML('beforeend', messageTemplate);
                        chatBody.scrollTop = chatBody.scrollHeight; // Scroll to the bottom
                        updateContactRecentMessage(messageText, currentTime);
                    }
                    messageInput.value = ''; // Clear the input field
                }
            }
            // preview
            function sendImageFromFile(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        sendMessageWithImage(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            document.addEventListener('paste', function(event) {
                const items = (event.clipboardData || event.originalEvent.clipboardData).items;
                for (const item of items) {
                    if (item.type.startsWith('image/')) {
                        const file = item.getAsFile();
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            sendMessageWithImage(e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            });

            function sendMessageWithImage(imageSrc) {
                const chatBody = document.getElementById('chatBody');
                const currentTime = new Date().toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });

                const imageTemplate = `
                <div class="flex flex-row justify-end">
                    <div class="messages text-sm text-white grid grid-flow-row gap-2">
                        <div class="flex items-center flex-row-reverse group">
                            <div class="px-2 py-2 rounded-lg mt-1 bg-blue-700 lg:max-w-md break-words">
                                <img src="${imageSrc}" alt="Image" class="max-w-full h-auto rounded cursor-pointer" onclick="previewImage(this)">
                                <span class="block text-xs text-gray-300 mt-1 text-right select-none">${currentTime}</span>
                            </div>
                            <button type="button" class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center" onclick="showMessageActions(this)">
                                <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                            </button>
                        </div>
                    </div>
                </div>`;
                chatBody.insertAdjacentHTML('beforeend', imageTemplate);
                chatBody.scrollTop = chatBody.scrollHeight; // Scroll to the bottom
            }

            function previewImage(imageElement) {
                const fullScreenPreview = document.getElementById('fullScreenPreview');
                const fullScreenImage = document.getElementById('fullScreenImage');
                fullScreenImage.src = imageElement.src;
                fullScreenPreview.classList.remove('hidden');
            }

            function closeImagePreview() {
                const fullScreenPreview = document.getElementById('fullScreenPreview');
                fullScreenPreview.classList.add('hidden');
                document.getElementById('fullScreenImage').src = '';
            }

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeImagePreview();
                }
            });

            function showMessageActions(button) {
                // Placeholder function to handle message actions
                alert('Message actions');
            }

            function updateContactRecentMessage(messageText, time) {
                // Placeholder function to handle updating the recent message in the contact list
                console.log(`Update recent message: ${messageText} at ${time}`);
            }




            function searchContacts() {
                const input = document.getElementById('searchInput').value.toLowerCase();
                const contactItems = document.querySelectorAll('.contact-item');

                contactItems.forEach(contact => {
                    const contactName = contact.innerText.toLowerCase();
                    if (contactName.includes(input)) {
                        contact.style.display = '';
                    } else {
                        contact.style.display = 'none';
                    }
                });
            }

            function showMessageActions(button) {
                selectedMessageElement = button.closest('.group');
                const modal = document.getElementById('messageActionModal');
                const rect = button.getBoundingClientRect(); // Use the button's bounding rect

                // Calculate the position of the modal
                const modalTop = rect.top + window.scrollY + rect.height;
                const modalLeft = rect.left - (modal.offsetWidth / 2) + (rect.width / 2);

                // Set the position of the modal
                modal.style.top = `${modalTop}px`;
                modal.style.left = `${modalLeft}px`;
                modal.classList.remove('hidden');

                // Event listener to close the modal when clicking outside
                document.addEventListener('click', outsideClickListener);
            }

            function closeModal() {
                document.getElementById('messageActionModal').classList.add('hidden');
                document.removeEventListener('click', outsideClickListener);
            }

            function outsideClickListener(event) {
                const modal = document.getElementById('messageActionModal');
                if (!modal.contains(event.target) && !selectedMessageElement.contains(event.target)) {
                    closeModal();
                }
            }

            function promptDeleteMessage() {
                document.getElementById('messageActionModal').classList.add('hidden');
                document.getElementById('deleteConfirmModal').classList.remove('hidden');
            }

            function closeDeleteConfirmModal() {
                document.getElementById('deleteConfirmModal').classList.add('hidden');
            }

            function deleteMessage() {
                if (selectedMessageElement) {
                    const messageText = selectedMessageElement.querySelector('.message-text').innerText;
                    selectedMessageElement.remove();
                    closeDeleteConfirmModal();
                    updateContactRecentMessage(messageText, null, true);
                }
            }

            function copyMessage() {
                if (selectedMessageElement) {
                    const messageText = selectedMessageElement.querySelector('.message-text').innerText;
                    navigator.clipboard.writeText(messageText);
                    closeModal();
                }
            }

            function editMessage() {
                if (selectedMessageElement) {
                    const messageText = selectedMessageElement.querySelector('.message-text').innerText;
                    const messageInput = document.getElementById('messageInput');
                    const editMessageContainer = document.getElementById('editMessageContainer');
                    const editMessageText = document.getElementById('editMessageText');

                    messageInput.value = messageText;
                    editMessageText.innerHTML =
                        `<div class="flex items-center">
                            <i class="bi bi-pen h-5 w-5 text-blue-500 mr-2"></i>
                            <div>
                                <span class="text-blue-500">Edit message</span><br>
                                <span class="text-xs">${messageText}</span>
                            </div>
                        </div>`;
                    editMessageContainer.classList.remove('hidden');
                    editMode = true;
                    closeModal();
                }
            }

            function cancelEdit() {
                editMode = false;
                selectedMessageElement = null;
                document.getElementById('editMessageContainer').classList.add('hidden');
                document.getElementById('messageInput').value = '';
            }

            function updateContactRecentMessage(messageText, time, isDelete = false) {
                const contactItem = document.getElementById(currentContactId);
                if (contactItem) {
                    const recentMessage = contactItem.querySelector('.recent-message');
                    const messageTime = contactItem.querySelector('.message-time');
                    if (isDelete) {
                        recentMessage.innerText = 'Message deleted';
                    } else {
                        recentMessage.innerText = `You: ${messageText}`; // Add 'You: ' prefix
                        messageTime.innerText = time ? time : 'Just now';
                    }
                }
            }


            function backToContacts() {
                const chatContainer = document.getElementById('chatContainer');
                chatContainer.innerHTML = `
                    <div class="flex items-center justify-center h-full">
                        <p class="text-white/30 bg-gray-500 bg-opacity-75 backdrop-blur-lg rounded-full  pr-2 pl-2 select-none">
                            Please select a contact to start chatting</p>
                    </div>`;
            }

            function showNotification(message) {
                const notification = document.getElementById('notification');
                notification.querySelector('#notificationText').innerText = message;
                notification.classList.remove('hidden');
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 3000);
            }
        </script>
    </body>
</x-app-layout>
