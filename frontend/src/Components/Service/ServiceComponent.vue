khav SAROEUN [ {WEP 2024 C} ]🛸, [6/24/2024 8:54 AM]
<template>
  <div class="">
    <div class="flex items-center justify-center py-4 md:py-8 flex-wrap bg-gray-900 sticky top-0 z-50">
      <button
        type="button"
        class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800"
      >
        All categories
      </button>
      <button
        type="button"
        class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800"
      >
        Man
      </button>
      <button
        type="button"
        class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800"
      >
        Woman
      </button>
      <button
        type="button"
        class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800"
      >
        Product
      </button>
    </div>
    <div class="grid grid-flow-row-dense grid-cols-3">
      <div class="col-span-2 ml-6">
        <div class="grid grid-cols-2 mb-0 gap-x-5 gap-y-0">
          <!-- card service -->
          <div v-for="service in services" :key="service"
            class="max-w-lg mx-auto h-3/4 bg-white rounded-lg shadow-md overflow-hidden p-4 flex items-center mb-0"
          >
            <div class="flex-1 mt-3">
              <p class="text-lg font-semibold text-gray-900 ">Passion Macchiato</p>
              <p class="text-pink-500 text-xl font-bold">
                $1.40 <span class="line-through text-gray-500">$1.75</span>
                <span class="text-gray-500 ml-3"
                    > <a href=""><svg
                      class="h-6 w-6 text-red-500"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                      />
                    </svg></a>
                    : 01</span
                  >
              </p>
              <p class="text-gray-700">
                For ref only: To add a unique flavor fresh passion
              </p>
            </div>
            <div class="relative w-30 h-30 ml-4">
              <img
                class="w-full h-full object-cover rounded-lg"
                src="https://i.pinimg.com/564x/7e/95/ca/7e95ca066aed1767823721ad53e5d83a.jpg"
                alt="Taxi Tea"
              />
              <button class="absolute bottom-2 right-2 bg-white rounded-full p-1 shadow-md">
                <svg class="h-6 w-6 text-pink-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- booking -->
      <div class="col-span-1 sticky top-30 z-50">
        <div>

khav SAROEUN [ {WEP 2024 C} ]🛸, [6/24/2024 8:54 AM]
<div class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden p-3">
            <div class="max-h-49 overflow-y-auto pl-3">
              <div class="flex justify-between items-center mb-2">
                <span class="text-pink-500 font-semibold">គ្រាប់ឆូក</span>
                <!-- <span class="text-gray-500">20 បញ្ចី</span> -->
              </div>
              <div class="flex flex-col space-y-4">
                <div class="flex items-center space-x-4">
                  <img
                    class="w-16 h-16 object-cover rounded-lg"
                    src="https://i.pinimg.com/564x/7e/95/ca/7e95ca066aed1767823721ad53e5d83a.jpg"
                    alt="Item"
                  />
                  <div class="flex-1">
                    <h5 class="text-base font-bold text-gray-900">គ្រាប់ឆូកបាការ៉តា</h5>
                    <p class="text-red-500 text-base font-bold">
                      $1.40 <span class="line-through text-gray-500">$4.75</span>
                    </p>
                  </div>
                  <div class="flex items-center border-solid p-1.5 rounded-full">
                    <button class="border-none bg-white">
                      <svg
                        class="h-6 w-6 text-red-500"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="4" y1="7" x2="20" y2="7" />
                        <line x1="10" y1="11" x2="10" y2="17" />
                        <line x1="14" y1="11" x2="14" y2="17" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                      </svg>
                    </button>
                    <span class="text-gray-500 font-bold">1</span>
                    <button class="border-none bg-white">
                      <svg
                        class="h-6 w-6 text-green-500"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M15 7v-4h-12v12.01h4" stroke-dasharray=".001 4" />
                        <path d="M19 11v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" />
                        <path d="M13 13l9 3l-4 2l-2 4l-3 -9" />
                      </svg>
                    </button>
                  </div>
                </div>
                <div class="flex items-center space-x-4">
                  <img
                    class="w-16 h-16 object-cover rounded-lg"
                    src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                    alt="Item"
                  />
                  <div class="flex-1">
                    <h2 class="text-base font-semibold text-gray-900">តែដិចម៉ាន់ហ្គូ</h2>
                    <p class="text-red-500 text-base font-bold">
                      $1.40 <span class="line-through text-gray-500">$4.75</span>
                    </p>
                  </div>
                  <div class="flex items-center border-solid p-1.5 rounded-full">
                    <button class="border-none bg-white">
                      <svg
                        class="h-6 w-6 text-red-500"
                        width="24"
                        height="24"

khav SAROEUN [ {WEP 2024 C} ]🛸, [6/24/2024 8:54 AM]
viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <line x1="4" y1="7" x2="20" y2="7" />
                        <line x1="10" y1="11" x2="10" y2="17" />
                        <line x1="14" y1="11" x2="14" y2="17" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                      </svg>
                    </button>
                    <span class="text-gray-500 font-bold">1</span>
                    <button class="border-none bg-white">
                      <svg
                        class="h-6 w-6 text-green-500"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        fill="none"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M15 7v-4h-12v12.01h4" stroke-dasharray=".001 4" />
                        <path d="M19 11v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2" />
                        <path d="M13 13l9 3l-4 2l-2 4l-3 -9" />
                      </svg>
                    </button>
                  </div>
                </div>
                </div>
                <h1>date</h1>
                <h1>time</h1>
            </div>
              <div class="border-t mt-4 pt-4">
                <div class="flex justify-between items-center">
                  <span class="font-semibold text-gray-900">សរុប</span>
                  <span class="text-gray-900">$2.80</span>
                </div>
                <button class="mt-4 bg-pink-500 text-white w-full py-2 rounded-lg shadow-md">
                  តំរូវការទិញរបស់ខ្ញុំបញ្ចូលក្នុងការចូលរួម
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
</template>

<script >
export default{
  data(){
    return {
      services:8
    }
  }
}

</script>

<style>
</style>