<script setup>
import { onMounted, computed, watch, ref } from 'vue';
import { useStudentStore } from '@/Stores/studentStore';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    student: Object
});

const formStore = useStudentStore();

onMounted(async () => {
    await formStore.fetchCountries();

    if (props.student) {
        formStore.student = { ...props.student };
        setSelectedCountry(props.student.choice_of_country);
    }
});

watch(() => props.student, async (newStudent) => {
    if (newStudent) {
        formStore.student = { ...newStudent };
        await formStore.fetchCountries();
        setSelectedCountry(newStudent.choice_of_country);
    }
}, { deep: true });

const selectedCountry = computed(() => formStore.selectedCountry);
const countries = computed(() => formStore.countries);
const isOpen = computed(() => formStore.isOpen);

const selectCountry = (country) => {
    formStore.selectCountry(country);
    formStore.student.choice_of_country = country.name;
};

const setSelectedCountry = (countryName) => {
    if (countryName && formStore.countries.length > 0) {
        const country = formStore.countries.find(c => c.name === countryName);
        if (country) {
            formStore.selectCountry(country);
        }
    }
};

const selectedFile = ref(null);
const handleFileUpload = (event) => {
    selectedFile.value = event.target.files[0];
};

const getFileUrl = (filePath) => {
    return filePath ? `/storage/${filePath}` : "#";
};

const getFileName = (filePath) => {
    return filePath ? filePath.split("/").pop() : "No file";
};

</script>

