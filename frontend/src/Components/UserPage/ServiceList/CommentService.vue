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
                    <img :src="baseURL+product.image" alt="Product Image" class="img-fluid rounded" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card-body order-primary">
                    <h1 class="card-title"><i class="bi bi-amd p-2"></i>{{ product.service_name }}</h1>
                    <div class="description mb-3">
                      <h4>Description</h4>
                      <p>{{ product.description }}</p>
                    </div>
                    <div class="detail mb-3">
                      <h4>Details</h4>
                      <p>Original price: <b>${{ product.price }}</b></p>
                      <p>Descount price: <b>${{ product.discount }}</b></p>
                      <p>Data strat: {{ product.created_at }}</p>
                    </div>
                    <div class="rating mb-3">
                      <label for="like">
                        <h4>Like</h4>
                        <i
                          class="bi bi-heart-fill font-size-lg fs-4"
                          :class="{ 'bi-heart-fill': product.liked, 'text-danger': product.liked }"
                          @click="toggleLike"
                          style="cursor: pointer"
                        ></i>
                      </label>
                      <!-- <span>{{ likeCount }}</span> -->
                    </div>
                    <div class="buttons">
                      <router-link to="/listService/1">
                        <button class="btn btn-info me-2" @click="addToCart">Back</button>
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
        <div v-for="comment in comments" :key="comment.id" class="comment-box mb-4">
          <div class="d-flex align-items-start">
            <img :src="comment.avatar" alt="User Avatar" class="rounded-circle me-3" width="50" />
            <div class="flex-grow-1">
              <div class="d-flex justify-content-between">
                <p class="mb-1">
                  <strong>{{ comment.username }}</strong> <small>{{ comment.time }}</small>
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
              <div v-if="comment.replies.length > 0" class="ms-4">
                <div v-for="reply in comment.replies" :key="reply.id" class="comment-reply mb-3">
                  <div class="d-flex justify-content-between">
                    <p class="mb-1">
                      <strong>{{ reply.username }}</strong> <small>{{ reply.time }}</small>
                    </p>
                    <button
                      class="btn btn-danger btn-sm"
                      @click="removeReply(comment.id, reply.id)"
                    >
                      Remove
                    </button>
                  </div>
                  <p>{{ reply.text }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="d-flex align-items-center mt-4 p-3" style="background-color: #f0f0f0">
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWwWf4v8y-sHDj4CzyJ07YQa6DlV4T1QyBvA&s"
            alt="User Avatar"
            class="rounded-circle"
            width="50"
          />
          <input
            type="text"
            class="form-control bg-red-200 ms-3"
            placeholder="Add a comment..."
            v-model="newCommentText"
            @keyup.enter="addComment"
          />
        </div>
      </div>
    </section>
  </div>
</template>
<script setup lang="ts">
  import { ref, computed } from 'vue';
  import { useRoute } from 'vue-router';
  import { useServiceStore } from '../../../stores/service';
  import baseURL from '../../../api/url';

  const route = useRoute();
  const serviceStore = useServiceStore();
  const product = computed(() => serviceStore.services.find((services: any) => services.id === Number(route.params.id)));

  // Data
  const newCommentText = ref('');
  const comments = ref([
    {
      id: 1,
      avatar: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAzBE_P3rPclK8gJnC-y1Mq7kNOvyL8yUHlg&s',
      username: 'User1',
      text: 'I have come to expect much more from your products and, therefore, this has been very upsetting for me.😒😂❤️',
      showReplyBox: false,
      replyText: '',
      replies: []
    },
    {
      id: 2,
      avatar: 'https://cdn-icons-png.flaticon.com/512/2919/2919906.png',
      username: 'User2',
      text: 'I have come to expect much more from your products and, therefore, this has been very upsetting for me.😍❤️👌',
      showReplyBox: false,
      replyText: '',
      replies: []
    }
  ]);
  const likeCount = ref(0);

  // Methods
  const replyTo = (comment: any) => {
    comment.showReplyBox = !comment.showReplyBox;
  };

  const addReply = (comment: any) => {
    if (comment.replyText.trim()) {
      const newReply = {
        id: Date.now(),
        username: 'Anonymous',
        time: 'just now',
        text: comment.replyText.trim()
      };
      comment.replies.push(newReply);
      comment.replyText = '';
      comment.showReplyBox = false;
    }
  };

  const removeReply = (commentId: number, replyId: number) => {
    const comment = comments.value.find((comment) => comment.id === commentId);
    if (comment) {
      comment.replies = comment.replies.filter((reply) => reply.id !== replyId);
    }
  };

  const addComment = () => {
    if (newCommentText.value.trim()) {
      const newComment = {
        id: Date.now(),
        avatar: 'https://example.com/new-avatar.jpg',
        username: 'Anonymous',
        text: newCommentText.value.trim(),
        showReplyBox: false,
        replyText: '',
        replies: []
      };
      comments.value.push(newComment);
      newCommentText.value = '';
    }
  };

  const removeComment = (commentId: number) => {
    comments.value = comments.value.filter((comment) => comment.id !== commentId);
  };

  const toggleLike = () => {
    product.value.liked = !product.value.liked;
    if (product.value.liked) {
      likeCount.value++;
    } else {
      likeCount.value--;
    }
  };
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
