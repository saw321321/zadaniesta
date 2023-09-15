<template>
    <div>
      <h2>Lista Tagów</h2>
      <ul>
        <li v-for="(tag, index) in tags" :key="index">{{ tag.name }}</li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      tags: Array, // Przyjmuje tablicę tagów
    },
  };
  
  </script>
  
  <style scoped>
  /* Style dla komponentu TagList.vue */
  </style>