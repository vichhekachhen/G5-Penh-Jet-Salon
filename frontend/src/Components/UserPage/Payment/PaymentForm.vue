<template>
    <v-app class="bg-pink-500">
      <v-container>
        <div class="container-lg my-5">
          <div class="d-flex flex-row justify-content-center">
  
            <!-- Invoice Card -->
            <div class="col-md-5 card p-3 mx-3 bg-light" >
              <div>
                <h4 class="text-center p-2 ">Your Order From</h4>
              </div>
              <hr class="border-2"/>
              <div class="card p-3 rounded">
                <p><strong>Service Name:</strong> </p>
                <p><strong>Price:</strong> </p>
                <p><strong>Quantity:</strong> </p>
              </div>
              <div class="card-footer text-center">
                <p class="display-6 p-3">Total Amount: </p>
              </div>
            </div>
  
            <!-- Payment Form -->
            <div class="col-md-7 mx-3">
              <div class="card p-3">
                <div class="card-body">
                  <h3 class="card-title text-center mb-4" >PAYMENT SERVICE</h3>
                  <form @submit.prevent="processPayment">
                    <div class="mb-3">
                      <label for="fullName" class="form-label" ><strong>User Name:</strong></label>
                      <input type="text" id="fullName" v-model="fullName" class="form-control"
                       required />
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label" ><strong>Email:</strong></label>
                      <input type="email" id="email" v-model="email" class="form-control"
                       required />
                    </div>
                    <div class="mb-3">
                      <label for="phone" class="form-label" ><strong>Phone Number:</strong></label>
                      <input type="tel" id="phone" v-model="phone" class="form-control"
                       required />
                    </div>
  
                    <div class="row mb-3">
                      <!-- Date  -->
                      <div class="col-md-6">
                        <label for="date" class="form-label" ><strong>Date:</strong></label>
                        <input type="date" id="date" v-model="selectedDate" class="form-control"
                         required />
                      </div>
                      <!-- Time  -->
                      <div class="col-md-6">
                        <label for="time" class="form-label" ><strong>Time:</strong></label>
                        <input type="time" id="time" v-model="selectedTime" class="form-control"
                         required />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-6">
                        <label for="total" class="form-label" ><strong>Total Price:</strong></label>
                        <input type="text" id="total" v-model.number="totalPrice" class="form-control"
                         required />
                      </div>
                      <!-- QR Code  -->
                      <div class="col-md-6">
                        <v-container>
                          <v-row>
                            <v-col v-for="(image, index) in images" :key="index" cols="12" sm="4" class="text-center">
                              <v-img :width="170" aspect-ratio="1/1" cover :src="image.thumbnail"
                                @click="openModal(image)" class="img-thumbnail" />
                              <v-tex class="text-center" >{{ image.bank }}</v-tex>
                            </v-col>
                          </v-row>
                          <v-dialog v-model="dialog" max-width="800px">
                            <v-card :style="{ backgroundColor: modalBackgroundColor }">
                              <v-card-title>
                                <v-btn icon @click="dialog = false">
                                  <v-icon>mdi-close</v-icon>
                                </v-btn>
                                <v-spacer></v-spacer>
                                <span class="headline">QR Code</span>
                              </v-card-title>
                              <v-card-text class="text-center">
                                <v-img :src="selectedImage" aspect-ratio="1.77" contain></v-img>
                              </v-card-text>
                              <v-card-actions>
                                <v-btn @click="downloadImage" class="mr-4 d-flex align-center justify-center">
                                  <span class="d-flex align-center">
                                    Download
                                    <v-divider vertical inset class="mx-2" :thickness="2"
                                      style="height: 24px; background-color: white; opacity: 1;"></v-divider>
                                    <v-icon>mdi-arrow-down-bold</v-icon>
                                  </span>
                                </v-btn>
                              </v-card-actions>
                            </v-card>
                          </v-dialog>
                        </v-container>
                      </div>
  
                    </div>
                  </form>
                </div>
              </div>
            </div>
  
          </div>
        </div>
      </v-container>
    </v-app>
  </template>
  
  <script>
  
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
        creditCardNumber: '',
        images: [
          {
            bank: "ABA",
            thumbnail: "https://asset.brandfetch.io/iduTsrn35q/idZnP-pDVO.jpeg",
            full: "https://cdn.britannica.com/17/155017-050-9AC96FC8/Example-QR-code.jpg",
          },
          {
            bank: "Amret",
            thumbnail: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcROYTk5csp8xr0BmalclqQ1bfNrKWEktgnDcQ&s",
            full: "https://cdn.britannica.com/17/155017-050-9AC96FC8/Example-QR-code.jpg",
          },
          {
            bank: "Canadia",
            thumbnail: "https://is5-ssl.mzstatic.com/image/thumb/Purple125/v4/07/6c/2f/076c2fd9-e0c9-80a1-6371-13109625cfad/source/512x512bb.jpg",
            full: "https://cdn.britannica.com/17/155017-050-9AC96FC8/Example-QR-code.jpg",
          },
        ],
        dialog: false,
        selectedImage: null,
        modalBackgroundColor: '#ffffff', // Default color
      }
    },
    computed: {
      getCart() {
        const store = useCartStore()
        return store.cart
      }
    },
    methods: {
      openModal(image) {
        this.selectedImage = image.full;
        this.dialog = true;
        // Set the modal background color based on the bank
        if (image.bank === "ABA") {
          this.modalBackgroundColor = "#005D85";
        } else if (image.bank === "Amret") {
          this.modalBackgroundColor = "#008247";
        } else if (image.bank === "Canadia") {
          this.modalBackgroundColor = "#D61229";
        }
      },
      downloadImage() {
        fetch(this.selectedImage)
          .then(response => response.blob())
          .then(blob => {
            const filename = this.selectedImage.split('/').pop(); // Extract filename from URL
            saveAs(blob, filename);
          })
          .catch(error => {
            console.error('Error downloading image:', error);
            // Handle errors gracefully, e.g., display an error message to the user
          });
      },
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
  .img-thumbnail {
    cursor: pointer;
    width: 100%;
    height: auto;
  }
  </style>