<template v-bind="$attrs">
    <div class="grid grid-cols-12 gap-6">
        <!-- Country Selection -->
        <div class="col-span-6 sm:col-span-3 md:col-span-4">
            <label for="choice_of_country" class="block text-sm font-medium text-gray-700">
                Choice of Country
            </label>
            <div class="relative mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                @click="formStore.toggleDropdown">
                <div class="flex items-center">
                    <img :src="selectedCountry?.flag" v-if="selectedCountry?.flag" alt="Selected country flag"
                        class="inline-block w-6 h-4 mr-2" />
                    <span>{{ selectedCountry?.name || "Select a country" }}</span>
                </div>
            </div>

            <ul v-if="isOpen"
                class="absolute mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 max-h-64 overflow-y-auto">
                <li v-for="country in countries" :key="country.code" @click="selectCountry(country)"
                    class="flex items-center px-3 py-2 cursor-pointer hover:bg-gray-100">
                    <img :src="country.flag" alt="Country flag" class="inline-block w-6 h-4 mr-2" />
                    {{ country.name }} ({{ country.code }})
                </li>
            </ul>

            <input type="hidden" :value="selectedCountry?.name || ''" name="choice_of_country" id="choice_of_country"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.choice_of_country }"
                @input="formStore.clearError('choice_of_country')" />

            <InputError :message="formStore.student.errors.choice_of_country" class="mt-2" />
        </div>


        <!-- Intake -->
        <div class="col-span-6 sm:col-span-3 md:col-span-4">
            <label for="intake" class="block text-sm font-medium text-gray-700">Intake</label>
            <input name="intake" v-model="formStore.student.intake" type="date" id="intake" placeholder="Enter intake"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.intake }"
                @input="formStore.clearError('intake')" />
            <InputError :message="formStore.student.errors.intake" class="mt-2" />
        </div>

        <!-- Intended Course -->
        <div class="col-span-6 sm:col-span-3 md:col-span-4">
            <label for="intended_course" class="block text-sm font-medium text-gray-700">Intended Course</label>
            <input name="intended_course" v-model="formStore.student.intended_course" type="text" id="intended_course"
                placeholder="Enter intended course"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.intended_course }"
                @input="formStore.clearError('intended_course')" />
            <InputError :message="formStore.student.errors.intended_course" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="firstname" class="block text-sm font-medium text-gray-700">First Name</label>
            <input name="firstname" v-model="formStore.student.firstname" type="text" id="firstname"
                placeholder="Enter first name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.firstname }"
                @input="formStore.clearError('firstname')" />
            <InputError :message="formStore.student.errors.firstname" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="middlename" class="block text-sm font-medium text-gray-700">Middle Name</label>
            <input v-model="formStore.student.middlename" name="middlename" type="text" id="middlename"
                placeholder="Enter middle name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.middlename }" />
            <InputError :message="formStore.student.errors.middlename" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="surname" class="block text-sm font-medium text-gray-700">Surname</label>
            <input v-model="formStore.student.surname" type="text" name="surname" id="surname"
                placeholder="Enter surname"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.surname }" />
            <InputError :message="formStore.student.errors.surname" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="nickname" class="block text-sm font-medium text-gray-700">Nick Name</label>
            <input v-model="formStore.student.nickname" type="text" name="nickname" id="nickname"
                placeholder="Enter nick name"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.nickname }" />
            <InputError :message="formStore.student.errors.nickname" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select id="gender" name="gender" v-model="formStore.student.gender"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.gender }">
                <option value="">Select a gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <InputError :message="formStore.student.errors.gender" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input name="email" v-model="formStore.student.email" type="email" id="email" placeholder="Enter email"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.email }"
                @input="formStore.clearError('email')" />
            <InputError :message="formStore.student.errors.email" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
            <input v-model="formStore.student.nationality" type="text" name="nationality" id="nationality"
                placeholder="Enter nationality"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.nationality }" />
            <InputError :message="formStore.student.errors.nationality" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input v-model="formStore.student.date_of_birth" name="date_of_birth" type="date" id="date_of_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth</label>
            <input v-model="formStore.student.place_of_birth" name="place_of_birth" type="text" id="place_of_birth"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter place of birth" />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-3">
            <label for="national_insurance" class="block text-sm font-medium text-gray-700">UK National Insurance
                Number</label>
            <input v-model="formStore.student.national_insurance" name="national_insurance" type="text"
                id="national_insurance"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter uk national insurance number" />
        </div>
        <div class="col-span-6 sm:col-span-6 md:col-span-6">
            <label for="other_nationalities" class="block text-sm font-medium text-gray-700">
                Do you or have you ever held any other nationalities? If YES, please specify:
            </label>
            <input v-model="formStore.student.other_nationalities" name="other_nationalities" type="text"
                id="other_nationalities"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Please enter any other nationalities " />
        </div>
        <div class="col-span-6 sm:col-span-3 md:col-span-4">
            <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital Status</label>
            <select v-model="formStore.student.marital_status" id="marital_status" name="marital_status"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm">
                <option value="">Select an option</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="unmarried_partner">Unmarried Partner</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-4">
            <label for="criminal_conviction" class="block text-sm font-medium text-gray-700">
                Do you have any criminal convictions?
            </label>

            <select id="criminal_conviction" name="criminal_conviction" v-model="formStore.student.criminal_conviction"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.criminal_conviction }">
                <option value="">Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <InputError :message="formStore.student.errors.criminal_conviction" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-4">
            <label for="police_clearance" class="block text-sm font-medium text-gray-700">
                Do you have Police Clearance Certificate/DBS Check?
            </label>
            <select id="police_clearance" name="police_clearance" v-model="formStore.student.police_clearance"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.police_clearance }">
                <option value="">Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
            <InputError :message="formStore.student.errors.police_clearance" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="disability" class="block text-sm font-medium text-gray-700">
                Do you have any Disability? (If yes, please specify)
            </label>
            <div class="mt-1">
                <select id="disability" name="disability" v-model="formStore.student.disability"
                    class="block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                    :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.disability }">
                    <option value="">Select an option</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </div>

            <InputError :message="formStore.student.errors.disability" class="mt-2" />
        </div>


        <div class="col-span-6 sm:col-span-3 md:col-span-6">
            <label for="fircopy" class="block text-sm font-medium text-gray-700">
                If you lost/stolen your passport (please upload police complaint report/FIR)?
            </label>

            <input type="file" id="fircopy" name="fircopy" @change="handleFileUpload"
                class="mt-1 block w-full text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.fircopy }"
                accept=".pdf,.jpg,.jpeg,.png" />
            <small class="text-gray-500">Accepted formats: PDF, JPG, JPEG, PNG</small>

            <!-- Show selected file name -->
            <p v-if="selectedFile" class="mt-2 text-green-600 text-sm">
                File Selected: {{ selectedFile.name }}
            </p>

            <div v-if="formStore.student.fircopy" class="mt-2">
                <p class="text-gray-700 text-sm">Current File:</p>
                <a :href="getFileUrl(formStore.student.fircopy)" target="_blank" class="text-blue-600 hover:underline">
                    {{ getFileName(formStore.student.fircopy) }}
                </a>
            </div>

            <InputError :message="formStore.student.errors.fircopy" class="mt-2" />
        </div>



        <div class="col-span-6 sm:col-span-6 md:col-span-12">
            <label for="living_situation" class="block text-sm font-medium text-gray-700">
                Give more details about your living situation, such as who you live with and who owns the property
            </label>

            <textarea id="living_situation" name="living_situation" v-model="formStore.student.living_situation"
                rows="4"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Provide details about your living situation"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.living_situation }"></textarea>
            <InputError :message="formStore.student.errors.living_situation" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-6 md:col-span-12">
            <label for="correspondence_address" class="block text-sm font-medium text-gray-700">
                Correspondence address (If different than home address)
            </label>

            <textarea id="correspondence_address" name="correspondence_address"
                v-model="formStore.student.correspondence_address" rows="3"
                class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500 sm:text-sm"
                placeholder="Enter your correspondence address"
                :class="{ 'text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300': formStore.student.errors.correspondence_address }"></textarea>
            <InputError :message="formStore.student.errors.correspondence_address" class="mt-2" />
        </div>
    </div>
</template>