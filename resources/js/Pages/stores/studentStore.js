import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3';
import { useToast } from "vue-toast-notification";
import { ref } from "vue";
export const useStudentStore = defineStore("studentform", {
  state: () => ({
    student: useForm({
      id: "",
      choice_of_country: "",
      intake: "",
      intended_course: "",
      firstname: "",
      middlename: "",
      surname: "",
      nickname: "",
      email: "",
      gender: "",
      nationality: "",
      date_of_birth: "",
      place_of_birth: "",
      national_insurance: "",
      other_nationalities: "",
      marital_status: "",
      criminal_conviction: "",
      police_clearance: "",
      disability: "",
      fircopy: "",
      living_situation: "",
      correspondence_address: "",
      FinancialDetails: {
        own_property: "",
        bank_savings: "",
        tuition_budget: "",
        bank_funds: "",
        tuition_payer: "",
      },
      StudentEmployment: [
        {
          personal_circumstances: "",
          employment_details: "",
          present_work: "",
          company_name: "",
          job_start_date: "",
          work_address: "",
          employer_phone: "",
          employer_email: "",
          additional_jobs
        }
      ],
      IncomeDetails: {
        monthly_income: 0,
        income_from_others: "",
        other_income_sources: "",
        monthly_income_given_to_family: 0,
        monthly_living_costs: 0,
      },
      References: [{ name: "", phone: "", email: "", position: "", relationship: "", duration: "" }],
      FinancialDocuments: [
        { document_title: "", document_name: "", document_path }
    ],
      PassportDetails: {
        passport_number: "",
        place_of_issue: "",
        issuing_authority: "",
        date_of_issue: "",
        date_of_expiry: "",
      },
      FirstPassportDetails: {
        previous_ppt_number: "",
        place_of_issue_previous: "",
        issuing_authority_previous: "",
        date_of_issue_previous: "",
        date_of_expiry_previous: "",
        national_id_number: "",
      },
      ContactDetails: {
        address: "",
        postal_code: "",
        how_long_lived: "",
        home_number: "",
        mobile_number: "",
        email_address: "",
        contact_during_application: "",
        main_address_uk: "",
        ownership_status: "",
      },
      ParentsDetails: {
        father: {
          given_name: "",
          family_name: "",
          date_of_birth: "",
          place_of_birth: "",
          nationality: "",
        },
        mother: {
          given_name: "",
          family_name: "",
          date_of_birth: "",
          place_of_birth: "",
          nationality: "",
        },
      },
      TravelDetails: {
        travel_date: "",
      },
      OtherInformationDetails: {
        family_in_uk: "",
        travelling_with_others: "",
      },
      QualificationsDetails: {
        qualifications: "",
        study_institution: "",
        subjects_studied: "",
        date_passed: "",
        study_gap_after_last_degree: "",
        can_you_justify_gap: "",
      },
      ImmigrationDetails: {
        travel_outside: "",
        travel_uk: "",
        refused_uk_visa: "",
        refused_any_visa: "",
        granted_uk_visa: "",
        refused_entry_uk: "",
        deported_uk: "",
        deported_other_country: "",
        applied_home_office: "",
        breach_immigration_conditions: "",
        criminal_convictions: "",
        charged_criminal_offence: "",
        involved_in_war_crimes: "",
        involved_in_terrorism: "",
        activities_bad_character: "",
        nhs_treatment_unpaid: "",
        organization_type: "",
      },
      UkVisaHistoryDetails: {
        visa_type: "",
        visa_valid_from: "",
        visa_expiry_date: "",
        visa_reference_number: "",
      },
      OverseasTravelHistoryDetails: {
        uk_country_visited: "",
        uk_date_arrived: "",
        uk_purpose_of_visit: "",
        uk_length_of_stay: "",
        europe_country_visited: "",
        europe_date_arrived: "",
        europe_purpose_of_visit: "",
        europe_length_of_stay: "",
        acnz_usa_country_visited: "",
        acnz_usa_date_arrived: "",
        acnz_usa_purpose_of_visit: "",
        acnz_usa_length_of_stay: "",
        row_country_visited: "",
        row_date_arrived: "",
        row_purpose_of_visit: "",
        row_length_of_stay: "",
      },
      SpousePartnersNotAccompanyingDetails: {
        spouse_given_name: "",
        spouse_family_name: "",
        spouse_passport_number: "",
        spouse_location: "",
        spouse_dob: "",
        spouse_nationality: "",
        spouse_accompanying_uk: "",
      },
      Children: [
        {
          full_name: "",
          gender: "",
          dob: "",
          place_of_birth: "",
          nationality: "",
          accompanying_uk: false,
          current_address: "",
          passport_number: "",
        },
      ],
      SpousePartnersAccompanyingDetails: {
        spouse_father_given_name: "",
        spouse_father_family_name: "",
        father_dob: "",
        father_place_of_birth: "",
        spouse_mother_given_name: "",
        spouse_mother_family_name: "",
        mother_dob: "",
        mother_place_of_birth: "",
        spouse_visa_valid_from: "",
        spouse_visa_expiry_date: "",
        spouse_visa_type: "",
        spouse_travel_history: "",
      },
      RequirmentsForEuropeDetails: {
        do_you_have_block_account: "",
        have_you_legalised_documents: "",
        bonafide_student_undertaking: "",
      },
      DocumentRequired: {
        file_title: "",
        file_name: "",  
        file_path: "" 
      },
      CheckCopyDetails: {
        copy_current_passport: false,
        copy_any_current_previous_uk_visas: false,
        copy_any_previous_passports: false,
        remarks: "",
      },
    }),

    showModal: ref(false),
    studentIdToDelete: ref(null),
    errors: {},
    countries: [],
    selectedCountry: null,
    isOpen: false,
    totalStudents: ref(0),
    
  }),
  

  actions: {
    
    async addStudentForm() {
      const toast = useToast();
      try {
        await this.student.post(route("students.store"), {
          onSuccess: () => {
            toast.success("Student added successfully!");
          },
          onError: (errors) => {
            toast.error("Failed to add student.");
            console.error("Validation errors:", errors);
          },
        });
      } catch (error) {
        toast.error("An unexpected error occurred.");
        console.error("Error adding student:", error);
      }
    },

    setStudent(data) {
      this.student = { ...this.student, ...data };
    },
    async editStudentForm() {
      const toast = useToast();
    
      try {
        await Inertia.put(route('students.update', this.student.id),{
          preserveScroll: true,
          onSuccess: () => {
            toast.success("Student updated successfully!");
            router.get(route('students.edit', this.student.id));
          },
          onError: (errors) => {
            toast.error("Failed to update student.");
            console.error("Validation errors:", errors);
            this.errors = errors;
          }
        });
      } catch (error) {
        toast.error("An unexpected error occurred.");
        console.error("Error updating student:", error);
      }
    },
      
      updateStudentField(field, value) {
        this.student[field] = value;
      },
      
    confirmDelete(studentId) {
      this.studentIdToDelete = studentId;
      this.showModal = true;
    },

    async handleDelete() {
      this.showModal = false;
      try {
         router.delete(route("students.destroy", this.studentIdToDelete), {
          onSuccess: () => {
            router.visit(route("students.index"), {
              preserveScroll: true,
              replace: true,
            });
          },
          onError: (error) => {
            console.error("Error deleting student:", error);
          },
        });
      } catch (error) {
        console.error("Error deleting student:", error);
      }
    },

    setFormField(field, value) {
        this.student[field] = value;
        this.clearError(field);
      },
      
      setError(field, message) {
        this.errors[field] = message;
      },
  
      clearError(field) {
        if (this.student.errors[field]) {
          delete this.student.errors[field]; 
        }
      },
      
      validateField(field) {
        if (!this.student[field] || this.student[field].trim() === '') {
          this.setError(field, `${field} is required.`);
          return false;
        }
        this.clearError(field);
        return true;
      },
  
      async fetchCountries() {
        try {
          const response = await fetch('https://restcountries.com/v3.1/all');
          const data = await response.json();
          this.countries = data
            .sort((a, b) => a.name.common.localeCompare(b.name.common))
            .map((country) => {
              const callingCode = country.idd?.root && country.idd?.suffixes
                ? `${country.idd.root}${country.idd.suffixes[0]}`
                : null;
  
              return callingCode && country.name.common
                ? {
                    code: callingCode,
                    name: country.name.common,
                    flag: country.flags?.svg || country.flags?.png || '',
                  }
                : null;
            })
            .filter(Boolean);
        } catch (error) {
          console.error('Error fetching countries:', error);
        }
      },
  
      selectCountry(country) {
        this.selectedCountry = country;
        this.student.choice_of_country = country.name;
        this.isOpen = false;
        this.clearError('choice_of_country');
      },
  
      toggleDropdown() {
        this.isOpen = !this.isOpen;
      },

      addReference() {
        this.References.push({
          name: "",
          phone: "",
          email: "",
          position: "",
          relationship: "",
          duration: "",
        });
      },
      
      removeReference(index) {
        if (this.References.length > 0) {
          this.student.References.splice(index, 1);
        }
      },

      addChild() {
        this.student.Children.push({
          full_name: "",
          gender: "",
          dob: "",
          place_of_birth: "",
          nationality: "",
          accompanying_uk: false,
          current_address: "",
          passport_number: "",
        });
      },
      removeChild(index) {
        if (this.student.Children.length > 1) {
          this.student.Children.splice(index, 1);
        }
      },

      addFinancialDocument() {
        if (!this.student.Documents) {
          this.student.Documents = [];
        }
        this.student.Documents.push({
          document_name: "",
          file_url: "",
        });
      },
    
      removeFinancialDocument(index) {
        if (this.student.Documents.length > 0) {
          this.student.Documents.splice(index, 1);
        }
      },

      addJob() {
        this.jobs.push({
          personal_circumstances: "",
          employment_details: "",
          present_work: "",
          company_name: "",
          job_start_date: "",
          work_address: "",
          employer_phone: "",
          employer_email: "",
          additional_jobs: "",
        });
      },
      removeJob(index) {
        if (this.jobs.length > 1) {
          this.jobs.splice(index, 1);
        }
      },

      persist: {
        enabled: true,
        strategies: [
          {
            key: "studentform",
            storage: localStorage,
          },
        ],
      },
     
      
  },
});