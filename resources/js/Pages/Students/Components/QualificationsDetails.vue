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
            QUALIFICATIONS
        </h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="qualifications" class="block text-sm font-medium text-gray-700">
                Please tell us about any Qualifications you hold at Degree level or higher:
            </label>
            <textarea v-model="formStore.student.qualifications" id="qualifications" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Tell us about any Qualifications you hold at Degree level or higher"></textarea>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="study_institution" class="block text-sm font-medium text-gray-700">
                Where did you study?
            </label>
            <input v-model="formStore.student.study_institution" type="text" id="study_institution"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter where did you study" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="subjects_studied" class="block text-sm font-medium text-gray-700">
                Subject/s studied
            </label>
            <input v-model="formStore.student.subjects_studied" type="text" id="subjects_studied"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter the subject" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="date_passed" class="block text-sm font-medium text-gray-700">
                Date passed/qualified
            </label>
            <input v-model="formStore.student.date_passed" type="date" id="date_passed"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="study_gap_after_last_degree" class="block text-sm font-medium text-gray-700">
                Study Gap after Last Degree
            </label>
            <input v-model="formStore.student.study_gap_after_last_degree" type="text" id="study_gap_after_last_degree"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter study gap" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="can_you_justify_gap" class="block text-sm font-medium text-gray-700">
                Can you justify gap?
            </label>
            <select v-model="formStore.student.can_you_justify_gap" id="can_you_justify_gap"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Please select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
    </div>
</template>