<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  id: Number,
  nome: String,
  email: String,
  eta: Number
});


const userPP = ref({
  nome: props.nome,
  email: props.email,
  eta: props.eta
});


</script>

<template>
<v-expansion-panels>
  <v-expansion-panel>
    <v-expansion-panel-title>
      {{ props.id }} - {{ props.nome }} - {{ props.email }} - {{ props.eta }}
    </v-expansion-panel-title>

    <v-expansion-panel-text>
      <v-text-field v-model="user.nome" label="Nome" dense hide-details />
      <v-text-field v-model="user.email" label="Email" dense hide-details />
      <v-text-field v-model="user.eta" label="Età" dense hide-details />
      <v-btn @click="salvaModifiche">Salva</v-btn>
    </v-expansion-panel-text>
  </v-expansion-panel>
</v-expansion-panels>
</template>

<script>

function salvaModifiche() {
  console.log("Dati salvati:", userP.value);
}
</script>
