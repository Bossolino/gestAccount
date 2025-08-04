<script setup>
  import { ref } from 'vue'
  import main from '@/main'
  import axios from 'axios'

  // main.checkUser();

  let carica = ref(false)
  let emailIns = ref('')
  let passwordIns = ref('')
  const passField = ref("password")
  const btnIcon = ref("mdi-eye-off")
  const errText = ref("")
  function visPass(){
    if (passField.value === "password") {
      passField.value = "text"
      btnIcon.value = "mdi-eye"
    } else {
      passField.value = "password"
      btnIcon.value = "mdi-eye-off"
    }
  }
  
  function login() {
    axios({
      method: 'post',
      url: 'http://localhost:8888/Login',
      data: {
          EMAIL: emailIns.value,
          PASSWORD: passwordIns.value
      }
    }).then(response => {
        console.log(response.data);
        if (response.data.error) {
            errText.value = response.data.error;
            return;
        }
        main.ID = response.data.ID;
        main.nome = response.data.NOME;
        localStorage.setItem("accesso", response.data.token);
        main.login();
      }).catch(error => {
        console.error("Login failed:", error);
        errText.value = "*Si è verificato un errore: "+ error;
    });
    
  }

</script>
<template>
  <v-sheet class="mx-auto" width="300">
    <v-form @submit.prevent>
      <v-text-field v-model="emailIns" label="Email"></v-text-field>
      <div>
          <v-text-field
            v-model="passwordIns" label="Password" :type="passField"></v-text-field>
            <v-btn type="button" @click="visPass" :icon="btnIcon">
            </v-btn>
          <p style="color:red" v-if="errText.value != ''">{{ errText }}</p>
      </div>
      <v-btn class="mt-2" type="submit" @click="carica = true; login()" block>Submit</v-btn>
    </v-form>
  </v-sheet>
</template>