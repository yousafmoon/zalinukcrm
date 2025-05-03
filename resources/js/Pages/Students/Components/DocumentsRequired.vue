<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { ref, watch } from 'vue';

const props = defineProps({
  student: Object
});

const formStore = useStudentStore();

const documents = ref([{ file_title: '', file_name: '', file_path: null }]);

// Watch for changes and update the store
watch(documents, (newDocuments) => {
  formStore.documents = newDocuments;
}, { deep: true });

const handleFileChange = (event, index) => {
  const file = event.target.files[0];
  if (file) {
    documents.value[index].file_name = file.name;
    documents.value[index].file_path = URL.createObjectURL(file);
  }
};

const addDocument = () => {
  documents.value.push({ file_title: '', file_name: '', file_path: null });
};

const removeDocument = (index) => {
  if (documents.value.length > 1) {
    documents.value.splice(index, 1);
  }
};
</script>

<template>
  <div class="col-span-1 sm:col-span-2">
    <h3 class="text-lg font-medium text-red-700">Documents Required</h3>
  </div>

  <div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
      <h4 class="text-md font-medium text-gray-900">Please Upload CNIC,Photos,Passport,Resume,Police Clearance
        Certificate,English Proficiency Certificate,IELTS,Matric Transcript,Matric Certificate,Inter Transcript,Inter
        Certificate,Bachelor Transcript,Bachelor’s Degree,Experience Certificates,Any Other Certification,Two
        Recommendation Letters,Professional Experience Letter,Motivational Letter,Bank Statement,Past 3 Years Tax
        Returns</h4>

      <div v-for="(document, index) in documents" :key="index" class="border p-4 rounded-md mt-2">
        <div class="flex justify-between items-center mb-2 relative">
          <h3>Add Document - {{ index + 1 }}</h3>
          <div class="absolute top-1 right-1 flex space-x-2">
            <button type="button" @click="addDocument()" class="bg-red-500 text-white px-3 py-1 rounded-md">+
            </button>
            <button type="button" @click="removeDocument(index)" class="bg-red-500 text-white px-3 py-1 rounded-md"
              v-if="documents.length > 1">-
            </button>
          </div>
        </div>

        <div class="grid grid-cols-12 gap-4">
          <!-- Document Title -->
          <div class="col-span-12 sm:col-span-6">
            <label :for="'document_title_' + index" class="block text-sm font-medium text-gray-800">Document
              Title</label>
            <input v-model="document.file_title" :id="'document_title_' + index" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 
                     focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
              placeholder="Enter document title" />
          </div>

          <!-- File Upload -->
          <div class="col-span-12 sm:col-span-6">
            <label :for="'file_upload_' + index" class="block text-sm font-medium text-gray-800">Choose File</label>
            <div class="relative mt-1">
              <label :for="'file_upload_' + index"
                class="inline-block w-full bg-gray-900 text-white text-center py-2 px-3 rounded-md cursor-pointer hover:bg-red-600">
                Browse File
              </label>
              <input type="file" :id="'file_upload_' + index" @change="handleFileChange($event, index)"
                class="hidden" />
            </div>
            <span v-if="document.file_name" class="block text-sm text-gray-600 mt-1">
              Selected File: {{ document.file_name }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
