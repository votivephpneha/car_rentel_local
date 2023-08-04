@if(count($car_list)>0)
@foreach($car_list as $c_list)
<?php

$car_price_data = DB::table('car_price_days')->where('car_id',$c_list->id)->get();

?>
<div class="tab-pane tab_pan" role="tabpanel">
<div class="card overflow-hidden">
    <div class="d-md-flex">
        <div class="item-card9-img">
            <div class="item-card9-imgs"><a href="#"></a> <img alt="img" class="cover-image" src="{{ url('public/uploads/cars') }}/{{ $c_list->image }}"></div>
        </div>
        <div class="card border-0 mb-0">
            <div class="card-body">
                <div class="item-card9">
					<div class="title_price">
						<div class="title_name_info">
                    <a class="text-dark" href="#"> <h4 class="font-weight-bold mt-1 mb-2">{{ $c_list->title }}</h4> 
					<p>{{ $c_list->car_description }}</p>
					</a>
                    <?php
                                                                $price_data = DB::table('car_price_days')->where('no_of_day','1 Day')->where('car_id',$c_list->id)->first();
                                                                $price = $price_data->price * $date_diff;

                                                                ?></div>
                                                                <div class="price_div">
                                                                    <div class="day_price">{{ $price_data->price }} <i class="fa fa-eur" aria-hidden="true"></i> /Day</div>
                                                                    <div class="tot_price">{{ $price }} <i class="fa fa-eur" aria-hidden="true"></i> Total</div>
                                                                </div>
																</div>
            <div class="item-card9-desc mb-2 mt-1" style="">
                <div class="row features_list">
                    <div class="col-lg-3 col-sm-3">
                        <div class="icon-set">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="feat-set">{{ $c_list->no_of_seats }} Seater</div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                        <div class="icon-set">
                            <i class="bi bi-gear"></i>
                        </div>
                        <div class="feat-set">{{ $c_list->vehicle_type }}</div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                        <div class="icon-set">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <div class="feat-set">{{ $c_list->no_of_km }}</div>
                    </div>
                    <div class="col-lg-3 col-sm-3">
                        <div class="icon-set">
                            <i class="bi bi-three-dots"></i>
                        </div>
                        <div class="feat-set">More</div>
                    </div>
                </div>
            </div>
                </div>
            </div>
            <div class="card-footer p-0">
                <div class="item-card9-footer btn-appointment">
                    <div class="btn-group w-100">
                        <a href="{{ url('/booking')}}/{{ $c_list->id }}" class="btn btn-outline-light w-34 p-2 border-top-0 border-end-0 border-bottom-0 call-btn">
                        <div class="book-btn-1"><i class="fe fe-phone me-1"></i>BOOK NOW</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
            <!-- <div class="card col_02 border-0 mb-0 price_det"> 
                <div class="card-body">
                    <div class="item-card-price">
                        <table>
  <tbody>
    @foreach($car_price_data as $car_price)
                                                                    <?php
                                                                        $price = $car_price->price;
                                                                        $price_cal = $date_diff*$price;
                                                                        $new_days = $car_price->no_of_day;
                                                                        $new_days1 = str_replace(" Day","",$new_days);
                                                                        $new_days2 = str_replace("+","",$new_days1);
                                                                        $new_days3 = $new_days2*$date_diff;

                                                                    ?>
  <tr>
    <?php
                                                                        $price = $car_price->price;
                                                                        $price_cal = $date_diff*$price;
                                                                        $new_days = $car_price->no_of_day;
                                                                        $new_days1 = str_replace(" Day","",$new_days);
                                                                        $new_days2 = str_replace("+","",$new_days1);
                                                                        $new_days3 = $new_days2*$date_diff;

                                                                    ?>
    <td>@if($new_days == "1 Day")   
                                                                    <?php
                                                                    echo str_replace("+","",$new_days3)." Days"
                                                                    ?>
                                                                    @else
                                                                     {{ $new_days3 }} + Days
                                                                    @endif</td>
    <td>|</td>
    <td>
        <?php
            $price = $car_price->price;
            $price_cal = $date_diff*$price;
        ?>
    ${{ $price_cal }}</td>
  </tr>
  @endforeach
 
</tbody>
</table>
                        
                    </div>
                </div>  
            </div> -->
    </div>
</div>
</div>
@endforeach
<div class="pagination-navs">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination" id="nav">
                                 <!-- <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </li>  -->
                            </ul>
                        </nav>
                    </div>
                    <div class="change_date_btn">
                        <a href="#" id="myBtn">Change Date</a>
                    </div>
@else
<div class="no-product"><h4>No Cars Found</h4></div>

@endif                    
                    