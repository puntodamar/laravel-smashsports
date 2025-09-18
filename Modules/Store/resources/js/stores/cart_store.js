import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
    state: () => ({
        items: [],
    }),
    getters: {
        cartItems: (state) => state.items,
    },
    actions: {
        addToCart(item) {
            this.items.push(item);
        },
        clear() {
            this.items = [];
        },
    },
});
