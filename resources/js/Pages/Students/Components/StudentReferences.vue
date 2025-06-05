<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';

const formStore = useStudentStore();

const addRef = () => {
  formStore.addstudentReference();
};

const removeRef = (index) => {
  formStore.removestudentReference(index);
};
</script>

<template>
  <div>
    <h3 class="text-lg leading-6 font-medium text-red-700 uppercase">
      Academic / Job References
    </h3>

    <div v-for="(reference, index) in formStore.student.studentReferences" :key="index"
      class="relative border p-4 rounded-lg shadow-md bg-white mt-4">
      <!-- Add and Remove Buttons -->
      <div class="absolute top-1 right-1 flex space-x-2">
        <button @click="addRef()" type="button" class="bg-red-500 text-white px-3 py-1 rounded-md">+</button>
        <button @click="removeRef(index)" type="button" v-if="formStore.student.studentReferences.length > 1"
          class="bg-red-500 text-white px-3 py-1 rounded-md">-</button>
      </div>


      <h3 class="mb-2 text-gray-800 font-semibold">Reference - {{ index + 1 }}</h3>

      <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_name_' + index" class="block text-sm font-medium text-gray-700">Name</label>
          <input v-model="reference.ref_name" :id="'reference_name_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter name" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_phone_' + index" class="block text-sm font-medium text-gray-700">Phone Number</label>
          <input v-model="reference.ref_phone" :id="'reference_phone_' + index" type="tel" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter phone number" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_email_' + index" class="block text-sm font-medium text-gray-700">Work Email</label>
          <input v-model="reference.ref_email" :id="'reference_email_' + index" type="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter work email" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_position_' + index" class="block text-sm font-medium text-gray-700">Position</label>
          <input v-model="reference.ref_position" :id="'reference_position_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter position" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_relationship_' + index" class="block text-sm font-medium text-gray-700">Relationship
            to You</label>
          <input v-model="reference.ref_relationship" :id="'reference_relationship_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter relationship" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
          <label :for="'reference_duration_' + index" class="block text-sm font-medium text-gray-700">How long has the
            person known you?</label>
          <input v-model="reference.ref_duration" :id="'reference_duration_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                   focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter duration" />
        </div>
      </div>
    </div>
  </div>
</template>