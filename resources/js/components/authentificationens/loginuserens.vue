<template>
    <div class="login-container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="mb-0">Login</h3>
              <router-link class="nav-link active" to="/loginuserens">Enseignants</router-link>
            </div>
            <div class="card-body">
              <form @submit.prevent="handleLogin">
                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                  <div class="col-md-8">
                    <input id="email" type="email" class="form-control" v-model="user.email" required autofocus>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                  <div class="col-md-8">
                    <input id="password" type="password" class="form-control" v-model="user.password" required>
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                      Login
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  let user = {};
  
  const handleLogin = async () => {
    try {
      const response = await axios.post('http://localhost:8000/api/loginuserens/', user);
      router.push("/menuuserens");
      localStorage.setItem('user', response.data.user.name);
      localStorage.setItem('token', response.data.token);
    } catch (error) {
      console.error(error);
      alert(error.message || 'An error occurred during login.');
    }
  };
  </script>
  
  <style scoped>
  .login-container {
    position: fixed;
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .card-default {
    width: 100%;
    max-width: 600px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  .card-header {
    background-color: #007bff;
    color: #fff;
    padding: 10px 15px;
    border-bottom: 1px solid #ccc;
  }
  
  .card-body {
    padding: 20px;
  }
  
  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
  }
  
  .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
  }
  </style>
  