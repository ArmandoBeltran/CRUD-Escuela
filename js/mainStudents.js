const stud = new Vue
({
    el: '#app', 
    data: {
        errorMsg: false, 
        successMsg: false, 
        showEditModal: false, 
        showDeleteModal: false, 

        /**Students */
        students: [], 
        newStudent: 
        {
            name: "", 
            major: "", 
        },

        /**Array to show current student data */
        currentStudent: [],
    }, 
    mounted: function ()
    {
        this.getAllStudents(); 
    }, 
    methods: {
         /**Students */
        getAllStudents: function ()
        {
            axios.get("http://localhost/universidad/proyecto/alumnos/backendStudents.php?action=read")
                 .then(function(response)
                 {
                    if (response.data.error)
                        {stud.errorMsg = response.data.message;}
                    else 
                        {stud.students = response.data.students;}
                 });
        },
        addStudent: function ()
        {
            var formData = stud.toFormData(stud.newStudent); 
            axios.post("http://localhost/universidad/proyecto/alumnos/backendStudents.php?action=create", formData)
                 .then(function (response)
                 {
                    stud.newStudent = {
                        name: "", 
                        major: ""
                    }; 
                    if (response.data.error)
                    {
                        stud.errorMsg = response.data.message; 
                    }
                    else
                    {
                        stud.successMsg = response.data.message; 
                        stud.getAllStudents();
                    }
                 }); 
            
        }, 
        selectStudent: function (student)
        {   
            stud.currentStudent = student; 
        },
        updateStudent: function ()
        {
            var formData = stud.toFormData(stud.currentStudent); 
            axios.post("http://localhost/universidad/proyecto/alumnos/backendStudents.php?action=update", formData)
                 .then(function (response)
                 {
                    stud.currentStudent = {}; 

                    if (response.data.error)
                    {
                        stud.errorMsg = response.data.message; 
                    }
                    else
                    {
                        stud.successMsg = response.data.message; 
                        stud.getAllStudents(); 
                    }
                 });
        },
        deleteStudent: function ()
        {
            var formData = stud.toFormData(stud.currentStudent); 
            axios.post("http://localhost/universidad/proyecto/alumnos/backendStudents.php?action=delete", formData)
                 .then( function (response)
                 {
                    stud.currentStudent = {}; 

                    console.log(response); 
                    if(response.data.error)
                    {
                        stud.errorMsg = response.data.message; 
                    }
                    else
                    {
                        stud.successMsg = response.data.Message; 
                        stud.getAllStudents(); 
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