<template>
    <Addenseignant/>
    <div class="card">
        <DataTable :value="enseignants" stripedRows paginator showGridlines :rows="8" :rowsPerPageOptions="[5, 10, 20, 50]" dataKey="id" :loading="isLoading">
  
            <Column header="Image">
                <template #body="{ data }">
                    <img :src="data.imageens" :alt=data.code class="shadow-4" width="65" />
  
                </template>
            </Column>
            <Column field="code" header="code"></Column>
  
            
            <Column field="nom" header="Nom" sortable></Column>
  
            <Column field="prénom" header="Prenom" sortable></Column>
  
            <Column field="grade" header="Grade" sortable></Column>
            <Column field="numBureau" header="numBureau" sortable></Column>
            <Column field="mail" header="mail" sortable></Column>
            <Column field="téléphone" header="téléphone" sortable></Column>
            <Column field="login" header="login" sortable></Column>
            <Column field="password" header="password" sortable></Column>
            
            <Column field="id" header="Actions" style="min-width: 12rem">
                
                <template #body="val">
  
                    <div class="d-flex">
                        <Editenseignant :ens="val.data"/>
                        <button type="button" class="btn btn-warning rounded-circle " @click="deleteenseignant(val.data.id)">
  
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
  import Editenseignant from './Editenseignant.vue';
  import Addenseignant from './Addenseignant.vue';

  const enseignants = ref([])
  const isLoading = ref(true)
  const errorMessage = ref('');
  const getenseignants = async () => {
    await api.get("/api/enseignants")
        .then(res => {
            enseignants.value = res.data
            isLoading.value = false
        })
        .catch(error => {
            console.log(error)
        })
  }
  onMounted(() => {
    getenseignants();
  });
  const deleteenseignant = async (id) => {
  if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
    try {
      await api.delete(`/api/enseignants/${id}`);
      getenseignants();
    } catch (error) {
      console.error(error);
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