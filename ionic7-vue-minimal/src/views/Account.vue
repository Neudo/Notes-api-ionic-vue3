<template>
  <ion-page v-if="loggedIn">
    <ion-header>
      <ion-toolbar>
        <ion-title>Mon compte</ion-title>
      </ion-toolbar>
    </ion-header>

    <ion-content>
      <div class="account-info">
          <ion-item>
            <ion-label>Email</ion-label>
            <ion-text>{{ user.user.email }}</ion-text>
          </ion-item>
          <ion-item>
            <ion-label>Nom</ion-label>
            <ion-text>{{ user.user.name }}</ion-text>
          </ion-item>
          <ion-item>
            <ion-label>Date de création du compte</ion-label>
            <ion-text>{{user.user.created_at}}</ion-text>
          </ion-item>
          <ion-button @click.prevent="userLogout" expand="block" color="primary">Déconnexion</ion-button>
        </div>
    </ion-content>
  </ion-page>
  <ion-page v-else >
    <ion-content>
      <p>Veuillez vous connecter pour consulter cette page.</p>
    </ion-content>
  </ion-page>
</template>

<script lang="js">
import { IonPage, IonHeader, IonText, IonContent, IonList, IonItem, IonLabel, IonRouterOutlet, IonCard, IonInput,IonButton, IonTitle, IonToolbar } from '@ionic/vue';
import {RouterLink} from "vue-router";
import {mapActions, mapState} from "pinia";
import {useAuthStore} from "@/stores/auth.js";
export default {
  name: 'Account',
  components: {
    IonPage, RouterLink, IonContent, IonList,IonItem,IonLabel,IonRouterOutlet,IonCard,IonInput,IonButton,IonTitle, IonToolbar, IonText, IonHeader
  },
  data() {
    return {
    };
  },

  computed: {
    ...mapState(useAuthStore, ['loggedIn', 'user'])
  },
  methods: {
    ...mapActions(useAuthStore, { singOut: 'logout' }),
    async userLogout() {
      try {
        await this.singOut();
        // this.$emit('update:isLogged', false)
      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>

<style scoped>

</style>