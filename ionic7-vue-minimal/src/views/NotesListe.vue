<template>
  <ion-page>
    <ion-content class="ion-padding">
      <h1>Vos notes</h1>

      <ion-card color="tertiary">
        <ion-card-header>
          <ion-card-title>Card Title</ion-card-title>
          <ion-card-subtitle>Le 04/04/2023</ion-card-subtitle>
        </ion-card-header>

        <ion-card-content>
          Card Content Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, dolor dolores id odio quod rem sed sunt velit voluptates? Beatae dolorum et officia voluptatibus! Accusamus adipisci dolorem ex explicabo minus mollitia nemo nobis non, possimus, rem sunt suscipit tempora temporibus vel veritatis. Consequuntur culpa cumque debitis deserunt doloribus illo incidunt iste non officia voluptates? Ab alias aliquid, atque beatae consectetur eius eligendi explicabo facere hic impedit ipsam molestias nemo neque, nesciunt, nobis perferendis perspiciatis porro quam quibusdam repudiandae sed sit soluta totam ut veritatis. Aliquam animi assumenda beatae debitis distinctio dolorum esse eveniet expedita impedit, iste iusto magnam officiis, optio quas quia quos sapiente sed, tenetur. Dicta omnis quasi sed sunt!
        </ion-card-content>
        <ion-button color="primary">Editer</ion-button>
        <ion-button color="danger" id="present-alert">Supprimer</ion-button>
        <ion-alert
            trigger="present-alert"
            header="Alert"
            sub-header="Important message"
            message="This is an alert!"
            :buttons="alertButtons"
        ></ion-alert>
      </ion-card>

      <ion-card color="success">
        <ion-card-header>
          <ion-card-title>Card Title</ion-card-title>
          <ion-card-subtitle>Card Subtitle</ion-card-subtitle>
        </ion-card-header>

        <ion-card-content>
          Card Content Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto et fugit, harum hic provident! Delectus distinctio id ullam! Beatae blanditiis eum ex incidunt laborum modi, molestias optio temporibus voluptate voluptatum. Autem, eveniet.
        </ion-card-content>
      </ion-card>

      <ion-card color="light">
        <ion-card-header>
          <ion-card-title>Card Title</ion-card-title>
          <ion-card-subtitle>Card Subtitle</ion-card-subtitle>
        </ion-card-header>

        <ion-card-content>
          Card Content Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium atque consequatur iste magni officiis soluta voluptas! Atque consectetur consequuntur culpa cumque doloribus, ducimus expedita illo in inventore iste itaque nesciunt sit voluptate. A aliquid atque facilis libero officiis porro soluta temporibus unde veritatis voluptate. Doloremque impedit laudantium maiores veniam vero!
        </ion-card-content>
      </ion-card>

      <ion-card color="tertiary">
        <ion-card-header>
          <ion-card-title>Card Title</ion-card-title>
          <ion-card-subtitle>Card Subtitle</ion-card-subtitle>
        </ion-card-header>

        <ion-card-content>
          Card Content
        </ion-card-content>
      </ion-card>

    </ion-content>
  </ion-page>
</template>
<script lang="js">
import { IonPage, IonContent, IonAlert, IonButton } from '@ionic/vue';
import {useAuthStore} from "@/stores/auth.js";


export default {
  components: { IonPage, IonContent,IonButton,IonAlert},
  setup() {
    const alertButtons = ['OK'];

    return { alertButtons };
  },
  data() {
    return {
    };
  },
  mounted() {
    this.showNotes()
  },
  methods:{
    async showNotes() {
      const url = "http://127.0.0.1:8000/api/notes/";
      const store = useAuthStore()
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${store.user.token}`
        },
      })
      if (response.ok) {
        const data = await response.json();
        console.log(data);
      } else {
        console.error('Erreur lors de l\'enregistrement de la note');
      }
    }
  }
};
</script>
<style scoped>

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