<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';


const props = defineProps({
    student: Object
});
const formStore = useStudentStore();


</script>
<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            INCOME AND EXPENDITURE</h3>
    </div>

    <div class="grid grid-cols-12 gap-6">

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="monthly_income" class="block text-sm font-medium text-gray-700">Total Monthly Income (After
                Tax)</label>
            <input v-model="formStore.student.incomeDetails.monthly_income" type="number" id="monthly_income"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter monthly income" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="income_from_others" class="block text-sm font-medium text-gray-700">Income From Others
                (Parents/Family)</label>
            <select v-model="formStore.student.incomeDetails.income_from_others" id="income_from_others"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Select an option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="other_income_sources" class="block text-sm font-medium text-gray-700">Other Income
                Sources</label>
            <select v-model="formStore.student.incomeDetails.other_income_sources" id="other_income_sources"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Select an option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="monthly_income_given_to_family" class="block text-sm font-medium text-gray-700">Monthly Income
                Given to Family</label>
            <input v-model="formStore.student.incomeDetails.monthly_income_given_to_family" type="number"
                id="monthly_income_given_to_family"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter amount" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="monthly_living_costs" class="block text-sm font-medium text-gray-700">Monthly Living
                Costs</label>
            <input v-model="formStore.student.incomeDetails.monthly_living_costs" type="number"
                id="monthly_living_costs"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter living costs" />
        </div>
    </div>
</template>