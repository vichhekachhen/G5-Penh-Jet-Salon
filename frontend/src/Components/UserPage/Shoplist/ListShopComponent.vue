<template>
  <div class="col mb-5" @click="handleClick" style="cursor: pointer">
    <div class="card h-100 hover-shadow">
      <div v-if="ListShop.onSale" class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
        Sale
      </div>
      <img class="card-img-top" :src="ListShop.image" alt="ListShop Image" />
      <div class="card-body p-4">
        <div class="text-center">
          <h5 class="fw-bolder">{{ ListShop.name }}</h5>
          <p>{{ ListShop.address }}</p>
          <div v-if="ListShop.reviews" class="d-flex justify-content-center small text-warning mb-2">
            <div v-for="star in 5" :key="star" class="bi-star-fill" :class="{ 'text-muted': star > ListShop.reviews }"></div>
          </div>
          <span v-if="ListShop.originalPrice" class="text-muted text-decoration-line-through">{{ ListShop.originalPrice }}</span>
          {{ ListShop.price }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    ListShop: {
      type: Object,
      required: true
    }
  },
  methods: {
    handleClick() {
      this.$emit('ListShop-click', this.ListShop)
    }
  }
}
</script>

<style scoped>
.hover-shadow:hover {
  box-shadow: 0 0 40px rgba(221, 13, 207, 0.3);
  transition: all 0.3s ease-in-out;
  transform: scale(1.05);
}
</style>
