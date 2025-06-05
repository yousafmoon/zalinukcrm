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
        DATES OF TRAVEL
    </h3>

    <div v-if="props.student && props.student.travel_details">
        <table class="w-full table-auto border border-gray-300 text-sm">
            <tbody>
                <tr class="border-b">
                    <td class="font-semibold p-2 w-1/2">
                        What date do you hope to travel to the UK?
                    </td>
                    <td class="p-2">{{ props.student.travel_details.travel_date }}</td>

                </tr>
            </tbody>
        </table>
    </div>

</template>