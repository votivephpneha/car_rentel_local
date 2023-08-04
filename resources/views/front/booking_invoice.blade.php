<div class="order_summry" style="border: 1px solid #e7e7e7; padding: 25px; border-radius: 7px;">
	<div class="order_invoice_mail">
		<?php
			$booking_mgmt = DB::table('booking_management')->where('booking_id',$booking_id)->get()->first();
			//echo $booking->total;
			
		?>
		<p><b>Hello <span style="color: #ff0091;">{{ $booking_mgmt->driver_first_name }} {{ $booking_mgmt->driver_last_name }}</span></b></p>
		<div class="info-invoice" style="display: flex;background: rgb(248, 248, 249);padding: 25px;border-radius: 12px;">
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Booking ID: <b>{{ $booking_mgmt->booking_id }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">To: <b>{{ $booking_mgmt->driver_first_name }} {{ $booking_mgmt->driver_last_name }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Country of Residence: <b>{{ $booking_mgmt->driver_country }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Phone No: <b>{{ $booking_mgmt->driver_contact_no }}</b></p >
		</div>	
		<div class="info-invoice" style="display: flex;background: rgb(248, 248, 249);padding: 25px;border-radius: 12px;">
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Pickup Location: <b>{{ $pickup_location }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Drop Off Location: <b>{{ $drop_off_location }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Pickup Date: <b>{{ $pickup_date }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Drop Off Date: <b>{{ $drop_off_date }}</b></p >
		</div>	
	</div>
	<h2 style="font-size: 18px;color: #ff0091;margin-bottom: 5px;">Order Details</h2>
	<table style="width:100%;">
		<thead>
			<tr>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;border-radius: 20px 0 0 20px;">#</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Title</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Image</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Vehicle Type</th>
				
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Unit Price</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;border-radius: 0px 20px 20px 0px;">Total Price</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$booking = DB::table('booking_management')->where('booking_id',$booking_id)->get();
				$booking_details = DB::table('booking_details')->where('booking_id',$booking_id)->get();
				
				$i = 0;
			?>
			@foreach($booking_details as $b_det)
			    <?php
			    	$i++;
			    	$vehicle_detail = DB::table('car_management')->where('id',$b_det->vehicle_id)->get()->first();	
			    	
			    ?>
				<tr>
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">{{ $i }}</td>
					<td style="color: #ff0091;padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">{{ $vehicle_detail->title }}</td>
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">
						<img src="{{ url('/public/uploads/cars') }}/{{ $vehicle_detail->image }}">
					</td>	
						
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">{{ $vehicle_detail->vehicle_type }}</td>	
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">
						${{ $b_det->price }}
						
					</td>	
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">
						${{ $b_det->price }}
					</td>	
					
				</tr>
			@endforeach
			<tr>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"><b>Total</b></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">
					<b>
					<?php
						$booking_total = $booking_mgmt->total;	
						echo "$".number_format((float)$booking_total, 2, '.', '');
					?>
					</b>
				</td>
			</tr>
			
		</tbody>
		
	</table>
</div>