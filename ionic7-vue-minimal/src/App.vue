<template>
  <ion-app>
    <Header/>
      <ion-router-outlet />
      <Tab-bar/>
  </ion-app>
</template>

<script>
import { IonApp, IonRouterOutlet } from '@ionic/vue';
import TabBar from "@/components/tab-bar.vue";
import Header from "@/components/Header.vue";

export default {
  components: {TabBar, IonApp, IonRouterOutlet, Header }
}
</script>
