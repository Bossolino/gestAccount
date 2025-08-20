<script setup>
import { shallowRef, ref } from 'vue'
import axios from 'axios'
  const dialog = shallowRef(false)
  const dialogDelete = shallowRef(false)
  const props = defineProps({
    ID: Number,
    NOME: String,
    EMAIL: String,
    ETA: Number
  })
  
  let proprieties = ref({
    ID: props.ID,
    NOME: props.NOME,
    EMAIL: props.EMAIL,
    ETA: props.ETA
  });
  
  function aggiornaUtente(id, nome, email, eta) {
    axios({
      method: 'POST',
      url: 'http://localhost:8888/Update',
      headers: { 'Content-Type': 'application/json' },
      data: {
        ID: id,
        NOME: nome,
        EMAIL: email,
        ETA: eta
      }
    }).then(response => {
      console.log('User updated successfully:', response.data)
      alert(response.data);
      location.reload();
    }).catch(error => {
      console.error("ERRORE Informazioni non aggiornate dell'utente:", error)
      alert("ERRORE Informazioni non aggiornate dell'utente:", error);
    })
  }

  function cancellaUtente(ID){
    axios({
      method: 'POST',
      url: 'http://localhost:8888/Delete',
      headers: { 'Content-Type': 'application/json' },
      data: {
        ID: ID,
      }
    }).then(response => {
      console.info('Utente eliminato con successo:', response.data)
      alert(response.data);
      location.reload();
    }).catch(error => {
      console.error("ERRORE utente non cancellato (js) :", error)
      alert("ERRORE utente non cancellato:", error);
    })
  }

</script>
<template>
  <div class="text-center">
    <v-dialog
      v-model="dialog"
      max-width="600"
    >
      <template v-slot:activator="{ props: activatorProps }">
        <v-btn
          class="text-none font-weight-regular"
          prepend-icon="mdi-account"
          text="Edit Profile"
          variant="tonal"
          v-bind="activatorProps"
        ></v-btn>
      </template>

      <v-card
        prepend-icon="mdi-account"
        :title="`User Profile id : ${proprieties.ID}`"
      >
        <v-card-text class="text-align-center">
          <v-row dense>
            <v-col  cols="5"
              md="1"
              sm="6">
              <p></p>
            </v-col>
            <v-col
              cols="12"
              md="4"
              sm="6"
            >
              <v-text-field
                label="Nome*"
                required
                :model-value="proprieties.NOME"
                v-model="proprieties.NOME"
              ></v-text-field>
            </v-col>
            <v-col
              cols="25"
              md="4"
              sm="8"
            >
              <v-text-field
                label="Email*"
                required
                type="email"
                :model-value="proprieties.EMAIL"
                v-model="proprieties.EMAIL"
              ></v-text-field>
            </v-col>

            <v-col
              cols="20"
              md="3"
              sm="6"
            >
            <v-number-input :reverse="false" control-variant="default" label="Età" :model-value="proprieties.ETA" :hide-input="false" :inset="false" :min="0" :max="70"  v-model="proprieties.ETA" :precision="0" required />
          </v-col>

          </v-row>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-btn color="error" variant="outlined" text="Delete account" append-icon="mdi-account-remove" @click="dialogDelete = true;"></v-btn>
          <v-spacer></v-spacer>
          <v-btn
            text="Close"
            variant="plain"
            color="error"
            append-icon="mdi-close"
            @click="dialog = false;"
          ></v-btn>

          <v-btn
            color="success"
            text="Save"
            append-icon="mdi-check"
            variant="tonal"
            @click="dialog = false; aggiornaUtente(proprieties.ID, proprieties.NOME, proprieties.EMAIL, proprieties.ETA);"
          ></v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>

  <template>
    <div class="text-center pa-4">
      <v-dialog
        v-model="dialogDelete"
        max-width="400"
        persistent
      >
        <template v-slot:activator="{ props: activatorProps }">
          <v-btn v-bind="activatorProps">
            Open Dialog
          </v-btn>
        </template>

        <v-card
          prepend-icon="mdi-account-remove"
          :text="`sei sicuro di voler Eliminare l'utente: ${proprieties.ID} ${proprieties.NOME} ${proprieties.EMAIL} ${proprieties.ETA}?`" title="Cancella utente" :prepend-icon="mdi-account-remove">
          <template v-slot:actions>
            <v-spacer></v-spacer>

            <v-btn @click="dialogDelete = false" color="success">
              Annulla
            </v-btn>

            <v-btn @click="dialogDelete = false; cancellaUtente(proprieties.ID)" color="error">
              Cancella
            </v-btn>
          </template>
        </v-card>
      </v-dialog>
    </div>
  </template>
</template>