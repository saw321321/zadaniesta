
  
  <script>
  export default {
    data() {
      return {
        users: [] 
      };
    },
    mounted() {
        this.fetchUsers();
    },
    methods: {
   
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
 
  </style>