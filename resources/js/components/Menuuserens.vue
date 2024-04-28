<template>
   <div class="background-container">
    <nav class="navbar navbar-expand-lg bg-aqua" data-bs-theme="dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
    <img class="logo" src="https://res.cloudinary.com/dtjj1rxjq/image/upload/v1702165735/ywnhlzopw6cxuziesfg8.png" alt="Logo" width="100" height="70"><strong>IIT</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
         <li>
              <router-link class="nav-link active" to="/">Cours</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link active" to="/">Notes</router-link>
            </li>
            <li class="nav-item">
          <router-link class="nav-link active" to="/loginuserens">Login</router-link>
           </li>
          <li class="nav-item">
          <router-link class="nav-link active" to="/registeruserens">Register</router-link>
          </li>
          <li class="nav-item">
          <button @click="deconnexion">Logout</button>
          </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-sm-2" type="search" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
          </form>

        </div>
        
      </div>

    </nav>

    <div class="container" >
      <router-view></router-view>
   </div>
  </div>
  </template>
  
  <script setup>
import axios from 'axios';
import { useRouter } from 'vue-router';
const router = useRouter();
const deconnexion=async()=> {
let token=""

token=localStorage.getItem('token')
console.log(token)
axios.post('http://localhost:8000/api/deconnexion', null, {

headers: {
'Authorization': `Bearer ${token}`
}
})

.then((response) => {
console.log(response)
localStorage.removeItem('token')
localStorage.removeItem('user')


router.push("/")
})
.catch(err => {console.log(err);alert(err) })

}

</script>
  
<style lang="scss" scoped>
.background-container {
  background-image: url('../../../../scolarite/scolarite/src/assets/napu.PNG');
  background-position: center center; 
  background-repeat: no-repeat;
}

.bg-aqua {
  background-color: rgb(82, 204, 194);
}


.logo {
  margin-right: 10px;
}
</style>