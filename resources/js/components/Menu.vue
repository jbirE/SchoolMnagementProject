<template>
    
    <nav class="navbar navbar-expand-lg bg-aqua" data-bs-theme="dark">
      
      <router-link to="/">
            <a class="navbar-brand">
                <img class="logo" src="https://res.cloudinary.com/dtjj1rxjq/image/upload/v1702165735/ywnhlzopw6cxuziesfg8.png" alt="Logo" width="100" height="70">
                <strong>IIT</strong>
            </a>
        </router-link>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <router-link class="nav-link active" to="/listeetudiant">Etudiants</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link active" to="/listeenseignant">Enseignants</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link active" to="/listegroupe">Groupes</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link active" to="/listediplome">Diplomes</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link active" to="/listecour">Cours</router-link>
            </li>
       
            <li class="nav-item">
          <router-link class="nav-link active" to="/login">Login</router-link>
           </li>
          <li class="nav-item">
          <router-link class="nav-link active" to="/register">Register</router-link>
          </li>
          <li class="nav-item">
          <button @click="logout">Logout</button>
          </li>
          </ul>
          
        </div>
        
     

    </nav>

   

  </template>
  
  <script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter();
const logout=async()=> {
let token=""

token=localStorage.getItem('token')
console.log(token)
axios.post('http://localhost:8000/api/logout', null, {

headers: {
'Authorization': `Bearer ${token}`
}
})

.then((response) => {
console.log(response)
localStorage.removeItem('token')
localStorage.removeItem('user')


router.push("/login")
})
.catch(err => {console.log(err);alert(err) })

}

</script>
  

<style lang="scss" scoped>
</style>