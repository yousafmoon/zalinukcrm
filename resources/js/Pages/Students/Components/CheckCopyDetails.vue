<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <div class="col-span-1 sm:col-span-2">
            <h3 class="text-lg font-medium text-red-700">Please forward this completed questionnaire and the following
                copy documents to your admission officer at ZALINUK CONSULTANTS</h3>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <label for="copy_current_passport" class="inline-flex items-center">
                <input v-model="formStore.student.copy_current_passport" type="checkbox" id="copy_current_passport"
                    class="form-checkbox h-5 w-5 text-red-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Copy of current passports for all applicants
                    confirming personal details</span>
            </label>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <label for="copy_any_current_previous_uk_visas" class="inline-flex items-center">
                <input v-model="formStore.student.copy_any_current_previous_uk_visas" type="checkbox"
                    id="copy_any_current_previous_uk_visas" class="form-checkbox h-5 w-5 text-red-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Copy of any current/previous UK visas</span>
            </label>
        </div>

        <div class="col-span-1 sm:col-span-1">
            <label for="copy_any_previous_passports" class="inline-flex items-center">
                <input v-model="formStore.student.copy_any_previous_passports" type="checkbox"
                    id="copy_any_previous_passports" class="form-checkbox h-5 w-5 text-red-500">
                <span class="ml-2 text-sm font-medium text-gray-700">Copy of any previous passports still in your
                    possession</span>
            </label>
        </div>
    </div>

    <div class="col-span-6 sm:col-span-3 md:col-span-6">
        <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
        <textarea v-model="formStore.student.remarks" id="remarks" rows="10"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
            placeholder="Please enter remarks"></textarea>
    </div>
</template>