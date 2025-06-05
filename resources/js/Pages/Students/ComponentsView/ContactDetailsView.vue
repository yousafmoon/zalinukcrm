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

    <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
        MAIN APPLICANT’S CONTACT DETAILS IN COUNTRY OF APPLICATION:
    </h3>

    <div v-if="props.student && props.student.contact_details">

        <table class="w-full table-auto border border-gray-300 text-sm">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Address</td>
                    <td class="p-2 whitespace-pre-line">{{ props.student.contact_details.address }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Postal/Zip Code</td>
                    <td class="p-2">{{ props.student.contact_details.postal_code }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">How Long Have You Lived at This Address?</td>
                    <td class="p-2">{{ props.student.contact_details.how_long_lived }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Home (Landline) Number</td>
                    <td class="p-2">{{ props.student.contact_details.home_number }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Mobile Number</td>
                    <td class="p-2">{{ props.student.contact_details.mobile_number }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Email Address</td>
                    <td class="p-2">{{ props.student.contact_details.email_address }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Will this be your contact details during the application process?</td>
                    <td class="p-2">{{ props.student.contact_details.contact_during_application }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Main address and contact details of where you will be staying whilst
                        in
                        the UK</td>
                    <td class="p-2 whitespace-pre-line">{{ props.student.contact_details.main_address_uk }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Ownership status of your home</td>
                    <td class="p-2">{{ props.student.contact_details.ownership_status }}</td>
                </tr>
            </tbody>
        </table>


    </div>

</template>