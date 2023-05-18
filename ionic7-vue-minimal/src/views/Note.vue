<template>
  <ion-page  v-if="loggedIn" >
    <ion-header>
      <ion-toolbar>
        <ion-title>Nouvelle note</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content>
      <ion-list>
        <ion-item>
          <ion-label position="floating">Écrivez ici ..</ion-label>
          <ion-textarea v-model="content"></ion-textarea>
        </ion-item>
      </ion-list>

      <ion-button @click.prevent="addNote" expand="block" color="primary" >Enregistrer</ion-button>
    </ion-content>
  </ion-page>
  <ion-page v-else >
    <ion-content>
      <p>Veuillez vous connecter pour consulter cette page.</p>
    </ion-content>
  </ion-page>

</template>
<script lang="js">
import { IonPage, IonContent, IonTextarea, IonHeader, IonList, IonLabel, IonButton, IonTitle, IonToolbar, IonItem} from '@ionic/vue';
import { useAuthStore } from '../stores/auth'
import { mapState } from 'pinia'
import router from "@/router/index.js";

export default {
  name: 'Note',
  computed: {
    ...mapState(useAuthStore, ['loggedIn', 'user'])
  },
  data(){
    return{
      content: '',
    }
  },
  components: { IonPage,IonContent, IonTextarea, IonHeader, IonList, IonLabel, IonButton, IonTitle, IonToolbar, IonItem},
  methods:{
    async addNote() {
      const url = "http://127.0.0.1:8000/api/notes/";
      const store = useAuthStore()
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${store.user.token}`
        },
        body: JSON.stringify({ message: this.content })
      });

      if (response.ok) {
        const data = await response.json();
        await router.push('/home')
      } else {
        console.error('Erreur lors de l\'enregistrement de la note');
      }
    },
  }
};
</script>

<style scoped>
ion-content {
  --padding-top: 75px;
}

</style>