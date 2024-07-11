async function showAddStudentModal() {
    $('#custom-add-student-modal').modal('show')
}

async function hideModal() {
    $('#custom-add-student-modal').modal('hide')
    $('#customModal').modal('hide')
    document.getElementById('customModalTitle').innerHTML = ""
    document.getElementById('customModalBody').innerHTML = ""
    document.getElementById('customModalFooter').innerHTML = ""
    if(document.getElementById('error-message-name')){
        document.getElementById('error-message-name').remove()
    }
    if(document.getElementById('error-message-subject')) {
        document.getElementById('error-message-subject').remove()
    }
    if(document.getElementById('error-message-marks')) {
        document.getElementById('error-message-marks').remove()
    }
}

async function addStudent() {
    try {
        $('.add-student-btn').addClass('d-none')
        $('.custom-loader').removeClass('d-none')
        if(document.getElementById('error-message-name')){
            document.getElementById('error-message-name').remove()
        }
        if(document.getElementById('error-message-subject')) {
            document.getElementById('error-message-subject').remove()
        }
        if(document.getElementById('error-message-marks')) {
            document.getElementById('error-message-marks').remove()
        }

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

                    if(response.message == "Validation Failed.") {
                        for (let key in response.errors) {
                            if (response.errors.hasOwnProperty(key)) {
                                const errorElement = document.createElement('span')
                                errorElement.setAttribute('class', 'text-danger')
                                var error_span_id = 'error-message-' + key
                                errorElement.setAttribute('id', error_span_id)
                                errorElement.innerHTML = response.errors[key][0]
                                document.getElementById('ttp-label-' + key).insertAdjacentElement('afterend', errorElement)
                            }
                        }
                    } else {
                        document.getElementById('custom-error-message').innerHTML = error.message
                    }
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
                
                const response = JSON.parse(error.responseText)

                if(response.message == "Validation Failed.") {
                    for (let key in response.errors) {
                        if (response.errors.hasOwnProperty(key)) {
                            const errorElement = document.createElement('span')
                            errorElement.setAttribute('class', 'text-danger')
                            var error_span_id = 'error-message-' + key
                            errorElement.setAttribute('id', error_span_id)
                            errorElement.textContent = response.errors[key][0]
                            document.getElementById('ttp-label-' + key).insertAdjacentElement('afterend', errorElement)
                        }
                    }
                } else {
                    document.getElementById('custom-error-message').innerHTML = error.message
                }

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
        showModal(title = 'Error', body = "An error occurred. Please try again later.")
    }
}

async function showConfirmModal(body = "Are you sure you want to proceed?") {
    $('#customModal').modal('show')
    document.getElementById('customModalTitle').innerHTML = "Confirmation!"
    document.getElementById('customModalBody').innerHTML = body

    return new Promise((confirm) => {
        var button1 = document.createElement('button');
        button1.setAttribute('class', 'btn btn-outline-danger m-2');
        button1.setAttribute('value', '1');
        button1.setAttribute('type', 'button');
        button1.innerText = 'Yes';

        var button2 = document.createElement('button');
        button2.setAttribute('class', 'btn btn-outline-success');
        button2.setAttribute('type', 'button');
        button2.setAttribute('value', '0');
        button2.innerText = 'No';

        button1.addEventListener('click', function() {
            hideModal()
            confirm(1);
        });

        button2.addEventListener('click', function() {
            hideModal()
            confirm(0);
        });

        document.getElementById('customModalFooter').innerHTML = '';
        document.getElementById('customModalFooter').appendChild(button1);
        document.getElementById('customModalFooter').appendChild(button2);
    });
}

async function showModal(title = "Teacher Portal", body = "", footer = "", close = 1) {
    $('#customModal').modal('show')
    document.getElementById('customModalTitle').innerHTML = title
    if(body == "") {
        document.getElementById('customModalBody').classList.add('d-none')
    } else {
        document.getElementById('customModalBody').innerHTML = body
    }
    if(footer == "") {
        document.getElementById('customModalFooter').classList.add('d-none')
    } else {
        document.getElementById('customModalFooter').innerHTML = footer
    }
    if(! close ) {
        document.getElementById('customModalClose').classList.add('d-none')
    }
}

async function deleteStudent(student_id, current_page) {
    showConfirmModal("Are you sure you want to delete?").then((result) => {
        if(! result ) {
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
                        
                        showModal(title = 'Deleted', body = response.message, footer = "", close = 0)
                        setTimeout(function() {
                            hideModal()
                            window.location.href = '/students?page=' + current_page;
                        }, 2000)
                    } else {
                        $('.delete-student-btn-' + student_id).removeClass('d-none')
                        $('.custom-loader-' + student_id).addClass('d-none')

                        showModal(title = 'Failed', body = response.message, footer = "")
                    }
                },
                error: function(error) {
                    console.error(error);
                    $('.delete-student-btn-' + student_id).removeClass('d-none')
                    $('.custom-loader-' + student_id).addClass('d-none')
                    
                    showModal(title = 'Failed', body = JSON.parse(error.responseText).message, footer = "")
                }
            });
        } catch (error) {
            $('.delete-student-btn-' + student_id).removeClass('d-none')
            $('.custom-loader-' + student_id).addClass('d-none')
            
            console.error('Error:', error);
            showModal(title = 'Error', body = "An error occurred. Please try again later.")
        }
    });
}

async function editStudent(student_id, current_page) {
    var row = document.getElementById(student_id);
    if (row) {
        var tds = row.getElementsByTagName('td');
        var th = row.getElementsByTagName('th');

        var currentValue = th[0].innerText;

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
            var currentValue = td.innerText;

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
            } else {
                input.setAttribute('type', 'text');
            }
            input.setAttribute('value', currentValue);

            td.innerHTML = '';
            td.appendChild(input);
        }
        var td = tds[tds.length - 1];
        var currentValue = td.innerText;

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

async function cancelEdit() {
    location.reload();
}

async function updateStudent(student_id, current_page) {
    showConfirmModal("Are you sure you want to update student data?").then((result) => {
        if(! result ) {
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
                        showModal(title = 'Updated', body = response.message, footer = "", close = 0)
                        setTimeout(function() {
                            hideModal()
                            window.location.href = '/students?page=' + current_page;
                        }, 2000)
                    } else {
                        showModal(title = 'Updated', body = response.message)
                    }
                },
                error: function(error) {
                    console.error(error);
                    showModal(title = 'Failed', body = JSON.parse(error.responseText).message)
                }
            });
        } catch (error) {
            console.error('Error:', error);
            showModal(title = 'Error', body = "An error occurred. Please try again later.")
        }
    });
}
