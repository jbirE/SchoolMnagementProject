<template>
  <div class="list-container">
    <Addetudiant/>
    <div class="card">
        <DataTable :value="etudiants" stripedRows paginator showGridlines :rows="8" :rowsPerPageOptions="[5, 10, 20, 50]" dataKey="id" :loading="isLoading">
  
            <Column header="Image">
                <template #body="{ data }">
                    <img :src="data.imageetud" :alt=data.id_etudiant class="shadow-4" width="65" />
  
                </template>
            </Column>
            <Column field="id_etudiant" header="id_etudiant"></Column>
  
            
            <Column field="Nom" header="Nom" sortable></Column>
  
            <Column field="Prenom" header="Prenom" sortable></Column>
            <Column field="DateNaissance" header="DateNaissance" sortable></Column>
            <Column field="diplome.nom_diplome" header="Diplome" sortable></Column>
  
            <Column field="groupe.nom_groupe" header="Groupe" sortable></Column>
            <Column field="adressePersonnelle" header="adressePersonnelle" sortable></Column>
            <Column field="mail" header="mail" sortable></Column>
            <Column field="téléphone" header="téléphone" sortable></Column>
            <Column field="login" header="login" sortable></Column>
            <Column field="password" header="password" sortable></Column>
            
            <Column field="id" header="Actions" style="min-width: 12rem">
                
                <template #body="val">
  
                    <div class="d-flex">
                        <Editetudiant :art="val.data"/>
                        <button type="button" class="btn btn-warning rounded-circle " @click="deleteetudiant(val.data.id)">
  
                            <span style="color: rgb(245, 5, 5)">
                                <i class="fa-solid fa-trash"></i>   
  
                            </span>
                            
  
                        </button>
                        
                    </div>
                </template>
            </Column>
        </DataTable>
        <div v-if="errorMessage" class="error-message">
      {{ errorMessage }}
    </div>
    </div>
  </div>
  </template>
  <script setup>
  import api from '../config/api.js';
  import DataTable from 'primevue/datatable';
  import Column from 'primevue/column';
  import { ref, onMounted } from 'vue';
  import Editetudiant from './Editetudiant.vue';
  import Addetudiant from './Addetudiant.vue';
  let token = ""
token = localStorage.getItem('token')
const config = {
    headers : {Authorization:`Bearer ${token}`}
};
  const etudiants = ref([])
  const isLoading = ref(true)
  const errorMessage = ref('');
  const getetudiants = async () => {
    await api.get("/api/etudiants",config)
        .then(res => {
            etudiants.value = res.data
            isLoading.value = false
        })
        .catch(error => {
            console.log(error)
        })
  }
  onMounted(() => {
    getetudiants();
  });
  const deleteetudiant = async (id) => {
  if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
    try {
      await api.delete(`/api/etudiants/${id}`);
      getetudiants();
    } catch (error) {
      console.error(error);
      errorMessage.value = "Impossible de supprimer l'étudiant car des références existent dans les tables 'groupes' et 'diplomes'.";
    }
  }
};


  </script>
  <style lang="scss" scoped>
  .error-message {
  color: red;
  margin-top: 10px;
  }

  .list-container {
  background: none;  // Remplacez par le style d'arrière-plan que vous souhaitez pour cette page
}
</style>