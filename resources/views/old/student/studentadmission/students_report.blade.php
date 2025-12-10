@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'studentregister',
])

@section('content')
    <style>
        .actionBtn {
            transition: transform 0.15s ease, background-color 0.3s ease;
        }

        .actionBtn:hover {
            transform: scale(0.90);
            /* background-color: #37b972 !important; */
            background-color: rgba(81, 203, 206 0.5) !important;
        }
    </style>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <p class="h6"><i class="fa fa-user"></i>&nbsp;&nbsp;Student Register</p>
                </div>
                <hr>
                <form id="searchForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date_range"> Date</label>
                                <input type="text" class="form-control" id="date_range" name="date_range" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="enroll_number">Enroll No.</label>
                                <input type="text" class="form-control" id="enroll_number" name="enroll_number" />
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="class_id">Current Class</label>
                                <select class="form-control" id="cur_class_id" name="cur_class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classMaster as $class)
                                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="">Select Type</option>
                                    <option value="Defence" @if ((isset($getdata->type) && $getdata->type == 'Defence') || old('type') == 'Defence') selected @endif>Defence
                                    </option>
                                    <option value="Civil Defence" @if ((isset($getdata->type) && $getdata->type == 'Civil Defence') || old('type') == 'Civil Defence') selected @endif>Civil
                                        Defence</option>
                                    <option value="ESM" @if ((isset($getdata->type) && $getdata->type == 'ESM') || old('type') == 'ESM') selected @endif>ESM</option>
                                    <option value="Civ Gov Employee" @if ((isset($getdata->type) && $getdata->type == 'Civ Gov Employee') || old('type') == 'Civ Gov Employee') selected @endif>Civ
                                        Gov Employee</option>
                                    <option value="Civilian" @if ((isset($getdata->type) && $getdata->type == 'Civilian') || old('type') == 'Civilian') selected @endif>Civilian
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="disability_id">Unique Disability</label>
                                <select class="form-control" id="disability_id" name="disability_id">
                                    <option value="">Select Disability</option>
                                    @foreach ($disabilityMatser as $disability)
                                        <option value="{{ $disability->id }}">{{ $disability->disability_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 text-right">
                            <button type="button" id="searchBtn" class="btn btn-primary actionBtn">
                                <div class="spinner-border spinner-border-sm text-white d-none " role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span class="btn-text">{{ __('Search') }}</span>
                            </button>
                            <button type="button" id="clearBtn" class="btn btn-secondary actionBtn">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card reporttable" style="display: none;">
            <div class="card-body">
                <div class="rp_table">
                    <table class="table table-bordered" id="studentsTable">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Photo</th>
                                <th>Enroll No.</th>
                                <th>Name</th>
                                <th>Current Class</th>                               
                                <th>Mobile</th>
                                <th>DOB</th>
                                <th>Disability</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- PHOTO modal --}}
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">

                <div class="qrcontainer" id="PhotoCode">
                    <!-- Header with Close Button -->
                    <div class="modal-header">
                        <h6 class="modal-title">Student Photo</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-0">
                        <img id="StudentImage" src="#" controls autoplay />
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer justify-content-between">

                </div>

            </div>
        </div>
    </div>
    {{-- end Photo modal --}}
    <script>
        $(document).ready(function() {
            $('.reporttable').hide();
            let dataTable = null;

            $('#searchBtn').click(function() {
                var $btn = $(this).find('.spinner-border');
                $('.spinner-border').removeClass('d-none');
                $('#searchBtn').find('.btn-text').text('Signing in...');
                let dateRange = $('#date_range').val();
                let dates = dateRange ? dateRange.split(' to ') : [];
                let studentRoute = "{{ route('studentdetailsbyid', ['id' => ':id']) }}";
                let progressReportRoute = "{{ route('progressreport_form', ['action' => 'Add', 'id' => ':id']) }}";
                let academicReportRoute = "{{ route('academicreport_form', ['action' => 'Add', 'id' => ':id']) }}";
                let formData = $('#searchForm').serializeArray();
                formData.push({
                    name: 'start_date',
                    value: dates[0] || ''
                });
                formData.push({
                    name: 'end_date',
                    value: dates[1] || ''
                });

                $.ajax({
                    url: "{{ route('studentregister.fetch') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        $('.spinner-border').addClass('d-none');
                        $('#searchBtn').find('.btn-text').text('Search');
                        let tbody = $('#studentsTable tbody');
                        tbody.empty();
                        $('.reporttable').show();
                        let baseUrl = "{{ asset('student_documents') }}/";
                        if (response.length > 0) {
                            $.each(response, function(index, data) {  
                                let studentUrl = studentRoute.replace(':id', data.id);
                                let progressReportUrl='';
                                let academicReportUrl = '';
                                if(data.progress_main || data.progress_report || data.progress_report_cur){
                                  progressReportUrl = progressReportRoute.replace('Add', 'Edit').replace(':id', data.id);
                                }else{
                                 progressReportUrl = progressReportRoute.replace(':id', data.id);
                                }

                                if(data.academic_main || data.academic_report || data.academic_report_cur){
                                  academicReportUrl = academicReportRoute.replace('Add', 'Edit').replace(':id', data.id);
                                }else{
                                 academicReportUrl = academicReportRoute.replace(':id', data.id);
                                }
                               
                                let row = `
                                    <tr>
                                        <td>${index+1}</td>
                                        <td>
                                        <a class="text-primary student_photo" title="View" data-toggle="modal"
                                                    data-target="#PhotoModal" data-src="${baseUrl}${data.student_documents?.image || 'child_profile_pic.jpg'}">
                                        <img src="${baseUrl}${data.student_documents?.image || 'child_profile_pic.jpg'}" style="width: 50px;"></a>
                                        </td>
                                        {{-- <td>${data.session ?? 'NA'}</td> --}}
                                        {{-- <td>${data.admission_date ?? 'NA'}</td>  --}}
                                        <td>${data.enroll_number ?? 'NA'}</td>
                                        <td>${data.student_name ?? 'NA'}</td>
                                        {{-- <td>${data.adm_class ? data.adm_class.class_name : 'NA'}</td> --}}
                                        <td>${data.cur_class ? data.cur_class.class_name : 'NA'}</td>
                                        {{-- <td>${data.type ?? 'NA'}</td>  --}}
                                        {{-- <td>${data.fathers_name ?? 'NA'}</td>   --}}
                                        {{-- <td>${data.mothers_name ?? 'NA'}</td>  --}}
                                        {{-- <td>${data.state ? data.state.state_name : 'NA'}</td>  --}}
                                        {{--  <td>${data.city ? data.city.city_name : 'NA'}</td> --}}
                                        {{-- <td>${data.address ?? 'NA'}</td>  --}}
                                        <td>${data.mobile ?? 'NA'}</td>
                                        {{-- <td>${data.sex ?? 'NA'}</td> --}}
                                        <td>${data.dob ?? 'NA'}</td>
                                        {{-- <td>${data.age ?? 'NA'}</td>  --}}
                                        <td> ${   data.student_disability && data.student_disability.length > 0
                                            ? data.student_disability.map(d => d.disability.disability_name).join('<br>')
                                            : 'NA'
                                        }
                                        </td>

                                        {{-- <td>${data.aadhar_no ?? 'NA'}</td> --}}
                                        <td class="not-export text-center viewdetail">
                                                    <a href="${studentUrl}" class="text-primary" data-toggle="tooltip"  title="View Full Details" target="_blank">                                           
                                                        <i class="fa fa-eye"></i> 
                                                    </a>&nbsp;
                                       
                                         {{-- start progress report --}}
                                                    
                                                    <a href="${progressReportUrl}"
                                                        class="text-warning " title="Progress Report" data-toggle="tooltip" data-placement="bottom">
                                                        <i class="fa-solid fa-bars-progress"></i>
                                                    </a>&nbsp;
                                                    <a href="${academicReportUrl}"
                                                        class="text-warning" title="Academic Report" data-toggle="tooltip" data-placement="top">
                                                        <i class="fa-solid fa-square-poll-horizontal"></i>
                                                    </a>&nbsp;
                                                     {{-- end progress report --}}
                                             </td>
                                    </tr>`;
                                tbody.append(row);
                            });

                            if ($.fn.dataTable.isDataTable('#studentsTable')) {
                                dataTable.clear().draw();
                            }
                        } else {
                            tbody.append(
                                '<tr><td colspan="18" class="text-center">No records found</td></tr>'
                            );
                            if ($.fn.dataTable.isDataTable('#studentsTable')) {
                                dataTable.clear().destroy();
                            }
                        }
                    }
                });
            });

            $('#clearBtn').click(function() {
                $('#date_range').val('');
                $('#searchForm')[0].reset();
                $('#studentsTable tbody').empty();
                $('.reporttable').hide();
                $('#date_range').data('daterangepicker').setStartDate(moment().startOf('day'));
                $('#date_range').data('daterangepicker').setEndDate(moment().endOf('day'));
            });


        });
    </script>
    <script>
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        $(document).on('click', '.student_photo', function(e) {
            var photoUrl = $(this).data('src');
            $('#StudentImage').attr('src', photoUrl);
        });
    </script>
@endsection
