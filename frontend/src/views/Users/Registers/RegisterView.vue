<!-- src/components/Login.vue -->
<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100 p-3">
    <el-card class="w-full max-w-md shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-center">Registration</h2>
        <el-form @submit="onSubmit">
            <div class="row">
                <div class="col">
                    <!-- First name -->
                    <el-form-item :error="FirstNameError">
                        <b>First name</b>
                        <el-input placeholder="inter user name" v-model="First_name" size="large" type="text" />
                    </el-form-item>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <el-form-item :error="LastNameError">
                        <b>Last name</b>
                        <el-input placeholder="Last name" v-model="Last_name" size="large" />
                    </el-form-item>
                </div>
            </div>
            <!-- Email -->
            <el-form-item :error="emailError">
                <b>Email</b>
                <el-input placeholder="Email Address" v-model="email" size="large" />
            </el-form-item>
            
            <!-- Password -->
            <el-form-item :error="passwordError" class="">
                <b>Password</b>
                <el-input placeholder="Entern your password" v-model="password" size="large" type="password" />
            </el-form-item>

            <!-- Phone number -->
            <el-form-item :error="phoneError" class="">
                <b>Phone number</b>
                <el-input placeholder="Entern your phone number" v-model="phone" size="large" type="text" />
            </el-form-item>

            <!-- Gander -->
            <b>Gander</b>
            <el-form-item class="mt-2" v-model="gender">
                <div class="">
                    <input class="form-check-input mt-2 m-2" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="">
                    <input class="form-check-input mt-2 m-2" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
            </el-form-item>
        <div>
          <el-button
            size="large"
            class=" w-full"
            :disabled="isSubmitting"
            type="primary"
            native-type="submit"
            >Register now</el-button
          >
        </div>
    </el-form>
    <p class="mt-4 text-center">Already have on acount <a href="">Login now</a></p>
    </el-card>
    <!-- <div class="col-3 ml-6">
        <h2 class="text-center">Welcome to register the employee in SaLon Cambodia</h2>
    </div> -->
  </div>
</template>

<script setup lang="ts">
import axiosInstance from '@/plugins/axios'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useRouter } from 'vue-router'

const router = useRouter()

const formSchema = yup.object({
  First_name: yup.string().required().label('First name'),
  Last_name: yup.string().required().label('Last name'),
  email: yup.string().required().email().label('Email address'),
  password: yup.string().required().label('Password'),
  phone: yup.string().required().label('Phone number'),
})

const { handleSubmit, isSubmitting } = useForm({
  initialValues: {
    First_name: '',
    Last_name: '',
    email: '',
    password: '',
    phone: '',
    gender: ''
  },
  validationSchema: formSchema
})

const onSubmit = handleSubmit(async (values) => {
  try {
    const { data } = await axiosInstance.post('/register', values)
    localStorage.setItem('access_token', data.access_token)
    router.push('/')
  } catch (error) {
    console.warn('Error:', error)
  }
})

const { value: First_name, errorMessage: FirstNameError } = useField('First_name')
const { value: Last_name, errorMessage: LastNameError } = useField('Last_name')
const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')
const { value: phone, errorMessage: phoneError } = useField('phone')

</script>


<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>