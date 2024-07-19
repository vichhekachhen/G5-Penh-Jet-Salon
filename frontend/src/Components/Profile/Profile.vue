<template>
  <div class="min-h-screen flex flex-col md:flex-row bg-gray-100">
    <!-- Sidebar -->
    <div class="w-full md:w-1/3 p-6 bg-white shadow-lg">
      <!-- Action Button (Return to Home) -->
      <div class="flex justify-start mb-6">
        <a
          href="/"
          class="bg-pink-600 text-white p-2 rounded-full transition duration-300 hover:bg-pink-700"
        >
          <i class="bi bi-arrow-left"></i>
          <span class="sr-only">Back</span>
        </a>
      </div>
      <!-- Profile Header -->
      <div class="text-center mb-6">
        <img
          :src="profileImage ? profileImagePreview : 'http://127.0.0.1:8000'+userAuth.user.profile"
          class="rounded-full mx-auto mb-4"
          alt="Profile Picture"
          style="width: 80px; height: 80px"
        />
        <h3 class="font-semibold text-xl">{{ userAuth.user.name }}</h3>
        <!-- Button trigger modal -->
        <button
          type="button"
          class="mt-4 bg-pink-500 hover:bg-pink-600 text-white p-2 rounded transition duration-300"
          data-bs-toggle="modal"
          data-bs-target="#profileModal"
        >
          Update Profile
        </button>

        <!-- Modal -->
        <div
          class="modal fade"
          id="profileModal"
          tabindex="-1"
          aria-labelledby="profileModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-pink-500" id="profileModalLabel">Update Profile</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <label for="profileImageUpload" class="block text-gray-700"
                  >Upload Profile Image</label
                >
                <input
                  type="file"
                  id="profileImageUpload"
                  @change="handleImageUpload"
                  class="mt-1 p-2 border rounded w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
                />
                <div v-if="profileImage" class="mt-4">
                  <img :src="profileImage" alt="Preview" class="rounded w-24 h-24 object-cover" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Close
                </button>
                <button
                  type="button"
                  class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition duration-300"
                  @click="updateUserProfile"
                >
                  Save changes
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <!-- Stats Section -->
      <div class="text-left mt-6">
        <div class="mb-4">
          <h6 class="text-gray-800 font-semibold"><b>Email</b></h6>
          <p>{{ userAuth.user.email }}</p>
        </div>
        <div class="mb-4">
          <h6 class="text-gray-800 font-semibold"><b>Phone Number</b></h6>
          <p>{{ userAuth.user.phone }}</p>
        </div>
        <div class="mb-4">
          <h6 class="text-gray-800 font-semibold"><b>Date of Birth</b></h6>
          <p>{{ userAuth.user.birth }}</p>
        </div>
        <div class="mb-4">
          <h6 class="text-gray-800 font-semibold"><b>Gender</b></h6>
          <p>{{ userAuth.user.gender }}</p>
        </div>
        <div>
          <h6 class="text-gray-800 font-semibold"><b>Address</b></h6>
          <p>{{ userAuth.user.location }}</p>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="flex-1 p-6 md:p-10">
      <!-- Success Alert -->
      <div
        v-if="showSuccessAlert"
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
        role="alert"
      >
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">Your profile has been updated successfully.</span>
        <span @click="showSuccessAlert = false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
          <svg
            class="fill-current h-6 w-6 text-green-500"
            role="button"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <title>Close</title>
            <path
              d="M14.348 5.652a.5.5 0 00-.707 0L10 9.293 6.36 5.652a.5.5 0 10-.707.707l3.64 3.641-3.64 3.641a.5.5 0 00.707.707L10 10.707l3.641 3.64a.5.5 0 00.707-.707L10.707 10l3.641-3.641a.5.5 0 000-.707z"
            />
          </svg>
        </span>
      </div>

      <!-- Navigation Tabs -->
      <!-- <div class="mb-6">
        <button
          @click="toggleFormVisibility"
          class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition duration-300"
        >
          Update
        </button>
      </div> -->

      <!-- Form Section -->
      <form

        @submit.prevent="submitForm"
        class="grid grid-cols-1 md:grid-cols-2 gap-6"
      >
        <div>
          <label class="block text-gray-700">Username</label>
          <input
            type="text"
            v-model="userAuth.user.name"
            class="mt-1 p-2 border rounded w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
          />
        </div>
        <div>
          <label class="block text-gray-700">Phone Number</label>
          <input
            type="tel"
            v-model="userAuth.user.phone"
            class="mt-1 p-2 border rounded w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
          />
        </div>
        <div>
          <label class="block text-gray-700">Address</label>
          <input
            type="text"
            v-model="userAuth.user.location"
            class="mt-1 p-2 border rounded w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
          />
        </div>
        <div>
          <label class="block text-gray-700">Email address</label>
          <input
            type="email"
            v-model="userAuth.user.email"
            class="mt-1 p-2 border rounded w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
          />
        </div>
        <div>
          <label class="block text-gray-700">Date Of Birth</label>
          <input
            type="date"
            v-model="userAuth.user.birth"
            class="mt-1 p-2 border rounded w-full focus:outline-none focus:ring-2 focus:ring-pink-500"
          />
        </div>
        <div>
          <label class="block text-gray-700">Gender</label>
          <div class="mt-2">
            <div class="flex items-center mb-2">
              <input
                class="form-check-input mt-1 mr-2"
                type="radio"
                name="gender"
                id="male"
                value="male"
                v-model="userAuth.user.gender"
              />
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="flex items-center mb-2">
              <input
                class="form-check-input mt-1 mr-2"
                type="radio"
                name="gender"
                id="female"
                value="female"
                v-model="userAuth.user.gender"
              />
              <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="flex items-center">
              <input
                class="form-check-input mt-1 mr-2"
                type="radio"
                name="gender"
                id="other"
                value="other"
                v-model="userAuth.user.gender"
              />
              <label class="form-check-label" for="other">Other</label>
            </div>
          </div>
        </div>

        <div class="col-span-2 my-5">
          <button
            type="submit"
            class="w-full bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition duration-300"
          >
            Update
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth-store';
import { useUserStore } from '@/stores/user';

export default {
  data() {
    return {
      isUpdate: false,
      showSuccessAlert: false,
      userAuth: useAuthStore(),
      profileImage: null,
    };
  },
  methods: {
    toggleFormVisibility() {
      this.isUpdate = !this.isUpdate;
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          this.profileImage = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    updateUserProfile() {
      if (this.profileImage) {
        this.userAuth.user.profile = this.profileImage;
      }
      this.closeModal('profileModal');
    },
    closeModal(modalId) {
      const modalElement = document.getElementById(modalId);
      const modal = bootstrap.Modal.getInstance(modalElement);
      if (modal) {
        modal.hide();
      }
    },
    async submitForm() {
      const updatedInfo = {
        name: this.userAuth.user.name,
        phone: this.userAuth.user.phone,
        location: this.userAuth.user.location,
        email: this.userAuth.user.email,
        birth: this.userAuth.user.birth,
        gender: this.userAuth.user.gender,
        profile: this.userAuth.user.profile,
      };
      await useUserStore().updateUserInfo(this.userAuth.user, updatedInfo);
      this.showSuccessAlert = true;
      setTimeout(() => {
        this.showSuccessAlert = false;
      }, 3000);
    },
  },
};
</script>

<style scoped>
.modal-header {
  background-color: #f8f8f8;
}
</style>