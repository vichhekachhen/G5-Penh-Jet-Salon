<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.0/font/bootstrap-icons.min.css" rel="stylesheet">
<x-app-layout>
    <!-- Overall layout structure -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <!-- Main body container (unusual to have <body> inside <main>) -->

        <body class="h-screen overflow-hidden flex items-center justify-center bg-gray-100">
            <!-- Full-screen container with centered content -->
            <div class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden">
                <!-- Main application container -->
                <div class="flex-1 flex flex-col">
                    <!-- Main content area with flex layout -->
                    <main class="flex-grow flex flex-row min-h-0">

                        <!-- Contacts and chat list section -->
                        <section
                            class="flex flex-col flex-none overflow-auto w-24 hover:w-64 group lg:max-w-sm md:w-2/5 transition-all duration-300 ease-in-out sticky top-0 z-50">
                            <!-- Search box for messenger -->
                            <div class="search-box p-4 flex-none">
                                <form onsubmit="">
                                    <div class="relative">
                                        <label>
                                            <!-- Input field for search with styling -->
                                            <input
                                                class="rounded-full py-2 pr-6 pl-10 w-full border border-gray-800 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                                                type="text" value="" placeholder="Search Messenger" />
                                            <!-- Search icon -->
                                            <span class="absolute top-0 left-0 mt-2 ml-3 inline-block">
                                                <svg viewBox="0 0 24 24" class="w-6 h-6">
                                                    <path fill="#bbb"
                                                        d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                                                </svg>
                                            </span>
                                        </label>
                                    </div>
                                </form>
                            </div>
                            <!-- List of contacts with recent messages -->
                            <div class="contacts p-2 flex-1 overflow-y-scroll">
                                @foreach ($users as $user)
                                    <!-- Contact item with image and recent message -->
                                    <div
                                        class="flex justify-between items-center p-3 bg-gray-800 rounded-lg relative mb-1">
                                        <div class="w-16 h-16 relative flex flex-shrink-0">
                                            <!-- Contact's profile image -->
                                            <img class="shadow-md rounded-full w-full h-full object-cover"
                                                src="https://randomuser.me/api/portraits/women/33.jpg" alt="" />
                                        </div>
                                        <div class="flex-auto min-w-0 ml-4 mr-6 hidden md:block group-hover:block">
                                            <!-- Contact's name and recent message -->
                                            <p>{{ $user->name }}</p>
                                            <div class="flex items-center text-sm text-gray-600">
                                                <div class="min-w-0">
                                                    <p class="truncate">Hak</p>
                                                </div>
                                                <p class="ml-2 whitespace-no-wrap">1h</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        <!-- Chat section with the active conversation -->
                        <section class="flex flex-col flex-auto border-l border-gray-800">
                            <!-- Header of the chat section -->
                            <div
                                class="chat-header px-6 py-4 flex flex-row flex-none justify-between items-center shadow">
                                <div class="flex">
                                    <div class="w-12 h-12 mr-4 relative flex flex-shrink-0">
                                        <!-- Participant's profile image -->
                                        <img class="shadow-md rounded-full w-full h-full object-cover"
                                            src="https://randomuser.me/api/portraits/women/33.jpg" alt="" />
                                    </div>
                                    <div class="text-sm">
                                        <!-- Participant's name and last activity -->
                                        <p class="font-bold">{{ $user->name }}</p>
                                        <p>Active 1h ago</p>
                                    </div>
                                </div>
                                <div class="flex">
                                    <!-- Action button with Bootstrap Icon -->
                                    <a href="#"
                                        class="block rounded-full hover:bg-gray-700 bg-gray-800 w-10 h-10 p-2 ml-4 flex items-center justify-center">
                                        <i class="bi bi-exclamation-circle-fill text-blue-500 text-xl"></i>
                                    </a>
                                </div>

                            </div>
                            <!-- Body of the chat section -->
                            <div class="chat-body p-4 flex-1 overflow-y-scroll">
                                <div class="flex flex-row justify-start">
                                    <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
                                        <!-- Sender's profile image -->
                                        <img class="shadow-md rounded-full w-full h-full object-cover"
                                            src="https://randomuser.me/api/portraits/women/33.jpg" alt="" />
                                    </div>
                                    <div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
                                        <!-- Sent message with background color -->
                                        <div class="flex items-center group">
                                            <p
                                                class="px-6 py-3 rounded-t-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">
                                                Hey! How are you?
                                            </p>
                                            <button type="button"
                                                class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center">
                                                <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                                            </button>
                                        </div>

                                        <!-- Another message -->
                                        <div class="flex items-center group">
                                            <p
                                                class="px-6 py-3 rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">
                                                Shall we go for hiking this weekend?
                                            </p>
                                            <button type="button"
                                                class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center">
                                                <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <!-- Timestamp for messages -->
                                <p class="p-4 text-center text-sm text-gray-500">12:40 PM</p>
                                <div class="flex flex-row justify-end">
                                    <div class="messages text-sm text-white grid grid-flow-row gap-2">
                                        <!-- Received message with background color -->
                                        <div class="flex items-center flex-row-reverse group">
                                            <p
                                                class="px-6 py-3 rounded-t-full rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">
                                                I'm good!</p>
                                                <button type="button"
                                                class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center">
                                                <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                                            </button>
                                        </div>
                                        <!-- Another received message -->
                                        <div class="flex items-center flex-row-reverse group">
                                            <p class="px-6 py-3 rounded-l-full bg-blue-700 max-w-xs lg:max-w-md">Shall
                                                we go for hiking this weekend bro?</p>
                                                <button type="button"
                                                class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center">
                                                <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                                            </button>
                                        </div>
                                        <div class="flex items-center flex-row-reverse group">
                                            <a class="block w-64 h-64 relative flex flex-shrink-0 max-w-xs lg:max-w-md"
                                                href="#">
                                                <img class="absolute shadow-md w-full h-full rounded-l-lg object-cover"
                                                    src="https://unsplash.com/photos/8--kuxbxuKU/download?force=true&w=640"
                                                    alt="hiking" />
                                            </a>
                                            <button type="button"
                                                class="group-hover:block flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 w-8 h-8 flex items-center justify-center">
                                                <i class="bi bi-three-dots-vertical" style="line-height: 1;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer of the chat section with message input -->
                            <div class="chat-footer flex-none">
                                <div class="flex flex-row items-center p-4">
                                    <!-- Button for additional action (not specified in detail) -->
                                    <button type="button"
                                        class="flex flex-shrink-0 focus:outline-none mx-2 block text-blue-600 hover:text-blue-700 w-6 h-6">
                                        <i class="bi bi-image"></i>
                                    </button>


                                    <div class="relative flex-grow flex items-center">
                                        <label class="w-full">
                                            <!-- Input field for typing messages -->
                                            <input
                                                class="rounded-full py-2 pl-3 pr-10 w-full border border-gray-800 focus:border-gray-700 bg-gray-800 focus:bg-gray-900 focus:outline-none text-gray-200 focus:shadow-md transition duration-300 ease-in"
                                                type="text" value="" placeholder="Aa" />
                                            <!-- Button with Bootstrap Icon -->
                                            <button type="button"
                                                class="absolute right-0 top-1/2 transform -translate-y-1/2 flex flex-shrink-0 focus:outline-none block text-blue-600 hover:text-blue-700 w-6 h-6 mr-3">
                                                <i class="bi bi-emoji-smile"></i>
                                            </button>
                                        </label>
                                    </div>


                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </body>
    </main>
</x-app-layout>
