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
    <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">FINANCIAL DETAILS</h2>

    <div v-if="props.student && props.student.financial_details">

        <table class="w-full table-auto border border-gray-300 text-sm mb-8">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Do you own any property?</td>
                    <td class="p-2">{{ props.student.financial_details.own_property }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Do you have any savings in the Bank?</td>
                    <td class="p-2">{{ props.student.financial_details.bank_savings }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Budget for yearly tuition fee?</td>
                    <td class="p-2">{{ props.student.financial_details.tuition_budget }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Bank funds (maintaining/going to maintain)?</td>
                    <td class="p-2">{{ props.student.financial_details.bank_funds }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Who is paying your tuition fee?</td>
                    <td class="p-2">{{ props.student.financial_details.tuition_payer }}</td>
                </tr>
            </tbody>
        </table>
    </div>


</template>
