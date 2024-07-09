<template>
  <div id="app">
    <div class="message-list">
      <div class="header">All Messages</div>
      <div
        v-for="message in messages"
        :key="message.id"
        class="message-item"
        @click="selectMessage(message)"
      >
        <img :src="message.avatar" alt="Avatar" class="avatar" />
        <div class="message-info">
          <div class="name">{{ message.name }}</div>
          <div class="text"><li class="text1 color-blue">You : </li>{{ message.text }}</div>
        </div>
        <div class="date">{{ message.date }}</div>
      </div>
    </div>
    <div class="message-content" v-if="selectedMessage">
      <div class="header">
        <img :src="selectedMessage.avatar" alt="Avatar" class="avatar" />
        <div class="name">{{ selectedMessage.name }}</div>
      </div>
      <div class="chat-content">
        <div class="chat-message" v-for="msg in selectedMessage.chat" :key="msg.id">
          <div :class="['chat-bubble', msg.sender === 'me' ? 'my-message' : 'their-message']">
            {{ msg.text }}
          </div>
        </div>
      </div>
      <div class="chat-input">
        <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message..." />
        <button @click="sendMessage" class="send-button">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            class="send-icon"
          >
            <path fill="currentColor" d="M2 21l21-9L2 3v7l15 2-15 2z" />
          </svg>
        </button>
      </div>
    </div>
    <div class="message-content" v-else>
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
          chat: [
            { id: 1, sender: 'them', text: 'Hey! Are u free?' },
            { id: 2, sender: 'me', text: 'Yes, I am free.' }
          ]
        },
        {
          id: 2,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [
            { id: 1, sender: 'them', text: 'Did u come?' },
            { id: 2, sender: 'me', text: 'Yes, I am here.' }
          ]
        },
        {
          id: 3,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [
            { id: 1, sender: 'them', text: 'Hey! free ot?' },
            { id: 2, sender: 'me', text: 'Yes, I am free.' }
          ]
        },
        {
          id: 4,
          name: 'Tem Ley',
          date: '12/02/2024',
          text: 'Mk ot ng hor',
          avatar:
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQVFSAv41c8I_YuS8C_Wd0maf8kSN9y0oISIV_zfr0sGeyyFql5diYralDX5BvIHrprxTI&usqp=CAU',
          chat: [
            { id: 1, sender: 'them', text: 'Mk ot ng hor' },
            { id: 2, sender: 'me', text: 'Yes, I am here.' }
          ]
        },
        {
          id: 5,
          name: 'Vicheka Chhen',
          date: '12/02/2024',
          text: 'Are you sure?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/3371/3371977.png',
          chat: [
            { id: 1, sender: 'them', text: 'Are you sure?' },
            { id: 2, sender: 'me', text: 'Yes, I am sure.' }
          ]
        },
        {
          id: 6,
          name: 'Joe Biden',
          date: '12/02/2024',
          text: 'Os rank ot yub ng ha?',
          avatar:
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT58-VVT8Wch6ligqL9BVGs4hHtZ2ChZeURvA&s',
          chat: [
            { id: 1, sender: 'them', text: 'Os rank ot yub ng ha?' },
            { id: 2, sender: 'me', text: 'Yes, I am here.' }
          ]
        },
        {
          id: 7,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [
            { id: 1, sender: 'them', text: 'Did u come?' },
            { id: 2, sender: 'me', text: 'Yes, I am here.' }
          ]
        },
        {
          id: 8,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [
            { id: 1, sender: 'them', text: 'Hey! free ot?' },
            { id: 2, sender: 'me', text: 'Yes, I am free.' }
          ]
        },
        {
          id: 9,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [
            { id: 1, sender: 'them', text: 'Did u come?' },
            { id: 2, sender: 'me', text: 'Yes, I am here.' }
          ]
        },
        {
          id: 10,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [
            { id: 1, sender: 'them', text: 'Hey! free ot?' },
            { id: 2, sender: 'me', text: 'Yes, I am free.' }
          ]
        },
        {
          id: 11,
          name: 'Makara Try',
          date: '12/02/2024',
          text: 'Did u come?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/1253/1253756.png',
          chat: [
            { id: 1, sender: 'them', text: 'Did u come?' },
            { id: 2, sender: 'me', text: 'Yes, I am here.' }
          ]
        },
        {
          id: 12,
          name: 'Veak Khlop',
          date: '12/02/2024',
          text: 'Hey! free ot?',
          avatar: 'https://cdn-icons-png.flaticon.com/512/4975/4975733.png',
          chat: [
            { id: 1, sender: 'them', text: 'Hey! free ot?' },
            { id: 2, sender: 'me', text: 'Yes, I am free.' }
          ]
        }
      ],
      selectedMessage: null,
      newMessage: ''
    }
  },
  methods: {
    selectMessage(message) {
      this.selectedMessage = message
    },
    sendMessage() {
      if (this.newMessage.trim() !== '') {
        this.selectedMessage.chat.push({
          id: Date.now(),
          sender: 'me',
          text: this.newMessage
        })
        this.newMessage = ''
      }
    }
  }
}
</script>

