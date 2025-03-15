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
            UK VISA HISTORY:</h3>
    </div>
    <label for="visa_type" class="block text-sm font-medium text-gray-700">
        If you have been granted a UK visa in the last 10 years, please provide details:
    </label>
    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-6 sm:col-span-3 md:col-span-3">

            <div class="mt-2">
                <label for="visa_type" class="block text-sm font-medium text-gray-700">VISA TYPE</label>
                <select v-model="formStore.student.visa_type" id="visa_type"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                    <option value="" disabled selected>Select Visa Type</option>
                    <option value="business">Business</option>
                    <option value="tourist">Tourist</option>
                    <option value="work">Work</option>
                </select>
            </div>
        </div>


        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <div class="mt-2">
                <label for="visa_valid_from" class="block text-sm font-medium text-gray-700">DATE VALID FROM</label>
                <input v-model="formStore.student.visa_valid_from" type="date" id="visa_valid_from"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <div class="mt-2">
                <label for="visa_expiry_date" class="block text-sm font-medium text-gray-700">EXPIRY DATE</label>
                <input v-model="formStore.student.visa_expiry_date" type="date" id="visa_expiry_date"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <div class="mt-2">
                <label for="visa_reference_number" class="block text-sm font-medium text-gray-700">REFERENCE NUMBER (if
                    applicable)</label>
                <input v-model="formStore.student.visa_reference_number" type="text" id="visa_reference_number"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter reference number if applicable">
            </div>

        </div>

    </div>
</template>