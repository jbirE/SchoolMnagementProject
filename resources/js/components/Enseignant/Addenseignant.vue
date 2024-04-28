<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">


        <div class="container-fluid">

            <button type="button" class="btn btn-warning rounded-circle" @click="visible = true">

                <span style="color: rgb(43, 27, 27)">
                    <i class="fa-solid fa-square-plus"> </i>
                </span>
                New
            </button>
        </div>
    </nav>

    <form>
        <Dialog v-model:visible="visible" modal header="Header" :style="{ width: '50rem' }"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <div class="row">
                <div class="col-md-6">
                    <label for="code" class="form-label">Code</label>

                    <input type="text" class="form-control" id="code" v-model="enseignant.code">

                </div>
                <div class="col-md-6">
                    <label for="nom" class="form-label">Nom</label>

                    <input type="text" class="form-control" id="nom" v-model="enseignant.nom">

                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6 ms-auto">

                 <label for="prénom" class="form-label">Prenom</label>

                 <input type="text" class="form-control" id="prénom" v-model="enseignant.prénom">

                </div>
                <div class="col-md-6">
                    <label for="grade" class="form-label">grade</label>

                    <input type="text" class="form-control" id="grade" v-model="enseignant.grade">
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="téléphone" class="form-label">téléphone</label>

                    <input type="number" class="form-control" id="téléphone" v-model="enseignant.téléphone">

                </div>
                <div class="col-md-6 ms-auto"> 
                    <label for="mail" class="form-label">mail</label>

                    <input type="text" class="form-control" id="mail" v-model="enseignant.mail">

                </div>

                


            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="login" class="form-label">Login</label>

                    <input type="text" class="form-control" id="login" v-model="enseignant.login">

                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>

                    <input type="password" class="form-control" id="password" v-model="enseignant.password">

                </div>
            </div>
            
            <div class="col-md-6">
                    <label for="numBureau" class="form-label">numBureau</label>

                    <input type="number" class="form-control" id="numBureau" v-model="enseignant.numBureau">

                </div>
                <div class="form-group">
                <div>
                    <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>
            

            </div>
           
            


            <br />
            <button type="submit" className="btn btn-outline-primary" @click="addenseignant">
                <i class="fa-solid fa-floppy-disk"></i>Enregister
            </button>
            <button type="button" className="btn btn-outline-primary" @click="cancel">
                <i class="fa-solid fa-floppy-disk"></i>cancel
            </button>
        </Dialog>
    </form>
</template>


<script setup>
import { ref, onMounted } from "vue"
import { useRouter } from 'vue-router';
import axios, { isCancel } from 'axios';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import api from '../config/api.js';
import Dialog from 'primevue/dialog';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);
const visible = ref(false);
const router = useRouter()

const enseignant = ref({
    code:"",
    nom: "",
    prénom: "",
    grade: "",
    mail: "",
    téléphone: "",
    Login: "",
    imageens:"",
    numBureau: "",
    password: ""
})


const addenseignant = async () => {
    try {
        await api.post("/api/enseignants/", enseignant.value)
        {
            visible.value = false
            window.location.reload()
        }
    } catch (error) {

    }
}
const cancel = async () => {
    visible.value = false;
    // Vous pouvez également réinitialiser les valeurs du formulaire ici si nécessaire
    enseignant.value = {
        code:"",
        nom: "",
        prénom: "",
        grade: "",
        mail: "",
        téléphone: "",
        Login: "",
        imageens: "",
        numBureau:"",
        password: ""
    };
};





const serverOptions = () => {
    console.log('server pond');
    return {
        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append('file', file);
            data.append('upload_preset', 'Ecommerce_cloudinary');
            data.append('cloud_name', 'dtjj1rxjq');
            data.append('public_id', file.name);
            axios.post('https://api.cloudinary.com/v1_1/dtjj1rxjq/upload',
                data)
                .then((response) => response.data)
                .then((data) => {
               
                    console.log(data);
                    enseignant.value.imageens = data.url;
                    load(data);
                })
                .catch((error) => {
                    console.error('Error uploading file:', error);
                    error('Upload failed');
                    abort();
                });
        },
    };
};



</script>

<style lang="css" scoped></style>