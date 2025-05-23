<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';

import MagnifyingGlass from '@/Components/Icons/MagnifyingGlass.vue';
import Pagination from "@/Components/Pagination.vue";
import { computed, ref, watch } from 'vue';
import Modal from '@/Components/Modal.vue';

    
defineProps({
    permissions: {
    type: Object,
    required: true
    }
})
let search = ref(usePage().props.search), 
    pageNumber = ref(1); 

let permissionsUrl = computed(()=>{
let url = new URL(route("permissions.index"));
url.searchParams.set("page", pageNumber.value);

if(search.value) {
    url.searchParams.set("search", search.value);
}

return url.toString();
});

watch (
    () => permissionsUrl.value,
        (updatedPermissionsUrl) => {
        router.visit(updatedPermissionsUrl, {
           preserveScroll: true,
           preserveState: true,
           replace: true 
        });
    }
)

watch (
    () => search.value,
      (value) => {
        if(value) {
            pageNumber.value = 1
        }
      }
)

const pageNumberUpdated = (link) => {
    const params = new URL(link.url).searchParams;
    pageNumber.value = params.get("page") || 1;

    router.visit(permissionsUrl.value, {
        preserveScroll: true,
        replace: true,
    });
};



let showModal = ref(false);
let permissionIdToDelete = ref(null);

function handleDelete() {
    showModal.value = false; 
    try {
        router.delete(route('permissions.destroy', permissionIdToDelete.value), {
            onSuccess: () => {
                router.visit(route('permissions.index'), {
                    preserveScroll: true,
                    replace: true,
                });
            },
            onError: (error) => {
                console.error("Error deleting permission:", error);
            },
        });
    } catch (error) {
        console.error("Error deleting permission:", error);
    }
}



const confirmDelete = (permissionId) => {
    permissionIdToDelete.value = permissionId;
    showModal.value = true;
}; 

</script>

<template>
    <Head title="Permissions" />
    <AuthenticatedLayout>
        <div class="bg-gray-100 py-10">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-xl font-semibold text-gray-900">
                                Permissions List
                            </h1>
                            <p class="mt-2 text-sm text-gray-700">
                                A list of all the Permissions.
                            </p>
                        </div>

                        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                            <a
                                :href="route('permissions.create')"
                                class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:w-auto"
                            >
                                Add Permission
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between mt-6">
                        <div class="relative text-md text-gray-800 col-span-4">
                            <div
                                class="absolute pl-2 left-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500"
                            >
                                <MagnifyingGlass />
                            </div>

                            <input
                            v-model="search"
                                type="text"
                                autocomplete="off"
                                placeholder="Search permissions data..."
                                id="search"
                                class="w-full block rounded-lg border-0 py-2 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-3 focus:ring-inset focus:ring-red-600 md:text-sm md:leading-6"
                            />
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col">
                        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"
                            >
                                <div
                                    class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative"
                                >
                                    <table
                                        class="min-w-full divide-y divide-gray-300"
                                    >
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                >
                                                    ID
                                                </th>
                                                <th
                                                    scope="col"
                                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                                                >
                                                    Name
                                                </th>

                                              
                                            
                                                <th
                                                    scope="col"
                                                    class="relative py-3.5 pl-3 pr-4 sm:pr-6"
                                                />
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-gray-200 bg-white"
                                        >
                                            <tr v-for="permission in permissions.data" :key="permission.id">
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                >
                                                    {{ permission.id }}
                                                </td>
                                                <td
                                                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                                                >
                                                    {{permission.name}}
                                                </td>
                                                
                                            
                                                <td
                                                    class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                                                >
                                                    <Link
                                                        :href="route('permissions.edit', permission.id)"
                                                        class="ml-2 leading-tight sm:text-white hover:text-white bg-green-600 rounded-sm px-2 py-1"
                                                    >
                                                        Edit
                                                    </Link>
                                                    <button
                                                    @click="confirmDelete(permission.id)"
                                                        class="ml-2 leading-tight sm:text-white hover:text-white bg-red-600 rounded-sm px-2 py-1"
                                                    >
                                                        Delete
                                                    </button>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div><Pagination  :data="permissions" baseRoute="/permissions"
                                    :pageNumberUpdated="pageNumberUpdated" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <Modal
        :show="showModal"
        title="Confirm Deletion"
        message="Are you sure you want to delete this permission? This action cannot be undone."
        confirmButtonText="Yes, Delete"
        cancelButtonText="No, Cancel"
        :actionData="{ id: permissionIdToDelete }"
        @close="showModal = false"
        @confirm="handleDelete"
    />

</template>