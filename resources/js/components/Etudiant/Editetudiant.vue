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
                        <label for="id_etudiant" class="form-label">id_etudiant</label>

                        <input type="text" class="form-control" id="id_etudiant" v-model="etudiant.id_etudiant">

                    </div>
                    <div class="col-md-6 ms-auto">
    <label for="Nom" class="form-label">Nom</label>
    <input type="text" class="form-control" id="Nom" v-model="etudiant.Nom">
</div>

                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="Prenom" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="Prenom" v-model="etudiant.Prenom">
                    </div>
                    <div class="col-md-6 ms-auto">
                        <label for="mail" class="form-label">mail</label>

                        <input type="texte" class="form-control" id="mail" v-model="etudiant.mail">

                    </div>
                    <div class="col-md-6 ms-auto">
                        <label for="DateNaissance" class="form-label">DateNaissance</label>

                        <input type="date" class="form-control" id="DateNaissance" v-model="etudiant.DateNaissance">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="adressePersonnelle" class="form-label">adressePersonnelle</label>
                        <input type="text" class="form-control" id="adressePersonnelle" v-model="etudiant.adressePersonnelle">
                    </div>
                    <div class="col-md-6 ms-auto">
    <label for="groupe" class="form-label">Groupes</label>
    <select class="form-control" v-model="etudiant.groupe_id">
        <option v-for="sc in groupe" :key="sc.id" :value="sc.id">{{ sc.groupe_id }}</option>
    </select>
</div>

                    <div class="col-md-6 ms-auto">
                        <label for="diplome" class="form-label">Diplomes</label>
                        <select class="form-control" v-model="etudiant.diplome_id">
                            <option v-for="sc in diplome" :key="sc.id" :value=sc.id>{{ sc.diplome_id }}</option>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="téléphone" class="form-label">téléphone</label>
                        <input type="number" class="form-control" id="téléphone" v-model="etudiant.téléphone">
                    </div>
                    <div class="col-md-6">.
                        <label for="login" class="form-label">login</label>
                        <input type="password" class="form-control" id="login" v-model="etudiant.login">
                    </div>
                </div>
                <div class="row">
                    <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>
                <br />
                <button type="submit" className="btn btn-outline-primary" @click="modifierproduit">
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
const props = defineProps(['art'])
const visible = ref(false);
const etudiant = ref({})
const diplome = ref({})
const groupe= ref({})
const getdiplomes = async () => {

    await api.get('/api/diplomes').then(res => {
        diplome.value = res.data;
    }).catch(error => {
        console.log(error)
    });
}

const getgroupes = async () => {
    await api.get('/api/groupes').then(res => {
        groupe.value = res.data; // Change 'diplome' to 'groupe'
    }).catch(error => {
        console.log(error)
    });
}

const handleFilePondInit = async () => {
    if (etudiant.value.imageetud) {
        myFiles.value = [
            {
                source: etudiant.value.imageetud,
                options: { type: 'local' }
            }
        ]
    }
}
const loadetudiant = () => {
    console.log(props.art)
    etudiant.value = props.art
}

onMounted(() => {
    getdiplomes();
    getgroupes();
    loadetudiant()
}

);
const modifierproduit = () => {
    api.put(`/api/etudiants/${etudiant.value.id}`, etudiant.value)
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
                    etudiant.value.imageart = data.url;
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