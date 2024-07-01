<template>
  <div id="viewport">
    <div id="sidebar" class="bg-dark text-white">
      <header class="bg-primary text-center p-3">
        <img src="https://imgv3.fotor.com/images/slider-image/A-clear-close-up-photo-of-a-woman.jpg"
          class="rounded w-13 h-13 me-3 mb-3 object-fit-cover" alt="">
        <h4 class="text-white mb-0">Kaka 24</h4>
        <small class="text-white">Salon Owner</small>
      </header>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="/Dashboard">
            <i class="bi bi-grid-1x2"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/Calendar">
            <i class="bi bi-calendar"></i> Calendar
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-chat-dots"></i> Messages
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-bag-plus-fill"></i> Add Products & Service
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-info-circle"></i> Orders
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-graph-up-arrow"></i> Analytics
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-person"></i> Customers
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="bi bi-gear"></i> Settings
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SideBar',
}
</script>

<style scoped>
@import url('https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css');

body {
  overflow-x: hidden;
  font-family: 'Roboto', sans-serif;
  font-size: 16px;
}


#viewport {
  padding-left: 250px;
  transition: padding-left 0.5s ease;
}


#sidebar {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 250px;
  overflow-y: auto;
  transition: width 0.5s ease;
}

#sidebar header {
  font-size: 20px;
  line-height: 52px;
}

#sidebar .nav-link {
  color: #CFD8DC;
  padding: 10px 20px;
  transition: background-color 0.3s;
}

#sidebar .nav-link:hover {
  background-color: #455A64;
  color: #ECEFF1;
}

#sidebar .nav-link i {
  margin-right: 10px;
}
</style>
