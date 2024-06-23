<script setup lang="ts">
import { Icon } from '@iconify/vue'
</script>
<template>
  <header class="flex justify-between px-15 py-2 bg-light items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-2">
      <Icon icon="skill-icons:devto-dark" style="font-size: 45px" />
      <span class="text-xl font-bold">I-KNOW</span>
    </div>

    <!-- Menu Items -->
    <nav class="navbar navbar-default flex justify-center space-x-4">
      <router-link class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900 nav-link" aria-current="page" to="/">Home</router-link>
      <router-link class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900 nav-link" to="/post">Post</router-link>
      <router-link class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900 nav-link" to="/team"> Team</router-link>
      <router-link class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900 nav-link" to="/projects">Project</router-link>
      <router-link class="font-bold px-3 py-2 text-slate-700 rounded-lg hover:bg-slate-100 hover:text-slate-900 nav-link" to="/reports">Report</router-link>
    </nav>

    <!-- Sign In -->
    <div>
      <!-- <router-link class="px-4 py-2 rounded font-semibold" to="/login">Login now</router-link> -->
    </div>
  </header>
</template>
