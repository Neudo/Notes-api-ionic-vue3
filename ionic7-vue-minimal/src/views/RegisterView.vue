<template>
  <ion-page>
    <ion-content class="ion-padding">
      <a href="/home">Retour</a>

      <form @submit.prevent="register" action="">
        <ion-title>Inscription</ion-title>
        <ion-item>
          <ion-label position="floating">Email</ion-label>
          <ion-input v-model="email" type="email" required></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="floating">Pseudo</ion-label>
          <ion-input v-model="name" type="text" required></ion-input>
        </ion-item>
        <ion-item>
          <ion-label position="floating">Mot de passe</ion-label>
          <ion-input v-model="password" type="password" required></ion-input>
        </ion-item>
        <ion-button type="submit" expand="block" class="ion-margin-top" color="primary">S'inscrire</ion-button>
      </form>
    </ion-content>
  </ion-page>
</template>


<script lang="js">
import { IonPage, IonContent, IonList, IonItem, IonLabel, IonRouterOutlet, IonCard, IonInput,IonButton, IonTitle } from '@ionic/vue';
import {RouterLink} from "vue-router";
import {mapActions} from "pinia";
import {useAuthStore} from "@/stores/auth.js";
export default {
  components: {
    IonPage,
    RouterLink,
    IonContent,
    IonList,IonItem,IonLabel,IonRouterOutlet,IonCard,IonInput,IonButton,IonTitle
  },
  data() {
    return {
      email: '',
      name: '',
      password:''
    };
  },
  methods: {
    ...mapActions(useAuthStore, { signUp: 'register'}),
    async register() {
      try {
        await this.signUp(this.name, this.email, this.password)
      } catch(error) {
        console.log(error)
      }
    }

  }

};
</script>

<style scoped>
ion-header {
  background-color: #3880ff;
}

ion-title {
  color: #fff;
  font-weight: 600;
  text-align: left;
  width: 90%;
  flex: 0;
}

form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  margin-top: 2rem;
  height: 100%;
}

ion-item {
  width: 80%;
  margin: .2vh auto 0;
}

ion-button {
  width: 80%;
  margin: 2vh auto;
}

ion-content {
  --padding-top: 75px;
}

a {
  margin: 2vh 0 0 0;
  color: #3880ff;
  font-weight: 600;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
}
</style>