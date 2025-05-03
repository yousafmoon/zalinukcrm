<script setup>
import { useStudentStore } from '@/Pages/Stores/studentStore';
import { watch } from 'vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();

watch(() => props.student, (newStudent) => {
    if (newStudent) {
        formStore.setStudent({
            ...newStudent,
            studentEmployment: newStudent.studentEmployment?.length
                ? newStudent.studentEmployment
                : [formStore.emptyJob()]
        });
    }
}, { immediate: true, deep: true });

const addJob = () => formStore.addstudentEmployment();
const removeJob = (index) => formStore.removestudentEmployment(index);
</script>

<template>
    <div>
        <h3 class="text-lg leading-6 font-medium text-red-700">WORK HISTORY</h3>
    </div>

    <div class="grid grid-cols-12">
        <label class="block text-sm font-medium text-gray-700 col-span-12">
            What are your current personal circumstances?
        </label>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Job Entries -->
        <div v-for="(job, index) in formStore.student.studentEmployment" :key="index"
            class="col-span-12 grid grid-cols-12 gap-6 border p-4 rounded-md shadow-md relative">

            <!-- Add & Remove Buttons -->
            <div class="absolute top-1 right-1 flex space-x-2">
                <button @click="addJob" type="button"
                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">+
                </button>
                <button @click="removeJob(index)" type="button" v-if="formStore.student.studentEmployment.length > 1"
                    class="bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition">-
                </button>
            </div>

            <!-- Personal Circumstances -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <div class="mt-1 space-y-2">
                    <label class="inline-flex items-center">
                        <input type="radio" v-model="job.personal_circumstances" value="Employed full time"
                            class="form-radio text-red-500">
                        <span class="ml-2 text-sm">Employed full time</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" v-model="job.personal_circumstances" value="Self employed"
                            class="form-radio text-red-500">
                        <span class="ml-2 text-sm">Self employed</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" v-model="job.personal_circumstances" value="Student"
                            class="form-radio text-red-500">
                        <span class="ml-2 text-sm">Student</span>
                    </label>
                </div>
            </div>

            <!-- Employment Details -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Employment Details</label>
                <input type="text" v-model="job.employment_details"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>

            <!-- Present Work -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Present Work</label>
                <input type="text" v-model="job.present_work"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>

            <!-- Company Name -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Company Name</label>
                <input type="text" v-model="job.company_name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>

            <!-- Start Date -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Start Date</label>
                <input type="date" v-model="job.job_start_date"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>

            <!-- Work Address -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Work Address</label>
                <textarea v-model="job.work_address" rows="2"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
            </div>

            <!-- Employer Phone -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Employer Phone</label>
                <input type="tel" v-model="job.employer_phone"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>

            <!-- Employer Email -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Employer Email</label>
                <input type="email" v-model="job.employer_email"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm">
            </div>

            <!-- Additional Jobs -->
            <div class="col-span-12 sm:col-span-6 md:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Additional Jobs</label>
                <textarea v-model="job.additional_jobs" rows="2"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-red-500 focus:border-red-500 sm:text-sm"></textarea>
            </div>
        </div>
    </div>
</template>