@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'login_activity',
])

@section('content')
    <div class="content">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class=" d-flex justify-content-between align-items-center ">
                            <div class="col-md-4">
                                <h6 class="card-title mb-0"><i class="nc-icon nc-tile-56"></i> User Login Activity List</h6>
                            </div>
                            <div class="">
                                <form id="dateFilterForm" class="d-flex align-items-center gap-2 flex-wrap" method="GET"
                                    action="{{ route('login.activities') }}">
                                    <!-- From Date -->
                                    <div class="input-group col-md-4 mb-0">
                                        <span class="input-group-text" style="padding: 0px 10px;">
                                            F
                                        </span>
                                        <input type="date" name="from_date" id="fromDate"
                                            value="{{ request('from_date') }}" class="form-control datepicker"
                                            placeholder="Start Date" autocomplete="off" onChange="resetenddate()">
                                    </div>

                                    <!-- To Date -->
                                    <div class="input-group col-md-4 mb-0   ">
                                        <span class="input-group-text" style="padding: 0 10px;">
                                            T
                                        </span>
                                        <input type="date" name="to_date" id="toDate" class="form-control datepicker"
                                            value="{{ request('to_date') }}" placeholder="End Date" autocomplete="off">
                                    </div>

                                    <!-- Filter Button -->
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                            Filter
                                        </button>

                                        <!-- Reset Button -->
                                        <button type="button" id="resetFilter" class="btn btn-sm btn-outline-secondary"
                                            style="background: none; color: darkgray; border: 2px solid darkgray;">
                                            Reset
                                        </button>

                                    </div>
                                </form>

                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-center table-bordered alltable" id="example">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Last Login</th>
                                        <th>Last Logout</th>
                                        <th>IP Address</th>
                                        <th>Browser</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data as $index => $getdata)
                                        <tr>
                                            <td>{{ $index + 1 ?? 'NA' }} </td>
                                            <td>
                                               <div class="d-flex align-items-end">
                                                 <img src="{{ asset('teacher_documents/teacher_icon.png') }}"
                                                    class="card-img-top" alt="Image"
                                                    style="width: 25px; object-fit: cover; padding-right:4px;">
                                                {{ $getdata?->users?->user_id ?? 'NA' }}
                                               </div>
                                            </td>
                                            <td>{{ $getdata?->users?->name ?? 'NA' }} </td>
                                            <td>{{ $getdata?->logged_in_at ? \Carbon\Carbon::parse($getdata->logged_in_at)->format('dM Y H:i:s') : 'NA' }}
                                            </td>
                                            <td>{{ $getdata?->logged_out_at ? \Carbon\Carbon::parse($getdata->logged_out_at)->format('dM Y H:i:s') : 'NA' }}
                                            </td>
                                            <td>{{ $getdata?->ip_address ?? 'NA' }} </td>
                                            <td>{{ $getdata?->user_agent ?? 'NA' }} </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script>
            $('#resetFilter').click(function() {
                $('#fromDate').val('');
                $('#toDate').val('');
                const data = $(this).serialize();
                window.location = "{{ route('login.activities') }}" + "?" + data;
            });

            $('#dateFilterForm').submit(function(e) {
                e.preventDefault();
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();
                if (!fromDate || !toDate) {
                    alert("Please select both start and end dates");
                    document.getElementById("fromDate").value = '';
                    document.getElementById("toDate").value = '';
                    return;
                }

                // Validate date range
                if (fromDate && toDate && new Date(fromDate) > new Date(toDate)) {
                    alert('End date must be greater than or equal to start date');
                    document.getElementById("fromDate").value = '';
                    document.getElementById("toDate").value = '';
                    return false;
                }

                const data = $(this).serialize();
                window.location = "{{ route('login.activities') }}" + "?" + data;
            });

            function resetenddate() {
                document.getElementById("toDate").value = '';
            }
        </script>
    @endsection
