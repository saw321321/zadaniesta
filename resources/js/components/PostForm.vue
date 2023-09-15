<template>
  <div>
    <h2>{{ isEditMode ? 'Edytuj Wpis' : 'Dodaj Wpis' }}</h2>
    <form @submit.prevent="savePost">
      <div class="form-group">
        <label for="title">Tytuł:</label>
        <input type="text" id="title" v-model="postData.title" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="content">Treść:</label>
        <textarea id="content" v-model="postData.content" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label for="tags">Tagi:</label>
        <select id="tags" v-model="selectedTags" class="form-control" multiple>
          <option v-for="tag in tags" :key="tag.id" :value="tag.id">{{ tag.name }}</option>
        </select>
      </div>
      <button type="submit" id="confirm-button" class="btn btn-primary">{{ isEditMode ? 'Zapisz zmiany' : 'Dodaj Wpis' }}</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    isEditMode: Boolean,
    tags: Array,
    postData: Object,
  },
  data() {
    return {
      selectedTags: [],
      postData: {
        title: '',
        content: '',
        tags: [],
        publication_date: new Date().toISOString().substr(0, 10),
      },
      currentDate: new Date().toISOString().substr(0, 10),
    };
  },
  methods: {
    savePost() {
      const postDataToSend = {
        title: this.postData.title,
        content: this.postData.content,
        tags: this.selectedTags,
        publication_date: this.postData.publication_date,
      };

      if (this.isEditMode) {
        axios.put(`/api/posts/${this.postData.id}`, postDataToSend).then(() => {
          this.hideConfirmationModal();
        });
      } else {
        axios.post('/api/posts', postDataToSend).then(() => {
          this.hideConfirmationModal();
        });
      }
    },
  },
};
</script>