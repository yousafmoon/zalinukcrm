import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { Inertia } from '@inertiajs/inertia';
import { router } from '@inertiajs/vue3';
import { useToast } from "vue-toast-notification";
import { ref } from "vue";
export const useStudentStore = defineStore("student", {
  
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
      own_property: "",
      bank_savings: "",
      tuition_budget: "",
      bank_funds: "",
      tuition_payer: "",
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
          additional_jobs: ""
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
        { document_title: "", document_name: "", document_path: "" }
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
      OverseasTravelHistoryDetails: [
        {
            region_title: '',
            visits: [
                {
                    country_visited: '',
                    date_arrived: '',
                    purpose_of_visit: '',
                    length_of_stay: ''
                }
            ]
        }
    ],
      SpousePartnersNotAccompanyingDetails: {
        spouse_given_name: "",
        spouse_family_name: "",
        spouse_passport_number: "",
        spouse_location: "",
        spouse_dob: "",
        spouse_nationality: "",
        spouse_accompanying_uk: "",
      },
      Childrens: [
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
      DocumentsRequired: {
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
    countries: ref([]),
    isOpen: ref(false),
    selectedCountry: ref(null),
    totalStudents: ref(0),
    
  }),
  

  actions: {

    handleFileUpload(event) {
      const file = event.target.files[0];
      if (!file) {
        this.selectedFile = null;
        this.student.fircopy = null;
        this.fileSizeError = null;
        return;
      }
      const maxSize = 2 * 1024 * 1024; // 2MB limit
      if (file.size > maxSize) {
        this.fileSizeError = "File size must be less than 2MB.";
        this.selectedFile = null;
        this.student.fircopy = null;
        event.target.value = "";
        return;
      }
      this.fileSizeError = null;
      this.selectedFile = file;
      // Assign the raw File object for submission.
      this.student.fircopy = file;
    },
    
  
    removeFile() {

      this.selectedFile = null;
      this.student.fircopy = null;
      this.fileSizeError = null;
      const fileInput = document.querySelector("#fircopy");
      if (fileInput) {
        fileInput.value = "";
      }
    },
    
  
    getFileUrl(file) {
      if (!file) return "";
      return file instanceof File ? URL.createObjectURL(file) : `/storage/${file}`;
  },

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
      this.student = { ...this.student, ...data, errors: data.errors || {} };
  },
  
  async updateStudentForm() {
    const toast = useToast();

    if (!this.student.id) {
        toast.error("Student ID is missing.");
        console.error("Student ID is undefined or null.");
        return;
    }

    try {
        const updateUrl = route('students.update', { student: this.student.id });
        Inertia.put(updateUrl, this.student, {
            onSuccess: () => {
                toast.success("Student updated successfully.");
                router.visit(route('students.index'), {
                    preserveScroll: true,
                    replace: true,
                });
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

    async handleDelete(studentId) {
      const toast = useToast();
      try {
          await Inertia.delete(route('students.destroy', { student: studentId }), {
              onSuccess: () => {
                  toast.success("Student deleted successfully.");
                  router.visit(route('students.index'), {
                      preserveScroll: true,
                      replace: true,
                  });
              },
              onError: (error) => {
                  toast.error("Failed to delete student.");
                  console.error("Error deleting student:", error);
              }
          });
      } catch (error) {
          toast.error("An unexpected error occurred.");
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
        if (this.student.errors && this.student.errors[field]) {
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
        this.student.choice_of_country = country?.name ? String(country.name).trim() : null;
        this.isOpen = false;
        this.clearError('choice_of_country');
      },  
      
      toggleDropdown() {
        this.isOpen = !this.isOpen;
      },

      addReference() {
        this.student.References.push({
          name: "",
          phone: "",
          email: "",
          position: "",
          relationship: "",
          duration: "",
        });
      },
      
      removeReference(index) {
        if (this.student.References.length > 0) {
          this.student.References.splice(index, 1);
        }
      },

      addChild() {
        this.student.Childrens.push({
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
        if (this.student.Childrens.length > 0) {
          this.student.Childrens.splice(index, 1);
        }
      },
      addRegion() {
        this.student.OverseasTravelHistoryDetails.push({
            region_title: '',
            visits: [
                {
                    country_visited: '',
                    date_arrived: '',
                    purpose_of_visit: '',
                    length_of_stay: ''
                }
            ]
        });
    },
    removeRegion(index) {
        if (this.student.OverseasTravelHistoryDetails.length > 1) {
            this.student.OverseasTravelHistoryDetails.splice(index, 1);
        }
    },
    addVisit(regionIndex) {
        this.student.OverseasTravelHistoryDetails[regionIndex].visits.push({
            country_visited: '',
            date_arrived: '',
            purpose_of_visit: '',
            length_of_stay: ''
        });
    },
    removeVisit(regionIndex, visitIndex) {
        if (this.student.OverseasTravelHistoryDetails[regionIndex].visits.length > 1) {
            this.student.OverseasTravelHistoryDetails[regionIndex].visits.splice(visitIndex, 1);
        }
    },

      addFinancialDocument() {
        if (!this.student.FinancialDocuments) {
          this.student.FinancialDocuments = [];
        }
        this.student.FinancialDocuments.push({
          document_title: "",
          document_name: "",
          document_path: ""
        });
      },
  
      removeFinancialDocument(index) {
        if (this.student.FinancialDocuments.length > 0) {
          this.student.FinancialDocuments.splice(index, 1);
        }
      },
  
      handleFileChange(event, index) {
        const file = event.target.files[0];
        if (file) {
          this.student.FinancialDocuments[index].document_name = file.name;
          this.student.FinancialDocuments[index].document_path = URL.createObjectURL(file);
        }
      },

      addStudentEmployment() {
        this.student.StudentEmployment.push({
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
      removeStudentEmployment(index) {
        if (this.student.StudentEmployment.length > 0) {
          this.student.StudentEmployment.splice(index, 1);
        }
      },

      persist: {
        enabled: true,
        strategies: [
          {
            key: "student",
            storage: localStorage,
          },
        ],
      },
     
      
  },
});