<template>
    <div class="container my-4">
        <div class="row justify-content-center">
            <div v-if="userAuth.isAuthenticated" class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm">
                    <img src="../../Images/shop1.jpg" class="card-img-top" style=" height: 120px;" alt="User Cover">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div>
                                <img v-if="userAuth.user.profile" class="rounded-circle me-3"
                                    style="width: 80px; height: 80px;" :src="userAuth.user.profile" alt="User Profile">
                                <img v-else src="../../Images/image.png" class="rounded-circle me-3"
                                    style="width: 80px; height: 80px;" alt="User Profile">
                            </div>
                            <h2 class="card-title mb-0 text-muted">{{ userAuth.user.name }}</h2>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <dl class="text-muted">
                                    <dt>Username</dt>
                                    <dd>{{ userAuth.user.name }}</dd>
                                    <dt>Date of Birth</dt>
                                    <dd>{{ userAuth.user.birth }}</dd>
                                    <dt>Gender</dt>
                                    <dd>{{ userAuth.user.gender }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl class="text-muted">
                                    <dt>Location</dt>
                                    <dd>{{ userAuth.user.location }}</dd>
                                    <dt>Phone Number</dt>
                                    <dd>{{ userAuth.user.phone }}</dd>
                                    <dt>Email</dt>
                                    <dd>{{ userAuth.user.email }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end my-3">
                            <button class="btn text-white bg-pink-500 hover:bg-pink-600" data-toggle="modal"
                                data-target="#editProfileModal">
                                Edit Profile
                            </button>
                        </div>
                        <h2 class="card-title mb-3 text-pink-500">Location</h2>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3909.0138350429465!2d104.88050867378648!3d11.550865044434541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951add5e2cd81%3A0x171e0b69c7c6f7ba!2sPasserelles%20num%C3%A9riques%20Cambodia%20(PNC)!5e0!3m2!1sen!2skh!4v1719371386905!5m2!1sen!2skh"
                            class="w-100 rounded-lg" style="height: 300px;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'
import axiosInstance from '@/plugins/axios'
import { useAuthStore } from '@/stores/auth-store'
const userAuth = useAuthStore()

const router = useRouter()


</script>

<style></style>