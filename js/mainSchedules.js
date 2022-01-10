const sched = new Vue
({
    el: '#app', 
    data: {
        errorMsg: false, 
        successMsg: false, 
        showEditModal: false, 
        showDeleteModal: false, 

        /** */
        schedules: [], 
        students: [],
        professors: [], 
        subjects: [],

        newSchedule: 
        {
            student: 0, 
            professor: 0,
            subject: 0, 
            time: "", 
            day: ""
        },

        currentSchedule: [],
    }, 
    mounted: function ()
    {
        this.getAllSchedules(); 
    }, 
    methods: {
         /**schedects */
        getAllSchedules: function ()
        {
            axios.get("http://localhost/universidad/proyecto/horarios/backendSchedules.php?action=read")
                 .then( function (response)
                 {
                    if (response.data.error)
                    {
                        sched.errorMsg = response.data.message; 
                    }
                    else
                    {
                        sched.schedules = response.data.schedules; 
                    }
                 }); 
        },
        /*Obtener los datos de las demás tablas*/
        getAllStudents: function ()
        {
            axios.get("http://localhost/universidad/proyecto/alumnos/backendStudents.php?action=read")
                 .then(function(response)
                 {
                    if (response.data.error)
                        {sched.errorMsg = response.data.message;}
                    else 
                        {sched.students = response.data.students;}
                 });
        },
        getAllProfessors: function ()
        {
            axios.get("http://localhost/universidad/proyecto/profesores/backendProfessors.php?action=read")
                 .then(function(response)
                 {
                    if (response.data.error)
                        {sched.errorMsg = response.data.message;}
                    else 
                        {sched.professors = response.data.professors;}
                 });
        },
        getAllSubjects: function ()
        {
            axios.get("http://localhost/universidad/proyecto/materias/backendSubjects.php?action=read")
                 .then(function(response)
                 {
                    if (response.data.error)
                        {sched.errorMsg = response.data.message;}
                    else 
                        {sched.subjects = response.data.subjects;}
                 });
        },
         /**Obtener los datos de las demas tablas ^ */
        addSchedule: function ()
        {
            var formData = sched.toFormData(sched.newSchedule); 
            axios.post("http://localhost/universidad/proyecto/horarios/backendSchedules.php?action=create", formData)
                 .then(function (response)
                 {
                    sched.newSchedule = {
                        student: 0, 
                        professor: 0,
                        subject: 0, 
                        time: "", 
                        day: "" 
                    }; 
                    if (response.data.error)
                    {
                        sched.errorMsg = response.data.message; 
                    }
                    else
                    {
                        sched.successMsg = response.data.message; 
                        sched.getAllSchedules();
                    }
                 }); 
        }, 
        selectSchedule: function (schedule)
        {
            sched.currentSchedule = schedule; 
        },
        updateSchedule: function ()
        {
            var formData = sched.toFormData(sched.currentSchedule); 
            axios.post("http://localhost/universidad/proyecto/horarios/backendSchedules.php?action=update", formData)
                 .then(function (response)
                 {
                    sched.currentSchedule = {}; 

                    if (response.data.error)
                    {
                        sched.errorMsg = response.data.message; 
                    }
                    else
                    {
                        sched.successMsg = response.data.message; 
                        sched.getAllSchedules(); 
                    }
                 });
        },
        deleteSchedule: function ()
        {
            var formData = sched.toFormData(sched.currentSchedule); 
            axios.post("http://localhost/universidad/proyecto/horarios/backendSchedules.php?action=delete", formData)
                 .then( function (response)
                 {
                    sched.currentSchedule = {}; 

                    console.log(response); 
                    if(response.data.error)
                    {
                        sched.errorMsg = response.data.message; 
                    }
                    else
                    {
                        sched.successMsg = response.data.Message; 
                        sched.getAllSchedules(); 
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