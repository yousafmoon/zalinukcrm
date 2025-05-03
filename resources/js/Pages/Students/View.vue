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
            <div class="p-5 grid grid-cols-2 gap-4 w-screen">
              <h2 class="col-span-2 text-lg font-semibold text-gray-800">MAIN APPLICANT’S BIOGRAPHICAL INFORMATION</h2>

              <p class="font-semibold text-gray-700">Choice of country</p>
              <p>{{ student.choice_of_country }}</p>

              <p class="font-semibold text-gray-700">Intake</p>
              <p>{{ student.intake }}</p>

              <p class="font-semibold text-gray-700">Intended Course</p>
              <p>{{ student.intended_course }}</p>

              <p class="font-semibold text-gray-700">First Name</p>
              <p>{{ student.firstname }}</p>

              <p class="font-semibold text-gray-700">Middle Name</p>
              <p>{{ student.middlename }}</p>

              <p class="font-semibold text-gray-700">Last Name</p>
              <p>{{ student.surname }}</p>

              <p class="font-semibold text-gray-700">Nickname</p>
              <p>{{ student.nickname }}</p>

              <p class="font-semibold text-gray-700">Email</p>
              <p>{{ student.email }}</p>

              <p class="font-semibold text-gray-700">Gender</p>
              <p>{{ student.gender }}</p>

              <p class="font-semibold text-gray-700">Nationality</p>
              <p>{{ student.nationality }}</p>

              <p class="font-semibold text-gray-700">Date of Birth</p>
              <p>{{ student.date_of_birth }}</p>

              <p class="font-semibold text-gray-700">Place of Birth</p>
              <p>{{ student.place_of_birth }}</p>

              <p class="font-semibold text-gray-700">UK National Insurance Number</p>
              <p>{{ student.national_insurance }}</p>

              <p class="font-semibold text-gray-700">Do you or have you ever held any other nationalities? If YES,
                please
                specify</p>
              <p>{{ student.other_nationalities }}</p>

              <p class="font-semibold text-gray-700">Marital Status</p>
              <p>{{ student.marital_status }}</p>

              <p class="font-semibold text-gray-700">Do you have any criminal convictions?</p>
              <p>{{ student.criminal_conviction }}</p>

              <p class="font-semibold text-gray-700">Do you have Police Clearance Certificate/DBS Check?</p>
              <p>{{ student.police_clearance }}</p>

              <p class="font-semibold text-gray-700">Do you have any Disability? (If yes, please specify)</p>
              <p>{{ student.disability }}</p>

              <p class="font-semibold text-gray-700">If you lost/stolen your passport (please upload police complaint
                report/FIR)?</p>
              <p>{{ student.fircopy }}</p>

              <p class="font-semibold text-gray-700">Give more details about your living situation, such as who you live
                with and who owns the property</p>
              <p>{{ student.living_situation }}</p>

              <p class="font-semibold text-gray-700">Correspondence address (If different than home address)</p>
              <p>{{ student.correspondence_address }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">FINANCIAL DETAILS</h2>

              <p class="font-semibold text-gray-700">Do you own any property?</p>
              <p>{{ student.own_property }}</p>

              <p class="font-semibold text-gray-700">Do you have any savings in the Bank?</p>
              <p>{{ student.bank_savings }}</p>

              <p class="font-semibold text-gray-700">Budget for yearly tuition fee?</p>
              <p>{{ student.tuition_budget }}</p>

              <p class="font-semibold text-gray-700">Bank funds (maintaining/going to maintain)?</p>
              <p>{{ student.bank_funds }}</p>

              <p class="font-semibold text-gray-700">Who is paying your tuition fee?</p>
              <p>{{ student.tuition_payer }}</p>

              <p class="font-semibold text-gray-700">What are your current personal circumstances?</p>
              <p>{{ student.personal_circumstances }}</p>

              <p class="font-semibold text-gray-700">Write your employment details</p>
              <p>{{ student.employment_details }}</p>

              <p class="font-semibold text-gray-700">What is your present work, job or occupation?</p>
              <p>{{ student.present_work }}</p>

              <p class="font-semibold text-gray-700">What is the name of the company or organisation you work for?</p>
              <p>{{ student.company_name }}</p>

              <p class="font-semibold text-gray-700">When did you start this job?</p>
              <p>{{ student.job_start_date }}</p>

              <p class="font-semibold text-gray-700">What is your work address?</p>
              <p>{{ student.work_address }}</p>

              <p class="font-semibold text-gray-700">What are your employer's telephone numbers?</p>
              <p>{{ student.employer_phone }}</p>

              <p class="font-semibold text-gray-700">What is your employer's email address?</p>
              <p>{{ student.employer_email }}</p>


              <p class="font-semibold text-gray-700">Give details of any additional jobs or occupations</p>
              <p>{{ student.additional_jobs }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">Income and Expenditure</h2>
              <p class="font-semibold text-gray-700">Total Monthly Income (After Tax)</p>
              <p>{{ student.monthly_income }}</p>

              <p class="font-semibold text-gray-700">Income From Others (Friends/Family)</p>
              <p>{{ student.income_from_others }}</p>

              <p class="font-semibold text-gray-700">Other Income Sources</p>
              <p>{{ student.other_income_sources }}</p>

              <p class="font-semibold text-gray-700">Monthly Income Given to Family</p>
              <p>{{ student.monthly_income_given_to_family }}</p>

              <p class="font-semibold text-gray-700">Monthly Living Costs</p>
              <p>{{ student.monthly_living_costs }}</p>


              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">Financial Documents </h2>

              <p class="font-semibold text-gray-700">Payslips</p>
              <p>{{ student.payslips }}</p>

              <p class="font-semibold text-gray-700">Personal Bank Statement</p>
              <p>{{ student.bank_statement }}</p>

              <p class="font-semibold text-gray-700">Letter from Previous Employer</p>
              <p>{{ student.letter_from_previous_employer }}</p>

              <p class="font-semibold text-gray-700">Official Tax Documents</p>
              <p>{{ student.official_tax_documents }}</p>

              <p class="font-semibold text-gray-700">Dividend Voucher</p>
              <p>{{ student.dividend_voucher }}</p>

              <p class="font-semibold text-gray-700">Invoice Explanation/Payment Summaries</p>
              <p>{{ student.invoice_explanation }}</p>

              <p class="font-semibold text-gray-700">Business Account</p>
              <p>{{ student.business_account }}</p>

              <p class="font-semibold text-gray-700">Accountant's Letter</p>
              <p>{{ student.accountant_letter }}</p>

              <p class="font-semibold text-gray-700">Business Bank Statement</p>
              <p>{{ student.business_bank_statement }}</p>


              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">ACADEMIC / JOB REFERENCES </h2>
              <h3 class="col-span-2">Reference Title (Academic)</h3>

              <h5>Reference - 1</h5>

              <p class="col-span-2 font-semibold text-gray-700">Name</p>
              <p>{{ student.reference_name }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Phone Number</p>
              <p>{{ student.reference_phone }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Work Email</p>
              <p>{{ student.reference_email }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Position</p>
              <p>{{ student.reference_position }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Relationship to You</p>
              <p>{{ student.reference_relationship }}</p>

              <p class="col-span-2 font-semibold text-gray-700">How long has the person known you?</p>
              <p>{{ student.reference_duration }}</p>

              <h5 class="col-span-2">Reference - 2</h5>

              <p class="col-span-2 font-semibold text-gray-700">Name</p>
              <p>{{ student.reference_name_2 }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Phone Number</p>
              <p>{{ student.reference_phone_2 }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Work Email</p>
              <p>{{ student.reference_email_2 }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Position</p>
              <p>{{ student.reference_position_2 }}</p>

              <p class="col-span-2 font-semibold text-gray-700">Relationship to You</p>
              <p>{{ student.reference_relationship_2 }}</p>

              <p class="col-span-2 font-semibold text-gray-700">How long has the person known you?</p>
              <p>{{ student.reference_duration_2 }}</p>


              <h3 class="col-span-2 ">Reference (Work)</h3>

              <h5 class="col-span-2">Reference - 1</h5>

              <p class="font-semibold text-gray-700">Name</p>
              <p>{{ student.work_reference_name }}</p>

              <p class="font-semibold text-gray-700">Phone Number</p>
              <p>{{ student.work_reference_phone }}</p>

              <p class="font-semibold text-gray-700">Work Email</p>
              <p>{{ student.work_reference_email }}</p>

              <p class="font-semibold text-gray-700">Position</p>
              <p>{{ student.work_reference_position }}</p>

              <p class="font-semibold text-gray-700">Relationship to You</p>
              <p>{{ student.work_reference_relationship }}</p>

              <p class="font-semibold text-gray-700">How long has the person known you?</p>
              <p>{{ student.work_reference_duration }}</p>

              <h5 class="col-span-2">Reference - 2</h5>

              <p class="font-semibold text-gray-700">Name</p>
              <p>{{ student.work_reference_name_2 }}</p>

              <p class="font-semibold text-gray-700">Phone Number</p>
              <p>{{ student.work_reference_phone_2 }}</p>

              <p class="font-semibold text-gray-700">Work Email</p>
              <p>{{ student.work_reference_email_2 }}</p>

              <p class="font-semibold text-gray-700">Position</p>
              <p>{{ student.work_reference_position_2 }}</p>

              <p class="font-semibold text-gray-700">Relationship to You</p>
              <p>{{ student.work_reference_relationship_2 }}</p>

              <p class="font-semibold text-gray-700">How long has the person known you?</p>
              <p>{{ student.work_reference_duration_2 }}</p>


              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">MAIN APPLICANT’S PASSPORT INFORMATION</h2>
              <p class="font-semibold text-gray-700">Passport Number</p>
              <p>{{ student.passport_number }}</p>

              <p class="font-semibold text-gray-700">Place of Issue</p>
              <p>{{ student.place_of_issue }}</p>

              <p class="font-semibold text-gray-700">Issuing Authority</p>
              <p>{{ student.issuing_authority }}</p>

              <p class="font-semibold text-gray-700">Date of Issue</p>
              <p>{{ student.date_of_issue }}</p>

              <p class="font-semibold text-gray-700">Date of Expiry</p>
              <p>{{ student.date_of_expiry }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">IS THIS YOUR FIRST PASSPORT</h2>
              <p class="font-semibold text-gray-700">Previous PPT Number</p>
              <p>{{ student.previous_ppt_number }}</p>

              <p class="font-semibold text-gray-700">Previous place of issue</p>
              <p>{{ student.place_of_issue_previous }}</p>

              <p class="font-semibold text-gray-700">Issuing Authority</p>
              <p>{{ student.issuing_authority_previous }}</p>

              <p class="font-semibold text-gray-700">Date of Issue</p>
              <p>{{ student.date_of_issue_previous }}</p>

              <p class="font-semibold text-gray-700">Date of Expiry
              </p>
              <p>{{ student.date_of_expiry_previous }}</p>

              <p class="font-semibold text-gray-700">National Identity Card Number </p>
              <p>{{ student.national_id_number }}</p>


              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">MAIN APPLICANT’S CONTACT DETAILS IN
                COUNTRY OF
                APPLICATION:</h2>
              <p class="font-semibold text-gray-700">Address</p>
              <p>{{ student.address }}</p>


              <p class="font-semibold text-gray-700">Postal/Zip Code</p>
              <p>{{ student.postal_code }}</p>

              <p class="font-semibold text-gray-700">How Long Have You Lived at This Address?</p>
              <p>{{ student.how_long_lived }}</p>

              <p class="font-semibold text-gray-700">Home (Landline) Number</p>
              <p>{{ student.home_number }}</p>

              <p class="font-semibold text-gray-700">Mobile Number</p>
              <p>{{ student.mobile_number }}</p>

              <p class="font-semibold text-gray-700">Email Address</p>
              <p>{{ student.email_address }}</p>

              <p class="font-semibold text-gray-700">Will this be your contact details during the application process?
              </p>
              <p>{{ student.contact_during_application }}</p>

              <p class="font-semibold text-gray-700">Main address and contact details of where you will be staying
                whilst in
                the UK</p>
              <p>{{ student.main_address_uk }}</p>

              <p class="font-semibold text-gray-700">What is the ownership status of your home?</p>
              <p>{{ student.ownership_status }}</p>


              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">MAIN APPLICANT’S PARENT’S DETAILS (Father)
              </h2>

              <p class="font-semibold text-gray-700">Father’s Given Name</p>
              <p>{{ student.father_given_name }}</p>

              <p class="font-semibold text-gray-700">Father’s Family Name</p>
              <p>{{ student.father_family_name }}</p>

              <p class="font-semibold text-gray-700">Father’s Date of Birth</p>
              <p>{{ student.father_date_of_birth }}</p>

              <p class="font-semibold text-gray-700">Father’s Place and Country of Birth</p>
              <p>{{ student.father_place_birth }}</p>

              <p class="font-semibold text-gray-700">Father’s Nationality</p>
              <p>{{ student.father_nationality }}</p>.

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">MAIN APPLICANT’S PARENT’S DETAILS (Mother)
              </h2>

              <p class="font-semibold text-gray-700">Mother’s Given Name</p>
              <p>{{ student.mother_given_name }}</p>

              <p class="font-semibold text-gray-700">Mother’s Family Name</p>
              <p>{{ student.mother_family_name }}</p>

              <p class="font-semibold text-gray-700">Mother’s Date of Birth</p>
              <p>{{ student.mother_date_of_birth }}</p>

              <p class="font-semibold text-gray-700">Mother’s Place and Country of Birth</p>
              <p>{{ student.mother_place_birth }}</p>

              <p class="font-semibold text-gray-700">Mother’s Nationality</p>
              <p>{{ student.mother_nationality }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">DATES OF TRAVEL</h2>

              <p class="font-semibold text-gray-700">What date do you hope to travel to the UK?</p>
              <p>{{ student.travel_date }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">OTHER INFORMATION</h2>

              <p class="font-semibold text-gray-700">Do you have any immediate family in the UK?</p>
              <p>{{ student.family_in_uk }}</p>

              <p class="font-semibold text-gray-700">Will you be travelling to the UK with someone who is NOT your
                partner,
                spouse, or dependent?</p>
              <p>{{ student.travelling_with_others }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">QUALIFICATIONS</h2>
              <p class="col-span-2 font-semibold text-gray-700">Please tell us about any Qualifications you hold at
                Degree
                level or higher:</p>
              <p>{{ student.qualifications }}</p>
              <p class="col-span-2 font-semibold text-gray-700">Where did you study?</p>
              <p>{{ student.study_institution }}</p>
              <p class="col-span-2 font-semibold text-gray-700">Subject/s studied</p>
              <p>{{ student.subjects_studied }}</p>
              <p class="col-span-2 font-semibold text-gray-700">Date passed/qualified</p>
              <p>{{ student.date_passed }}</p>.
              <p class="col-span-2 font-semibold text-gray-700">Study Gap After Last Degree</p>
              <p>{{ student.study_gap_after_last_degree }}</p>
              <p class="col-span-2 font-semibold text-gray-700">Can You Justify Gap</p>
              <p>{{ student.can_you_justify_gap }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">MAIN APPLICANT’S IMMIGRATION HISTORY</h2>

              <p class="font-semibold text-gray-700">Have you travelled OUTSIDE your country of residence in the last 10
                years?</p>
              <p>{{ student.travel_outside }}</p>

              <p class="font-semibold text-gray-700">Have you travelled to the United Kingdom in the last 10 years?</p>
              <p>{{ student.travel_uk }}</p>

              <p class="font-semibold text-gray-700">Have you ever been refused a Visa for the UK?</p>
              <p>{{ student.refused_uk_visa }}</p>

              <p class="font-semibold text-gray-700">Have you ever been refused a Visa for any country?</p>
              <p>{{ student.refused_any_visa }}</p>

              <p class="font-semibold text-gray-700">Have you been granted a UK Visa in the last 10 years?</p>
              <p>{{ student.granted_uk_visa }}</p>

              <p class="font-semibold text-gray-700">Have you been refused entry on arrival to the UK in the last 10
                years?
              </p>
              <p>{{ student.refused_entry_uk }}</p>

              <p class="font-semibold text-gray-700">Have you ever been deported, removed or otherwise required to leave
                the
                UK?</p>
              <p>{{ student.deported_uk }}</p>

              <p class="font-semibold text-gray-700">Have you ever been deported, removed or otherwise required to leave
                any
                other country?</p>
              <p>{{ student.deported_other_country }}</p>

              <p class="font-semibold text-gray-700">Have you made an application to the UK Home Office to remain in the
                UK
                in the last 10 years?</p>
              <p>{{ student.applied_home_office }}</p>

              <p class="font-semibold text-gray-700">Have you ever been in breach of your Immigration conditions for the
                UK?
              </p>
              <p>{{ student.breach_immigration_conditions }}</p>

              <p class="font-semibold text-gray-700">Do you have any criminal convictions in any country (including
                traffic
                offences)?</p>
              <p>{{ student.criminal_convictions }}</p>

              <p class="font-semibold text-gray-700">Have you ever been charged in any country with a criminal offence
                for
                which you have not yet been tried in a court (including traffic offences)?</p>
              <p>{{ student.charged_criminal_offence }}</p>

              <p class="font-semibold text-gray-700">In times of either peace or war, have you ever been involved in or
                suspected of involvement in war crimes, crimes against humanity or genocide?</p>
              <p>{{ student.involved_in_war_crimes }}</p>

              <p class="font-semibold text-gray-700">Have you ever been involved in, supported or encouraged terrorist
                activity in any country?</p>
              <p>{{ student.involved_in_terrorism }}</p>


              <p class="font-semibold text-gray-700">Have you engaged in any other activities that might include any
                which
                may mean you may not be considered a person of good character?</p>
              <p>{{ student.activities_bad_character }}</p>

              <p class="font-semibold text-gray-700">Have you at any point in the past had treatment via the UK National
                Health Service to the value in excess of £1000 which may remain unpaid?</p>
              <p>{{ student.nhs_treatment_unpaid }}</p>

              <p class="font-semibold text-gray-700">Have you ever worked for the following types of organisations?</p>
              <p>{{ student.organization_type }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4"> UK VISA HISTORY</h2>

              <p class="font-semibold text-gray-700">VISA TYPE</p>
              <p>{{ student.visa_type }}</p>

              <p class="font-semibold text-gray-700">DATE VALID FROM</p>
              <p>{{ student.visa_valid_from }}</p>

              <p class="font-semibold text-gray-700">EXPIRY DATE</p>
              <p>{{ student.visa_expiry_date }}</p>

              <p class="font-semibold text-gray-700">REFERENCE NUMBER (if applicable)</p>
              <p>{{ student.visa_reference_number }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">OVERSEAS TRAVEL HISTORY</h2>
              <h3 class="text-md col-span-2">United Kingdom</h3>

              <p class="font-semibold text-gray-700">Country Visited</p>
              <p>{{ student.uk_country_visited }}</p>

              <p class="font-semibold text-gray-700">Date Arrived</p>
              <p>{{ student.uk_date_arrived }}</p>

              <p class="font-semibold text-gray-700">Purpose of visit</p>
              <p>{{ student.uk_purpose_of_visit }}</p>

              <p class="font-semibold text-gray-700">Length of stay (dd/wks/yrs)</p>
              <p>{{ student.uk_length_of_stay }}</p>

              <h3 class="text-md col-span-2">Europe</h3>

              <p class="font-semibold text-gray-700">Country Visited</p>
              <p>{{ student.europe_country_visited }}</p>

              <p class="font-semibold text-gray-700">Date Arrived</p>
              <p>{{ student.europe_date_arrived }}</p>

              <p class="font-semibold text-gray-700">Purpose of visit</p>
              <p>{{ student.europe_purpose_of_visit }}</p>

              <p class="font-semibold text-gray-700">Length of stay (dd/wks/yrs)</p>
              <p>{{ student.europe_length_of_stay }}</p>

              <h3 class="text-md col-span-2">Australia, Canada, New Zealand, USA</h3>

              <p class="font-semibold text-gray-700">Country Visited</p>
              <p>{{ student.acnz_usa_country_visited }}</p>

              <p class="font-semibold text-gray-700">Date Arrived</p>
              <p>{{ student.acnz_usa_date_arrived }}</p>

              <p class="font-semibold text-gray-700">Purpose of visit</p>
              <p>{{ student.acnz_usa_purpose_of_visit }}</p>

              <p class="font-semibold text-gray-700">Length of stay (dd/wks/yrs)</p>
              <p>{{ student.acnz_usa_length_of_stay }}</p>

              <h3 class="col-span-2 text-md">Rest of the World</h3>

              <p class="font-semibold text-gray-700">Country Visited</p>
              <p>{{ student.row_country_visited }}</p>

              <p class="font-semibold text-gray-700">Date Arrived</p>
              <p>{{ student.row_date_arrived }}</p>

              <p class="font-semibold text-gray-700">Purpose of visit</p>
              <p>{{ student.row_purpose_of_visit }}</p>

              <p class="font-semibold text-gray-700">Length of stay (dd/wks/yrs)</p>
              <p>{{ student.row_length_of_stay }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4"> PLEASE PROVIDE THE FOLLOWING INFORMATION
                – IF
                APPLICABLE – EVEN IF YOUR FAMILY ARE NOT ACCOMPANYING YOU TO THE UK.
              </h2>

              <p class="font-semibold text-gray-700">Spouse / Partner’s Given Name</p>
              <p>{{ student.spouse_given_name }}</p>


              <p class="font-semibold text-gray-700">Spouse / Partner’s Family Name</p>
              <p>{{ student.spouse_family_name }}</p>

              <p class="font-semibold text-gray-700">Spouse Passport Number (if held)</p>
              <p>{{ student.spouse_passport_number }}</p>

              <p class="font-semibold text-gray-700">Where is your spouse / partner now</p>
              <p>{{ student.spouse_location }}</p>

              <p class="font-semibold text-gray-700">Spouse / Partner’s Date of Birth</p>
              <p>{{ student.spouse_dob }}</p>

              <p class="font-semibold text-gray-700">Spouse’s Nationality</p>
              <p>{{ student.spouse_nationality }}</p>
              <p class="font-semibold text-gray-700">Will your spouse / partner be accompanying you to the United
                Kingdom?
              </p>
              <p>{{ student.spouse_accompanying_uk }}</p>
              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">YOUR CHILDREN (IRRESPECTIVE OF AGE)</h2>

              <div v-if="children && children.length > 0">
                <h2 class="text-lg font-semibold text-gray-800 mt-4">Children Information</h2>

                <div v-for="(child, index) in children" :key="index">
                  <h3 class="text-md font-semibold">Child {{ index + 1 }}</h3>

                  <p class="font-semibold text-gray-700">Full Name</p>
                  <p>{{ child.full_name }}</p>

                  <p class="font-semibold text-gray-700">Gender</p>
                  <p>{{ child.gender }}</p>

                  <p class="font-semibold text-gray-700">Date of Birth</p>
                  <p>{{ child.dob }}</p>

                  <p class="font-semibold text-gray-700">Place of Birth</p>
                  <p>{{ child.place_of_birth }}</p>

                  <p class="font-semibold text-gray-700">Nationality</p>
                  <p>{{ child.nationality }}</p>

                  <p class="font-semibold text-gray-700">Accompanying to the UK?</p>
                  <p>{{ child.accompanying_uk }}</p>

                  <p class="font-semibold text-gray-700">Current Address</p>
                  <p>{{ child.current_address }}</p>

                  <p class="font-semibold text-gray-700">Passport Number</p>
                  <p>{{ child.passport_number }}</p>
                </div>
              </div>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4"> THIS PAGE SHOULD ONLY BE COMPLETED IF
                YOUR
                SPOUSE / PARTNER WILL ACCOMPANY YOU TO THE UK.</h2>
              <h3 class="col-span-2 text-md">Father</h3>
              <p class="font-semibold text-gray-700">Father’s Given Name</p>
              <p>{{ student.spouse_father_given_name }}</p>

              <p class="font-semibold text-gray-700">Father’s Family Name</p>
              <p>{{ student.spouse_father_family_name }}</p>

              <p class="font-semibold text-gray-700">Father’s Date of Birth</p>
              <p>{{ student.father_dob }}</p>

              <p class="font-semibold text-gray-700">Father’s Place and Country of Birth</p>
              <p>{{ student.father_place_of_birth }}</p>

              <h3 class="col-span-2 text-md">Mother</h3>

              <p class="font-semibold text-gray-700">Mother’s Given Name</p>
              <p>{{ student.spouse_mother_family_name }}</p>

              <p class="font-semibold text-gray-700">Mother’s Family Name</p>
              <p>{{ student.spouse_mother_family_name }}</p>


              <p class="font-semibold text-gray-700">Mother’s Date of Birth</p>
              <p>{{ student.mother_dob }}</p>


              <p class="font-semibold text-gray-700">Mother’s Place and Country of Birth</p>
              <p>{{ student.mother_place_of_birth }}</p>

              <h3 class="col-span-2 text-md">UK VISA HISTORY</h3>

              <p class="font-semibold text-gray-700">Date Valid From</p>
              <p>{{ student.visa_valid_from }}</p>

              <p class="font-semibold text-gray-700">Expiry Date</p>
              <p>{{ student.visa_expiry_date }}</p>

              <p class="font-semibold text-gray-700">Visa Type (Business/Visit)</p>
              <p>{{ student.visa_type }}</p>

              <p class="font-semibold text-gray-700">Overseas Travel History</p>
              <p>{{ student.spouse_travel_history }}</p>


              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">Requirements for Europe</h2>

              <p class="font-semibold text-gray-700">Do you have Block account?</p>
              <p>{{ student.do_you_have_block_account }}</p>

              <p class="font-semibold text-gray-700">Have you legalised the documents from Embassy?</p>
              <p>{{ student.have_you_legalised_documents }}</p>

              <p class="font-semibold text-gray-700">Bonafide Student Undertaking</p>
              <p>{{ student.bonafide_student_undertaking }}</p>


              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">Please forward this completed
                questionnaire
                and the following copy documents to your admission officer at ZALINUK CONSULTANTS</h2>

              <p class="font-semibold text-gray-700">Copy of current passports for all applicants confirming personal
                details</p>
              <p>{{ student.copy_current_passport }}</p>

              <p class="font-semibold text-gray-700">Copy of any current/previous UK visas</p>
              <p>{{ student.copy_any_current_previous_uk_visas }}</p>

              <p class="font-semibold text-gray-700">Copy of any previous passports still in your possession</p>
              <p>{{ student.copy_any_previous_passports }}</p>

              <p class="font-semibold text-gray-700">Remarks</p>
              <p>{{ student.remarks }}</p>

              <h2 class="col-span-2 text-lg font-semibold text-gray-800 mt-4">Documents Required</h2>
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