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
            OTHER INFORMATION
        </h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-4">
            <label for="family_in_uk" class="block text-sm font-medium text-gray-700">
                Do you have any immediate family in the UK?
            </label>
            <select v-model="formStore.student.family_in_uk" id="family_in_uk"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Please select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-8">
            <label for="travelling_with_others" class="block text-sm font-medium text-gray-700">
                Will you be travelling to the UK with someone who is NOT your partner, spouse, or dependent?
            </label>
            <select v-model="formStore.student.travelling_with_others" id="travelling_with_others"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Please select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
    </div>
</template>