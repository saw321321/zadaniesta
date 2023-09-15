<template>
  <div>
    <h2>Dodaj użytkownika</h2>
    <form @submit.prevent="saveUser">
      <div class="form-group">
        <label for="name">Imię:</label>
        <input type="text" id="name" v-model="user.name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="user.email" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="password">Hasło:</label>
        <input type="password" id="password" v-model="user.password" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="role">Rola:</label>
        <select id="role" v-model="user.role" class="form-control">
          <option value="user">Użytkownik</option>
          <option value="admin">Administrator</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Dodaj</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      user: {
        name: '',
        email: '',
        password: '',
        role: 'user',
      },
    };
  },
  methods: {
    saveUser() {
      if (this.isEditMode) {
        // Edytuj użytkownika
        axios.put(`/users/${this.userIdToEdit}/edit`, this.user).then(() => {
          this.redirectToList();
        });
      } else {
        // Dodaj użytkownika
        axios.post('/api/users', this.user).then(() => {
          this.redirectToList();
        });
      }
    },
  },
};
</script>