<style>
#app {
  display: flex;
  height: 100vh;
  font-family: 'Arial', sans-serif;
}

.message-list {
  width: 350px;
  background-color: #ffffff;
  border-right: 1px solid #dddfe2;
  overflow-y: auto;
}

.message-list .header {
  padding: 15px;
  background-color: #f5f6f7;
  font-size: 20px;
  font-weight: bold;
  color: #1c1e21;
  border-bottom: 1px solid #dddfe2;
}

.message-item {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.message-item:hover {
  background-color: #f0f2f5;
}

.avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-right: 15px;
  object-fit: cover;
  flex-shrink: 0; /* Ensure avatars don't shrink */
}

.message-info {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.name {
  font-weight: bold;
  color: #050505;
}

.text {
  color: #65676b;
  font-size: 14px;
}

.date {
  font-size: 12px;
  color: #90949c;
}

.message-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  background-color: #ffffff;
  overflow: hidden;
}

.message-content .header {
  display: flex;
  align-items: center;
  padding: 15px;
  background-color: #f5f6f7;
  border-bottom: 1px solid #dddfe2;
}

.message-content .header .avatar {
  width: 40px;
  height: 40px;
  margin-right: 10px;
  flex-shrink: 0; /* Ensure avatars don't shrink */
}

.message-content .header .name {
  font-weight: bold;
  color: #1c1e21;
}

.chat-content {
  flex: 1;
  padding: 15px;
  overflow-y: auto;
  background-color: #e4e6eb;
  max-height: calc(100vh - 140px); /* Adjust max-height as needed */
}

.chat-message {
  display: flex;
  margin-bottom: 10px;
}

.chat-bubble {
  display: inline-block;
  padding: 10px 15px;
  border-radius: 20px;
  max-width: 60%;
  word-wrap: break-word;
  font-size: 14px;
  line-height: 1.4;
}

.my-message {
  background-color: #0084ff;
  color: white;
  align-self: flex-end;
}

.their-message {
  background-color: #ffffff;
  color: #050505;
  align-self: flex-start;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.chat-input {
  display: flex;
  padding: 10px;
  border-top: 1px solid #dddfe2;
  background-color: #f5f6f7;
}

.chat-input input {
  flex: 1;
  border: none;
  padding: 10px;
  border-radius: 20px;
  margin-right: 10px;
  background-color: #e4e6eb;
  font-size: 14px;
}

.chat-input input:focus {
  outline: none;
  background-color: #ffffff;
}

.chat-input button {
  background: none;
  border: none;
  cursor: pointer;
  padding: 0;
  margin-left: 10px;
}

.chat-input button svg {
  fill: #0084ff;
  width: 24px;
  height: 24px;
  padding: 8px;
  border-radius: 50%;
  background-color: #0084ff;
}

.chat-input button svg:hover {
  background-color: #0060af;
}
</style>
