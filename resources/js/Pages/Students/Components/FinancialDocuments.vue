<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

const addFinancial = () => {
    formStore.addFinancialDocument();
};

const removeFinancial = (index) => {
    formStore.removeFinancialDocument(index);
};

</script>

<template>
    <div class="relative">
        <h3 class="text-lg leading-6 font-medium text-red-700">
            FINANCIAL DOCUMENTS <br>
            <span class="text-sm text-gray-600">(Please upload payslips, bank statement,letter from previous employer
                and
                official taxdocuments)</span>
        </h3>
    </div>

    <!-- Loop through the financial documents -->
    <div v-for="(doc, index) in formStore.student.FinancialDocuments" :key="index"
        class="relative p-4 border rounded-lg shadow-md mt-4 bg-gray-50">

        <!-- + / - buttons on the top-right -->
        <div class="absolute top-1 right-1 flex space-x-2">
            <button @click="addFinancial()" type="button" class="bg-red-500 text-white px-3 py-1 rounded-md">+</button>
            <button @click="removeFinancial(index)" type="button" v-if="formStore.student.FinancialDocuments.length > 1"
                class="bg-red-500 text-white px-3 py-1 rounded-md">-</button>
        </div>

        <!-- Document Title Input -->
        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700">Document Title</label>
            <input type="text" v-model="doc.document_title"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter document title">
        </div>

        <!-- File Upload Input -->
        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700">Upload File</label>
            <input type="file" @change="formStore.handleFileChange($event, index)"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
        </div>

        <!-- Display uploaded file name -->
        <div v-if="doc.document_name" class="mt-2 text-sm text-gray-600">
            <strong>Selected File:</strong> {{ doc.document_name }}
        </div>
    </div>
</template>
