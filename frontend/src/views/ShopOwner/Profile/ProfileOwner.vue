<template>
  <div class="container mt-6">
    <div class="row gutters">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
          <div class="card-body text-center">
            <div class="account-settings">
              <div class="user-profile">
                <img class="rounded-circle me-lg-2" alt="owner img" src="../../../Images/shop1.jpg"
                  style="width: 100px; height: 100px;" />
                <h5 class="user-name text-center mt-4">{{ userAuth.name }}</h5>
                <p>{{ userAuth.email }}</p>
              </div>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal">
                Update Profile
              </button>
            </div>
            <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel"
              aria-hidden="true">
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
                    <button type="submit"
                      class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded transition-colors duration-300">Save
                      changes</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100">
          <div class="card-body">
            <div class="row gutters">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h4 class="mb-4 text-pink-500 text-center">Personal Details</h4>
              </div>
              <hr />
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="phone">Phone: </label>
                  <p> (+885){{ userAuth.phone }}</p>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="birth">Birth: </label>
                  <p>{{ userAuth.birth }}</p>
                </div>
              </div>
              <hr>
            </div>
            <div class="row gutters">
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="location">Location: </label>
                  <p>{{ userAuth.location }}</p>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <label for="gender">Gender :</label>
                  <p>{{ userAuth.gender }}</p>
                </div>
              </div>
            </div>
          </div>
          <!-- update profile -->
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateOwner">
            Edit
          </button>
          <!-- Modal -->
          <div class="modal fade" id="updateOwner" tabindex="-1" aria-labelledby="updateOwnerLabel" aria-hidden="true">
            <div class="modal-dialog mt-3">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-pink-500" id="updateOwnerLabel">Update information</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- form body -->
                <div class="modal-body md-2">
                  <div class="mb-3">
                    <label class="block">Username: </label>
                    <input type="text" v-model="userAuth.name" class="mt-1 p-2 border rounded w-full" />
                  </div>
                  <div class="mb-3">
                    <label class="block">Email:</label>
                    <input type="email" v-model="userAuth.email" class="mt-1 p-2 border rounded w-full" />
                  </div>
                  <div class="mb-3">
                    <label class="block">Phone Number: </label>
                    <input type="tel" v-model="userAuth.phone" class="mt-1 p-2 border rounded w-full" />
                  </div>
                  <div class="mb-3">
                    <label class="block">Address: </label>
                    <input type="text" v-model="userAuth.location" class="mt-1 p-2 border rounded w-full" />
                  </div>
                  <div class="mb-3">
                    <label class="block">Date Of Birth</label>
                    <input type="date" v-model="userAuth.birth" class="mt-1 p-2 border rounded w-full" />
                  </div>
                  <div>
                    <label class="block">Gender</label>
                    <el-form-item class="mt-2">
                      <div>
                        <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="male" value="Male"
                          v-model="userAuth.gender" />
                        <label class="form-check-label" for="male">Male</label>
                      </div>
                      <div>
                        <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="female" value="Female"
                          v-model="userAuth.gender" />
                        <label class="form-check-label" for="female">Female</label>
                      </div>
                      <div>
                        <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="other" value="Other"
                          v-model="userAuth.gender" />
                        <label class="form-check-label" for="other">Other</label>
                      </div>
                    </el-form-item>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" @click="saveUser">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <!-- end -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { useAuthStore } from '../../../stores/auth-store'
export default {
  name: 'ProfileOwner',
  data() {
    return {
      isModalVisible: false,
      userAuth: useAuthStore().user,
    }
  },
  methods: {
    saveUser() {
      // Save user logic
      console.log('user saved:', this.userAuth)
      this.hideUpdateModal()
    },
    hideUpdateModal() {
      this.isModalVisible = false
    }
  }
}
</script>

<style>
.modal.show {
  display: block;
}

.modal {
  background: rgba(0, 0, 0, 0.5);
}

@media (max-width: 840px) {
  .col-xl-3, .col-xl-9 {
    flex: 0 0 100%;
    max-width: 100%;
    padding: 10px;
  }
}
@media (max-width: 1024px) {
  .col-xl-3, .col-xl-9 {
    flex: 0 0 100%;
    max-width: 100%;
  }
}
</style>
