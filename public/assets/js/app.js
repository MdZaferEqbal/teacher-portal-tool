async function showAddStudentModal() {
    $('#custom-add-student-modal').modal('show')
}

async function hideAddStudentModal() {
    $('#custom-add-student-modal').modal('hide')
}

async function addStudent() {
    try {
        $('.add-student-btn').addClass('d-none')
        $('.custom-loader').removeClass('d-none')

        $.ajax({
            url: window.location.origin + '/api/add-student',
            type: 'POST',
            data: {
                name: document.getElementById('ttp-name').value,
                subject: document.getElementById('ttp-subject').value,
                marks: document.getElementById('ttp-marks').value
            },
            success: function(response) {
                if (response.status == 1) {
                    $('.add-student-btn').removeClass('d-none')
                    $('.custom-loader').addClass('d-none')
                    
                    document.getElementById('custom-success-message').innerHTML = response.message

                    setTimeout(function() {
                        document.getElementById('custom-success-message').innerHTML = ""
                        window.location.href = '/students';
                    }, 2000);
                } else {
                    $('.add-student-btn').removeClass('d-none')
                    $('.custom-loader').addClass('d-none')

                    document.getElementById('custom-error-message').innerHTML = response.message
                    setTimeout(function() {
                        document.getElementById('custom-error-message').innerHTML = ""
                        $('#custom-error-message').addClass('d-none')
                    }, 2000)
                }
            },
            error: function(error) {
                console.error(error);
                $('.add-student-btn').removeClass('d-none')
                $('.custom-loader').addClass('d-none')
                
                document.getElementById('custom-error-message').innerHTML = JSON.parse(error.responseText).message

                setTimeout(function() {
                    document.getElementById('custom-error-message').innerHTML = ""
                    $('#custom-error-message').addClass('d-none')
                }, 2000)
            }
        });
    } catch (error) {
        $('.add-student-btn').removeClass('d-none')
        $('.custom-loader').addClass('d-none')
        
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    }
}

async function deleteStudent(student_id, current_page) {
    if (!confirm('Are you sure you want to delete this student?')) {
        return;
    }
    try {
        $('.delete-student-btn-' + student_id).addClass('d-none')
        $('.custom-loader-' + student_id).removeClass('d-none')

        $.ajax({
            url: window.location.origin + '/api/delete-student',
            type: 'GET',
            data: {
                id: student_id,
            },
            success: function(response) {
                if (response.status == 1) {
                    $('.delete-student-btn-' + student_id).removeClass('d-none')
                    $('.custom-loader-' + student_id).addClass('d-none')
                    
                    alert(response.message)
                    window.location.href = '/students?page=' + current_page;
                } else {
                    $('.delete-student-btn-' + student_id).removeClass('d-none')
                    $('.custom-loader-' + student_id).addClass('d-none')

                    alert(response.message)
                }
            },
            error: function(error) {
                console.error(error);
                $('.delete-student-btn-' + student_id).removeClass('d-none')
                $('.custom-loader-' + student_id).addClass('d-none')
                
                alert(JSON.parse(error.responseText).message);
            }
        });
    } catch (error) {
        $('.delete-student-btn-' + student_id).removeClass('d-none')
        $('.custom-loader-' + student_id).addClass('d-none')
        
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    }
}

async function editStudent(student_id, current_page) {
    var row = document.getElementById(student_id);
    if (row) {
        var tds = row.getElementsByTagName('td');
        var th = row.getElementsByTagName('th');

        var currentValue = th[0].innerText.trim();

        var input = document.createElement('input');
        input.setAttribute('class', 'form-control');
        input.setAttribute('type', 'text');
        input.setAttribute('name', 'name');
        input.setAttribute('id', 'ttd-student-name');
        input.setAttribute('value', currentValue);

        th[0].innerHTML = '';
        th[0].appendChild(input);

        for (var i = 0; i < tds.length - 1; i++) {
            var td = tds[i];
            var currentValue = td.innerText.trim();

            var input = document.createElement('input');
            input.setAttribute('class', 'form-control');
            if(i == 0) {
                input.setAttribute('type', 'text');
                input.setAttribute('name', 'subject');
                input.setAttribute('id', 'ttd-student-subject');
            } else if(i == 1) {
                input.setAttribute('type', 'number');
                input.setAttribute('name', 'marks');
                input.setAttribute('id', 'ttd-student-marks');
            } 
            input.setAttribute('value', currentValue);

            td.innerHTML = '';
            td.appendChild(input);
        }
        var td = tds[tds.length - 1];
        var currentValue = td.innerText.trim();

        var button1 = document.createElement('button');
        button1.setAttribute('class', 'btn btn-outline-secondary m-2');
        button1.setAttribute('onclick', 'updateStudent(' + student_id + ',' + current_page + ')');
        button1.setAttribute('type', 'button');
        button1.innerText = 'Update';

        var button2 = document.createElement('button');
        button2.setAttribute('class', 'btn btn-outline-danger');
        button2.setAttribute('type', 'button');
        button2.setAttribute('onclick', 'cancelEdit()');
        button2.innerText = 'Cancel';

        td.innerHTML = '';
        td.appendChild(button1);
        td.appendChild(button2);
    }
}

async function updateStudent(student_id, current_page) {
    if (!confirm('Are you sure you want to update student data?')) {
        return;
    }
    try {
        $.ajax({
            url: window.location.origin + '/api/update-student',
            type: 'GET',
            data: {
                id: student_id,
                name: document.getElementById('ttd-student-name').value,
                subject: document.getElementById('ttd-student-subject').value,
                marks: document.getElementById('ttd-student-marks').value,
            },
            success: function(response) {
                if (response.status == 1) {
                    alert(response.message)
                    window.location.href = '/students?page=' + current_page;
                } else {
                    alert(response.message)
                }
            },
            error: function(error) {
                console.error(error);
                alert(JSON.parse(error.responseText).message);
            }
        });
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    }
}

async function cancelEdit() {
    location.reload();
}
