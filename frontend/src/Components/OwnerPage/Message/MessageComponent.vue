<template>
  <div id="app">
    <div class="sidebar">
      <div class="search-bar">
        <input type="text" v-model="searchQuery" placeholder="Search" />
      </div>
      <div class="message-list">
        <div
          class="message-item"
          v-for="message in filteredMessages"
          :key="message.id"
          @click="selectMessage(message)"
          :class="{ selected: selectedMessage === message }"
        >
          <img :src="message.avatar" alt="Avatar" class="avatar" />
          <div class="message-info">
            <div class="name">{{ message.name }}</div>
            <div class="text" v-html="truncatedText(message.text)"></div>
          </div>
          <div class="date">{{ message.date }}</div>
        </div>
        <div v-if="filteredMessages.length === 0" class="no-results">
          No matching messages found.
        </div>
      </div>
    </div>
    <div class="chat-area" v-if="selectedMessage">
      <div class="chat-header">
        <div class="contact-info">
          <div class="contact-name">{{ selectedMessage.name }}</div>
          <div class="contact-status">Last seen recently</div>
        </div>
      </div>
      <div class="chat-content">
        <div class="chat-message" v-for="msg in selectedMessage.chat" :key="msg.id">
          <div :class="['chat-bubble', msg.sender === 'me' ? 'my-message' : 'their-message']">
            <p>{{ msg.text }}</p>
            <div class="timestamp">{{ msg.date }}</div>
          </div>
        </div>
      </div>
      <div class="chat-input-container">
        <input
          type="text"
          v-model="newMessage"
          @keyup.enter="sendMessage"
          placeholder="Write a message..."
          aria-label="Write a message"
          class="chat-input"
        />
        <button @click="sendMessage" class="send-button" aria-label="Send message">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="currentColor"
            class="send-icon"
          >
            <path d="M2 21l21-9L2 3v7l15 2-15 2z" />
          </svg>
        </button>
      </div>
    </div>
    <div class="chat-area" v-else>
      <h3>Select a message to view its content</h3>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      messages: [
        {
          id: 1,
          name: 'Khav Saroeurn',
          date: '12/02/2024',
          text: 'Hey! Are u free?',
          avatar:
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS785biEGWYfQ3kCbvts_QRuNPn7IJpvovN4A&s',
          chat: [{ id: 1, sender: 'them', text: 'Hey! Are u free?' }]
        },
        {
          id: 2,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
        },
        {
          id: 3,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
        },
        {
          id: 4,
          name: 'Tem Ley',
          date: '12/02/2024',
          text: 'Mk ot ng hor',
          avatar:
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVFSAv41c8I_YuS8C_Wd0maf8kSN9y0oISIV_zfr0sGeyyFql5diYralDX5BvIHrprxTI&usqp=CAU',
          chat: [{ id: 1, sender: 'them', text: 'Mk ot ng hor' }]
        },
        {
          id: 5,
          name: 'Vicheka Chhen',
          date: '12/02/2024',
          text: 'Are you sure?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/3371/3371977.png',
          chat: [{ id: 1, sender: 'them', text: 'Are you sure?' }]
        },
        {
          id: 6,
          name: 'Joe Biden',
          date: '12/02/2024',
          text: 'Os rank ot yub ng ha?',
          avatar:
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT58-VVT8Wch6ligqL9BVGs4hHtZ2ChZeURvA&s',
          chat: [{ id: 1, sender: 'them', text: 'Os rank ot yub ng ha?' }]
        },
        {
          id: 7,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
        },
        {
          id: 8,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
        },
        {
          id: 9,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
        },
        {
          id: 10,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
        },
        {
          id: 11,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [{ id: 1, sender: 'them', text: 'Did u come?' }]
        },
        {
          id: 12,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [{ id: 1, sender: 'them', text: 'Hey! free ot?' }]
        }
      ],
      selectedMessage: null,
      newMessage: '',
      searchQuery: ''
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
    }
  },
  methods: {
    selectMessage(message) {
      this.selectedMessage = message
    },
    sendMessage() {
      if (this.newMessage.trim()) {
        const newMsg = {
          id: Date.now(),
          sender: 'me',
          text: this.newMessage,
          date: new Date().toLocaleString()
        }
        this.selectedMessage.chat.push(newMsg)
        this.selectedMessage.text = `<strong style="color: blue;">You: ${this.newMessage}</strong>` // Update the preview text in the sidebar
        this.selectedMessage.date = newMsg.date // Update the date in the message list
        this.newMessage = ''
      }
    },
    truncatedText(text) {
      const words = text.split(' ')
      if (words.length > 5) {
        return words.slice(0, 5).join(' ') + '...'
      }
      return text
    }
  }
}
</script>

