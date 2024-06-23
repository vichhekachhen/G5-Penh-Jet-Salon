
<template>
  <div class="id h-190">
    <h2 class="text-center pt-20">Provinces in Cambodia</h2>
    <div class="d-flex justify-content-around pt-5 ">
      <div class="card text-white col-3 shadow card-hover">
        <img class="Image" src="https://media.tacdn.com/media/attractions-splice-spp-674x446/06/6c/56/f8.jpg">
        <div class="card-img-overlay">
          <div class="pt-40">
            <button class="btn bg-light text-dark" type="button">Phnom Penh</button>
            <!-- <h3 class="border-1 bg-white border-0 text-black w-50">Phnom Penh</h3> -->
          </div>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img class="Image" src="https://i0.wp.com/www.cambodialifestyle.com/wp-content/uploads/2024/04/Takeo-4.jpg?fit=1000%2C612&ssl=1">
        <div class="card-img-overlay">
          <div class="pt-40">
            <button class="btn bg-light text-dark" type="button">Tachoe</button>
            <!-- <h3 class="border-1 bg-white border-0 text-black w-30">Tachoe</h3> -->
          </div>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img class="Image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeexoOq_z1Zo1o7n2eymShTp5bAF2DHDyEuQ&s">
        <div class="card-img-overlay">
          <div class="pt-40">
            <button class="btn bg-light text-dark" type="button">Seim Reap</button>
            <!-- <h3 class="border-1 bg-white border-0 text-black w-50">Seim Reap</h3> -->
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-around pt-5 ">
      <div class="card text-white col-3 shadow card-hover">
        <img class="Image" src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Ta_Dambang_Statue.png/250px-Ta_Dambang_Statue.png">
        <div class="card-img-overlay">
          <div class="province pt-45">
            <button class="btn bg-light text-dark" type="button">Battambang</button>
            <!-- <h3 class="border-1 bg-white border-0 text-black w-50">Battambang</h3> -->
          </div>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img class="Image" src="https://i0.wp.com/www.cambodialifestyle.com/wp-content/uploads/2024/04/Takeo-4.jpg?fit=1000%2C612&ssl=1">
        <div class="card-img-overlay">
          <div class="province pt-45">
            <button class="btn bg-light text-dark" type="button">Kampot</button>
            <!-- <h3 class="border-1 bg-white border-0 text-black w-30">Kampot</h3> -->
          </div>
        </div>
      </div>
      <div class="card text-white col-3 shadow card-hover">
        <img class="Image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQwcSvvwjTfU9pUtZsmt6Xk0FdASavh_YbDyA&s">
        <div class="card-img-overlay">
          <div class="province pt-45">
            <button class="btn bg-light text-dark" type="button">Preah Srey Hanu</button>
            <!-- <h3 class="border-1 bg-white border-0 text-black w-60">Preah Srey Hanu</h3> -->
          </div>
          
        </div>
      </div>
    </div>
</div>
</template>

<style>
.Image{
  width: 100%;
  height: 100%;
  overflow: hidden;
}
.id{
  background-color: white;
}
.card-hover:hover{
  transform: scale(1.04);
  transition: all 0.3s ease-in-out;
  transition-duration: 0.3s;
  transition-timing-function: ease-in-out;
  transition-delay: 0s;
  /* transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); */
}
</style>