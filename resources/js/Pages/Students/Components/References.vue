<script setup>
import { useStudentStore } from '@/Stores/studentStore';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
  student: Object
});
const formStore = useStudentStore();
</script>

<template>
  <div>
    <h3 class="text-lg leading-6 font-medium text-red-700">
      ACADEMIC / JOB REFERENCES
    </h3>

    <div v-for="(reference, index) in formStore.references" :key="index">
      <div class="col-span-12 mb-4 flex justify-between items-center">
        <h3>Reference - {{ index + 1 }}</h3>
        <div>
          <button type="button" @click="formStore.removeReference(index)"
            class="text-red-500 border border-red-700 rounded-md p-2">-
          </button>
          <button type="button" @click="formStore.addReference()"
            class="text-red-500 border border-red-700 rounded-md p-2">+
          </button>
        </div>
      </div>

      <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_name_' + index" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="reference.name" :id="'reference_name_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter name" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_phone_' + index" class="block text-sm font-medium text-gray-700">Phone Number</label>
          <input v-model="reference.phone" :id="'reference_phone_' + index" type="tel" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter phone number" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_email_' + index" class="block text-sm font-medium text-gray-700">Work Email</label>
          <input v-model="reference.email" :id="'reference_email_' + index" type="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter work email" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_position_' + index" class="block text-sm font-medium text-gray-700">Position</label>
          <input v-model="reference.position" :id="'reference_position_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter position" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_relationship_' + index" class="block text-sm font-medium text-gray-700">Relationship
            to You</label>
          <input v-model="reference.relationship" :id="'reference_relationship_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter relationship" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_duration_' + index" class="block text-sm font-medium text-gray-700">How long has the
            person known you?</label>
          <input v-model="reference.duration" :id="'reference_duration_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter duration" />
        </div>
      </div>
    </div>
  </div>
</template>
