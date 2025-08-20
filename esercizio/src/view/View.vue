<script setup>
    import main from '@/main';
    import axios from 'axios';
    import { createElementVNode, ref, useTransitionState } from 'vue';
    
    let carica = ref(true)
    let righe = `<tr class="rig">
                <th>ID</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>ETÀ</th>
            </tr>`;
axios({
    method: "POST",
    url: "http://localhost:8888/View",
    headers: {'Content-Type': 'application/json'}
}).then( async function (response){
    let users = response.data;
    users.forEach(user => {
        righe += `
            <tr class="rig">
                <td>${user.ID}</td>
                <td>${user.NOME}</td>
                <td>${user.EMAIL}</td>
                <td>${user.ETA}</td>
            <tr>
        `;
    });
    righe+= "</table>"
    document.getElementById("tab").innerHTML = `${righe}`;
    carica.value = false;
    
}).catch(function (response) {
    righe += `
            <tr>
                <td colspan="3">ERRORE nel reperire gli utenti</td>
            <tr>
        `;
    righe+= "</table>"
    
    document.getElementById("tab").innerHTML = ``+righe;
})
    
</script>
<style lang="css">
    #tab{
        margin: 0 auto;
        width: 100%;
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
<template>
    <Nav-bar />
    <v-progress-circular v-if="carica" style="display: flex;margin: 0 auto;"  indeterminate :size="80" />
    <div>
        <v-container>
            <table id="tab">
            </table>
        </v-container>
    </div>
</template>