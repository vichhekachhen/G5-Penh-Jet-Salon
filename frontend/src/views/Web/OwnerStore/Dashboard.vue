<template>
    <nav-bar></nav-bar>
    <div class="container">
      <div class="sidebar">
        <side-bar></side-bar>
      </div>
      <div class="main-content">
        <div class="row">
          <!-- card 1 -->
          <div class="col-3 mt-13">
            <div class="card mb-3 shadow-lg" style="max-width: 250px;">
              <div class="row g-0">
                <div class="col-4">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    class="card-img-top rounded-start"
                    alt="img"
                  />
                </div>
                <div class="col-8">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">Amount</h5>
                    <p class="card-text">$ 100/day</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- card 2 -->
          <div class="col-3 mt-13">
            <div class="card mb-3 shadow-lg" style="max-width: 250px;">
              <div class="row g-0">
                <div class="col-4">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    class="card-img-top rounded-start"
                    alt="img"
                  />
                </div>
                <div class="col-8">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">Total Amount</h5>
                    <p class="card-text">$ 9000/week</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- card 3 -->
          <div class="col-3 mt-13">
            <div class="card mb-3 shadow-lg" style="max-width: 250px;">
              <div class="row g-0">
                <div class="col-4">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    class="card-img-top rounded-start"
                    alt="img"
                  />
                </div>
                <div class="col-8">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">Service</h5>
                    <p class="card-text">100 Products</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- card 4 -->
          <div class="col-3 mt-13">
            <div class="card mb-3 shadow-lg" style="max-width: 250px;">
              <div class="row g-0">
                <div class="col-4">
                  <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4OIreKFvX4sGmLSIrea6TPOziJjz6FwSRqw&s"
                    class="card-img-top rounded-start"
                    alt="img"
                  />
                </div>
                <div class="col-8">
                  <div class="card-body">
                    <h5 class="card-title fw-bold">Customers</h5>
                    <p class="card-text">100/day</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- chart  -->
  </template>
  
  <script>
  import NavBar from "../../../Components/NavOwnerCom/NavBar.vue";
  import SideBar from "./SideBar.vue";
  
  export default {
    components: { SideBar, NavBar },
    name: "Dashboard",
  };
  </script>
  
  <style>
  .container {
    display: flex;
  }
  
  .sidebar {
    width: 250px;
  }
  
  .main-content {
    flex: 1;
    padding: 10px;
    margin-top: 20px; /* Add margin-top value to create space */
  }
  
  .card {
    width: 100%;
  }
  
  .card-img-top {
    object-fit: cover;
    height: 100%;
  }
  </style>