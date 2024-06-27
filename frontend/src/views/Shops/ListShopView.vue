<template>
  <div>
    <!-- Header-->
    <header class="bg-image py-5">
      <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-black">
          <h1 class="display-4 fw-bolder">Shop in style</h1>
          <p>ONE Day Spa & Beauty Salon: Best Salon in Phnom Penh</p>
        </div>
      </div>
    </header>
    <section class="py-5">
      <div class="containers px-4 px-lg-5 mt-5">
        <h3>
          Professional hair cutting and styling, manicures and pedicures, and often cosmetics, makeup and makeovers.
        </h3>
        <!-- Model alert -->
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
          <ListShopComponent
            v-for="ListShop in ListShop"
            :key="ListShop.id"
            :ListShop="ListShop"
            @ListShop-click="handleListShopClick"
          />
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import ListShopComponent from '@/Components/UserPage/Shoplist/ListShopComponent.vue'

export default {
  components: {
    ListShopComponent
  },
  data() {
    return {
      ListShop: [
        {
          id: 1,
          name: 'Fancy Product',
          image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtERe8qenuPxi-Cfii6Er16UsSUCk4o20xBg&s',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'View options',
          onSale: false,
          reviews: 3,
          originalPrice: null,
          price: '$40.00'
        },
        {
          id: 2,
          name: 'Special Item',
          image: 'https://shopsinhk.com/wp-content/uploads/2017/02/il-colpo-hair-salon-pacific-place-hong-kong.jpg',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'Add to cart',
          onSale: false,
          reviews: 5,
          originalPrice: '$50.00',
          price: '$25.00'
        },
        {
          id: 3,
          name: 'Sale Item',
          image: 'https://images.fresha.com/locations/location-profile-images/437833/1469976/eb87e53c-3746-4ec0-89e3-204cbaa07668.jpg?class=width-small',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'Add to cart',
          onSale: false,
          reviews: 4,
          originalPrice: '$20.00',
          price: '$18.00'
        },
        {
          id: 4,
          name: 'Popular Item',
          image: 'https://images.fresha.com/locations/location-profile-images/850588/1584369/900bc548-607b-4786-83c9-247ae15ec7b3.jpg?class=fallback',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'Add to cart',
          reviews: 5,
          originalPrice: null,
          price: '$40.00'
        },
        {
          id: 5,
          name: 'Sale Item',
          image: 'https://images.fresha.com/locations/location-profile-images/726075/1000502/6052cc68-2b98-49d9-9739-f238dfa3d73e.jpg?class=fallback',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'Add to cart',
          onSale: false,
          reviews: 3,
          originalPrice: '$50.00',
          price: '$25.00'
        },
        {
          id: 6,
          name: 'Fancy Product',
          image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwIdK43WZb9dAcJKQ94jJBzaaHhDttg2_XzfFqWk-18CNTvoJt6kTH3gYuwHohX5Lu-Ys&usqp=CAU',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'View options',
          onSale: false,
          reviews: 5,
          originalPrice: null,
          price: '$40.00'
        },
        {
          id: 7,
          name: 'Special Item',
          image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSac9tr_t80SmzC-sTTBFleDnYuZwdIqvFopw&s',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'Add to cart',
          onSale: false,
          reviews: 4,
          originalPrice: '$50.00',
          price: '$25.00'
        },
        {
          id: 8,
          name: 'Popular Item',
          image: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGYCZwP-b4gmaBQRPe1XjYozs9bY7SULIaY7vQhYZe-lEcWKwbBLWC2XlZwVS-L2-3aow&usqp=CAU',
          address: 'D05, Street Betong, Phum Mol, Phnom Penh 12401',
          action: 'Add to cart',
          reviews: 5,
          originalPrice: null,
          price: '$40.00'
        }
      ]
    }
  },

  //model alert
  methods: {
    handleListShopClick(ListShop) {
      console.log(`Clicked ListShop: ${ListShop.name}`)
    }
  }
}
</script>

<style scoped>
.hover-shadow:hover {
  box-shadow: 0 0 40px rgba(221, 13, 207, 0.3);
  transition: all 0.3s ease-in-out;
  transform: scale(1.05);
  transition: all 0.3s ease-in-out;
}
.bg-image {
  background-image: url('https://www.solasalonstudios.com/_next/image?url=https%3A%2F%2Fd3p1kyyvw4qtho.cloudfront.net%2Flocations%2Fimage_1s%2F000%2F000%2F997%2Fcarousel%2FScreen_Shot_2023-03-02_at_11.44.44_AM.png&w=3840&q=100');
  background-size: cover;
  height: 75vh;
  background-position: center;
}
.container h1 {
  font-size: 50px;
  color: #000000;
  background-color: rgba(255, 255, 255, 0.51);
  padding: 40px;
  border-radius: 10px;
  width: auto;
  max-width: 500px;
  height: auto;
  text-align: center;
  margin: 40px auto; /* Center align */
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}

.container p {
  font-size: 20px; /* Adjusted for readability */
  color: #000000;
   background-color: rgba(255, 255, 255, 0.51);
  padding: 10px;
  border-radius: 10px;
  width: auto;
  max-width: 600px;
  height: auto;
  text-align: center;
  margin: 50px auto; /* Center align with spacing */
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}
.containers h3{
  font-size: 20px;
  color: #000000;
  background-color: rgba(206, 96, 221, 0.474);
  padding: 30px;
  border-radius: 10px;
  width: auto;
  max-width: auto;
  height: auto;
  text-align: center;
  margin-bottom: 60px;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
}
</style>
