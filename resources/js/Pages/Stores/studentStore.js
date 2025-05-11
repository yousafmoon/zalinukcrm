import { defineStore } from "pinia";
import { useForm, router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import { Inertia } from '@inertiajs/inertia';

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
      living_situation: "",
      correspondence_address: "",
      financialDetails: {
        own_property: "",
        bank_savings: "",
        tuition_budget: "",
        bank_funds: "",
        tuition_payer: "",
        errors: {}
      },
      
      studentEmployment: [
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
      incomeDetails: {
        monthly_income: "",
        income_from_others: "",
        other_income_sources: "",
        monthly_income_given_to_family: "",
        monthly_living_costs: "",
      },
      studentReferences: [{ name: "", phone: "", email: "", position: "", relationship: "", duration: "" }],
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
    isRemoving: ref(false),
    selectedFile: null,
    fileSizeError: null,
    
  }),
  
  actions: {
  setStudent(student) {
  if (!student) {
    this.student = {
      ...this.student, 
    };
    return;
  }

  const financialDetails = {
    ...this.defaultFinancialDetails(),
    ...(this.student.financialDetails || {}),
    ...(student.financialDetails || {}),
  };

  const incomeDetails = {
    ...this.defaulIncomeDetails(),
    ...(this.student.incomeDetails || {}),
    ...(student.incomeDetails || {}),
  };

  const studentEmployment = Array.isArray(student.studentEmployment)
    ? student.studentEmployment.map((job, index) => ({
        ...this.defaultStudentEmployment(),
        ...(this.student.studentEmployment?.[index] || {}),
        ...job,
      }))
    : (this.student.studentEmployment || []);

      const studentReferences = Array.isArray(student.studentReferences)
    ? student.studentReferences.map((reference,index) => ({
        ...this.defaultstudentReferences(),
        ...(this.student.studentReferences?.[index] || {}),
        ...reference
      }))
    : (this.student.studentReferences || []);

  this.student = {
    ...this.student,
    ...student,
    financialDetails,
    incomeDetails,
    studentEmployment,
    studentReferences,
  };
},
    
  defaultFinancialDetails() {
      return {
          own_property: '',
          bank_savings: '',
          tuition_budget: '',
          bank_funds: '',
          tuition_payer: '',
          errors: {}
      };
  },

    defaulIncomeDetails() {
      return {
          monthly_income: '',
          income_from_others: '',
          monthly_income_given_to_family: '',
          monthly_income_given_to_family: '',
          monthly_living_costs: '',
          errors: {}
      };
  },
  defaultStudentEmployment() {
  return {
    personal_circumstances: '',
    employment_details: '',
    present_work: '',
    company_name: '',
    job_start_date: '',
    work_address: '',
    employer_phone: '',
    employer_email: '',
    additional_jobs: '',
    errors: {}
  };
},
 defaultstudentReferences() {
  return {
    name: '',
    phone: '',
    email: '',
    position: '',
    relationship: '',
    duration: '',
    errors: {}
  };
},


 async addStudentForm() {
      const toast = useToast();
      const formData = new FormData();
      for (const key in this.student) {
        if (key === "FinancialDetails") {
          formData.append("FinancialDetails", JSON.stringify(this.student.financialDetails));
        } else if (key === "StudentEmployment") {
          formData.append("StudentEmployment", JSON.stringify(this.student.studentEmployment));
        } else if (key==='IncomeDetails') {
          formData.append("IncomeDetails", JSON.stringify(this.student.incomeDetails));
        } else if(key==='studentReferences') {
          formData.append("studentReferences".JSON.stringify(this.student.studentReferences));
        } else {
          formData.append(key, this.student[key]);
        }
      }

      try {
        this.student.post(route("students.store"), formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        });

        toast.success("Student added successfully!");
      } catch (error) {
        toast.error("Failed to add student.");
        console.error("Form submission error:", error);
      }
    },

  updateStudentForm() {
    const toast = useToast();

    if (!this.student || !this.student.id) {
      toast.error("Student data is missing.");
      return;
    }

    Inertia.put(route('students.update', this.student.id), this.student, {
      onSuccess: () => {
        toast.success("Student updated successfully.");
         router.visit(route('students.edit'), {
                      preserveScroll: true,
                      replace: true,
                  });
      },
      onError: (errors) => {
        console.error(errors);
        toast.error("Failed to update student.");
      }
    });
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
          await this.student.delete(route('students.destroy', { student: studentId }), {
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

          addstudentEmployment() {
        this.student.studentEmployment.push(this.emptyJob());
    },

    removestudentEmployment(index) {
        if (this.student.studentEmployment.length > 1) {
            this.student.studentEmployment.splice(index, 1);
        }
    },


  emptyJob() {
      return {
          personal_circumstances: '',
          employment_details: '',
          present_work: '',
          company_name: '',
          job_start_date: '',
          work_address: '',
          employer_phone: '',
          employer_email: '',
          additional_jobs: ''
      };
  },

      addstudentReference() {
        this.student.studentReferences.push({
          name: "",
          phone: "",
          email: "",
          position: "",
          relationship: "",
          duration: "",
        });
      },
      
      removestudentReference(index) {
          this.student.studentReferences.splice(index, 1);
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
          this.student.Childrens.splice(index, 1);
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
            this.student.OverseasTravelHistoryDetails.splice(index, 1);
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
            this.student.OverseasTravelHistoryDetails[regionIndex].visits.splice(visitIndex, 1);
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
          this.student.FinancialDocuments.splice(index, 1);
      },
  
      handleFileChange(event, index) {
        const file = event.target.files[0];
        if (file) {
          this.student.FinancialDocuments[index].document_name = file.name;
          this.student.FinancialDocuments[index].document_path = URL.createObjectURL(file);
        }
      },

  },
});