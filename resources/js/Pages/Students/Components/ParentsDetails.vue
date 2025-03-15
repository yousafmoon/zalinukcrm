<script setup>

import { useStudentStore } from '@/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            MAIN APPLICANT’S PARENT’S DETAILS (Father)</h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="father_given_name" class="block text-sm font-medium text-gray-700">Father’s Given Name</label>
            <input v-model="formStore.student.father_given_name" type="text" id="father_given_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter father given name" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="father_family_name" class="block text-sm font-medium text-gray-700">Father’s Family Name</label>
            <input v-model="formStore.student.father_family_name" type="text" id="father_family_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter father family name" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="father_date_of_birth" class="block text-sm font-medium text-gray-700">Father’s Date of
                Birth</label>
            <input v-model="formStore.student.father_date_of_birth" type="date" id="father_date_of_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="father_place_birth" class="block text-sm font-medium text-gray-700">Father’s Place and Country
                of Birth</label>
            <input v-model="formStore.student.father_place_birth" type="text" id="father_place_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter father's place and country of birth" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="father_nationality" class="block text-sm font-medium text-gray-700">Father’s Nationality</label>
            <input v-model="formStore.student.father_nationality" type="text" id="father_nationality"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter father's nationality" />
        </div>

    </div>


    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            MAIN APPLICANT’S PARENT’S DETAILS (Mother)</h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="mother_given_name" class="block text-sm font-medium text-gray-700">Mother’s Given Name</label>
            <input v-model="formStore.student.mother_given_name" type="text" id="mother_given_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter mother's given name" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="mother_family_name" class="block text-sm font-medium text-gray-700">Mother’s Family Name</label>
            <input v-model="formStore.student.mother_family_name" type="text" id="mother_family_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter mother's family name" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="mother_date_of_birth" class="block text-sm font-medium text-gray-700">Mother’s Date of
                Birth</label>
            <input v-model="formStore.student.mother_date_of_birth" type="date" id="mother_date_of_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="mother_place_birth" class="block text-sm font-medium text-gray-700">Mother’s Place and Country
                of Birth</label>
            <input v-model="formStore.student.mother_place_birth" type="text" id="mother_place_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter mother's palce and country of birth" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="mother_nationality" class="block text-sm font-medium text-gray-700">Mother’s Nationality</label>
            <input v-model="formStore.student.mother_nationality" type="text" id="mother_nationality"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter mother nationality" />
        </div>

    </div>
</template>