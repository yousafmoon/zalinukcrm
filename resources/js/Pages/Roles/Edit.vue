<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

defineProps({
        roles: {
        type: Object,
        required: true
        }
    })

let role = usePage().props.role.data;

const form = useForm({
   name: role.name,
   permissions: role.permissions.map(permission => permission.id), 

})
const updateRole = () => {
    form.put(route('roles.update', role.id)); 
}
</script>
<template>
        <Head title="Update Role" />

<AuthenticatedLayout>
    <template #header>
        <h2
            class="text-xl font-semibold leading-tight text-gray-800"
        >
           Update Role
        </h2>
    </template>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="updateRole();">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6 relative">
                                <Link 
                                    :href="route('roles.index')"
                                    class="absolute right-10 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="button">
                                    Back
                                 </Link>
                                <div>
                                    <h3
                                        class="text-lg leading-6 font-medium text-gray-900"
                                    >
                                        Role Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new role.
                                    </p>
                                </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-700"
                                            >Name</label
                                        >
                                        <input
                                        v-model="form.name"
                                            type="text"
                                            id="name"
                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                                            :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 @enderror':form.errors.name}"
                                            />
                                        <InputError :message="form.errors.name" class="mt-2" />
                                    </div>

                                    
                                </div>

                                <div class="col-span-6 sm:col-span-3 flex w-full flex-wrap">
                                     <div v-for="permission in $page.props.permissions" :key="permission.id" class="mt-2">
                                    <label class="inline-flex items-center mr-4 w-full">
                                        <input
                                            type="checkbox"
                                            :value="permission.id"
                                            v-model="form.permissions"
                                            :checked="permission.checked"
                                            class="mt-3 rounded text-sm"
                                            :class="{'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300 @enderror':form.errors.updated_at}"
                                            />
                                            <span class="ml-2 mt-3">{{ permission.name }}</span>
                                        </label>
     
                                    </div>     
                                </div>
                            </div>
                            <div
                                class="px-4 py-3 bg-gray-50 text-right sm:px-6"
                            >
                                <Link
                                    :href="route('roles.index')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-4"
                                >
                                    Cancel
                                 </Link>
                                <button
                                    type="submit"
                                    class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                >
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