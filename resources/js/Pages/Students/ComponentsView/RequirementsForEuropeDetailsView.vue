<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';

import { watchEffect } from 'vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();

watchEffect(() => {
    if (props.student) {
        formStore.student = props.student;
    }
});
</script>
<template>
    <div class="col-span-1 sm:col-span-2 mb-4">
        <h3 class="text-lg font-medium text-red-700">Requirements for Europe</h3>
    </div>

    <div v-if="props.student && props.student.requirements_for_europe_details">
        <table class="w-full table-auto border border-gray-300 text-sm mb-4">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Do you have Block account?</td>
                    <td class="p-2">{{ props.student.requirements_for_europe_details.do_you_have_block_account }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Have you legalised the documents from Embassy?</td>
                    <td class="p-2">{{ props.student.requirements_for_europe_details.have_you_legalised_documents }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Bonafide Student Undertaking</td>
                    <td class="p-2">{{ props.student.requirements_for_europe_details.bonafide_student_undertaking }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
