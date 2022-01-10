const prof = new Vue
({
    el: '#app', 
    data: {
        errorMsg: false, 
        successMsg: false, 
        showEditModal: false, 
        showDeleteModal: false, 

        /**Professors */
        professors: [], 
        newProfessor: 
        {
            name: "", 
            area: "",
            rfc: "", 
        },

        currentProfessor: [],
    }, 
    mounted: function ()
    {
        this.getAllProfessors(); 
    }, 
    methods: {
         /**Professors */
        getAllProfessors: function ()
        {
            axios.get("http://localhost/universidad/proyecto/profesores/backendProfessors.php?action=read")
                 .then(function(response)
                 {
                    if (response.data.error)
                        {prof.errorMsg = response.data.message;}
                    else 
                        {prof.professors = response.data.professors;}
                 });
        },
        addProfessor: function ()
        {
            var formData = prof.toFormData(prof.newProfessor); 
            axios.post("http://localhost/universidad/proyecto/profesores/backendProfessors.php?action=create", formData)
                 .then(function (response)
                 {
                    prof.newProfessor = {
                        name: "", 
                        area: "", 
                        rfc: "",
                    }; 
                    if (response.data.error)
                    {
                        prof.errorMsg = response.data.message; 
                    }
                    else
                    {
                        prof.successMsg = response.data.message; 
                        prof.getAllProfessors();
                    }
                 }); 
        }, 
        selectProfessor: function (professor)
        {
            prof.currentProfessor = professor; 
        },
        updateProfessor: function ()
        {
            var formData = prof.toFormData(prof.currentProfessor); 
            axios.post("http://localhost/universidad/proyecto/profesores/backendProfessors.php?action=update", formData)
                 .then(function (response)
                 {
                    prof.currentProfessor = {}; 

                    if (response.data.error)
                    {
                        prof.errorMsg = response.data.message; 
                    }
                    else
                    {
                        prof.successMsg = response.data.message; 
                        prof.getAllProfessors(); 
                    }
                 });
        },
        deleteProfessor: function ()
        {
            var formData = prof.toFormData(prof.currentProfessor); 
            axios.post("http://localhost/universidad/proyecto/profesores/backendProfessors.php?action=delete", formData)
                 .then( function (response)
                 {
                    prof.currentProfessor = {}; 

                    console.log(response); 
                    if(response.data.error)
                    {
                        prof.errorMsg = response.data.message; 
                    }
                    else
                    {
                        prof.successMsg = response.data.Message; 
                        prof.getAllProfessors(); 
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