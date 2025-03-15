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
            PLEASE PROVIDE THE FOLLOWING INFORMATION – IF APPLICABLE – EVEN IF YOUR FAMILY ARE NOT ACCOMPANYING YOU TO
            THE UK.
        </h3>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
        <div class="col-span-1 sm:col-span-1">
            <div class="mt-2">
                <label for="spouse_given_name" class="block text-sm font-medium text-gray-700">Spouse / Partner’s Given
                    Name</label>
                <input v-model="formStore.student.spouse_given_name" type="text" id="spouse_given_name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter spouse/partner's given name">
            </div>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <div class="mt-2">
                <label for="spouse_family_name" class="block text-sm font-medium text-gray-700">Spouse / Partner’s
                    Family Name</label>
                <input v-model="formStore.student.spouse_family_name" type="text" id="spouse_family_name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter spouse/partner's family name">
            </div>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <div class="mt-2">
                <label for="spouse_passport_number" class="block text-sm font-medium text-gray-700">Spouse Passport
                    Number (if held)</label>
                <input v-model="formStore.student.spouse_passport_number" type="text" id="spouse_passport_number"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter spouse's passport number (if applicable)">
            </div>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <div class="mt-2">
                <label for="spouse_location" class="block text-sm font-medium text-gray-700">Where is your spouse /
                    partner now</label>
                <input v-model="formStore.student.spouse_location" type="text" id="spouse_location"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter spouse/partner's current location">
            </div>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <div class="mt-2">
                <label for="spouse_dob" class="block text-sm font-medium text-gray-700">Spouse / Partner’s Date of
                    Birth</label>
                <input v-model="formStore.student.spouse_dob" type="date" id="spouse_dob"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <div class="mt-2">
                <label for="spouse_nationality" class="block text-sm font-medium text-gray-700">Spouse’s
                    Nationality</label>
                <input v-model="formStore.student.spouse_nationality" type="text" id="spouse_nationality"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter spouse's nationality">
            </div>
        </div>

        <div class="col-span-1 sm:col-span-2">
            <div class="mt-2">
                <label for="spouse_accompanying_uk" class="block text-sm font-medium text-gray-700">Will your spouse /
                    partner be accompanying you to the United Kingdom?</label>
                <select v-model="formStore.student.spouse_accompanying_uk" id="spouse_accompanying_uk"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    <option value="" disabled>Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>
        </div>
    </div>
</template>