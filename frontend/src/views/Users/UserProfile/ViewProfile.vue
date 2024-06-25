<template>
    <div class="container mt-5">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img :src="user.avatarUrl" alt="User" class="rounded-circle" width="150" />
                                <div class="mt-3">
                                    <h4>{{ user.name }}</h4>
                                    <p class="text-secondary mb-1">{{ user.role }}</p>
                                    <p class="text-muted font-size-sm">{{ user.location }}</p>
                                    <button class="btn btn-outline-primary">Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ user.name }}
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ user.email }}
                                </div>
                            </div>
                            <hr />
                            <!-- Add more rows for other user data -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useUserStore } from '../../../stores/user-store';
import { useField, useForm } from 'vee-validate';
import * as yup from 'yup';
import axios from 'axios';

export default {
  setup() {
    const userStore = useUserStore();

    const { handleSubmit, errors } = useForm({
      validationSchema: yup.object({
        name: yup.string().required('Name is required'),
        email: yup.string().email('Invalid email address').required('Email is required'),
        profile: yup.string().required('Profile is required'),
      }),
    });

    const { value: name, errorMessage: nameError } = useField('name');
    const { value: email, errorMessage: emailError } = useField('email');
    const { value: profile, errorMessage: profileError } = useField('profile');

    const onSubmit = handleSubmit(async (values) => {
      try {
        await axios.post('/api/users', values);
        userStore.fetchUsers();
      } catch (error) {
        console.error('Error creating user:', error);
      }
    });

    return {
      name,
      email,
      profile,
      nameError,
      emailError,
      profileError,
      onSubmit,
    };
  },
};
</script>