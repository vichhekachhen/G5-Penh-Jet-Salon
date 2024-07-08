<template>
      <div class="flex items-center justify-center min-h-screen bg-gray-150 p-5">
        <el-card class="w-full max-w-[550px] shadow-lg">
          <h2 class="text-3xl font-bold mb-6 text-center">Register Shop</h2>
          <el-form @submit.prevent="onSubmit">
            <!-- Name -->
            <el-form-item :error="FirstNameError">
              <b>Profile</b>
              <el-input
                v-model="profile"
                size="large"
                type="file"
              />
            </el-form-item>
            <!-- phone -->
            <el-form-item :error="phoneError">
              <b>Phone</b>
              <el-input
                placeholder="Enter Phone"
                v-model="phone"
                size="large"
                type="text"
              />
            </el-form-item>
            <!-- address -->
            <el-form-item :error="addressError">
              <b>Address</b>
              <el-input
                placeholder="Enter your address"
                v-model="address"
                size="large"
                type="address"
              />
            </el-form-item>
            <!-- Confirm address -->
            <el-form-item :error="birthError">
              <b></b>
              <el-input
                placeholder="Pickup birht"
                v-model="birth"
                size="large"
                type="date"
              />
            </el-form-item>
            <!-- qr -->
            <el-form-item :error="qrError">
              <b></b>
              <el-input
                placeholder="Pickup birht"
                v-model="qr"
                size="large"
                type="file"
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
                Go In
              </el-button>
            </div>
          </el-form>
        </el-card>
      </div>
    </template>
    
    <script setup lang="ts">
    import {onMounted } from 'vue';
    import { useField, useForm } from 'vee-validate';
    import * as yup from 'yup';
    import { useProvinceStore } from '../../../stores/province-list';
    import { useUserStore } from '../../../stores/user';
    
    const provinceStore = useProvinceStore();
    
    onMounted(() => {
      provinceStore.fetchProvinces();
    });
    
    // Required form register
    const formSchema = yup.object({
      profile: yup.string().required().label('Profile'),
      phone: yup.string().required().label('phone address'),
      address: yup.string().required().label('address'),
      birth: yup.string().required().label('birth'),
      qr: yup.string().required().label('QR'),
    });
    
    const { handleSubmit, isSubmitting } = useForm({
      validationSchema: formSchema,
    });
    
    const { value: profile, errorMessage: FirstNameError } = useField('profile');
    const { value: phone, errorMessage: phoneError } = useField('phone');
    const { value: address, errorMessage: addressError } = useField('address');
    const { value:birth, errorMessage: birthError } =
      useField('birth');
    const { value: qr, errorMessage: qrError } = useField('qr');
    
    const userStore = useUserStore();
    
    const onSubmit = handleSubmit(async (values) => {
        userStore.addInfoToOwner(values);
    });
    </script>
    
    <style scoped>
    .min-h-screen {
      min-height: 100vh;
    }
    </style>
    