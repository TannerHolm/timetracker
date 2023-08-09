<template>
  <div class="fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-8 shadow-lg">
      <h2 class="text-xl font-semibold mb-4">Add New Time Entry</h2>
      <form @submit.prevent="createTimeEntry">
        <select v-model="selectedProject" @change="fetchProjectDetails">
          <option value="">Select a project</option>
          <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
        </select>
        <label for="description">Description</label>
        <input v-model="description" id="description" type="text" required>
        <label for="hours">Hours</label>
        <input v-model="hours" id="hours" type="number" step="0.5" required>     
        <button type="submit">Create Time Entry</button>
      </form>      
    </div>
  </div>

   
  </template>
  
  <script>
  export default {
    data() {
      return {
        description: '',
        hours: 0,
        // Other data properties as needed
      };
    },
    methods: {
      async createTimeEntry() {
        try {
          const response = await this.$inertia.post('/create', {
            description: this.description,
            hours: this.hours,
            // Other data properties as needed
          });
          
          // Handle success, e.g., show a success message
          console.log('Time entry created:', response);
        } catch (error) {
          // Handle error, e.g., show an error message
          console.error('Error creating time entry:', error);
        }
      },
    },
  };
  </script>
  