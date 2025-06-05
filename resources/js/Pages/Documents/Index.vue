<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import MagnifyingGlass from '@/Components/Icons/MagnifyingGlass.vue';
import Pagination from "@/Components/Pagination.vue";
import { computed, ref, watch, watchEffect } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { route } from 'ziggy-js';
import { useToast } from "vue-toast-notification";

const formStore = useStudentStore();

const props = defineProps({
    documents: { type: Object, required: true },
    student: { type: Object },
    totalDocuments: { type: Number },
});

let search = ref(usePage().props.search || '');
let pageNumber = ref(1);

const documentsUrl = computed(() => {
    let url = new URL(route("documents.index"));
    url.searchParams.set("page", pageNumber.value);
    if (search.value) {
        url.searchParams.set("search", search.value);
    }
    return url.toString();
});

watch(search, () => {
    pageNumber.value = 1;
    router.visit(documentsUrl.value, {
        preserveScroll: true,
        preserveState: true,
        replace: true,
    });
});



const pageNumberUpdated = (link) => {
    const params = new URL(link.url).searchParams;
    pageNumber.value = params.get("page") || 1;

    router.visit(documentsUrl.value, {
        preserveScroll: true,
        replace: true,
    });
};

const showModal = ref(false);
const documentIdToDelete = ref(null);

const confirmDocumentsDelete = (id) => {
    documentIdToDelete.value = id;
    showModal.value = true;
};

const handleDocDelete = async () => {
    const toast = useToast();
    try {
        await router.delete(route('documents.destroy', { document: documentIdToDelete.value }));
        toast.success("Document deleted successfully.");
        router.visit(route('documents.index'), { preserveScroll: true, replace: true });
    } catch (error) {
        toast.error("Failed to delete document.");
        console.error("Error deleting document:", error);
    }
    showModal.value = false;
};

const groupedDocuments = computed(() => {
    const groups = {};
    if (!props.documents?.data) return [];

    props.documents.data.forEach(doc => {
        if (!doc?.student?.id) return;
        const studentId = doc.student.id;
        if (!groups[studentId]) {
            groups[studentId] = {
                studentId,
                studentName: `${doc.student.firstname} ${doc.student.middlename ?? ''}`.trim(),
                documents: [],
                documentIds: []
            };
        }
        if (Array.isArray(doc.requiredDocuments)) {
            doc.requiredDocuments.forEach(reqDoc => {
                groups[studentId].documents.push({
                    ...reqDoc,
                    parentDocId: doc.id,
                    studentId: studentId
                });
            });
        }
        if (doc.id) {
            groups[studentId].documentIds.push(doc.id);
        }
    });
    return Object.values(groups);
});


watchEffect(() => {
    if (props.documents) {
        formStore.documents = props.documents;
    }
});
watch(search, () => {
    pageNumber.value = 1;
});
</script>

<template>

    <Head title="Documents" />
    <AuthenticatedLayout>
        <div class="bg-gray-100 py-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-semibold text-gray-900">
                            Student Documents List
                            <span class="font-semibold text-red-700">({{ totalDocuments }})</span>
                        </h1>
                        <p class="mt-2 text-sm text-gray-700">A list of all the Students Documents.</p>
                    </div>
                </div>

                <!-- Search -->
                <div class="flex flex-col justify-between mt-6">
                    <div class="relative text-md text-gray-800 col-span-4">
                        <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center text-gray-500">
                            <MagnifyingGlass />
                        </div>
                        <input v-model="search" type="text" placeholder="Search documents data..."
                            class="w-full block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-3 focus:ring-inset focus:ring-red-600" />
                    </div>
                </div>

                <!-- Table -->
                <div class="mt-8 flex flex-col">
                    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300" style="table-layout: fixed;">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="py-3.5 pl-4 text-left text-sm font-semibold text-gray-900"
                                                style="width: 20%;">Student Name</th>
                                            <th class="py-3.5 pl-4 text-left text-sm font-semibold text-gray-900"
                                                style="width: 15%;">ID</th>
                                            <th class="py-3.5 pl-4 text-left text-sm font-semibold text-gray-900"
                                                style="width: 20%;">Document Type</th>
                                            <th class="py-3.5 pl-4 text-left text-sm font-semibold text-gray-900"
                                                style="width: 20%;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="group in groupedDocuments" :key="group.studentId"
                                            class="bg-white border-b">
                                            <td class="py-4 pl-4 text-sm font-medium text-gray-900 align-top"
                                                style="width: 30%;">{{ group.studentName }}</td>
                                            <td colspan="4" class="p-0">
                                                <table class="w-full" style="table-layout: fixed;">
                                                    <tbody>
                                                        <tr v-for="doc in group.documents"
                                                            :key="doc.document_type + doc.parentDocId" class="border-t">
                                                            <td class="py-4 pl-4 text-sm font-medium text-gray-900"
                                                                style="width: 45%;">{{ doc.parentDocId }}</td>
                                                            <td class="py-4 pl-4 text-sm font-medium text-gray-900"
                                                                style="width: 50%;">{{ doc.document_type }}</td>
                                                            <td class="py-4 pl-4 text-sm font-medium text-gray-900"
                                                                style="width: 70%;">
                                                                <Link
                                                                    :href="route('documents.show', { id: doc.parentDocId })"
                                                                    class="ml-2 text-white bg-orange-600 rounded-sm px-2 py-1">
                                                                View</Link>
                                                                <Link
                                                                    :href="route('documents.edit', { id: doc.parentDocId })"
                                                                    class="ml-2 text-white bg-green-600 rounded-sm px-2 py-1">
                                                                Edit</Link>
                                                                <button @click="confirmDocumentsDelete(doc.parentDocId)"
                                                                    class="ml-2 text-white bg-red-600 rounded-sm px-2 py-1">Delete</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :data="documents" baseRoute="/documents"
                                :pageNumberUpdated="pageNumberUpdated" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <Modal :show="showModal" title="Confirm Deletion"
        message="Are you sure you want to delete this document? This action cannot be undone."
        confirmButtonText="Yes, Delete" @confirm="handleDocDelete" @close="showModal = false" />
</template>
