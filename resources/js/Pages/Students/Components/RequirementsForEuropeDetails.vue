<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <div class="col-span-1 sm:col-span-2">
        <h3 class="text-lg font-medium text-red-700">Requirements for Europe</h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-4">
            <div class="mt-2">
                <label for="do_you_have_block_account" class="block text-sm font-medium text-gray-700">
                    Do you have Block account?
                </label>
                <input v-model="formStore.student.do_you_have_block_account" type="text" id="do_you_have_block_account"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter your block account">
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <div class="mt-2">
                <label for="have_you_legalised_documents" class="block text-sm font-medium text-gray-700">
                    Have you legalised the documents from Embassy?
                </label>
                <input v-model="formStore.student.have_you_legalised_documents" type="text"
                    id="have_you_legalised_documents"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter legalisation details">
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <div class="mt-2">
                <label for="bonafide_student_undertaking" class="block text-sm font-medium text-gray-700">
                    Bonafide Student Undertaking
                </label>
                <input v-model="formStore.student.bonafide_student_undertaking" type="text"
                    id="bonafide_student_undertaking"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    placeholder="Enter undertaking details">
            </div>
        </div>
    </div>
</template>