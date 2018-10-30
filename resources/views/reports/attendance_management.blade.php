@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Attendance Management</h3>
                    </div>
                    <div class="box-body">
                        <table id="attendance" class="table table-striped">
                            <thead>
                                <th>#</th>
                                <th>PSI-S No.</th>
                                <th>Name</th>
                                <th>Phonetic</th>
                                <th>Country</th>
                                <th>Shift</th>
                                <th>Subsection</th>
                                <th>Confirmation Day Before</th>
                                <th>Confirmation 3 Hours Before</th>
                                <th>Contact No.</th>
                                <th>出勤ｼｭｯｷﾝ</th>
                                <th>カード</th>
                                <th>出勤時刻</th>
                                <th>退勤時刻</th>
                                <th>Break Time</th>
                                <th>移動</th>
                            </thead>
                            <tbody>
                            @foreach($data as $index => $datum)
                                <tr>
                                    <td scope="row">{{$index + 1}}</td>
                                    <td>{{$datum->staff_no}}</td>
                                    <td>{{$datum->name}}</td>
                                    <td>{{$datum->phoetic_kanji}}</td>
                                    <td>{{$datum->country_citizenship}}</td>
                                    <td>{{substr($datum->start_time, 0, -3)}} - {{substr($datum->end_time, 0, -3)}}</td>
                                    <td>{{$datum->subsection}}</td>
                                    <td>{{$datum->conformation_day_before}}</td>
                                    <td>{{$datum->conformation_3_hours_ago}}</td>
                                    <td>{{$datum->cell_no}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
    <script>
        $(document).ready(function () {
            $('#attendance').DataTable({"pageLength": 20});
        });
    </script>

@endpush