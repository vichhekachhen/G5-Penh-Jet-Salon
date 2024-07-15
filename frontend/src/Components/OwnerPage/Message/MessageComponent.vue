<template>

  <body class="bg-gray-100 text-gray-800 select-none" @click="closeDropdown">
    <div id="app" class="flex h-screen flex-col md:flex-row">
      <!-- Sidebar containing message list -->
      <div
        :class="['sidebar w-full md:w-1/3 bg-white border-r border-gray-300 flex flex-col', { 'hidden md:flex': selectedMessage }]">
        <!-- Search bar -->
        <div class="p-4 mb-1 bg-gray-200 flex items-center h-16">
          <div class="relative w-full">
            <i class="bi bi-search absolute left-3 top-4.5 transform -translate-y-1/2 h-5 w-5 text-gray-400"></i>
            <input type="text" v-model="searchQuery" placeholder="Search"
              class="w-full p-2 pl-10 pr-5 rounded-80 bg-white border border-gray-300 focus:outline-none focus:border-blue-500" />
          </div>
        </div>
        <!-- Message list -->
        <div class="message-list flex-1 overflow-y-auto custom-scrollbar">
          <div v-for="(message) in filteredMessages" :key="message.id">
            <div class="message-item flex items-center p-4 hover:bg-gray-200 cursor-pointer"
              @click="selectMessage(message)" :class="{ 'bg-gray-200': selectedMessage === message }">
              <img :src="message.avatar" alt="Avatar" class="avatar w-12 h-12 rounded-full mr-4 object-cover" />
              <div class="message-info flex-1">
                <div class="name font-semibold">{{ message.name }}</div>
                <div class="text text-sm text-gray-500 truncate" :title="message.text">{{ truncatedText(message.text) }}
                </div>
              </div>
              <div class="date text-xs text-gray-400">{{ message.date }}</div>
            </div>
          </div>
          <div v-if="filteredMessages.length === 0" class="no-results p-4 text-center text-gray-400">
            No matching messages found.
          </div>
        </div>
        <!-- Copy notification -->
        <div v-if="showNotification"
          class="fixed bottom-22 left-2/3 transform -translate-x-1/2 mb-5 p-3 rounded-lg bg-gray-800 bg-opacity-50 text-white shadow-lg flex items-center backdrop-blur-lg">
          <i class="bi bi-clipboard-check mr-2"></i>
          Text copied to clipboard!
        </div>

      </div>
      <!-- Chat area -->
      <div class="chat-area flex-1 flex flex-col" v-if="selectedMessage">
        <!-- Chat header -->
        <div class="chat-header p-4 bg-gray-200 flex items-center h-16">
          <i class="bi bi-arrow-left text-xl mr-3 cursor-pointer hover:text-blue-500"
            @click="selectedMessage = null"></i>
          <div class="relative inline-block w-13 h-13">
            <img :src="profile" alt="Profile Image" class="w-full h-full rounded-full object-cover">
            <span class="absolute bottom-0 right-0 block w-4 h-4 bg-green-500 rounded-full"></span>
          </div>
          <div class="contact-info ml-4">
            <div class="contact-name font-semibold">{{ selectedMessage.name }}</div>
            <div class="contact-status text-sm text-gray-500">Active</div>
          </div>
        </div>
        <!-- Chat content -->
        <div class="chat-content flex-1 p-4 overflow-y-auto bg-gray-100 custom-scrollbar">
          <div class="chat-message mb-4 flex relative" v-for="msg in selectedMessage.chat" :key="msg.id"
            @contextmenu.prevent="onRightClick($event, msg)" @mousedown.right="onRightClick($event, msg)">
            <div
              :class="['chat-bubble pl-4 pr-4 pt-2 pb-2 rounded-lg max-w-xs', msg.sender === 'me' ? 'bg-blue-500 text-white ml-auto' : 'bg-gray-200 text-gray-800']">
              <p>{{ msg.text }}</p>
              <div class="timestamp text-xs text-gray-500 mt-1 text-right ml-auto color-white">{{ msg.date }}</div>
            </div>
            <!-- Context menu -->
            <div v-if="showDropdown && dropdownMessage === msg"
              class="absolute right-2 mt-16 w-40 bg-black rounded shadow-md z-50">
              <button @click="copyText(msg.text)"
                class="flex items-center w-full text-left p-2 transition-colors rounded duration-300 hover:bg-gray-700 hover:text-white">
                <i class="bi bi-files"></i>
                <span class="ml-2">Copy Text</span>
              </button>
              <button @click="editMessage"
                class="flex items-center w-full text-left p-2 transition-colors rounded duration-300 hover:bg-gray-700 hover:text-white">
                <i class="bi bi-pen"></i>
                <span class="ml-2">Edit</span>
              </button>
              <button @click="confirmDeleteMessage"
                class="flex items-center w-full text-left p-2 transition-colors rounded duration-300 hover:bg-red-700 hover:text-white text-red-500">
                <i class="bi bi-trash"></i>
                <span class="ml-2">Delete</span>
              </button>
            </div>

          </div>
        </div>
        <!-- Chat input -->
        <div class="chat-input-container p-4 bg-gray-200 flex flex-col items-center sticky bottom-0">
          <div v-if="isEditing"
            class="old-message w-full p-2 mb-2 rounded text-gray-600 flex items-center justify-between">
            <div class="flex items-center">
              <i class="bi bi-pen h-5 w-5 text-blue-500 mr-2"></i>
              <div>
                <span class="text-blue-500">Edit message</span><br>
                <span class="text-gray-600">{{ editingMessage.text }}</span>
              </div>
            </div>
            <i @click="cancelEditing" class="bi bi-x text-xl cursor-pointer hover:text-red-500"></i>
          </div>
          <!-- input message  -->
          <div class="flex items-center w-full">
            <input type="text" v-model="newMessage" @keyup.enter="sendMessage" placeholder="Write a message..."
              aria-label="Write a message"
              class="chat-input flex-1 p-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" />
            <i class="bi bi-send-fill hover:color-blue-600 color-blue-500 ml-4 p-2" style="font-size: 1.3rem;"
              @click="sendMessage"></i>
          </div>

        </div>
      </div>
      <!-- Placeholder for no selected message -->
      <div class="chat-area flex-1 flex items-center justify-center bg-gray-100 text-gray-800" v-else>
        <h3 class="color-gray font-normal">Select a chat to start messaging</h3>
      </div>
    </div>
  </body>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      avatar: '',
      messages: [
        {
          id: 1,
          name: 'Hunii 💗🌹',
          date: '04:14 PM',
          text: 'Doing b sml 💗😢',
          avatar: 'https://i.pinimg.com/564x/5f/90/57/5f90575a969a1e737eaa0b4054b9bfe7.jpg',
          chat: [{ id: 1, sender: 'them', text: 'Doing b sml 💗😢' }]
        },
      ],
      selectedMessage: null,
      newMessage: '',
      searchQuery: '',
      showDropdown: false,
      dropdownMessage: null,
      editingMessage: null,
      showNotification: false,
    }
  },
  computed: {
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
    isEditing() {
      return this.editingMessage !== null;
    }
  },
  methods: {
    selectMessage(message) {
      this.selectedMessage = message
      this.avatar = message.avatar
      return this.avatar
    },
    sendMessage() {
      if (this.newMessage.trim()) {
        if (this.editingMessage) {
          this.editingMessage.text = this.newMessage
          this.editingMessage.date = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
          this.editingMessage = null
        } else {
          const newMsg = {
            id: Date.now(),
            sender: 'me',
            text: this.newMessage,
            date: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
          }
          this.selectedMessage.chat.push(newMsg)
          this.selectedMessage.text = `You: ${this.newMessage}`
          this.selectedMessage.date = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
        }
        this.newMessage = ''
      }
    },
    cancelEditing() {
      this.editingMessage = null;
      this.newMessage = '';
    },
    truncatedText(text) {
      const maxLength = 45
      if (text.length > maxLength) {
        return text.slice(0, maxLength) + ' ...'
      }
      return text
    },
    onRightClick(event, msg) {
      if (msg.sender === 'me') {
        this.showDropdown = true
        this.dropdownMessage = msg
        event.stopPropagation()
      }
    },
    closeDropdown() {
      this.showDropdown = false
      this.dropdownMessage = null
    },
    editMessage() {
      this.newMessage = this.dropdownMessage.text
      this.editingMessage = this.dropdownMessage
      this.closeDropdown()
    },
    confirmDeleteMessage() {
      if (confirm('Are you sure you want to delete this message?')) {
        this.deleteMessage()
      }
      this.closeDropdown()
    },
    deleteMessage() {
      const index = this.selectedMessage.chat.indexOf(this.dropdownMessage)
      if (index !== -1) {
        this.selectedMessage.chat.splice(index, 1)
      }
      this.dropdownMessage = null
    },
    copyText(text) {
      navigator.clipboard.writeText(text).then(() => {
        this.showNotification = true;
        setTimeout(() => {
          this.showNotification = false;
        }, 2000); // Show notification for 2 seconds
      }, () => {
        alert('Failed to copy text.')
      })
      this.closeDropdown()
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