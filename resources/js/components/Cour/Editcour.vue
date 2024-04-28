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

                        <input type="text" class="form-control" id="code" v-model="cour.code">

                    </div>
                    <div class="col-md-6 ms-auto">
                        <label for="descriptionSuccincte" class="form-label">descriptionSuccincte</label>

                        <input type="texte" class="form-control" id="descriptionSuccincte" v-model="cour.descriptionSuccincte">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="nombreHeure" class="form-label">nombreHeure</label>
                        <input type="number" class="form-control" id="nombreHeure" v-model="cour.nombreHeure">
                    </div>
                    <div class="col-md-6 ms-auto">
                        <label for="coefDiplôme" class="form-label">coefDiplôme</label>

                        <input type="number" class="form-control" id="coefDiplôme" v-model="cour.coefDiplôme">

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">.
                        <label for="coefExamen" class="form-label">coefExamen</label>
                        <input type="number" class="form-control" id="coefExamen" v-model="cour.coefExamen">
                    </div>

              
                    <div class="col-md-6">.
                        <label for="coefTd" class="form-label">coefTd</label>
                        <input type="number" class="form-control" id="coefTd" v-model="cour.coefTd">
                    </div>
                    
                    
                    
                </div>
             
                <div class="row">
                    <file-pond name="test" ref="pond" class-name="my-pond" label-idle="Drop files here..."
                        allow-multiple="false" accepted-file-types="image/jpeg, image/png" v-bind:files="myFiles"
                        v-on:init="handleFilePondInit" :server="serverOptions()" />
                </div>
                <br />
                <button type="submit" className="btn btn-outline-primary" @click="modifiercour">
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
const cour = ref({})





const handleFilePondInit = async () => {
    if (cour.value.imageens) {
        myFiles.value = [
            {
                source: cour.value.imageens,
                options: { type: 'local' }
            }
        ]
    }
}
const loadcour = () => {
    console.log(props.ens)
    cour.value = props.ens
}
onMounted(() => {

    loadcour()
}

);
const modifiercour = () => {
    api.put(`/api/cours/${cour.value.id}`, cour.value)
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
<style scoped></style>