<template>
  <v-app id="inspire" theme="dark">
    <NavBarAdmin />
    <v-main>
      <RouterView />

    </v-main>
  </v-app>
</template>

<script setup>

import NavBar from './components/NavBar.vue'
import NavBarAdmin from './components/NavBarAdmin.vue'

</script>