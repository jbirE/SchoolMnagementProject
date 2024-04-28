<template>
    <button type="button" class="btn btn-warning rounded-circle " @click="visible= true">
        <span style="color: rgb(233, 240, 241)">
            <i class="fa-solid fa-pen-to-square"></i>
        </span>
    </button>
    <form>
        <div class="card flex justify-content-center">
            <Dialog v-model:visible="visible">
                <div class="row">
                    <div class="col-md-6">.
                        <label for="code" class="form-label"></label>

                        <input type="text" class="form-control" id="code" v-model="enseignant.code">

                    </div>
                    <div class="col-md-6 ms-auto">
                        <label for="nom" class="form-label">Nom</label>

                        <input type="texte" class="form-control" id="nom" v-model="enseignant.nom">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="prénom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="prénom" v-model="enseignant.prénom">
                    </div>
                    <div class="col-md-6 ms-auto">
                        <label for="mail" class="form-label">mail</label>

                        <input type="texte" class="form-control" id="mail" v-model="enseignant.mail">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="grade" class="form-label">grade</label>
                        <input type="text" class="form-control" id="grade" v-model="enseignant.grade">
                    </div>

              
                    <div class="col-md-6">.
                        <label for="numBureau" class="form-label">numBureau</label>
                        <input type="number" class="form-control" id="numBureau" v-model="enseignant.numBureau">
                    </div>
                    
                    
                    
                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="téléphone" class="form-label">téléphone</label>
                        <input type="number" class="form-control" id="téléphone" v-model="enseignant.téléphone">
                    </div>
                    <div class="col-md-6">.
                        <label for="login" class="form-label">login</label>
                        <input type="password" class="form-control" id="login" v-model="enseignant.login">
                    </div>
                    <div class="col-md-6">.
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" v-model="enseignant.password">
                    </div>
                </div>
                <div class="row">
                    <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>
                <br />
                <button type="submit" className="btn btn-outline-primary" @click="modifierenseignant">
                    <i class="fa-solid fa-floppy-disk"></i>Enregister
                </button>
                <button type="button" className="btn btn-outline-primary" @click="cancel">
                    <i class="fa-solid fa-floppy-disk"></i>cancel
                </button>

            </Dialog>
        </div>
    </form>
</template>
<script setup>
import api from '../config/api.js';
import { ref, onMounted } from "vue"
import vueFilePond from 'vue-filepond';
import 'filepond/dist/filepond.min.css';
import Dialog from 'primevue/dialog';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
// Create FilePond component



const FilePond = vueFilePond(FilePondPluginImagePreview);
const myFiles = ref([]);
import axios from 'axios';
const props = defineProps(['ens'])
const visible = ref(false);
const enseignant = ref({})





const handleFilePondInit = async () => {
    if (enseignant.value.imageens) {
        myFiles.value = [
            {
                source: enseignant.value.imageens,
                options: { type: 'local' }
            }
        ]
    }
}
const loadenseignant = () => {
    console.log(props.ens)
    enseignant.value = props.ens
}
onMounted(() => {

    loadenseignant()
}

);
const modifierenseignant = () => {
    api.put(`/api/enseignants/${enseignant.value.id}`, enseignant.value)
        .then(() => {
            visible.value = false
        })
        .catch(error => {
            console.error("There was an error!", error);
        })

}
const cancel = () => {

    

    visible.value = false
}
const serverOptions = () => {
    console.log('server pond');
    return {
        load: (source, load, error, progress, abort, headers) => {
            var myRequest = new Request(source);
            fetch(myRequest).then(function (response) {
                response.blob().then(function (myBlob) {
                    load(myBlob);
                });
            });
        },

        process: (fieldName, file, metadata, load, error, progress, abort) => {
            const data = new FormData();
            data.append('file', file);
            data.append('upload_preset', 'Ecommerce_cloudinary');
            data.append('cloud_name', 'dtjj1rxjq');
            data.append('public_id', file.name);
            axios.post('https://api.cloudinary.com/v1_1/dtjj1rxjq/upload', data)
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
<style scoped></style>