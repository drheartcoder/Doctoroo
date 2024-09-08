$( '.datepicker' ).pickadate({
  format: 'dd/mm/yyyy',
  formatSubmit: 'yyyy-mm-dd',
  defaultValue: false,
  disable:[{from: [0,0,0], to: true }],
  onOpen: function() {
      console.log( 'Opened')
  },
  onClose: function() {
      console.log( 'Closed ' + this.$node.val() )
      
      selected_date = this.$node.val();
      var token = $('input[name="_token"]').val();
      $.ajax({
           url   : "{{ url('/') }}/patient/booking/get_doctor_available_time",
           type  : "POST",
           dataType:'json',
           data: {_token:token,selected_date:selected_date},
           success : function(res){
              
           }
      });
  },
  onSelect: function() {
      console.log( 'Selected: ' + this.$node.val() )
  },
  onStart: function() {
      console.log( 'Hello there :)' )
  }
})