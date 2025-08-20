<script setup>
    import axios from 'axios';
    import {ref} from 'vue';
    import EditButton from '../components/EditButton.vue';
    import main from "@/main"
    // main.checkUser();
    let carica = ref(true);
    let users = ref([]);
    let righe = `<tr class="rig">
                    <th>ID</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>EDIT</th>
                </tr>`;
    axios({
        method: "POST",
        url: "http://localhost:8888/View",
        headers: {'Content-Type': 'application/json'}
    }).then( async function (response){
        console.log(response)
        let userss = response.data;
        users.value = userss;
        carica.value = false;
        
    }).catch(function (response) {
        console.log(response);
        righe += `
                <tr>
                    <td colspan="3">ERRORE nel reperire gli utenti</td>
                <tr>
            `;
        righe+= "</table>"
        
        document.getElementById("tab").innerHTML = `${righe}`;
    })

</script>
<template>
    <Nav-bar />
    <v-progress-circular v-if="carica" style="display: flex;margin: 0 auto;"  indeterminate :size="80" />
    <div id="prov"></div>
    <table id="tab" class="table">
        <thead>
            <tr class="rig">
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <td>ETÀ</td>
                <th>EDIT</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" class="rig">
                <td>{{ user.ID }}</td>
                <td>{{ user.NOME }}</td>
                <td>{{ user.EMAIL }}</td>
                <td>{{ user.ETA }}</td>
                <td><EditButton :ID="user.ID" :NOME="user.NOME" :EMAIL="user.EMAIL" :ETA="user.ETA" /></td>
            </tr>
        </tbody>
    </table>
</template>
<style lang="css">
    #tab{
        margin: 0 2vw 0 2vw;
        width: 95%;
    }
    th {
        text-align: start;
        
    }

    td, th{
        width: 33%;
        border-collapse: collapse;
        border-bottom: 1px solid rgb(33, 150, 243);
    }
</style>