import { defineStore } from 'pinia';
export const useUserStore = defineStore('authenticated_user', {
    state: () => ({
        user: null,
    }),
    getters: {
        getUser() {
            return this.user;
        }
    },
    actions: {
        setUser(payload) {
            this.user = payload;
        },

    },
});
