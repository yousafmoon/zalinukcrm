<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            MAIN APPLICANT’S PASSPORT INFORMATION
        </h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="passport_number" class="block text-sm font-medium text-gray-700">Current Passport Number</label>
            <input v-model="formStore.student.passport_number" type="text" id="passport_number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter current passport number" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="place_of_issue" class="block text-sm font-medium text-gray-700">Place of Issue</label>
            <input v-model="formStore.student.place_of_issue" type="text" id="place_of_issue"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter place of issue" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="issuing_authority" class="block text-sm font-medium text-gray-700">Issuing Authority</label>
            <input v-model="formStore.student.issuing_authority" type="text" id="issuing_authority"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter issuing authority" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="date_of_issue" class="block text-sm font-medium text-gray-700">Date of Issue</label>
            <input v-model="formStore.student.date_of_issue" type="date" id="date_of_issue"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="date_of_expiry" class="block text-sm font-medium text-gray-700">Date of Expiry</label>
            <input v-model="formStore.student.date_of_expiry" type="date" id="date_of_expiry"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
    </div>
</template>