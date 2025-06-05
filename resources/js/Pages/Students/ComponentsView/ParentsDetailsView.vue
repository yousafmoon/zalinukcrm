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

    <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
        MAIN APPLICANT’S PARENT’S DETAILS (Father)
    </h3>

    <div v-if="props.student && props.student.parents_details">
        <table class="w-full table-auto border border-gray-300 text-sm mb-6">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Father’s Given Name</td>
                    <td class="p-2 whitespace-pre-line">{{ props.student.parents_details.father_given_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Family Name</td>
                    <td class="p-2">{{ props.student.parents_details.father_family_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Date of Birth</td>
                    <td class="p-2">{{ props.student.parents_details.father_date_of_birth }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Place and Country of Birth</td>
                    <td class="p-2 whitespace-pre-line">{{ props.student.parents_details.father_place_of_birth }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Father’s Nationality</td>
                    <td class="p-2">{{ props.student.parents_details.father_nationality }}</td>
                </tr>
            </tbody>
        </table>

        <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
            MAIN APPLICANT’S PARENT’S DETAILS (Mother)
        </h3>
        <table class="w-full table-auto border border-gray-300 text-sm">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Mother’s Given Name</td>
                    <td class="p-2 whitespace-pre-line">{{ props.student.parents_details.mother_given_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Family Name</td>
                    <td class="p-2">{{ props.student.parents_details.mother_family_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Date of Birth</td>
                    <td class="p-2">{{ props.student.parents_details.mother_date_of_birth }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Place and Country of Birth</td>
                    <td class="p-2 whitespace-pre-line">{{ props.student.parents_details.mother_place_of_birth }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Mother’s Nationality</td>
                    <td class="p-2">{{ props.student.parents_details.mother_nationality }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>