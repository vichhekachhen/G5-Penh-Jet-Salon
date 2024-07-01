<template>
  <v-app>
    <!-- NavBar component -->
    
    <v-container fluid>
      <v-row no-gutters>
        <!-- Sidebar -->
        <v-col cols="2">
          <side-bar></side-bar>
        </v-col>

        <!-- Main content -->
        <v-col cols="10" class="mt-5">
          <v-container>
            <v-row>
              <!-- Card 1 -->
              <v-col cols="12" sm="6" md="3">
                <v-card class="mb-3 shadow-lg">
                  <v-img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    alt="img"
                    height="200"
                  ></v-img>
                  <v-card-title class="fw-bold">Amount</v-card-title>
                  <v-card-text>$ 100/day</v-card-text>
                </v-card>
              </v-col>
              
              <!-- Card 2 -->
              <v-col cols="12" sm="6" md="3">
                <v-card class="mb-3 shadow-lg">
                  <v-img
                  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    alt="img"
                    height="200"
                    ></v-img>
                  <v-card-title class="fw-bold">Total Amount</v-card-title>
                  <v-card-text>$ 9000/week</v-card-text>
                </v-card>
              </v-col>

              <!-- Card 3 -->
              <v-col cols="12" sm="6" md="3">
                <v-card class="mb-3 shadow-lg">
                  <v-img
                  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    alt="img"
                    height="200"
                    ></v-img>
                  <v-card-title class="fw-bold">Service</v-card-title>
                  <v-card-text>100 Products</v-card-text>
                </v-card>
              </v-col>
              
              <!-- Card 4 -->
              <v-col cols="12" sm="6" md="3">
                <v-card class="mb-3 shadow-lg">
                  <v-img
                  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    alt="img"
                    height="200"
                    ></v-img>
                  <v-card-title class="fw-bold">Customers</v-card-title>
                  <v-card-text>100/day</v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
  <nav-bar></nav-bar>
</template>

<script>
import NavBar from "../../../Components/NavOwnerCom/NavBar.vue";

export default {
  components: { NavBar },
  name: "Dashboard",
};
</script>

<style>
/* Add custom styles here if needed */
</style>
