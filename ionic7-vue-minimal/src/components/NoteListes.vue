<template>
  <h1>Vos notes</h1>
  <div v-for="note in notes" key="note.id">
    <ion-card color="tertiary">
      <ion-card-header>
        <ion-card-subtitle>Le {{note.created_at}}</ion-card-subtitle>
      </ion-card-header>

      <ion-card-content class="card-content" >
        {{note.content}}
      </ion-card-content>
      <ion-button @click="showEditArea(note)" class="btn-edit" color="primary">Editer</ion-button>
      <ion-item-group :class="{'ion-hide': !note.isEditModeVisible}">
        <ion-label position="floating">Modifiez votre note</ion-label>
        <ion-textarea class="new-content" v-model="newNote" ></ion-textarea>
        <ion-button @click.prevent="editNote(note.id)" expand="block" color="primary" >Enregistrer</ion-button>
      </ion-item-group>
      <ion-button @click.prevent="deleteNote(note.id)" color="danger">Supprimer</ion-button>
    </ion-card>
  </div>
</template>
<script lang="js">
import { IonItemGroup, IonPage, IonContent, IonAlert, IonButton,IonCardContent, IonCardHeader, IonCardTitle, IonCardSubtitle, IonCard, IonTextarea, IonLabel } from '@ionic/vue';
import {useAuthStore} from "@/stores/auth.js";
import { mapState } from 'pinia'
export default {
  name: 'Notelistes',
  computed: {
    ...mapState(useAuthStore, ['loggedIn', 'user'])
  },
  components: { IonItemGroup, IonPage, IonContent,IonButton,IonAlert, IonCardContent, IonCardHeader, IonCardTitle, IonCardSubtitle, IonCard, IonTextarea, IonLabel,},
  setup() {
    const alertButtons = ['OUI'];
    return { alertButtons };
  },
  data() {
    return {
      notes: [],
      newNote: '',
      isEditModeVisible: false
    };
  },
  mounted(){
    this.showNotes()
  },
  methods:{
    async showNotes(){
      console.log('show notes')
      const store = useAuthStore()
      const url = "http://127.0.0.1:8000/api/notes/";
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${store.user.token}`
        },
      });
      this.notes = []
      if (response.ok) {
        const data = await response.json()
        for (let i = 0; i < data.notes.length; i++) {
          this.notes.push(data.notes[i])
        }
      } else {
        console.error('Erreur lors de l\'affichage des  notes')
      }
    },
    async deleteNote(id) {
      const store = useAuthStore()
      const url = `http://127.0.0.1:8000/api/notes/${id}`
      try {
        const response = await fetch(url, {
          method: 'DELETE',
          headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${store.user.token}`
          },
        });
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        console.log('Deleted note:', data);

        const index = this.notes.findIndex(note => note.id === id);
        this.notes.splice(index, 1);
      } catch (error) {
        console.error('Error deleting note:', error);
      }
    },
    showEditArea(note){
      this.newNote = note.content;
      note.isEditModeVisible = !note.isEditModeVisible;
    },
    async editNote(id){

      const newContent = this.newNote
      console.log(newContent)

      const url = `http://127.0.0.1:8000/api/notes/${id}`
      const store = useAuthStore()
      const response = await fetch(url, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${store.user.token}`
        },
        body: JSON.stringify({ message: newContent })
      });
      if (response.ok) {
        const data = await response.json();
        console.log(data.message);
        await this.showNotes()
      } else {
        console.error('Erreur lors de l\'edition de la note');
      }
    },
  },
};
</script>
<style scoped>

.hidden {
  display: none;
}

.visible {
  display: initial;
}


ion-button{
  width: 110%;
  margin: 0 -5vw;
  border-radius: 0;
}

ion-card{
  overflow: hidden;
}

h1{
  margin-bottom: 10vh;
  position: fixed;
  top: 75px;
  left: 30px;
}
ion-content {
  --padding-top: 155px;
}
</style>