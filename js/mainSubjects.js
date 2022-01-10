const subj = new Vue
({
    el: '#app', 
    data: {
        errorMsg: false, 
        successMsg: false, 
        showEditModal: false, 
        showDeleteModal: false, 

        /**Subjects */
        subjects: [], 
        newSubject: 
        {
            name: "", 
            credits: 0,
        },

        currentSubject: [],
    }, 
    mounted: function ()
    {
        this.getAllSubjects(); 
        
    }, 
    methods: {
         /**Subjects */
        getAllSubjects: function ()
        {
            axios.get("http://localhost/universidad/proyecto/materias/backendSubjects.php?action=read")
                 .then(function(response)
                 {
                    if (response.data.error)
                        {subj.errorMsg = response.data.message;}
                    else 
                        {subj.subjects = response.data.subjects;}
                 });
        },
        addSubject: function ()
        {
            var formData = subj.toFormData(subj.newSubject); 
            axios.post("http://localhost/universidad/proyecto/materias/backendSubjects.php?action=create", formData)
                 .then(function (response)
                 {
                    subj.newProfessor = {
                        name: "", 
                        credits: 0, 
                    }; 
                    if (response.data.error)
                    {
                        subj.errorMsg = response.data.message; 
                    }
                    else
                    {
                        subj.successMsg = response.data.message; 
                        subj.getAllSubjects();
                    }
                 }); 
        }, 
        selectSubject: function (subject)
        {
            subj.currentSubject = subject; 
        },
        updateSubject: function ()
        {
            var formData = subj.toFormData(subj.currentSubject); 
            axios.post("http://localhost/universidad/proyecto/materias/backendSubjects.php?action=update", formData)
                 .then(function (response)
                 {
                    subj.currentSubject = {}; 

                    if (response.data.error)
                    {
                        subj.errorMsg = response.data.message; 
                    }
                    else
                    {
                        subj.successMsg = response.data.message; 
                        subj.getAllSubjects(); 
                    }
                 });
        },
        deleteSubject: function ()
        {
            var formData = subj.toFormData(subj.currentSubject); 
            axios.post("http://localhost/universidad/proyecto/materias/backendSubjects.php?action=delete", formData)
                 .then( function (response)
                 {
                    subj.currentSubject = {}; 

                    console.log(response); 
                    if(response.data.error)
                    {
                        subj.errorMsg = response.data.message; 
                    }
                    else
                    {
                        subj.successMsg = response.data.Message; 
                        subj.getAllSubjects(); 
                    }
                 }); 
        },
        toFormData: function (obj)
        {
            var fd = new FormData(); 
            for (var i in obj)
            {
                fd.append(i, obj[i]); 
            }
            return fd; 
        }
    }
}); 
