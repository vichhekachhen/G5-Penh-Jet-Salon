<template>
  <div class="pt-5">
    <!-- Product Details Section -->
    <div class="background-gradient">
      <div class="container color-black mt-5">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
              <div class="row g-0">
                <div class="col-md-6">
                  <div class="product-image">
                    <img
                      :src="baseURL + serviceStore.service.image"
                      alt="Product Image"
                      class="img-fluid rounded"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-body order-primary">
                    <h1 class="card-title">
                      <i class="bi bi-amd p-2"></i>{{ serviceStore.service.service_name }}
                    </h1>
                    <div class="description mb-3">
                      <h4>Description</h4>
                      <p>{{ serviceStore.service.description }}</p>
                    </div>
                    <div class="detail mb-3">
                      <h4>Details</h4>
                      <p>
                        Original price: <b>${{ serviceStore.service.price }}</b>
                      </p>
                      <p>
                        Discount price: <b>${{ serviceStore.service.discount }}</b>
                      </p>
                      <!-- <p>Data start: {{ serviceStore.service.created_at }}</p> -->
                    </div>
                    <div class="buttons">
                      <router-link to="/listService/1">
                        <button class="btn btn-info me-2">Back</button>
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- Comments Section -->
  <section class="py-10">
    <div class="container mt-5 color-black">
      <h2><i class="bi bi-chat-left-text p-3"></i>Comments</h2>
      <div v-for="comment in useComment.comments" :key="comment.id" class="comment-box mb-4">
        <div class="d-flex align-items-start">
          <img :src="baseURL + comment.user_profile" alt="User Avatar" class="rounded-circle me-3" width="50" />
          <div class="flex-grow-1">
            <div class="d-flex justify-content-between">
              <p class="mb-1">
                <strong>{{ comment.user_name }}</strong>
              </p>
              <div>
                <button class="btn btn-secondary btn-sm me-2" @click="replyTo(comment)">
                  Reply
                </button>
                <button class="btn btn-danger btn-sm" @click="removeComment(comment.id)">
                  Remove
                </button>
              </div>
            </div>
            <p>{{ comment.text }}</p>
            <img v-if="comment.image" :src="baseURL + comment.image" alt="User Avatar" class="rounded-circle me-3" width="50" />
            <div v-if="comment.replies && comment.replies.length" class="mb-3">
              <div v-for="reply in comment.replies" :key="reply.id" class="mb-2 card">
                <div class="d-flex align-items-start pt-3 reply p-3">
                  <img v-if="reply.owner.profile" :src="baseURL + reply.owner.profile" alt="User Avatar" class="rounded-circle me-3" width="50" />
                  <div class="flex-grow-1 ">
                    <p class="mb-1">
                      <b>{{ reply.owner.name }}</b>
                    </p>
                    <div class="d-flex justify-content-end">
                      <button class="btn btn-danger btn-sm" @click="removeReply(reply.id)">
                        Remove
                      </button>
                    </div>
                    <p>{{ reply.text }}</p>
                    <img v-if="reply.owner.image" :src="baseURL + reply.owner.image" class="rounded-square" />
                  </div>
                </div>
              </div>
            </div>
            <div v-if="comment.showReplyBox" class="mb-3">
              <input
                type="text"
                class="form-control"
                placeholder="Add a reply..."
                v-model="replyText"
                @keyup.enter="addReply(comment)"
              />
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center mt-4 p-3" style="background-color: #f0f0f0">
        <div class="input-group mb-2">
          <!-- <input class="form-control" type="file" id="formFile" @change="handleFileUpload" /> -->
          <input
            type="text"
            class="form-control"
            placeholder="Add a comment..."
            v-model="commentAdd"
            @keyup.enter="addComment"
          />
          <button class="btn btn-primary" @click="addComment">
            <i class="bi bi-send"></i>
          </button>
        </div>
      </div>
    </div>
  </section>
  </div>
</template>
<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useServiceStore } from '../../../stores/service'
import { useCommentStore } from '../../../stores/comment'
import { useReplyStore } from '../../../stores/replyComment'
import baseURL from '../../../api/url'

const route = useRoute()
const serviceStore = useServiceStore()
const useComment = useCommentStore()
const useReply = useReplyStore()

// show the service
const fetchServiceShow = async () => {
  await serviceStore.getServiceShow(route.params.id)
}

//list all comments
const fetchAllComments = async () => {
  await useComment.fetchAllComments(route.params.id)
}

// delete comments
const removeComment = async (commentId) => {
  await useComment.deleteComments(commentId)
  fetchAllComments()
}

// delete replay
const removeReply = async (replyId) => {
  await useReply.repliesdealete(replyId)
  fetchAllComments()
}

const replyTo = (comment) => {
  comment.showReplyBox = !comment.showReplyBox 
}

// replay the comments
const replyText = ref("");
const addReply = async (comment) => {
  const reply = {
    text: replyText.value.toString(), 
  }
  useReply.repliesComment(comment.id, reply)
  replyText.value = ""
  fetchAllComments()
}

// comment the onwer
const commentAdd = ref("")
const addComment = async () => {
  const comment = {
    text: commentAdd.value.toString(),
  }
  useComment.addComments(route.params.id, comment)
  console.log(route.params.id, comment)
  commentAdd.value = ""
  fetchAllComments()
}

// routes showing
onMounted(async () => {
  fetchAllComments()
  fetchServiceShow()
})
</script>

<style scoped>

.background-gradient {
  background: radial-gradient(
    circle at 10% 20%,
    rgb(226, 240, 254) 0%,
    rgba(194, 44, 177, 0.342) 90%
  );
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 86%;
  margin-left: 7%;
}

.product-image img {
  width: 100%;
  height: auto;
  max-height: 450px;
  object-fit: cover;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.5s ease-in-out;
}

.product-image img:hover {
  transform: scale(1.05);
}

.card {
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

.card-body {
  padding: 30px;
}

.product-details h1 {
  font-size: 28px; 
  margin-bottom: 10px;
}

.product-details .price {
  color: #888;
  font-size: 24px;
  margin-bottom: 20px;
}

.product-details .description,
.product-details .detail {
  margin-bottom: 20px;
}

.quantity label {
  display: block;
  margin-bottom: 5px;
}

.comment-box {
  border: 1px solid #ddd;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 20px;
  background-color: #f9f9f9;
  transition: transform 0.3s ease-in-out; /* Add transition for smooth effect */
}

.comment-box img {
  border-radius: 50%;
}

@media (max-width: 768px) {
  .background-gradient {
    padding: 15px;
  }
  .card-body {
    padding: 15px;
  }
  .product-details h1 {
    font-size: 24px;
  }
  .product-details .price {
    font-size: 20px;
  }
}
</style>