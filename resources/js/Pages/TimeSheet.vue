<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TimeEntryForm from '@/Components/Time/TimeEntryForm.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import axios from 'axios';


const formatHoursToTime = (hours) => {
  const hourPart = Math.floor(hours);
  const minutePart = Math.round((hours - hourPart) * 60);

  // Pad single-digit minutes with leading zero
  const formattedMinutes = minutePart < 10 ? `0${minutePart}` : minutePart;

  return `${hourPart}:${formattedMinutes}`;
};
// get data from controller
const props = defineProps({
  entries: Array,
  projects: Array,
  week: Array,
  today: Array,
  user: Object,
  errors: Object,
  showActions: false,
  showCreateEntry: true,
});

console.log(props.projects);
let showCreateEntry = ref(false);

const currentEntries = ref([]);
const activeDate = ref(null);

let entries = props.entries;

  const getCurrentEntries = (date) => {
  currentEntries.value = props.entries.filter(entry => entry.date === date);
  activeDate.value = date;
  console.log(currentEntries.value);
};

getCurrentEntries(props.today.date);


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
<!-- show data passed from intertia/php controller -->

<section class="py-8">
  <div class="container px-4 mx-auto">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full px-4 mb-8 lg:mb-0">
        <div class="pt-4 bg-white shadow rounded">
          <div class="px-6 border-b border-blue-50">
            <div class="flex flex-wrap items-center mb-4">
              <div>
                <h3 class="text-xl font-bold">Your Time Sheet</h3>
                <!-- <p class="text-sm text-gray-500 font-medium">List of recent contracts and freelancers</p> -->
              </div>
              <a class="ml-auto flex items-center py-2 px-3 text-xs text-white bg-indigo-500 hover:bg-indigo-600 rounded" href="#">
                <span class="mr-1">
                  <svg class="h-3 w-3 text-indigo-300" viewbox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 8.33337C12.6 8.33337 12.3333 8.60004 12.3333 9.00004V11.6667C12.3333 12.0667 12.0666 12.3334 11.6666 12.3334H2.33331C1.93331 12.3334 1.66665 12.0667 1.66665 11.6667V9.00004C1.66665 8.60004 1.39998 8.33337 0.99998 8.33337C0.59998 8.33337 0.333313 8.60004 0.333313 9.00004V11.6667C0.333313 12.8 1.19998 13.6667 2.33331 13.6667H11.6666C12.8 13.6667 13.6666 12.8 13.6666 11.6667V9.00004C13.6666 8.60004 13.4 8.33337 13 8.33337ZM4.79998 4.13337L6.33331 2.60004V9.00004C6.33331 9.40004 6.59998 9.66671 6.99998 9.66671C7.39998 9.66671 7.66665 9.40004 7.66665 9.00004V2.60004L9.19998 4.13337C9.46665 4.40004 9.86665 4.40004 10.1333 4.13337C10.4 3.86671 10.4 3.46671 10.1333 3.20004L7.46665 0.533374C7.19998 0.266707 6.79998 0.266707 6.53331 0.533374L3.86665 3.20004C3.59998 3.46671 3.59998 3.86671 3.86665 4.13337C4.13331 4.40004 4.53331 4.40004 4.79998 4.13337Z" fill="currentColor"></path>
                  </svg>
                </span>
                <span>Report</span>
              </a>
            </div>
            <div>
              <a v-for="(item, index) in props.week" :key="index" :class="item == activeDate ? 'date-tab inline-block px-4 pb-2 text-sm font-medium text-indigo-500 border-b-2 border-indigo-500' : 'date-tab inline-block px-4 pb-2 text-sm font-medium text-gray-300 border-b-2 border-transparent hover:border-gray-300'" @click="getCurrentEntries(item)">{{ index }}</a>
            </div>
          </div>
          <div class="overflow-x-auto">
            <table class="table-fixed w-full">
              <thead class="bg-gray-50">
                <tr class="text-xs text-gray-500">
                  <th class="flex items-center pl-6 py-4 font-medium">Project Name</th>
                  <th class="py-4 font-medium">Time Entry</th>
                  <th class="py-4 font-medium">Budget</th>
                  <th class="py-4 font-medium">Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- using vue, create a for loop looping through data.entries -->
                
                <tr v-for="(item, index) in currentEntries" :key="index" :date="item.date" class="border-b border-blue-50 py-12 px-6">  
 
                    <td class="font-medium py-4 pl-6">
                      <p class="text-sm">{{ item.task }}</p>
                      <p class="text-xs text-gray-500">{{ item.description }}</p>
                    </td>
                    <td class="">
                      <p class="text-center mb-1 text-lg text-gray-500 font-medium">{{ formatHoursToTime(item.time) }}</p>
                    </td>
                    <td class="py-4 flex flex-col items-center">
                      
                      <p class="mb-1 text-xs text-indigo-500 font-medium">65%</p>
                      <div class="flex">
                        <div class="relative h-1 w-48 bg-indigo-50 rounded-full test">
                          <div class="absolute top-0 left-0 h-full w-custom-width  bg-indigo-500 rounded-full"></div>
                        </div>
                      </div>
                    </td>
                    <td class="py-4">
                      <!-- <button @click="editEntry">edit</button>
                      <button @click="moveEntry">move</button> 
                      <button @click="deleteEntry">delete</button> -->
                      <button  @click="showActions = !showActions" class="actions m-auto text-right flex justify-center">
                          <svg width="16" height="4" viewbox="0 0 16 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 0.333344C7.67037 0.333344 7.34813 0.431092 7.07405 0.614228C6.79997 0.797363 6.58635 1.05766 6.4602 1.36221C6.33406 1.66675 6.30105 2.00186 6.36536 2.32516C6.42967 2.64846 6.5884 2.94543 6.82149 3.17852C7.05458 3.41161 7.35155 3.57034 7.67485 3.63465C7.99815 3.69896 8.33326 3.66596 8.63781 3.53981C8.94235 3.41366 9.20265 3.20004 9.38578 2.92596C9.56892 2.65188 9.66667 2.32965 9.66667 2.00001C9.66667 1.55798 9.49107 1.13406 9.17851 0.821499C8.86595 0.508939 8.44203 0.333344 8 0.333344ZM2.16667 0.333344C1.83703 0.333344 1.5148 0.431092 1.24072 0.614228C0.966635 0.797363 0.753014 1.05766 0.626868 1.36221C0.500722 1.66675 0.467717 2.00186 0.532025 2.32516C0.596334 2.64846 0.755068 2.94543 0.988156 3.17852C1.22124 3.41161 1.51822 3.57034 1.84152 3.63465C2.16482 3.69896 2.49993 3.66596 2.80447 3.53981C3.10902 3.41366 3.36931 3.20004 3.55245 2.92596C3.73559 2.65188 3.83333 2.32965 3.83333 2.00001C3.83333 1.55798 3.65774 1.13406 3.34518 0.821499C3.03262 0.508939 2.6087 0.333344 2.16667 0.333344ZM13.8333 0.333344C13.5037 0.333344 13.1815 0.431092 12.9074 0.614228C12.6333 0.797363 12.4197 1.05766 12.2935 1.36221C12.1674 1.66675 12.1344 2.00186 12.1987 2.32516C12.263 2.64846 12.4217 2.94543 12.6548 3.17852C12.8879 3.41161 13.1849 3.57034 13.5082 3.63465C13.8315 3.69896 14.1666 3.66596 14.4711 3.53981C14.7757 3.41366 15.036 3.20004 15.2191 2.92596C15.4023 2.65188 15.5 2.32965 15.5 2.00001C15.5 1.55798 15.3244 1.13406 15.0118 0.821499C14.6993 0.508939 14.2754 0.333344 13.8333 0.333344Z" fill="#67798E"></path>
                          </svg>
                          <div v-if="showActions" class="dropdown absolute t-0 l-0 flex flex-col">
                            <button>edit</button>
                            <button>delete</button>
                            <button>move</button> 
                          </div>
                       </button>
                    </td>
                </tr>
              </tbody>
            </table>
            <div class="py-4 text-center bg-green-500 hover:bg-green-700">
              <a class="inline-flex items-center text-xl text-white font-medium" href="#">
                <span class="mr-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                </span>
                <span @click="showCreateEntry = !showCreateEntry">Add another Entry</span>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div v-if="showCreateEntry">
  <TimeEntryForm />
</div>
</AuthenticatedLayout>
</template>
