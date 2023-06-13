<div class="modal modal-fade " id="cancelledAppointmentModal">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Cancelled Appointment Reason</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
      <div class="modal-body">
        <form action="{{route('bookingCancelled')}}" method="post" id="bookingForm">
          @csrf
      
          <div class="row">
            <div class="col-md-12 form-group">
              <label>Reason For cancelled Appointment</label>
              <textarea name="reason" class="form-control" cols="5" rows="5" required="required" minlength='5'></textarea>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">      
        <input type="hidden" name="booking_id" value="" id="booking_id">  
        <button class="btn btn-sm btn-success " type="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>              
</div>