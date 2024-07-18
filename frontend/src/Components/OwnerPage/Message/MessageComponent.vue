<template>
  <div class="bg-gray-100 text-gray-800 select-none h-screen flex flex-col md:flex-row" @click="closeDropdown">
    <!-- Sidebar containing message list -->
    <div :class="['w-full md:w-1/3 bg-white border-r border-gray-300 flex flex-col', { 'hidden md:flex': selectedMessage }]">
      <!-- Search bar -->
      <div class="p-4 mb-1 bg-gray-200 flex items-center h-16">
        <div class="relative w-full">
          <i class="bi bi-search absolute left-3 top-4.5 transform -translate-y-1/2 h-5 w-5 text-gray-400"></i>
          <input type="text" v-model="searchQuery" placeholder="Search"
            class="w-full p-2 pl-10 pr-5 rounded-80 bg-white border border-gray-300 focus:outline-none focus:border-blue-500" />
        </div>
      </div>
      <!-- Message list -->
      <div class="flex-1 overflow-y-auto custom-scrollbar">
        <div v-for="list in filteredlistUsers" :key="list.id" class="flex items-center p-4 hover:bg-gray-200 cursor-pointer"
          @click="selectMessage(list)">
          <img :src="baseURL + list.profile" alt="Avatar" class="w-12 h-12 rounded-full mr-4 object-cover" />
          <div class="flex-1">
            <div class="font-semibold">{{ list.name }}</div>
            <p>{{ list.message }}</p>
          </div>
        </div>
        <div v-if="filteredlistUsers.length === 0" class="p-4 text-center text-gray-400">
          No matching users found.
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
    <div class="flex-1 flex flex-col" v-if="selectedMessage">
      <!-- Chat header -->
      <div class="p-4 bg-gray-200 flex items-center h-16">
        <i class="bi bi-arrow-left text-xl mr-3 cursor-pointer hover:text-blue-500" @click="selectedMessage = null"></i>
        <div class="relative inline-block w-13 h-13">
          <img :src="baseURL + selectedMessage.profile" alt="Profile Image" class="w-full h-full rounded-full object-cover">
          <span class="absolute bottom-0 right-0 block w-4 h-4 bg-green-500 rounded-full"></span>
        </div>
        <div class="ml-4">
          <div class="font-semibold">{{ selectedMessage.name }}</div>
          <div class="text-sm text-gray-500">Active</div>
        </div>
      </div>
      <!-- Chat content -->
      <div class="flex-1 p-4 overflow-y-auto bg-gray-100 custom-scrollbar">
        <div class="mb-4 flex relative" v-for="msg in selectedMessage.chat" :key="msg.id"
          @contextmenu.prevent="onRightClick($event, msg)" @mousedown.right="onRightClick($event, msg)">
          <div
            :class="['pl-4 pr-4 pt-2 pb-2 rounded-lg max-w-xs', msg.sender === 'me' ? 'bg-blue-500 text-white ml-auto' : 'bg-gray-200 text-gray-800']">
            <p>{{ msg.text }}</p>
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
      <div class="p-4 bg-gray-200 flex flex-col items-center sticky bottom-0">
        <div v-if="isEditing" class="w-full p-2 mb-2 rounded text-gray-600 flex items-center justify-between">
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
            class="flex-1 p-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500" />
          <i class="bi bi-send-fill hover:color-blue-600 color-blue-500 ml-4 p-2" style="font-size: 1.3rem;"
            @click="sendMessage"></i>
        </div>
      </div>
    </div>
    <!-- Placeholder for no selected message -->
    <div class="flex-1 flex items-center justify-center bg-gray-100 text-gray-800" v-else>
      <h3 class="color-gray font-normal">Select a chat to start messaging</h3>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import baseURL from '../../../api/url'

export default {
  data() {
    return {
      baseURL,
      listUsers: [],
      listSender: [],
      selectedMessage: null,
      showDropdown: false,
      dropdownMessage: null,
      searchQuery: '',
      newMessage: '',
      editingMessage: null,
      showNotification: false
    }
  },
  computed: {
    filteredlistUsers() {
      if (!this.searchQuery) {
        return this.listUsers;
      }
      const lowerCaseQuery = this.searchQuery.toLowerCase();
      return this.listUsers.filter(
        (message) =>
          message.name.toLowerCase().includes(lowerCaseQuery) ||
          message.text.toLowerCase().includes(lowerCaseQuery)
      );
    },
    isEditing() {
      return this.editingMessage !== null;
    }
  },
  methods: {
    selectMessage(message) {
      this.selectedMessage = message;
    },
    submit() {
      console.log('Form submitted');
    },
    sendMessage() {
      if (this.newMessage.trim()) {
        if (this.editingMessage) {
          this.editingMessage.text = this.newMessage;
          this.editingMessage.date = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
          this.editingMessage = null;
        } else {
          const newMsg = {
            id: Date.now(),
            sender: 'me',
            text: this.newMessage,
            date: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
          };
          this.selectedMessage.chat.push(newMsg);
          this.selectedMessage.message = `You: ${this.newMessage}`;
          this.selectedMessage.date = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }
        this.newMessage = '';
      }
    },
    cancelEditing() {
      this.editingMessage = null;
      this.newMessage = '';
    },
    onRightClick(event, msg) {
      if (msg.sender === 'me') {
        this.showDropdown = true;
        this.dropdownMessage = msg;
        event.stopPropagation();
      }
    },
    closeDropdown() {
      this.showDropdown = false;
      this.dropdownMessage = null;
    },
    editMessage() {
      this.newMessage = this.dropdownMessage.text;
      this.editingMessage = this.dropdownMessage;
      this.closeDropdown();
    },
    confirmDeleteMessage() {
      if (confirm('Are you sure you want to delete this message?')) {
        this.deleteMessage();
      }
      this.closeDropdown();
    },
    deleteMessage() {
      const index = this.selectedMessage.chat.indexOf(this.dropdownMessage);
      if (index !== -1) {
        this.selectedMessage.chat.splice(index, 1);
      }
      this.dropdownMessage = null;
    },
    copyText(text) {
      navigator.clipboard.writeText(text).then(() => {
        this.showNotification = true;
        setTimeout(() => {
          this.showNotification = false;
        }, 2000);
      }, () => {
        alert('Failed to copy text.');
      });
      this.closeDropdown();
    },
    async fetchlistUsers() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/getChat');
        this.listUsers = response.data.data;
      } catch (error) {
        console.error('Error fetching listUsers:', error);
      }
    },
    async listSenders() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/sender');
        this.listSender = response.data.data;
      } catch (error) {
        console.error('Error fetching listSenders:', error);
      }
    }
  },
  mounted() {
    this.fetchlistUsers();
    this.listSenders();
  }
}
</script>

<style scoped>
/* Additional styles for better responsiveness */
@media (max-width: 768px) {
  .sidebar {
    display: none;
  }

  .sidebar.md\:flex {
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
