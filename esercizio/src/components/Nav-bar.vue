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
<template>
    <v-container>
        <v-row class="text-center">
            <v-col  v-for="action in azioni">
                <v-btn size="small" :prepend-icon="action.icon" append color="info" :to="action.to">
                    <p class="text">{{ action.nome }}</p>
                </v-btn>
            </v-col>
            <v-col>
                <v-btn size="small" prepend-icon="mdi-logout" stacked color="error" @click="main.logout()">
                    <p class="text">Logout</p>
                </v-btn>
            </v-col>
        </v-row>
        <v-divider id="divi" :thickness="5" class="border-opacity-50" color="info" />
    </v-container>
</template>
<style lang="css">
    #divi{
        margin-top: 3vh;
    }
</style>