
  
  <script>
  export default {
    data() {
      return {
        users: [] // Tutaj będziemy przechowywać listę użytkowników
      };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
   // Funkcja do pobierania listy użytkowników z API
   fetchUsers() {
     axios.get('/api/users')
       .then(response => {
         this.users = response.data;
       })
       .catch(error => {
         console.error(error);
       });
   },

   saveUser() {
    axios.post('/api/users', this.user)
      .then(response => {
        // Po sukcesie odśwież stronę
        window.location.reload();
      })
      .catch(error => {
        console.error('Błąd zapisu użytkownika:', error);
      });
  },
 }
  };
  </script>
  
  <style scoped>
  /* Stylizacja komponentu */
  </style>