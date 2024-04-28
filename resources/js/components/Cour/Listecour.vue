<template>
    <Addcour/>
    <div class="card">
        <DataTable :value="cours" stripedRows paginator showGridlines :rows="8" :rowsPerPageOptions="[5, 10, 20, 50]" dataKey="id" :loading="isLoading">
  
            <Column header="Image">
                <template #body="{ data }">
                    <img :src="data.imagecour" :alt=data.code class="shadow-4" width="65" />
  
                </template>
            </Column>
            <Column field="code" header="code"></Column>
  
            
            <Column field="descriptionSuccincte" header="descriptionSuccincte" sortable></Column>
  
            <Column field="nombreHeure" header="nombreHeure" sortable></Column>
  
            <Column field="coefDiplôme" header="coefDiplôme" sortable></Column>
            <Column field="coefExamen" header="coefExamen" sortable></Column>
            <Column field="coefTd" header="coefTd" sortable></Column>
            <Column field="enseignant.nom" header="Enseignant" sortable></Column>
            <Column field="id" header="Actions" style="min-width: 12rem">
                
                <template #body="val">
  
                    <div class="d-flex">
                        <Editcour :ens="val.data"/>
                        <button type="button" class="btn btn-warning rounded-circle " @click="deletecour(val.data.id)">
  
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
  </template>
  <script setup>
  import api from '../config/api.js';
  import DataTable from 'primevue/datatable';
  import Column from 'primevue/column';
  import { ref, onMounted } from 'vue';
  import Editcour from './Editcour.vue';
  import Addcour from './Addcour.vue';

  const cours = ref([])
  const isLoading = ref(true)
  const errorMessage = ref('');
  const getcours = async () => {
    await api.get("/api/cours")
        .then(res => {
            cours.value = res.data
            isLoading.value = false
        })
        .catch(error => {
            console.log(error)
        })
  }
  onMounted(() => {
    getcours();
  });
  const deletecour = async (id) => {
  if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
    try {
      await api.delete(`/api/cours/${id}`);
      getcours();
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
</style>