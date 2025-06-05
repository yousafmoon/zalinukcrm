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

    <!-- MAIN APPLICANT'S BIOGRAPHICAL INFORMATION -->
    <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">MAIN APPLICANT’S BIOGRAPHICAL INFORMATION</h2>
    <table class="w-full table-auto border border-gray-300 text-sm mb-8">
        <tbody>
            <tr class="border-b">
                <td class="font-semibold p-2 w-1/2">Choice of country</td>
                <td class="p-2">{{ props.student.choice_of_country }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Intake</td>
                <td class="p-2">{{ props.student.intake }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Intended Course</td>
                <td class="p-2">{{ props.student.intended_course }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">First Name</td>
                <td class="p-2">{{ props.student.firstname }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Middle Name</td>
                <td class="p-2">{{ props.student.middlename }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Last Name</td>
                <td class="p-2">{{ props.student.surname }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Nickname</td>
                <td class="p-2">{{ props.student.nickname }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Email</td>
                <td class="p-2">{{ props.student.email }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Gender</td>
                <td class="p-2">{{ props.student.gender }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Nationality</td>
                <td class="p-2">{{ props.student.nationality }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Date of Birth</td>
                <td class="p-2">{{ props.student.date_of_birth }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Place of Birth</td>
                <td class="p-2">{{ props.student.place_of_birth }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">UK National Insurance Number</td>
                <td class="p-2">{{ props.student.national_insurance }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Other Nationalities</td>
                <td class="p-2">{{ props.student.other_nationalities }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Marital Status</td>
                <td class="p-2">{{ props.student.marital_status }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Criminal Convictions</td>
                <td class="p-2">{{ props.student.criminal_conviction }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Police Clearance</td>
                <td class="p-2">{{ props.student.police_clearance }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Disability</td>
                <td class="p-2">{{ props.student.disability }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Living Situation</td>
                <td class="p-2">{{ props.student.living_situation }}</td>
            </tr>
            <tr class="border-b">
                <td class="font-semibold p-2">Correspondence Address</td>
                <td class="p-2">{{ props.student.correspondence_address }}</td>
            </tr>
        </tbody>
    </table>

</template>