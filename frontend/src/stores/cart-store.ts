import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import * as yub from 'yup'

type productType = {
    id: number,
    name: string,
    price: number,
    discount: number,
    quantity: number
}

export const useCartStore = defineStore('cart', () => {
    let cart = ref<productType[]>([]);

    const incrementProduct = (product: productType) => {
      const existingProduct = cart.value.find((item) => item.id === product.id);
      if (existingProduct) {
        existingProduct.quantity += 1;
      } else {
        cart.value.push({ ...product, quantity: 1 });
      }
      return cart;
    };
  
    const decrementProduct = (product: productType) => {
      const existingProduct = cart.value.find((item) => item.id === product.id);
      if (existingProduct) {
        if (existingProduct.quantity > 1) {
          existingProduct.quantity -= 1;
        } else {
          cart.value = cart.value.filter((item) => item.id !== product.id);
        }
      }
      return cart;
    };
  
    return { cart, incrementProduct, decrementProduct };
})
