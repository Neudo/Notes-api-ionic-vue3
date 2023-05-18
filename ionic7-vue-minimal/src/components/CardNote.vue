<template>
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
</template>