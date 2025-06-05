<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { onMounted } from 'vue';

const props = defineProps({
    documents: Object,
    require: Boolean,
    studentId: [String, Number],
});

const formStore = useStudentStore();

const addDocuments = () => {
    formStore.addrequiredDocuments();
};

const removeDocuments = (index) => {
    formStore.removerequiredDocuments(index);
};

onMounted(() => {
    formStore.setDocuments(props.documents);
});


const handleFileChange = (event, index) => {
    const file = event.target.files[0];
    if (!file) return;

    const doc = formStore.documents.requiredDocuments[index];
    formStore.documents.requiredDocuments[index] = {
        ...doc,
        file: file,
        file_name: file.name,
        original_name: file.name,
        file_path: null,
    };
};
</script>

<template>
    <div class="relative">
        <h3 class="text-lg leading-6 font-medium text-red-700">
            <span class="text-sm text-gray-600">
                Please upload CNIC,Photos,Passport,Resume,Police Clearance Certificate,English Proficiency
                Certificate,IELTS,
                Matric Transcript,Matric Certificate,Inter Transcript,Inter Certificate,Bachelor Transcript,Bachelor’s
                Degree,
                Experience Certificates,Any Other Certification,Two Recommendation Letters,Professional Experience
                Letter,
                Motivational Letter,Bank Statement,Past 3 Years Tax Returns
            </span>
        </h3>
    </div>

    <div v-for="(doc, index) in formStore.documents.requiredDocuments" :key="index"
        class="relative p-4 border rounded-lg shadow-md mt-4 bg-gray-50">

        <div class="absolute top-1 right-1 flex space-x-2">
            <button @click="addDocuments()" type="button" class="bg-red-500 text-white px-3 py-1 rounded-md">+</button>
            <button @click="removeDocuments(index)" v-if="formStore.documents.requiredDocuments.length > 1"
                type="button" class="bg-red-500 text-white px-3 py-1 rounded-md">–</button>
        </div>

        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700">Document Type</label>
            <select v-model="doc.document_type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3
        focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option disabled value="">-- Select Document Type --</option>
                <option>CNIC</option>
                <option>Photos</option>
                <option>Passport</option>
                <option>Resume</option>
                <option>Police Clearance Certificate</option>
                <option>English Proficiency Certificate</option>
                <option>IELTS</option>
                <option>Matric Transcript</option>
                <option>Matric Certificate</option>
                <option>Inter Transcript</option>
                <option>Inter Certificate</option>
                <option>Bachelor Transcript</option>
                <option>Bachelor’s Degree</option>
                <option>Experience Certificates</option>
                <option>Any Other Certification</option>
                <option>Two Recommendation Letters</option>
                <option>Professional Experience Letter</option>
                <option>Motivational Letter</option>
                <option>Bank Statement</option>
                <option>Past 3 Years Tax Returns</option>
            </select>
        </div>

        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700">Document Name</label>
            <input type="text" v-model="doc.file_name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3
        focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Auto-filled after upload or edit manually" />
        </div>

        <div v-if="doc.file_path" class="mt-3 flex items-center space-x-2">
            <label class="text-sm font-medium text-gray-700 whitespace-nowrap">Uploaded File:</label>
            <a :href="`/storage/${doc.file_path}`" target="_blank" class="text-red-600 underline break-words">
                {{ doc.original_name || doc.file_name || 'View File' }}
            </a>
        </div>


        <div class="mt-3">
            <label class="block text-sm font-medium text-gray-700">Upload File</label>
            <input type="file" @change="handleFileChange($event, index)" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3
        focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
    </div>
</template>
