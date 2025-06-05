<script setup>

import { useStudentStore } from '@/Pages/Stores/studentStore';

import { watchEffect } from 'vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();

watchEffect(() => {
    if (props.student) {
        formStore.student = props.student;
    }
});
</script>
<template>


    <h3 class="text-lg font-medium text-red-700 mt-4 mb-2">
        MAIN APPLICANT’S IMMIGRATION HISTORY:
    </h3>


    <div v-if="props.student && props.student.immigration_details">

        <table class="w-full table-auto border border-gray-300 text-sm">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">
                        Have you travelled OUTSIDE your
                        country of residence in the last 10 years?
                    </td>
                    <td class="p-2 whitespace-pre-wrap">
                        {{ props.student.immigration_details.travel_outside }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Have you travelled to the United
                        Kingdom in the last 10 years?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.travel_uk }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Have you ever been refused a
                        Visa for the UK?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.refused_uk_visa }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Have you ever been refused a
                        Visa for any country?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.refused_any_visa }}
                    </td>
                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">Have you been granted a UK Visa
                        in the last 10 years?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.granted_uk_visa }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">Have you been refused entry on
                        arrival to the UK in the last 10 years?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.refused_entry_uk }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">Have you ever been deported,
                        removed or otherwise required to leave the UK?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.deported_uk }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">Have you ever been
                        deported, removed or otherwise required to leave any other country?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.deported_other_country }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">Have you made an
                        application to the UK Home Office to remain in the UK in the last 10 years?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.applied_home_office }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">Have you ever
                        been in breach of your Immigration conditions for the UK?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.breach_immigration_conditions }}
                    </td>
                </tr>


                <tr>
                    <td class="font-semibold p-2 w-1/2">
                        Do you have any criminal
                        convictions in any country (including traffic offences)?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.criminal_convictions }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">

                        Have you ever been
                        charged in any country with a criminal offence for which you have not yet been tried in a court
                        (including traffic offences)?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.charged_criminal_offence }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">
                        In times of either peace
                        or war, have you ever been involved in or suspected of involvement in war crimes, crimes against
                        humanity or genocide?</td>
                    <td class="p-2">
                        {{ props.student.immigration_details.involved_in_war_crimes }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">
                        Have you ever been
                        involved in, supported or encouraged terrorist activity in any country?
                    </td>
                    <td class="p-2">
                        {{ props.student.immigration_details.involved_in_terrorism }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">
                        Have you engaged in
                        any other activities that might include any which may mean you may not be considered a person of
                        good
                        character?
                    </td>
                    <td class="p-2">
                        {{ props.student.immigration_details.activities_bad_character }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">
                        Have you at any point in
                        the past had treatment via the UK National Health Service to the value in excess of £1000 which
                        may
                        remain unpaid?
                    </td>
                    <td class="p-2">
                        {{ props.student.immigration_details.nhs_treatment_unpaid }}
                    </td>
                </tr>

                <tr>
                    <td class="font-semibold p-2 w-1/2">
                        Have you ever worked for the following types of organisations?

                    </td>
                    <td class="p-2">
                        {{ props.student.immigration_details.organization_type }}
                    </td>
                </tr>


            </tbody>
        </table>
    </div>
</template>