<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-150 p-5">
    <el-card class="w-full max-w-[550px] shadow-lg">
      <h2 class="text-3xl font-bold mb-6 text-center">Register Shop</h2>
      <el-form @submit.prevent="onSubmit">
        <!-- Name -->
        <el-form-item :error="FirstNameError">
          <b>Username</b>
          <el-input
            placeholder="Enter username"
            v-model="name"
            size="large"
            type="text"
          />
        </el-form-item>
        <!-- Email -->
        <el-form-item :error="emailError">
          <b>Email</b>
          <el-input
            placeholder="Enter Email"
            v-model="email"
            size="large"
            type="email"
          />
        </el-form-item>
        <!-- Password -->
        <el-form-item :error="passwordError">
          <b>Password</b>
          <el-input
            placeholder="Enter your password"
            v-model="password"
            size="large"
            type="password"
          />
        </el-form-item>
        <!-- Confirm Password -->
        <el-form-item :error="confirmPasswordError">
          <b>Confirm password</b>
          <el-input
            placeholder="Enter confirm password"
            v-model="password_confirmation"
            size="large"
            type="password"
          />
        </el-form-item>
        <!-- Select Province -->
        <el-form-item :error="provinceError">
          <b>Select a Province</b>
          <select
            class="form-select"
            aria-label="Default select example"
            v-model="province_id"
            v-if="!isLoading && !error"
          >
            <option
              v-for="province in provinceStore.provinces"
              :key="province.id"
              :value="province.id"
            >
              {{ province.province_name }}
            </option>
          </select>
          <div v-if="isLoading">Loading...</div>
          <div v-if="error">{{ error }}</div>
        </el-form-item>
        <!-- City -->
        <el-form-item :error="cityError">
          <b>City</b>
          <el-input
            placeholder="Enter your city"
            v-model="city"
            size="large"
            type="text"
          />
        </el-form-item>
        <!-- Shop Name -->
        <el-form-item :error="shopError">
          <b>Shop Name</b>
          <el-input
            placeholder="Enter your shop name"
            v-model="shop_name"
            size="large"
            type="text"
          />
        </el-form-item>
        <!-- Gender -->
        <b>Gender</b>
        <el-form-item class="mt-2">
          <div>
            <input
              class="form-check-input mt-2 m-2"
              type="radio"
              name="gender"
              id="male"
              value="male"
              v-model="gender"
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
              v-model="gender"
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
              v-model="gender"
            />
            <label class="form-check-label" for="other">Other</label>
          </div>
        </el-form-item>
        <div>
          <el-button
            size="large"
            class="w-full"
            :disabled="isSubmitting"
            type="primary"
            native-type="submit"
          >
            Register now
          </el-button>
        </div>
      </el-form>
      <p class="mt-4 text-center">
        Already have an owner account? <router-link to="/login">Login now</router-link>
      </p>
    </el-card>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useField, useForm } from 'vee-validate';
import * as yup from 'yup';
import { useRouter } from 'vue-router';
import { useProvinceStore } from '@/stores/province-list';
import { useUserStore } from '@/stores/user';

const router = useRouter();

const provinceStore = useProvinceStore();

onMounted(() => {
  provinceStore.fetchProvinces();
});

const isLoading = provinceStore.isLoading;
const error = provinceStore.error;

// Required form register
const formSchema = yup.object({
  name: yup.string().required().label('Username'),
  email: yup.string().required().email().label('Email address'),
  password: yup.string().required().label('Password'),
  password_confirmation: yup
    .string()
    .required()
    .oneOf([yup.ref('password')], 'Passwords must match')
    .label('Password Confirmation'),
  city: yup.string().required().label('City'),
  shop_name: yup.string().required().label('Shop Name'),
  gender: yup.string().required().label('Gender'),
  province_id: yup.string().required().label('Province'),
});

const { handleSubmit, isSubmitting } = useForm({
  validationSchema: formSchema,
});

const { value: name, errorMessage: FirstNameError } = useField('name');
const { value: gender } = useField('gender');
const { value: email, errorMessage: emailError } = useField('email');
const { value: password, errorMessage: passwordError } = useField('password');
const { value: password_confirmation, errorMessage: confirmPasswordError } =
  useField('password_confirmation');
const { value: city, errorMessage: cityError } = useField('city');
const { value: shop_name, errorMessage: shopError } = useField('shop_name');
const { value: province_id, errorMessage: provinceError } = useField('province_id');

const userStore = useUserStore();

const onSubmit = handleSubmit(async (values) => {
  try {
    await userStore.createUser(values);
    router.push('/login'); 
  } catch (error) {
    console.warn('Error:', error);
  }
});
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>
