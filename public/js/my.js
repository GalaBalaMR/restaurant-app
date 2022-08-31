$(document).ready(function () {
  // nav menu--------------------------------------------------------
    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
       isClosed = false;
  
      trigger.click(function () {
        hamburger_cross();      
      });
  
      function hamburger_cross() {
  
        if (isClosed == true) {          
          overlay.hide();
          trigger.removeClass('is-open');
          trigger.addClass('is-closed');
          isClosed = false;
        } else {   
          overlay.show();
          trigger.removeClass('is-closed');
          trigger.addClass('is-open');
          isClosed = true;
        }
    }
    
    $('[data-toggle="offcanvas"]').click(function () {
          $('#wrapper').toggleClass('toggled');
    }); 
    
    // reservation ---------------------------------------------------------

  
    // show just table wich is in input
    var $id_table = $('#table');
        $actual_table = $id_table.val();

    $('.row-table').hide();

    // show reservation for first table
    $('#table-' +$actual_table).show();

    $id_table.on('click', function(){

      $('.row-table').hide();
      var $id_table_list = $(this).val(); 
          $show_table = $('#table-' +$id_table_list)

          $show_table.show();
    })

    // FORM ajax------------------------------------------------------
    //Reservation form
    var $res_form = $('#reservation-form');
        $loader = $('#loader');
        $alert = $('<div class="alert"></div>');
        $alert_p = $('<p></p>');

    $alert_p.appendTo($alert);


    $res_form.on('submit', function(event){
      event.preventDefault();
      
      $.ajax({
        url:  $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        beforeSend: function(){
          $loader.removeClass('d-none');
        },
        complete: function(){
          $loader.addClass('d-none');
          
        },
        success: function(data){

          //add value, delay and hide on ALERT
          //prepend it on info-mail 

          $alert_p.text(data.flash);
          $alert.prependTo($res_form);
          if(data.status == '1'){
          $alert.addClass('alert-success');
        }else{
            $alert.addClass('alert-danger');
          }
          $alert.show();
          $alert.delay(3000).hide(2000);

          //remove value from input except option input
          if($(this).find('.form-control:option'))
          {
            $('.form-control:not(option)').each(function() {
              $(this).val('');
            });
          };

        },

      })
    })

    // Content Form------------------------------------------------------
    // Content form update
    var $content_form_Updt = $('.content-form-update');
        

    $content_form_Updt.each(function(){
      $(this).on('submit', function(event){
        event.preventDefault();
        var $this_form = $(this);
        $.ajax({
          url:  $(this).attr('action'),
          method: 'POST',
          data: $(this).serialize(),
          beforeSend: function(){
            $loader.removeClass('d-none');
          },
          complete: function(){
            $loader.addClass('d-none');
            
          },
          success: function(data){
            
            var $changing_div = $('.'+ data.name +'');

            $changing_div.slideUp(400, function() {
              // Animation complete.
              $changing_div.empty().append( data.content );
            });
            $changing_div.slideDown(500);
            //add value, delay and hide on ALERT
            //prepend it on info-mail 
  
            $alert_p.text(data.flash);
            $alert.prependTo($this_form).hide().slideDown(500);
            if(data.status == '1'){
              $alert.addClass('alert-success');
            }else{
              $alert.addClass('alert-danger');
            }
            $alert.show();
            $alert.delay(3000).hide(2000);
  
          },
  
        })
      })
      
    })

    //Content form delete
    var $content_form_dlt = $('.content-form-delete')


    $content_form_dlt.each(function(){
      $(this).on('submit', function(event){

        event.preventDefault();

        var $this_form = $(this);

        $.ajax({
          url:  $(this).attr('action'),
          method: 'POST',
          data: $(this).serialize(),
          beforeSend: function(){
            $loader.removeClass('d-none');
          },
          complete: function(){
            $loader.addClass('d-none');
            
          },
          success: function(data){
            
            var $deleted_card = $('#content-card'+ data.id);

            console.log($deleted_card , data);

            $deleted_card.slideUp(500, function() {
              $deleted_card.remove();
          });
            //add value, delay and hide on ALERT
            //prepend it on info-mail 
  
            $alert_p.text(data.flash);
            $alert.prependTo('main').hide().slideDown(1000);
            if(data.status == '1'){
              $alert.addClass('alert-success');
            }else{
              $alert.addClass('alert-danger');
            }
            $alert.show();
            $alert.delay(3000).hide(2000);
  
          },
  
        })
      })
      
    })

    //Info Mail------------------------------------------
    var $info_mail = $('#info-mail');
        
    $info_mail.on('submit', function(event){
      event.preventDefault();

      $.ajax({
        url:  $(this).attr('action'),
        method: $(this).attr('method'),
        data: $(this).serialize(),
        beforeSend: function(){
          $loader.removeClass('d-none');
        },
        complete: function(){
          $loader.addClass('d-none');
        },
        success: function(data){

          //add value, delay and hide on ALERT
          //prepend it on info-mail 

          $alert_p.text(data.flash);
          $alert.addClass('alert-success');
          $alert.prependTo($info_mail);
          $alert.show();
          $alert.delay(3000).hide(2000);

          //remove value from input
          $('.form-control').each(function() {
            $(this).val('');
            
          });

        }

      })
    });

     // other-----------------------------------------------------------

  // if is some session hide it after 3 seconds
  $('#flash-message').delay(3000).hide(3000);

  // if is some session status hide it after 3 seconds
  $('#status').delay(3000).hide(3000);

  //hide and show content form
    var $content_form_div = $('.content-form-div');
        $content_form_a = $('.content-form-a');

    $content_form_div.hide();

    $content_form_a.each(function(){
      $(this).on('click', function(event){
        event.preventDefault();
        $(this).next().slideToggle(1000);
      })
    })

    $('.content-textarea').trumbowyg();

  });