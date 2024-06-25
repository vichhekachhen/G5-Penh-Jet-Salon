<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-150 p-5">
    <el-card class="w-full max-w-[550px] shadow-lg">
      <h2 class="text-3xl font-bold mb-6 text-center">Register Shop</h2>
      <el-form @submit.prevent="onSubmit">
        <!-- Name -->
        <el-form-item :error="FirstNameError">
          <b>Username</b>
          <el-input placeholder="Enter username" v-model="name" size="large" type="text" />
        </el-form-item>
        <!-- Email -->
        <el-form-item :error="emailError">
          <b>Email</b>
          <el-input placeholder="Enter Email" v-model="email" size="large" type="email" />
        </el-form-item>
        <!-- Password -->
        <el-form-item :error="passwordError" class="">
          <b>Password</b>
          <el-input placeholder="Enter your password" v-model="password" size="large" type="password" />
        </el-form-item>
        <!-- Confirm Password -->
        <el-form-item :error="confirmPasswordError" class="">
          <b>Confirm password</b>
          <el-input placeholder="Enter confirm password" v-model="confirmPassword" size="large" type="password" />
        </el-form-item>
        <!-- Select Province -->
        <div>
          <b>Select Province</b>
          <el-select v-model="selectedProvince" placeholder="Select Province">
            <el-option v-for="province in provinces" :key="province.id" :label="province.province_name"
              :value="province.id">
              {{ province.province_name }}
            </el-option>
          </el-select>
        </div>
        <!-- City -->
        <el-form-item :error="cityError">
          <b>City</b>
          <el-input placeholder="Enter your city" v-model="city" size="large" type="text" />
        </el-form-item>
        <!-- Shop Name -->
        <el-form-item :error="shopError">
          <b>Shop Name</b>
          <el-input placeholder="Enter your shop name" v-model="shop" size="large" type="text" />
        </el-form-item>
        <!-- Gender -->
        <b>Gender</b>
        <el-form-item class="mt-2">
          <div class="">
            <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="male" value="male"
              v-model="gender" />
            <label class="form-check-label" for="male">Male</label>
          </div>
          <div class="">
            <input class="form-check-input mt-2 m-2" type="radio" name="gender" id="female" value="female"
              v-model="gender" />
            <label class="form-check-label" for="female">Female</label>
          </div>
        </el-form-item>
        <div>
          <el-button size="large" class="w-full" :disabled="isSubmitting" type="primary" native-type="submit">
            Register now
          </el-button>
        </div>
      </el-form>
      <p class="mt-4 text-center">
        Already have an owner account? <router-link to="/loginOwner">Login now</router-link>
      </p>
    </el-card>
  </div>
</template>

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'
import { onMounted, ref } from 'vue'
import { useProvinceStore } from '@/stores/province-list'

const router = useRouter()
const provinceStore = useProvinceStore()

// Required form register
const formSchema = yup.object({
  name: yup.string().required().label('Username'),
  email: yup.string().required().email().label('Email address'),
  password: yup.string().required().label('Password'),
  confirmPassword: yup.string().required().oneOf([yup.ref('password')], 'Passwords must match').label('Password Confirmation'),
  city: yup.string().required().label('City'),
  shop: yup.string().required().label('Shop Name'),
  gender: yup.string().required().label('Gender'),
  selectedProvince: yup.string().required().label('Province')
})

// Submit register form
const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    name: '',
    email: '',
    password: '',
    confirmPassword: '',
    city: '',
    shop: '',
    gender: '',
    selectedProvince: ''
  },
  validationSchema: formSchema
})

// Get form field value and error message
const { value: name, errorMessage: FirstNameError } = useField('name')
const { value: gender } = useField('gender')
const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')
const { value: confirmPassword, errorMessage: confirmPasswordError } = useField('confirmPassword')
const { value: city, errorMessage: cityError } = useField('city')
const { value: shop, errorMessage: shopError } = useField('shop')
const { value: selectedProvince, errorMessage: provinceError } = useField('selectedProvince')

// Get provinces
onMounted(() => {
  provinceStore.fetchProvinces()
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/registerOwner', values)
    localStorage.setItem('access_token', data.access_token)
    router.push('/loginOwner')
  } catch (error) {
    console.warn('Error:', error)
  }
})
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>