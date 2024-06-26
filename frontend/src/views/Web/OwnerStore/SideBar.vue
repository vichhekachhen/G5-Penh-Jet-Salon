<template>
   <div>
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg d-flex justify-content-between">
         <div class="container-fluid"> <!-- Wrap the navbar content inside a container-fluid for responsive behavior -->
            <a class="navbar-brand" href="#">Your Brand</a>

            <!-- Toggle button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
               aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
               <!-- Search input with icon -->
               <form class="d-flex my-2 my-lg-0 ms-lg-4">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-primary" type="submit">
                     <i class="bi bi-search"></i>
                  </button>
               </form>

               <ul class="navbar-nav">
                  <li class="nav-item dropdown notification-container">
                     <a class="nav-link dropdown-toggle text-primary d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell me-2"></i>Notification<span class="badge bg-danger rounded-pill">2</span>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end notification-dropdown shadow-lg">
                        <li>
                           <a class="dropdown-item" href="#">
                              <div class="d-flex">
                                 <div class="flex-shrink-0 me-3">
                                    <img
                                       src="https://t4.ftcdn.net/jpg/06/08/55/73/360_F_608557356_ELcD2pwQO9pduTRL30umabzgJoQn5fnd.jpg"
                                       alt="User Avatar" class="rounded-circle w-13 h-13" style="object-fit: cover;">
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
                                    <img
                                       src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAcZUYZ7y_E5rfCrLNUNDOJEf-0Ii6wgRlyRB1ywNheQdzqjg_muOu9YwnAuq9ZEn50tc&usqp=CAU"
                                       alt="User Avatar" class="rounded-circle w-13 h-13" style="object-fit: cover;">
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
         </div>
      </nav>

      <!-- Sidebar -->
      <div class="d-flex">
         <div class="sidebar shadow-lg">
            <div class="user-profile d-flex align-items-center p-3">
               <img
                  src="https://www.imgacademy.com/sites/default/files/styles/scale_1700w/public/2022-07/img-homepage-meta_0.jpg?itok=LMirU0Ik"
                  alt="User Avatar" class="rounded-circle mr-3" width="50" height="50" />
               <div>
                  <h5 class="text-muted"><b>Socheathek MAO</b></h5>
                  <span class="badge bg-success">Salon Owner</span>
               </div>
            </div>
            <hr class="my-3" />
            <nav class="nav flex-column">
               <a class="nav-link active" href="#">
                  <i class="bi bi-columns mr-2"></i>
                  Dashboard
               </a>
               <a class="nav-link" href="#">
                  <i class="bi bi-calendar-event mr-2"></i>
                  Schedule
               </a>
               <a class="nav-link" href="#">
                  <i class="bi bi-envelope mr-2"></i>
                  Messages
               </a>
               <a class="nav-link" href="#">
                  <i class="bi bi-plus-circle mr-2"></i>
                  Add Product & Service
               </a>
               <a class="nav-link" href="#">
                  <i class="bi bi-cart-check mr-2"></i>
                  Orders
               </a>
               <a class="nav-link" href="#">
                  <i class="bi bi-bar-chart-line mr-2"></i>
                  Analytics
               </a>
               <a class="nav-link" href="#">
                  <i class="bi bi-people mr-2"></i>
                  Customers
               </a>
               <a class="nav-link" href="#">
                  <i class="bi bi-gear mr-2"></i>
                  Settings
               </a>
            </nav>
         </div>
      </div>
   </div>
</template>



<script>
export default {
   name: 'SideBar',
}
</script>

<style scoped>
.sidebar {
   background-color: #fff;
   border-right: 1px solid #e5e5e5;
   height: 100vh;
   position: fixed;
   left: 0;
   top: 0;
   width: 250px;
   z-index: 1030;
}

.user-profile {
   border-bottom: 1px solid #e5e5e5;
}

.nav-link {
   color: #495057;
   font-size: 16px;
   padding: 0.75rem 1.5rem;
   transition: background-color 0.2s ease-in-out;
}

.nav-link.active,
.nav-link:hover {
   background-color: #f8f9fa;
   color: #007bff;
}

.nav-link i {
   font-size: 18px;
}
</style>