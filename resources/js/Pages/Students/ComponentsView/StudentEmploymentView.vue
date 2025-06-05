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
    <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">WORK HISTORY</h2>

    <div v-if="props.student.student_employment && props.student.student_employment.length">
        <div v-for="(history, index) in props.student.student_employment" :key="index" class="mb-6">
            <h3 class="font-semibold text-gray-700 mb-2">Job {{ index + 1 }}</h3>
            <table class="w-full table-auto border border-gray-300 text-sm mb-4">
                <tbody>
                    <tr class="border-b">
                        <td class="font-semibold p-2 w-1/2">Personal Circumstances</td>
                        <td class="p-2">{{ history.personal_circumstances }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Employment Details</td>
                        <td class="p-2">{{ history.employment_details }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Present Work</td>
                        <td class="p-2">{{ history.present_work }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Company Name</td>
                        <td class="p-2">{{ history.company_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Start Date</td>
                        <td class="p-2">{{ history.job_start_date }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Work Address</td>
                        <td class="p-2">{{ history.work_address }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Employer Phone</td>
                        <td class="p-2">{{ history.employer_phone }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Employer Email</td>
                        <td class="p-2">{{ history.employer_email }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold p-2">Additional Jobs</td>
                        <td class="p-2">{{ history.additional_students }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>
