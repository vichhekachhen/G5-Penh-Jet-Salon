<template>
  <div class="min-h-screen flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div class="w-full md:w-1/2 p-4 bg-white">
      <!-- Action Button (Return to Home) -->
      <div class="flex justify-start mb-4">
        <a href="/" class="bg-pink-600 text-white p-2 rounded transition-colors duration-300 btn-sm">
          <i class="bi bi-arrow-left me-2"></i>
          <span class="sr-only">Back</span>
        </a>
      </div>
      <!-- Profile Header -->
      <div class="text-center">
    <img v-if="userAuth.user.profile" class="rounded-circle me-lg-2" :src="userAuth.user.profile" alt="" style="width: 40px; height: 40px">
    <img v-else class="rounded-circle me-lg-2" src="../Images/default-user-image.png" alt="" style="width: 40px; height: 40px">
    <h3 class="font-semibold ">{{ userAuth.user.name }}</h3>

    <!-- Button trigger modal -->
    <button type="button" class="bg-pink-500 hover:bg-pink-600 text-white p-2 rounded transition-colors duration-300" data-bs-toggle="modal" data-bs-target="#profileModal">
      Update Profile
    </button>

    <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-pink-500" id="profileModalLabel">Update Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="file" class="file-upload">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition-colors duration-300" @click="updateUserProfile">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
      <hr>
      <!-- Stats Section -->
      <div class="flex flex-col ml-5">
        <h6 class="text-gray-800 font-semibold">Email</h6>
        <p>{{ userAuth.user.email }}</p>
        <h6 class="text-gray-800 font-semibold">Phone number</h6>
        <p>{{ userAuth.user.phone }}</p>
        <h6 class="text-gray-800 font-semibold">Date of Birth</h6>
        <p>{{ userAuth.user.birth }}</p>
        <h6 class="text-gray-800 font-semibold">Gender</h6>
        <p>{{ userAuth.user.gender }}</p>
        <h6 class="text-gray-800 font-semibold">Address</h6>
        <p>{{ userAuth.user.location }}</p>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-5 md:p-10">
      <!-- Navigation Tabs -->
      <div class="mb-5 md:mb-10">
        <ul class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-5 border-b md:border-none">
          <a @click="toggleFormVisibility" href="#" class="text-pink-500 block">
            Update Information</a>
        </ul>
      </div>

      <!-- Form Section -->
      <form v-if="isUpdate" @submit.prevent="updateUserProfile" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block">Username</label>
          <input type="text" v-model="userAuth.user.name" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div>
          <label class="block">Phone Number</label>
          <input type="tel" v-model="userAuth.user.phone" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div>
          <label class="block">Address</label>
          <input type="text" v-model="userAuth.user.location" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div>
          <label class="block">Email address</label>
          <input type="email" v-model="userAuth.user.email" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div>
          <label class="block">Date Of Birth</label>
          <input type="date" v-model="userAuth.user.birth" class="mt-1 p-2 border rounded w-full" />
        </div>
        <div>
          <label class="block">Gender</label>
          <el-form-item class="mt-2">
            <div>
              <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="male" value="male"
                v-model="userAuth.user.gender" />
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div>
              <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="female" value="female"
                v-model="userAuth.user.gender" />
              <label class="form-check-label" for="female">Female</label>
            </div>
            <div>
              <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="other" value="other"
                v-model="userAuth.user.gender" />
              <label class="form-check-label" for="other">Other</label>
            </div>
          </el-form-item>
        </div>

        <div class="col-span-2 my-5">
          <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded duration-300">
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth-store'
import { useUserStore } from '@/stores/user';
const userAuth = useUserStore();
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      isUpdate: false,
      isClick: false,
      num: 15,
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
      userAuth.updateUserInfo(this.userAuth.user)
      await Swal.fire({
      position: 'top-center',
      icon: 'success',
      title: 'You updated successfully!',
      showConfirmButton: false,
      timer: 1500,
    });
    },
  }
}
</script>
