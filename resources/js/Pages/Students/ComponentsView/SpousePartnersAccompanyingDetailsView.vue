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
    <h3 class="text-lg leading-6 font-medium text-red-700 mt-4 mb-2">
        THIS PAGE SHOULD ONLY BE COMPLETED IF YOUR SPOUSE / PARTNER WILL ACCOMPANY YOU TO THE UK.
    </h3>


    <div v-if="props.student && props.student.spouse_partners_accompanying_details">

        <!-- Father Section -->
        <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">Father</h3>
        <table class="w-full table-auto border border-gray-300 text-sm mb-4">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Father’s Given Name</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_father_given_name }}
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Family Name</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_father_family_name }}
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Date of Birth</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.father_dob }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Father’s Place and Country of Birth</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.father_place_of_birth }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Mother Section -->
        <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">Mother</h3>
        <table class="w-full table-auto border border-gray-300 text-sm mb-4">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Mother’s Given Name</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_mother_given_name }}
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Family Name</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_mother_family_name }}
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Date of Birth</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.mother_dob }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Mother’s Place and Country of Birth</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_mother_place_of_birth
                    }}
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- UK Visa History Section -->
        <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">UK VISA HISTORY</h3>
        <table class="w-full table-auto border border-gray-300 text-sm mb-4">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Date Valid From</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_visa_valid_from }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Expiry Date</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_visa_expiry_date }}
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Visa Type (Business/Visit)</td>
                    <td class="p-2 capitalize">{{ props.student.spouse_partners_accompanying_details.spouse_visa_type }}
                    </td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Overseas Travel History</td>
                    <td class="p-2">{{ props.student.spouse_partners_accompanying_details.spouse_travel_history }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>