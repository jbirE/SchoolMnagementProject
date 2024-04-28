<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2
            shadow">
        <h4 align="center">Ajout diplome</h4>
        <form @submit.prevent="Adddiplome">
            <div class="row">
                <div class="col-md-6">
                    <label for="reference" class="form-label">Nom</label>

                    <input type="text" class="form-control" id="nom_diplome" v-model="diplome.nom_diplome">

                </div>
               
            </div>
         <br />
            <button type="submit" className="btn btn-outline-primary">
                <i class="fa-solid fa-floppy-disk"></i>Enregister

            </button>
            <router-link to="/listediplome" class="btn btn-outline-dangermx-2">

                <i class="fa-solid fa-xmark"></i>Cancel
            </router-link>
        </form>
    </div>
</template>


<script setup>
import { ref} from "vue"
import { useRouter } from 'vue-router';
import axios from 'axios';

// Create FilePond component

const router = useRouter()

const diplome = ref({
    nom_diplome: ""
})

const Adddiplome = async () => {
    await
        axios.post("http://localhost:8000/api/diplomes/", diplome.value)
            .then(() => (

                router.push({ name: 'Listediplome' })
            ))

            .catch(err => console.log(err))

}


</script>

<style lang="css" scoped></style>