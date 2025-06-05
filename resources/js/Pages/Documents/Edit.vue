<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { onMounted, computed, watch } from 'vue';
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { useToast } from 'vue-toast-notification';
import RequiredDocuments from '@/Pages/Documents/Components/RequiredDocuments.vue';

import { onBeforeMount } from 'vue';

const props = defineProps({
    documents: Object,
    documentsId: [String, Number],
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const toast = useToast();
const formStore = useStudentStore();
const page = usePage();

const computedStudentId = computed(() => page.props.value?.student_id || page.props.value?.query?.student_id);

const studentId = computed(() => page.props.value?.student_id || page.props.value?.query?.student_id);

onBeforeMount(() => {
    formStore.reset();
});

watch(computedStudentId, (newId) => {
    if (newId) {
        formStore.student.id = newId;
    }
}, { immediate: true });


watch(studentId, (newId) => {
    if (newId) {
        formStore.student.id = newId;
    }
}, { immediate: true });


onMounted(() => {
    if (props.documents) {
        const requiredDocuments = Array.isArray(props.documents.requiredDocuments)
            ? props.documents.requiredDocuments.map((doc) => ({
                document_type: doc.document_type || '',
                file_name: doc.file_name || doc.original_name || '',
                file: null,
                id: doc.id || null,
                file_path: doc.file_path || null,
                original_name: doc.original_name || '',
            }))
            : [];

        const resolvedStudentId = props.documents.student_id || computedStudentId.value || null;
        const resolvedDocumentId = props.documents.id || props.documentsId || null;

        formStore.setDocuments({
            ...props.documents,
            student_id: resolvedStudentId,
            id: resolvedDocumentId,
            requiredDocuments,
        });

    }
});

watch(
    () => formStore.documents.requiredDocuments,
    () => {
        if (!formStore.documents.student_id) {
            formStore.setDocuments({
                ...formStore.documents,
                student_id: computedStudentId.value || props.documents?.student_id || null,
            });
        }
    },
    { deep: true }
);

onMounted(() => {
    if (studentId.value) {
        formStore.student.id = studentId.value;
    }
});

const updateDocuments = async () => {
    const documentsId = formStore.documents?.id;
    const studentIdLocal = formStore.documents?.student_id || props.documents?.student_id || null;

    if (!documentsId) {
        toast.error("Documents ID is missing. Cannot update.");
        return;
    }
    if (!studentIdLocal) {
        toast.error("Student ID is missing. Cannot update.");
        return;
    }

    const formData = new FormData();

    formData.append('_method', 'PUT');

    console.log("Appending student_id:", studentIdLocal);
    formData.append('student_id', studentIdLocal);

    formStore.documents.requiredDocuments.forEach((doc, index) => {
        formData.append(`requiredDocuments[${index}][document_type]`, doc.document_type || '');
        if (doc.file) {
            formData.append(`requiredDocuments[${index}][file]`, doc.file);
        }
        if (doc.id) {
            formData.append(`requiredDocuments[${index}][id]`, doc.id);
        }
        if (doc.file_name) {
            formData.append(`requiredDocuments[${index}][file_name]`, doc.file_name);
        }
    });

    for (const pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
    }

    try {
        await router.post(route('documents.update', documentsId), formData, {
            preserveScroll: true,
            preserveState: true,
            forceFormData: true,
            onSuccess: () => {
                toast.success("Documents updated successfully.");
            },
            onError: (errors) => {
                toast.error("Failed to update documents.");
                console.error("Update error:", errors);
            },
        });
    } catch (error) {
        toast.error("Unexpected error while updating documents.");
        console.error("Update error:", error);
    }
};



</script>

<template>

    <Head title="Update documents" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Update Documents</h2>
        </template>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="updateDocuments" enctype="multipart/form-data">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6 relative">
                                <div class="flex justify-between">
                                    <h3 class="text-lg leading-6 font-medium text-red-700">
                                        MAIN APPLICANT’S DOCUMENTS INFORMATION
                                    </h3>
                                    <div class="flex justify-between gap-2">
                                        <Link :href="route('documents.index')"
                                            class="rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                        Back
                                        </Link>
                                        <button type="submit"
                                            class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Update
                                        </button>
                                    </div>
                                </div>

                                <RequiredDocuments :documents="formStore.documents" />
                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <Link :href="route('documents.index')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-4">
                                Cancel
                                </Link>
                                <button type="submit"
                                    class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
