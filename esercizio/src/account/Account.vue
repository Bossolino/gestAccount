<script setup>
import { ref } from 'vue';
import main from '@/main'
const btnIcon = ref("mdi-eye-off")
const passField = ref("password")
const pass = ref("")
const utente = ref({
    id: main.id,
    admin: "No",
    nome: main.nome,
    eta: main.eta,
    email: main.eta,
});

console.log(main)

const scritte = {
    id: "ID: ",
    admin: "Admin: ",
    nome: "Nome: ",
    eta: "Età: ",
    email: "Email: ",
};

window.addEventListener("load", () => {utente.value.id = main.id;
    utente.value.admin = main.admin === true? "Si" : "No";
})

</script>

<template>
  <Nav-bar />
  <v-divider></v-divider>
  <v-container class="text-center">
    <v-col>
        <v-row v-for="(label, key) in scritte" :key="key">
            <v-divider></v-divider>
            <!-- <p style="padding: 5vw;">{{ label }}{{ utente[key] }}</p> -->
             <v-text-field style="padding: 5vw;" disabled :v-model="utente[key]" :label="label"></v-text-field>
        </v-row>
    </v-col>
  </v-container>
</template>
