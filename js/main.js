jQuery(document).ready(function ($) {

    $('#footer-menu').tabs();

    // click instead of change to get around IE's "proper" change implementation
    $('input[name=flight-type]').click(function () {
        if (this.value == 'return') {
            $('#return-form').show();
        } else {
            $('#return-form').hide();
        }
    }).filter(':checked').click();
 
    $('input[type=text]').hint();
 
});

(function ($) {
    
$.fn.tabs = function () {
    return this.each(function () {
        var $nav = $(this).find('a');
        // KEY-RAZY!
        var $panels = $($nav.click(function () {
            $panels.hide().filter(this.hash).show();
            $nav.removeClass('selected');
            $(this).addClass('selected');
        }).map(function () {
          return this.hash;
        }).get().join(','));
        
        var $url_selected = $nav.filter('[hash=' + window.location.hash + ']');
        if ($url_selected.length) {
            $url_selected.click();
        } else {
            $nav.filter(':first').click();
        }
    });
};

$.fn.hint = function (blurClass) {
  if (!blurClass) { 
    blurClass = 'blur';
  }
    
  return this.each(function () {
    // get jQuery version of 'this'
    var $input = $(this),
    
    // capture the rest of the variable to allow for reuse
      title = $input.attr('placeholder'),
      $form = $(this.form),
      $win = $(window);

    function remove() {
      if ($input.val() === title && $input.hasClass(blurClass)) {
        $input.val('').removeClass(blurClass);
      }
    }

    // only apply logic if the element has the attribute
    if (title) { 
      // on blur, set value to title attr if text is blank
      $input.blur(function () {
        if (this.value === '') {
          $input.addClass(blurClass).val(title);
        }
      }).focus(remove).blur(); // now change all inputs to title
      
      // clear the pre-defined text when form is submitted
      $form.submit(remove);
      $win.unload(remove); // handles Firefox's autocomplete
    }
  });
};


})(jQuery);