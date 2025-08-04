<template>
<v-container>
    <v-col style="text-align: end">
        <v-btn prepend-icon="mdi-logout" size="small" append color="error" @click="main.logout()">
            <p class="text">Logout</p>
        </v-btn>
    </v-col>
</v-container>
<v-container class="fill-height" max-width="900">
    <v-row>
        <v-col>
        <div>
            <h2>Benvenuto</h2>
            <p>Scegli un azione: </p>
        </div>
        </v-col>
        <v-col  v-for="action in azioni">
            <v-btn :prepend-icon="action.icon" stacked color="info" :to="action.to">
                <p class="text">{{ action.nome }}</p>
            </v-btn>
        </v-col>
        <v-col>
            <v-btn prepend-icon="mdi-account" stacked color="info" to="/Account">
                <p class="text">Account</p>
            </v-btn>
        </v-col>
        
    </v-row>
</v-container>
</template>
<script setup>
    import main from '@/main'
    let azioni = [];

    const azioniAdmin = [
        {nome: "Home", icon: "mdi-home", to: "/"},
        {nome: "Vedi Utenti", icon: "mdi-format-list-bulleted", to: "/View"},
        {nome: "Aggiorna Utente", icon: "mdi-account-edit", to: "/Update"},
        {nome: "Crea Utente", icon: "mdi-account-plus", to: "/Create"}
    ];

    const azioniUser = [
        {nome: "Home", icon: "mdi-home", to: "/"},
        {nome: "Vedi Utenti", icon: "mdi-format-list-bulleted", to: "/View"}
    ];

    if (main.admin.value) {
        azioni = azioniAdmin;
    } else {
        azioni = azioniUser;
    }
</script>
<style>
.text{
    text-wrap: nowrap;
}
</style>