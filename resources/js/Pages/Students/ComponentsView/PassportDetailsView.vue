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
    <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">MAIN APPLICANT’S PASSPORT INFORMATION</h2>


    <div v-if="props.student && props.student.passport_details">
        <table class="w-full table-auto border border-gray-300 text-sm mt-2 mb-6">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Current Passport Number</td>
                    <td class="p-2">{{ props.student.passport_details.passport_number }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Place of Issue</td>
                    <td class="p-2">{{ props.student.passport_details.place_of_issue }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Issuing Authority</td>
                    <td class="p-2">{{ props.student.passport_details.issuing_authority }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Date of Issue</td>
                    <td class="p-2">{{ props.student.passport_details.date_of_issue }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Date of Expiry</td>
                    <td class="p-2">{{ props.student.passport_details.date_of_expiry }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>