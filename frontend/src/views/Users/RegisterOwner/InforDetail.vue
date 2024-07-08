<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-150 p-5">
    <el-card class="w-full max-w-[550px] shadow-lg">
      <h2 class="text-3xl font-bold mb-6 text-center">Register Shop</h2>
      <el-form @submit.prevent="onSubmit" enctype="multipart/form-data">
        <!-- Profile -->
        <el-form-item :error="profileError">
          <b>Profile</b>
          <input
            :v-model="profile"
            size="large"
            type="file"
            accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"
            @change="onFileChange('profile', $event)"
          />
        </el-form-item>
        <!-- Phone -->
        <el-form-item :error="phoneError">
          <b>Phone</b>
          <el-input placeholder="Enter Phone" v-model="phone" size="large" type="text" />
        </el-form-item>
        <!-- Location -->
        <el-form-item :error="locationError">
          <b>Address</b>
          <el-input
            placeholder="Enter your location"
            v-model="location"
            size="large"
            type="text"
          />
        </el-form-item>
        <!-- Birth -->
        <el-form-item :error="birthError">
          <b>Birth Date</b>
          <el-input placeholder="Pick your birth date" v-model="birth" size="large" type="date" />
        </el-form-item>
        <!-- QR Code -->
        <el-form-item :error="qrError">
          <b>QR Code</b>
          <input
            :v-model="qr_code"
            size="large"
            type="file"
            accept="image/jpeg,image/png,image/jpg,image/gif,image/svg+xml"
            @change="onFileChange('qr_code', $event)"
          />
        </el-form-item>
        <div>
          <el-button
            size="large"
            class="w-full"
            :disabled="isSubmitting"
            type="primary"
            native-type="submit"
          >
            Register
          </el-button>
        </div>
      </el-form>
    </el-card>
  </div>
</template>

<script setup lang="ts">
import { onMounted} from 'vue'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useProvinceStore } from '../../../stores/province-list'
import { useUserStore } from '../../../stores/user'

// Fetching provinces
const provinceStore = useProvinceStore()
onMounted(() => {
  provinceStore.fetchProvinces()
})

// Form validation schema
const formSchema = yup.object({
  profile: yup
    .mixed()
    .required('Profile is required')
    .test('fileType', 'Profile must be an image', (value) => {
      return value && ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'].includes(value.type)
    }),
  phone: yup.string().required('Phone is required').label('Phone'),
  location: yup.string().required('Location is required').label('Location'),
  birth: yup.date().required('Birth date is required').label('Birth'),
  qr_code: yup
    .mixed()
    .required('QR code is required')
    .test('fileType', 'QR code must be an image', (value) => {
      return value && ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml'].includes(value.type)
    })
})

const { handleSubmit, isSubmitting } = useForm({
  validationSchema: formSchema
})

const { value: profile, errorMessage: profileError, setValue: setProfile } = useField('profile')
const { value: phone, errorMessage: phoneError } = useField('phone')
const { value: location, errorMessage: locationError } = useField('location')
const { value: birth, errorMessage: birthError } = useField('birth')
const { value: qr_code, errorMessage: qrError, setValue: setQRCode } = useField('qr_code')

const userStore = useUserStore()

const onFileChange = (field, event) => {
  const file = event.target.files[0]
  if (field === 'profile') {
    setProfile(file)
  } else if (field === 'qr_code') {
    setQRCode(file)
  }
}

const onSubmit = handleSubmit(async (values) => {
  if (values.profile.value){
    values.profile = values.profile.value
  }
  if (values.qr_code.value){
    values.qr_code = values.qr_code.value
  }
  await userStore.addInfoToOwner(values)
})
</script>

<style scoped>
.min-h-screen {
  min-height: 100vh;
}
</style>
