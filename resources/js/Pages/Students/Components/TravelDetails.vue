<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            DATES OF TRAVEL
        </h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-6 md:col-span-6">
            <label for="travel_date" class="block text-sm font-medium text-gray-700">
                What date do you hope to travel to the UK?
            </label>
            <input v-model="formStore.student.travelDetails.travel_date" type="date" id="travel_date"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
    </div>

</template>