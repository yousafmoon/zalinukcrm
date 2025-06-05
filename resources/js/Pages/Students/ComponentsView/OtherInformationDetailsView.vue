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
        OTHER INFORMATION
    </h3>


    <div v-if="props.student && props.student.other_information_details">
        <table class="w-full table-auto border border-gray-300 text-sm">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">
                        Do you have any immediate family in the UK?
                    </td>

                    <td class="p-2">{{ props.student.other_information_details.family_in_uk }}</td>

                </tr>

                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">
                        Will you be travelling to the UK with someone who is NOT your partner, spouse, or dependent?
                    </td>
                    <td class="p-2">{{ props.student.other_information_details.travelling_with_others }}</td>

                </tr>
            </tbody>
        </table>
    </div>
</template>