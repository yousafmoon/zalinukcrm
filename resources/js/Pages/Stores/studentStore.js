import { defineStore } from "pinia";
import { useForm, router } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import { reactive, ref } from "vue";

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
      studentReferences: [{ ref_name: "", ref_phone: "", ref_email: "", ref_position: "", ref_relationship: "", ref_duration: "" }],
      requiredDocuments: [
        { document_title: "", document_name: "", document_path: "", file: null }
    ],
      passportDetails: {
        passport_number: "",
        place_of_issue: "",
        issuing_authority: "",
        date_of_issue: "",
        date_of_expiry: "",
      },
      firstpassportDetails: {
        previous_ppt_number: "",
        place_of_issue_previous: "",
        issuing_authority_previous: "",
        date_of_issue_previous: "",
        date_of_expiry_previous: "",
        national_id_number: "",
      },
      contactDetails: {
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
      parentsDetails: {
          father_given_name: "",
          father_family_name: "",
          father_date_of_birth: "",
          father_place_of_birth: "",
          father_nationality: "",
          mother_given_name: "",
          mother_family_name: "",
          mother_date_of_birth: "",
          mother_place_of_birth: "",
          mother_nationality: "",
        
      },
      travelDetails: {
        travel_date: "",
      },
      otherinformationDetails: {
        family_in_uk: "",
        travelling_with_others: "",
      },
      qualificationsDetails: {
        qualifications: "",
        study_institution: "",
        subjects_studied: "",
        date_passed: "",
        study_gap_after_last_degree: "",
        can_you_justify_gap: "",
      },
      immigrationDetails: {
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
      ukvisahistoryDetails: {
        visa_type: "",
        visa_valid_from: "",
        visa_expiry_date: "",
        visa_reference_number: "",
      },
      overseastravelhistoryDetails: [
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
     spousepartnersaccompanyingDetails: {
        spouse_father_given_name: "",
        spouse_father_family_name: "",
        father_dob: "",
        father_place_of_birth: "",
        spouse_mother_given_name: "",
        spouse_mother_family_name: "",
        mother_dob: "",
        spouse_mother_place_of_birth: "",
        spouse_visa_valid_from: "",
        spouse_visa_expiry_date: "",
        spouse_visa_type: "",
        spouse_travel_history: "",
      },

        childrenDetails: [
        {
          child_full_name: "",
          child_gender: "",
          child_dob: "",
          child_place_of_birth: "",
          child_nationality: "",
          child_accompanying_uk: "",
          child_current_address: "",
          child_passport_number: "",
        },
      ],

      familynotaccompanyingDetails: {
        spouse_given_name: "",
        spouse_family_name: "",
        spouse_passport_number: "",
        spouse_location: "",
        spouse_dob: "",
        spouse_nationality: "",
        spouse_accompanying_uk: "",
      },
    
      requirementsforeuropeDetails: {
        do_you_have_block_account: "",
        have_you_legalised_documents: "",
        bonafide_student_undertaking: "",
      },

    }),

   documents: useForm({
    student_id: null,
    requiredDocuments: [{
      id: null,
      document_type: "",
      file_name: "",
      original_name: "",
      file_path: "",
      uploaded_at: "",
      file: null,
    }]
  }),


    showModal: ref(false),
    studentIdToDelete: ref(null),
    documentIdToDelete: ref(null),
    errors: {},
    countries: ref([]),
    isOpen: ref(false),
    selectedCountry: ref(null),
    totalStudents: ref(0),
    totalDocuments: ref(0),
    isRemoving: ref(false),
    selectedFile: null,
    fileSizeError: null,
    
  }),

  
  actions: {
    
reset() {
  this.student = { id: null };
  this.documents = { requiredDocuments: [] };
},

resetDocuments(studentId = null) {
  this.student = { id: studentId || null };
  this.documents = {
    requiredDocuments: [
      {
        document_type: '',
        file_name: '',
        file: null,
        file_path: null,
        original_name: '',
      }
    ],
  };
},

 setDocuments(newDocuments) {
      if (newDocuments && newDocuments.requiredDocuments) {
        this.documents.requiredDocuments = [...newDocuments.requiredDocuments];
      } else {
        this.resetDocuments();
      }
    },


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
    ...this.defaultIncomeDetails(),
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

      const passportDetails = {
    ...this.defaultPassportDetails(),
    ...(this.student.passportDetails || {}),
    ...(student.passportDetails || {}),
  };

      const firstpassportDetails = {
    ...this.defaultfirstpassportDetails(),
    ...(this.student.firstpassportDetails || {}),
    ...(student.firstpassportDetails || {}),
  };

      const contactDetails = {
    ...this.defaultcontactDetails(),
    ...(this.student.contactDetails || {}),
    ...(student.contactDetails || {}),
  };

        const parentsDetails = {
    ...this.defaultparentsDetails(),
    ...(this.student.parentsDetails || {}),
    ...(student.parentsDetails || {}),
  };

        const travelDetails = {
    ...this.defaulttravelDetails(),
    ...(this.student.travelDetails || {}),
    ...(student.travelDetails || {}),
  };

      const otherinformationDetails = {
    ...this.defaultotherinformationDetails(),
    ...(this.student.otherinformationDetails || {}),
    ...(student.otherinformationDetails || {}),
  };

      const qualificationsDetails = {
    ...this.defaultqualificationsDetails(),
    ...(this.student.qualificationsDetails || {}),
    ...(student.qualificationsDetails || {}),
  };


        const immigrationDetails = {
    ...this.defaultimmigrationDetails(),
    ...(this.student.immigrationDetails || {}),
    ...(student.immigrationDetails || {}),
  };
      const ukvisahistoryDetails = {
    ...this.defaultukvisahistoryDetails(),
    ...(this.student.ukvisahistoryDetails || {}),
    ...(student.ukvisahistoryDetails || {}),
  };


const overseastravelhistoryDetails = Array.isArray(student.overseastravelhistoryDetails)
  ? student.overseastravelhistoryDetails.map(child => ({
      ...this.defaultoverseastravelhistoryDetails(),
      ...child,
    }))
  : [this.defaultoverseastravelhistoryDetails()];


        const spousepartnersaccompanyingDetails = {
    ...this.defaultspousepartnersaccompanyingDetails(),
    ...(this.student.spousepartnersaccompanyingDetails || {}),
    ...(student.spousepartnersaccompanyingDetails || {}),
  };

    const childrenDetails = Array.isArray(student.childrenDetails)
    ? student.childrenDetails.map((child,index) => ({
        ...this.defaultchildrenDetails(),
        ...(this.student.childrenDetails?.[index] || {}),
        ...child
      }))
    : (this.student.childrenDetails || []);

         const familynotaccompanyingDetails = {
    ...this.defaultfamilynotaccompanyingDetails(),
    ...(this.student.familynotaccompanyingDetails || {}),
    ...(student.familynotaccompanyingDetails || {}),
  };

          const requirementsforeuropeDetails = {
    ...this.defaultrequirementsforeuropeDetails(),
    ...(this.student.requirementsforeuropeDetails || {}),
    ...(student.requirementsforeuropeDetails || {}),
  };
  

  this.student = {
    ...this.student,
    ...student,
    financialDetails,
    incomeDetails,
    studentEmployment,
    studentReferences,
    passportDetails,
    firstpassportDetails,
    contactDetails,
    parentsDetails,
    travelDetails,
    otherinformationDetails,
    qualificationsDetails,
    immigrationDetails,
    ukvisahistoryDetails,
    overseastravelhistoryDetails,
    spousepartnersaccompanyingDetails,
    childrenDetails,
    familynotaccompanyingDetails,
    requirementsforeuropeDetails,
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

defaultIncomeDetails() {
    return {
        monthly_income: '',
        income_from_others: '',
        other_income_sources: '',
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
    ref_name: '',
    ref_phone: '',
    ref_email: '',
    ref_position: '',
    ref_relationship: '',
    ref_duration: '',
    errors: {}
  };
},

defaultPassportDetails() {
    return {
        passport_number: '',
        place_of_issue: '',
        issuing_authority: '',
        date_of_issue: '',
        date_of_expiry: '',
        errors: {}
    };
},

defaultfirstpassportDetails() {
    return {
        previous_ppt_number: '',
        place_of_issue_previous: '',
        issuing_authority_previous: '',
        date_of_issue_previous: '',
        date_of_expiry_previous: '',
        national_id_number: '',
        errors: {}
    };
},

defaultcontactDetails() {
    return {
        address: '',
        postal_code: '',
        how_long_lived: '',
        home_number: '',
        mobile_number: '',
        email_address: '',
        contact_during_application: '',
        main_address_uk: '',
        ownership_status: '',
        errors: {}
    };
},

defaultparentsDetails() {
    return {
        father_given_name: '',
        father_family_name: '',
        father_date_of_birth: '',
        father_place_of_birth: '',
        father_nationality: '',
        mother_given_name: '',
        mother_family_name: '',
        mother_date_of_birth: '',
        mother_place_of_birth: '',
        mother_nationality: '',
        errors: {}
    };
},

defaulttravelDetails() {
    return {
        travel_date: '',
        errors: {}
    };
},

defaultotherinformationDetails() {
    return {
        family_in_uk: '',
        travelling_with_others: '',
        errors: {}
    };
},

defaultqualificationsDetails() {
    return {
        qualifications: '',
        study_institution: '',
        subjects_studied: '',
        date_passed: '',
        study_gap_after_last_degree: '',
        can_you_justify_gap: '',
        errors: {}
    };
},

defaultimmigrationDetails() {
    return {
        travel_outside: '',
      travel_uk: '',
      refused_uk_visa: '',
      refused_any_visa: '',
      granted_uk_visa: '',
      refused_entry_uk: '',
      deported_uk: '',
      deported_other_country: '',
      applied_home_office: '',
      breach_immigration_conditions: '',
      criminal_convictions: '',
      charged_criminal_offence: '',
      involved_in_war_crimes: '',
      involved_in_terrorism: '',
      activities_bad_character: '',
      nhs_treatment_unpaid: '',
      organization_type: '',
        errors: {}
    };
},

defaultukvisahistoryDetails() {
    return {
        visa_type: '',
      visa_valid_from: '',
      visa_expiry_date: '',
      visa_reference_number: '',
        errors: {}
    };
},

defaultoverseastravelhistoryDetails() {
  return {
    region_title: '',
    visits: [
      {
        country_visited: '',
        date_arrived: '',
        purpose_of_visit: '',
        length_of_stay: ''
      }
    ]
  };
},

defaultspousepartnersaccompanyingDetails() {
      return {
         spouse_father_given_name: '',
        spouse_father_family_name: '',
        father_dob: '',
        father_place_of_birth: '',
        spouse_mother_given_name: '',
        spouse_mother_family_name: '',
        mother_dob: '',
        spouse_mother_place_of_birth: '',
        spouse_visa_valid_from: '',
        spouse_visa_expiry_date: '',
        spouse_visa_type: '',
        spouse_travel_history: '',
          errors: {}
      };
},

defaultchildrenDetails() {
  return {
          child_full_name: '',
          child_gender: '',
          child_dob: '',
          child_place_of_birth: '',
          child_nationality: '',
          child_accompanying_uk: '',
          child_current_address: '',
          child_passport_number: '',
    errors: {}
  };
},

defaultfamilynotaccompanyingDetails() {
    return {
      spouse_given_name: '',
      spouse_family_name: '',
      spouse_passport_number: '',
      spouse_location: '',
      spouse_dob: '',
      spouse_nationality: '',
      spouse_accompanying_uk: '',
      errors: {}
    };
},

defaultrequirementsforeuropeDetails() {
    return {
        do_you_have_block_account: '',
        have_you_legalised_documents: '',
        bonafide_student_undertaking: '',
        errors: {}
    };
},

setDocuments(documents) {
  if (!documents) return;

  const requiredDocuments = Array.isArray(documents.requiredDocuments)
    ? documents.requiredDocuments.map((doc) => ({
        ...this.defaultRequiredDocument(),
        ...doc,
      }))
    : [];

  this.documents = {
    student_id: documents.student_id ?? null,
    id: documents.id ?? null,
    ...documents,
    requiredDocuments,
  };
},

resetDocuments() {
  this.documents = {
    student_id: null,
    id: null,
    requiredDocuments: [],
  };
},

defaultRequiredDocument() {
  return {
    id: null,
    document_type: '',
    file_name: '',
    original_name: '',
    file_path: '',
    uploaded_at: '',
    file: null,
    errors: {},
  };
},


async addStudentForm() {
  const toast = useToast();
  const email = this.student.email;

  if (!email || email.trim() === "") {
    toast.error("Email is required.");
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    toast.error("Please enter a valid email address.");
    return;
  }

  const formData = new FormData();

  for (const key in this.student) {
    if (!this.student.hasOwnProperty(key)) continue;

    const value = this.student[key];

    const jsonFields = [
      "financialDetails", "studentEmployment", "incomeDetails", "studentReferences",
      "passportDetails", "firstpassportDetails", "contactDetails", "parentsDetails",
      "travelDetails", "otherinformationDetails", "qualificationsDetails", "immigrationDetails",
      "overseastravelhistoryDetails", "ukvisahistoryDetails", "spousepartnersaccompanyingDetails", 
      "childrenDetails", "familynotaccompanyingDetails", 
      "requirementsforeuropeDetails"
    ];

    if (jsonFields.includes(key) && value) {
      formData.append(key, JSON.stringify(value));
    } else {
      formData.append(key, value);
    }
  }

  try {
    await this.student.post(route("students.store"), formData);
    toast.success("Student added successfully!");
  } catch (error) {
    toast.error("Failed to add student.");
    console.error("Form submission error:", error);
  }
},



updateStudentField(field, value) {
  this.student[field] = value;
},

confirmDelete(studentId) {
this.studentIdToDelete = studentId;
this.showModal = true;
},

confirmDocumentsDelete(documentId) {
this.documentIdToDelete = documentId;
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


async handleDocumentsDelete(documentId) {
const toast = useToast();
try {
await router.delete(route('documents.destroy', { document: documentId }));
toast.success("Documents deleted successfully.");
router.visit(route('documents.index'), { preserveScroll: true, replace: true });
} catch (error) {
toast.error("Failed to delete documents.");
console.error("Error deleting documents:", error);
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
    if (this.documents.errors && this.documents.errors[field]) {
      delete this.documents.errors[field]; 
  }
},

validateField(field) {
if (!this.student[field] || this.student[field].trim() === '') {
  this.setError(field, `${field} is required.`);
  return false;
}
  if (!this.documents[field] || this.documents[field].trim() === '') {
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
    ref_name: "",
    ref_phone: "",
    ref_email: "",
    ref_position: "",
    ref_relationship: "",
    ref_duration: "",
  });
},

removestudentReference(index) {
    this.student.studentReferences.splice(index, 1);
},

addChild() {
  this.student.childrenDetails.push({
    child_full_name: "",
    child_gender: "",
    child_dob: "",
    child_place_of_birth: "",
    child_nationality: "",
    child_accompanying_uk: false,
    child_current_address: "",
    child_passport_number: "",
  });
},
removeChild(index) {
    this.student.childrenDetails.splice(index, 1);
},
addRegion() {
    this.student.overseastravelhistoryDetails.push({
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
        this.student.overseastravelhistoryDetails.splice(index, 1);
},
addVisit(regionIndex) {
    this.student.overseastravelhistoryDetails[regionIndex].visits.push({
        country_visited: '',
        date_arrived: '',
        purpose_of_visit: '',
        length_of_stay: ''
    });
},
removeVisit(regionIndex, visitIndex) {
        this.student.overseastravelhistoryDetails[regionIndex].visits.splice(visitIndex, 1);
},

  addrequiredDocuments() {
      this.documents.requiredDocuments.push({
         id: null,
        document_type: '',
        file_name: '',
        original_name: '',
        file_path: '',
        uploaded_at: '',
        file: null,
      });
    },

    removerequiredDocuments(index) {
      this.documents.requiredDocuments.splice(index, 1);
    },

  },


});