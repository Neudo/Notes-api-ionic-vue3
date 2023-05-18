import { createRouter, createWebHistory } from "@ionic/vue-router";
import HomePage from "../views/HomePage.vue";

const routes = [
  {
    path: "/",
    redirect: "/home",
  },
  {
    path: "/home",
    name: "Home",
    component: HomePage,
  },
  // {
  //   path: "/notes",
  //   name: "Notes",
  //   component: () => import("../views/NotesListe.vue"),
  // },
  {
    path: "/note",
    name: "Note",
    component: () => import("../views/Note.vue"),
  },
  {
    path: "/account",
    name: "Compte",
    component: () => import("../views/Account.vue"),
  },
  {
    path: "/register",
    name: "Register",
    component: () => import("../views/RegisterView.vue"),
  },


];
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