<style scoped>
body {
  margin: 0;
  font-family: 'Arial', sans-serif;
  background-color: #f5f5f5; /* Light gray background */
  color: #333; /* Dark text */
}

#app {
  display: flex;
  height: 100vh;
}

.sidebar {
  width: 400px; /* Increase sidebar width */
  background-color: #ffffff; /* White sidebar */
  border-right: 1px solid #ddd; /* Light gray border */
  display: flex;
  flex-direction: column;
}

.search-bar {
  padding: 10px;
  background-color: #f0f0f0; /* Light gray search bar */
  border-bottom: 1px solid #ddd; /* Light gray border */
}

.search-bar input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd; /* Light gray border */
  border-radius: 5px;
  background-color: #ffffff; /* White search input */
  color: #333; /* Dark text */
}

.message-list {
  flex: 1;
  overflow-y: auto;
}

.message-item {
  display: flex;
  align-items: center;
  padding: 10px; /* Increase padding for larger item size */
  cursor: pointer;
  transition: background-color 0.2s;
  word-wrap: break-word;
  width: 100%; 
  box-sizing: border-box; 
}

.message-item:hover,
.message-item.selected {
  background-color: #9e9fa06d; /* Light blue on hover/selected */
}

.avatar {
  width: 60px; /* Increase avatar size */
  height: 60px; /* Increase avatar size */
  border-radius: 50%;
  margin-right: 20px; /* Increase margin for better spacing */
}

.message-info {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.name {
  font-weight: bold;
  font-size: 18px; /* Increase font size */
  color: #333; /* Dark text */
}

.text {
  font-size: 16px; /* Increase font size */
  color: #777; /* Gray text */
  overflow: hidden; /* Hide overflow */
  text-overflow: ellipsis; /* Add ellipsis for overflow text */
  white-space: nowrap; /* Prevent text from wrapping */
}

.date {
  font-size: 14px; /* Increase font size */
  color: #999; /* Light gray date */
}

.chat-area {
  flex: 1;
  display: flex;
  flex-direction: column;
  background-color: #ffffff; /* White chat area */
}

.chat-header {
  padding: 15px;
  background-color: #f0f0f0; /* Light gray header */
  border-bottom: 1px solid #ddd; /* Light gray border */
  display: flex;
  align-items: center;
}

.contact-info {
  margin-left: 10px;
}

.contact-name {
  font-size: 18px;
  font-weight: bold;
  color: #333; /* Dark text */
}

.contact-status {
  font-size: 12px;
  color: #999; /* Light gray status */
}

.chat-content {
  flex: 1;
  padding: 15px;
  overflow-y: auto;
  background-color: #f5f5f5; /* Light gray chat content */
  border-top: 1px solid #ddd; /* Light gray border */
  margin: 10px;
  padding-bottom: 30px;
}

.chat-message {
  display: flex;
  flex-direction: column;
  margin-bottom: 10px;
}

.chat-bubble {
  padding: 10px 15px;
  border-radius: 20px;
  max-width: 80%;
  word-wrap: break-word;
  font-size: 14px;
  position: relative;
}

.my-message {
  background-color: #4873e2; /* Blue message background */
  color: white;
  align-self: flex-end;
}

.their-message {
  background-color: #e6e6e6; /* Light gray message background */
  color: #333; /* Dark text */
  align-self: flex-start;
}

.timestamp {
  font-size: 12px;
  color: #353434dd; /* Light gray timestamp */
  position: absolute;
  bottom: 10px;
  right: 10px;
}

.chat-input {
  display: flex;
  padding: 10px;
  background-color: #f0f0f0; /* Light gray chat input */
  border-top: 1px solid #ddd; /* Light gray border */
}

.chat-input input {
  flex: 1;
  border: 1px solid #ddd; /* Light gray border */
  padding: 10px;
  border-radius: 5px;
  background-color: #ffffff; /* White input background */
  color: #333; /* Dark text */
}

.chat-input input:focus {
  outline: none;
  border-color: #007bff; /* Blue focus border */
}

.chat-input button {
  background: none;
  border: none;
  cursor: pointer;
  margin-left: 10px;
}

.chat-input button svg {
  fill: #007bff; /* Blue send button */
}

.no-results {
  padding: 20px;
  text-align: center;
  color: #999; /* Light gray no results text */
}

.chat-input-container {
  display: flex;
  align-items: center;
  padding: 10px;
  border-top: 1px solid #ccc;
}

.chat-input {
  flex-grow: 1;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

.send-button {
  background-color: #007bff;
  border: none;
  padding: 10px;
  margin-left: 10px;
  border-radius: 4px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}

.send-button:hover {
  background-color: #0056b3;
}

.send-icon {
  fill: #fff;
}
</style>
