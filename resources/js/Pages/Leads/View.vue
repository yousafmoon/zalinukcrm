<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, router } from '@inertiajs/vue3';
import html2pdf from 'html2pdf.js';

import { useLeadStore } from '@/Pages/Stores/studentStore';
import LeadView from '@/Pages/Leads/ComponentsView/PersonalDetailsView.vue';
import { watchEffect } from 'vue';


const props = defineProps({
  lead: Object,
  leadId: Number,
});

const formStore = useLeadStore();
watchEffect(() => {
  formStore.lead = props.lead;
});


const navigateToLeadsIndex = () => {
  router.visit(route('leads.index'), {
    preserveScroll: true,
    preserveState: false,
    replace: true,
  });
};


const generatePDF = () => {
  const printContent = document.getElementById('lead-details');
  const filename = `${props.lead.firstname}_${props.lead.middlename}_${props.lead.surname}.pdf`;

  const options = {
    margin: 10,
    filename: filename,
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 4 },
    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
  };

  html2pdf().from(printContent).set(options).save();
};


</script>

<template>

  <Head title="View Lead" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        View Lead
      </h2>
    </template>

    <div class="bg-gray-100 py-10">
      <div class="mx-auto max-w-7xl">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <div class="flex justify-between sm:flex-auto">
              <h1 class="text-xl font-semibold text-gray-900 flex items-center">
                View Lead Details
                <div v-if="lead" class="ml-2 text-red-700">
                  ({{ lead.fullname }})
                </div>
              </h1>
              <div class="space-x-1">

                <PrimaryButton @click="navigateToLeadsIndex"
                  class="middle none center mr-4 rounded-sm focus:bg-green-500 bg-green-500 hover:bg-green-600 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-green-500/40 disabled:pointer-events-none"
                  data-ripple-light="true">
                  Back to Leads
                </PrimaryButton>
                <PrimaryButton @click="generatePDF"
                  class="middle none center rounded-sm bg-orange-500 focus:bg-orange-500 hover:bg-orange-600 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-orange-500/20 transition-all hover:shadow-orange-500/40 disabled:pointer-events-none"
                  data-ripple-light="true">
                  Download PDF
                </PrimaryButton>
              </div>
            </div>
          </div>




          <div id="lead-details" v-if="props.lead"
            class="my-5 bg-white overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <div class="p-5">
              <LeadView :lead="props.lead" />


            </div>

            <div class="space-x-1 flex justify-end p-5">
              <PrimaryButton @click="navigateToLeadsIndex"
                class="middle none center mr-4 rounded-sm focus:bg-green-500 bg-green-500 hover:bg-green-600 py-2 px-4 font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/20 transition-all hover:shadow-green-500/40 disabled:pointer-events-none"
                data-ripple-light="true">
                Back to Leads
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