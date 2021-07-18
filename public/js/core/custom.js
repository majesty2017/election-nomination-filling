$(document).ready(function () {
   //
})
let _token = $('input[name=_token]').val()
let profile_path = $('#profile_path').val()
let team_path = $('#team_path').val()

function load_image(image_id, image_loader = null, selector = '#') {
    if (selector === '.') {
        selector = '.'
    }
    $(selector+image_id).change(function (event) {
        let path = URL.createObjectURL(event.target.files[0])
        $(selector+image_loader).html(`<img src="${path}" height="80" width="80" style="border-radius: 100px" alt="" />`)
    })
}

function message(status, message, title = null) {
    if (title === null) {
        title = 'SRC Nomination Filling System'
    }
    var isRtl = $('html').attr('data-textdirection') === 'rtl';
    toastr[status](message, title, {
        showMethod: 'slideDown',
        hideMethod: 'slideUp',
        timeOut: 5000,
        rtl: isRtl
    });
}

function hold_modal(id, action) {
    $('#'+id).modal(action)
}

function deleteAlert(url, id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-3'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        showClass: {
            popup: 'animate__animated animate__flipInX'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url + '/' + id,
                type: 'delete',
                data: {_token: _token},
                success: function (res) {
                    if (res) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        )
                        message('success', res.message)
                        setTimeout(() => location.reload(true), 1000)
                    }
                }
            })
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your record is safe :)',
                'error'
            )
        }
    })
}

function refundAlert(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger mr-3'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, refund it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true,
        showClass: {
            popup: 'animate__animated animate__flipInX'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/payments/refund',
                type: 'post',
                data: {id: id, _token: _token},
                success: function (res) {
                    if (res) {
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            res.message,
                            'success'
                        )
                        message('success', res.message)
                        setTimeout(() => location.reload(true), 1000)
                    }
                }
            })
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your record is safe :)',
                'error'
            )
        }
    })
}

// Users function
function view_user(id) {
    $.ajax({
        url: '/users/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#v_'+k).html(v)
                })
                $('#vv_image').html(`<img src="images/profile/user-uploads/${res.image}" style="border-radius: 10px" width="100" height="100"  alt=""/>`)
            }
        }
    })
    hold_modal('view-user-modal', 'show')
}
function edit_user(id) {
    $.ajax({
        url: '/users/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                })
                $('#ee_image_loader').html(`<img src="images/profile/user-uploads/${res.image}" style="border-radius: 100px" width="80" height="80"  alt=""/>`)
            }
        }
    })
    hold_modal('edit-user-modal', 'show')
}

// Departments function
function view_departments(id) {
    $.ajax({
        url: '/departments/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            console.log(res)
            if (res) {
                $.each(res, function (k, v) {
                    $('#v_'+k).html(v)
                })
            }
        }
    })
    hold_modal('view-department-modal', 'show')
}
function edit_departments(id) {
    $.ajax({
        url: '/departments/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                })
            }
        }
    })
    hold_modal('edit-department-modal', 'show')
}

// Programmes function
function view_programmes(id) {
    $.ajax({
        url: '/programmes/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            console.log(res)
            if (res) {
                $.each(res, function (k, v) {
                    $('#v_'+k).html(v)
                })
            }
        }
    })
    hold_modal('view-programme-modal', 'show')
}
function edit_programmes(id) {
    $.ajax({
        url: '/programmes/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                })
            }
        }
    })
    hold_modal('edit-programme-modal', 'show')
}

// Portfolio function
function view_portfolios(id) {
    $.ajax({
        url: '/portfolios/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            console.log(res)
            if (res) {
                $.each(res, function (k, v) {
                    $('#v_'+k).html(v)
                })
            }
        }
    })
    hold_modal('view-portfolio-modal', 'show')
}
function edit_portfolios(id) {
    $.ajax({
        url: '/portfolios/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                })
            }
        }
    })
    hold_modal('edit-portfolio-modal', 'show')
}

// Student function
function view_students(id) {
    $.ajax({
        url: '/users/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#v_'+k).html(v)
                })
                $('#vv_image').html(`<img src="${profile_path+'/'+res.image}" style="border-radius: 10px" width="100" height="100"  alt=""/>`)
            }
        }
    })
    hold_modal('view-student-modal', 'show')
}

function edit_students(id) {
    $.ajax({
        url: '/users/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                })
                $('#ee_image_loader').html(`<img src="${profile_path+'/'+res.image}" style="border-radius: 100px" width="80" height="80"  alt=""/>`)
            }
        }
    })
    hold_modal('edit-student-modal', 'show')
}

