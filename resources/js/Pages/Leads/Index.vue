<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import MagnifyingGlass from '@/Components/Icons/MagnifyingGlass.vue';
import Pagination from "@/Components/Pagination.vue";
import { computed, ref, watch, watchEffect } from 'vue';
import Modal from '@/Components/Modal.vue';
import { useStudentStore } from '@/Pages/Stores/studentStore';

const formStore = useStudentStore();

const props = defineProps({
    lead: {
        type: Object,
        required: true,
    },
    totalLeads: {
        type: Number,
        required: false,
    },
});


let search = ref(usePage().props.search),
    pageNumber = ref(1);

let leadsUrl = computed(() => {
    let url = new URL(route("leads.index"));
    url.searchParams.set("page", pageNumber.value);

    if (search.value) {
        url.searchParams.set("search", search.value);
    }

    return url.toString();
});

watch(() => leadsUrl.value, (updatedLeadsUrl) => {
    router.visit(updatedLeadsUrl, {
        preserveScroll: true,
        preserveState: true,
        replace: true
    });
});

watch(() => search.value, (value) => {
    if (value) {
        pageNumber.value = 1;
    }
});

watch(() => formStore.lead, (newLeads) => {
    leads.value = newLeads;
});


const pageNumberUpdated = (link) => {
    const params = new URL(link.url).searchParams;
    pageNumber.value = params.get("page") || 1;

    router.visit(leadsUrl.value, {
        preserveScroll: true,
        replace: true,
    });
};

const showModal = ref(false);
const leadIdToDelete = ref(null);

const confirmDelete = (leadId) => {
    leadIdToDelete.value = leadId;
    showModal.value = true;
};

const handleDelete = () => {
    if (leadIdToDelete.value) {
        formStore.handleDelete(leadIdToDelete.value);
    }
    showModal.value = false;
};

const goToEdit = (id) => {
    window.location.href = route('leads.edit', id);
};

watchEffect(() => {
    if (props.lead) {
        formStore.lead = props.lead;
    }
});

</script>

<template>

    <Head title="Leads" />
    <AuthenticatedLayout>
        <div class="bg-gray-100 py-10">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Leads List <span class="font-semibold text-red-700">({{ totalLeads }})</span>
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">A list of all the Leads.</p>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a :href="route('students.create')"
                                class="inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                                Add Lead
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col justify-between mt-6">
                        <div class="relative text-md text-gray-800 col-span-4">
                            <div class="absolute pl-2 left-0 top-0 bottom-0 flex items-center text-gray-500">
                                <MagnifyingGlass />
                            </div>
                            <input v-model="search" type="text" placeholder="Search students data..."
                                class="w-full block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-3 focus:ring-inset focus:ring-red-600" />
                        </div>
                    </div>
                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-300">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    ID]</th>
                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Full Name</th>
                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Email</th>

                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Phone</th>

                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Preffered Country</th>

                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Course</th>


                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Source</th>

                                                <th
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">
                                                    Status</th>

                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="lead in leads.data" :key="lead.id">
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900">{{
                                                    lead.id }}</td>
                                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900">{{
                                                    lead.full_name }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500">{{ lead.email }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500">{{ lead.phone }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500">{{ lead.preffered_country }}
                                                </td>
                                                <td class="px-3 py-4 text-sm text-gray-500">{{ lead.course }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500">{{ lead.source }}</td>
                                                <td class="px-3 py-4 text-sm text-gray-500">{{ lead.status }}</td>
                                                <td class="py-4 pl-3 pr-4 text-right text-sm font-medium">
                                                    <Link :href="route('leads.show', lead.id)"
                                                        class="ml-2 text-white bg-orange-600 rounded-sm px-2 py-1">View
                                                    Details
                                                    </Link>
                                                    <button @click="goToEdit(lead.id)"
                                                        class="ml-2 text-white bg-green-600 rounded-sm px-2 py-1">
                                                        Edit
                                                    </button>
                                                    <button @click="confirmDelete(lead.id)"
                                                        class="ml-2 text-white bg-red-600 rounded-sm px-2 py-1">Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <Pagination :data="leads" baseRoute="/leads" :pageNumberUpdated="pageNumberUpdated" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <Modal :show="showModal" title="Confirm Deletion"
        message="Are you sure you want to delete this student? This action cannot be undone."
        confirmButtonText="Yes, Delete" @confirm="handleDelete" @close="showModal = false" />
</template>
