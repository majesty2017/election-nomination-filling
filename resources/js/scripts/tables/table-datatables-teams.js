/**
 * DataTables Basic
 */

$(function () {
  'use strict';

  var dt_teams_table = $('.datatables-teams'),
      dt_date_table = $('.datepicker'),
      assetPath = '../../../app-assets/';

  if ($('body').attr('data-framework') === 'laravel') {
    assetPath = $('body').attr('data-asset-path');
  }

  // DataTable with buttons
  // --------------------------------------------------------------------

  if (dt_teams_table.length) {
    var dt_team = dt_teams_table.DataTable({
      ajax: '/teams/team-lists',
      columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'designation' },
        { data: 'description' },
        { data: '' }
      ],
      columnDefs: [
        {
          targets: 0,
          visible: false
        },
        {
          // Avatar image/badge, Name and post
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            var $team_img = full['image'],
                $name = full['name'];
            if ($team_img) {
              // For Avatar image
              var $output =
                  '<img src="' + assetPath + 'images/teams/team-uploads/' + $team_img + '" alt="Avatar" width="32" height="32">';
            } else {
              // For Avatar badge
              var stateNum = full['status'];
              var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
              var $state = states[stateNum],
                  $name = full['full_name'],
                  $initials = $name.match(/\b\w/g) || [];
              $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
              $output = '<span class="avatar-content">' + $initials + '</span>';
            }

            var colorClass = $team_img === '' ? ' bg-light-' + $state + ' ' : '';
            // Creates full output for row
            var $row_output =
                '<div class="d-flex justify-content-left align-items-center">' +
                '<div class="avatar ' +
                colorClass +
                ' mr-1">' +
                $output +
                '</div>' +
                '<div class="d-flex flex-column">' +
                '<span class="emp_name text-truncate font-weight-bold">' +
                $name +
                '</span>' +
                '</div>' +
                '</div>';
            return $row_output;
          }
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
                '<a href="javascript:;" onclick="view_teams('+full.id+')" class="dropdown-item">' +
                feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) +
                'Details</a>' +
                '<a href="javascript:;" onclick="deleteAlert(`/teams/destroy`, '+full.id+')" class="dropdown-item delete-record">' +
                feather.icons['trash-2'].toSvg({ class: 'font-small-4 mr-50' }) +
                'Delete</a>' +
                '</div>' +
                '</div>' +
                '<a href="javascript:;" onclick="edit_teams('+full.id+')" class="item-edit">' +
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
              exportOptions: { columns: [2, 3, 4, 5] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4, 5] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4, 5] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4, 5] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [2, 3, 4, 5] }
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
          text: feather.icons['plus'].toSvg({ class: 'mr-50 font-small-4' }) + 'Add Team',
          className: 'create-new btn btn-primary',
          attr: {
            'data-toggle': 'modal',
            'data-target': '#add-team-modal'
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
    $('div.head-label').html('<h6 class="mb-0">Teams Data Table</h6>');
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
  let add_team_form = $('#add-team-form')
  add_team_form.submit(function (e) {
    e.preventDefault()
    $.ajax({
      url: add_team_form.attr('action'),
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
          add_team_form[0].reserved
          hold_modal('add-team-modal', 'hide')
          dt_team.ajax.reload()
          message('success', res.message)
        }
      }
    })
  })

  let edit_team_form = $('#edit-team-form')
  edit_team_form.submit(function (e) {
    e.preventDefault()
    $.ajax({
      url: edit_team_form.attr('action'),
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
          edit_team_form[0].reserved
          hold_modal('edit-team-modal', 'hide')
          dt_team.ajax.reload()
          message('success', res.message)
        }
      }
    })
  })

});
