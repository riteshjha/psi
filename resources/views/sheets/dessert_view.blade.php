 <div class="modal showComments" role="dialog">
                <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title comments_header">Modal Header</h4>
                        </div>
                        <div class="modal-body comments_body">
                          <div class="form-group">
                          <label for="comment">Comment:</label>
                          <textarea class="form-control comment" rows="5"></textarea>
                        </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default save">Save</button>

                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                    </div>
                  </div>
                  <table class="table table-borderd">
                <thead class="thead-dark">
                <tr>
                <th>Date</th>
                <th>Time</th>
                <th>No</th>
                <th class="border_field">Staff No.</th>
                <th class="border_field">Country</th>
                <th class="border_field">Name（フリガナ）</th>
                <th class="border_field">Name（氏名）</th>
                <th class="border_field">Tel No</th>
                <th class="background_responsible">Responsible</th>
                <th class="background_responsible">Conformation the day before</th>
                <th class="background_responsible">Responsible</th>
                <th class="background_responsible">Conform 3 hours ago</th>
                <th>Arrival time in case of late arrival</th>
                <th>Reason for late arrival and absence</th>
                <th>Call Medium/Through</th>
                <th>Comments</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($dessert as $dessert_row)
                <?php
                $i=0;
                $total_reserved=0;
                $total_reserved=count($dessert_row['dessert_info']);
                ?>
                @foreach($dessert_row['dessert_info'] as $key=> $info)
                        <tr>
                            <td class='background_global'> {{$dessert_row['date']}} </td>
                            <td class='background_global'> {{$dessert_row['time']}} </td>
                            <td class='background_global'> {{$key+1}} </td>
                            <td class="border_field contenteditable" contenteditable="true">{{$info->staff_no}}</td>
                            <td  class="border_field">{{$info->country_citizenship}}</td>
                            <td  class="border_field">{{$info->phoetic_kanji}}</td>
                            <td  class="border_field">{{$info->name}}</td>
                            <td  class="border_field">{{$info->cell_no}}</td>
                            <td class="background_responsible contenteditable" contenteditable="true" data-usage='responsibile'>{{$info->responsible1}}</td>
                            <td class="background_responsible" data-usage='confirmation'>
                                <select class='form-control confirmation'>
                                	<option value=''>--select--</option>
                                	<option value='OK' {{ ($info->conformation_day_before=='OK') ? 'selected':''}}>OK</option>
                                	<option value='Not OK' {{ ($info->conformation_day_before=='Not OK') ? 'selected':''}}>Not OK</option>
                                	<option value='No response' {{ ($info->conformation_day_before=='No response') ? 'selected':''}}>No response</option>
                                </select>
                            </td>
                            <td class="background_responsible contenteditable" contenteditable="true" data-usage='responsibile_1'>{{$info->responsible2}}</td>
                            <td class="background_responsible" data-usage='confirmation_1'>
                             <select class='form-control confirmation_1'>
                             		<option value=''>--select--</option>
                                	<option value='OK' {{ ($info->conformation_3_hours_ago=='OK') ? 'selected':''}}>OK</option>
                                	<option value='Not OK' {{ ($info->conformation_3_hours_ago=='Not OK') ? 'selected':''}}>Not OK</option>
                                	<option value='No response' {{ ($info->conformation_3_hours_ago=='No response') ? 'selected':''}}>No response</option>
                                </select>
                             </td>
                            <td class="contenteditable" contenteditable="true" data-usage='atlr'>{{$info->arrival_time_if_late}}</td>
                            <td class="contenteditable" contenteditable="true" data-usage='rlaa'>  </td>
                            <td  data-usage='cmt'>
                            <select class='form-control cmt'>
                            		<option value=''>--select--</option>
                                	<option value='viber' {{ ($info->call_medium=='viber') ? 'selected':''}}>viber</option>
                                	<option value='call' {{ ($info->call_medium=='call') ? 'selected':''}}>call</option>
                                </select>
                             </td>
                             <td>0</td>
                             <td><button type="button" class="btn btn-primary add_now">Delete</button></td>
                             <td style='visibility: hidden;display: none;'></td>
                             <td style='visibility: hidden;display: none;'></td>
                             <td style='visibility: hidden;display: none;'></td>
                             <td style='visibility: hidden;display: none;'></td>
                             <td style='visibility: hidden;display: none;'></td>
                             <td style='visibility: hidden;display: none;'>{{$dessert_row['id']}}</td>
                             <td style='visibility: hidden;display: none;'>{{$info->id}}</td>

                        </tr>
                        @endforeach
                    @for($i=$total_reserved+1;$i<=($dessert_row['total_require']);$i++)
                        <tr>
                            <td class='background_global'> {{$dessert_row['date']}} </td>
                            <td class='background_global'> {{$dessert_row['time']}} </td>
                            <td class='background_global'> {{$i}} </td>
                            <td class="border_field contenteditable" contenteditable="true">  </td>
                            <td  class="border_field">  </td>
                            <td  class="border_field">  </td>
                            <td  class="border_field">  </td>
                            <td  class="border_field">  </td>
                            <td class="background_responsible contenteditable" contenteditable="true" data-usage='responsibile'>  </td>
                            <td class="background_responsible" data-usage='confirmation'>
                                <select class='form-control confirmation'>
                                	<option value=''>--select--</option>
                                	<option value='OK'>OK</option>
                                	<option value='Not OK'>Not OK</option>
                                	<option value='No response'>No response</option>
                                </select>
                            </td>
                            <td class="background_responsible contenteditable" contenteditable="true" data-usage='responsibile_1'>  </td>
                            <td class="background_responsible" data-usage='confirmation_1'>
                             <select class='form-control confirmation_1'>
                             		<option value=''>--select--</option>
                                	<option value='OK'>OK</option>
                                	<option value='Not OK'>Not OK</option>
                                	<option value='No response'>No response</option>
                                </select>
                             </td>
                            <td class="contenteditable" contenteditable="true" data-usage='atlr'>  </td>
                            <td class="contenteditable" contenteditable="true" data-usage='rlaa'>  </td>
                            <td  data-usage='cmt'>
                            <select class='form-control cmt'>
                            		<option value=''>--select--</option>
                                	<option value='viber'>viber</option>
                                	<option value='call'>call</option>
                                </select>
                             </td>
                             <td>0</td>
                             <td></td>
                             <td style='visibility: hidden;display:none'></td>
                             <td style='visibility: hidden;display:none'></td>
                             <td style='visibility: hidden;display:none'></td>
                             <td style='visibility: hidden;display:none'></td>
                             <td style='visibility: hidden;display:none'></td>
                             <td style='visibility: hidden;display:none'>{{$dessert_row['id']}}</td>
                             <td style='visibility: hidden;display: none;'></td>
                        </tr>
                        @endfor
                        @if($dessert_row['total_require']==0)
                        <tr>
                            <td> {{$dessert_row['date']}} </td>
                            <td> {{$dessert_row['time']}} </td>
                        <td colspan='13'>Not available, <a href="{{Route('shift.show',$dessert_row['master_id'])}}" target='_blank'>Add here </a></td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>


            </table>
            <input type='hidden' id='all_saved_value'>



            <script>
            var allowed_field=[4,5,6,7];
            var main_val;
            var allowed_pop_up=['Not OK','No response'];
            var is_model_alert=false;
            var last_psi='';
            var last_select='';

                $('body').on('focus change', '[contenteditable]', function(ee) {
                    const $this = $(this);
                    $this.data('before', $this.html());

                    console.log('preparation..');
                    fixCellValue($this);

                    is_model_alert=false;
                    console.log($('#all_saved_value').data());
                }).on('blur', '[contenteditable]', function(e) {
                    const $this = $(this);
                    if ($this.data('before') !== $this.html()) {
                        $this.data('before', $this.html());
                        $this.trigger('change');
                        main_val=$(this).html();
                        var requestor=$this.data('usage');
						if(typeof requestor !=='undefined' && requestor === 'responsibile'){
							$('#all_saved_value').data('8',$(this).html());
						}
						else if(typeof requestor !=='undefined' && requestor === 'responsibile_1'){
							$('#all_saved_value').data('10',$(this).html());
						}
						else if(typeof requestor !=='undefined' && requestor === 'atlr'){
							$('#all_saved_value').data('12',$(this).html());
						}
						else if(typeof requestor !=='undefined' && requestor === 'rlaa'){
							$('#all_saved_value').data('13',$(this).html());
						}
						else{

                            $('#all_saved_value').data('3',main_val);
                            added_generated_value=$('#all_saved_value').data('23');
                            company_schedule_id=$('#all_saved_value').data('22');
                            console.log('dessert_id '+added_generated_value);
    						$.ajax({
    	                        type:"GET",
    	                        url:"/dessert/findDetails",
    	                        data:{'psi_num':main_val,'dessert_id':added_generated_value,'schedule_id':company_schedule_id},
    	                        dataType:'json',
    	                        success:function(data){
    	                        	main_logical_data=data;
    	                        	$.each(data,function(i,v){
    	                        		$('#all_saved_value').data(i,v);
    		                        });
    	                        	findDetails($this);
    	                        }

    	                    });
						}
                    }
                });
                $('.add_now').click(function(){
                    return;
                	getCell($(this));
					all_record=$('#all_saved_value').data();
					$.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'POST',
                        url:"{{ route('dessert.store') }}",
                        data:{allRecord:all_record},
                        success:function(data){
                            console.log(data);

                        }
                    });
                });
                $('.confirmation').change(function(){
                	is_model_alert='';
						var confirmation_data=$(this).find('option:selected').val();
						var my_this=$(this);
						if($.inArray(confirmation_data,allowed_pop_up) !=-1){
							if(is_model_alert!=confirmation_data){
     							is_model_alert=confirmation_data;
     							$('.modal-title').html('<strong>Conformation the day before </strong> for'+$('#all_saved_value').data('0')+','+$('#all_saved_value').data('1')+','+$('#all_saved_value').data('2'));
     							$('.showComments').modal('show');
     							$('.save').click(function(){

    									comment_val=$('.comment').val();
    									my_this.closest('tr').find('td').each(
    					                	    function (i) {
    					                    	    if(i==20){
    			    		                	    	$('#all_saved_value').data(i.toString(),comment_val);
    			    		                    	    $(this).html(comment_val);
    					                    	    }
    					                	    });
    									$('.showComments').modal('hide');
         						});
							}
						}
						$(this).data('confirmation_status',confirmation_data);
						$(this).closest('tr').find('td').each(
		                	    function (i) {
		                    	    if(i==17){
    		                	    	$('#all_saved_value').data(i.toString(),confirmation_data);
    		                    	    $(this).html(confirmation_data);
		                    	    }
		                	    });

						$('#all_saved_value').data('9',confirmation_data);

                 });
                $('.confirmation_1').change(function(){
                		is_model_alert='';
						var confirmation_data=$(this).find('option:selected').val();
						$(this).data('confirmation_status_1',confirmation_data);

						var my_this=$(this);
						if($.inArray(confirmation_data,allowed_pop_up) !=-1){
							if(is_model_alert!=confirmation_data){
     							is_model_alert=confirmation_data;
     							$('.modal-title').html('<strong>Conform 3 hours ago </strong> for'+$('#all_saved_value').data('0')+','+$('#all_saved_value').data('1')+','+$('#all_saved_value').data('2'));
     							$('.showComments').modal('show');
     							$('.save').click(function(){

    									comment_val=$('.comment').val();
    									my_this.closest('tr').find('td').each(
    					                	    function (i) {
    					                    	    if(i==21){
    			    		                	    	$('#all_saved_value').data(i.toString(),comment_val);
    			    		                    	    $(this).html(comment_val);
    					                    	    }
    					                	    });
    									$('.showComments').modal('hide');
         						});
							}
						}
						$(this).closest('tr').find('td').each(
		                	    function (i) {
		                    	    if(i==18){
    		                	    	$('#all_saved_value').data(i.toString(),confirmation_data);
    		                    	    $(this).html(confirmation_data);
		                    	    }
		                	    });
						$('#all_saved_value').data('11',confirmation_data);

                 });
                $('.cmt').change(function(){
						var confirmation_data=$(this).find('option:selected').val();
						$(this).data('cmt',confirmation_data);
						$(this).closest('tr').find('td').each(
		                	    function (i) {
		                    	    if(i==19){
    		                	    	$('#all_saved_value').data(i.toString(),confirmation_data);
    		                    	    $(this).html(confirmation_data);
		                    	    }
		                	    });
						$('#all_saved_value').data('14',confirmation_data);

                 });
                function findDetails(obj){
                	obj.closest('tr').find('td').each(
                    	    function (i) {
                            	    if($.inArray(i,allowed_field) != -1){
                                	    $(this).html($('#all_saved_value').data(i.toString()));
                            	    }
                        	    if($.inArray(i,[0,1,2]) != -1){
                            	    $('#all_saved_value').data(i.toString(),$(this).html());
                        	    }
                    	    });
                }
                function fixCellValue(obj){
                	$('.comment').val('');
                	obj.closest('tr').find('td').each(
                	    function (i) {
                    	    if($.inArray(i,[9,11,14]) ==-1){
                    	    	$('#all_saved_value').removeData('"'+i+'"');
                	    		$('#all_saved_value').data(i.toString(),$(this).html());
                    	    }
                    	    else{
                        	    if(i==9){
                            	    console.log($(this).data('confirmation_status'));
                        	    	$('#all_saved_value').data(i.toString(),$(this).data('confirmation_status'));
                        	    }
                        	    else if(i==11){
                            	    console.log($(this).data('confirmation_status_1'));
                        	    	$('#all_saved_value').data(i.toString(),$(this).data('confirmation_status_1'));
                        	    }
                        	    else if(i==14){
                            	    console.log($(this).data('cmt'));
                        	    	$('#all_saved_value').data(i.toString(),$(this).data('cmt'));
                        	    }
                        	   }
                	    });
                    }
                function getCell(obj){


                	obj.closest('tr').find('td').each(
                	    function (i) {
                	    	$('#all_saved_value').data(i.toString(),$(this).html());
                	    });
                    }



            $(window).scroll(function(){
                var stickyOffset = $('thead').offset().top
                var sticky = $("thead th "),
                    scroll = $(window).scrollTop();

                if (scroll > stickyOffset) sticky.addClass('sticky-top');
                else sticky.removeClass('sticky-top');
            });

            </script>