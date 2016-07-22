// when document is ready this function call 
$( document ).ready(function() {
    console.log( "ready!" );
});

// ===============================================================================================================

// when window load this function call 
$( window ).load(function() {
	console.log( "window loaded" );
});

// ===============================================================================================================

// when form submit; set FormID 
$( "#FormID" ).submit(function( event ) {
  alert( "Handler for .submit() called." );
  event.preventDefault();
});

OR

$("#FormID").on("submit", function(){
    alert("form has been submitted.");
    return false;
});

// ===============================================================================================================

// when call this event show (no valid) text up to 1 secound
$("span").text( "Not valid!" ).show().fadeOut( 1000 );

// ===============================================================================================================

// this event use to form submit
$("form").submit();

// ===============================================================================================================

// this event use to appand on p 
$( "p" ).append( "<strong>Hello</strong>" );

Example
<p>I would like to say: </p>

Output
I would like to say: Hello

// ===============================================================================================================
//this is use to appand span in foo tag
$( "span" ).appendTo( "#foo" );

Example
<span>I have nothing more to say... </span>
<div id="foo">FOO! </div>

Output
<div id="foo">
	FOO!
	<span>I have nothing more to say... </span>
</div>

// ===============================================================================================================
// this function use to click on class offsite 
// not this is not use in document.ready 
$( document ).on( "click", "a.offsite", function() {
  alert( "Goodbye!" );  // jQuery 1.7+
});


// ===============================================================================================================
// when select dropdownl opction this function call
$( ".select" ).change(function() {
  alert( "Handler for .change() called." );
});

$('select').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
});


// ===============================================================================================================
//Get value 
var bla = $('#txt_name').val();

//Set value
$('#txt_name').val('bla');


// ===============================================================================================================
// when key up get this value
$(document).ready(function(){
  $("#txt_name").keyup(function(){
    alert(this.value);
  });
});


// ===============================================================================================================
// when clieck on span add class example on all li element 
$( "span" ).click(function() {
  $( "li" ).each(function() {
    $( this ).toggleClass( "example" );
  });
});

Example
<ul>
  <li>Eat</li>
  <li>Sleep</li>
  <li>Be merry</li>
</ul>

Output
<ul>
	<li class="example">Eat</li>
	<li class="example">Sleep</li>
	<li class="example">Be merry</li>
</ul>
