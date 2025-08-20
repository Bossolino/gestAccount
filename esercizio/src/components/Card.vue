<script setup>
    const props = defineProps({
        titolo: String,
        obbiettivo: Number
    })
</script>
<style>
#car:hover{
    border: 1px solid blue;
}
</style>
<template>
    <v-col>
        <v-card id="car">
            <v-card-text>
                <h3>{{ props.titolo }}</h3>
            </v-card-text>
            <v-card-text v-if="props.obbiettivo">
                {{ props.obbiet }}€
            </v-card-text>
        </v-card>
    </v-col>
</template>