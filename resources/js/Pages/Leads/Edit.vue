<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { onMounted, watch, ref } from 'vue';
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { useToast } from 'vue-toast-notification';

import LeadView from '@/Pages/Students/Components/LeadView.vue';

const props = defineProps({
    lead: Object,
    errors: {
        type: Object,
        default: () => ({})
    }
});

const toast = useToast();
const formStore = useStudentStore();
const lead = ref({ ...props.lead });

onMounted(() => {
    if (props.lead) {
        formStore.setStudent(props.lead);
    }
});

watch(() => props.lead, (newStudent) => {
    if (newStudent) {
        lead.value = { ...newStudent };
        formStore.setStudent(newStudent);
    }
}, { deep: true });


const updateStudent = async () => {
    if (!formStore.lead || !formStore.lead.id) {
        toast.error("Student data is missing.");
        return;
    }

    try {
        await router.put(route('leads.update', formStore.lead.id), formStore.lead, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                toast.success("Student updated successfully.");
            },
            onError: (errors) => {
                toast.error("Failed to update lead. Please check the form.");
                console.error(errors);
                const firstErrorField = document.querySelector(".error");
                if (firstErrorField) {
                    firstErrorField.scrollIntoView({ behavior: "smooth", block: "center" });
                }
            }
        });
    } catch (error) {
        toast.error("Unexpected error while updating lead.");
        console.error("Update error:", error);
    }
};

</script>


<template>

    <Head title="Update Student" />

    <AuthenticatedLayout :key="$page.url">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Update Student
            </h2>

        </template>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="updateStudent" enctype="multipart/form-data">
                        <div class=" shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6 relative">
                                <div class="flex justify-between">
                                    <h3 class="text-lg leading-6 font-medium text-red-700">
                                        MAIN APPLICANT’S BIOGRAPHICAL INFORMATION
                                    </h3>

                                    <div class="flex justify-between">
                                        <Link :href="route('leads.index')"
                                            class="mr-5 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="button">
                                        Back
                                        </Link>
                                        <button type="submit"
                                            class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Update
                                        </button>
                                    </div>

                                </div>

                                <LeadView :lead="lead" />

                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <Link :href="route('leads.index')"
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