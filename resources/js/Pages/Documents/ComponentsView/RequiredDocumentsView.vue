<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { onMounted, watchEffect } from 'vue';

const props = defineProps({
    documents: Object
});

const formStore = useStudentStore();

onMounted(() => {
    formStore.setDocuments(props.documents);
});
watchEffect(() => {
    if (props.documents) {
        formStore.documents = props.documents;
    }
});

</script>

<template>
    <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">Uploaded Required Documents</h2>

    <div v-if="props.documents.required_documents && props.documents.required_documents.length">
        <table class="w-full table-auto text-left border border-gray-300 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">#</th>
                    <th class="p-2 border">Document Type</th>
                    <th class="p-2 border">File Name</th>
                    <th class="p-2 border">View File</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(doc, index) in props.documents.required_documents" :key="index" class="border-b">
                    <td class="p-2 border text-left">{{ index + 1 }}</td>
                    <td class="p-2 border">{{ doc.document_type }}</td>
                    <td class="p-2 border">{{ doc.file_name || doc.original_name }}</td>
                    <td class="p-2 border">
                        <template v-if="doc.file_path">
                            <a :href="`/storage/${doc.file_path}`" target="_blank"
                                class="text-blue-600 underline">View</a>
                        </template>
                        <template v-else>
                            <span class="text-gray-500 italic">Not Uploaded</span>
                        </template>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-else>
        <p class="text-sm text-gray-600">No documents uploaded yet.</p>
    </div>
</template>
