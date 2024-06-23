<template>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <div class="id h-175">
    <h2 class="text-center pt-20">Beauty salon design</h2>
    <div class="d-flex justify-content-around pt-6 ">
      <div class="card text-white col-3 shadow card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
          <button>button</button>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-around pt-5">
      <div class="card text-white col-3 shadow card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRwwfk8hhhRhNlgDOcAFxZ3GoVkFHEdJYEwBA&s">
        <div class="card-img-overlay">
          <h5 class="card-title">Card title</h5>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="group">
        <img src="/src/Images/download (6).png" style="height: 60px;">
        <div class="FooterLeft">
          <h3>Logo</h3>
          <h5>Welcom to salaon penh jit</h5>
          <p>Becutifull Penh jit salon </p>
        </div>
        <div class="FooterCenter">
          <h3>Hours</h3>
          <p>Mon to Fri: 7am - 7pm </p>
          <p>Sat: 9am to 9pm </p>
          <p>Sun: 9am to 7pm </p>
        </div>
        <div class="FooterRight">
          <h3>Contact Us</h3>
          <p> Phone: 0962590414</p>
          <p>Email: </p>
          <p>Address: </p>
        </div>
      </div>
      <hr>
      <div class="GroupIcon">
        <a href="https://facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="https://linkedin.com" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <p class="text-center">PENH JIT SALON * 2024</p>
    </footer>
  </div>
</template>

<style>
.id {
  background-color: white;
}

.card-hover:hover {
  transform: scale(1.04);
  transition: all 0.3s ease-in-out;
  transition-duration: 0.3s;
  transition-timing-function: ease-in-out;
  transition-delay: 0s;
  /* transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); */
}

.footer {
  background-color: #e4a4b0;

}

.group {
  display: flex;

}
img{
  margin-left: 4%;
  margin-top: 2%;
}

.FooterLeft{
  width: 50%;
  /* margin-left: 4%; */
  margin-top: 3%;

}
.FooterCenter {
  width: 50%;
  margin-top: 4%;
}

.FooterRight {
  width: 30%;
  margin-top: 4%;
}

.GroupIcon {
  text-align: center;
  padding: 10px;
}

.social-icon {
  color: palevioletred;
  margin: 0 10px;
  font-size: 24px;
  transition: color 0.3s ease-in-out;
}

.social-icon:hover {
  color: #3e0ab8;
}
</style>
