<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import PersonalDetails from '@/Pages/Students/Components/PersonalDetails.vue';
import FinancialDetails from '@/Pages/Students/Components/FinancialDetails.vue';
import StudentEmployment from '@/Pages/Students/Components/StudentEmployment.vue';
import IncomeDetails from '@/Pages/Students/Components/IncomeDetails.vue';
import References from '@/Pages/Students/Components/References.vue';
import FinancialDocuments from '@/Pages/Students/Components/FinancialDocuments.vue';
import ParentsDetails from '@/Pages/Students/Components/ParentsDetails.vue';
import PassportDetails from '@/Pages/Students/Components/PassportDetails.vue';
import FirstPassportDetails from '@/Pages/Students/Components/FirstPassportDetails.vue';
import ContactDetails from '@/Pages/Students/Components/ContactDetails.vue';
import TravelDetails from '@/Pages/Students/Components/TravelDetails.vue';
import OtherInformationDetails from '@/Pages/Students/Components/OtherInformationDetails.vue';
import QualificationDetails from '@/Pages/Students/Components/QualificationDetails.vue';
import ImmigrationDetails from '@/Pages/Students/Components/ImmigrationDetails.vue';
import UkVisaHistoryDetails from '@/Pages/Students/Components/UkVisaHistoryDetails.vue';
import SpousePartnersNotAccompanyingDetails from '@/Pages/Students/Components/SpousePartnersNotAccompanyingDetails.vue';
import Children from '@/Pages/Students/Components/Children.vue';
import SpousePartnersAccompanyingDetails from '@/Pages/Students/Components/SpousePartnersAccompanyingDetails.vue';
import RequirementsForEuropeDetail from '@/Pages/Students/Components/RequirementsForEuropeDetail.vue';
import DocumentRequired from '@/Pages/Students/Components/DocumentRequired.vue';
import CheckCopyDetails from '@/Pages/Students/Components/CheckCopyDetails.vue';
import { ref, onMounted } from 'vue';
import { useStudentStore } from '@/Pages/Stores/studentStore';

const props = defineProps({
  student: Object,
});

const formStore = useStudentStore();

const createStudent = async () => {
formStore.addStudentForm();
}
</script>

<template>
        <Head title="Create Student" />

<AuthenticatedLayout>
    <template #header>
        <h2
            class="text-xl font-semibold leading-tight text-gray-800"
        >
           Create Student
        </h2>

    </template>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="createStudent();">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6 relative"> 
                                <div class="flex justify-between">
                                    <h3
                                        class="text-lg leading-6 font-medium text-red-700"
                                    >
                                    MAIN APPLICANT’S BIOGRAPHICAL INFORMATION
                                    </h3>
                               
                                    <div class="flex justify-between">
                                        <Link 
                                            :href="route('students.index')"
                                                class="mr-5 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                                             Back
                                        </Link>
                                        <button
                                    type="submit"
                                    class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                >
                                    Save
                                </button>
                                    </div>
                             
                               </div>
                             
                            <PersonalDetails :student="student"  />
                            <FinancialDetails :student="student"  />
                            <StudentEmployment :student="student"  />  
                            <IncomeDetails :student="student"  />
                            <References :student="student"  />
                            <FinancialDocuments  :student="student" />
                            <PassportDetails  :student="student" />
                            <FirstPassportDetails  :student="student" />
                            <ContactDetails  :student="student" />
                            <ParentsDetails  :student="student" />
                            <TravelDetails  :student="student" />
                            <OtherInformationDetails  :student="student" />
                            <QualificationDetails  :student="student" />
                            <ImmigrationDetails  :student="student" />
                            <UkVisaHistoryDetails  :student="student" />
                            <OverseasTravelHistoryDetails :student="student" />
                            <SpousePartnersNotAccompanyingDetails  :student="student" />
                            <Children :student="student" />
                            <SpousePartnersAccompanyingDetails  :student="student" />
                            <RequirementsForEuropeDetail  :student="student" />
                            <DocumentRequired  :student="student" />
                            <CheckCopyDetails  :student="student" />
                        

                            </div>
                            <div
                                class="px-4 py-3 bg-gray-50 text-right sm:px-6"
                            >
                                <Link
                                   :href="route('students.index')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 mr-4"
                                >
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="bg-red-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                >
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