@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <style>

    </style>
    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-checkmark"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Confirmation</span>
                        <span class="info-box-number">{{isset($dessert_report['OK'])??$dessert_report['OK']}}55%</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-9 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Confirmed Shift</span>
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block" style='margin: 8px -10px!important'>
                                    <h5 class="description-header"> 5/5{{--{{$employee_summery[0]->total_count}}--}}</h5>
                                    <span class="description-text" style='text-transform: none;'>Tomorrow</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block" style="margin: 8px -10px!important;">
                                    <h5 class="description-header"> 4/5{{--}}{{$employee_summery[1]->total_count}}--}}</h5>
                                    <span class="description-text" style='text-transform: none;'>Tomorrow To Week</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block" style="margin: 8px -10px!important;">
                                    <h5 class="description-header">2/5{{--{{$employee_summery[2]->total_count}}--}}</h5>
                                    <span class="description-text"
                                          style='text-transform: none;'>Tomorrow To Month</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('dashboard.cardExpire')</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped" id='expire_info'>
                            <thead>
                            <tr>
                                <th>@lang('dashboard.psisno')</th>
                                <th>@lang('dashboard.name')</th>
                                <th>@lang('dashboard.cellno')</th>
                                <th>@lang('dashboard.expiredate')   </th>
                                <th>@lang('dashboard.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($dashboard as $card)
                                <tr>
                                    <td>{{$card->psi_number}}</td>
                                    <td>{{$card->name}}</td>
                                    <td>{{$card->cell_no}}</td>
                                    <td>{{$card->residence_card_exp_date}}</td>
                                    <td class='viber_messessing'><span class=""><a href="#"><i
                                                        class="far fa-comment-dots"></i></a></span>&nbsp;&nbsp;<span
                                                class=""><a href="#"><i class="fas fa-phone"></i></a></span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{route('exp_date')}}" class="uppercase">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('dashboard.tn')</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered" id='tn_table'>
                            <thead>
                            <tr>
                                <th>Section</th>
                                <th>Sub-Section</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Total</th>
                                <th>Necessary</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($total_ncessary_data as $tn_data)
                                <tr>
                                    <td>{{$tn_data->master_main_company}}</td>
                                    <td>{{$tn_data->name}}</td>
                                    <td>{{$tn_data->DATE}}</td>
                                    <td>{{$tn_data->time}}</td>
                                    <td>{{$tn_data->total_used}}</td>
                                    <td>{{$tn_data->total_require}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{route('total_necessary')}}" class="uppercase">View All</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('dashboard.rssa')</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped" id='rda_table'>
                            <thead>
                            <tr>
                                <th>PsisNo</th>
                                <th>Responsible</th>
                                <th>Activity</th>
                                <th>Date</th>
                                <th>Comment</th>
                                <th>Total comments</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($recent_dessert_activity as $rda_info)
                                <tr>
                                    <td>{{$rda_info->staff_no}}</td>
                                    <td>{{$rda_info->operator}}</td>
                                    <td>{{$rda_info->activity}}</td>
                                    <td>{{$rda_info->date}}</td>
                                    <td>{{$rda_info->comments}}</td>
                                    <td>{{$rda_info->total_comment}}</td>
                                    <td><span class=""><a href="#"><i class="far fa-comment-dots"></i></a></span>&nbsp;&nbsp;<span
                                                class=""><a href="#"><i class="fas fa-phone"></i></a></span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{route('recent_sheet')}}" class="uppercase">View All</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Viber Alert Summary</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped" id='alert_viber'>
                            <thead>
                            <tr>
                                <th>Message Type</th>
                                <th>Sent</th>
                                <th>Response Count</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Residence card expiry</td>
                                <td>2</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>One day before</td>
                                <td>1</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>3 hour before</td>
                                <td>3</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>Arrival confirmation</td>
                                <td>1</td>
                                <td>5</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="box-footer text-center">
                        <a href="{{route('alert_summary')}}" class="uppercase">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.modal',['modal_id'=>'card_expiry','modal_title'=>'Viber Notification'])
@endsection
@push('scripts')
    <script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
    <script>
        var last_click = '';
        $(document).ready(function () {
            $('#tn_table').DataTable({"pageLength": 3});
            $('#expire_info').DataTable({"pageLength": 3});
            $('#rda_table').DataTable({"pageLength": 3});
            $('#alert_viber').DataTable({"pageLength": 4});
        });
        $('.viber_messessing').on('click', function (e) {
            $('#card_expiry').modal('show');
            $("#card_expiry").appendTo("body");
            if (last_click !== '') {
                last_click.removeClass('text-danger');
                last_click = $(this).closest('tr');
                last_click.addClass('text-danger');
            }
            else {
                last_click = $(this).closest('tr');
                last_click.addClass('text-danger');
            }
            $('.profile-username').html(last_click.find("td:eq(1)").text());
        });
        $('.send_it_now').on('click', function () {
            var comments = $('#comment').val();
            var psis_no = last_click.find("td:eq(0)").text();
            console.log(psis_no);
            console.log(comments);
            $('#comment').val('');
        });
        $(document).on('click', '#messags_view', function () {
            char_class = $('#message_send_view').attr('class');
            char_class = $('#chat_view').attr('class');
            $('#message_send_view').removeClass();
            $('#message_send_view').addClass('col-sm-4');
            $('#chat_view').show('100');
        });
        $('#card_expiry').on('hidden.bs.modal', function () {
            $('#chat_view').hide();
            $('#message_send_view').removeClass();
            $('#message_send_view').addClass('col-sm-9');
        });
    </script>

@endpush
