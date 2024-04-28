<template>
 
  <div>
      <div v-if="isLoading">
          <h2> Loading .... </h2>
      </div>
      <div v-else class="py-6">
          <nav class="navbar navbar-expand-lg navbar-dark bg-info">
              <div class="container-fluid">

                  <router-link :to="{ name: 'Addgroupe' }" class="btn btn-outline-light"><i
                          class="fa-regular fa-square-plus"></i>

                      New Groupe
                  </router-link>

              </div>
          </nav>
          <table class="table table-striped shadow">
              <thead>
                  <tr>
                      <th scope="col">Nom</th>
               
             
                      <th scope="col">Modifier</th>
                      <th>Supprimer</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="Grp in Groupes" :key="Grp.id">

                      <td>{{ Grp.nom_groupe }}</td>
           
               

                      <td>
                          <router-link :to="{ name: 'Editgroupe', params: { id: Grp.id } }"
                              class="btn btn-outline-warning mx-2">
                              <i class="fa-solid fa-pen-to-square"></i>
                              Modifier
                          </router-link>
                      </td>

                      <td><button class="btn btn-outline-danger mx-2" @click="deleteGroupe(Grp.id)">

                              <i class="fa-solid fa-trash-can"></i>
                              Delete
                          </button></td>
                  </tr>
              </tbody>
          </table>

      </div>
  </div>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const Groupes = ref([])
const isLoading = ref(true)


const getGroupes = async () => {
  await axios.get("http://localhost:8000/api/groupes")
      .then(res => {
          Groupes.value = res.data
          isLoading.value = false
      })
      .catch(error => {
          console.log(error)
      })
}
onMounted(() => {
  getGroupes();
});
const deleteGroupe = async (id) => {
  if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
      try {



          await axios.delete(`http://localhost:8000/api/groupes/${id}`)

          getGroupes()
      } catch (error) {
          console.log(error)
      }
  }
}
</script>
<style lang="scss" scoped></style>