<template>
  <v-container>
    <v-row>
      <v-col>
        <v-row>
          <Card titolo="+" />
          <Card titolo="PC Fisso" :obbiettivo="1000" />
        </v-row>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import {ref} from 'vue'
import Card from '../components/Card.vue'

const obbiettivo = ref(0)
const attuali = ref(0)

</script>

<style>
.card{
  max-width: 300px;
  max-height: 600px;
  text-align: center;
}

</style>