<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">


        <div class="container-fluid">

            <button type="button" class="btn btn-warning rounded-
    circle" @click="visible = true">

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
                    <label for="id_etudiant" class="form-label">id_etudiant</label>

                    <input type="text" class="form-control" id="id_etudiant" v-model="etudiant.id_etudiant">

                </div>
                <div class="col-md-6">
                    <label for="Nom" class="form-label">Nom</label>

                    <input type="text" class="form-control" id="Nom" v-model="etudiant.Nom">

                </div>
                
            </div>
            <div class="row">
                <div class="col-md-6 ms-auto">

                 <label for="Prenom" class="form-label">Prenom</label>

                 <input type="texte" class="form-control" id="Prenom" v-model="etudiant.Prenom">

                </div>
                <div class="col-md-6 ms-auto">

                  <label for="DateNaissance" class="form-label">DateNaissance</label>

                  <input type="date" class="form-control" id="DateNaissance" v-model="etudiant.DateNaissance">

                    </div>
                <div class="col-md-6">
                    <label for="adressePersonnelle" class="form-label">adressePersonnelle</label>

                    <input type="text" class="form-control" id="adressePersonnelle" v-model="etudiant.adressePersonnelle">
                </div>
               
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="téléphone" class="form-label">téléphone</label>

                    <input type="number" class="form-control" id="téléphone" v-model="etudiant.téléphone">

                </div>
                <div class="col-md-6 ms-auto"> <!-- n9asmo 12 colonne ala 6 w 6  -->
                    <label for="mail" class="form-label">mail</label>

                    <input type="texte" class="form-control" id="mail" v-model="etudiant.mail">

                </div>

                


            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="login" class="form-label">Login</label>

                    <input type="text" class="form-control" id="login" v-model="etudiant.login">

                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>

                    <input type="password" class="form-control" id="password" v-model="etudiant.password">

                </div>
            </div>
            <div class="row"></div>
                <div class="form-group">Diplomes<select class="form-control" v-model="etudiant.diplome_id">

                 <option v-for="dp in diplomes" :key="dp.id" :value=dp.id>{{ dp.nom_diplome}}</option>
               </select>
               </div> 

                <div class="form-group">Groupes<select class="form-control" v-model="etudiant.groupe_id">

                        <option v-for="gr in groupes" :key="gr.id" :value=gr.id>{{ gr.nom_groupe }}</option>
                    </select>
                </div>
                <div class="form-group">
                <div>
                    <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>
            

            </div>
           
            


            <br />
            <button type="submit" className="btn btn-outline-primary" @click="addetudiant">
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

import api from '../config/api.js';
import Dialog from 'primevue/dialog';
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';

// Create FilePond component
const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);
const visible = ref(false);
const router = useRouter()

const etudiant = ref({
    id_etudiant:"",
    Nom: "",
    Prenom: "",
    adressePersonnelle: "",
    mail: "",
    téléphone: "",
    Login: "",
    diplome_id: "",
    groupe_id: "",
    imageetud:",",
    password: ""
})
const groupes = ref([]);
const diplomes = ref([])
const getgroupes = async () => {
    await
        api.get('/api/groupes').then(res => {
            groupes.value = res.data;
        }).catch(error => {
            console.log(error)
        });
}

const getdiplomes= async () => {
    await
        api.get('/api/diplomes').then(res => {
            diplomes.value = res.data;
        }).catch(error => {
            console.log(error)
        });
}
const addetudiant = async () => {
    try {
        await api.post("/api/etudiants/", etudiant.value)
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
    etudiant.value = {
        Nom: "",
        Prenom: "",
        adressePersonnelle: "",
        mail: "",
        téléphone: "",
        Login: "",
        diplome_id: "",
        groupe_id: "",
        imageetud: "",
        password: ""
    };
};
onMounted(() => {
    getgroupes();
    getdiplomes();
}

);



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
                    etudiant.value.imageetud = data.url;
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