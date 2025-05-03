<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import InputError from '@/Components/InputError.vue';
import { watch } from 'vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();

watch(() => props.student, (newStudent) => {
    if (newStudent) {
        const studentWithDefaults = {
            ...newStudent,
            financialDetails: {
                ...(newStudent.financialDetails || {}),
                errors: newStudent.financialDetails?.errors || {}
            }
        };
        formStore.setStudent(studentWithDefaults);
    }
}, { immediate: true, deep: true });
</script>
<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            FINANCIAL DETAILS</h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-6 md:col-span-4">
            <label for="own_property" class="block text-sm font-medium text-gray-700">
                Do you own any property?
            </label>
            <select id="own_property" v-model="formStore.student.financialDetails.own_property"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.financialDetails.errors.own_property }">
                <option value="">Select an option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <InputError :message="formStore.student.financialDetails.errors.own_property" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6 md:col-span-4">
            <label for="bank_savings" class="block text-sm font-medium text-gray-700">
                Do you have any savings in the Bank?
            </label>
            <select id="bank_savings" v-model="formStore.student.financialDetails.bank_savings"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.financialDetails.errors.bank_savings }">
                <option value="">Select an option</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            <InputError :message="formStore.student.financialDetails.errors.bank_savings" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6 md:col-span-4">
            <label for="tuition_budget" class="block text-sm font-medium text-gray-700">
                Budget for yearly tuition fee? (€)
            </label>
            <input type="number" id="tuition_budget" v-model="formStore.student.financialDetails.tuition_budget"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter amount in USD"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.financialDetails.errors.tuition_budget }" />
            <InputError :message="formStore.student.financialDetails.errors.tuition_budget" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6 md:col-span-4">
            <label for="bank_funds" class="block text-sm font-medium text-gray-700">
                Bank funds (maintaining/going to maintain)?
            </label>
            <input type="text" id="bank_funds" v-model="formStore.student.financialDetails.bank_funds"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter bank funds details"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.financialDetails.errors.bank_funds }" />
            <InputError :message="formStore.student.financialDetails.errors.bank_funds" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6 md:col-span-4">
            <label for="tuition_payer" class="block text-sm font-medium text-gray-700">
                Who is paying your tuition fee?
            </label>
            <select id="tuition_payer" v-model="formStore.student.financialDetails.tuition_payer"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.financialDetails.errors.tuition_payer }">
                <option value="">Select an option</option>
                <option value="self">Self</option>
                <option value="parents">Parents</option>
                <option value="sibling">Sibling</option>
                <option value="other">Other</option>
            </select>
            <InputError :message="formStore.student.financialDetails.errors.tuition_payer" class="mt-2" />
        </div>



    </div>
</template>