<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100 p-3">
    <el-card class="w-full max-w-md shadow-lg">
      <h2 class="text-2xl font-bold mb-6 text-center">Registration</h2>
      <el-form @submit="onSubmit">

        <!-- name -->
        <el-form-item :error="FirstNameError">
          <b>Username</b>
          <el-input placeholder="Enter username" v-model="name" size="large" type="text" />
        </el-form-item>
        <!-- Email -->
        <el-form-item :error="emailError">
          <b>Email</b>
          <el-input placeholder="Enter Email" v-model="email" size="large" type="email"/>
        </el-form-item>

        <!-- Password -->
        <el-form-item :error="passwordError" class="">
          <b>Password</b>
          <el-input
            placeholder="Entern your password"
            v-model="password"
            size="large"
            type="password"
          />
        </el-form-item>

        <!-- Password -->
        <el-form-item :error="passwordError" class="">
          <b>Password comfirmation</b>
          <el-input
            placeholder="Enter your password comfirmation"
            v-model="password_confirmation"
            size="large"
            type="password"
          />
        </el-form-item>
        <!-- Gander -->
        <b>Gander</b>
        <el-form-item class="mt-2">
          <div class="">
            <input
              class="form-check-input mt-2 m-2"
              type="radio"
              name="inlineRadioOptions"
              id="inlineRadio1"
              value="male"
              v-model="gender"
            />
            <label class="form-check-label" for="inlineRadio1">Male</label>
          </div>
          <div class="">
            <input
              class="form-check-input mt-2 m-2"
              type="radio"
              name="inlineRadioOptions"
              id="inlineRadio2"
              value="female"
              v-model="gender"
            />
            <label class="form-check-label" for="inlineRadio2">Female</label>
          </div>
          <div class="">
            <input
              class="form-check-input mt-2 m-2"
              type="radio"
              name="inlineRadioOptions"
              id="inlineRadio3"
              value="other"
              v-model="gender"
            />
            <label class="form-check-label" for="inlineRadio2">Other</label>
          </div>
        </el-form-item>
        <div>
          <el-button
            size="large"
            class="w-full"
            :disabled="isSubmitting"
            type="primary"
            native-type="submit"
            >Register now</el-button
          >
        </div>
      </el-form>

      <p class="mt-4 text-center">
        Already have on acount? <router-link to="/login">Login now</router-link>
      </p>
    </el-card>
  </div>
</template>

<script setup lang="ts">
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useUserStore } from '@/stores/user';

// const router = useRouter()

const formSchema = yup.object({
  name: yup.string().required().label('First name'),
  email: yup.string().required().email().label('Email address'),
  password: yup.string().required().label('Password'),
  password_confirmation: yup.string().required().label('Phone number'),
  gender: yup.string().required().label('Gender')
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    gender: ''
  },
  validationSchema: formSchema
})

const userStore = useUserStore();
  const onSubmit = handleSubmit(async (values) => {
    userStore.createUserCustomer(values);
});

const { value: name, errorMessage: FirstNameError } = useField('name')
const { value: gender} = useField('gender')
const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')
const { value: password_confirmation} = useField('password_confirmation')
</script>


<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>