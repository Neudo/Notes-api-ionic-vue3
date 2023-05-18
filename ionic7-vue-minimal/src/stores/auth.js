import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: {},
        loggedIn: false,
    }),
    actions: {
        async register(name, email, password) {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/auth/register", {
                    email: email,
                    password: password,
                    name: name,
                    token_name: "Vuejs"
                });

                if (response.status === 200) {
                    const user = response.data;
                    this.loggedIn = true;
                    this.user = user;
                    localStorage.setItem("token", user.token);
                } else {
                    throw new Error('Failed to register user.');
                }
            } catch (error) {
                throw error;
            }
        },
        async login(email, password) {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/auth/login", {
                    email: email,
                    password: password,
                    token_name: "Vuejs"
                });

                const user = response.data;
                this.loggedIn = true;
                this.user = user;
                localStorage.setItem("token", user.token);
            } catch (error) {
                throw error;
            }
        },
        async logout() {
            if (!this.user.token) {
                throw new Error("Token does not exist");
            }
            try {
                await axios.post(
                    "http://127.0.0.1:8000/api/auth/logout",
                    {},
                    {
                        headers: {
                            Authorization: `Bearer ${this.user.token}`,
                        },
                    }
                );
                this.loggedIn = false;
                this.user = {};
                localStorage.removeItem("token");
            } catch (error) {
                throw new Error(error.message);
            }
        },
    },
});