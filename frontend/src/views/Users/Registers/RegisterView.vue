<template>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
        <div class="d-flex flex-column justify-content-between h-90 p-3 p-md-4 p-xl-5">
          <img class="img-fluid rounded mx-auto my-3" loading="lazy" src="../../../Images/show.jpg" width="445"
            height="100" alt="Logo">
        </div>
      </div>
      <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
        <div class="p-3 p-md-4 p-xl-5">
          <div class="row">
            <div class="col-12">
              <div class="mb-5">
                <h2 class="h3 text-center">Registration</h2>
              </div>
            </div>
          </div>
          <form @submit="ReSubmit">
            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12" :error="UserNameError">
                <label for="Username" class="form-label">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" v-model="name" id="Username" placeholder="Enter Username" >
              </div>
              <div class="col-12" :error="emailError">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" v-model="email" id="email" placeholder="Enter email">
              </div>
              <div class="col-12" :error="passwordError">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" v-model="password" id="password"
                  placeholder="Enter password">
              </div>
              <div class="col-12" :error="passwordError">
                <label for="password" class="form-label">Password comfirmation<span class="text-danger">*</span></label>
                <input type="password" class="form-control" v-model="password_confirmation" id="passwordConfirmation"
                  placeholder="Password comfirmation">
              </div>
              <!-- Gender  -->
              <div class="form-group">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="male"
                    v-model="gender">
                  <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                    value="female" v-model="gender">
                  <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="other"
                    v-model="gender">
                  <label class="form-check-label" for="inlineRadio2">Other</label>
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button :disabled="isSubmitting" class="btn bsb-btn-xl btn-primary" native-type="submit">Sign
                    up</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <p class="m-0 text-secondary text-center">Already have an account?
                <router-link to="/login">Login</router-link>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useUserStore } from '@/stores/user';

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
const ReSubmit = handleSubmit(async (values) => {
  userStore.createUserCustomer(values);
});

const { value: name, errorMessage: UserNameError } = useField('name')
const { value: gender } = useField('gender')
const { value: email, errorMessage: emailError } = useField('email')
const { value: password, errorMessage: passwordError } = useField('password')
const { value: password_confirmation } = useField('password_confirmation')
</script>
