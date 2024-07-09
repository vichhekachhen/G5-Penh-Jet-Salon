<template>
  <v-app class="bg-pink-500">
    <v-container>
      <div class="container-lg mt-5">
        <div class="d-flex flex-row justify-content-center">
          <div class="col-md-7 mx-3">
            <div class="card p-3">
              <div class="card-body">
                <h3 class="card-title text-center mb-4">BOOKING SERVICE</h3>
                <div v-if="userAuth.isAuthenticated">
                  <form @submit.prevent="submitBooking">
                    <div class="mb-3">
                      <label for="fullName" class="form-label"><strong>User Name:</strong></label>
                      <input disabled type="text" id="fullName" class="form-control" :value="userAuth.user.name" required />
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label"><strong>Email:</strong></label>
                      <input disabled type="email" id="email" class="form-control" :value="userAuth.user.email" required />
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label"><strong>Phone Number:</strong></label>
                      <input v-model="phone" type="tel" id="phone" class="form-control" required />
                      <div v-if="phoneError" class="text-danger">{{ phoneError }}</div>
                    </div>

                    <div class="row mb-3">
                      <!-- Date -->
                      <div class="col-md-6">
                        <label for="date" class="form-label"><strong>Date:</strong></label>
                        <input v-model="date" type="date" id="date" class="form-control" required />
                        <div v-if="dateError" class="text-danger">{{ dateError }}</div>
                      </div>
                      <!-- Time -->
                      <div class="col-md-6">
                        <label for="time" class="form-label"><strong>Time:</strong></label>
                        <input v-model="time" type="time" id="time" class="form-control" required />
                        <div v-if="timeError" class="text-danger">{{ timeError }}</div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="total" class="form-label"><strong>Total Price: $</strong></label>
                        <input v-model="total" type="text" id="total" class="form-control" required />
                        <div v-if="totalError" class="text-danger">{{ totalError }}</div>
                      </div>
                    </div>
                    <button class="btn btn-primary" type="submit" :disabled="isBooking">
                      Submit
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </v-container>
  </v-app>
</template>

<script>
import { useAuthStore } from '@/stores/auth-store'
import { useUserStore } from '@/stores/user'
import { useField, useForm } from 'vee-validate'
import * as yup from 'yup'
import { useBookingStore } from '@/stores/booking'

export default {
  setup() {
    const userAuth = useAuthStore()
    const formSchema = yup.object({
      phone: yup.string().required().label('Phone'),
      date: yup.date().required().label('Date'),
      time: yup.string().required().label('Time'),
      total: yup.number().required().label('Total Price')
    })

    const { handleSubmit, isBooking } = useForm({
      initialValues: {
        phone: '',
        date: '',
        time: '',
        total: ''
      },
      validationSchema: formSchema
    })

    const BookingStore = useBookingStore()
    const submitBooking = handleSubmit(async (values) => {
      await BookingStore.createUserBooking(values)
    })

    const { value: phone, errorMessage: phoneError } = useField('phone')
    const { value: date, errorMessage: dateError } = useField('date')
    const { value: time, errorMessage: timeError } = useField('time')
    const { value: total, errorMessage: totalError } = useField('total')

    return {
      userAuth,
      phone,
      date,
      time,
      total,
      phoneError,
      dateError,
      timeError,
      totalError,
      isBooking,
      submitBooking
    }
  }
}
</script>