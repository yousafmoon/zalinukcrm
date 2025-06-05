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
        QUALIFICATIONS
    </h3>

    <div v-if="props.student && props.student.qualifications_details">
        <table class="w-full table-auto border border-gray-300 text-sm">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">
                        Please tell us about any Qualifications you hold at Degree level or higher:
                    </td>
                    <td class="p-2 whitespace-pre-wrap">
                        {{ props.student.qualifications_details.qualifications }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Where did you study?</td>
                    <td class="p-2">
                        {{ props.student.qualifications_details.study_institution }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Subject/s studied</td>
                    <td class="p-2">
                        {{ props.student.qualifications_details.subjects_studied }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Date passed/qualified</td>
                    <td class="p-2">
                        {{ props.student.qualifications_details.date_passed }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Study Gap after Last Degree</td>
                    <td class="p-2">
                        {{ props.student.qualifications_details.study_gap_after_last_degree }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">Can you justify gap?</td>
                    <td class="p-2">
                        {{ props.student.qualifications_details.can_you_justify_gap }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>