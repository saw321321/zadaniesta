<template>
    <div>
      <h2>Lista Wpisów</h2>
      <a href="{{ route('posts.create') }}" class="btn btn-primary">Dodaj Wpis</a>
  
      <table class="table">
        <thead>
          <tr>
            <th>Tytuł</th>
            <th>Data Publikacji</th>
            <th>Akcje</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in posts" :key="post.id">
            <td>{{ post.title }}</td>
            <td>{{ post.publication_date }}</td>
            <td>
              <a :href="`{{ route('posts.show') }}/${post.id}`" class="btn btn-info">Pokaż</a>
              <a :href="`{{ route('posts.edit') }}/${post.id}`" class="btn btn-warning">Edytuj</a>
              <a :href="`{{ route('posts.delete') }}/${post.id}`" class="btn btn-danger">Usuń</a>
            </td>
          </tr>
        </tbody>
      </table>
  
      <pagination :data="posts" @pagination="fetchPosts"></pagination>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        posts: [],
      };
    },
    created() {
      this.fetchPosts();
    },
    methods: {
        async fetchPosts(page = 1) {
            try {
              const response = await axios.get(`{{ route('api.posts.index') }}?page=${page}`);
              this.posts = response.data.data; 
            } catch (error) {
             console.error('Wystąpił błąd podczas pobierania wpisów:', error);
            }
        },
    },
  };
  </script>