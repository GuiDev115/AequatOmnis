<script setup>
import http from '@/services/http.js'
import { ref } from 'vue';
import router from '../router';


const usuario = ref({
    email: "",
    password: ""
})

const login = async () => {
    try {
        console.log(usuario.value)
        const { data } = await http.post('/login', usuario.value)
            
        if(data.user && data.user.administrador) {
            console.log("Login como admin realizado com sucesso")
            // Armazenar token no localStorage
            localStorage.setItem('auth_token', data.token)
            localStorage.setItem('user', JSON.stringify(data.user))
            router.push('/admin')
        } else if(data.user) {
            console.log("Login como usuário comum realizado com sucesso")
            localStorage.setItem('auth_token', data.token)
            localStorage.setItem('user', JSON.stringify(data.user))
            router.push('/')
        }
        console.log(data)
    } catch (error) {
        console.log("Erro no login:", error?.response?.data)
        alert("Erro no login: " + (error?.response?.data?.error || "Credenciais inválidas"))
    }
}
</script>


<template>
    <v-main class="d-flex flex-row justify-center ">
        <v-card class="bg-grey-darken-4" width="700">
            <v-row align="center">
                <v-col class="d-flex justify-center py-10">
                    <h3>Entrar</h3>
                </v-col>
            </v-row>


            <v-form @submit.prevent="login" class="d-flex justify-center">
                <v-col cols="12">
                    <v-container class="my-4 py-5 bg-grey-darken-4 rounded">
                        <v-row class=" d-flex justify-center">
                            <v-col cols="12" md="7">
                                <v-text-field v-model="usuario.email" label="Email" required></v-text-field>
                            </v-col>


                        </v-row>

                        <v-row class="d-flex justify-center">

                            <v-col cols="12" md="7">
                                <v-text-field v-model="usuario.password" type="password" label="Senha"
                                    required></v-text-field>
                            </v-col>

                        </v-row>

                        <v-row class="justify-center">
                            <v-btn type="submit" color="green-darken-1">Confirmar</v-btn>
                        </v-row>
                    </v-container>
                </v-col>
            </v-form>
        </v-card>
    </v-main>
</template>