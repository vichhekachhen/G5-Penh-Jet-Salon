<template>
  <div>
    <!-- Header-->
    <header class="bg-image py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-black">
          <h1 class="display-4 fw-bolder">Shop in style</h1>
        </div>
      </div>
    </header>
    <section class="py-5">
      <div class="container px-4 px-lg-5 mt-5">
        <h3> Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</h3>
        <div
          class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center"
        >
          <div
            class="col mb-5"
            v-for="product in products"
            :key="product.id"
            style="cursor: pointer"
          >
            <div
              @click="handleProductClick(product)"
              class="card h-100 hover-shadow"
            >
              <!-- Sale badge-->
              <div
                v-if="product.onSale"
                class="badge bg-dark text-white position-absolute"
                style="top: 0.5rem; right: 0.5rem"
              >
                Sale
              </div>
              <!-- Product image-->
              <img class="card-img-top" :src="product.image" alt="..." />
              <!-- Product details-->
              <div class="card-body p-4">
                <div class="text-center">
                  <!-- Product name-->
                  <h5 class="fw-bolder">{{ product.name }}</h5>
                  <p>{{product.adress}}</p>
                  <!-- Product reviews-->
                  <div
                    v-if="product.reviews"
                    class="d-flex justify-content-center small text-warning mb-2"
                  >
                    <div
                      v-for="star in 5"
                      :key="star"
                      class="bi-star-fill"
                      :class="{ 'text-muted': star > product.reviews }"
                    ></div>
                  </div>
                  <!-- Product price-->
                  <span
                    v-if="product.originalPrice"
                    class="text-muted text-decoration-line-through"
                    >{{ product.originalPrice }}</span
                  >
                  {{ product.price }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: [
        {
          id: 1,
          name: "Fancy Product",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtERe8qenuPxi-Cfii6Er16UsSUCk4o20xBg&s",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "View options",
          onSale: false,
        },
        {
          id: 2,
          name: "Special Item",
          image:
            "https://shopsinhk.com/wp-content/uploads/2017/02/il-colpo-hair-salon-pacific-place-hong-kong.jpg",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "Add to cart",
          onSale: false,
          reviews: 5,
        },
        {
          id: 3,
          name: "Sale Item",
          image:
            "https://images.fresha.com/locations/location-profile-images/437833/1469976/eb87e53c-3746-4ec0-89e3-204cbaa07668.jpg?class=width-small",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "Add to cart",
          onSale: false,
        },
        {
          id: 4,
          name: "Popular Item",
          image:
            "https://images.fresha.com/locations/location-profile-images/850588/1584369/900bc548-607b-4786-83c9-247ae15ec7b3.jpg?class=fallback",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "Add to cart",
          reviews: 5,
        },
        {
          id: 5,
          name: "Sale Item",
          image:
            "https://images.fresha.com/locations/location-profile-images/726075/1000502/6052cc68-2b98-49d9-9739-f238dfa3d73e.jpg?class=fallback",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "Add to cart",
          onSale: false,
        },
        {
          id: 6,
          name: "Fancy Product",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwIdK43WZb9dAcJKQ94jJBzaaHhDttg2_XzfFqWk-18CNTvoJt6kTH3gYuwHohX5Lu-Ys&usqp=CAU",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "View options",
          onSale: false,
        },
        {
          id: 7,
          name: "Special Item",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSac9tr_t80SmzC-sTTBFleDnYuZwdIqvFopw&s",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "Add to cart",
          onSale: false,
          reviews: 5,
        },
        {
          id: 8,
          name: "Popular Item",
          image:
            "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGYCZwP-b4gmaBQRPe1XjYozs9bY7SULIaY7vQhYZe-lEcWKwbBLWC2XlZwVS-L2-3aow&usqp=CAU",
          adress: "D05, Street Betong, Phum Mol, Phnom Penh 12401",
          action: "Add to cart",
          reviews: 5,
        },
      ],
    };
  },
  methods: {
    handleProductClick(product) {
      console.log(`Clicked product: ${product.name}`);
    },
  },
};
</script>

<style scoped>
.hover-shadow:hover {
  box-shadow: 0 0 20px rgba(221, 13, 207, 0.3);
  transition: all 0.3s ease-in-out;
  transform: scale(1.05);
  transition: all 0.3s ease-in-out;
}
.bg-image {
  background-image: url("https://img.freepik.com/premium-photo/gradient-tropical-leaves-background_880763-5193.jpg");
  background-size: cover;
  background-position: center;
}
.container h3{
  font-size: 30px;
  color: rgb(6, 6, 6);
  font-weight: bold;
  text-align: center;
  margin-top: 20px;
  margin-bottom:70px;
}
</style>
