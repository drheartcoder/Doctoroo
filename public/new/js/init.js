 $('.collapsible').collapsible();
$('.button-collapse').sideNav({
        menuWidth: 310, // Default is 240
        edge: 'left', // Choose the horizontal origin
});

$('.button-collapse-open').sideNav({
      menuWidth: 300, // Default is 240
      edge: 'right', // Choose the horizontal origin
      closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
    });

 // modal start
$('.modal').modal({
      dismissible: false, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
    }
  );
// modal end

//select dropdown
$(document).ready(function() {
    $('select').material_select();
});



/*$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'mm/dd/yyyy',
    hiddenName: true,
    closeOnSelect: true,
    closeOnClear: true,
});*/

/*$('.datepicker').pickadate({
    closeOnSelect: true,
    closeOnClear: true,
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
  onStart: function() {
    console.log('Hello there :)')
  },
  onRender: function() {
    console.log('Whoa.. rendered anew')
  },
  onOpen: function() {
    console.log('Opened up')
  },
  onClose: function() {
    console.log('Closed now')
  },
  onStop: function() {
    console.log('See ya.')
  },
  onSet: function(val) {
    console.log('Just set stuff:', val)
  }
})*/

/*$('#timepicker_default').pickatime({
      default: 'now'
});*/

$('.materialboxed').materialbox();


  $/*('input.autocomplete').autocomplete({
    data: {
      "Apple": null,
      "Microsoft": null,
      "Google": 'https://placehold.it/250x250'
    },
    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    onAutocomplete: function(val) {
      // Callback function when value is autcompleted.
    },
    minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
  });*/
        



      
