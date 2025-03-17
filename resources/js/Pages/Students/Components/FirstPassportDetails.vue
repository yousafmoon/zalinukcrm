<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <p class="mt-2 text-sm text-red-700">
        IS THIS YOUR FIRST PASSPORT:
    </p>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="previous_ppt_number" class="block text-sm font-medium text-gray-700">Previous PPT Number</label>
            <input v-model="formStore.student.previous_ppt_number" type="text" id="previous_ppt_number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter previous ppt number" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="place_of_issue_previous" class="block text-sm font-medium text-gray-700">Place of Issue</label>
            <input v-model="formStore.student.place_of_issue_previous" type="text" id="place_of_issue_previous"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter previous place of issue" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="issuing_authority_previous" class="block text-sm font-medium text-gray-700">Issuing
                Authority</label>
            <input v-model="formStore.student.issuing_authority_previous" type="text" id="issuing_authority_previous"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter previous issuing authority" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="date_of_issue_previous" class="block text-sm font-medium text-gray-700">Date of Issue</label>
            <input v-model="formStore.student.date_of_issue_previous" type="date" id="date_of_issue_previous"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="date_of_expiry_previous" class="block text-sm font-medium text-gray-700">Date of Expiry</label>
            <input v-model="formStore.student.date_of_expiry_previous" type="date" id="date_of_expiry_previous"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="national_id_number" class="block text-sm font-medium text-gray-700">National Identity Card
                Number</label>
            <input v-model="formStore.student.national_id_number" type="text" id="national_id_number"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter national id card number" />
        </div>
    </div>
</template>