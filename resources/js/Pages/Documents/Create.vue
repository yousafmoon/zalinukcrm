<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import RequiredDocuments from '@/Pages/Documents/Components/RequiredDocuments.vue';
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { useToast } from "vue-toast-notification";
import { Inertia } from '@inertiajs/inertia';
import { onMounted, watch, watchEffect, ref } from 'vue';


const props = defineProps({
    studentId: {
        type: [String, Number],
        required: false,
    },
    documents: {
        type: Object,
        required: false
    },
    student: Object
});


const formStore = useStudentStore();
formStore.student = props.student;

const toast = useToast();

watch(() => formStore.documents.requiredDocuments, (newVal) => {
}, { immediate: true, deep: true });


onMounted(() => {
    const url = new URL(window.location.href);
    const studentIdFromUrl = url.searchParams.get('studentId');
    const previousStudentId = sessionStorage.getItem('cameFromEdit');

    if (!props.studentId && studentIdFromUrl) {
        formStore.student = { ...formStore.student, student_id: studentIdFromUrl };
    }

    if (previousStudentId && studentIdFromUrl && previousStudentId !== studentIdFromUrl) {
        sessionStorage.setItem('cameFromEdit', studentIdFromUrl);
        window.location.reload();
    } else {
        sessionStorage.setItem('cameFromEdit', studentIdFromUrl);
    }
});

watchEffect(() => {
    formStore.student = props.student;
});

const createDocuments = async () => {
    const studentId = formStore.student?.id || formStore.student?.student_id || props.studentId;
    if (!studentId) {
        toast.error("Student ID is missing. Please select a student.");
        return;
    }

    if (!studentId) {
        toast.error("Student ID is missing. Please select a student.");
        return;
    }

    const formData = new FormData();
    formData.append('student_id', studentId);

    formStore.documents.requiredDocuments.forEach((doc, index) => {
        formData.append(`requiredDocuments[${index}][document_type]`, doc.document_type || '');
        formData.append(`requiredDocuments[${index}][file_name]`, doc.file_name || doc.original_name || '');
        if (doc.file) {
            formData.append(`requiredDocuments[${index}][file]`, doc.file);
        }
    });

    Inertia.post(route('documents.store'), formData, {
        preserveScroll: true,
        preserveState: true,
        forceFormData: true,
        onSuccess: () => {
            toast.success("Document added successfully!");
        },
        onError: (error) => {
            console.error("Form submission error:", error);
            toast.error("Failed to add document.");
        },
    });
};


</script>

<template>

    <Head title="Create Student" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Documents
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="createDocuments" enctype="multipart/form-data">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6 relative">
                                <div class="flex justify-between">
                                    <h3 class="text-lg leading-6 font-medium text-red-700">
                                        Required Documents
                                    </h3>

                                    <div class="flex justify-between">
                                        <Link :href="route('documents.index')"
                                            class="mr-5 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                        Back
                                        </Link>
                                        <button type="submit"
                                            class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Save
                                        </button>
                                    </div>
                                </div>
                                <RequiredDocuments :documents="documents" :student="student" />

                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <Link :href="route('documents.index')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-4">
                                Cancel
                                </Link>
                                <button type="submit"
                                    class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
