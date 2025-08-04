<script setup>
    import main from '@/main';
    import axios from 'axios';
    import {ref} from 'vue';

    const loading = ref(false);
    let campi = ref({
        nome: '',
        email: '',
        eta: 0,
        errore: false
    });

    let esito = ref(false);
    let esitoText = ref('');
    let esitoType = ref('');

    function crea(){
        console.log("crea utente");
        console.log(campi.value);
        if (campi.value.nome == '' || campi.value.email == '' || campi.value.eta == 0 || campi.value.eta == '' ) {
            loading.value = false;
            campi.value.errore = true;
            console.log("Compila tutti i campi")
            return;
        }
        campi.value.errore = false;
        console.log("mando dati");
        console.log(campi.value);
        loading.value= true;
        axios({
            method: "POST",
            url: "http://localhost:8888/Create",
            headers: {'Content-Type': 'application/json'},
            data: {
                NOME: campi.value.nome,
                EMAIL: campi.value.email,
                ETA: campi.value.eta
            }
        }).then(function (response) {
            console.log(response);
            loading.value = false;
            console.log(response);
            esitoType.value = 'success';
            esito.value = true;
            esitoText.value = response.data;
            campi.nome = '';
            campi.email= '';
            campi.eta= 0
        }).catch(function (error) {
            console.log(error.code);
            loading.value = false;
            esito.value = true;
            esitoType.value = 'error';
            esitoText.value = "ERRORE: " + error.code + " - " + error.message;
        });

 
 
}
</script>
<template>
    <Nav-bar />
    <div class="margin-0-auto text-align-center">
         <form @submit.prevent="crea">
            <v-responsive class="mx-auto" max-width="344">
                <v-row>
                    <v-alert v-if="esito" closable title="Create new user" :text="esitoText" :type="esitoType"></v-alert>
                </v-row>
                <v-row>
                    <v-col><h3 class="text-align-start"><v-icon icon="mdi-account-plus" />Nuovo utente</h3></v-col>
                </v-row>
                <v-text-field hide-details="auto" placeholder="Inserisci il Nome" label="Nome" :model-value="campi.nome" v-model="campi.nome" />
                <v-text-field hide-details="auto" placeholder="Inserisci l'Email" label="Email" :model-value="campi.email" v-model="campi.email" />
                <v-number-input :reverse="false" control-variant="default" label="Inserisci l'Età" :hide-input="false" :inset="false" :min="0" :max="70"  v-model="campi.eta" :precision="0" required />
                <p style="color: red;" v-if="campi.errore">*Compila tutti i campi</p>
                <v-btn :disabled="loading" :loading="loading" class="text-none mb-4" color="info" size="x-large" variant="flat" block @click="crea()">Crea Utente</v-btn>
            </v-responsive>
         </form>
    </div>
</template>