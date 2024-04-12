<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.87.0">
  <title>Voting System</title>

  <!-- Bootstrap core CSS -->
  <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .green {
      background: #b4d8b4;
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>

<body>

  @include('layouts.partials.navbar')

  <main class="container">
    @yield('content')
  </main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    (function($) {
      $.fn.styleddropdown = function() {
        return this.each(function() {
          var obj = $(this)
          obj.find('.field').on('click', function() { //onclick event, 'list' slideIn/slideOut
            obj.find('.list').slideToggle(400);
          });

          obj.find('.list li').on('click', function() { //onclick event, select 'list' item
            var classSel = $(this).attr('class'),
              typeBRules = '',
              typeCRules = '';
            // if 'li' has been disabled act like the goggles (do nothing)
            if ($(this).hasClass('disabled')) {
              $('#candidateid').val('');
              $('#candBtn').attr('disabled');

              return false;
            }

            if ($(this).hasClass('selected')) {
              $(this).removeClass('selected');
              $('#candidateid').val('');
              $('#candBtn').attr('disabled', 'disabled');


            } else {
              $('#candBtn').removeAttr('disabled');

              // Clear out any previous selection from the grouping
              $('[class~=' + classSel + ']').removeClass('selected');
              // Select clicked 'li'
              $(this).addClass('selected');
              dataval = $(this).attr('data-value');
              $('#candidateid').val(dataval);
              // Set the rules to affect by, comment out to not have the groups interact at all
              typeBRules = {
                '1': '5'
              };
              typeCRules = {
                '5': '2'
              };
            }

            // if the rules are blank interact function will just clear the 'disabled' class
            if ($(this).hasClass('typeB')) { // If it's in the second group, affect the third group
              interact($(this), typeBRules, '.typeB', '.typeC');
            } else if ($(this).hasClass('typeC')) { // If it's in the third group, affect second group
              interact($(this), typeCRules, '.typeC', '.typeB');
            }
          });

          interact = function(selection, rules, selectionClass, interactClass) {
            var valueSel = selection.html(),
              dataSel = $(interactClass + '[data-value~=' + rules[valueSel] + ']');
            if (rules[valueSel]) {
              $(selectionClass).removeClass('disabled');
              dataSel.addClass('disabled').removeClass('selected');
            } else {
              $(interactClass).removeClass('disabled');
            }
          }
        });
      };
    })(jQuery);

    $(function() {
      $('.select').styleddropdown();
    });

    jQuery(document).on("click", ".candBtn", function() {
      var candidate = $('#candidateid').val(),
        hitURL = "{{ route('votecandidate') }}";

      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this change!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Vote Now!"
      }).then((result) => {
        if (result.isConfirmed) {
          jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: hitURL,
            data: {
              candidate: candidate,
              "_token": "{{ csrf_token() }}"
            }
          }).done(function(data) {
            console.log(data);
            if (data.status = true) {
              Swal.fire({
                title: "Success!",
                text: "Voted Successfully.",
                icon: "success",
                allowOutsideClick: false,
                allowEscapeKey: false
              }).then((result) => {
                location.reload();
              });
            } else if (data.status = false) {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
              })
            } else {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Access Denied!"
              });
            }
          });



        }
      });
    });


    jQuery(document).on("click", ".deletcand", function() {
      var candidate = $('#candidateid').val(),
        hitURL = "{{ route('votecandidate') }}";

      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this change!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Vote Now!"
      }).then((result) => {
        if (result.isConfirmed) {
          jQuery.ajax({
            type: "POST",
            dataType: "json",
            url: hitURL,
            data: {
              candidate: candidate,
              "_token": "{{ csrf_token() }}"
            }
          }).done(function(data) {
            console.log(data);
            if (data.status = true) {
              Swal.fire({
                title: "Success!",
                text: "Voted Successfully.",
                icon: "success",
                allowOutsideClick: false,
                allowEscapeKey: false
              }).then((result) => {
                location.reload();
              });
            } else if (data.status = false) {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!"
              })
            } else {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Access Denied!"
              });
            }
          });



        }
      });
    });
  </script>
</body>

</html>