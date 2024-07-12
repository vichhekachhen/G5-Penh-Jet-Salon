<template>
    <!-- Main template structure -->
  
    <body class="bg-gray-100 text-gray-800 select-none">
      <!-- Root div containing the app -->
      <div id="app" class="flex h-screen flex-col md:flex-row">
        <!-- Sidebar container, hidden on mobile when a message is selected -->
        <div
          class="['sidebar w-full md:w-1/3 bg-white border-r border-gray-300 flex flex-col', { 'hidden md:flex': selectedMessage }]">
          <!-- Search bar at the top of the sidebar -->
          <div class="p-4 border-b border-gray-300 bg-gray-200 flex items-center h-16">
            <div class="relative w-full">
              <svg xmlns="http://www.w3.org/2000/svg"
                class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
              <input type="text" v-model="searchQuery" placeholder="Search"
                class="w-full p-2 pl-10 rounded bg-white border border-gray-300 focus:outline-none focus:border-blue-500" />
            </div>
          </div>
          <!-- Message list container with overflow handling -->
          <div class="message-list flex-1 overflow-y-auto custom-scrollbar">
            <!-- Loop through filteredMessages to display each message -->
            <div v-for="(message) in filteredMessages" :key="message.id">
              <!-- Individual message item -->
              <div class="message-item flex items-center p-4 hover:bg-gray-200 cursor-pointer"
                @click="selectMessage(message)" :class="{ 'bg-gray-200': selectedMessage === message }">
                <!-- Avatar image -->
                <img :src="message.avatar" alt="Avatar" class="avatar w-12 h-12 rounded-full mr-4" />
                <!-- Message info (name and text preview) -->
                <div class="message-info flex-1">
                  <div class="name font-semibold">{{ message.name }}</div>
                  <div class="text text-sm text-gray-500 truncate" :title="message.text">{{ truncatedText(message.text) }}
                  </div>
                </div>
                <!-- Message date -->
                <div class="date text-xs text-gray-400">{{ message.date }}</div>
              </div>
            </div>
            <!-- Display if no matching messages found -->
            <div v-if="filteredMessages.length === 0" class="no-results p-4 text-center text-gray-400">
              No matching messages found.
            </div>
          </div>
        </div>
        <!-- Chat area, shown when a message is selected -->
        <div class="chat-area flex-1 flex flex-col" v-if="selectedMessage">
          <!-- Chat header with back button (visible on mobile) and contact info -->
          <div class="chat-header p-4 bg-gray-200 border-b border-gray-300 flex items-center h-16">
            <i class="bi bi-arrow-left text-xl mr-3 cursor-pointer hover:text-blue-500"
              @click="selectedMessage = null"></i>
            <div class="relative inline-block w-13 h-13">
              <img :src="profile" alt="Profile Image" class="w-full h-full rounded-full">
              <span class="absolute bottom-0 right-0 block w-4 h-4 bg-green-500 rounded-full"></span>
            </div>
            <div class="contact-info ml-4">
              <div class="contact-name font-semibold">{{ selectedMessage.name }}</div>
              <div class="contact-status text-sm text-gray-500">Last seen recently</div>
            </div>
          </div>
          <!-- Chat content area displaying messages -->
          <div class="chat-content flex-1 p-4 overflow-y-auto bg-gray-100 custom-scrollbar">
            <div class="chat-message mb-4 flex relative" v-for="msg in selectedMessage.chat" :key="msg.id"
              @contextmenu.prevent="onRightClick($event, msg)">
              <div
                :class="['chat-bubble pl-4 pr-4 pt-2 pb-2 rounded-lg max-w-xs', msg.sender === 'me' ? 'bg-blue-500 text-white ml-auto' : 'bg-gray-200 text-gray-800']">
                <p>{{ msg.text }}</p>
                <div class="timestamp text-xs text-gray-500 mt-1 text-right ml-auto color-white">{{ msg.date }}</div>
              </div>
              <!-- Dropdown menu for edit/delete options -->
              <div v-if="showDropdown && dropdownMessage === msg"
                class="absolute right-0 mt-2 w-32 bg-white border border-gray-300 rounded shadow-md z-50">
                <button @click="editMessage" class="block w-full text-left p-2 hover:bg-gray-100">Edit</button>
                <button @click="confirmDeleteMessage"
                  class="block w-full text-left p-2 hover:bg-red-100 text-red-500">Delete</button>
              </div>
            </div>
          </div>
          <!-- Chat input container at the bottom -->
          <div
            class="chat-input-container p-4 bg-gray-200 flex flex-col items-center border-t border-gray-300 sticky bottom-0">
            <!-- Display old message if editing -->
            <div v-if="isEditing"
              class="old-message w-full p-2 mb-2 bg-white border border-gray-300 rounded text-gray-600 flex items-center justify-between">
              <span>Editing: "{{ editingMessage.text }}"</span>
              <i @click="cancelEditing" class="bi bi-x text-xl cursor-pointer hover:text-red-500"></i>
            </div>
            <div class="flex items-center w-full">
              <input type="text" v-model="newMessage" @keyup.enter="sendMessage" placeholder="Write a message..."
                aria-label="Write a message"
                class="chat-input flex-1 p-2 rounded bg-white border border-gray-300 focus:outline-none focus:border-blue-500" />
              <button @click="sendMessage" class="send-button ml-4 p-2 rounded bg-blue-500 hover:bg-blue-600 text-white"
                aria-label="Send message">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"
                  class="send-icon">
                  <path d="M2 21l21-9L2 3v7l15 2-15 2z" />
                </svg>
              </button>
            </div>
          </div>
        </div>
        <!-- Placeholder area when no message is selected -->
        <div class="chat-area flex-1 flex items-center justify-center bg-gray-100 text-gray-800" v-else>
          <h3 class="color-gray font-normal">Select a message to view its content</h3>
        </div>
      </div>
    </body>
  </template>
  
  <script>
  export default {
    name: 'App',
    data() {
      return {
        // Messages data
        avatar: '',
        messages: [
          {
            id: 1,
            name: 'Khav Saroeurn',
            date: '04:14 PM',
            text: 'Hey! Are u free?',
            avatar: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS785biEGWYfQ3kCbvts_QRuNPn7IJpvovN4A&s',
            chat: [{ id: 1, sender: 'them', text: 'Hey! Are u free?' }]
          },
          {
            id: 2,
            name: 'Makara Try',
            date: '04:14 PM',
            text: 'Did u come?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
            chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
          },
          {
            id: 3,
            name: 'Veak Khlop',
            date: '04:14 PM',
            text: 'Hey! free ot?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
            chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
          },
          {
            id: 4,
            name: 'Tem Ley',
            date: '04:14 PM',
            text: 'Mk ot ng hor',
            avatar:
              'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVFSAv41c8I_YuS8C_Wd0maf8kSN9y0oISIV_zfr0sGeyyFql5diYralDX5BvIHrprxTI&usqp=CAU',
            chat: [{ id: 1, sender: 'them', text: 'Mk ot ng hor' }]
          },
          {
            id: 5,
            name: 'Vicheka Chhen',
            date: '04:14 PM',
            text: 'Are you sure?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/3371/3371977.png',
            chat: [{ id: 1, sender: 'them', text: 'Are you sure?' }]
          },
          {
            id: 6,
            name: 'Joe Biden',
            date: '04:14 PM',
            text: 'Os rank ot yub ng ha?',
            avatar:
              'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT58-VVT8Wch6ligqL9BVGs4hHtZ2ChZeURvA&s',
            chat: [{ id: 1, sender: 'them', text: 'Os rank ot yub ng ha?' }]
          },
          {
            id: 7,
            name: 'Makara Try',
            date: '04:14 PM',
            text: 'Did u come?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
            chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
          },
          {
            id: 8,
            name: 'Veak Khlop',
            date: '04:14 PM',
            text: 'Hey! free ot?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
            chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
          },
          {
            id: 9,
            name: 'Makara Try',
            date: '04:14 PM',
            text: 'Did u come?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
            chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
          },
          {
            id: 10,
            name: 'Veak Khlop',
            date: '04:14 PM',
            text: 'Hey! free ot?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
            chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
          },
          {
            id: 11,
            name: 'Makara Try',
            date: '04:14 PM',
            text: 'Did u come?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
            chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
          },
          {
            id: 12,
            name: 'Veak Khlop',
            date: '04:14 PM',
            text: 'Hey! free ot?',
            avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
            chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
          }
        ],
        selectedMessage: null, // Currently selected message
        newMessage: '', // New message input
        searchQuery: '', // Search query input
        showDropdown: false,
        dropdownMessage: null,
        editingMessage: null, // Currently editing message
      }
    },
    computed: {
      // Filter messages based on search query
      filteredMessages() {
        if (!this.searchQuery) {
          return this.messages
        }
        const lowerCaseQuery = this.searchQuery.toLowerCase()
        return this.messages.filter(
          (message) =>
            message.name.toLowerCase().includes(lowerCaseQuery) ||
            message.text.toLowerCase().includes(lowerCaseQuery)
        )
      },
      profile() {
        return this.avatar
      },
      // Check if we are in editing mode
      isEditing() {
        return this.editingMessage !== null;
      }
    },
    methods: {
      // Select a message to view
      selectMessage(message) {
        this.selectedMessage = message
        this.avatar = message.avatar
        return this.avatar
      },
      // Send a new message or update an existing one
      sendMessage() {
        if (this.newMessage.trim()) {
          if (this.editingMessage) {
            // Update the existing message
            this.editingMessage.text = this.newMessage
            this.editingMessage.date = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            this.editingMessage = null // Clear editing state
          } else {
            // Create a new message
            const newMsg = {
              id: Date.now(),
              sender: 'me',
              text: this.newMessage,
              date: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
            }
            this.selectedMessage.chat.push(newMsg)
            this.selectedMessage.text = `You: ${this.newMessage}` // Update the preview text in the sidebar
            this.selectedMessage.date = new Date(newMsg.date).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
          }
          this.newMessage = '' // Clear input
        }
      },
      // Cancel editing
      cancelEditing() {
        this.editingMessage = null;
        this.newMessage = '';
      },
      // Truncate text for display in the sidebar
      truncatedText(text) {
        const maxLength = 45
        if (text.length > maxLength) {
          return text.slice(0, maxLength) + ' ...'
        }
        return text
      },
      // Right-click handler to show dropdown
      onRightClick(event, msg) {
        if (msg.sender === 'me') {
          this.showDropdown = true
          this.dropdownMessage = msg
          // Position the dropdown at the cursor location
          const dropdown = event.currentTarget.querySelector('.dropdown-menu')
          dropdown.style.top = `${event.clientY}px`
          dropdown.style.left = `${event.clientX}px`
        }
      },
      // Close dropdown
      closeDropdown() {
        this.showDropdown = false
        this.dropdownMessage = null
      },
      // Edit message
      editMessage() {
        this.newMessage = this.dropdownMessage.text
        this.editingMessage = this.dropdownMessage
        this.closeDropdown()
      },
      // Confirm delete message
      confirmDeleteMessage() {
        if (confirm('Are you sure you want to delete this message?')) {
          this.deleteMessage()
        }
        this.closeDropdown()
      },
      // Delete message
      deleteMessage() {
        const index = this.selectedMessage.chat.indexOf(this.dropdownMessage)
        if (index !== -1) {
          this.selectedMessage.chat.splice(index, 1)
        }
        this.dropdownMessage = null
      }
    }
  }
  </script>
  
  <style scoped>
  /* Additional styles for better responsiveness */
  @media (max-width: 768px) {
    .sidebar {
      display: none;
    }
  
    .sidebar.md\\:flex {
      display: flex;
    }
  
    .chat-area {
      flex: 1;
      width: 100%;
    }
  }
  
  /* Ensure word wrapping and overflow handling */
  .chat-bubble {
    word-wrap: break-word;
    word-break: break-word;
    overflow-wrap: break-word;
  }
  
  /* Add truncation with ellipses for long text */
  .message-info .text {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    /* number of lines to show */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  
  /* Custom scrollbar styles */
  .custom-scrollbar::-webkit-scrollbar {
    width: 2px;
    /* Initial width of the scrollbar */
  }
  
  .custom-scrollbar::-webkit-scrollbar-track {
    background: #f1f1f1;
  }
  
  .custom-scrollbar::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
  }
  
  .custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: #555;
  }
  </style>