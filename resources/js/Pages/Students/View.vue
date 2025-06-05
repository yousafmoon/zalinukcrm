<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, Head, router } from '@inertiajs/vue3';
import html2pdf from 'html2pdf.js';

import { useStudentStore } from '@/Pages/Stores/studentStore';
import PersonalDetailsView from '@/Pages/Students/ComponentsView/PersonalDetailsView.vue';
import FinancialDetailsView from '@/Pages/Students/ComponentsView/FinancialDetailsView.vue';
import StudentEmploymentView from '@/Pages/Students/ComponentsView/StudentEmploymentView.vue';
import IncomeDetailsView from '@/Pages/Students/ComponentsView/IncomeDetailsView.vue';
import StudentReferencesView from '@/Pages/Students/ComponentsView/StudentReferencesView.vue';
import ParentsDetailsView from '@/Pages/Students/ComponentsView/ParentsDetailsView.vue';
import PassportDetailsView from '@/Pages/Students/ComponentsView/PassportDetailsView.vue';
import FirstPassportDetailsView from '@/Pages/Students/ComponentsView/FirstPassportDetailsView.vue';
import ContactDetailsView from '@/Pages/Students/ComponentsView/ContactDetailsView.vue';
import TravelDetailsView from '@/Pages/Students/ComponentsView/TravelDetailsView.vue';
import OtherInformationDetailsView from '@/Pages/Students/ComponentsView/OtherInformationDetailsView.vue';
import QualificationsDetailsView from '@/Pages/Students/ComponentsView/QualificationsDetailsView.vue';
import ImmigrationDetailsView from '@/Pages/Students/ComponentsView/ImmigrationDetailsView.vue';
import UkVisaHistoryDetailsView from '@/Pages/Students/ComponentsView/UkVisaHistoryDetailsView.vue';
import OverseasTravelHistoryDetailsView from '@/Pages/Students/ComponentsView/OverseasTravelHistoryDetailsView.vue';
import SpousePartnersAccompanyingDetailsView from '@/Pages/Students/ComponentsView/SpousePartnersAccompanyingDetailsView.vue';
import RequirementsForEuropeDetailsView from '@/Pages/Students/ComponentsView/RequirementsForEuropeDetailsView.vue';
import ChildrenDetailsView from '@/Pages/Students/ComponentsView/ChildrenDetailsView.vue';
import FamilyNotAccompanyingDetailsView from '@/Pages/Students/ComponentsView/FamilyNotAccompanyingDetailsView.vue';
import { Inertia } from '@inertiajs/inertia';
import { watchEffect } from 'vue';


const props = defineProps({
  student: Object,
  studentId: Number,
});

const formStore = useStudentStore();
watchEffect(() => {
  formStore.student = props.student;
});


const navigateToStudentsIndex = () => {
  router.visit(route('students.index'), {
    preserveScroll: true,
    preserveState: false,
    replace: true,
  });
};


const generatePDF = () => {
  const printContent = document.getElementById('student-details');
  const filename = `${props.student.firstname}_${props.student.middlename}_${props.student.surname}.pdf`;

  const options = {
    margin: 10,
    filename: filename,
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 4 },
    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
  };

  html2pdf().from(printContent).set(options).save();
};

const goToDocumentsCreate = () => {
  const studentId = props.student.id;
  sessionStorage.setItem('cameFromEdit', studentId);
  Inertia.get(route('documents.create', { studentId }));
};


</script>

<template>

  <Head title="View Student" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        View Student
      </h2>
    </template>

    <div class="bg-gray-100 py-10">
      <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <div class="flex justify-between sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900 flex items-center">
                View Student Details
                <div v-if="student" class="ml-2 text-red-700">
                  ({{ student.firstname }} {{ student.middlename }} {{ student.surname }})
                </div>
              </h1>
              <div class="space-x-1">
                <PrimaryButton @click="goToDocumentsCreate"
                  class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                  Add document
                </PrimaryButton>



                <PrimaryButton @click="navigateToStudentsIndex"
                  class="middle none center mr-4 rounded-sm focus:bg-green-500 bg-green-500 hover:bg-green-600 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-green-500/40 disabled:pointer-events-none"
                  data-ripple-light="true">
                  Back to Students
                </PrimaryButton>
                <PrimaryButton @click="generatePDF"
                  class="middle none center rounded-sm bg-orange-500 focus:bg-orange-500 hover:bg-orange-600 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-orange-500/20 transition-all hover:shadow-orange-500/40 disabled:pointer-events-none"
                  data-ripple-light="true">
                  Download PDF
                </PrimaryButton>
              </div>
            </div>
          </div>




          <div id="student-details" v-if="props.student"
            class="my-5 bg-white overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <div class="p-5">
              <PersonalDetailsView :student="props.student" />
              <FinancialDetailsView :student="props.student" />
              <StudentEmploymentView :student="props.student" />
              <IncomeDetailsView :student="props.student" />
              <StudentReferencesView :student="props.student" />
              <PassportDetailsView :student="props.student" />
              <FirstPassportDetailsView :student="props.student" />
              <ContactDetailsView :student="props.student" />
              <ParentsDetailsView :student="props.student" />
              <TravelDetailsView :student="props.student" />
              <OtherInformationDetailsView :student="props.student" />
              <QualificationsDetailsView :student="props.student" />
              <ImmigrationDetailsView :student="props.student" />
              <UkVisaHistoryDetailsView :student="props.student" />
              <OverseasTravelHistoryDetailsView :student="props.student" />
              <SpousePartnersAccompanyingDetailsView :student="props.student" />
              <ChildrenDetailsView :student="props.student" />
              <FamilyNotAccompanyingDetailsView :student="props.student" />
              <RequirementsForEuropeDetailsView :student="props.student" />

            </div>

            <div class="space-x-1 flex justify-end p-5">
              <PrimaryButton @click="navigateToStudentsIndex"
                class="middle none center mr-4 rounded-sm focus:bg-green-500 bg-green-500 hover:bg-green-600 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-green-500/40 disabled:pointer-events-none"
                data-ripple-light="true">
                Back to Students
              </PrimaryButton>
              <PrimaryButton @click="generatePDF"
                class="middle none center rounded-sm bg-orange-500 focus:bg-orange-500 hover:bg-orange-600 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-orange-500/20 transition-all hover:shadow-orange-500/40 disabled:pointer-events-none"
                data-ripple-light="true">
                Download PDF
              </PrimaryButton>
            </div>

          </div>

          <div v-else>
            <p>Loading...</p>
          </div>


        </div>


      </div>
    </div>
  </AuthenticatedLayout>
</template>