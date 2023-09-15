<template>
  <div>
    <h2>Edytuj użytkownika</h2>
    <form @submit.prevent="updateUser">
      <div class="form-group">
        <label for="name">Imię:</label>
        <input type="text" id="name" v-model="user.name" class="form-control">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="user.email" class="form-control">
      </div>
      <div class="form-group">
        <label for="role">Rola:</label>
        <select id="role" v-model="user.role" class="form-control">
          <option value="user">Użytkownik</option>
          <option value="admin">Administrator</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Zapisz zmiany</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
props: {
  userId: Number, 
},
data() {
  return {
    user: {
      id: this.userId, 
      name: '',
      email: '',
      role: 'user',
    },
  };
},
created() {
  
  this.getUserData(this.userId);
},
methods: {
  getUserData(userId) {
   
    axios.get(`/api/users/${userId}`)
      .then((response) => {
        const userData = response.data;
        this.user = {
          id: userData.id,
          name: userData.name,
          email: userData.email,
          role: userData.role,
        };
      })
      .catch((error) => {
        console.error('Błąd pobierania danych użytkownika:', error);
      });
  },
  updateUser() {
  
  axios.put(`/api/users/${this.userId}`, { 
    name: this.user.name,
    email: this.user.email,
    role: this.user.role,
  })
    .then(() => {
      
      this.$router.push('/users'); 
    })
    .catch((error) => {
      console.error('Błąd aktualizacji użytkownika:', error);
    });
},
},
};
</script>
