<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, router } from '@inertiajs/vue3';
import html2pdf from 'html2pdf.js';

const props = defineProps({
  student: Object,
  required: true
});

const navigateToStudentsIndex = () => {
  router.visit(route('students.index'), {
    preserveScroll: true,
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

          <div id="student-details" v-if="student"
            class="my-5 bg-white overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <div class="p-5">

              <!-- MAIN APPLICANT'S BIOGRAPHICAL INFORMATION -->
              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">MAIN APPLICANT’S BIOGRAPHICAL INFORMATION</h2>
              <table class="w-full table-auto border border-gray-300 text-sm mb-8">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Choice of country</td>
                    <td class="p-2">{{ student.choice_of_country }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Intake</td>
                    <td class="p-2">{{ student.intake }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Intended Course</td>
                    <td class="p-2">{{ student.intended_course }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">First Name</td>
                    <td class="p-2">{{ student.firstname }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Middle Name</td>
                    <td class="p-2">{{ student.middlename }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Last Name</td>
                    <td class="p-2">{{ student.surname }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Nickname</td>
                    <td class="p-2">{{ student.nickname }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Email</td>
                    <td class="p-2">{{ student.email }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Gender</td>
                    <td class="p-2">{{ student.gender }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Nationality</td>
                    <td class="p-2">{{ student.nationality }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Date of Birth</td>
                    <td class="p-2">{{ student.date_of_birth }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Place of Birth</td>
                    <td class="p-2">{{ student.place_of_birth }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">UK National Insurance Number</td>
                    <td class="p-2">{{ student.national_insurance }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Other Nationalities</td>
                    <td class="p-2">{{ student.other_nationalities }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Marital Status</td>
                    <td class="p-2">{{ student.marital_status }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Criminal Convictions</td>
                    <td class="p-2">{{ student.criminal_conviction }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Police Clearance</td>
                    <td class="p-2">{{ student.police_clearance }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Disability</td>
                    <td class="p-2">{{ student.disability }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Living Situation</td>
                    <td class="p-2">{{ student.living_situation }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Correspondence Address</td>
                    <td class="p-2">{{ student.correspondence_address }}</td>
                  </tr>
                </tbody>
              </table>


              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">FINANCIAL DETAILS</h2>

              <table class="w-full table-auto border border-gray-300 text-sm mb-8">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Do you own any property?</td>
                    <td class="p-2">{{ student.own_property }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Do you have any savings in the Bank?</td>
                    <td class="p-2">{{ student.bank_savings }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Budget for yearly tuition fee?</td>
                    <td class="p-2">{{ student.tuition_budget }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Bank funds (maintaining/going to maintain)?</td>
                    <td class="p-2">{{ student.bank_funds }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Who is paying your tuition fee?</td>
                    <td class="p-2">{{ student.tuition_payer }}</td>
                  </tr>
                </tbody>
              </table>

              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">WORK HISTORY</h2>

              <table class="w-full table-auto border border-gray-300 text-sm mb-4">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Personal Circumstances</td>
                    <td class="p-2">{{ student.personal_circumstances }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Employment Details</td>
                    <td class="p-2">{{ student.employment_details }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Present Work</td>
                    <td class="p-2">{{ student.present_work }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Company Name</td>
                    <td class="p-2">{{ student.company_name }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Start Date</td>
                    <td class="p-2">{{ student.student_start_date }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Work Address</td>
                    <td class="p-2">{{ student.work_address }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Employer Phone</td>
                    <td class="p-2">{{ student.employer_phone }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Employer Email</td>
                    <td class="p-2">{{ student.employer_email }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">Additional Jobs</td>
                    <td class="p-2">{{ student.additional_students }}</td>
                  </tr>
                </tbody>
              </table>


              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">INCOME AND EXPENDITURE</h2>

              <table class="w-full table-auto border border-gray-300 text-sm mb-8">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Total Monthly Income (After Tax)</td>
                    <td class="p-2">{{ student.monthly_income }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Income From Others (Parents/Family)</td>
                    <td class="p-2">{{ student.income_from_others }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Other Income Sources</td>
                    <td class="p-2">{{ student.other_income_sources }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Monthly Income Given to Family</td>
                    <td class="p-2">{{ student.monthly_income_given_to_family }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">Monthly Living Costs</td>
                    <td class="p-2">{{ student.monthly_living_costs }}</td>
                  </tr>
                </tbody>
              </table>

              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">ACADEMIC / JOB REFERENCES</h2>

              <table class="w-full table-auto border border-gray-300 text-sm mb-4">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Name</td>
                    <td class="p-2">{{ student.name }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Phone Number</td>
                    <td class="p-2">{{ student.phone }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Work Email</td>
                    <td class="p-2">{{ student.email }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Position</td>
                    <td class="p-2">{{ student.position }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Relationship to You</td>
                    <td class="p-2">{{ student.relationship }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">How long has the person known you?</td>
                    <td class="p-2">{{ student.duration }}</td>
                  </tr>
                </tbody>
              </table>

              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">MAIN APPLICANT’S PASSPORT INFORMATION</h2>

              <table class="w-full table-auto border border-gray-300 text-sm mt-2 mb-6">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Current Passport Number</td>
                    <td class="p-2">{{ student.passport_number }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Place of Issue</td>
                    <td class="p-2">{{ student.place_of_issue }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Issuing Authority</td>
                    <td class="p-2">{{ student.issuing_authority }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Date of Issue</td>
                    <td class="p-2">{{ student.date_of_issue }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">Date of Expiry</td>
                    <td class="p-2">{{ student.date_of_expiry }}</td>
                  </tr>
                </tbody>
              </table>

              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">IS THIS YOUR FIRST PASSPORT:</h2>

              <table class="w-full table-auto border border-gray-300 text-sm mt-2 mb-6">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Previous PPT Number</td>
                    <td class="p-2">{{ student.previous_ppt_number }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Place of Issue</td>
                    <td class="p-2">{{ student.place_of_issue_previous }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Issuing Authority</td>
                    <td class="p-2">{{ student.issuing_authority_previous }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Date of Issue</td>
                    <td class="p-2">{{ student.date_of_issue_previous }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Date of Expiry</td>
                    <td class="p-2">{{ student.date_of_expiry_previous }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">National Identity Card Number</td>
                    <td class="p-2">{{ student.national_id_number }}</td>
                  </tr>
                </tbody>
              </table>

              <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
                MAIN APPLICANT’S CONTACT DETAILS IN COUNTRY OF APPLICATION:
              </h3>

              <table class="w-full table-auto border border-gray-300 text-sm">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Address</td>
                    <td class="p-2 whitespace-pre-line">{{ student.address }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Postal/Zip Code</td>
                    <td class="p-2">{{ student.postal_code }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">How Long Have You Lived at This Address?</td>
                    <td class="p-2">{{ student.how_long_lived }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Home (Landline) Number</td>
                    <td class="p-2">{{ student.home_number }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Mobile Number</td>
                    <td class="p-2">{{ student.mobile_number }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Email Address</td>
                    <td class="p-2">{{ student.email_address }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Will this be your contact details during the application process?</td>
                    <td class="p-2">{{ student.contact_during_application }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Main address and contact details of where you will be staying whilst
                      in
                      the UK</td>
                    <td class="p-2 whitespace-pre-line">{{ student.main_address_uk }}</td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">Ownership status of your home</td>
                    <td class="p-2">{{ student.ownership_status }}</td>
                  </tr>
                </tbody>
              </table>


              <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
                MAIN APPLICANT’S PARENT’S DETAILS (Father)
              </h3>
              <table class="w-full table-auto border border-gray-300 text-sm mb-6">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Father’s Given Name</td>
                    <td class="p-2 whitespace-pre-line">{{ student.father_given_name }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Family Name</td>
                    <td class="p-2">{{ student.father_family_name }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Date of Birth</td>
                    <td class="p-2">{{ student.father_date_of_birth }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Father’s Place and Country of Birth</td>
                    <td class="p-2 whitespace-pre-line">{{ student.father_place_of_birth }}
                    </td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">Father’s Nationality</td>
                    <td class="p-2">{{ student.father_nationality }}</td>
                  </tr>
                </tbody>
              </table>

              <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
                MAIN APPLICANT’S PARENT’S DETAILS (Mother)
              </h3>
              <table class="w-full table-auto border border-gray-300 text-sm">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Mother’s Given Name</td>
                    <td class="p-2 whitespace-pre-line">{{ student.mother_given_name }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Family Name</td>
                    <td class="p-2">{{ student.mother_family_name }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Date of Birth</td>
                    <td class="p-2">{{ student.mother_date_of_birth }}</td>
                  </tr>
                  <tr class="border-b">
                    <td class="font-semibold p-2">Mother’s Place and Country of Birth</td>
                    <td class="p-2 whitespace-pre-line">{{ student.mother_place_of_birth }}
                    </td>
                  </tr>
                  <tr>
                    <td class="font-semibold p-2">Mother’s Nationality</td>
                    <td class="p-2">{{ student.mother_nationality }}</td>
                  </tr>
                </tbody>
              </table>


              <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
                DATES OF TRAVEL
              </h3>

              <table class="w-full table-auto border border-gray-300 text-sm">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">
                      What date do you hope to travel to the UK?
                    </td>
                    <td class="p-2">{{ student.travel_date }}</td>

                  </tr>
                </tbody>
              </table>

              <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
                OTHER INFORMATION
              </h3>

              <table class="w-full table-auto border border-gray-300 text-sm">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">
                      Do you have any immediate family in the UK?
                    </td>

                    <td class="p-2">{{ student.family_in_uk }}</td>

                  </tr>

                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">
                      Will you be travelling to the UK with someone who is NOT your partner, spouse, or dependent?
                    </td>
                    <td class="p-2">{{ student.travelling_with_others }}</td>

                  </tr>
                </tbody>
              </table>


              <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
                QUALIFICATIONS
              </h3>

              <table class="w-full table-auto border border-gray-300 text-sm">
                <tbody>
                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">
                      Please tell us about any Qualifications you hold at Degree level or higher:
                    </td>
                    <td class="p-2 whitespace-pre-wrap">
                      {{ student.qualifications }}
                    </td>
                  </tr>

                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Where did you study?</td>
                    <td class="p-2">
                      {{ student.study_institution }}
                    </td>
                  </tr>

                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Subject/s studied</td>
                    <td class="p-2">
                      {{ student.subjects_studied }}
                    </td>
                  </tr>

                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Date passed/qualified</td>
                    <td class="p-2">
                      {{ student.date_passed }}
                    </td>
                  </tr>

                  <tr class="border-b">
                    <td class="font-semibold p-2 w-1/3">Study Gap after Last Degree</td>
                    <td class="p-2">
                      {{ student.study_gap_after_last_degree }}
                    </td>
                  </tr>

                  <tr>
                    <td class="font-semibold p-2 w-1/3">Can you justify gap?</td>
                    <td class="p-2">
                      {{ student.can_you_justify_gap }}
                    </td>
                  </tr>
                </tbody>
              </table>




              <h2 class="text-lg font-medium text-red-700 mt-4 mb-2">Documents Required</h2>
              <div v-for="(field, index) in documentFields" :key="index" class="col-span-2">
                <p class="font-semibold text-gray-700">{{ field.label }}:</p>
                <p v-if="student[field.name]">
                  <a :href="student[field.name]" target="_blank" class="text-blue-500 hover:underline" download>
                    Download {{ field.label }}
                  </a>
                </p>
              </div>

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