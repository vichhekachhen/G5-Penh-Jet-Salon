<template>
  <div class="min-h-screen bg-gray-100 flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div class="w-full md:w-1/4 p-5 bg-white">
      <!-- Profile Header -->
      <div class="flex items-center space-x-4 p-2 mb-5">
        <img src="../../Images/logo.png" alt="Profile Picture" class="h-16 w-16 rounded-full" />
        <div>
          <h2 class="font-semibold text-lg">{{ userAuth.user.name }}</h2>
          <p class="text-sm text-gray-600">Penh Jet Salon</p>
        </div>
      </div>
      <!-- Stats Section -->
      <div class="flex flex-col gap-2">
        <span class="text-gray-800 font-semibold">Email:</span>
        <small>{{ userAuth.user.email }}</small>
        <span class="text-gray-800 font-semibold">Phone number:</span>
        <small>{{ userAuth.user.phone }}</small>
        <span class="text-gray-800 font-semibold">Date of Birth: </span>
        <small>{{ userAuth.user.birth }}</small>
        <span class="text-gray-800 font-semibold">Gender: </span>
        <small>{{ userAuth.user.gender }}</small>
      </div>
      <!-- Action Button (Return to Home) -->
      <router-link
        to="/"
        type="button"
        class="mt-6 text-white bg-gray-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          height="24px"
          viewBox="0 -960 960 960"
          width="24px"
          fill="#5f6368"
        >
          <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" />
        </svg>
      </router-link>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-5 md:p-10">
      <!-- Navigation Tabs -->
      <div class="mb-5 md:mb-10">
        <ul
          class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-5 border-b md:border-none"
        >
          <a
            @click="toggleFormVisibility"
            href="#"
            class="text-white-500 hover:text-white-600 pb-2 md:pb-0 border-b-2 md:border-none border-blue-500 md:hover:border-blue-600 block"
            >Update Account</a
          >
          <a
            @click="toggleHistory"
            href="#"
            class="text-white-500 hover:text-white-600 pb-2 md:pb-0 border-b-2 md:border-none border-blue-500 md:hover:border-blue-600 block"
            >History</a
          >
        </ul>
      </div>

      <!-- Form Section -->
      <form
        v-if="isUpdate"
        @submit.prevent="updateUserProfile"
        class="grid grid-cols-1 md:grid-cols-2 gap-6"
      >
        <div>
          <label class="block">Username</label>
          <input type="text" v-model="userAuth.user.name" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div>
          <label class="block">Phone Number</label>
          <input type="tel" v-model="userAuth.user.phone" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div>
          <label class="block">Location</label>
          <input
            type="text"
            v-model="userAuth.user.location"
            class="mt-1 p-2 border rounded w-full"
          />
        </div>
        <div>
          <label class="block">Email address</label>
          <input
            type="email"
            v-model="userAuth.user.email"
            class="mt-1 p-2 border rounded w-full"
          />
        </div>
        <el-form-item class="mt-2">
          <div>
            <input
              class="form-check-input mt-2 m-2"
              type="radio"
              name="gender"
              id="male"
              value="male"
              v-model="userAuth.user.gender"
            />
            <label class="form-check-label" for="male">Male</label>
          </div>
          <div>
            <input
              class="form-check-input mt-2 m-2"
              type="radio"
              name="gender"
              id="female"
              value="female"
              v-model="userAuth.user.gender"
            />
            <label class="form-check-label" for="female">Female</label>
          </div>
          <div>
            <input
              class="form-check-input mt-2 m-2"
              type="radio"
              name="gender"
              id="other"
              value="other"
              v-model="userAuth.user.gender"
            />
            <label class="form-check-label" for="other">Other</label>
          </div>
        </el-form-item>
        <div>
          <label class="block">Date Of Birth</label>
          <input type="date" v-model="userAuth.user.birth" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div class="col-span-2">
          <button
            type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
          >
            Update
          </button>
        </div>
      </form>

      <!-- History Section -->
      <div v-if="isClick" class="container mx-auto py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
          <div class="bg-gray-800 text-white font-bold py-2 px-4">Transaction List</div>
          <div class="p-4">
            <table class="w-full table-auto">
              <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                  <th class="py-3 px-6 text-left">Customer</th>
                  <th class="py-3 px-6 text-left">Transaction Date</th>
                  <th class="py-3 px-6 text-left">Amount</th>
                  <th class="py-3 px-6 text-left">Status</th>
                </tr>
              </thead>
              <tbody class="text-gray-600 text-sm font-light">
                <tr
                  v-for="n in num"
                  :key="n"
                  class="border-b border-gray-200 table-row hover:bg-gray-100"
                >
                  <td class="py-3 px-6">Customer Name</td>
                  <td class="py-3 px-6">2024-06-28</td>
                  <td class="py-3 px-6">$100.00</td>
                  <td class="py-3 px-6">Paid</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth-store'
import axiosInstance from '@/plugins/axios'

export default {
  data() {
    return {
      username: 'Nathaniel',
      phoneNumber: '+1800-000',
      location: 'Phnom Penh',
      email: 'nathaniel.poole@microsoft.com',
      gender: 'male',
      dob: '',
      isUpdate: false,
      isClick: false,
      num: 15,
      currentPage: 1,
      pageSize: 10,
      totalRecords: 97,
      pageLinks: [],
      userAuth: useAuthStore()
    }
  },
  methods: {
    toggleFormVisibility() {
      this.isUpdate = !this.isUpdate
      this.isClick = false
    },
    toggleHistory() {
      this.isClick = !this.isClick
      this.isUpdate = false
    },
    submitForm() {
      console.log('Form submitted!')
      this.isUpdate = false
    },
    async updateUserProfile() {
      try {
        const response = await axiosInstance.put('/updateInfo', this.userAuth.user)
        console.log(response.data.message)
      } catch (error) {
        console.error('Error updating profile:', error)
      }
    }
  }
}
</script>
