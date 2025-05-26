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
            THIS PAGE SHOULD ONLY BE COMPLETED IF YOUR SPOUSE / PARTNER WILL ACCOMPANY YOU TO THE UK.:
        </h3>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
        <!-- Father Section -->
        <div class="col-span-4">
            <h3 class="text-lg font-medium text-red-700">Father</h3>
        </div>
        <div class="col-span-1">
            <label for="spouse_father_given_name" class="block text-sm font-medium text-gray-700">Father’s Given
                Name</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_father_given_name" type="text"
                id="spouse_father_given_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter father's given name">
        </div>
        <div class="col-span-1">
            <label for="spouse_father_family_name" class="block text-sm font-medium text-gray-700">Father’s Family
                Name</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_father_family_name" type="text"
                id="spouse_father_family_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter father's family name">
        </div>
        <div class="col-span-1">
            <label for="father_dob" class="block text-sm font-medium text-gray-700">Father’s Date of Birth</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.father_dob" type="date" id="father_dob"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
        </div>
        <div class="col-span-1">
            <label for="father_place_of_birth" class="block text-sm font-medium text-gray-700">Father’s Place and
                Country of Birth</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.father_place_of_birth" type="text"
                id="father_place_of_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter father's place and country of birth">
        </div>

        <!-- Mother Section -->
        <div class="col-span-4">
            <h3 class="text-lg font-medium text-red-700">Mother</h3>
        </div>
        <div class="col-span-1">
            <label for="spouse_mother_given_name" class="block text-sm font-medium text-gray-700">Mother’s Given
                Name</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_mother_given_name" type="text"
                id="spouse_mother_given_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter mother's given name">
        </div>
        <div class="col-span-1">
            <label for="spouse_mother_family_name" class="block text-sm font-medium text-gray-700">Mother’s Family
                Name</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_mother_family_name" type="text"
                id="spouse_mother_family_name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter mother's family name">
        </div>
        <div class="col-span-1">
            <label for="mother_dob" class="block text-sm font-medium text-gray-700">Mother’s Date of Birth</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.mother_dob" type="date" id="mother_dob"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
        </div>
        <div class="col-span-1">
            <label for="spouse_mother_place_of_birth" class="block text-sm font-medium text-gray-700">Mother’s Place and
                Country of Birth</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_mother_place_of_birth"
                type="text" id="spouse_mother_place_of_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter mother's place and country of birth">
        </div>

        <!-- UK Visa History Section -->
        <div class="col-span-4">
            <h3 class="text-lg font-medium text-red-700">UK VISA HISTORY</h3>
        </div>
        <div class="col-span-1">
            <label for="spouse_visa_valid_from" class="block text-sm font-medium text-gray-700">Date Valid From</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_visa_valid_from" type="date"
                id="spouse_visa_valid_from"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
        </div>
        <div class="col-span-1">
            <label for="spouse_visa_expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
            <input v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_visa_expiry_date" type="date"
                id="spouse_visa_expiry_date"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
        </div>
        <div class="col-span-1">
            <label for="spouse_visa_type" class="block text-sm font-medium text-gray-700">Visa Type
                (Business/Visit)</label>
            <select v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_visa_type" id="spouse_visa_type"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled>Select Visa Type</option>
                <option value="business">Business</option>
                <option value="visit">Visit</option>
            </select>
        </div>
        <div class="col-span-1">
            <label for="spouse_travel_history" class="block text-sm font-medium text-gray-700">Overseas Travel
                History</label>
            <textarea v-model="formStore.student.spousepartnersaccompanyingDetails.spouse_travel_history"
                id="spouse_travel_history" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Provide travel details"></textarea>
        </div>

    </div>
</template>