<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { watchEffect } from 'vue';

const props = defineProps({
  student: Object
});

const formStore = useStudentStore();

watchEffect(() => {
  if (props.student) {
    formStore.student = props.student;
  }
});
</script>

<template>

  <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">ACADEMIC / JOB REFERENCES</h2>


  <div v-if="props.student && props.student.student_references && props.student.student_references.length">
    <div v-for="(reference, index) in props.student.student_references" :key="index" class="mb-6">
      <h3 class="font-semibold text-md mb-2">Reference {{ index + 1 }}</h3>
      <table class="w-full table-auto border border-gray-300 text-sm mb-4">
        <tbody>
          <tr class="border-b">
            <td class="font-semibold p-2 w-1/2">Name</td>
            <td class="p-2">{{ reference.ref_name }}</td>
          </tr>
          <tr class="border-b">
            <td class="font-semibold p-2">Phone Number</td>
            <td class="p-2">{{ reference.ref_phone }}</td>
          </tr>
          <tr class="border-b">
            <td class="font-semibold p-2">Work Email</td>
            <td class="p-2">{{ reference.ref_email }}</td>
          </tr>
          <tr class="border-b">
            <td class="font-semibold p-2">Position</td>
            <td class="p-2">{{ reference.ref_position }}</td>
          </tr>
          <tr class="border-b">
            <td class="font-semibold p-2">Relationship to You</td>
            <td class="p-2">{{ reference.ref_relationship }}</td>
          </tr>
          <tr>
            <td class="font-semibold p-2">How long has the person known you?</td>
            <td class="p-2">{{ reference.ref_duration }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</template>