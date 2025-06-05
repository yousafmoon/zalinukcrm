<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { watchEffect } from 'vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();
watchEffect(() => {
    formStore.student = props.student;
});
</script>

<template>
    <h3 class="text-lg leading-6 font-medium text-red-700">
        YOUR CHILDREN (IRRESPECTIVE OF AGE)
    </h3>

    <div v-if="props.student && props.student.children_details">

        <div v-for="(child, index) in props.student.children_details" :key="index"
            class="mt-4 border rounded-lg p-4 shadow bg-white relative">

            <!-- Heading -->
            <h3 class="text-lg font-medium text-red-700 mb-2">
                Child {{ index + 1 }}
            </h3>

            <!-- Table Format -->
            <table class="w-full table-auto border border-gray-300 text-sm">
                <tbody>
                    <tr class="border-b">
                        <td class="font-semibold p-2 w-1/2">Full Name</td>
                        <td class="p-2">{{ child.child_full_name }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Gender</td>
                        <td class="p-2">{{ child.child_gender }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Date of Birth</td>
                        <td class="p-2">{{ child.child_dob }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Place of Birth</td>
                        <td class="p-2">{{ child.child_place_of_birth }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Nationality</td>
                        <td class="p-2">{{ child.child_nationality }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Accompanying to UK</td>
                        <td class="p-2">{{ child.child_accompanying_uk }}</td>
                    </tr>
                    <tr class="border-b">
                        <td class="font-semibold p-2">Current Address</td>
                        <td class="p-2">{{ child.child_current_address }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold p-2">Passport Number</td>
                        <td class="p-2">{{ child.child_passport_number }}</td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>
