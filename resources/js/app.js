//require('./bootstrap');
//require('alpinejs');
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import UserList from './components/UserList.vue';
import UserForm from './components/UserForm.vue'; // Dodaj pozostałe komponenty, które już stworzyłeś
import PostList from './components/PostList.vue';
import PostForm from './components/PostForm.vue';
import TagList from './components/TagList.vue';
import UserEdit from './components/UserEdit.vue';
//import router from './router.js';

const app = createApp({
   // router: router,
    data() {
      return {
        PostForm: true,
        UserEdit: true,
        UserForm: true, // Zamiast showUserForm
      };
    },
  });
//app.use(router);
app.component('user-edit', UserEdit);
app.component('user-list', UserList);
app.component('user-form', UserForm); // Dodaj pozostałe komponenty
app.component('post-list', PostList);
app.component('post-form', PostForm);
app.component('tag-list', TagList);
app.mount('#app');