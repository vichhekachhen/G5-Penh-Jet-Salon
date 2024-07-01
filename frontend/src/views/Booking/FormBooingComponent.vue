<template>
  <div class="container-lg my-5">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="text-black" v-for="listCard in getCart" :key="listCard.id">
          <p><strong>Items:</strong> {{ listCard.name }}</p>
          <p><strong>Original prices:</strong> {{ listCard.price }}</p>
          <p><strong>Discounted prices:</strong> {{ listCard.discount }}</p>
          <p><strong>Quantities:</strong> {{ listCard.quantity }}</p>
          <p><strong>Total price:</strong> {{ listCard.price - listCard.discount }}</p>
        </div>
      </div>
      <div class="col-md-7">
        <div class="card card-shadow">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">PAYMENT SERVICE</h3>
            <form @submit.prevent="processPayment">
              <div class="mb-3">
                <label for="fullName" class="form-label">Full Name:</label>
                <input type="text" id="fullName" v-model="fullName" class="form-control" required />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email Address:</label>
                <input type="email" id="email" v-model="email" class="form-control" required />
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="tel" id="phone" v-model="phone" class="form-control" required />
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="date" class="form-label">Date:</label>
                  <input
                    type="date"
                    id="date"
                    v-model="selectedDate"
                    class="form-control"
                    required
                  />
                </div>
                <div class="col-md-6">
                  <label for="time" class="form-label">Time:</label>
                  <input
                    type="time"
                    id="time"
                    v-model="selectedTime"
                    class="form-control"
                    required
                  />
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="total" class="form-label">Total Price:</label>
                  <input
                    type="number"
                    id="total"
                    v-model.number="totalPrice"
                    class="form-control"
                    required
                  />
                </div>
                <div class="col-md-6">
                  <label for="payment-method" class="form-label">Payment Method:</label>
                  <select
                    id="payment-method"
                    v-model="selectedPaymentMethod"
                    class="form-select"
                    required
                  >
                    <option value="" disabled>Select Payment Method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                  </select>
                </div>
              </div>
              <div v-if="selectedPaymentMethod === 'credit_card'" class="mb-3">
                <label for="card" class="form-label">Credit Card Number:</label>
                <input
                  type="text"
                  id="card"
                  v-model="creditCardNumber"
                  class="form-control"
                  placeholder="XXXX XXXX XXXX XXXX"
                  required
                />
                <img
                  src="https://tradegeos.co.uk/wp-content/uploads/png-clipart-mastercard-visa-credit-card-paypal-logo-mastercard-text-display-advertising-removebg-preview-1.png"
                  alt=""
                  class="img-fluid mt-2"
                />
              </div>
              <div class="d-grid mt-4">
                <button type="submit" class="btn btn-info btn-lg">Pay Now</button>
              </div>
            </form>
          </div>
          {{listcard}}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useCartStore } from '@/stores/cart-store'

export default {

  props: {
    items: Object
  },
  data() {
    return {
      fullName: '',
      email: '',
      phone: '',
      selectedDate: '',
      selectedTime: '',
      totalPrice: null,
      selectedPaymentMethod: '',
      creditCardNumber: ''
    }
  },
  computed: {
    getCart() {
      const store = useCartStore()
      return store.cart
    }
  },
  methods: {
    processPayment() {
      if (
        !this.fullName ||
        !this.email ||
        !this.phone ||
        !this.selectedDate ||
        !this.selectedTime ||
        !this.totalPrice ||
        !this.selectedPaymentMethod
      ) {
        alert('Please fill in all required fields.')
        return
      }

      if (this.selectedPaymentMethod === 'credit_card' && !this.creditCardNumber) {
        alert('Please enter credit card details.')
        return
      }

      console.log('Processing payment...', {
        fullName: this.fullName,
        email: this.email,
        phone: this.phone,
        date: this.selectedDate,
        time: this.selectedTime,
        totalPrice: this.totalPrice,
        paymentMethod: this.selectedPaymentMethod,
        creditCardNumber: this.creditCardNumber
      })

      this.resetForm()
    },
    resetForm() {
      this.fullName = ''
      this.email = ''
      this.phone = ''
      this.selectedDate = ''
      this.selectedTime = ''
      this.totalPrice = null
      this.selectedPaymentMethod = ''
      this.creditCardNumber = ''
    }
  }
}
</script>

<style scoped>
body {
  font-family: 'Arial', sans-serif;
  background-color: #e063da;
  margin-top: 50px;
}

.container-lg {
  max-width: 1000px;
}

.card {
  border-radius: 30px;
  box-shadow: 0 10px 8px rgba(126, 3, 104, 0.1);
  padding: 20px;
  margin-bottom: 20px;
  background-color: #d17ec75c;
  border: 1px solid #931271;
  border-radius: 20px;
}

.card-body {
  padding: 2rem;
}

.card-title {
  font-size: 2.5rem;
  font-weight: bold;
  margin-bottom: 2rem;
}

.form-label {
  font-size: 1.1rem;
  font-weight: bold;
}

.form-control {
  border-radius: 8px;
  border: 1px solid #ced4da;
  padding: 0.8rem;
}

.form-select {
  border-radius: 8px;
  border: 1px solid #ced4da;
  padding: 0.8rem;
}

.btn-lg {
  border-radius: 8px;
  background-color: #ae6fac;
  border-color: #845580;
  padding: 0.75rem 1.5rem;
  font-size: 1.2rem;
  transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-lg:hover {
  background-color: #912797;
  border-color: #da1b9e;
}

.text-black {
  color: black;
  font-weight: bold;
  font-size: 20px;
  text-align: left;
  margin-bottom: 20px;
  margin-top: 10px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  background-color: #f8f9fa;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}
</style>
