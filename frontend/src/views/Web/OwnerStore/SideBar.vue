<template>


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

   <nav class="navbar navbar-light bg-light shadow-lg">
      <a class="navbar-brand">Navbar</a>
      <form class="form-inline d-flex">
         <input class="form-control form-control-lg w-75 h-75" type="search" placeholder="Search" aria-label="Search">
         <button class="btn btn-outline-success my-2 my-sm-0 btn-lg" type="submit">Search</button>
      </form>
   </nav>


</template>

<script>
import NavBarCom from '@/Components/NavOwnerCom/NavBar.vue'

export default {
   name: 'SideBar',
   components: {
      NavBarCom
   }
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