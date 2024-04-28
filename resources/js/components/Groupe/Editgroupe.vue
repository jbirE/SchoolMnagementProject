<template>
    <div class="col-md-6 offset-md-3 border rounded p-4 mt-2 shadow">

        <h4 align="center">Modifier Groupe</h4>
        <form @submit.prevent="modifiergroupe">
            <div class="row">
                <div class="col-md-6">.
                    <label for="nom_groupe" class="form-label">nom groupe</label>

                    <input type="text" class="form-control" id="nom_groupe" v-model="groupe.nom_groupe">

                </div>
                
            </div>

            
            <br />
            <button type="submit" className="btn btn-outline-primary">
                <i class="fa-solid fa-floppy-disk"></i>Enregister
            </button>
            <router-link to="/listegroupe" class="btn btn-outline-danger mx-2">
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

const groupe = ref({});
const fetchGroupe = async () => {
    await
        axios.get(`http://localhost:8000/api/groupes/${route.params.id}`).then((res) => {

            groupe.value = res.data;
        })
            .catch((err) => { console.error(err) })
}



const modifiergroupe = () => {
    axios.put(`http://localhost:8000/api/groupes/${route.params.id}`, groupe
        .value)

        .then(() => {
            router.push('/groupes')
        })
        .catch(error => {

            

            console.error("There was an error!", error);
        })

}
onMounted(() => {
   
    fetchGroupe()
}

);


</script>
<style scoped></style>