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

                    <input type="number" class="form-control" id="code" v-model="cour.code">

                </div>
                <div class="col-md-6">
                    <label for="descriptionSuccincte" class="form-label">descriptionSuccincte</label>

                    <input type="text" class="form-control" id="descriptionSuccincte" v-model="cour.descriptionSuccincte">

                </div>

            </div>
            <div class="row">
                <div class="col-md-6 ms-auto">

                    <label for="nombreHeure" class="form-label">nombreHeure</label>

                    <input type="text" class="form-control" id="nombreHeure" v-model="cour.nombreHeure">

                </div>
                <div class="col-md-6">
                    <label for="coefDiplôme" class="form-label">coefDiplôme</label>

                    <input type="number" class="form-control" id="coefDiplôme" v-model="cour.coefDiplôme">
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="coefExamen" class="form-label">coefExamen</label>

                    <input type="number" class="form-control" id="coefExamen" v-model="cour.coefExamen">

                </div>
                <div class="col-md-6 ms-auto">
                    <label for="coefTd" class="form-label">coefTd</label>

                    <input type="number" class="form-control" id="mail" v-model="cour.coefTd">

                </div>

                <div class="row"></div>
                <div class="form-group">
                    Enseignants
                    <select class="form-control" v-model="cour.enseignant_id">
                        <option v-for="enseignant in enseignants" :key="enseignant.id" :value="enseignant.id">
                            {{ enseignant.nom }} {{ enseignant.prénom }}
                        </option>
                    </select>
                </div>



            </div>

            <div class="col-md-6">


                <div>
                    <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>


            </div>




            <br />
            <button type="submit" className="btn btn-outline-primary" @click="addcour">
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
const enseignants = ref([])
const cour = ref({
    code: "",
    imagecour: "",
    descriptionSuccincte: "",
    nombreHeure: "",
    coefDiplôme: "",
    coefExamen: "",
    enseignant_id: "",
    coefTd: ""

})


const addcour = async () => {
    try {
        await api.post("/api/cours/", cour.value)
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
    cour.value = {
        code: "",
        imagecour: "",
        descriptionSuccincte: "",
        nombreHeure: "",
        coefDiplôme: "",
        enseignant_id: "",
        coefExamen: "",
        coefTd: ""
    };
};


onMounted(() => {
    getenseignant();
});

const getenseignant = async () => {
    try {
        const response = await api.get('/api/enseignants');
        enseignants.value = response.data;
        console.log(enseignants.value); // Check the data in the console
    } catch (error) {
        console.log(error);
    }
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
                    cour.value.imagecour = data.url;
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