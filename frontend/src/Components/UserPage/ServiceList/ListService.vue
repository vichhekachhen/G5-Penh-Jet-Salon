<template>
  <div>
    <img class="w-100 h-35" src="../../../Images/shop1.jpg" alt="">
    <div class="flex items-center justify-around py-4 md:py-8 flex-wrap bg-light sticky top-0 z-50">
      <button type="button"
        class="relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-1 hover:after:bg-pink-500 transition-all duration-300"><b>Man</b></button>
      <button type="button"
        class="relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-1 hover:after:bg-pink-500 transition-all duration-300"><b>Woman</b></button>
      <button type="button"
        class="relative hover:after:content-[''] hover:after:absolute hover:after:bottom-0 hover:after:left-0 hover:after:w-full hover:after:h-1 hover:after:bg-pink-500 transition-all duration-300"><b>Product</b></button>
    </div>

    <div class="grid grid-cols-2 mt-4">
      <!-- cart service -->
      <div class="col-span-1 ml-6">
        <div class="grid grid-cols-2 mb-0 gap-x-5 gap-y-0">
          <!-- card service -->
          <div
            class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden p-6 flex items-center mb-0">
            <div class="flex-1">
              <p class="text-xl font-bold text-gray-900">Name</p>
              <p class="text-pink-500 text-2xl font-bold">
                <span class="line-through text-gray-500">$99.99</span>
                <span class="text-gray-500 ml-3">$79.99</span>
              </p>
              <p class="text-gray-700 mt-2">description</p>
            </div>
            <div class="relative w-36 h-36 ml-6">
              <img class="w-full h-full object-cover rounded-lg" src="https://via.placeholder.com/300x300"
                alt="Service Image" />
              <button
                class="absolute bottom-2 right-2 bg-white rounded-full p-2 shadow-md hover:bg-pink-500 hover:text-white transition-colors">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="12" y1="5" x2="12" y2="19" />
                  <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>