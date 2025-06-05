<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';

import { watchEffect } from 'vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();
watchEffect(() => {
    formStore.student = props.student;
});

</script>
<template>
    <div>
        <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
            FAMILY NOT ACCOMPANYING
        </h3>



        <div v-if="props.student && props.student.family_not_accompanying_details">

            <table class="w-full table-auto border border-gray-300 text-sm mb-4">
                <tbody>
                    <tr class="border-b">
                        <td class="font-semibold p-2 w-1/2">Spouse / Partner’s Given Name</td>
                        <td class="p-2">{{ props.student.family_not_accompanying_details.spouse_given_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Spouse / Partner’s Family Name</td>
                        <td class="p-2">{{ props.student.family_not_accompanying_details.spouse_family_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Spouse Passport Number (if held)</td>
                        <td class="p-2">{{ props.student.family_not_accompanying_details.spouse_passport_number }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Where is your spouse / partner now</td>
                        <td class="p-2">{{ props.student.family_not_accompanying_details.spouse_location }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Spouse / Partner’s Date of Birth</td>
                        <td class="p-2">{{ props.student.family_not_accompanying_details.spouse_dob }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Spouse’s Nationality</td>
                        <td class="p-2">{{ props.student.family_not_accompanying_details.spouse_nationality }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold p-2">Will your spouse / partner accompany you to the UK?</td>
                        <td class="p-2">{{ props.student.family_not_accompanying_details.spouse_accompanying_uk }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>