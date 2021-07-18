/**
 * DataTables Basic
 */

$(function () {
  'use strict';

  var dt_students_table = $('.datatables-students'),
      dt_date_table = $('.datepicker'),
      assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_students_table.length) {
    var dt_students = dt_students_table.DataTable({
      ajax: '/students/student-lists',
      columns: [
        { data: 'id' },
        { data: 'name' },
        { data: '',
          render: function (a,b, c, d) {
            return `<img src="${profile_path+'/'+c.image}" height="80" width="80" style="border-radius: 100px" />`
          }
        },
        { data: 'phone' },
        { data: 'email' },
        { data: '' }
      ],
      columnDefs: [
        {
          targets: 0,
          visible: false
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          render: function (data, type, full, meta) {
            return (
                '<div class="d-inline-flex">' +
                '<a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown">' +
                feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                '</a>' +
                '<div class="dropdown-menu dropdown-menu-right">' +
                '<a href="javascript:;" onclick="view_students('+full.id+')" class="dropdown-item">' +
                feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) +
                'Details</a>' +
                '<a href="javascript:;" onclick="deleteAlert(`/users/destroy`, '+full.id+')" class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                'Delete</a>' +
                '</div>' +
                '</div>' +
                '<a href="javascript:;" onclick="edit_students('+full.id+')" class="item-edit">' +
                feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                '</a>'
            );
          }
        }
      ],
      order: [['0', 'desc']],
      dom:
          '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [
        [10, 25, 50, 100, 250, 500, -1],
        [10, 25, 50, 100, 250, 500, "All"],
      ],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle mr-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1, 2, 3, 4] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        },
        {
          text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4 hide' }) + 'Add Applicant',
          className: 'create-new btn btn-primary',
          attr: {
            'data-toggle': 'modal',
            'data-target': '#add-student-modal'
          },
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details of ' + data['full_name'];
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              console.log(columns);
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                  ? '<tr data-dt-row="' +
                  col.rowIndex +
                  '" data-dt-column="' +
                  col.columnIndex +
                  '">' +
                  '<td>' +
                  col.title +
                  ':' +
                  '</td> ' +
                  '<td>' +
                  col.data +
                  '</td>' +
                  '</tr>'
                  : '';
            }).join('');

            return data ? $('<table class="table"/>').append(data) : false;
          }
        }
      },
      language: {
        paginate: {
          // remove previous & next text from pagination
          previous: '&nbsp;',
          next: '&nbsp;'
        }
      }
    });
    $('div.head-label').html('<h6 class="mb-0">Applicants Data Table</h6>');
  }

  // Flat Date picker
  if (dt_date_table.length) {
    dt_date_table.flatpickr({
      monthSelectorType: 'static',
      dateFormat: 'm/d/Y'
    });
  }

  // Add New record
  // ? Remove/Update this code as per your requirements ?
  let add_student_form = $('#add-student-form')
  add_student_form.submit(function (e) {
    e.preventDefault()
    $.ajax({
      url: add_student_form.attr('action'),
      type: 'post',
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (res) {
        if (res.status === 'fail') {
          let msg = ''
          $.each(res.error, function (a, b) {
            msg = b
            message('error', msg)
          })
        } else {
          add_student_form[0].reset()
          hold_modal('add-student-modal', 'hide')
          dt_students.ajax.reload()
          message('success', res.message)
        }
      }
    })
  })

  let edit_student_form = $('#edit-student-form')
  edit_student_form.submit(function (e) {
    e.preventDefault()
    $.ajax({
      url: edit_student_form.attr('action'),
      type: 'post',
      data: new FormData(this),
      cache: false,
      contentType: false,
      processData: false,
      success: function (res) {
        if (res.status === 'fail') {
          let msg = ''
          $.each(res.error, function (a, b) {
            msg = b
            message('error', msg)
          })
        } else {
          edit_student_form[0].reset()
          hold_modal('edit-student-modal', 'hide')
          dt_students.ajax.reload()
          message('success', res.message)
        }
      }
    })
  })

});
