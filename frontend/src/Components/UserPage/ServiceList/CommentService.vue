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
                      <p>Data start: {{ serviceStore.service.created_at }}</p>
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
    <section class="py-5">
      <div class="container mt-5 color-black">
        <h2><i class="bi bi-chat-left-text p-3"></i>Comments</h2>
        <div v-for="comment in useComment.comments" :key="comment.id" class="comment-box mb-4">
          <div class="d-flex align-items-start">
            <img :src="baseURL + comment.user_profile" alt="User Avatar" class="rounded-circle me-3" width="50" />
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <p class="mb-1">
                  <strong>{{ comment.user_id }}</strong> <small></small>
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
              <div v-if="comment.showReplyBox" class="mb-3">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Add a reply..."
                  v-model="comment.replyText"
                  @keyup.enter="addReply(comment)"
                />
              </div>
            </div>
          </div>
        </div>
          <div class="d-flex align-items-center mt-4 p-3" style="background-color: #f0f0f0">
            <!-- <form @click="addComments"> -->
            <div class="mb-3">
                <input class="form-control" type="file" id="formFile" @change="handleFileUpload">
            </div>
            <div class="input-group">
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
        <!-- </form> -->
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
import baseURL from '../../../api/url'

const route = useRoute()
const serviceStore = useServiceStore()
const useComment = useCommentStore()

const fetchServiceShow = async () => {
  await serviceStore.getServiceShow(route.params.id)
}

const fetchAllComments = async () => {
  await useComment.fetchAllComments(route.params.id)
}

const removeComment = async (commentId) => {
  await useComment.deleteComments(commentId)
  fetchAllComments()
}

// const handleFileUpload = (event) =>{
//   const file = event.target.files[0];
//   imageAdd.value = URL.createObjectURL(file)
// }

const replyTo = (comment) => {
  comment.showReplyBox =!comment.showReplyBox
}

const addReply = async (comment) => {
  console.log("hello, " + comment)
  // await useComment.addReply(comment.id, comment.replyText)
  // comment.replyText = ""
}

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
    rgba(194, 44, 177, 0.41) 90%
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
  transition: transform 0.3s ease-in-out;
}

.product-image img:hover {
  transform: scale(1.05);
}

.card {
  border: none;
  border-radius: 12px;
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

.comment-box:hover {
  transform: scale(1.01); /* Scale up slightly on hover */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
}

.comment-box img {
  border-radius: 50%;
}

.comment-box p {
  margin-bottom: 10px;
}

.comment-reply {
  background-color: #fafafa;
  padding: 10px;
  border-radius: 8px;
  transition: transform 0.3s ease-in-out; /* Add transition for smooth effect */
}

.comment-reply:hover {
  transform: scale(1.01); /* Scale up slightly on hover */
}

.comment-reply p {
  margin-bottom: 5px;
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