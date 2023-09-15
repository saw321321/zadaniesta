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
  userId: Number, // Przekazujemy ID użytkownika, który ma być edytowany
},
data() {
  return {
    user: {
      id: this.userId, // Użyj przekazanego ID użytkownika
      name: '',
      email: '',
      role: 'user',
    },
  };
},
created() {
  // Teraz możesz użyć userId do żądania API lub innych operacji
  this.getUserData(this.userId);
},
methods: {
  getUserData(userId) {
    // Wykonaj żądanie API do pobrania danych użytkownika
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
  // Wykonaj akcję aktualizacji użytkownika
  axios.put(`/api/users/${this.userId}`, { // Użyj this.userId
    name: this.user.name,
    email: this.user.email,
    role: this.user.role,
  })
    .then(() => {
      // Po zaktualizowaniu użytkownika wykonaj odpowiednie akcje (np. powrót do listy)
      this.$router.push('/users'); // Przykład przekierowania do listy użytkowników
    })
    .catch((error) => {
      console.error('Błąd aktualizacji użytkownika:', error);
    });
},
},
};
</script>
