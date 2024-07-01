<template>
    <div>
      <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg rounded sticky-top">
                      <div class="container-fluid">
            <!-- Toggle button for sidebar -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
              <span class="navbar-toggler-icon"></span>
            </button>
  
            <!-- Brand -->
            <img src="https://buffer.com/library/content/images/size/w1200/2023/10/free-images.jpg"
              class="rounded me-3 w-15 h-15 object-fit-cover" alt="Logo">
            <a class="navbar-brand" href="#"><b>PENH JET SALON</b></a>
  
            <!-- Search form -->
            <form class="d-none d-lg-flex ms-auto w-100 h-11">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </form>
  
            <!-- Notification dropdown -->
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-primary d-flex align-items-center" href="#"
                  role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="badge-container">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-danger">99</span>
                  </span>
                </a>
  
                <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow-lg">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <img src="https://t4.ftcdn.net/jpg/06/08/55/73/360_F_608557356_ELcD2pwQO9pduTRL30umabzgJoQn5fnd.jpg"
                            alt="User Avatar" class="rounded-circle avatar">
                        </div>
                        <div>
                          <strong>Veak Khlop</strong>
                          <div>Check out this interesting article!</div>
                          <small class="text-muted">1 year ago</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <hr>
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAcZUYZ7y_E5rfCrLNUNDOJEf-0Ii6wgRlyRB1ywNheQdzqjg_muOu9YwnAuq9ZEn50tc&usqp=CAU"
                            alt="User Avatar" class="rounded-circle avatar">
                        </div>
                        <div>
                          <strong>Makara Try</strong>
                          <div>Check out this interesting article!</div>
                          <small class="text-muted">1 day ago</small>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
  
        <!-- Main content -->
        <div class="main-content">
          <!-- Content goes here -->
          <router-view></router-view>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      toggleSidebar() {
        // Implement your sidebar toggle logic here
      }
    }
  }
  </script>
  
  <style scoped>
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 250px;
    /* Adjust width as needed */
    background-color: #fff;
    border-right: 1px solid #ddd;
    z-index: 1000;
    /* Ensure sidebar is above content */
    overflow-y:auto;
    /* Allow scrolling if content exceeds sidebar height */
  }
  
  .content {
    margin-left: 250px;
    /* Sidebar width */
    padding: 20px;
  }
  
  .navbar {
    background-color: #fff;
  }
  
  .navbar-toggler {
    border: none;
    outline: none;
  }
  
  .avatar {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
  }
  </style>