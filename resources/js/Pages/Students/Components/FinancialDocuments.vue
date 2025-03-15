<script setup>
import { ref } from 'vue';
import { useStudentStore } from '@/stores/useStudentStore';

const formStore = useStudentStore();
const newDocumentName = ref('');

</script>

<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            FINANCIAL DOCUMENTS
        </h3>
    </div>

    <!-- Input for adding a new document -->
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-9">
            <label class="block text-sm font-medium text-gray-700">Document Label</label>
            <input type="text" v-model="newDocumentName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" placeholder="Enter document name">
        </div>
        <div class="col-span-3 flex items-end">
            <button @click="formStore.addFinancialDocument(newDocumentName); newDocumentName=''" class="px-3 py-2 bg-green-500 text-white rounded-md shadow-sm hover:bg-green-600">
                +
            </button>
        </div>
    </div>

    <!-- Loop to display document upload fields -->
    <div v-for="(doc, index) in formStore.documents" :key="index" class="grid grid-cols-12 gap-6 mt-3">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label class="block text-sm font-medium text-gray-700">{{ doc.name }}</label>
            <input @change="formStore.handleDocumentFileChange($event, index)" type="file" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
        <div class="col-span-2 flex items-end">
            <button @click="formStore.removeFinancialDocument(index)" class="px-3 py-2 bg-red-500 text-white rounded-md shadow-sm hover:bg-red-600">
                -
            </button>
        </div>
    </div>
</template>
