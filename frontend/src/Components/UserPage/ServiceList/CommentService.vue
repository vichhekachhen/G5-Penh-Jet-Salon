<template>
  <div>
    <div class="background-gradient">
      <div id="app" class="container color-black mt-5">
        <div class="row">
          <div class="col-md-6 product-image mb-4 mb-md-0">
            <img
              :src="product.image"
              alt="Product Image"
              class="img-fluid rounded"
              style="max-width: 100%; height: auto; max-height: 300px"
            />
          </div>
          <div class="col-md-6 product-details">
            <h1>{{ product.name }}</h1>
            <div class="price">${{ product.price.toFixed(2) }}</div>
            <div class="description">
              <h4>Description</h4>
              <p>{{ product.description }}</p>
            </div>
            <div class="detail">
              <h4>Details</h4>
              <p>Color: {{ product.color }}</p>
              <p>Size: {{ product.size }}</p>
              <p>Material: {{ product.material }}</p>
            </div>
            <div class="quantity">
              <label for="quantity">Quantity</label>
              <input
                type="number"
                id="quantity"
                v-model.number="quantity"
                min="1"
                class="form-control"
              />
            </div>
            <div class="buttons mt-4">
              <button class="btn btn-success me-2" @click="addToCart">Add to Cart</button>
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
                  <button class="btn btn-secondary btn-sm" @click="removeComment(comment.id)">
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
                      class="btn btn-secondary btn-sm"
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
        <div class="d-flex align-items-center mt-4">
          <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWwWf4v8y-sHDj4CzyJ07YQa6DlV4T1QyBvA&s"
            alt="User Avatar"
            class="rounded-circle"
            width="50"
          />
          <input
            type="text"
            class="form-control ms-3"
            placeholder="Add a comment..."
            v-model="newCommentText"
            @keyup.enter="addComment"
          />
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newCommentText: '',
      product: {
        image:
          'https://cdn.prod.website-files.com/650d8c7172a9963770681588/65c7acbcf144ec117bdc69de_korean%20hairstyle%20men%20amsterdam.WEBP',
        name: 'Korean Style',
        price: 99.99,
        description: 'Product description',
        color: 'Blue',
        size: 'Medium',
        material: 'Cotton'
      },
      comments: [
        {
          id: 1,
          avatar:
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSAzBE_P3rPclK8gJnC-y1Mq7kNOvyL8yUHlg&s',
          username: 'User1',
          time: 'just now',
          text: 'I have come to expect much more from your products and, therefore, this has been very upsetting for me.😒😂❤️',
          showReplyBox: false,
          replyText: '',
          replies: []
        },
        {
          id: 2,
          avatar: 'https://cdn-icons-png.flaticon.com/512/2919/2919906.png',
          username: 'User2',
          time: '2 minutes ago',
          text: 'I have come to expect much more from your products and, therefore, this has been very upsetting for me.😍❤️👌',
          showReplyBox: false,
          replyText: '',
          replies: []
        }
      ],
      quantity: 1
    }
  },
  methods: {
    addToCart() {
      // Implement addToCart functionality
    },
    replyTo(comment) {
      comment.showReplyBox = !comment.showReplyBox
    },
    addReply(comment) {
      if (comment.replyText.trim()) {
        const newReply = {
          id: Date.now(),
          username: 'Anonymous',
          time: 'just now',
          text: comment.replyText.trim()
        }
        comment.replies.push(newReply)
        comment.replyText = ''
        comment.showReplyBox = false
      }
    },
    removeReply(commentId, replyId) {
      const comment = this.comments.find((comment) => comment.id === commentId)
      if (comment) {
        comment.replies = comment.replies.filter((reply) => reply.id !== replyId)
      }
    },
    addComment() {
      if (this.newCommentText.trim()) {
        const newComment = {
          id: Date.now(),
          avatar: 'https://example.com/new-avatar.jpg',
          username: 'Anonymous',
          time: 'just now',
          text: this.newCommentText.trim(),
          showReplyBox: false,
          replyText: '',
          replies: []
        }
        this.comments.push(newComment)
        this.newCommentText = ''
      }
    },
    removeComment(commentId) {
      this.comments = this.comments.filter((comment) => comment.id !== commentId)
    }
  }
}
</script>

<style scoped>
.background-gradient {
  background: radial-gradient(
    circle at 10% 20%,
    rgb(226, 240, 254) 0%,
    rgba(194, 44, 177, 0.41) 90%
  );
  width: 80%;
  margin: 0 auto;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.product-image img {
  width: 60%;
  max-height: 300px;
  border-radius: 8px;
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
}

.comment-box:hover {
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease-in-out;
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
}

.comment-reply p {
  margin-bottom: 5px;
}

.buttons {
  margin-top: 20px;
}

.btn-sm {
  font-size: 14px;
}

.form-control {
  border-radius: 8px;
}

.color-black {
  color: #333;
}

@media (max-width: 768px) {
  .background-gradient {
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
