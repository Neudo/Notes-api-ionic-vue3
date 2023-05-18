
<template>
  <ion-tabs>
    <ion-router-outlet></ion-router-outlet>
    <ion-tab-bar slot="bottom">
      <ion-tab-button tab="home" href="/home">
        <ion-icon :icon="homeOutline"></ion-icon>
        <ion-label>Home</ion-label>
      </ion-tab-button>

      <ion-tab-button tab="radio" href="/note">
        <ion-icon :icon="addCircleOutline"></ion-icon>
        <ion-label>Nouvelle note</ion-label>
      </ion-tab-button>

      <ion-tab-button tab="library" href="/account">
        <ion-icon :icon="personOutline"></ion-icon>
        <ion-label>Mon compte</ion-label>
      </ion-tab-button>

    </ion-tab-bar>
  </ion-tabs>

</template>

<script lang="js">
import { IonPage, IonTabs, IonRouterOutlet, IonTabBar, IonTabButton, IonLabel, IonIcon } from '@ionic/vue';

import { homeOutline, addCircleOutline, personOutline  } from 'ionicons/icons';

export default {
  components: { IonPage, IonTabs, IonRouterOutlet, IonTabBar, IonTabButton, IonLabel, IonIcon },
  data() {
    return {
      homeOutline,
      addCircleOutline,
      personOutline

    };
  },
};
</script>