// Payment function
$(document).ready(function () {
    $.ajax({
        url: '/payments/applicant-lists',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
            $.each(res, function (k, v) {
                $('#student_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#e_student_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#applicant_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#ee_student_id').append(`<option value="${v.id}">${v.name}</option>`)
            })
        }
    })
    $.ajax({
        url: '/payments/portfolio-lists',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
            $.each(res, function (k, v) {
                $('#portfolio_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#e_portfolio_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#portfolio').append(`<option value="${v.id}">${v.name}</option>`)
                $('#ee_portfolio_id').append(`<option value="${v.id}">${v.name}</option>`)
            })
        }
    })

    $.ajax({
        url: '/fillings/programmes',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
            $.each(res, function (k, v) {
                $('#programme_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#ee_programme_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#fprogramme_id').append(`<option value="${v.id}">${v.name}</option>`)
            })
        }
    })

    $.ajax({
        url: '/fillings/departments',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
            $.each(res, function (k, v) {
                $('#department_id').append(`<option value="${v.id}">${v.name}</option>`)
                $('#ee_department_id').append(`<option value="${v.id}">${v.name}</option>`)
            })
        }
    })

    $('#portfolio_id').change(function () {
        let id = $(this).val()
        $.ajax({
            url: '/payments/portfolio',
            type: 'post',
            data: {id: id, _token: _token},
            success: function (res) {
                console.log(res)
                $('#amount').val(res.amount.toFixed(2, 2))
                $('#new_amount').val(res.amount * 100)
                $('#amount_title').html(`<span>${res.name +'  GHS '+ res.amount.toFixed(2, 2)}</span>`)
                $('#new_portfolio_id').val(res.id)
            }
        })
    })

    $('#e_portfolio_id').change(function () {
        let id = $(this).val()
        $.ajax({
            url: '/payments/portfolio',
            type: 'post',
            data: {id: id, _token: _token},
            success: function (res) {
                $('#e_amount').val(res.amount)
            }
        })
    })
})

function view_payments(id) {
    $.ajax({
        url: '/payments/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#v_'+k).html(v)
                })
                $('#v_applicant').html(res.user.name)
                $('#v_portfolio').html(res.portfolio.name)
            }
        }
    })
    hold_modal('view-payment-modal', 'show')
}

function edit_payments(id) {
    $.ajax({
        url: '/payments/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                })
            }
        }
    })
    hold_modal('edit-payment-modal', 'show')
}

function view_fillings(id) {
    $.ajax({
        url: '/fillings/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#v_'+k).html(`<b><span>${v}</span></b>`)
                })
                $('#v_applicant_id').html(`<b>${res.user.name}</b>`)
                $('#v_programme_id').html(`<b>${res.programme.name}</b>`)
                $('#v_department_id').html(`<b>${res.department.name}</b>`)
                $('#v_portfolio').html(`<b>${res.portfolio.name}</b>`)
                $('#v_image_loader').html(`<img src="${profile_path+'/'+res.image}" style="border-radius: 10px" width="120" height="120"  alt=""/>`)
            }
        }
    })
    hold_modal('view-filling-modal', 'show')
}

function edit_fillings(id) {
    $.ajax({
        url: '/fillings/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                    $('#ee_'+k).filter(function () {
                        return $(this).val() === $('#ee_'+k).val(v)
                    }).attr('selected', true)
                })
                $('#f_image_loader').html(`<img src="${profile_path+'/'+res.image}" style="border-radius: 100px" width="80" height="80"  alt=""/>`)
            }
        }
    })
    hold_modal('edit-filling-modal', 'show')
}

function view_teams(id) {
    $.ajax({
        url: '/teams/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    if (v === null) v = ''
                    $('#v_'+k).html(`<b><span>${v}</span></b>`)
                })
                $('#vv_image').html(`<img src="${team_path+'/'+res.image}" style="border-radius: 10px" width="120" height="120"  alt=""/>`)
            }
        }
    })
    hold_modal('view-team-modal', 'show')
}

function edit_teams(id) {
    $.ajax({
        url: '/teams/show',
        type: 'post',
        data: {id: id, _token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#e_'+k).val(v)
                })
                $('#eimage_loader').html(`<img src="${team_path+'/'+res.image}" style="border-radius: 100px" width="80" height="80"  alt=""/>`)
            }
        }
    })
    hold_modal('edit-team-modal', 'show')
}

$(document).ready(function () {
    $.ajax({
        url: '/web_settings/settings',
        type: 'post',
        data: {_token: _token},
        success: function (res) {
            if (res) {
                $.each(res, function (k, v) {
                    $('#'+k).val(v)
                })
                $('#limage_loader').html(`<img src="images/web-settings/logos/${res.logo}" height="80" width="80" style="border-radius: 100px" alt="Logo"/>`)

                $('#fimage_loader').html(`<img src="images/web-settings/favicons/${res.favicon}" height="80" width="80" style="border-radius: 100px" alt="Favivon"/>`)
            }
        }
    })
})