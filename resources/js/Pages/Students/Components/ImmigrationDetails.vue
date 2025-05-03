<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';

const props = defineProps({
    student: Object
});
const formStore = useStudentStore();

</script>
<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">
            MAIN APPLICANT’S IMMIGRATION HISTORY:</h3>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="travel_outside" class="block text-sm font-medium text-gray-700">Have you travelled OUTSIDE your
                country of residence in the last 10 years?</label>
            <select v-model="formStore.student.travel_outside" id="travel_outside"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="sm:col-span-3 md:col-span-6">
            <label for="travel_uk" class="block text-sm font-medium text-gray-700">Have you travelled to the United
                Kingdom in the last 10 years?</label>
            <select v-model="formStore.student.travel_uk" id="travel_uk"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="refused_uk_visa" class="block text-sm font-medium text-gray-700">Have you ever been refused a
                Visa for the UK?</label>
            <select v-model="formStore.student.refused_uk_visa" id="refused_uk_visa"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="refused_any_visa" class="block text-sm font-medium text-gray-700">Have you ever been refused a
                Visa for any country?</label>
            <select v-model="formStore.student.refused_any_visa" id="refused_any_visa"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="granted_uk_visa" class="block text-sm font-medium text-gray-700">Have you been granted a UK Visa
                in the last 10 years?</label>
            <select v-model="formStore.student.granted_uk_visa" id="granted_uk_visa"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="refused_entry_uk" class="block text-sm font-medium text-gray-700">Have you been refused entry on
                arrival to the UK in the last 10 years?</label>
            <select v-model="formStore.student.refused_entry_uk" id="refused_entry_uk"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="deported_uk" class="block text-sm font-medium text-gray-700">Have you ever been deported,
                removed or otherwise required to leave the UK?</label>
            <select v-model="formStore.student.deported_uk" id="deported_uk"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>


        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="deported_other_country" class="block text-sm font-medium text-gray-700">Have you ever been
                deported, removed or otherwise required to leave any other country?</label>
            <select v-model="formStore.student.deported_other_country" id="deported_other_country"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="applied_home_office" class="block text-sm font-medium text-gray-700">Have you made an
                application to the UK Home Office to remain in the UK in the last 10 years?</label>
            <select v-model="formStore.student.applied_home_office" id="applied_home_office"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="breach_immigration_conditions" class="block text-sm font-medium text-gray-700">Have you ever
                been in breach of your Immigration conditions for the UK?</label>
            <select v-model="formStore.student.breach_immigration_conditions" id="breach_immigration_conditions"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="criminal_convictions" class="block text-sm font-medium text-gray-700">Do you have any criminal
                convictions in any country (including traffic offences)?</label>
            <textarea v-model="formStore.student.criminal_convictions" id="criminal_convictions" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter if you have any criminal convictions"></textarea>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="charged_criminal_offence" class="block text-sm font-medium text-gray-700">Have you ever been
                charged in any country with a criminal offence for which you have not yet been tried in a court
                (including traffic offences)?</label>
            <select v-model="formStore.student.charged_criminal_offence" id="charged_criminal_offence"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="involved_in_war_crimes" class="block text-sm font-medium text-gray-700">In times of either peace
                or war, have you ever been involved in or suspected of involvement in war crimes, crimes against
                humanity or genocide?</label>
            <select v-model="formStore.student.involved_in_war_crimes" id="involved_in_war_crimes"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="involved_in_terrorism" class="block text-sm font-medium text-gray-700">Have you ever been
                involved in, supported or encouraged terrorist activity in any country?</label>
            <select v-model="formStore.student.involved_in_terrorism" id="involved_in_terrorism"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="activities_bad_character" class="block text-sm font-medium text-gray-700">Have you engaged in
                any other activities that might include any which may mean you may not be considered a person of good
                character?</label>
            <textarea v-model="formStore.student.activities_bad_character" id="activities_bad_character" rows="4"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter if you have you engaged in any other activities "></textarea>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="nhs_treatment_unpaid" class="block text-sm font-medium text-gray-700">Have you at any point in
                the past had treatment via the UK National Health Service to the value in excess of £1000 which may
                remain unpaid?</label>
            <select v-model="formStore.student.nhs_treatment_unpaid" id="nhs_treatment_unpaid"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="organization_type" class="block text-sm font-medium text-gray-700">
                Have you ever worked for the following types of organisations?
            </label>
            <select v-model="formStore.student.organization_type" id="organization_type"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="" disabled selected>Select an option</option>
                <option value="armed_forces">Armed Forces (including compulsory national or military service)</option>
                <option value="government">Government (including Public or Civil Administration and compulsory national
                    service)</option>
                <option value="media">Media organisations</option>
                <option value="security">Security organisations (including police and private security companies)
                </option>
                <option value="judiciary">Judiciary (including work as a judge or magistrate)</option>
            </select>
        </div>

    </div>
</template>