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


    <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">INCOME AND EXPENDITURE</h2>


    <div v-if="props.student && props.student.income_details">

        <table class="w-full table-auto border border-gray-300 text-sm mb-8">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Total Monthly Income (After Tax)</td>
                    <td class="p-2">{{ props.student.income_details.monthly_income }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Income From Others (Parents/Family)</td>
                    <td class="p-2">{{ props.student.income_details.income_from_others }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Other Income Sources</td>
                    <td class="p-2">{{ props.student.income_details.other_income_sources }}</td>
                </tr>
                <tr class="border-b">
                    <td class="font-semibold p-2">Monthly Income Given to Family</td>
                    <td class="p-2">{{ props.student.income_details.monthly_income_given_to_family }}</td>
                </tr>
                <tr>
                    <td class="font-semibold p-2">Monthly Living Costs</td>
                    <td class="p-2">{{ props.student.income_details.monthly_living_costs }}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>