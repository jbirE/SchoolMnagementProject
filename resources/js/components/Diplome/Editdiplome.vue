<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">

        <h4 align="center">Modifier diplome</h4>
        <form @submit.prevent="modifierdiplome">
            <div class="row">
                <div class="col-md-6">.
                    <label for="nom_diplome" class="form-label">nom diplome</label>

                    <input type="text" class="form-control" id="nom_diplome" v-model="diplome.nom_diplome">

                </div>
                
            </div>

            
            <br />
            <button type="submit" className="btn btn-outline-primary">
                <i class="fa-solid fa-floppy-disk"></i>Enregister
            </button>
            <router-link to="/listediplome" class="btn btn-outline-danger mx-2">
                <i class="fa-solid fa-xmark"></i>Cancel
            </router-link>

        </form>
    </div>
</template>
    
<script setup>
import { ref, onMounted } from "vue"
import { useRouter, useRoute } from 'vue-router';



const router = useRouter();
const route = useRoute();
import axios from 'axios';

const diplome = ref({});
const fetchdiplome = async () => {
    await
        axios.get(`http://localhost:8000/api/diplomes/${route.params.id}`).then((res) => {

            diplome.value = res.data;
        })
            .catch((err) => { console.error(err) })
}



const modifierdiplome = () => {
    axios.put(`http://localhost:8000/api/diplomes/${route.params.id}`, diplome
        .value)

        .then(() => {
            router.push('/diplomes')
        })
        .catch(error => {

            

            console.error("There was an error!", error);
        })

}
onMounted(() => {
   
    fetchdiplome()
}

);


</script>
<style scoped></style>